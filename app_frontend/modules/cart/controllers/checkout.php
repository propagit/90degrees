<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if(!modules::run('auth/is_user_logged_in')){
			redirect('customer/login');	
		}
		$this->load->model('order/order_model');
	}
	
	function index()
	{
		$this->address();
	}
	
	function address()
	{	
		if(!$this->session->userdata('agreed_to_terms')){
			redirect('cart');
		}
				
		if($this->session->userdata('user_id')){
			$user_id = $this->session->userdata('user_id');
			$customer = modules::run('customer/get_customer',$user_id);	
			if($customer){
				$data['customer'] = $customer;	
			}
		}
		
		#$data['add_css'] = $this->load->view('product/css', isset($data) ? $data : NULL, true);
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('cart/address', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	
	function payment()
	{
		if(!$this->session->userdata('agreed_to_terms') || !$this->session->userdata('delivery_address')){
			redirect('cart');
		}
		
		
		
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('cart/payment', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);

	}
	
	function confirm()
	{
		if($this->session->flashdata('cur_order_id')){
			$order_id = $this->session->flashdata('cur_order_id');
		}else{
			redirect(base_url());
		}
		
		$data['order'] = $this->order_model->get_order($order_id);
		$data['order_items'] = $this->order_model->get_order_items($order_id);
		
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('cart/confirm', isset($data) ? $data : NULL);
		#$data['add_js'] = $this->load->view('product/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	
	function failed()
	{
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('cart/failed', isset($data) ? $data : NULL);
		#$data['add_js'] = $this->load->view('product/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);	
	}
	
	function get_deliver_address($form_data = 'populate')
	{
		$user_id = $this->session->userdata('user_id');
		$customer = modules::run('customer/get_customer',$user_id);	
		if($customer && $form_data == 'populate'){
			$data['customer'] = $customer;	
		}else{
			$data['customer'] = array();		
		}
		return $this->load->view('cart/ajax_delivery_address', isset($data) ? $data : NULL, true);
	}
	
	function order_step_header($active = 'address')
	{
		$data['active'] = $active;
		$this->load->view('order_step_header',isset($data) ? $data : NULL);	
	}
	
}