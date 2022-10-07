<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		is_logged_in();
		$this->load->model('Product_model');
	}

	public function index($product_id)
	{
		if ( ! $product_id)
		{
			show_404();
		}
		$data['page_title'] = 'Product Info';
		$data['nav_active'] = 'product_list';
		$data['page_js'] = [
			base_url('assets/js/helpers.js'),
			base_url('assets/js/product/view.js')
			
		];

		$page_data['categories'] = categories();

		$page_data['info'] = $this->Product_model->get(['id' => $product_id]);
		if ( ! $page_data['info']) {
			redirect(base_url('Product/alist'));
		}
		$page_data['images'] = $this->Product_model->product_images(['product_id' => $product_id]);


		$data['body'] = $this->load->view('product/view', $page_data, true);
		$this->load->view('index', $data);
	}

	public function delete_image($image_id)
	{
		$image_url = $this->Product_model->get_image(['id' => $image_id], 'image_url')->image_url;
		
		if ($image_url && file_exists('./uploads/'. $image_url)) 
		{
			unlink('./uploads/'. $image_url);
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Product_model->delete_image($image_id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Deleted successfully');
	}

	public function update($product_id)
	{
		if (has_empty_post())
		{
			json_response(FALSE, 'Fill in the empty fields');
		}

		$fields = ['name', 'description', 'type', 'price', 'total_person'];

		$data = parse_data($_POST, $fields);
		if($this->Product_model->is_name_exists($data['name'], $product_id))
		{
			json_response(FALSE, 'Product name is already exist.');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->Product_model->update($data, $product_id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Updated successfully');

	}
}