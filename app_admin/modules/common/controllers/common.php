<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MX_Controller {
	
	
	function __construct()
	{
		parent::__construct();
		#$this->load->model('country_model');
		#$this->load->model('month_model');
	}
	
	function validate_input($input, $rules)
	{
		$errors = array();
		foreach($rules as $rule) {
			$conditions = explode(',', $rule['rules']);
			foreach($conditions as $condition) {
				switch($condition) {
					case 'required':
							if (!isset($input[$rule['field']]) || $input[$rule['field']] == '') {
								$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' is required');
							}
						break;
				}
			}
		}
		return $errors;
	}
	

	function alert_success()
	{
		$this->load->view('alert_success');
	}
	
	function alert_error()
	{
		$this->load->view('alert_error');
	}

	function get_countries()
	{
		#return $this->db->country_model->get_all();
	}

	function dd_action_palet($params)
	{
		# current fields - update per requirements
		/*$params = array(
					'status' => 'required',
					'obj_id' => 'required',
					'obj_type' => 'required - this is the table name'
					'ul_class' => '',
					'links' => array(
								'label' => '',
								'url' => '',
								'id' => '',
								'class' => '',
								'attrs' => '',
								'data' => ''
								),
					);*/
		# the links parameter is now optional which is used to populate any additional action pallete
		
		$data['params'] = $params;
		$this->load->view('dd_action_pallet',isset($data) ? $data : NULL);
	}
	
	function dd_action_palet_general($params)
	{
		# current fields - update per requirements
		/*$params = array(
					'status' => 'required',
					'obj_id' => 'required',
					'obj_type' => 'required - this is the table name'
					'ul_class' => '',
					'links' => array(
								'label' => '',
								'url' => '',
								'id' => '',
								'class' => '',
								'attrs' => '',
								'data' => ''
								),
					);*/
		# the links parameter is now optional which is used to populate any additional action pallete
		
		$data['params'] = $params;
		$this->load->view('dd_action_pallet_general',isset($data) ? $data : NULL);
	}
	
}