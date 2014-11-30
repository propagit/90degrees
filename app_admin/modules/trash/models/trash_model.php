<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trash_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Trash_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function get_list($table)
	{
		$sql = "SELECT * FROM $table";
		if ($table == 'users')
		{
			$sql .= " LEFT JOIN user_customers ON user_customers.user_id = $table.user_id";
		}
		$sql .= " WHERE status = " . TRASHED;
					
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function delete_list($table)
	{
		$this->db->where('status', TRASHED);
		return $this->db->delete($table);
	}
	
	
	function restore($table, $param) {
		foreach($param as $key => $value)
		{
			$this->db->where($key, $value);
		}
		if ($this->db->update($table, array('status' => 0)))
		{
			return true;
		}
		else
		{
			return $this->error_message("There was error while updating $table.");
		}
	}
	
}