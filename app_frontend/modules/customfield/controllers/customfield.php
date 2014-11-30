<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customfield extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('custom_field_model');
	}
	
	function view($field_id, $user_id = '')
	{
		$field = $this->custom_field_model->get($field_id);
		if (!$field)
		{
			return;
		}
		if ($user_id)
		{
			$user_data = $this->custom_field_model->get_user_data($user_id, $field_id);
			if ($user_data)
			{
				$data['value'] = $user_data['value'];
			}			
		}
		
		$data['field'] = $field;
		$this->load->view('field/' . $field['type'], isset($data) ? $data : NULL);
	}
	
	function all($required = 0)
	{
		return $this->custom_field_model->all($required);
	}
	
	function add_user_data($user_id, $input = array())
	{
		$custom_fields = $this->all();
		if ($custom_fields)
		{
			foreach($custom_fields as $field)
			{
				if (isset($input[$field['field_id']]))
				{
					$this->custom_field_model->add_user_data(array(
						'user_id' => $user_id,
						'field_id' => $field['field_id'],
						'value' => $input[$field['field_id']]
					));
				}
			}
		}
	}
	
}