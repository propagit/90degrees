<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_ajax extends MX_Controller {

	function set_layout(){
		$layout = $this->input->post('layout');
		$this->session->set_userdata('layout',$layout);
		echo $layout;	
	}
	

}