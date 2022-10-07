<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

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
                    ->from('categories')
                    ->where('name', $name)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('categories')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all()
    {
        return $this->db->select('*')
                    ->from('categories')
                    ->get()
                    ->result();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('categories');
    }

    public function has_products($id)
    {
        $query = $this->db->select('id')
                    ->from('products')
                    ->where('type', $id)
                    ->where('deleted', 0)
                    ->get();

        return $query->num_rows() > 0;
    }
}
?>