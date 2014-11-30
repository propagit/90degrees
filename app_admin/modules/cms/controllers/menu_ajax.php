<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
	}
	
	function validate_menu($input)
	{
		$rules = array(
			array('field' => 'name', 'label' => 'Menu Name', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function create()
	{
		$input = $this->input->post();
		$errors = $this->validate_menu($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
				
		$menu_id = $this->menu_model->insert_menu($input);
		if (is_int($menu_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $menu_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $menu_id
			));
		}
	}
	
	function update()
	{
		$input = $this->input->post();
		$errors = $this->validate_menu($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$menu_id = $input['menu_id'];
		$updated = $this->menu_model->update_menu($menu_id, $input);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $menu_id
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
	
	function load_subject_list()
	{
		$subject = $this->input->post('subject');
		$subject_id = $this->input->post('subject_id');
		switch($subject) {
			case 'page':
					echo modules::run('cms/page/field_select', 'subject_id', $subject_id);
				break;
			case 'category':
					echo modules::run('catalog/category/field_select', 'subject_id', $subject_id);
				break;
			case 'product':
					echo modules::run('catalog/product/field_select', 'subject_id', $subject_id);
				break;
		}		 
	}
	
	function validate_system_url($input)
	{
		$rules = array(
			array('field' => 'subject', 'label' => 'Subject', 'rules' => 'required'),
			array('field' => 'subject_id', 'label' => 'Subject', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function add_system_url()
	{
		$input = $this->input->post();
		$errors = $this->validate_system_url($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$input['url_type'] = 'system';
		$url_id = $this->menu_model->insert_url($input);
		if (is_int($url_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['menu_id']
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $url_id
			));
		}
	}
	
	function update_system_url()
	{
		$input = $this->input->post();
		$errors = $this->validate_system_url($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$input['url_type'] = 'system';
		$url_id = $input['url_id'];
		if (!isset($input['new_window']))
		{
			$input['new_window'] = 0;
		}
		$updated = $this->menu_model->update_url($url_id, $input);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $url_id
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
	
	function validate_custom_url($input)
	{
		$rules = array(
			array('field' => 'label', 'label' => 'Label', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function add_custom_url()
	{
		$input = $this->input->post();
		$errors = $this->validate_custom_url($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$input['url_type'] = 'custom';
		$url_id = $this->menu_model->insert_url($input);
		if (is_int($url_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['menu_id']
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $url_id
			));
		}
	}
	
	function update_custom_url()
	{
		$input = $this->input->post();
		$errors = $this->validate_custom_url($input);
		if (count($errors) > 0) {
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		$input['url_type'] = 'custom';
		$url_id = $input['url_id'];
		if (!isset($input['new_window']))
		{
			$input['new_window'] = 0;
		}
		$updated = $this->menu_model->update_url($url_id, $input);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $url_id
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

	function update_urls_tree()
	{
		$urls_tree = $this->input->post('urls_tree');
		$order = 0;
		foreach($urls_tree as $url)
		{
			$order = $this->update_url_parent($url, $order);
			# Update top (root) level of menu
			$updated = $this->menu_model->update_url($url['id'], array(
									'parent_id' => 0,
									'url_order' => $order
								));
			if ($updated !== true)
			{
				echo $updated;
				return;
			}
			$order++;
		}
	}
	
	function update_url_parent($url, $order)
	{
		if (isset($url['children']))
		{
			foreach($url['children'] as $child_url)
			{
				$updated = $this->menu_model->update_url($child_url['id'], array(
									'parent_id' => $url['id'],
									'url_order' => $order
								));
				if ($updated !== true)
				{
					echo $updated;
					return;
				}
				$order++; # Increase order
				$order = $this->update_url_parent($child_url, $order);
			}
		}
		return $order;
	}
	
	function trash_url()
	{
		$url_id = $this->input->post('url_id');
		$updated = $this->menu_model->update_url($url_id, array('status' => TRASHED));
		if ($updated !== true) {
			echo $updated;
		}
	}
}
	
	