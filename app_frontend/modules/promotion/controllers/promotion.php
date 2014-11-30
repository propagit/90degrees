<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('promotion_model');
		$this->load->model('promotion_condition_model');
	}
	
	function apply_product_promotions($product_id)
	{
		$product = modules::run('catalog/product/id', $product_id);
		$discount = 0;
		$promotions = $this->promotion_model->get_product_promotions();
		foreach($promotions as $promotion)
		{
			$conditions = $this->promotion_condition_model->get_promotion_conditions($promotion['promotion_id']);
			foreach($conditions as $condition)
			{
				if (in_array($product['product_id'], unserialize($condition['value'])))
				{
					if ($promotion['discount_type'] == 'fixed')
					{
						$discount += $promotion['discount_value'];
					}
					else
					{
						$discount += $promotion['discount_value'] * $product['price'] / 100;
					}
				}
			}
		}
		#var_dump($discount);
		return $discount;
	}
	
}