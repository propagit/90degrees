<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_model extends CI_Model {

    function error_message($msg) {
        if (ENVIRONMENT == 'development')
        {
            return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' (Form_model.php)';
        }
        else
        {
            return $msg;
        }
    }

    function prepare_data($data) {


        return $data;
    }

    function insert_form($data) {
        $data = $this->prepare_data($data);
        if($this->db->insert('cms_forms', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return $this->error_message('insert_form', 'There was error while adding new form.');
        }
    }

    function get_form($form_id) {
        $this->db->where('form_id', $form_id);
        $this->db->where('status >= ', 0);
        $query = $this->db->get('cms_forms');
        return $query->first_row('array');
    }

    function get_forms() {
        $this->db->where('status >',-1);
        $query = $this->db->get('cms_forms');
        return $query->result_array();
    }


    function insert_field($data) {
        if ($this->db->insert('cms_form_fields', $data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return $this->error_message('insert_field', 'There was error while adding new field.');
        }
    }

    function get_fields($form_id)
    {
        $this->db->where('form_id', $form_id);
        $this->db->order_by('field_order', 'asc');
        $query = $this->db->get('cms_form_fields');
        return $query->result_array();
    }

    function get_field($field_id)
    {
        $this->db->where('field_id', $field_id);
        $query = $this->db->get('cms_form_fields');
        return $query->first_row('array');
    }

    function update_field($field_id, $data)
    {
        $this->db->where('field_id', $field_id);
        return $this->db->update('cms_form_fields', $data);
    }

    function delete_field($field_id)
    {
        $this->db->where('field_id', $field_id);
        return $this->db->delete('cms_form_fields');
    }

}
