<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_ajax extends MX_Controller {
	
	
	 function __construct()
    {
        parent::__construct();
        $this->load->model('promotion_model');
        $this->load->model('promotion_condition_model');
		$this->load->model('product_model');
    }

    function create()
    {
        $input = $this->input->post();
		
		$rules = array(
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
		);

		$errors = modules::run('common/validate_input', $input, $rules);
		
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}

        $data = array(
                'promotion_type' => $input['promotion_type'],
                'name' => $input['name'],
                'description' => $input['description'],
                'discount_type' => $input['discount_type'],
                'discount_value' => $input['discount_value'][$input['discount_type']],
                'valid_period' => 0,
                'date_from' => '',
                'date_to' => ''
            );
        if (isset($input['valid_period']))
        {
            $data['valid_period'] = 1;
            $data['date_from'] = date('Y-m-d', strtotime($input['date_from']));
            $data['date_to'] = date('Y-m-d', strtotime($input['date_to']));
        }
		if(isset($input['status'])){
			$data['status'] = 1;	
		}

        $promotion_id = $this->promotion_model->insert_promotion($data);
        if (is_int($promotion_id))
		{
			# Promotion created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $promotion_id
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $promotion_id
			));
		}
    }

    function update_basic()
    {
        $input = $this->input->post();

		$rules = array(
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
		);

		$errors = modules::run('common/validate_input', $input, $rules);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}
	
        $data = array(
                'promotion_type' => $input['promotion_type'],
                'name' => $input['name'],
                'description' => $input['description'],
                'discount_type' => $input['discount_type'],
                'discount_value' => $input['discount_value'][$input['discount_type']],
                'valid_period' => 0,
                'date_from' => '',
                'date_to' => ''
            );
			
        if(isset($input['valid_period'])){
            $data['valid_period'] = 1;
            $data['date_from'] = date('Y-m-d', strtotime($input['date_from']));
            $data['date_to'] = date('Y-m-d', strtotime($input['date_to']));
        }
		
		if(isset($input['status'])){
			$data['status'] = 1;	
		}
		
		$promotion_id = $input['promotion_id'];
		$updated = $this->promotion_model->update_promotion($promotion_id, $data);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $promotion_id
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}
        
    }
	
	function update_conditions()
	{
		$input = $this->input->post();
		$promotion_id = $input['promotion_id'];
		$conditions = $input['conditions'];
		$usages = array();
		if (isset($input['usages']))
		{
			$usages = $input['usages'];
		}
		foreach($conditions as $condition_id => $value)
		{
			if (is_array($value)) # condition_type: product
			{
				foreach($value as $product_id)
				{
					$product = $this->product_model->get_product($product_id);
					$price = $product['price'];
					$discount_value = $data['discount_value'];
					if ($data['discount_type'] == 'percentage')
					{
						$discount_value = $product['price'] * $discount_value / 100;
					}
					$sale_price = $product['price'] - $discount_value;
					$this->product_model->update_product($product_id, array('sale_price' => $sale_price));
				}
				$value = serialize($value);
			}
			$condition_data = array('value' => $value);
			if (isset($usages[$condition_id]))
			{
				$condition_data['allowed_usages'] = $usages[$condition_id];
			}

			$this->promotion_condition_model->update_promotion_condition($condition_id, $condition_data);
		}	
		
		echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $promotion_id
			));
	}
	
	function change_status()
	{
		$promotion_id = $this->input->post('promotion_id');
		$trashed = $this->input->post('trashed');
		
		
		# If not trashed
		if(!$trashed){
			$promotion = $this->promotion_model->get_promotion($promotion_id);
			$new_status = $promotion['status'] ? 0 : 1;
		}else{
			# If trashed set status to -1
			$new_status = -1;	
		}
		
		$updated = $this->promotion_model->update_status($promotion_id,$new_status);
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $promotion_id
			));
		}
		else
		{
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $updated
			));
		}
	}
	
	function reset_conditions()
    {
		$input = $this->input->post();
		$promotion_id = $input['promotion_id'];
        $data = array(
                'promotion_type' => $input['promotion_type']
				);
		$this->promotion_model->update_promotion($promotion_id,$data);
		
        $promotion_id = $this->input->post('promotion_id');
        $this->promotion_condition_model->delete_promotion_conditions($promotion_id);
		
		return;
    }
	
	function add_condition()
    {
        $input = $this->input->post();
        $promotion_condition_id = $this->promotion_condition_model->add_promotion_condition($input);
    }

    function list_conditions()
    {
        $conditions = $this->promotion_condition_model->get_promotion_conditions($this->input->post('promotion_id'));

        foreach($conditions as $condition)
        {
            $data['condition'] = $condition;
            $this->load->view('condition/' . $condition['condition_type'] . '_view', isset($data) ? $data : NULL);
        }
    }

    function delete_condition()
    {
        $condition_id = $this->input->post('condition_id');
        $this->promotion_condition_model->delete_promotion_condition($condition_id);
    }

	function list_products()
    {
        $condition_id = $this->input->post('condition_id');
        $condition = $this->promotion_condition_model->get_promotion_condition($condition_id);
        $data['products'] = $this->product_model->search_products();
        $data['condition'] = $condition;
        $data['promotion'] = $this->promotion_model->get_promotion($condition['promotion_id']);
        $this->load->view('condition/product/table_view', isset($data) ? $data : NULL);
    }

    
	
}