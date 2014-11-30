<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('user/customer_model');
	}
	
	function index()
	{
		$data['orders'] = $this->order_model->get_all();
		$this->load->view('table_view', isset($data) ? $data : NULL);
	}
	
	function view($order_id)
	{
		$data['invoice_link'] = $this->generate_invoice($order_id);
		$order = $this->order_model->get_order($order_id);
		$data['customer'] = $this->customer_model->get_customer_by_user_id($order['user_id']);
		$data['comments'] = $this->order_model->get_comments($order_id);
	
		$data['order'] = $order;
		$data['order_items'] = $this->order_model->get_order_items($order_id);
		$this->load->view('invoice/details', isset($data) ? $data : NULL);	
	}
	
	function get_todays_order()
	{
		return $this->order_model->get_order_count_by_date(date('Y-m-d'));	
	}
	
	
	function generate_invoice($order_id)
	{
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

		return base_url() . "uploads/orders/$filename.pdf";

	}
	
	function get_order_items($order_id)
	{
		return $this->order_model->get_order_items($order_id);
	}
	
	function export()
	{
		$this->load->view('export_form', isset($data) ? $data : NULL);		
	}
	
	
	function _test()
	{
		$order_id = 8;
		$order = $this->order_model->get_order($order_id);
		$data['customer'] = $this->customer_model->get_customer_by_user_id($order['user_id']);
		$data['comments'] = $this->order_model->get_comments($order_id);

		$data['order'] = $order;
		$data['order_items'] = $this->order_model->get_order_items($order_id);
		$this->load->view('invoice/download', isset($data) ? $data : NULL);	
				
	}
	
	
	
	
}