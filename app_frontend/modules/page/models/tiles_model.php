<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiles_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Tiles_model.php)';
		}
		else
		{
			return $msg;
		}
	}	
	
	function get_tiles(){
		$this->db->where('status > ', 0);
		$query = $this->db->get('cms_tiles');
		return $query->result_array();
	}

	function get_banner($tile_id) {
		$this->db->where('tile_id', $tile_id);
		$this->db->where('status >= ', 0);
		$query = $this->db->get('cms_tiles');
		return $query->first_row('array');
	}
	
	function get_first_image($tile_id) {
		$sql = "SELECT u.* FROM upload_objects t
					LEFT JOIN uploads u ON u.upload_id = t.upload_id
				WHERE object_name = 'tile_image'
				AND t.status > " . TRASHED . "
				AND t.object_id = $tile_id";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	
	function get_feature_image($feature_image_id) {
		$sql = "SELECT u.* FROM upload_objects t
					LEFT JOIN uploads u ON u.upload_id = t.upload_id
				WHERE object_name = 'tile_image'
				AND t.status > " . TRASHED . "
				AND u.upload_id = $feature_image_id";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	
	function get_tiles_by_slug($slug){
		$tile = $this->db->where('tile_uri',$slug)
						->where('status',ACTIVE)	
						->get('cms_tiles')
						->first_row('array');
		return $tile;
	}
	
	function get_images($tile_id) {
		$sql = "SELECT u.* FROM upload_objects b
					LEFT JOIN uploads u ON u.upload_id = b.upload_id
				WHERE object_name = 'tile_image'
				AND b.status > " . TRASHED . "
				AND b.object_id = $tile_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}