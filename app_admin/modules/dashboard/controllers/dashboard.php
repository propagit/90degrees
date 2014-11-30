<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}
	
	function index()
	{
		$data['revenue_last_year'] = $this->get_revenue_graph_data(date('Y',strtotime("-1 year")));
		$data['revenue_this_year'] = $this->get_revenue_graph_data(date('Y'));
		$data['signups'] = $this->get_signup_graph_data(date('Y')); 
		$this->load->view('home', isset($data) ? $data : NULL);	
	}
	
	function get_month_sale($year,$month)
	{
	 	return $this->dashboard_model->get_month_sale($year,$month);
	}
	
	function get_todays_sale()
	{
		return $this->dashboard_model->get_order_amount_by_date(date('Y-m-d'));	
	}
	
	
	# returns sales data on monthly basis arrray where array key 1 = Jan .. 12 = Dec
	function get_year_sale_breakdown($year = '')
	{
		if(!$year){
			$year = date('Y');	
		}
		$sales = $this->dashboard_model->get_year_sale_breakdown($year);

		$data = array();
		for($i = 1; $i <= 12; $i++)
		{
			$data[$i] = 0;
			foreach($sales as $sale){
				if($sale['month'] == $i){
					$data[$i] = $sale['total'];	
				}
			}
		}
		return $data;
	}
	
	function get_revenue_graph_data($year)
	{

		$sales = $this->get_year_sale_breakdown($year);
		
		$cur_base = '';
		$out = '';
		$i = 1;
		foreach($sales as $sale){
			$cur_base = strtotime(date('Y-'.$i)) * 1000;
			$i++;
			$out .= '[' . $cur_base . ', '. $sale . '],'; 	
		}
		$out = trim($out,',[');
		return '['.$out;
	}
	
	function get_signup_graph_data($year)
	{

		$signups = $this->dashboard_model->get_year_signups_breakdown($year);
		
		# break this data into month array
		$data = array();
		for($i = 1; $i <= 12; $i++)
		{
			$data[$i] = 0;
			foreach($signups as $signup){
				if($signup['month'] == $i){
					$data[$i] = $signup['total'];	
				}
			}
		}
		
		
		$cur_base = '';
		$out = '';
		$i = 1;
		foreach($data as $val){
			$cur_base = strtotime(date('Y-'.$i)) * 1000;
			$i++;
			$out .= '[' . $cur_base . ', '. $val . '],'; 	
		}
		$out = trim($out,',[');
		return '['.$out;
	}
	
	function get_month_sale_breakdown($year,$month)
	{
		$sales = $this->dashboard_model->get_month_sale_breakdown($year,$month);
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
		
		# break this data into month array
		$data = array();
		for($i = 1; $i <= $days; $i++)
		{
			$data[$i] = 0;
			foreach($sales as $sale){
				if($sale['day'] == $i){
					$data[$i] = $sale['total'];	
				}
			}
		}
		return $data;
	}
	
	function test()
	{
		echo time() . '<br>';
		echo 	1364587000000 - 1354586000000 . '<br>';
		echo 	1374588000000 - 1364587000000 . '<br>';
	}
	
	
}