<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Banner_model.php)';
		}
		else
		{
			return $msg;
		}
	}	
	
	function get_banners(){
		$this->db->where('status > ', 0);
		$query = $this->db->get('cms_banners');
		return $query->result_array();
	}

	function get_banner($banner_id) {
		$this->db->where('banner_id', $banner_id);
		$this->db->where('status >= ', 0);
		$query = $this->db->get('cms_banners');
		return $query->first_row('array');
	}
	
	function get_first_image($banner_id) {
		$sql = "SELECT u.* FROM upload_objects b
					LEFT JOIN uploads u ON u.upload_id = b.upload_id
				WHERE object_name = 'banner_image'
				AND b.status > " . TRASHED . "
				AND b.object_id = $banner_id";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}

}