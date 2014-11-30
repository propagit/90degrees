<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_ajax extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('promotion_model');
	}
	
	function validate_delivery_address($input)
	{
		$rules = array(
			array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'required'),
			array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),
			array('field' => 'country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
			array('field' => 'suburb', 'label' => 'Suburb', 'rules' => 'required'),
			array('field' => 'postcode', 'label' => 'Postcode', 'rules' => 'required'),
			array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'required')
		);
		$required_custom_fields = modules::run('customfield/all', 1);
		if ($required_custom_fields)
		{
			foreach($required_custom_fields as $field)
			{
				$rules[] = array('field' => $field['field_id'], 'label' => $field['label'], 'rules' => 'required');
			}
		}
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function add_delivery_address()
	{
		$input = $this->input->post();
		$errors = $this->validate_delivery_address($input);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		# Add delivery address to session var for future reference
		$this->session->set_userdata('delivery_address',$input);
		
		# Check if this customer's profile exist, create new customer
		$user_id = $this->session->userdata('user_id');
		$action = 'cart/checkout/payment';
		
		if(!modules::run('customer/get_customer',$user_id)){
			# Create customer profile
			$new_customer = $input;
			$new_customer['user_id'] = $user_id;
			$new_customer['billing_address1'] = $input['address1'];
			$new_customer['billing_address2'] = $input['address2'];
			$new_customer['billing_suburb'] = $input['suburb'];
			$new_customer['billing_postcode'] = $input['postcode'];
			$new_customer['billing_state'] = $input['state'];
			$new_customer['billing_country'] = $input['country'];
			
			# since the customer table doesnot have custom field, unset this otherwise this will create a db error 
			unset($new_customer['1']);
			
			# The customer does not have order comments field so unset this
			unset($new_customer['order_comment']);
			
			$new_customer['email'] = modules::run('customer/get_username',$user_id);
			$customer_id = modules::run('customer/create',$new_customer);
			
			if (is_int($customer_id))
			{
				# Add custom fields
				modules::run('customfield/add_user_data', $user_id, $input);
				
				# Customer created successfully
				echo json_encode(array(
					'ok' => true,
					'success' => true,
					'action' => $action
				));
			}
			else
			{
				# System error
				echo json_encode(array(
					'ok' => true,
					'success' => false,
					'msg' => $user_id
				));
			}
		}else{
			modules::run('customfield/add_user_data', $user_id, $input);
			
			# Customer created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $action
			));	
		}
			
	}
	
	function validate_payment_form()
	{
		$input = $this->input->post();
		$rules = array(
			array('field' => 'card_number', 'label' => 'Card Number', 'rules' => 'required'),
			array('field' => 'card_name', 'label' => 'Cart Name', 'rules' => 'required'),
			array('field' => 'exp_month', 'label' => 'Expiry Month', 'rules' => 'required'),
			array('field' => 'exp_year', 'label' => 'Expiry Year', 'rules' => 'required'),
			array('field' => 'cvv', 'label' => 'Security Code', 'rules' => 'required')
		);
		
		# Validate input
		$errors = modules::run('common/validate_input', $input, $rules);
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		echo json_encode(array(
			'ok' => true,
			'success' => true,
			'action' => true
		));
		
	}
	
	function get_deliver_address()
	{
		$form_data = $this->input->post('form_data');
		echo modules::run('cart/checkout/get_deliver_address',$form_data);
	}
	
	function set_agreed_to_terms()
	{
		$this->session->set_userdata('agreed_to_terms',true);
		echo 'agreed to terms';	
	}
	
	function add_coupon()
	{
		$coupon = $this->input->post('coupon');
		$condition = $this->promotion_model->check_coupon($coupon);
		if ($condition) {
			$this->session->set_userdata('coupon', $this->input->post('coupon'));
			$this->session->set_userdata('condition_id', $condition['condition_id']);
			$this->set_discount_amount($coupon);
			echo json_encode(array(
				'success' => true
			));
			return;
		}
		echo json_encode(array(
				'success' => false
			));
	}
	
	function set_discount_amount($coupon)
	{
		$cart_total = modules::run('cart/get_total');
		# $coupon = $this->session->userdata('coupon');
		$condition = $this->promotion_model->check_coupon($coupon);
		if (!$condition) {
			return 0;
		}
		$promotion = $this->promotion_model->get_promotion($condition['promotion_id']);
		if (!$promotion) {
			return 0;
		}
	    $discount_value = $promotion['discount_value'];
        if ($promotion['discount_type'] == 'percentage')
        {
            $discount_value = $discount_value * $cart_total / 100;
        }
        $this->session->set_userdata('discount_amount',$discount_value);
	}
	
	
	
}