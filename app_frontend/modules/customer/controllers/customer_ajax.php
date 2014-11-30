<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if(modules::run('auth/is_user_logged_in')){
			$this->user_id = $this->session->userdata('user_id');		
		}
		$this->load->model('customer_model');
		$this->load->model('user_model');
		$this->load->model('subscriber_model');
	}
	
	function validate_new_account($input)
	{
		$rules = array(
			array('field' => 'email', 'label' => 'Email', 'rules' => 'required|email|unique[users.username.status >.-1]'),
			array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
		);
		return modules::run('common/validate_input', $input, $rules);	
	}
	
	function create_account()
	{
		$input = $this->input->post();
		$errors = $this->validate_new_account($input);
		# If cart has content redirect to checkout page else redirect to account page
		$redirect = modules::run('cart/get_contents') ? 'cart' : 'customer/account';
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		  
		  
		$user_data = array(
			'level' => 1,
			'username' => $input['email'],
			'password' => md5(SALT.$input['password']),
			'status' => 1
		);
		  
		$user_id = $this->user_model->insert_user($user_data);
		  
		if(is_int($user_id)){
			# new account created 
			# login this user and redirect to checkout page
			$user['user_id'] = $user_id;	
			if(modules::run('auth/generate_session_vars',$user)){
				echo json_encode(array(
					'ok' => true,
					'success' => true,
					'action' => $redirect
				));
			}else{
				echo json_encode(array(
					'ok' => false,
					'success' => false,
					'msg' => ''
				));
			}
		}
	}
	
	
	function login()
	{
		$data = $this->input->post();
		# If cart has content redirect to checkout page else redirect to account page
		$redirect = modules::run('cart/get_contents') ? 'cart' : 'customer/account';
		$customer = modules::run('auth/validate_user',$data);

		if(count($customer))
		{
			if(modules::run('auth/generate_session_vars',$customer)){
				echo json_encode(array(
					'ok' => true,
					'success' => true,
					'action' => $redirect
				));
			}else{
				echo json_encode(array(
					'ok' => false,
					'success' => false,
					'msg' => ''
				));
			}
			
		}
		else
		{
			echo json_encode(array(
					'ok' => false,
					'success' => false,
					'msg' => ''
				));
		}				

	}
	
	function update_personal()
	{
		$input = $this->input->post();
		$cur_email = '';
		$cur_customer = $this->customer_model->get_customer($this->user_id);
		# if the customer only exist as a user
		# check user table
		if(!$cur_customer){
			$user = $this->user_model->get_user($this->user_id);
			$cur_email = $user['username'];
		}else{
			$cur_email = $cur_customer['email'];	
		}
		
		$rules = array(
			array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'required'),
			array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),
			($cur_email != $input['email']) ? array('field' => 'email', 'label' => 'Email', 'rules' => 'required|email|unique[user_customers.email]') : '', 	
			array('field' => 'country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
			array('field' => 'suburb', 'label' => 'Suburb', 'rules' => 'required'),
			array('field' => 'postcode', 'label' => 'Postcode', 'rules' => 'required'),
			array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'required')
		);
		
		# Validat user data
		$errors =  modules::run('common/validate_input', $input, $rules);
		
		# If data invalid
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		# If email changed then change username as well
		if($cur_email != $input['email']){
			$this->user_model->update($this->user_id,array('username' => $input['email']));
		}
		
		# Check if password field has been field
		if(isset($input['password']) && $input['password']){
			$this->user_model->update($this->user_id,array('password' => md5(SALT.$input['password'])));	
		}
		
		# If data is valid
		$customer_data = array(
				'user_id' => $this->user_id,
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
		
		# Sometimes the customer does not exist at this point if they just created their account and left.
		# if that is the case create new customer
		
		if(!$cur_customer){
			$updating = $this->customer_model->insert_customer($customer_data);	
		}else{
			# Update personal info
			$updating = $this->customer_model->update_customer($this->user_id ,$customer_data);	
		}

		if ($updating)
		{
			# Customer updated successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => true
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => 'Update failed'
			));
		}
		
	}
	
	function update_billing()
	{
		$input = $this->input->post();

		
		$rules = array(	
			array('field' => 'country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
			array('field' => 'suburb', 'label' => 'Suburb', 'rules' => 'required'),
			array('field' => 'postcode', 'label' => 'Postcode', 'rules' => 'required'),
			array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'required')
		);
		
		# Validat user data
		$errors =  modules::run('common/validate_input', $input, $rules);
		
		# If data invalid
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}

		# If data is valid
		$customer_data = array(
				'billing_address1' => $input['address1'],
				'billing_address2' => $input['address2'],
				'billing_suburb' => $input['suburb'],
				'billing_postcode' => $input['postcode'],
				'billing_state' => $input['state'],
				'billing_country' => $input['country']
			);

				
		# Update personal info
		$updating = $this->customer_model->update_customer($this->user_id ,$customer_data);
		if ($updating)
		{
			# Customer created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => true
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => 'Update failed'
			));
		}
		
	}

	function subscribe()
	{
		$input = $this->input->post();
		$rules = array(	
			array('field' => 'email', 'label' => 'Email', 'rules' => 'required|email|unique[subscribers.email]')
		);
		
		# Validat user data
		$errors =  modules::run('common/validate_input', $input, $rules);
		
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		  
		  
		$subscriber = array(
			'email' => $input['email']
		);
		  
		$subscriber_id = $this->subscriber_model->insert_subscriber($subscriber);
		  
		if(is_int($subscriber_id)){
			# Customer created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $subscriber_id
			));
			
		}else{
			# System error
			echo json_encode(array(
				'ok' => false,
				'success' => false,
				'msg' => $subscriber_id
			));
		}
	}
	
	function reset_password()
	{
		$input = $this->input->post();
		# Check if username / email exist
		$user = $this->user_model->get_user_by_username($input['email']); 
		if(!$user){
			echo json_encode(array(
				'ok' => false,
				'msg' => 'This email does not exist in our system'
			));
			return;
		}
		
		$new_pass = modules::run('common/random_string');
		$this->user_model->update($user['user_id'],array('password' => md5(SALT.$new_pass)));
		
		$email = $user['username'];
		$data['new_password'] = $new_pass;
		$data['email'] = $email;
		modules::run('email/send_password_reset',$data);
		
		echo json_encode(array(
				'ok' => true,
				'success' => true,
				'msg' => 'Your new password has been sent to ' . $email
			));
	}
}