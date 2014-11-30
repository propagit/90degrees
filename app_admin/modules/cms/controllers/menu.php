<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
	}
	
	function index($method='', $param='')
	{
		$data['menus'] = $this->menu_model->get_menus();
		$this->load->view('menu/main_view', isset($data) ? $data : NULL);
	}
	
	function edit($menu_id, $url_id = '')
	{
		$menu = $this->menu_model->get_menu($menu_id);
		if (!$menu) {
			# Show page error
			return;
		}
		$data['menu'] = $menu;
		$url = $this->menu_model->get_url($url_id);
		if ($url) {
			$data['url'] = $url;
		}
		$this->load->view('menu/edit_view', isset($data) ? $data : NULL);
	}
	
	function urls_tree($menu_id)
	{
		$tree = '<ol class="dd-list">';
		$urls = $this->get_tree_url($menu_id);
		foreach($urls as $url) {
			$tree .= $this->display_children_url($url);
		}
		$tree .= '</ol>';
		
		$data['tree'] = $tree;
		$this->load->view('menu/urls_tree_view', isset($data) ? $data : NULL);
	}
	
	/**
	*	@desc: recursive function to display url in the tree structure
	*/
	function display_children_url($url)
	{
		$url = $this->url_details($url);
		$output = '<li class="dd-item dd3-item" data-id="' . $url['url_id'] . '">
						<div class="dd-handle dd3-handle">
							<span>Drag</span>
						</div>
						<div class="dd3-content"><a onclick="edit_url(' . $url['url_id'] . ')">' . $url['label'] . '</a>';
		
		# New window icon
		if ($url['new_window']) 
		{
			$output .= '<em class="padding-5" rel="tooltip" title="" data-placement="left" data-original-title="Open in a new window"><i class="fa fa-external-link"></i></em>';
		}
		
		# Trash icon / function
		$output .= '<em class="pull-right padding-4" rel="tooltip" title="" data-placement="left" data-original-title="Delete"><a onclick="trash_url(' . $url['url_id'] . ')"><i class="pull-right fa fa-trash-o"></i></a></em>';
		
		$output .= '</div>';
		if (isset($url['children']))
		{
			$output .= '<ol class="dd-list">';
			foreach($url['children'] as $child)
			{
				$output .= $this->display_children_url($child);
			}
			$output .= '</ol>';
		}
		$output .= '</li>';
		return $output;
	}
	
	function url_details($url)
	{
		if ($url['url_type'] == 'system' && $url['label'] == '')
		{
			switch($url['subject']) {
				case 'page': 
						$page = modules::run('cms/page/id', $url['subject_id']);
						$url['label'] = $page['title'];
					break;
				case 'category': 
						$category = modules::run('catalog/category/id', $url['subject_id']);
						$url['label'] = $category['name'];
					break;
				case 'product': 
						$product = modules::run('catalog/product/id', $url['subject_id']);
						$url['label'] = $product['name'];
					break;
			}
		}
		return $url;
	}
	
	/**
	*	@desc: get the tree data structure of menu urls
	*	@return: (array) of url with recursively sub urls
	*/
	function get_tree_url($menu_id)
	{
		$tree = array();
		$urls = $this->menu_model->get_urls($menu_id); # Get all root urls (no parent) of the menu
		foreach($urls as $url)
		{
			$tree[] = $this->get_child_url($url);
		}
		return $tree;
	}	
	
	/**
	*	@desc: recursive function to get the array of menu url with sub urls
	*	@param: $url: object of url
	*	@return: $url: the object of url itself include children
	*/
	function get_child_url($url)
	{
		$sub_urls = $this->menu_model->get_child_urls($url['url_id']);
		if (count($sub_urls) > 0)
		{
			$children = array();
			foreach($sub_urls as $sub_url)
			{
				$children[] = $this->get_child_url($sub_url);
			}
			$url['children'] = $children;
		}
		return $url;
	} 
}