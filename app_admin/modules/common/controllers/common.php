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
					'btn_name' => 'required',
					'ul_class' => '',
					'links' => array(
								'label' => 'required',
								'url' => '',
								'id' => '',
								'class' => '',
								'attrs' => '',
								'data' => ''
								),
					);*/
		
		$data['params'] = $params;
		$this->load->view('dd_action_pallet',isset($data) ? $data : NULL);
	}
}