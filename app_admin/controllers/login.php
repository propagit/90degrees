<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Login
 */

class Login extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->template->set_template('login');
		$this->template->render();
	}

	function validate_admin()
	{
		echo modules::run('auth/validate_user');
	}

	function logout()
	{
		echo modules::run('auth/logout_user');
	}

}

/* End of file dispatcher.php */
/* Location: ./application/controllers/dispatcher.php */
