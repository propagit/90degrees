<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Customer_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function insert_customer($data) {	
		if($this->db->insert('user_customers', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new Customer. Please contact webmaster');
		}
	}	
	
	function get_customers()
	{
		$query = $this->db->get('user_customers');
		return $query->result_array();
	}	
	
	function update_customer($user_id, $data) {
		$this->db->where('user_id', $user_id);
		if ($this->db->update('user_customers', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this customer. Please contact webmaster');
		}
	}
		
	function get_customer($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_customers');
		return $query->first_row('array');
	}
}