<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Auth
 */

class Auth extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}


	function is_user_logged_in()
	{
		return $this->session->userdata('customer_loggedin');
	}

	function validate_user($data)
	{
		$customer = $this->auth_model->validate_user($data);
		if(count($customer)){
			return $customer;
		}else{
			return false;
		}
	}

	function generate_session_vars($user)
	{
		if(!$user){
			return false;
		}
		$this->session->set_userdata('user_id',$user['user_id']);
		$this->session->set_userdata('customer_loggedin',TRUE);
		return true;
	}

	function logout_customer()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('customer_loggedin');
		$this->session->unset_userdata('agreed_to_terms');
		#$this->session->sess_destroy();
	}

	function is_customer_logged_in($return = false)
	{
		if(!$this->session->userdata('customer_loggedin')){
			if($return){
				return false;
			}else{
				redirect('customer/sign_up');
			}
		}else{
			return true;
		}
	}


}
