<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiles_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (tile_model.php)';
		}
		else
		{
			return $msg;
		}
	}	
	
	function prepare_data($data) {
		if($data['tile_uri'] == '') {
			if(isset($data['name'])){
				$data['tile_uri'] = url_title(strtolower($data['name']));
			}
		}
		$data['updated_on'] = date('Y-m-d H:i:s');
		return $data;
	}
	
	
	function insert_tile($data) {
		$data = $this->prepare_data($data);
		if($this->db->insert('cms_tiles', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('insert_tile', 'There was error while adding new tile.');
		}
	}
	
	function update_tile($tile_id, $data)
	{
		$data = $this->prepare_data($data);
		$this->db->where('tile_id', $tile_id);
		if ($this->db->update('cms_tiles', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_tile', 'There was error while updating this tile.');
		}
	}
	
	function get_tiles() {
		$this->db->where('status >',-1)
				 ->order_by('tile_order','asc');
		$query = $this->db->get('cms_tiles');
		return $query->result_array();
	}

	function get_tile($tile_id) {
		$this->db->where('tile_id', $tile_id);
		$this->db->where('status >= ', 0);
		$query = $this->db->get('cms_tiles');
		return $query->first_row('array');
	}
	
	function add_image($tile_id, $upload_id) {
		$data = array(
			'upload_id' => $upload_id,
			'object_name' => 'tile_image',
			'object_id' => $tile_id
		);
		if ($this->db->insert('upload_objects', $data)) 
		{
			return $this->db->insert_id();
		} 
		else  
		{
			return $this->error_message('add_image','There was error while adding this tile image.');
		}
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
	
	function trash_image($upload_id) {
		$this->db->where('upload_id', $upload_id);
		$this->db->where('object_name', 'tile_image');
		if ($this->db->update('upload_objects', array('status' => TRASHED)))
		{
			return true;
		}
		else
		{
			return $this->error_message('trash_image', 'There was error while trashing this tile image.');
		}
	}
	
	function set_feature_image($tile_id,$upload_id){
		$this->db->where('tile_id', $tile_id);
		if ($this->db->update('cms_tiles', array('feature_image_id' => $upload_id)))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_tile', 'There was error while updating this tile.');
		}
	}
	
	function order_tiles($params)
	{
		$tile_id      = $params['id'];
		$fromPosition = is_array($params['fromPosition']) ? $params['fromPosition'][0] : $params['fromPosition'];
		$toPosition   = $params['toPosition'];
		$direction    = $params['direction'];
		$aPosition    = ($direction === "back") ? $toPosition+1 : $toPosition-1;
		
		$sql = "UPDATE cms_tiles 
				SET tile_order = 0 
				WHERE tile_order = " . $toPosition ;
		
		$this->db->query($sql);
		
		$sql = "UPDATE cms_tiles 
				SET tile_order = $toPosition 
				WHERE tile_id = " . $tile_id;
		 
		$this->db->query($sql);
	
		if($direction === "back") {
			$sql = "UPDATE cms_tiles 
					SET tile_order = tile_order + 1 
						WHERE ( $toPosition <= tile_order 
							AND tile_order <= $fromPosition) 
						AND tile_id != $tile_id and tile_order != 0 
						ORDER BY tile_order DESC";   
			$this->db->query($sql);                  
		} // backward direction
		  
		if($direction === "forward") {    
			$sql = "UPDATE cms_tiles 
					SET tile_order = tile_order - 1 
						WHERE ($fromPosition <= slideshow_ordem 
							AND tile_order <= $toPosition) 
						AND tile_id != $tile_id and tile_order != 0 
						ORDER BY tile_order ASC"; 
			$this->db->query($sql);                    
		} // Forward Direction
		 
					 
		$sql = "UPDATE cms_tiles 
				SET tile_order = $aPosition 
					WHERE tile_order = 0";
		$this->db->query($sql);  
	}

}