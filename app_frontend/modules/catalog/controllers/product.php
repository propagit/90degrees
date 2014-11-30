<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('category_model');
	}
	
	function index($slug = '')
	{
		$product = $this->product_model->get_product_by_slug($slug);
		if (!$product)
		{
			show_404();
		}
		$data['images'] = $this->product_model->get_images($product['product_id']);
		
		$data['title'] = $product['name'];
		$data['product'] = $product;
		
		$data['add_css'] = $this->load->view('catalog/css', isset($data) ? $data : NULL, true);
		$this->load->view('common/header', isset($data) ? $data : NULL);
		
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => base_url(), 'label' => 'Category Name'),
			array('url' => '#', 'label' => $product['name'])
		)); 
		$this->load->view('catalog/details', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('catalog/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	

	function new_products()
	{
		return $this->product_model->get_products();
	}
	
	function image($product_id)
	{
		$images = $this->product_model->get_images($product_id);
		if (count($images) > 0) {
			return $images[0]['full_path'];
		}
	}
	
	function category($category = "")
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
		$this->load->view('product/categories', isset($data) ? $data : NULL);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	
	
	function get_product_image($product_id)
	{
		$image = $this->product_model->get_hero($product_id);	
		return $image['full_path'];
	}
	
	function id($product_id)
	{
		return $this->product_model->get_product($product_id);
	}
}