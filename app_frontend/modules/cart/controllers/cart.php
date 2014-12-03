<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('promotion_model');
		$this->load->model('promotion_condition_model');
	}
	
	function index()
	{
		
		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
			array('url' => '#', 'label' => 'Cart'),
		)); 
		#$data['add_css'] = $this->load->view('product/css', isset($data) ? $data : NULL, true);
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('cart/details', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	
	function insert_item($params)
	{
		$id = $params['id'];
		$qty = $params['qty'];
		
		$product = modules::run('catalog/product/id', $id);
		$discount = modules::run('promotion/apply_product_promotions', $id);
		
		$price = $product['price'];
		if ($product['sale_price'] > 0 && $product['sale_price'] < $product['price'])
		{
			$price = $product['sale_price'];
		}
		if ($discount)
		{
			$price = $product['price'] - $discount;
		}
		
		$data = array(
				 	'id' => $id,
					'qty' => $qty,
					'price' => $price,
					'name' => $product['name'],
					'uri_path' => $product['uri_path']
					);
		# this returns rowid
		return $this->cart->insert($data);
	}
	
	function is_duplicate($id)
	{
		$items = $this->cart->contents();
		if($items){
			foreach($items as $item){
				if($item['id'] == $id){
					return true;
				}
			}
		}
		return false;
	}


	function increment_qty($params)
	{
		$id = $params['id'];
		$new_qty = $params['qty'];
		$rowid = $params['rowid'];
		$cart_items = $this->cart->contents();
		if($cart_items){
			foreach($cart_items as $item){
				if($item['id'] == $id){
					$rowid = $item['rowid'];
					$cur_qty = $item['qty'];
					$data = array(
              			 'rowid' => $rowid,
               			 'qty'   => $cur_qty+$new_qty,
           		 	);
					return $this->cart->update($data);
				}
			}
		}
		return false;

	}
	
	function rightbar_cart($enable_coupon = false)
	{
		$promotions = $this->promotion_model->get_cart_promotions();
		$applied_promotions = array();
		$has_coupon = false;
		$coupon = $this->session->userdata('coupon');
		foreach($promotions as $promotion)
		{
			$conditions = $this->promotion_condition_model->get_promotion_conditions($promotion['promotion_id']);
			if (count($conditions) == 0)
			{
				$applied_promotions[] = $promotion;
			}
			else
			{
				$satisfied = 0;
				foreach($conditions as $condition)
				{
					if ($condition['condition_type'] == 'order'
						&& $condition['value'] <= $this->get_total())
					{
						$satisfied++;
					}
					if ($condition['condition_type'] == 'coupon'
						&& $condition['actual_usages'] < $condition['allowed_usages'])
					{
						if ($condition['value'] == $coupon)
						{
							$satisfied++;
						}
						else
						{
							$has_coupon = true;
						}
					}
				}
				if ($satisfied == count($conditions))
				{
					$applied_promotions[] = $promotion;
				}
			}
		}
		
		$coupon = $this->session->userdata('coupon');
		$condition = $this->promotion_model->check_coupon($coupon);
		if ($condition) {
			$promotion = $this->promotion_model->get_promotion($condition['promotion_id']);
			if ($promotion) {
				$applied_promotions[] = $promotion;
			}
		}
		
		
		$data['has_coupon'] = $has_coupon;
		$data['promotions'] = $applied_promotions;
		
		$data['enable_coupon'] = $enable_coupon;
		return $this->load->view('rightbar_cart_summary',isset($data) ? $data : NULL, true);	
	}
	
	function get_contents()
	{
		return $this->cart->contents();
	}
	
	function get_total()
	{
		return $this->cart->total();	
	}
	
	function get_total_items()
	{
		return $this->cart->total_items();	
	}
	
	function destroy()
	{
		$this->cart->destroy();	
		$this->destroy_coupons();
	}
	
	function destroy_coupons()
	{
		$this->session->unset_userdata('coupon');
		$this->session->unset_userdata('condition_id');
		$this->session->unset_userdata('discount_amount');	
	}
	
	function get_mini_cart(){
		return $this->load->view('mini_cart_container',true);	
	}
	
	
}