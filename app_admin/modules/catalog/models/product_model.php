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
	
	function prepare_product_data($data) {
		if($data['uri_path'] == '') {
			$data['uri_path'] = url_title($data['name']);
		}
		$data['updated_on'] = date('Y-m-d H:i:s');
		return $data;
	}
	
	function insert_product($data) {
		$data = $this->prepare_product_data($data);
		if($this->db->insert('catalog_products', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->error_message('insert_product', 'There was error while adding new product.');
		}
	}
	
	function update_product($product_id, $data)
	{
		$this->db->where('product_id', $product_id);
		if ($this->db->update('catalog_products', $data))
		{
			return true;
		}
		else
		{
			return $this->error_message('update_product', 'There was error while updating this product.');
		}
	}
	
	function get_products() {
		$this->db->where('status >',-1);
		$query = $this->db->get('catalog_products');
		return $query->result_array();
	}
	
	function get_product($product_id) {
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('catalog_products');
		return $query->first_row('array');
	}
	
	function add_image($product_id, $upload_id) {
		$data = array(
			'upload_id' => $upload_id,
			'object_name' => 'product_image',
			'object_id' => $product_id
		);
		if ($this->db->insert('upload_objects', $data)) 
		{
			return $this->db->insert_id();
		} 
		else  
		{
			return $this->error_message('add_image','There was error while adding this product image.');
		}
	}
	
	function get_images($product_id) {
		$sql = "SELECT u.* FROM upload_objects p
					LEFT JOIN uploads u ON u.upload_id = p.upload_id
				WHERE object_name = 'product_image'
				AND p.status > " . TRASHED . "
				AND p.object_id = $product_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function trash_image($upload_id) {
		$this->db->where('upload_id', $upload_id);
		$this->db->where('object_name', 'product_image');
		if ($this->db->update('upload_objects', array('status' => TRASHED)))
		{
			return true;
		}
		else
		{
			return $this->error_message('trash_image', 'There was error while trashing this product image.');
		}
	}
	
	function get_categories($product_id) {
		$sql = "SELECT category_id FROM catalog WHERE product_id = " . $product_id;
		$query = $this->db->query($sql);
		$category_ids = array();
		foreach($query->result_array() as $r) {
			$category_ids[] = $r['category_id'];
		}
		return $category_ids;
	}
	
	function update_category($product_id, $category_id) {
		$this->db->where('product_id', $product_id);
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('catalog');
		if (!$query) {
			return $this->error_message('update_category', 'There was error while updating this catalog.');
		}
		$result = $query->first_row('array');
		if ($result) 
		{
			# Delete
			$this->db->where('id', $result['id']);
			if ($this->db->delete('catalog'))
			{
				return (int) $result['id'];
			}
			else
			{
				return $this->error_message('update_category', 'There was error while updating this catalog.');
			}
		}
		else
		{
			# Add
			$data = array(
				'product_id' => $product_id,
				'category_id' => $category_id
			);
			if ($this->db->insert('catalog', $data))
			{
				return $this->db->insert_id();
			}
			else
			{
				return $this->error_message('update_category', 'There was error while updating this catalog.');
			}
		}
	}
	
	function get_product_categories($product_id)
	{
		$sql = "SELECT cc.* FROM catalog_categories cc 
				WHERE cc.category_id IN 
					(SELECT DISTINCT c.category_id FROM catalog c WHERE
						c.product_id = ".$product_id.")
				ORDER BY cc.name ASC";
						
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}