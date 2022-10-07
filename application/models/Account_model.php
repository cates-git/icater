<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function is_username_exists($username, $id = NULL)
    {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->select('username')
                    ->from('users')
                    ->where('username', $username)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function create($data)
    {
		// encrypt password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function get($where, $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('users')
                    ->where_arr($where)
                    ->get()
                    ->row();
    }

    public function all($where = [])
    {
        return $this->db->select('id, first_name, last_name, address, contact_number, shop_name, email, username, type, avatar')
                    ->from('users')
                    ->where('type!=', -1) // exclude super admin
                    ->where('id!=', get_user_data()['id'])
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function users($where = [], $fields = '*')
    {
        return $this->db->select($fields)
                    ->from('users')
                    ->where_arr($where)
                    ->get()
                    ->result();
    }

    public function search_seller($keyword)
    {
        // $search = $this->set_like($keyword);

        // $this->db->group_start();
        // foreach ($search['like'] as $like) {
        //     $this->db->or_like($like);
        // }
        // $this->db->group_end();

        return $this->db->select('id, CONCAT(first_name, " ", last_name) AS name, email, avatar, shop_name, contact_number, address')
            ->from('users')
            ->where('type', 1)
            ->like('address', $keyword)
            // ->order_by("(".implode('+', $search['order']).")", 'DESC')
            ->get()
            ->result();
    }

    private function set_like($keyword)
    {
        $like = [];
        $order_by = [];
        
        $words = explode(' ', $keyword);

        // $search_fields = ['first_name', 'last_name', 'address', 'shop_name'];
        $search_fields = ['address'];
        
        foreach ($search_fields as $field)
        {
           foreach ($words as $word)
            {
                $like[] = [$field => $word];
                $order_by[] = "(case when {$field} like '%{$word}%' then 1 else 0 end)";
            }
 
        }
        
        return [
            'like' => $like,
            'order'  => $order_by
        ];
    }

    public function delete($user_id)
    {
        $usertype = $this->get(['id' => $user_id], 'type')->type;

        // customer
        if ($usertype == 2)
        {
            // delete ordered services
            $this->db->where('customer_id', $user_id)->delete('ordered_services');
            // delete booked services
            $this->db->where('user_id', $user_id)->delete('booked_services');
            // messages
            $this->db->where('sender', $user_id)->delete('messages');
            $this->db->where('receiver', $user_id)->delete('messages');
        }

        // seller
        elseif ($usertype == 1)
        {
            $this->db->where('user_id', $user_id)->delete('products');
        }

        
        return $this->db->where('id', $user_id)->delete('users');
    }

    public function has_products($id)
    {
        $query = $this->db->select('id')
                    ->from('products')
                    ->where('user_id', $id)
                    ->where('deleted', 0)
                    ->get();

        return $query->num_rows() > 0;
    }

    public function get_bank_account()
    {
        $query = $this->db->select('*')
                    ->from('bank_account')
                    ->get();
                    
        if ($query->num_rows() > 0) 
        {
            return $query->row();
        }

        $account = new StdClass();
        $account->account = '';
        $account->bank = '';
        return $account;
    }

    public function update_bank_account($data)
    {
        $query = $this->db->select('*')
                    ->from('bank_account')
                    ->get();
        
        if ($query->num_rows() > 0) 
        {
            $id = $query->row()->id;
            
            $this->db->where('id', $id);
            return $this->db->update('bank_account', $data);
        }

        $this->db->insert('bank_account', $data);
        return $this->db->insert_id();
    }
}
?>