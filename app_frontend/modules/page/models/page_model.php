<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {
	
	function get_pages() {
		$query = $this->db->get('cms_pages');
		return $query->result_array();
	}
	
	function get_page($page_id) {
		$this->db->where('page_id', $page_id);
		$query = $this->db->get('cms_pages');
		return $query->first_row('array');
	}
	
	function get_page_by_slug($slug)
	{
		$this->db->where('uri_path', $slug);
		$this->db->where('status >',-1);
		$query = $this->db->get('cms_pages');
		return $query->first_row('array');	
	}
		
	function get_menu($menu_id) {
		$this->db->where('menu_id', $menu_id);
		$query = $this->db->get('cms_menus');
		return $query->first_row('array');
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
	
	function get_menu_by_subject($subject){
		$this->db->where	('subject',$subject);
		$this->db->where	('status !=',-1);
		$this->db->order_by('url_order','asc');
		$query = $this->db->get('cms_menu_urls');
		return $query->result_array();
	}
	
}