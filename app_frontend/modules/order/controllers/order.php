<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('eway_model');
	}	
	
	function process_payment()
	{
		$card = $this->input->post();
		$user_id = $this->session->userdata('user_id');
		$delivery_add = $this->session->userdata('delivery_address');
		
		$email = modules::run('customer/get_username',$user_id);
		
		# discount
		$discount = 0;
		if($this->session->userdata('discount_amount')){
			$discount = 	$this->session->userdata('discount_amount');
		}

		
		$total = modules::run('cart/get_total');
		$total = $total - $discount;
		# $total = 1000;
		
		# remove decimal 
		$total = $total * 100;

		$order_id = modules::run('order/add_order');
		
			
		# run payment validation here
		$payment_params = array(
							'order_id' => $order_id,
							'first_name' => $delivery_add['first_name'],
							'last_name' => $delivery_add['last_name'],
							'email' => $email,
							'address' => $delivery_add['address1'] . $delivery_add['address2'],
							'postcode' => $delivery_add['postcode'],
							'cardname' => $card['card_name'],
							'cardnumber' => $card['card_number'],
							'expmonth' => $card['exp_month'],
							'expyear' => $card['exp_year'],
							'cvv' => $card['cvv'],
							'total' => $total,
							'invoice_head' => 'KLOP INVOICE'	
						);

		$ewayResponseFields = $this->_process_eWay($payment_params);
		
		# print_r($ewayResponseFields);exit;
		
		if(strtolower($ewayResponseFields["EWAYTRXNSTATUS"])=="true"){
			# if payment successful distroy cart and $this->session->userdata('delivery_address');
			# and redirect successful page
			$this->empty_vars();
			$this->order_model->update($order_id,array('order_status' => 'paid', 'gateway_message' => json_encode($ewayResponseFields)));	

			# send order confirmation
			$email_data = array(
								'order_id' => $order_id,
								'email_to' => $email
								);
			modules::run('email/send_order_confirmation',$email_data);
		
			# send order notification	
			
			$this->session->set_flashdata('cur_order_id',$order_id);
			$email_data = array(
								'order_id' => $order_id,
								'email_to' => SALES_EMAIL
								);
			modules::run('email/send_order_confirmation',$email_data);
			
			redirect('cart/checkout/confirm');	
				
		}else if (strtolower($ewayResponseFields["EWAYTRXNSTATUS"])=="false") {
			# transaction failed
			$this->order_model->update($order_id,array('order_status' => 'failed', 'gateway_message' => json_encode($ewayResponseFields)));	

			redirect('cart/checkout/failed');	
		}
		else {
			# mark this as failed transaction as well
			$this->order_model->update($order_id,array('order_status' => 'failed', 'gateway_message' => json_encode($ewayResponseFields)));
			
			redirect('cart/checkout/failed');	
		}
		
		
		
	}
	
	function empty_vars()
	{
		modules::run('cart/destroy');
		$this->session->unset_userdata('delivery_address');	
		$this->session->unset_userdata('agreed_to_terms');
	}
	
	function add_order()
	{
		$card = $this->input->post();
		$delivery_add = $this->session->userdata('delivery_address');
		$user_id = $this->session->userdata('user_id');
		
		# Get email
		$email = modules::run('customer/get_username',$user_id);
		
		# discount
		$discount = 0;
		if($this->session->userdata('discount_amount')){
			$discount = 	$this->session->userdata('discount_amount');
		}

		# coupon code
		$coupon_code = 'coupon';
		if($this->session->userdata('coupon')){
			$coupon_code = 	$this->session->userdata('coupon');
		}
		
		$total = modules::run('cart/get_total');
		
		$total = $total - $discount;

		$cc_lastfour = '****'.substr($card['card_number'],-4,4);

		$tax = $total / 11;
		$subtotal = $total - $tax;
		




		$order_data = array(
							'user_id' => $user_id,
							'first_name' => $delivery_add['first_name'],
							'last_name' => $delivery_add['last_name'],
							'email' => $email,
							'mobile' => $delivery_add['mobile'],
							'phone' => $delivery_add['phone'],
							'address1' => $delivery_add['address1'],
							'address2' => $delivery_add['address2'],
							'country' => $delivery_add['country'],
							'state' => $delivery_add['state'],
							'suburb' => $delivery_add['suburb'],
							'postcode' => $delivery_add['postcode'],
							'payment_type' => 'Credit Card',
							'card_number' => $cc_lastfour,
							'card_name' => $card['card_name'],
							'order_status' => 'processing',
							'subtotal' => $subtotal,
							'total' => $total,
							'tax' => $tax,
							'discount' => $discount,
							'coupon_code' => $coupon_code
							);
		$order_id = $this->order_model->insert_order($order_data);
		
		if(is_int($order_id)){
			# Add order comment
			if(isset($delivery_add['order_comment'])){
				$order_comment = array(
								'order_id' => $order_id,
								'user_id' => $user_id,
								'commented_by' => 'customer',
								'comment' => $delivery_add['order_comment']
								);
				$this->order_model->insert_comment($order_comment);
			}
			if(modules::run('order/add_order_items',$order_id)){
				return $order_id;
			}else{
				return false;
			}
		}
	}

	function add_order_items($order_id)
	{
		$count = 0;
		$today = date('Y-m-d');
		if($order_id){
			$cart_items = modules::run('cart/get_contents');
			if($cart_items){
				foreach($cart_items as $item){
					$order_items = array(
										'order_id' => $order_id,
										'product_id' => $item['id'],
										'product_name' => $item['name'],
										'product_uri' => $item['uri_path'],
										'quantity' => $item['qty'],
										'price' => $item['price'],
										'attributes' => json_encode($item['options']),
										);
					if($this->order_model->insert_order_items($order_items)){
						$count++;
					}
				}
			}
		}
		return $count;
	}
	
	# EWAY Process Payment
	function _process_eWay($params) {
		
		$order_id = $params['total'];
		$firstname = $params['first_name'];
		$lastname = $params['last_name'];
		$email = $params['email'];
		$address = $params['address'];
		$postcode = $params['postcode'];
		$cardname = $params['cardname'];
		$cardnumber = $params['cardnumber'];
		$expmonth = $params['expmonth'];
		$expyear = $params['expyear'];
		$cvv = $params['cvv'];
		$total = $params['total'];
		$invoice_head = $params['invoice_head'];
		
		# Payment config
		# $eWAY_CustomerID = "87654321"; // eWAY Customer ID - Test
		$eWAY_CustomerID = "18781442"; // eWAY Customer ID - Live
		$eWAY_PaymentMethod = 'REAL_TIME_CVN'; // payment gatway to use (REAL_TIME, REAL_TIME_CVN or GEO_IP_ANTI_FRAUD)
		$eWAY_UseLive = true; // true to use the live gateway

		$this->load->model('Eway_model');
		$this->Eway_model->init($eWAY_CustomerID, $eWAY_PaymentMethod, $eWAY_UseLive);

		# Set the payment details
		$this->Eway_model->setTransactionData("TotalAmount", $total); //mandatory field
		$this->Eway_model->setTransactionData("CustomerFirstName", $firstname);
		$this->Eway_model->setTransactionData("CustomerLastName", $lastname);
		$this->Eway_model->setTransactionData("CustomerEmail", $email);
		$this->Eway_model->setTransactionData("CustomerAddress", $address);
		$this->Eway_model->setTransactionData("CustomerPostcode", $postcode);
		$this->Eway_model->setTransactionData("CustomerInvoiceDescription", $invoice_head);
		$this->Eway_model->setTransactionData("CustomerInvoiceRef", "INV" . $order_id); # Order reference
		$this->Eway_model->setTransactionData("CardHoldersName", $cardname); # mandatory field
		$this->Eway_model->setTransactionData("CardNumber", $cardnumber); # mandatory field
		$this->Eway_model->setTransactionData("CardExpiryMonth", $expmonth); # mandatory field
		$this->Eway_model->setTransactionData("CardExpiryYear", $expyear); # mandatory field
		$this->Eway_model->setTransactionData("TrxnNumber", "TRXN".$order_id);
		$this->Eway_model->setTransactionData("Option1", "");
		$this->Eway_model->setTransactionData("Option2", "");
		$this->Eway_model->setTransactionData("Option3", "");
		$this->Eway_model->setTransactionData("CVN", $cvv);
		$this->Eway_model->setCurlPreferences(CURLOPT_SSL_VERIFYPEER, 0); // Require for Windows hosting

		return $this->Eway_model->doPayment();
		
	}
	
	
}