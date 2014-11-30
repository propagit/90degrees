<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}
	
	function index()
	{
		$data['products'] = $this->product_model->get_products();
		$this->load->view('product/table_view', isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		$data['tab'] = 'basic';
		$this->load->view('product/form_view', isset($data) ? $data : NULL);
	}
	
	function edit($product_id, $tab = 'basic')
	{
		$product = $this->product_model->get_product($product_id);
		if (!$product)
		{
			show_404();
		}
		$data['product'] = $product;
		$data['tab'] = $tab;
		$this->load->view('product/form_view', isset($data) ? $data : NULL);
	}
	
	function categories($product_id)
	{
		$category_ids = $this->product_model->get_categories($product_id);
		$data['tree'] = $this->tree_category($category_ids);
		$data['product_id'] = $product_id;
		$this->load->view('product/categories_view', isset($data) ? $data : NULL);
	}
	
	function tree_category($category_ids)
	{
		$tree = '<ul>';
		$categories = modules::run('catalog/category/get_tree_category');
		foreach($categories as $category) {
			$tree .= $this->display_children_category($category, $category_ids);
		}
		$tree .= '</ul>';
		return $tree;
	}
	
	function display_children_category($category, $category_ids)
	{
		$output = '<li>';
		if (isset($category['children']))
		{
			$output .= '<span><i class="fa fa-lg fa-has-sub fa-minus-circle"></i> <a>';
			$output .= $category['name'] . '</a></span>';
			$output .= '<ul>';
			foreach($category['children'] as $child)
			{
				$output .= $this->display_children_category($child, $category_ids);
			}
			$output .= '</ul>';
		}
		else
		{
			$output .= '<span><label class="checkbox inline-block"><input type="checkbox" name="category_id[]" value="' . $category['category_id'] . '"' . ((in_array($category['category_id'], $category_ids)) ? ' checked' : '') . '>
						<i></i>' . $category['name'] . '</label></span>';
		}
		$output .= '</li>';
		return $output;
	}
	
	function field_select($field_name, $product_id)
	{
		$data['products'] = $this->product_model->get_products();
		$data['field_name'] = $field_name;
		$data['product_id'] = $product_id;
		$this->load->view('product/field_select', isset($data) ? $data : NULL);
	}
	
	function id($product_id)
	{
		return $this->product_model->get_product($product_id);
	}
	
	function get_product_categories($product_id)
	{
		$product_cats = array();
		$categories = $this->product_model->get_product_categories($product_id);	
		if($categories){
			foreach($categories as $cat){
				array_push($product_cats, $cat['name']);	
			}
		}
		echo count($product_cats) ? implode(', ',$product_cats) : '-';
	}
}