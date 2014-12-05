<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	/*function index($controller, $slug = '',$page_no = '', $sort_by = "")
	{
		echo modules::run('catalog/' . $controller . '/index', $slug, $page_no, $sort_by);
	}*/
	function index($controller, $slug = '')
	{
		echo modules::run('catalog/' . $controller . '/index', $slug);
	}
	
}