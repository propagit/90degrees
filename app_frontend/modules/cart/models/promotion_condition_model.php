<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_condition_model extends CI_Model {

    function get_promotion_conditions($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get('promotion_conditions');
        return $query->result_array();
    }

    function get_promotion_condition($condition_id) {
        $this->db->where('condition_id', $condition_id);
        $query = $this->db->get('promotion_conditions');
        return $query->first_row('array');
    }

    function increase_coupon_usages($condition_id) {
        $condition = $this->get_promotion_condition($condition_id);
        if ($condition) {
	        return $this->update_promotion_condition($condition_id, array('actual_usages' => $condition['actual_usages'] + 1));
        }
        return false;
    }
}
