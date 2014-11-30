<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_field_model extends CI_Model {

    function get($field_id)
    {
	    $this->db->where('field_id', $field_id);
	    $query = $this->db->get('custom_fields');
	    return $query->first_row('array');
    }
    
    function all($required)
    {
	    if ($required)
	    {
		    $this->db->where('required', 1);
	    }
	    $query = $this->db->get('custom_fields');
	    return $query->result_array();
    }
    
    function add_user_data($data)
    {
	    if (!isset($data['user_id']) || !isset($data['field_id']) || $data['value'] == '')
		{
			return false;
		}
		if ($this->get_user_data($data['user_id'], $data['field_id'])) # Found the user custom field, update the value
		{
			$this->db->where('user_id', $data['user_id']);
			$this->db->where('field_id', $data['field_id']);
			return $this->db->update('user_custom_fields', $data);
		}
		else # New config, add to database
		{
			$this->db->insert('user_custom_fields', $data);
			return $this->db->insert_id();
		}	    
    }
    
    function get_user_data($user_id, $field_id)
    {
	    $this->db->where('user_id', $user_id);
	    $this->db->where('field_id', $field_id);
	    $query = $this->db->get('user_custom_fields');
	    return $query->first_row('array');
    }
}
