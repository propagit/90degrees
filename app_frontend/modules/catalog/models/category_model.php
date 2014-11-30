<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
	
	function get_category($category_id) {
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('catalog_categories');
		return $query->first_row('array');
	}
	
	function get_parent_categories()
	{
		$sql = "SELECT * FROM catalog_categories cc
				WHERE cc.parent_id = 0
				ORDER BY cc.category_order ASC";
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function is_root_category($category_slug)
	{
		$cat = $this->db->where('uri_path',$category_slug)
					    ->where('parent_id',0)
					    ->get('catalog_categories')
					    ->result_array();
					   
		if($cat){
			return $cat;	
		}
		
		return false;

	}
	
	function get_category_id($category_uri)
	{
		$this->db->where('uri_path', $category_uri);
		$query = $this->db->get('catalog_categories');
		$category = $query->first_row('array');
		if($category){
			return $category['category_id'];	
		}
		return false;
	}
	
	function get_category_by_slug($category_uri)
	{
		$this->db->where('uri_path', $category_uri);
		$query = $this->db->get('catalog_categories');
		return $query->first_row('array');	
	}
}