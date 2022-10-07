<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['page_title'] = 'Add Product';
		$data['nav_active'] = 'product_list';

		$data['categories'] = categories();

		$data['page_js'] = [
			base_url('assets/js/helpers.js'),
			base_url('assets/js/product/create.js')
			
		];

		$data['body'] = $this->load->view('product/create', $data, true);
		$this->load->view('index', $data);
	}

	public function process()
	{
		if (has_empty_post(['file', 'files']))
		{
			json_response(FALSE, 'Fill in the empty fields');
		}
		$fields = ['name', 'description', 'type', 'price', 'total_person'];

		$data = parse_data($_POST, $fields);

		$this->load->model('Product_model');

		if($this->Product_model->is_name_exists($data['name']))
		{
			json_response(FALSE, 'Product name is already exist.');
		}

		$files = [];
		foreach ($_POST['files'] as $file) 
		{
			$split = explode( '/', $file );
			$file_ext = explode( ';', $split[1] )[0];
			$filename = md5(uniqid().time()) . '.' . $file_ext; 
            $filepath = './uploads/';
			$img = file_put_contents($filepath.$filename, base64_decode(explode(',',$file)[1]));

			$files[] = $filename;
		}

		try 
		{
			$this->db->trans_start();
			
			$product_id = $this->Product_model->create($data);
			$this->Product_model->save_image($files, $product_id);


			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Created successfully', $product_id);
	}
}