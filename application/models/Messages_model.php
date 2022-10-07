<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function add($data)
    {
        $this->db->insert('ordered_services', $data);
        return $this->db->insert_id();
    }

    public function all($where = [], $or_where = [])
    {
        if ( ! empty($or_where)) 
        {   
            $this->db->group_start()->or_where_arr($or_where)->group_end();
        }

        return $this->db->select('*')
                    ->from('messages')
                    ->where_arr($where)
                    ->order_by('create_time', 'DESC')
                    ->get()
                    ->result();
    }

    public function customer_messages($where = [], $or_where = [])
    {
        if ( ! empty($or_where)) 
        {   
            $this->db->group_start()->or_where($or_where)->group_end();
        }

        return $this->db->select('m.*, CONCAT(s.first_name, " ", s.last_name) AS sender_name, s.email AS sender_email, s.avatar AS sender_avatar, CONCAT(r.first_name, " ", r.last_name) AS receiver_name, r.email AS receiver_email, r.avatar AS receiver_avatar')
                    ->from('messages m')
                    ->join('users s', 'm.sender = s.id', 'RIGHT')
                    ->join('users r', 'm.receiver = r.id', 'LEFT')
                    ->where_arr($where)
                    ->order_by('create_time')
                    ->get()
                    ->result();
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('messages')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function create($data)
    {
        $this->db->insert('messages', $data);
        return $this->db->insert_id();
    }

}
?>