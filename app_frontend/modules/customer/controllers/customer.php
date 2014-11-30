<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();		
		
		if(!modules::run('auth/is_user_logged_in')){
			# redirect('customer/login');	
		}else{
			$this->user_id = $this->session->userdata('user_id');	
		}
		$this->load->model('customer_model');
		$this->load->model('user_model');
		$this->load->model('order/order_model');
	}	
	
	function account()
	{
		if(!modules::run('auth/is_user_logged_in')){
			redirect('customer/login');	
		}
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => base_url(), 'label' => 'My Account'),
		)); 
		
		$this->load->view('common/header');
		$this->load->view('account', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);	
	}
	
	function personal()
	{
		if(!modules::run('auth/is_user_logged_in')){
			 redirect('customer/login');	
		}
		
		$data['customer'] = $this->get_customer($this->user_id);
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => base_url().'customer/account', 'label' => 'My Account'),
			array('url' => '#', 'label' => 'My Personal Information')
		)); 
		
		$this->load->view('common/header');
		$this->load->view('personal', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);		
	}
	
	function order_history()
	{
		if(!modules::run('auth/is_user_logged_in')){
			 redirect('customer/login');	
		}
		
		$data['add_css'] = $this->load->view('css', isset($data) ? $data : NULL, true);
		
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => base_url().'customer/account', 'label' => 'My Account'),
			array('url' => '#', 'label' => 'Order History')
		)); 
		$user_id = $this->session->userdata('user_id');
		$data['orders'] = $this->order_model->get_user_orders($user_id);
		
		$this->load->view('common/header',isset($data) ? $data : NULL);
		$this->load->view('order_history', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);		
	}
	
	function billing()
	{
		if(!modules::run('auth/is_user_logged_in')){
			 redirect('customer/login');	
		}
		
		$data['customer'] = $this->get_customer($this->user_id);
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => base_url().'customer/account', 'label' => 'My Account'),
			array('url' => '#', 'label' => 'My Billing Address')
		)); 
		
		$this->load->view('common/header');
		$this->load->view('billing', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);		
	}

	function login()
	{
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => '#', 'label' => 'Authentication'),
		)); 
		
		$this->load->view('common/header');
		$this->load->view('login', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);		
	}
	
	function forgot_password()
	{
		
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => 'customer/login', 'label' => 'Authentication'),
			array('url' => '#', 'label' => 'Forgot Password')
		)); 
		
		$this->load->view('common/header');
		$this->load->view('forgot_password', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js',isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);		
	}
	
	function account_footer_nav()
	{
		return $this->load->view('account_footer',isset($data) ? $data : NULL, true);	
	}
	
	function logout()
	{
		modules::run('auth/logout_customer');
		modules::run('cart/destroy');
		redirect(base_url().'customer/login');
	}
	
	function create($data)
	{
		return $this->customer_model->insert_customer($data);	
	}
	
	function update($user_id,$data)
	{
		return $this->customer_model->update_customer($user_id,$data);	
	}
	
	function get_customer($user_id)
	{
		return $this->customer_model->get_customer($user_id);
	}
	
	function get_username($user_id)
	{
		$user = $this->user_model->get_user($user_id);	
		return $user['username'];	
	}
	
	function get_customer_name()
	{
		$customer = $this->get_customer($this->user_id);
		if(isset($customer['first_name']) && $customer['first_name']){
			return $customer['first_name'];	
		}else{
			return $this->get_username($this->user_id);	
		}
	}
}