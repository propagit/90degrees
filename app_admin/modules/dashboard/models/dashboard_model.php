<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	function error_message($msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Dashboard_model.php)';
		}
		else
		{
			return $msg;
		}
	}
	
	function get_month_sale($year,$month)
	{
		$sql = "SELECT SUM(o.total) as total_sale
				 FROM orders o
					WHERE o.order_status = 'paid'
					AND o.deleted = 0
					AND o.created_on LIKE '" . $year .'-'.$month."%'";
		$total = $this->db->query($sql)->row_array();
		return isset($total['total_sale']) ? $total['total_sale'] : '0.00';
	}
	
	function get_order_amount_by_date($date)
	{
		$sql = "SELECT sum(total) AS total_amount FROM orders 
				WHERE order_status  = 'paid'
				AND deleted = 0
				AND created_on LIKE '" . $date . "%'";

		$total = $this->db->query($sql)->row_array();
		if($total){
			return $total['total_amount'] ? $total['total_amount'] : '0.00';	
		}
	}
	
	function get_year_sale_breakdown($year)
	{
		$sql = "SELECT MONTH(created_on) AS month, sum(total) AS total FROM orders 
				WHERE order_status = 'paid' 
				AND deleted = 0
				AND YEAR(created_on) = '".$year."'
				GROUP BY MONTH(created_on)";
		return $this->db->query($sql)->result_array();
	}
	
	function get_year_signups_breakdown($year)
	{
		$sql = "SELECT MONTH(created_on) AS month, count(user_id) AS total FROM users 
				WHERE status = 1
				AND YEAR(created_on) = '".$year."'
				GROUP BY MONTH(created_on)";
		return $this->db->query($sql)->result_array();
	}
	
	function get_month_sale_breakdown($year,$month)
	{
		$sql = "SELECT DAY(created_on) AS day, sum(total) AS total FROM orders 
				WHERE order_status = 'paid' 
				AND deleted = 0 
				AND YEAR(created_on) = '".$year."' 
				AND MONTH(created_on) = '".$month."' 
				GROUP BY DAY(created_on)";	
		return $this->db->query($sql)->result_array();
	}
	
	
}