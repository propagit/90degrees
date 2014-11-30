<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Dispatcher
 * Description: control main flow of the app
 * @author: namnd86@gmail.com
 */

class Dispatcher extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if(!modules::run('auth/is_admin_logged_in')){
			redirect('admin/login');
		}
	}
	
	function index()
	{
		$this->template->set_template('admin');
		$this->template->render();
	}
	
	
}

/* End of file dispatcher.php */
/* Location: ./application/controllers/dispatcher.php */