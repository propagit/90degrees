<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}
	
	function validate_category($input)
	{
		$rules = array(
			array('field' => 'name', 'label' => 'Category Name', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function create()
	{
		$input = $this->input->post();
		$errors = $this->validate_category($input);
		
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		$category_data = array(
			'parent_id' => $input['parent_id'],
			'name' => $input['name'],
			'uri_path' => $input['uri_path']
		);
		
		$category_id = $this->category_model->insert_category($category_data);
		
		if (is_int($category_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['parent_id'] # Keep info of parent category
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $input['parent_id'] # Keep info of parent category
			));
		}
	}
	
	function update()
	{
		$input = $this->input->post();
		$errors = $this->validate_category($input);
		
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$category_id = $input['category_id'];
		$category_data = array(
			'parent_id' => $input['parent_id'],
			'name' => $input['name'],
			'uri_path' => $input['uri_path']
		);
		
		$updated = $this->category_model->update_category($category_id,$category_data);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $category_id
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