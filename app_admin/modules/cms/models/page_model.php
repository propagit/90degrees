<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Page_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function prepare_page_data($data) {
		if($data['uri_path'] == '') {
			if(isset($data['title'])){
				$data['uri_path'] = url_title($data['title']);
			}
		}
		$data['updated_on'] = date('Y-m-d H:i:s');
		return $data;
	}
	
	function update_page($page_id, $data) {
		$data = $this->prepare_page_data($data);
		$this->db->where('page_id', $page_id);
		if ($this->db->update('cms_pages', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this page. Please contact webmaster');
		}
	}
	
	function update_status($page_id,$status){
		$this->db->where('page_id', $page_id);
		if ($this->db->update('cms_pages', array('status' => $status)))
		{
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this page. Please contact webmaster');
		}	
	}
	
	function insert_page($data) {
		$data = $this->prepare_page_data($data);		
		if($this->db->insert('cms_pages', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new page. Please contact webmaster');
		}
	}	
	
	function get_pages() {
		$this->db->where('status >=',0);
		$query = $this->db->get('cms_pages');
		return $query->result_array();
	}
	
	function get_page($page_id) {
		$this->db->where('page_id', $page_id);
		$this->db->where('status >= ', 0);
		$query = $this->db->get('cms_pages');
		return $query->first_row('array');
	}
	
	function get_page_by_uri($uri_path)
	{
		$this->db->where('uri_path', $uri_path);
		$this->db->where('status >',-1);
		$query = $this->db->get('cms_pages');
		return $query->first_row('array');	
	}
}