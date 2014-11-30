<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('customer_model');
	}
	
	function index()
	{
		$data['customers'] = $this->customer_model->get_customers();
		$this->load->view('customer/table_view', isset($data) ? $data : NULL);
	}
	
	function add()
	{
		$this->load->view('customer/form_view', isset($data) ? $data : NULL);
	}
	
	function update($user_id, $is_new = false)
	{
		$data['is_new'] = $is_new;
		$data['customer'] = $this->customer_model->get_customer_by_user_id($user_id);
		$data['custom_fields'] = $this->customer_model->get_customer_custom_fields($user_id);
		$data['user'] = $this->user_model->get_user($user_id);
 		$this->load->view('customer/form_view', isset($data) ? $data : NULL);	
	}

}