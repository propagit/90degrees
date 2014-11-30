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
		
		$sql = "SELECT 	u.user_id as u_user_id,
				u.username,
				u.created_on as u_created_on, 
				u.status, 
				c.* 
				FROM users u
					LEFT JOIN user_customers c ON u.user_id = c.user_id
						AND u.level = 1 
				WHERE u.status > -1";
		return $this->db->query($sql)->result_array();

	}
	
	function get_customer_custom_fields($user_id)
	{
		$sql = "SELECT c.label, u.value FROM user_custom_fields u
					LEFT JOIN custom_fields c ON c.field_id = u.field_id
				WHERE u.user_id = $user_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_customer_by_user_id($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_customers');
		return $query->first_row('array');
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
}