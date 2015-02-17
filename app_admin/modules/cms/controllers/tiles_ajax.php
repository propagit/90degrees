<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiles_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('tiles_model');
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
		
		$tile_data = array(
			'name' => $input['name'],
			'tile_uri' => $input['tile_uri'],
			'new_window' => $input['new_window'],
			'content' => $input['content_text'],
			'short_desc' => $input['short_desc']
		);
		$tile_id = $this->tiles_model->insert_tile($tile_data);
		
		if (is_int($tile_id))
		{
			# tile created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $tile_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $tile_id
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
		$tile_data = array(
			'name' => $input['name'],
			'tile_uri' => $input['tile_uri'],
			'new_window' => $input['new_window'],
			'content' => $input['content_text'],
			'short_desc' => $input['short_desc']
		);
		
		$updated = $this->tiles_model->update_tile($input['tile_id'], $tile_data);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['tile_id']
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
				$id = $this->tiles_model->add_image($input['tile_id'], $upload_id);
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
		$data['images'] = $this->tiles_model->get_images($input['tile_id']);
		$data['tile'] = $this->tiles_model->get_tile($input['tile_id']);
		$this->load->view('tile/images_view', isset($data) ? $data : NULL);
	}
	
	function trash_image()
	{
		$upload_id = $this->input->post('upload_id');
		$this->tiles_model->trash_image($upload_id);
	}
	
	function change_status()
	{
		$tile_id = $this->input->post('tile_id');
		$trashed = $this->input->post('trashed');
		
		# If not trashed
		if(!$trashed){
			$tile = $this->tiles_model->get_tile($tile_id);
			$new_status = $tile['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		$updated = $this->tiles_model->update_tile($tile_id,array('status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $tile_id
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
	
	function set_feature()
	{
		$upload_id = $this->input->post('upload_id');
		$tile_id = $this->input->post('tile_id');
		$updated = $this->tiles_model->set_feature_image($tile_id, $upload_id);
		if ($updated){
			echo 'successful';	
		}else{
			echo 'failed';	
		}
	}
	
	function update_home_visibility()
	{
		$tile_id = $this->input->post('tile_id');
		$tile = $this->tiles_model->get_tile($tile_id);
		$new_home_page_status = $tile['home_page'] ? 0 : 1;
		
		$updated = $this->tiles_model->update_tile($tile_id,array('home_page' => $new_home_page_status));
		
		if ($updated === true)
		{
			echo 'ok';
		}
		else
		{
			echo 'failed';
		}
	}
	
	function update_order()
	{
		echo $this->tiles_model->order_tiles($_POST);
	}
	
	
}