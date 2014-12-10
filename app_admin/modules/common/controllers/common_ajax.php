<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
	}
	
	
	
	function change_status(){
	
		$obj_type = $this->input->post('obj_type');
		$obj_id = $this->input->post('obj_id');
		$trashed = $this->input->post('trashed');
	
		$obj_key = $this->common_model->get_obj_primary_key($obj_type);
		
		# If not trashed
		if(!$trashed){
			$obj = $this->common_model->get_object($obj_type,$obj_key,$obj_id);
			$new_status = $obj['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		
		$updated = $this->common_model->update_object($obj_type,$obj_key,$obj_id,array('status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $obj_id
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
	
	