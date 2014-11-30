<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (User_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function insert_user($data) {	
		if($this->db->insert('users', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new user. Please contact webmaster');
		}
	}	
	
	function get_user($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	
	# Username is also the email
	function get_user_by_username($username)
	{
		$this->db->where('username',$username);
		$this->db->where('status >',-1);
		$query = $this->db->get('users');	
		return $query->row_array();
	}
	
	function update($user_id,$data)
	{
		$this->db->where('user_id',$user_id);
		if($this->db->update('users', $data))
		{
			return $this->db->affected_rows();
		}
		else
		{
			return $this->error_message('There was error while updating user. Please contact webmaster');
		}	
	}
}