<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Order_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function insert_order($data) {	
		if($this->db->insert('orders', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding new Order. Please contact webmaster');
		}
	}	
	
	function insert_order_items($data){
		if($this->db->insert('order_items', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding Order items. Please contact webmaster');
		}
	}
	
	function get_order($order_id)
	{
		$this->db->where('order_id',$order_id);
		$this->db->where('deleted !=',1);
		$query = $this->db->get('orders');
		return $query->first_row('array');	
	}
	
	function get_user_orders($user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('deleted !=',1);
		$this->db->order_by('created_on','desc');
		$query = $this->db->get('orders');
		return $query->result_array();	
	}
	
	function get_order_items($order_id)
	{
		$this->db->where('order_id',$order_id);
		$this->db->order_by('product_name','asc');
		$query = $this->db->get('order_items');	
		return $query->result_array();
	}
	
	function insert_comment($data)
	{
		if($this->db->insert('order_comments', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('There was error while adding Order Comments. Please contact webmaster');
		}	
	}
	
	function update($order_id,$data)
	{
		$this->db->where('order_id',$order_id);
		if($this->db->update('orders', $data))
		{
			return $this->db->affected_rows();
		}
		else
		{
			return $this->error_message('There was error while updating order. Please contact webmaster');
		}	
	}
	
}