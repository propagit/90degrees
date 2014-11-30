<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}
	
}