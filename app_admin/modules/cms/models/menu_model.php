<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Menu_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function insert_menu($data) {
		if($this->db->insert('cms_menus', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new menu.');
		}
	}
	
	function get_menus() {
		$query = $this->db->get('cms_menus');
		return $query->result_array();
	}
	
	function get_menu($menu_id) {
		$this->db->where('menu_id', $menu_id);
		$query = $this->db->get('cms_menus');
		return $query->first_row('array');
	}
	
	function update_menu($menu_id, $data) {
		$this->db->where('menu_id', $menu_id);
		if ($this->db->update('cms_menus', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this menu.');
		}
	}
	
	function get_url($url_id) {
		$this->db->where('url_id', $url_id);
		$this->db->where('status > ', TRASHED);
		$query = $this->db->get('cms_menu_urls');
		return $query->first_row('array');
	}
	
	function insert_url($data) {
		if ($this->db->insert('cms_menu_urls', $data)) {
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding url to this menu.');
		}
	}
	
	function get_urls($menu_id) {
		$this->db->where('parent_id', 0);
		$this->db->where('menu_id', $menu_id);
		$this->db->where('status > ', TRASHED);
		$this->db->order_by('url_order', 'asc');
		$query = $this->db->get('cms_menu_urls');
		return $query->result_array();
	}
	
	function get_child_urls($parent_id) {
		$this->db->where('parent_id', $parent_id);
		$this->db->where('status > ', TRASHED);
		$this->db->order_by('url_order', 'asc');
		$query = $this->db->get('cms_menu_urls');
		return $query->result_array();
	}
	
	function update_url($url_id, $data)
	{
		$this->db->where('url_id', $url_id);
		if ($this->db->update('cms_menu_urls', $data)) {
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this url.');
		}
	}
}