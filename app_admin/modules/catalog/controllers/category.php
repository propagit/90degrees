<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}
	
	function index()
	{
		$this->load->view('category_view');
	}
	
	function create($parent_id)
	{
		$data['parent_id'] = $parent_id;
		$this->load->view('category_view', isset($data) ? $data : NULL);
	}
	
	function edit($category_id)
	{
		$category = $this->category_model->get_category($category_id);
		if (!$category) {
			# Show page error
			return;
		}
		$data['category'] = $category;
		$data['parent_id'] = $category['parent_id'];
		$this->load->view('category_view', isset($data) ? $data : NULL);
	}
	
	/*
	*	@desc: This function displays the tree view of all categories and sub categories
	*	@parameter: $value is the category_id of the current editted category
	*	@return: (void)
	*/
	function tree($value)
	{
		$output = '';
		$categories = $this->category_model->get_categories(0);
		foreach($categories as $category)
		{
			$output .= $this->get_category_tree($category, $value);
		}
		echo $output;
	}
	
	/*
	*	@desc: Recursive function for display the tree view of the category
	*	@parameter: 
	*		+ $category: object of category
	*		+ $value: $value is the category_id of the current editted category
	*	@return: (html)
	*/
	function get_category_tree($category, $value = 0)
	{
		$output = '<li>';
		$sub_categories = $this->category_model->get_categories($category['category_id']);
		if (count($sub_categories) > 0)
		{
			$output .= '<span><i class="fa fa-lg fa-has-sub fa-minus-circle"></i> ';
			$output .= ' <a href="#' . ajax_url() . 'category/edit/' . $category['category_id'] . '">' . $category['name'] . '</a></span>';
			$output .= '<ul>';
			foreach($sub_categories as $sub_category)
			{
				$output .= $this->get_category_tree($sub_category);
			}
			$output .= '</ul>';
		}
		else
		{
			$output .= '<span><i class="icon-leaf"></i> <a href="#' . ajax_url() . 'category/edit/' . $category['category_id'] . '">' . $category['name'] . '</a></span>';
		}
		$output .= '</li>';
		return $output;
	}
	
	function field_select($field_name, $category_id)
	{
		$data['field_name'] = $field_name;
		$categories = $this->category_model->get_categories(0);
		$options = '';
		foreach($categories as $category)
		{
			$options .= $this->get_field_category_tree($category, 0, $category_id);
		}
		$data['options'] = $options;
		$this->load->view('category/field_select', isset($data) ? $data : NULL);
	}
	
	
	function field_category($value)
	{
		$output = '';
		$categories = $this->category_model->get_categories(0);
		foreach($categories as $category)
		{
			$output .= $this->get_field_category_tree($category, 1, $value);
		}
		echo $output;
	}
	
	function get_field_category_tree($category, $level, $value)
	{
		$output = '<option value="' . $category['category_id'] . '"' . (($category['category_id'] == $value) ? ' selected' : '') . '>';
		for($i=0; $i < $level; $i++)
		{
			$output .= '|--';
		}
		$output .= ' ' . $category['name'] . '</option>';
		$sub_categories = $this->category_model->get_categories($category['category_id']);
		if (count($sub_categories) > 0) 
		{
			$level++;
			foreach($sub_categories as $sub_category)
			{
				$output .= $this->get_field_category_tree($sub_category, $level, $value);
			}
		}
		return $output;	
	}
	
	/**
	*	@desc: get the tree data structure of categories
	*	@return: (array) of categories with recursively sub directories
	*/
	function get_tree_category()
	{
		$tree = array();
		$categories = $this->category_model->get_categories(0); # Get all root categories (no parent)
		foreach($categories as $category)
		{
			$tree[] = $this->get_child_category($category);
		}
		return $tree;
	}	
	
	/**
	*	@desc: recursive function to get the array of categories with sub categories
	*	@param: $category: object of category
	*	@return: $category: the object of category itself include children
	*/
	function get_child_category($category)
	{
		$sub_categories = $this->category_model->get_categories($category['category_id']);
		if (count($sub_categories) > 0)
		{
			$children = array();
			foreach($sub_categories as $sub_category)
			{
				$children[] = $this->get_child_category($sub_category);
			}
			$category['children'] = $children;
		}
		return $category;
	}
	
	function id($category_id)
	{
		return $this->category_model->get_category($category_id);
	}
}