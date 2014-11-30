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
		
	function prepare_data($data) {
		if($data['banner_uri']) {
			$url = $data['banner_uri'];
			if(stripos($url, "http") === false){
				$data['banner_uri'] = "http://".$url;
			}
		}
		
		return $data;
	}
	
	function insert_banner($data) {
		$data = $this->prepare_data($data);
		if($this->db->insert('cms_banners', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('insert_banner', 'There was error while adding new banner.');
		}
	}
	
	function update_banner($banner_id, $data)
	{
		$data = $this->prepare_data($data);
		$this->db->where('banner_id', $banner_id);
		if ($this->db->update('cms_banners', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_banner', 'There was error while updating this banner.');
		}
	}
	
	function get_banners() {
		$this->db->where('status >',-1);
		$query = $this->db->get('cms_banners');
		return $query->result_array();
	}

	function get_banner($banner_id) {
		$this->db->where('banner_id', $banner_id);
		$this->db->where('status >= ', 0);
		$query = $this->db->get('cms_banners');
		return $query->first_row('array');
	}
	
	function add_image($banner_id, $upload_id) {
		$data = array(
			'upload_id' => $upload_id,
			'object_name' => 'banner_image',
			'object_id' => $banner_id
		);
		if ($this->db->insert('upload_objects', $data)) 
		{
			return $this->db->insert_id();
		} 
		else  
		{
			return $this->error_message('add_image','There was error while adding this banner image.');
		}
	}
	
	function get_images($banner_id) {
		$sql = "SELECT u.* FROM upload_objects b
					LEFT JOIN uploads u ON u.upload_id = b.upload_id
				WHERE object_name = 'banner_image'
				AND b.status > " . TRASHED . "
				AND b.object_id = $banner_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function trash_image($upload_id) {
		$this->db->where('upload_id', $upload_id);
		$this->db->where('object_name', 'banner_image');
		if ($this->db->update('upload_objects', array('status' => TRASHED)))
		{
			return true;
		}
		else
		{
			return $this->error_message('trash_image', 'There was error while trashing this banner image.');
		}
	}

}