<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (common_model.php)';
		}
		else
		{
			return $msg;
		}
	}	
	
	function get_object($table_name,$primary_key_field,$primary_key_value) {
		$this->db->where($primary_key_field, $primary_key_value);
		$this->db->where('status >= ', 0);
		$query = $this->db->get($table_name);
		return $query->first_row('array');
	}
	
	
	function update_object($table_name,$primary_key_field,$primary_key_value,$data){
		$this->db->where($primary_key_field,$primary_key_value);
		if ($this->db->update($table_name, $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_' . $table_name, 'There was error while updating this record.');
		}	
	}

}