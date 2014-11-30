<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
	}
	
	function index($category = "")
	{
		$data['parent_categories'] = $this->category_model->get_parent_categories();	
		
		if($category){
			# get category info
			$category = $this->category_model->get_category_by_slug($category);
			if($category){
				$data['products'] = $this->product_model->get_products_by_category($category['category_id']);
			}else{
				show_404();
			}
				
		}else{
			show_404();	
		}
		
 		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
					array('url' => '#', 'label' => 'Category'),
					array('url' => '#', 'label' => isset($category['name']) ? $category['name'] : '') # this check is not needed but kept to ensure it does not break
				));
		
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('catalog/categories', isset($data) ? $data : NULL);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
		
	function id($category_id)
	{
		return $this->category_model->get_category($category_id);
	}
}