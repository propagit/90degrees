<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {


	function validate_user($data) {
		$this->db->where('username',$data['username']);
		$this->db->where('password',md5(SALT.$data['password']));
		$this->db->where('level','9');
		$this->db->where('status',1);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){ 
			return $query->first_row('array');
		}
		return false;
	}
	
}