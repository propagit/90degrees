<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}
	
	function add_item()
	{
		$post = $this->input->post();
		# if cart already has this product increase the quantity by given quantity
		# this is not a udate process but simply an increment of the quantity
		if(modules::run('cart/is_duplicate',$post['id'])){
			$rowid = modules::run('cart/increment_qty',$post);
		# else add new item to the cart
		}else{
			$rowid = modules::run('cart/insert_item',$post);
		}
		
		echo $rowid;
	}
	
	function update()
	{
		$out['status'] = false;
		$data = $this->input->post('data');
		if(isset($data) && count($data) > 0){
			foreach($data as $key => $val){
				$cart_data['rowid'] = $key;
				$cart_data['qty'] = $val;
				$this->cart->update($cart_data);
			}
			$out['status'] = true;
		}
		echo json_encode($out);
	}
	
	function delete_item()
	{
		$out['status'] = false;
		$rowid = $this->input->post('rowid');
		# set qty to zero and it will remove the item
		$data = array(
					'rowid' => $rowid,
					'qty' => 0
					);
		if($this->cart->update($data)){
			$out['status'] = true;	
		}
		echo json_encode($out);
	}
	
	function rightbar_cart()
	{
		echo modules::run('cart/rightbar_cart',true);	
	}
	
	
	function menu()
	{
		$this->load->view('menu', isset($data) ? $data : NULL);
	}
	
	function mob_cart()
	{
		$this->load->view('mob_cart', isset($data) ? $data : NULL);	
	}
	
}