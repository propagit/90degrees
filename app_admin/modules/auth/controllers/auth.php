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

	function is_admin_logged_in()
	{
		return $this->session->userdata('is_admin_logged_in');
	}

	function validate_user()
	{
		$status = 'success';
		$input = $this->input->post();
		$admin = $this->auth_model->validate_user($input);
		if(count($admin)){
			$this->generate_session_vars($admin);
		}else{
			$status = 'failed';
		}
		echo $status;
	}

	function generate_session_vars($user)
	{
		if(!$user){
			return false;
		}
		$this->session->set_userdata('user_id',$user['user_id']);
		$this->session->set_userdata('is_admin_logged_in',TRUE);
		return true;
	}

	function logout_user()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('is_admin_logged_in');
		redirect('admin');
	}



}
