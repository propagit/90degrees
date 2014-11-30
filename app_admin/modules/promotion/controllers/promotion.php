<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends MX_Controller {
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('promotion_model');
		$this->load->model('promotion_condition_model');
		$this->load->model('product_model');
	}
	
	function index()
	{
		$data['promotions'] = $this->promotion_model->get_all();
		$this->load->view('table_view', isset($data) ? $data : NULL);
	}
	
	function create()
	{
		$data['tab'] = 'basic';
		$this->load->view('form_view', isset($data) ? $data : NULL);
	}
	
	function edit($promotion_id, $tab = 'basic')
	{
		$promotion = $this->promotion_model->get_promotion($promotion_id);
		if (!$promotion)
		{
			show_404();
		}
		$data['promotion'] = $promotion;
		$data['tab'] = $tab;
		$this->load->view('form_view', isset($data) ? $data : NULL);
	}
	
	function discount($price, $promotion_id)
	{
		$promotion = $this->promotion_model->get_promotion($promotion_id);
		if (!$promotion)
		{
			return 0;
		}
		if ($promotion['discount_type'] == 'fixed')
		{
			return $promotion['discount_value'];
		}
		else
		{
			return $promotion['discount_value'] * $price / 100;
		}
	}
}