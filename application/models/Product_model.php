<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function is_name_exists($name, $id = NULL)
    {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->select('name')
                    ->from('products')
                    ->where('name', $name)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
        $data['user_id'] = get_user_data()['id'];

        if (get_user_type() == 1) { // seller
            $data['request_status'] = 1;
        }
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function all($where = [], $limit = NULL)
    {
        $this->db->select('*')
            ->from('products')
            ->where_arr($where);

        if ($limit)
        {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    public function all_with_seller($where = [])
    {
        return $this->db->select('p.*, CONCAT(s.first_name, " ", s.last_name) AS seller, s.email')
                    ->from('products p')
                    ->join('users s', 'p.user_id = s.id', 'LEFT')
                    ->where_arr($where)
                    ->where('deleted', 0)
                    ->get()
                    ->result();
    }

    public function requests()
    {
        return $this->db->select('p.*, CONCAT(s.first_name, " ", s.last_name) AS seller, s.email')
                    ->from('products p')
                    ->join('users s', 'p.user_id = s.id', 'LEFT')
                    ->where_in('request_status', [1, 3]) // pending and disapproved
                    ->get()
                    ->result();
    }

    public function save_image($images, $product_id)
    {
        $data = [];
        foreach ($images as $image) {
            $data[] = [
                'image_url' => $image,
                'product_id' => $product_id
            ];
        }
        return $this->db->insert_batch('product_images', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('products')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function get_image($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('product_images')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function product_images($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('product_images')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function one_image_per_product($where = [], $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('product_images')
                    ->where_arr($where)
                    ->group_by('product_id')
                    ->get()
                    ->result();
    }

    public function delete_image($image_id)
    {
        $image_data = $this->get_image(['id' => $image_id], 'image_url');
        if ($image_data && $image_data->image_url && file_exists('./uploads/'.$image_data->image_url)) 
        {
            unlink('./uploads/'.$image_data->image_url);
        }
        $this->db->where('id', $image_id);
        return $this->db->delete('product_images');
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function product_reviews($where = [])
    {
        return $this->db->select('r.*, CONCAT(c.first_name, " ", c.last_name) AS customer, c.email')
                    ->from('reviews r')
                    ->join('ordered_services o', 'r.order_id = o.id', 'LEFT')
                    ->join('users c', 'o.customer_id = c.id', 'LEFT')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function product_ids($where = [], $limit = NULL)
    {
        $this->db->select('id')
            ->from('products')
            ->where_arr($where);

        if ($limit)
        {
            $this->db->limit($limit);
        }
        
        return $this->db->get()->result_array();
    }
}
?>