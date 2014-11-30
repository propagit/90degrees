<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

    function search_products($params = array()) {
        $this->db->where('status >', 0);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('catalog_products');
        return $query->result_array();
    }

    function get_product($product_id) {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('catalog_products');
        return $query->first_row('array');
    }

    function update_product($product_id, $data) {
        $this->db->where('product_id', $product_id);
        return $this->db->update('catalog_products', $data);
    }

    function reset_product_sale_price() {
        return $this->db->update('catalog_products', array('sale_price' => 0));
    }
}
