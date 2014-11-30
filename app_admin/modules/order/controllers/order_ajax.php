<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('user/customer_model');
	}
	
	function add_comment()
	{
		$input = $this->input->post();
		
		$comments = array(
			'order_id' => $input['order_id'],
			'user_id' => 1,
			'commented_by' => 'admin',
			'comment' => $input['comment']
		);
		
		$comment_id = $this->order_model->insert_comment($comments);
		
		# If send email is checked
		if($input['send_email']){
			
				
		}
		
		if (is_int($comment_id))
		{
			# Page created successfully
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $input['order_id']
			));
		}
		else
		{
			# System error
			echo json_encode(array(
				'ok' => true,
				'success' => false,
				'msg' => $input['order_id']
			));
		}
	}
	
	function change_status()
	{
		$order_id = $this->input->post('order_id');
		$new_status = $this->input->post('new_status');
		
		$updated = $this->order_model->update_order($order_id,array('order_status' => $new_status));
		
		if ($updated === true)
		{
			echo json_encode(array(
				'ok' => true,
				'success' => true,
				'action' => $order_id
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
	
	function download_invoice()
	{
		$order_id = $this->input->post('order_id');
		$return_path = true;
		
		# As PDF creation takes a bit of memory, we're saving the created file in /uploads/pdf/
		$filename = "order_" . $order_id;
		$site_path = './';
		$upload_path = $site_path . 'uploads';
		if(!file_exists($upload_path .'/orders/'.$filename.'.pdf')){
			$pdfFilePath = $upload_path ."/orders/$filename.pdf";
			
			$dir = $upload_path .'/orders/';
			if(!is_dir($dir))
			{
			  mkdir($dir);
			  chmod($dir,0777);
			  $fp = fopen($dir.'/index.html', 'w');
			  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
			  fclose($fp);
			}
			 
			ini_set('memory_limit','128M'); # boost the memory limit if it's low 
			$order = $this->order_model->get_order($order_id);
			$data['customer'] = $this->customer_model->get_customer_by_user_id($order['user_id']);
			$data['comments'] = $this->order_model->get_comments($order_id);
	
			$data['order'] = $order;
			$data['order_items'] = $this->order_model->get_order_items($order_id);
			$html = $this->load->view('invoice/download', isset($data) ? $data : NULL, true);	
			
		
			$stylesheet = file_get_contents('./assets/admin/css/invoice-download.css');
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load(); 	
			$pdf->WriteHTML($stylesheet,1);		
			$pdf->WriteHTML($html,2);
			$pdf->Output($pdfFilePath, 'F'); // save to file 
			
			#var_dump($html); die();
		}
		if($return_path){
			echo base_url() . "uploads/orders/$filename.pdf";
		}else{
			redirect($upload_path . "/orders/$filename.pdf"); 
		}
	}
	
	function export_csv()
	{
		$params = $this->input->post();
		$orders = $this->order_model->search_order($params);
		
		# print_r($orders);die();return;
		$filename = "klop-orders.csv";
		  
		$csv = "";
		if($orders){
			$total = count($orders);
			foreach($orders as $order){
				$csv .=  "C" . "," . 
						" " . "," . 
						" " . "," . 
						"S1" . "," . 
						" " . "," . 
						$order['first_name'] . " " . $order['last_name'] . "," . 
						" " . "," . 
						$this->_clean_csv($order['address1']) . "," .
						$this->_clean_csv($order['address2']) . "," .
						" " . "," .
						" " . "," .  
						$order['suburb'] . "," .
						$order['state'] . "," .
						$order['postcode'] . "," .
						(strtolower($order['country']) == 'australia' ? "AU" : $order['country']) . "," .
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						"N" . "," .
						" " . "," . 
						" " . "," . 
						"N" . "," .
						" " . "," . 
						$order['order_id'] . "," .
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						"Klop Australia Pty Ltd" . "," .
						"1098 High St" . "," .
						" " . "," . 
						" " . "," . 
						" " . "," . 
						"ARMADALE" . "," .
						"VIC" . "," .
						"3143" . "," .
						"AU" . "," .
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						$order['email'] . "," .
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						" " . "," . 
						"Y" . "\r\n";
						
						# new line for the same order filled with constant values
				$csv .= "A" . "," .
						"4.2" . "," .
						"32" . "," .
						"21" . "," .
						"21" . "," .
						$this->order_model->get_order_qty($order['order_id']) . "\r\n";		
				
			}
				
		}else{
			echo 'No records found'; return;	
		}
		
		$dir = './uploads/orders/csv/';
		
		$path = $dir.$filename;
		if(!is_dir($dir)){
		  mkdir($dir);
		  chmod($dir,0777);
		  $fp = fopen($dir.'/index.html', 'w');
		  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
		  fclose($fp);
		}
		$fd = fopen ($path, "w");
		fputs($fd, $csv);
		fclose($fd);
		echo $total . ($total > 1 ? ' records' : ' record') . ' found and is ready for download. <a target="_blank" id="download-link" href="' . base_url() . 'uploads/orders/csv/' . $filename . '">Download Now</a>';
	}
	
	function _clean_csv($string){
		return str_replace(array("\r", "\r\n", "\n", ","), "-",$string);	
	}
	
	
	
	
}