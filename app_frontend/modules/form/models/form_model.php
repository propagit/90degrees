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

    function get_form($form_id) {
        $this->db->where('form_id', $form_id);
        $this->db->where('status >= ', 0);
        $query = $this->db->get('cms_forms');
        return $query->first_row('array');
    }

    function get_fields($form_id)
    {
        $this->db->where('form_id', $form_id);
        $this->db->order_by('field_order', 'asc');
        $query = $this->db->get('cms_form_fields');
        return $query->result_array();
    }

}
