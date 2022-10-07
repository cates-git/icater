<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function add($data)
    {
        $this->db->insert('ordered_services', $data);
        return $this->db->insert_id();
    }

    public function all($where = [])
    {
        return $this->db->select('o.*, p.name, p.type, p.price, CONCAT(c.first_name, " ", c.last_name) AS customer_name, c.email, r.rate, r.comment')
                    ->from('ordered_services o')
                    ->join('products p', 'o.product_id = p.id', 'RIGHT')
                    ->join('users c', 'o.customer_id = c.id', 'LEFT')
                    ->join('reviews r', 'r.order_id = o.id', 'LEFT')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function customer_orders($where = [])
    {
        return $this->db->select('o.*, p.name, p.type, r.rate, r.comment')
                    ->from('ordered_services o')
                    ->join('products p', 'o.product_id = p.id', 'RIGHT')
                    ->join('reviews r', 'r.order_id = o.id', 'LEFT')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('ordered_services', $data);
    }

    public function booked_services($where = [])
    {
        return $this->db->select('o.*, p.name, p.type, p.user_id, CONCAT(c.first_name, " ", c.last_name) AS customer_name, c.email, b.id AS book_id, b.date_notified, CONCAT(s.first_name, " ", s.last_name) AS seller_name')
                    ->from('ordered_services o')
                    ->join('products p', 'o.product_id = p.id', 'RIGHT')
                    ->join('users c', 'o.customer_id = c.id', 'RIGHT')
                    ->join('users s', 'p.user_id = s.id', 'RIGHT')
                    ->join('booked_services b', 'b.order_id = o.id', 'LEFT')
                    ->where_arr($where)
                    ->where_in('o.status', [1, 4])
                    ->where('p.request_status', 2)
                    ->get()
                    ->result();
    }

    public function seller_booked_services($where = [])
    {
        return $this->db->select('b.id AS book_id, b.order_id, b.date_notified, o.*, p.name, p.type, CONCAT(c.first_name, " ", c.last_name) AS customer_name, c.email')
                    ->from('booked_services b')
                    ->join('ordered_services o', 'b.order_id = o.id', 'LEFT')
                    ->join('products p', 'o.product_id = p.id', 'RIGHT')
                    ->join('users c', 'o.customer_id = c.id', 'RIGHT')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function notify_seller($data)
    {
        $data['user_id'] = get_user_data()['id'];
        $this->db->insert('booked_services', $data);
        return $this->db->insert_id();
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('ordered_services')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function review($data)
    {
        $this->db->insert('reviews', $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('ordered_services');
    }

    public function has_ordered($where = [])
    {
        $query = $this->db->select('id')
                    ->from('ordered_services')
                    ->where_arr($where)
                    ->get();

        return $query->num_rows() > 0;
    }
}
?>