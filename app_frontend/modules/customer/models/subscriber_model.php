<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriber_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Subscriber_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function insert_subscriber($data){
		if($this->db->insert('subscribers', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new Subscriber. Please contact webmaster');
		}
	}
	
}