<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
	
	function error_message($function, $msg) {
		if (ENVIRONMENT == 'development')
		{
			return 'Database Error ' . $this->db->_error_number() . ': ' . $this->db->_error_message() . ' - Product_model.php - ' . $function . '()';
		}
		else
		{
			return $msg . '. Please contact webmaster';
		}
	}
	
	
	function get_products() {
		$query = $this->db->get('catalog_products');
		return $query->result_array();
	}
	
	function get_product($product_id) {
		$this->db->where('product_id', $product_id);
		$this->db->where('status > ', TRASHED);
		$query = $this->db->get('catalog_products');
		return $query->first_row('array');
	}
	
	function get_product_by_slug($slug) {
		$this->db->where('uri_path', $slug);
		$this->db->where('status > ', TRASHED);
		$query = $this->db->get('catalog_products');
		return $query->first_row('array');
	}
	
	function get_images($product_id) {
		$sql = "SELECT u.* FROM upload_objects p
					LEFT JOIN uploads u ON u.upload_id = p.upload_id
				WHERE object_name = 'product_image'
				AND p.status > " . TRASHED . "
				AND p.object_id = $product_id
				ORDER BY object_order ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_hero($product_id)
	{
		$sql = "SELECT u.* FROM upload_objects p
					LEFT JOIN uploads u ON u.upload_id = p.upload_id
				WHERE object_name = 'product_image'
				AND p.status > " . TRASHED . "
				AND p.object_id = ".$product_id." 
				ORDER BY p.object_order ASC 
				LIMIT 1";
		$query = $this->db->query($sql);
		return $query->first_row('array');	
	}
	
	function get_products_by_category($params)
	{
		if(isset($params['records_per_page'])){
			$records_per_page = $params['records_per_page'];	
		}
		
		$sql = "SELECT p.* FROM catalog_products p
				   WHERE p.product_id IN 
				   	 	(SELECT product_id FROM catalog c
							WHERE c.category_id = ".$params['category_id'].")";
							
		# sort records
		if(isset($params['order']) && $params['order']){
			$sql .= "ORDER by " . $params['order'] . " ASC";
		}
		
		# limit the records if necessary						
		if(isset($params['cur_page']) && $params['records_per_page']){
			$sql .= " LIMIT ".(($params['cur_page']-1)*$records_per_page)." ,".$records_per_page;	
		}
		
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	


	
	
}