<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_model');
	}
	
	
	function create()
	{
		$input = $this->input->post();
		
		$rules = array(
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
		);

		$errors = modules::run('common/validate_input', $input, $rules);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		$banner_data = array(
			'name' => $input['name'],
			'banner_uri' => $input['banner_uri'],
			'new_window' => isset($input['new_window']) ? 1 : 0,
			'caption' => $input['caption']
		);
		$banner_id = $this->banner_model->insert_banner($banner_data);
		
		if (is_int($banner_id))
		{
			# Banner created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $banner_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $banner_id
			));
		}
		
	}
	
	function update($tab)
	{
		$input = $this->input->post();
		
		$rules = array(
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
		);

		$errors = modules::run('common/validate_input', $input, $rules);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		$updated = $this->banner_model->update_banner($input['banner_id'], $input);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['banner_id']
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
	
	function add_images()
	{
		$input = $this->input->post();
		$upload_ids = explode(',', $input['upload_ids']);
		if (count($upload_ids) > 0) {
			foreach($upload_ids as $upload_id) {
				$id = $this->banner_model->add_image($input['banner_id'], $upload_id);
				if (!is_int($id))
				{
					echo $id;
					return;
				}
			}
		}
	}
	
	function load_images()
	{
		$input = $this->input->post();
		$data['images'] = $this->banner_model->get_images($input['banner_id']);
		$this->load->view('banner/images_view', isset($data) ? $data : NULL);
	}
	
	function trash_image()
	{
		$upload_id = $this->input->post('upload_id');
		$this->banner_model->trash_image($upload_id);
	}
	
	function change_status()
	{
		$banner_id = $this->input->post('banner_id');
		$trashed = $this->input->post('trashed');
		
		# If not trashed
		if(!$trashed){
			$banner = $this->banner_model->get_banner($banner_id);
			$new_status = $banner['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		$updated = $this->banner_model->update_banner($banner_id,array('status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $banner_id
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