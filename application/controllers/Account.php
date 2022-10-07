<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public $fields = ['first_name', 'last_name', 'contact_number', 'shop_name', 'address', 'email', 'username', 'password', 'confirm', 'type'];
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Account_model');
	}

	public function index()
	{
		$data['page_title'] = 'My Account';
		$data['page_js'] = [
			base_url('assets/js/account/profile.js')
		];

		$page_data['user'] = $this->Account_model->get(['id' => get_user_data()['id']]);
		if ( ! $page_data['user'])
		{
			$this->session->sess_destroy();
			redirect(base_url());
		}

		if ($page_data['user']->avatar && file_exists('./uploads/'. $page_data['user']->avatar)) 
		{
			$page_data['user']->avatar = base_url('./uploads/'. $page_data['user']->avatar);
		} 
		else 
		{
			$page_data['user']->avatar = get_default_avatar();
		}

		if (in_array(get_user_type(), [-1, 0])) 
		{
			$page_data['bank_account'] = $this->Account_model->get_bank_account();
		}

		$data['body'] = $this->load->view('account/personal', $page_data, true);

		$this->load->view('index', $data);
	}

	public function alist()
	{
		if (get_user_type() != -1)
		{
			show_404();
		}

		$data['page_title'] = 'Accounts';
		$data['nav_active'] = 'account_list';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/account/list.js')
		];

		$page_data['types'] = [
			'Admin',
			'Seller',
			'Customer'
		];
		
		$where = [];
		$user_type = $this->input->post('type');
		if ($user_type)
		{
			$where['type'] = $user_type;
		}

		$page_data['list'] = $this->Account_model->all($where);

		$data['body'] = $this->load->view('account/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function create()
	{
		if (get_user_type() != -1)
		{
			show_404();
		}
		$data['page_title'] = 'Create Account';
		$data['nav_active'] = 'account_list';
		$data['page_js'] = [
			base_url('assets/js/helpers.js'),
			base_url('assets/js/account/create.js')
		];
		$data['body'] = $this->load->view('account/create', NULL, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		$user_type = $this->input->post('type');

		$exclude = [];

		if ($user_type == 0) 
		{
			$exclude = ['shop_name', 'address'];
		}
		else if ($user_type == 2) 
		{
			$exclude = ['shop_name'];
		}

		$exclude[] = 'file';

		if (has_empty_post($exclude)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$fields = array_diff($this->fields, $exclude);

		$data = parse_data($_POST, $fields);

		if ( ! isset($data['password']))
		{
			json_response(FALSE, 'Please provide a password');
		}
		
		if (!isset($data['confirm']) || $data['password'] !== $data['confirm']) {
			json_response(FALSE, 'Password and retyped password doesn\'t match.');
		}
		
		unset($data['confirm']);
		
		if (isset($_POST['file']))
		{
			$data['avatar'] = $this->upload_avatar($_POST['file']);
		}

		if($this->Account_model->is_username_exists($data['username']))
		{
			json_response(FALSE, 'Username is already used. Please use another.');
		}

		try 
		{
			$this->db->trans_start();
			
			$user_id = $this->Account_model->create($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Created account successfully');
	}

	public function edit($user_id)
	{
		$data['page_title'] = 'Edit Account';
		$data['page_js'] = [
			base_url('assets/js/account/update.js')
		];

		$page_data['user'] = $this->Account_model->get(['id' => $user_id]);

		if ($page_data['user']->avatar && file_exists('./uploads/'. $page_data['user']->avatar)) 
		{
			$page_data['user']->avatar = base_url('./uploads/'. $page_data['user']->avatar);
		} 
		else 
		{
			$page_data['user']->avatar = get_default_avatar();
		}

		$data['body'] = $this->load->view('account/edit', $page_data, true);

		$this->load->view('index', $data);
	}

	public function view($user_id)
	{
		$data['page_title'] = 'View Account';
		$data['page_js'] = [
			base_url('assets/js/account/update.js')
		];
		$data['nav_active'] = 'account_list';

		$page_data['user'] = $this->Account_model->get(['id' => $user_id]);

		if ($page_data['user']->avatar && file_exists('./uploads/'. $page_data['user']->avatar)) 
		{
			$page_data['user']->avatar = base_url('./uploads/'. $page_data['user']->avatar);
		} 
		else 
		{
			$page_data['user']->avatar = get_default_avatar();
		}

		$data['body'] = $this->load->view('account/view', $page_data, true);

		$this->load->view('index', $data);
	}

    public function update()
    {
		$id = $this->input->post('id');

		if ( ! in_array(get_user_type(), [-1, 0]) && $id != get_user_data()['id']) 
		{
			json_response(FALSE, 'You can not edit other user\'s account');
		}

		$user = $this->Account_model->get(['id' => $id], 'type, avatar');
		$user_type = $user->type;

		$exclude = [];

		if ($user_type == 0) 
		{
			$exclude = ['shop_name', 'address'];
		}
		else if ($user_type == 2) 
		{
			$exclude = ['shop_name'];
		}

		$exclude[] = 'file';

		$fields = array_diff($this->fields, $exclude);

		$exclude[] = 'password';
		$exclude[] = 'confirm';

		if (has_empty_post($exclude)) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, $fields);

		if($this->Account_model->is_username_exists($data['username'], $id))
		{
			json_response(FALSE, 'Username is already used. Please use another.');
		}

		if ( ! empty($data['password']) || ! empty($data['confirm']))
		{
			if (!isset($data['confirm']) || $data['password'] !== $data['confirm']) 
			{
				json_response(FALSE, 'Password and retyped password doesn\'t match.');
			}

			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		}
		else 
		{
			unset($data['password']);
		}

		unset($data['confirm']);

		
		if (isset($_POST['file']))
		{
			if ($user->avatar && file_exists('./uploads/'. $user->avatar)) 
			{
				unlink('./uploads/'. $user->avatar);
			}
			$data['avatar'] = $this->upload_avatar($_POST['file']);
		}

		$this->Account_model->update($data, $id);
		
		if (get_user_data()['id'] == $id && isset($_POST['file'])) 
		{
			if ($data['avatar'] && file_exists('./uploads/'. $data['avatar'])) 
			{
				$_SESSION['logged_in']['avatar'] = base_url('./uploads/'. $data['avatar']);
			} 
			else 
			{
				$_SESSION['logged_in']['avatar'] = get_default_avatar();
			}
		}
        
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ($id == get_user_data()['id']) 
		{	
			json_response(FALSE, 'Cannot delete current user\'s account');
		}

		$user = $this->Account_model->get(['id' => $id], 'avatar, type');

		// seller
		if ($user->type == 1)
		{
			if ($this->Account_model->has_products($id))
			{
				json_response(FALSE, 'Cannot delete account. The seller has products.');
			}
			
		}
		
		if ($user && $user->avatar && file_exists('./uploads/'. $user->avatar)) 
		{
			unlink('./uploads/'. $user->avatar);
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Account_model->delete($id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
		json_response(TRUE, 'Deleted successfully');
	}
	
	private function upload_avatar($file) 
	{
		$split = explode( '/', $file );
		$file_ext = explode( ';', $split[1] )[0];
		$filename = md5(uniqid().time()) . '.' . $file_ext; 
		$filepath = './uploads/';
		$img = file_put_contents($filepath.$filename, base64_decode(explode(',',$file)[1]));
		return $filename;
	}

	public function update_bank_account ()
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'Can not update account.');
		}

		$account = $this->input->post('account');
		$bank = $this->input->post('bank');

		if ( ! trim($account) && ! trim($bank) )
		{			
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = [
			'account' => $account,
			'bank' => $bank
		];

		$this->Account_model->update_bank_account($data);

		json_response(TRUE, 'Updated successfully');
	}
}

