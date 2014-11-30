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
	
	function get_all()
	{
		$this->db->where('deleted !=',1);
		$this->db->order_by('order_id','desc');
		$query = $this->db->get('orders');
		return $query->result_array();
	}
	
	function get_order($order_id)
	{
		$this->db->where('order_id',$order_id);
		$this->db->where('deleted !=',1);
		$query = $this->db->get('orders');
		return $query->first_row('array');	
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
	
	function get_comments($order_id)
	{
		$this->db->where('order_id',$order_id);
		$this->db->order_by('created_on','asc');
		$query = $this->db->get('order_comments');
		return $query->result_array();	
	}
	
	function update_order($order_id, $data) {
		$this->db->where('order_id', $order_id);
		if ($this->db->update('orders', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('There was error while updating this order. Please contact webmaster');
		}
	}
	
	function get_order_count_by_date($date)
	{
		$sql = "SELECT count(*) AS total_orders FROM orders 
				WHERE order_status  = 'paid'
				AND deleted = 0
				AND created_on LIKE '" . $date . "%'";

		$total = $this->db->query($sql)->row_array();
		if($total){
			return $total['total_orders'];	
		}else{
			return false;	
		}
	}
	
	function search_order($params)
	{
		$sql = "SELECT * FROM orders o 
				WHERE o.created_on >= '" . date('Y-m-d',strtotime($params['order_from'])) . "' 
				AND o.created_on <= '" . date('Y-m-d',strtotime($params['order_to'])) . "'
				AND o.order_status  = 'paid' 
				AND o.deleted = 0 
				ORDER BY o.created_on DESC";
		$orders = $this->db->query($sql)->result_array();
		return $orders;
	}
	
	function get_order_qty($order_id)
	{
		$sql = "SELECT SUM(quantity) as qty
				FROM order_items oi 
				WHERE oi.order_id = ".$order_id;
		$row = $this->db->query($sql)->row_array();
		if($row){
			return $row['qty'];	
		}
		return 0;
	}
	
	
}