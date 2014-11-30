<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}
	
	function index($method='', $param='')
	{
		$data['pages'] = $this->page_model->get_pages();
		$this->load->view('page/table_view', isset($data) ? $data : NULL);
	}
	
	function create()
	{
		$this->load->view('page/form_view');
	}
	
	function edit($page_id)
	{
		$page = $this->page_model->get_page($page_id);
		if (!$page) {
			# Show page error
			return;
		}
		$data['page'] = $page;
		$this->load->view('page/form_view', isset($data) ? $data : NULL);
	}
	
	function field_select($field_name, $page_id)
	{
		$data['field_name'] = $field_name;
		$data['page_id'] = $page_id;
		$data['pages'] = $this->page_model->get_pages();
		$this->load->view('page/field_select', isset($data) ? $data : NULL);
	}
	
	function id($page_id)
	{
		return $this->page_model->get_page($page_id);
	}

}