<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('customer_model');
	}
	
	function validate_customer($input)
	{
		$rules = array(
			array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
			array('field' => 'dob', 'label' => 'DOB', 'rules' => 'required'),
			array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'required'),
			array('field' => 'country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
			array('field' => 'suburb', 'label' => 'Suburb', 'rules' => 'required'),
			array('field' => 'postcode', 'label' => 'Postcode', 'rules' => 'required'),
			array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function add()
	{
		$input = $this->input->post();
		$errors = $this->validate_customer($input);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}

		# Add User
		
		$user_data = array(
			'level' => 1,
			'username' => $input['username'],
			'password' => md5(SALT.$input['password']),
			'status' => 1
		);
				
		$user_id = $this->user_model->insert_user($user_data);
		
		if(is_int($user_id)){
			
			# Add customer
			$customer_data = array(
				'user_id' => $user_id,
				'first_name' => $input['first_name'],
				'last_name' => $input['last_name'],
				'dob' => date('Y-m-d',strtotime($input['dob'])),
				'email' => $input['email'],
				'phone' => $input['phone'],
				'mobile' => $input['mobile'],
				'address1' => $input['address1'],
				'address2' => $input['address2'],
				'suburb' => $input['suburb'],
				'postcode' => $input['postcode'],
				'state' => $input['state'],
				'country' => $input['country'],
				'billing_address1' => $input['address1'],
				'billing_address2' => $input['address2'],
				'billing_suburb' => $input['suburb'],
				'billing_postcode' => $input['postcode'],
				'billing_state' => $input['state'],
				'billing_country' => $input['country'],
				'additional_info' => $input['additional_info']
			);	
			
			$customer_id = $this->customer_model->insert_customer($customer_data);
			
			if (is_int($customer_id))
			{
				# Customer created successfully
				echo json_encode(array(
					'ok' => true,
					'success' => true,
					'action' => $user_id
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
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $user_id
			));
				
		}

	}
	
	function update_basic()
	{
		$input = $this->input->post();
		$errors = $this->validate_customer($input);
		
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$user_id = $input['user_id'];
		if(isset($input['password'])){
			$this->user_model->update_user($user_id,array('password' => md5(SALT.$input['password'])));
		}
		
		$customer_data = array(
				'first_name' => $input['first_name'],
				'last_name' => $input['last_name'],
				'dob' => date('Y-m-d',strtotime($input['dob'])),
				'email' => $input['email'],
				'phone' => $input['phone'],
				'mobile' => $input['mobile'],
				'address1' => $input['address1'],
				'address2' => $input['address2'],
				'suburb' => $input['suburb'],
				'postcode' => $input['postcode'],
				'state' => $input['state'],
				'country' => $input['country'],
				'additional_info' => $input['additional_info']
		);
		
		$updated = $this->customer_model->update_customer($user_id, $customer_data);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['user_id']
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}	
	}
	
	function update_billing()
	{
		$input = $this->input->post();		
		$customer_data = array(
				'billing_address1' => $input['billing_address1'],
				'billing_address2' => $input['billing_address2'],
				'billing_suburb' => $input['billing_suburb'],
				'billing_postcode' => $input['billing_postcode'],
				'billing_state' => $input['billing_state'],
				'billing_country' => $input['billing_country']
			);	
		$user_id = $input['user_id'];
		$updated = $this->customer_model->update_customer($user_id, $customer_data);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['user_id']
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}	
	}
	
	
	function change_status()
	{
		$user_id = $this->input->post('user_id');
		$trashed = $this->input->post('trashed');
		
		# If not trashed
		if(!$trashed){
			$user = $this->user_model->get_user($user_id);
			$new_status = $user['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		$updated = $this->user_model->update_user($user_id,array('status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $user_id
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}
	}
}