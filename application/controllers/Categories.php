<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Categories_model');
	}

	public function alist()
	{
		if (get_user_type() != -1)
		{
			show_404();
		}
		$data['page_title'] = 'Categories';
		$data['nav_active'] = 'categories';
		$data['page_js'] = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js'),
			base_url('assets/js/categories/list.js')
		];

		$page_data['list'] = $this->Categories_model->all();

		$data['body'] = $this->load->view('categories/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function create()
	{
		$data['page_title'] = 'Create Category';
		$data['nav_active'] = 'categories';
		$data['page_js'] = [
			base_url('assets/js/categories/create.js')
		];
		$data['body'] = $this->load->view('categories/create', NULL, true);
		$this->load->view('index', $data);
	}

	public function add()
	{		
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'Cannot create category');
		}

		if (has_empty_post(['file'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$data = parse_data($_POST, ['name']);
		
		if (isset($_POST['file']))
		{
			$data['image'] = $this->upload($_POST['file']);
		}
		else 
		{
			json_response(FALSE, 'Please provide category picture');
		}

		if($this->Categories_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Category name already exists.');
		}

		try 
		{
			$this->db->trans_start();
			
			$user_id = $this->Categories_model->create($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Created successfully');
	}
	
    public function update()
    {
		$id = $this->input->post('id');

		if ( ! in_array(get_user_type(), [-1, 0])) 
		{
			json_response(FALSE, 'Cannot update category');
		}

		$image = $this->Categories_model->get(['id' => $id], 'image')->image;

		if (has_empty_post(['file'])) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}
		
		$data = parse_data($_POST, ['name']);

		if($this->Categories_model->is_name_exists($data['name'], $id))
		{
			json_response(FALSE, 'Category name already exists.');
		}
		
		if (isset($_POST['file']))
		{
			if ($image && file_exists('./uploads/'. $image)) 
			{
				unlink('./uploads/'. $image);
			}
			$data['image'] = $this->upload($_POST['file']);
		}

		$this->Categories_model->update($data, $id);
		
		json_response(TRUE, 'Updated successfully');
	}

	public function delete($id)
	{
		if ( ! in_array(get_user_type(), [-1, 0])) 
		{	
			json_response(FALSE, 'Cannot delete category');
		}

		if ($this->Categories_model->has_products($id))
		{
			json_response(FALSE, 'Cannot delete category. There are products under this category.');
		}

		$image = $this->Categories_model->get(['id' => $id], 'image')->image;
		
		if ($image && file_exists('./uploads/'. $image)) 
		{
			unlink('./uploads/'. $image);
		}

        $this->Categories_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}
	
	private function upload($file) 
	{
		$split = explode( '/', $file );
		$file_ext = explode( ';', $split[1] )[0];
		$filename = md5(uniqid().time()) . '.' . $file_ext; 
		$filepath = './uploads/';
		$img = file_put_contents($filepath.$filename, base64_decode(explode(',',$file)[1]));
		return $filename;
	}

}

