<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		is_logged_in();
		$this->page_js = [
			base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'),
			base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'),
			base_url('assets/js/pages/tables.js')
		];
		$this->load->model('Product_model');
		$this->categories = categories();

	}

	public function alist()
	{
		$data['page_title'] = 'Products';
		$data['nav_active'] = 'product_list';
		
		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/product/list.js');
		
		$page_data['categories'] = $this->categories;

		if (get_user_type() == 1) 
		{
			$data['page_title'] = 'My Product Requests';
			$page_data['list'] = $this->Product_model->all(['user_id' => get_user_data()['id']]);
		} 
		else 
		{
			$page_data['list'] = $this->Product_model->all_with_seller(['request_status' => [0, 2]]);
		}

		$data['body'] = $this->load->view('product/list', $page_data, true);
		$this->load->view('index', $data);
	}

	public function ordered()
	{
		$is_customer = get_user_type() == 2;

		$data['page_title'] = $is_customer ? 'My Booked Services' : 'Ordered Services';
		$data['nav_active'] = 'product_ordered';
		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/product/ordered.js');

		$page_data['categories'] = $this->categories;

		$this->load->model('Order_model');
		if ($is_customer)
		{
			$page_data['list'] = $this->Order_model->customer_orders([
											'customer_id' => get_user_data()['id'],
											'o.status!=' => 3
										]);
		}
		else 
		{
			$page_data['list'] = $this->Order_model->all(['o.status!=' => 3]);
		}

		if (get_user_type() == 2) 
		{
			$this->load->model('Account_model');
			$page_data['bank_account'] = $this->Account_model->get_bank_account();
		}
		
		$data['body'] = $this->load->view('product/ordered', $page_data, true);
		$this->load->view('index', $data);
	}

	public function cancelled()
	{
		$is_customer = get_user_type() == 2;

		$data['page_title'] = $is_customer ? 'My Ordered Services' : 'Cancelled Services';
		$data['nav_active'] = 'product_cancelled';

		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/product/cancelled.js');

		$page_data['categories'] = $this->categories;

		$this->load->model('Order_model');
		if ($is_customer)
		{
			$page_data['list'] = $this->Order_model->customer_orders([
											'customer_id' => get_user_data()['id'],
											'o.status' => 3
										]);
		}
		else 
		{
			$page_data['list'] = $this->Order_model->all(['o.status' => 3]);
		}
		
		$data['body'] = $this->load->view('product/cancelled', $page_data, true);
		$this->load->view('index', $data);
	}

	public function requests()
	{
		$data['page_title'] = "Seller's Product Request";
		$data['nav_active'] = 'product_requests';
		
		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/product/requests.js');

		
		$page_data['categories'] = $this->categories;

		$page_data['list'] = $this->Product_model->requests();

		$data['body'] = $this->load->view('product/requests', $page_data, true);
		$this->load->view('index', $data);
	}

	public function booked()
	{
		$is_seller = get_user_type() == 1;

		$data['page_title'] = $is_seller ? 'My Services' : 'Booking Section';
		$data['nav_active'] = 'product_booked';
		$data['page_js'] = $this->page_js;
		$data['page_js'][] = base_url('assets/js/product/booked.js');

		$page_data['categories'] = $this->categories;

		$this->load->model('Order_model');
		$where = [];
		if ($is_seller)
		{
			$where = ['p.user_id' => get_user_data()['id']];
			$page_data['list'] = $this->Order_model->seller_booked_services($where);
		}
		else
		{
			$page_data['list'] = $this->Order_model->booked_services($where);
		}
		
		$data['body'] = $this->load->view('product/booked', $page_data, true);
		$this->load->view('index', $data);
	}
}
