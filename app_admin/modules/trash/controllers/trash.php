<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trash extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('trash_model');
	}
	
	function index()
	{
		$data['pages'] = $this->trash_model->get_list('cms_pages');
		$data['urls'] = $this->trash_model->get_list('cms_menu_urls');
		$data['products'] = $this->trash_model->get_list('catalog_products');
		$data['users'] = $this->trash_model->get_list('users');
		$data['banners'] = $this->trash_model->get_list('cms_banners');
		$data['tiles'] = $this->trash_model->get_list('cms_tiles');
		$data['promotions'] = $this->trash_model->get_list('promotions');
		$this->load->view('table_view', isset($data) ? $data : NULL);
	}
	
}