<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('upload_model');
	}
	
	
	/**
	*	@desc: 
	*	@param: 
	*			- $params (array) - array of uploading options
	*			- $callback (string) - callback function after uploading
	*/
	function field_upload($params = array(), $callback='') {
		$field_name = 'userfile'; # Default field name		
		if (isset($params['name'])) {
			$field_name = $params['name'];
		}
		
		$allowed_extensions = array(array('title' => 'Image files', 'extensions' => 'jpg,gif,png')); # Default extensions
		if (isset($params['allowed_extensions'])) {
			$allowed_extensions = $params['allowed_extensions'];
		}
		
		# resize params
		if(isset($params['resize_params'])){
			$data['resize_params'] = $params['resize_params']; 
		}
		
		$data['field_name'] = $field_name;
		$data['allowed_extensions'] = $allowed_extensions;
		$data['callback'] = $callback;
		$this->load->view('field_upload_view', isset($data) ? $data : NULL);
	}
	
	/**
	*	@name: do_upload
	*	@desc: function to upload a file and store file information to database
	*	@access: public
	*	@param: (array) $config
	*	@return: (json) {ok: false, msg: string} or {ok: true, upload_id: int}
	*/
	function do_upload($config) 
	{
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload())
		{
			$msg = $this->upload->display_errors('','');
			return json_encode(array(
				'ok' => false,
				'msg' => $msg
			));
		}
		else
		{
			$data = $this->upload->data();
			$upload_id = $this->upload_model->insert_upload($data);
			return json_encode(array(
				'ok' => true,
				'upload_id' => $upload_id
			));
		}
	}
	
	function update_upload($upload_id, $data)
	{
		return $this->upload_model->update_upload($upload_id, $data);
	}
	
	/**
	*	@name: get_upload
	*	@desc: function to get file information from database
	*	@access: public
	*	@param: (int) $upload_id
	*	@return: (array) file data
	*/
	function get_upload($upload_id)
	{
		return $this->upload_model->get_upload($upload_id);
	}
	
	function resize_photo($params) 
	{
		$name = $params['name'];
		$directory = $params['directory'];
		$sub = $params['sub'];
		$width = $params['width'];
		$height = $params['height'];
		$maintain_ratio = isset($params['maintain_ratio']) ? $params['maintain_ratio'] : TRUE;
	
		$config = array();
		$config['source_image'] = $directory."/".$name;
		$config['create_thumb'] = FALSE;
		$config['new_image'] = $directory."/".$sub."/".$name;
		$config['maintain_ratio'] = $maintain_ratio;
		$config['quality'] = 100;
		$config['width'] = $new_dimensions['width'];
		$config['height'] = $new_dimensions['height'];
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();		
		$this->image_lib->clear();	
	}
	
	
	# this is an attempt to make the resize work for landscape - work in progress currently now in use.
	function validate_resize($params)
	{
		$target_width = $params['width'];
		$target_height = $params['height'];
		$source = $params['directory'] . '/' . $params['name'];
		$image_size = getimagesize($source);
		$org_width = $image_size[0];
		$org_height = $image_size[1];
		
		$adjusted_height = $target_width * ($org_height/$org_width);
		$adjusted_width = $target_height * ($org_width/$org_height);
		
		$aspect_ratio = $org_width / $org_height;
		
		if($adjusted_width < $target_width){
			return array(
						'new_width' => $target_width,
						'new_height' => round($target_width * $aspect_ratio)
						);
		}
		if($adjusted_height < $target_height){
			return array(
						'new_width' => round($target_height * $aspect_ratio),
						'new_height' => $target_height
						);
		}
	}
	
	
	
	function crop_photo($params)
	{
			
	}
	
}