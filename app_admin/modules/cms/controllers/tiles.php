<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiles extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('tiles_model');
	}
	
	function index($order_mode = 'disabled')
	{
		$data['tiles'] = $this->tiles_model->get_tiles();
		$data['order_mode'] = false;
		$this->load->view('tile/table_view', isset($data) ? $data : NULL);
	}
	
	function create()
	{
		$data['tab'] = 'basic';
		$this->load->view('tile/form_view', isset($data) ? $data : NULL);
	}
	
	function edit($tile_id, $tab = 'basic')
	{
		$tile = $this->tiles_model->get_tile($tile_id);
		if (!$tile)
		{
			show_404();
		}
		$data['tile'] = $tile;
		$data['tab'] = $tab;
		$this->load->view('tile/form_view', isset($data) ? $data : NULL);
	}
	
	function order_position()
	{
		$data['tiles'] = $this->tiles_model->get_tiles();
		$data['order_mode'] = true;
		$this->load->view('tile/table_view', isset($data) ? $data : NULL);
	}	
	
	
}