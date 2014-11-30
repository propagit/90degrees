<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_model');
	}
	
	function index()
	{
		$data['banners'] = $this->banner_model->get_banners();
		$this->load->view('banner/table_view', isset($data) ? $data : NULL);
	}
	
	function create()
	{
		$data['tab'] = 'basic';
		$this->load->view('banner/form_view', isset($data) ? $data : NULL);
	}
	
	function edit($banner_id, $tab = 'basic')
	{
		$banner = $this->banner_model->get_banner($banner_id);
		if (!$banner)
		{
			show_404();
		}
		$data['banner'] = $banner;
		$data['tab'] = $tab;
		$this->load->view('banner/form_view', isset($data) ? $data : NULL);
	}
	
	
}