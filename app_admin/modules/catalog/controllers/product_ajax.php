<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}
	
	function validate_category($input)
	{
		$rules = array(
			array('field' => 'name', 'label' => 'Product Name', 'rules' => 'required')
		);
		return modules::run('common/validate_input', $input, $rules);
	}
	
	function create()
	{
		$input = $this->input->post();
		$errors = $this->validate_category($input);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
		
		$product_data = array(
			'name' => $input['name'],
			'uri_path' => $input['uri_path'],
			'short_desc' => $input['short_desc'],
			'long_desc' => $input['long_desc']
		);
		$product_id = $this->product_model->insert_product($product_data);
		
		if (is_int($product_id))
		{
			# Product created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $product_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $product_id
			));
		}
		
	}
	
	function update($tab)
	{
		$input = $this->input->post();
		
		# Add code for checking price value (to be completed)
		
		$updated = $this->product_model->update_product($input['product_id'], $input);
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['product_id']
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
				$id = $this->product_model->add_image($input['product_id'], $upload_id);
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
		$data['images'] = $this->product_model->get_images($input['product_id']);
		$this->load->view('product/images_view', isset($data) ? $data : NULL);
	}
	
	function trash_image()
	{
		$upload_id = $this->input->post('upload_id');
		$this->product_model->trash_image($upload_id);
	}
	
	function update_category()
	{
		$input = $this->input->post();
		if (isset($input['product_id']) && isset($input['category_id']))
		{
			$id = $this->product_model->update_category($input['product_id'], $input['category_id']);
			if (!is_int($id))
			{
				echo $id;
			}
		}
		else
		{
			echo 'Invalid input';
		}		
	}
	
	function change_status()
	{
		$product_id = $this->input->post('product_id');
		$trashed = $this->input->post('trashed');
		
		# If not trashed
		if(!$trashed){
			$product = $this->product_model->get_product($product_id);
			$new_status = $product['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		$updated = $this->product_model->update_product($product_id,array('status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $product_id
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