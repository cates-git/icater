<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		is_logged_in();
		$this->load->model('Product_model');
	}

	public function add_images($product_id)
	{
        if ( ! $product_id) 
        {
			json_response(FALSE, 'Cannot find product');
        }
        
        if ( ! isset($_POST['files'])) 
        {
			json_response(FALSE, 'Please select image to upload');
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
        $this->Product_model->save_image($files, $product_id);
		
        json_response(TRUE, 'Images uploaded successfully');
    }

	public function set_status()
	{
		if (has_empty_post())
		{
			json_response(FALSE, 'Fill in the empty fields');
		}

        $data = ['status' => $this->input->post('status')];
        $product_id = $this->input->post('id');

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

	public function set_request_status($product_id, $request_status)
	{
        $data = ['request_status' => $request_status];

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
		$msg = $request_status == 2 ? 'approved' : 'disapproved';
        json_response(TRUE, "Request {$msg} successfully");
	}

	public function delete($product_id)
	{
		$product = $this->Product_model->get(['id' => $product_id]);

		if (get_user_type() == 1 && $product->user_id != get_user_data()['id']) 
		{	
			json_response(FALSE, "You are not allowed to delete the product.");
		}
		
		try 
		{
			$this->db->trans_start();
			
			$this->Product_model->update(['deleted' => 1], $product_id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, "Deleted successfully");
	}
}