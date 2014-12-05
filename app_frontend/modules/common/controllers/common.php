<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
	}
	
	function validate_input($input, $rules)
	{
		$errors = array();
		foreach($rules as $rule) {
			$conditions = explode('|', $rule['rules']);
			foreach($conditions as $condition) {
				switch($condition) {
					case 'required':
							if (!isset($input[$rule['field']]) || $input[$rule['field']] == '') {
								$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' is required');
							}
						break;
					case 'email':
						if (!filter_var($input[$rule['field']],FILTER_VALIDATE_EMAIL)){
							$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' is invalid');	
						}
						break;
					default:
						# check of conditions such as unique
						
						# Unique
						if (strpos($condition,'unique') !== false) {
							$db_param = trim(substr($condition,7),']'); #
							$db_arr = explode('.',$db_param);
							
							$param = array(
										'db_table' => $db_arr[0], 
										'db_field' => $db_arr[1],
										'input_value' => $input[$rule['field']]
										);
							# Check to see if only active status are to be queried
							if(isset($db_arr['2']) && isset($db_arr['3'])){
								$param['db_active_field'] = $db_arr[2];	
								$param['db_active_value'] = $db_arr[3];
							}
							if(!$this->common_model->is_unique($param)){
								$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' already exist in our system.');	
							}
						}
					break;
				}
			}
		}
		return $errors;
	}
	
	/**
	*	@desc: this function render the breadcrumb view for the page
	*	@param: $pages - array of page tree
	*/
	function breadcrumb($pages = array())
	{
		$data['pages'] = $pages;
		$this->load->view('breadcrumb', isset($data) ? $data : NULL);
	}
	
	function random_string($string_len = 6)
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$rand_string = array(); 
		$alpha_length = strlen($alphabet) - 1; 
		for ($i = 0; $i < $string_len; $i++) {
			$n = rand(0, $alpha_length);
			$rand_string[] = $alphabet[$n];
		}
		return implode($rand_string); 
	}
	
	/**
	 * @desc: function to generate pagination
	 *
	 */
	function pagination($params = array())
	{
		# config
		$data['number_of_pages_to_display'] = TOTAL_DISPLAY_PAGES;
		$data['first_half_of_pages'] = FIRST_HALF;
		$data['second_half_of_pages'] = SECOND_HALF;
		
		# other vars that are required to be passed in the params array
		$data['records_per_page'] = $params['records_per_page'];
		$data['total_records'] = $params['total_records'];
		$data['current_page'] = $params['current_page'];
		$data['url'] = $params['url'];
	
		$this->load->view('pagination',isset($data) ? $data : NULL);	
	}
	

	

	
}