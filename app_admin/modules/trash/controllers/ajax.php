<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('trash_model');
	}
	
	function restore()
	{
		$input = $this->input->post();
		switch($input['type'])
		{
			case 'page':
					$this->trash_model->restore('cms_pages', array('page_id' => $input['id']));
				break;
			case 'product':
					$this->trash_model->restore('catalog_products', array('product_id' => $input['id']));
				break;
			case 'user':
					$this->trash_model->restore('users', array('user_id' => $input['id']));
				break;
			case 'banner':
					$this->trash_model->restore('cms_banners', array('banner_id' => $input['id']));
				break;
			case 'tile':
					$this->trash_model->restore('cms_tiles', array('tile_id' => $input['id']));
				break;
			case 'promotion':
					$this->trash_model->restore('promotions', array('promotion_id' => $input['id']));
				break;	
			
		}
	}
	
	function empty_trash()
	{
		$this->trash_model->delete_list('cms_pages');
		$this->trash_model->delete_list('catalog_products');
		$this->trash_model->delete_list('users');
		$this->trash_model->delete_list('promotions');
	}
}