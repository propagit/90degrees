<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order/order_model');
	}
	
	function send_password_reset($data)
	{
		
		$message = $this->load->view('forgot_password',$data,true);
		$email_data = array(
				'to' => $data['email'],
				'from' => NO_REPLY_EMAIL,
				'from_text' => 'Password Reset - '.SITE_NAME,
				'subject' => 'Your password for [ '.base_url().' ] has been changed',
				'message' => $message
				);
		$this->send_email($email_data);	
	}
	
	function send_contact_us($data)
	{
		$message = $this->load->view('contact_us',$data,true);
		$email_data = array(
				'to' => INFO_EMAIL,
				'from' => NO_REPLY_EMAIL,
				'from_text' => 'Contact Form Message - '.SITE_NAME,
				'subject' => 'A contact us notification was received from [ '.base_url().' ] at '.date('d/m/Y h:i a'),
				'message' => $message
				);
		$this->send_email($email_data);		
	}	
	
	function send_order_confirmation($data)
	{
		$order_id = $data['order_id'];
		$order_data['order'] = $this->order_model->get_order($order_id);
		$order_data['order_items'] = $this->order_model->get_order_items($order_id);
		$message = $this->load->view('order_confirmation',$order_data,true);
		
		$email_data = array(
				'to' => $data['email_to'],
				'from' => NO_REPLY_EMAIL,
				'from_text' => 'Order Confirmation - '.SITE_NAME,
				'subject' => '[' . SITE_NAME . '] Purchase Confirmation , Order ID [' . $order_id . ']',
				'message' => $message
				);
		$this->send_email($email_data);		
	}
	
	function _test()
	{
		$order_id = 8;
		$order_data['order'] = $this->order_model->get_order($order_id);
		$order_data['order_items'] = $this->order_model->get_order_items($order_id);
		$message = $this->load->view('order_confirmation',$order_data,true);
		
		$email_data = array(
				'to' => 'kaushtuv@propagate.com.au',
				'from' => NO_REPLY_EMAIL,
				'from_text' => 'Order Confirmation - '.SITE_NAME,
				'subject' => '[' . SITE_NAME . '] Purchase Confirmation , Tax Invoice [' . $order_id . ']',
				'message' => $message
				);
		$this->send_email($email_data);
	}
	
	
	/**
	*	@name: send_email
	*	@desc: A central function to send email
	*	@access: public
	*	@param: (array) email data
	*/
	function send_email($data)
	{
		#if(LIVE_SERVER){
		#	$this->send_email_live($data);
		#}else{
			$this->send_email_localhost($data);
		#}
	}

	/**
	*	@name: send_email_live
	*	@desc: A central function to send all email in live server
	*	@access: public
	*	@param: (array) email data
	*/
	function send_email_live($data)
	{
		$to = '';
		$from = '';
		$cc = '';
		$bcc = '';
		$from_text = '';
		$subject = ''; 
		$message = ''; 
		$attachment = ''; 
		$bcc = '';
		if($data){
			foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($from,$from_text);		
			$this->email->to($to);
			$this->email->cc($cc);
			$this->email->bcc($bcc);
			$this->email->subject($subject);
			
			$email_signature = $this->load->view('email_signature', isset($data) ? $data : NULL,true);
			$this->email->message($message .'<br />' . $email_signature);
			if($attachment){
				if(is_array($attachment)){
					foreach($attachment as $attach){
						$this->email->attach($attach);
					}
				}else{
					$this->email->attach($attachment);	
				}
			}
			$this->email->send();
			$this->email->clear(true);	
			return true;
					
		} else {
			return false;	
		}
		

	}
	
	/**
	*	@desc Test function to send email from localhost
	*
	*   @name send_email
	*	@access public
	*	
	*/
	function send_email_localhost($data)
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'propagate.au@gmail.com', // change it to yours
		  'smtp_pass' => 'm0r3m0n3Y', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
		$to = '';
		$from = '';
		$cc = '';
		$bcc = '';
		$from_text = '';
		$subject = ''; 
		$message = ''; 
		$attachment = ''; 
		$bcc = '';
		
		if($data){
		foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		}
		

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('propagate.au@gmail.com',$from_text); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject($subject);
		$email_signature = $this->load->view('email_signature', isset($data) ? $data : NULL,true);
		$this->email->message($message .'<br />' . $email_signature);
			
			
		if($attachment){
			if(is_array($attachment)){
				foreach($attachment as $attach){
					$this->email->attach($attach);
				}
			}else{
				$this->email->attach($attachment);	
			}
		}
		/*if($attachment){
			$this->email->attach('./uploads/forms/o_19c097fppdjd1uel4q21ntach9c.jpg');	
		}*/
		if($this->email->send()){
		  	echo 'Email sent.';
		}else{
			show_error($this->email->print_debugger());
		} 
	}
	
	function test()
	{
		echo realpath(dirname(__FILE__));	
	}
	
	
	
}