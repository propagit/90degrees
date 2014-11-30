<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
	
	
	function error_message($function, $msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' - Category_model.php - ' . $function . '()';
		}
		else
		{
			return $msg;
		}
	}
	
	function prepare_category_data($data) {
		if($data['uri_path'] == '') {
			$data['uri_path'] = url_title($data['name']);
		}
		return $data;
	}
	
	function insert_category($data) {
		$data = $this->prepare_category_data($data);
		if($this->db->insert('catalog_categories', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('insert_category', 'There was error while adding new category. Please contact webmaster');
		}
	}
	
	function update_category($category_id, $data)
	{
		$this->db->where('category_id', $category_id);
		if ($this->db->update('catalog_categories', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_category', 'There was error while updating this category. Please contact webmaster');
		}
	}
	
	function get_categories($parent_id) {
		$this->db->where('parent_id', $parent_id);
		$query = $this->db->get('catalog_categories');
		return $query->result_array();
	}
	
	function get_category($category_id) {
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('catalog_categories');
		return $query->first_row('array');
	}
	
	
}