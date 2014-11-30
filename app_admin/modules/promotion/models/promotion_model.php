<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_model extends CI_Model {
		
	function insert_promotion($data) {
        $this->db->insert('promotions', $data);
        return $this->db->insert_id();
    }

    function get_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get('promotions');
        return $query->first_row('array');
    }

    function update_promotion($promotion_id, $data) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->update('promotions', $data);
    }
	
	function update_status($promotion_id,$status){
		$this->db->where('promotion_id', $promotion_id);
		return $this->db->update('promotions', array('status' => $status));
	}
	
    function search_promotions($params) {
        if (isset($params['keyword']) && $params['keyword'] != '') {
            $this->db->like('name', $params['keyword']);
        }
        if (isset($params['status']) && $params['status'] != '') {
            $this->db->like('status', $params['status']);
        }
        if (isset($params['date_from']) && $params['date_from'] != '') {
            $date_from = date('Y-m-d', strtotime($params['date_from']));
            $where = "(valid_period = 0 OR (valid_period = 1 AND (date_from >= '$date_from' OR date_to >= '$date_from')))";
            $this->db->where($where);
        }
        if (isset($params['date_to']) && $params['date_to'] != '') {
            $date_to = date('Y-m-d', strtotime($params['date_to']));
            $where = "(valid_period = 0 OR (valid_period = 1 AND (date_from <= '$date_to' OR date_to <= '$date_to')))";
            $this->db->where($where);
        }
        $query = $this->db->get('promotions');
        return $query->result_array();
    }
	
	function get_all()
	{
		$this->db->where('status >',-1);
		$query = $this->db->get('promotions');
        return $query->result_array();	
	}

    function delete_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->delete('promotions');
    }

	function get_current_promotions() {
		$today = date('Y-m-d');
        $sql = "SELECT *
                FROM promotions
                WHERE status = 1
                AND promotion_type = 'cart'
                AND (valid_period = 0 OR (valid_period = 1 AND
                    date_from <= '$today' AND date_to >= '$today'))";
        $query = $this->db->query($sql);
        return $query->result_array();
	}

    function get_cart_promotions() {
        $today = date('Y-m-d');
        $sql = "SELECT p.*
                FROM promotions p, promotion_conditions c
                WHERE p.status = 1
                AND p.promotion_type = 'cart'
                AND (p.valid_period = 0 OR (p.valid_period = 1 AND
                    p.date_from <= '$today' AND p.date_to >= '$today'))
                AND p.promotion_id = c.promotion_id
                AND c.condition_type != 'coupon'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function check_coupon($coupon) {
    	$today = date('Y-m-d');
	    $sql = "SELECT c.*
	    		FROM promotion_conditions c, promotions p
	    		WHERE c.value = '$coupon'
	    		AND c.actual_usages < c.allowed_usages
	    		AND c.promotion_id = p.promotion_id
	    		AND p.status = 1
	    		AND (p.valid_period = 0 OR (p.valid_period = 1 AND
                    p.date_from <= '$today' AND p.date_to >= '$today'))";
         $query = $this->db->query($sql);
         return $query->first_row('array');
    }
	
}