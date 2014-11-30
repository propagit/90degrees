<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_model extends CI_Model {
		
	
    function get_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get('promotions');
        return $query->first_row('array');
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
    
    function get_product_promotions()
    {
	    $today = date('Y-m-d');
        $sql = "SELECT p.*
                FROM promotions p, promotion_conditions c
                WHERE p.status = 1
                AND p.promotion_type = 'catalog'
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