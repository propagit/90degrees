<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}
	
	function validate_page($input)
	{
		$rules = array(
			array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
			array('field' => 'content_text', 'label' => 'Content', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	
	function create()
	{
		$input = $this->input->post();
		$errors = $this->validate_page($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$page_data = array(
			'title' => $input['title'],
			'uri_path' => $input['uri_path'],
			'meta_title' => $input['meta_title'],
			'meta_description' => $input['meta_description'],
			#'meta_keywords' => $input['meta_keywords'],
			'content' => $input['content_text']
		);
		
		$page_id = $this->page_model->insert_page($page_data);
		
		if (is_int($page_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $page_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $page_id
			));
		}
	}
	
	function update()
	{
		$input = $this->input->post();
		$errors = $this->validate_page($input);
		
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		$page_data = array(
			'title' => $input['title'],
			'uri_path' => $input['uri_path'],
			'meta_title' => $input['meta_title'],
			'meta_description' => $input['meta_description'],
			#'meta_keywords' => $input['meta_keywords'],
			'content' => $input['content_text']
		);
		$page_id = $input['page_id'];
		$updated = $this->page_model->update_page($page_id, $page_data);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $page_id
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}
		
	}
	
	//check if uri already exist
	function uri_exist()
	{
		$uri_path = $this->input->post('slug');
		$out['uri_exist'] = false;
		if($this->page_model->get_page_by_uri($uri_path)){
			$out['uri_exist'] = true;
		}
		echo json_encode($out);
	}
	
	function change_status()
	{
		$page_id = $this->input->post('page_id');
		$trashed = $this->input->post('trashed');
		# If not trashed
		if(!$trashed){
			$page = $this->page_model->get_page($page_id);
			$new_status = $page['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		$updated = $this->page_model->update_status($page_id,$new_status);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $page_id
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}
	}

	
}