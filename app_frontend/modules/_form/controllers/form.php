<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');
    }


    function index($form_id)
    {
        $form = $this->form_model->get_form($form_id);
        if (!$form) {
            show_404();
        }
        if ($form['captcha']) {
            $data['captcha'] = $this->generate_captcha();
        }
        $fields = $this->form_model->get_fields($form_id);
        $data['form'] = $form;
        $data['fields'] = $fields;
        $this->load->view('main_view', isset($data) ? $data : NULL);
    }

    function field($field=array())
    {
        $data['field'] = $field;
        $this->load->view('field/' . $field['type'], isset($data) ? $data : NULL);
    }

    function generate_captcha()
    {
        $this->load->helper('captcha');

        # Setup vals to pass into the create_captcha function
        $vals = array(
            'img_path' => CAPTCHA_PATH,
            'img_url' => base_url() . CAPTCHA_PATH,
            'img_height' => 66,
            'img_width' => 225
        );
        # Generate the captcha
        $captcha = create_captcha($vals);
        # Store the captcha value in a session to retrieve later
        $this->session->set_userdata('captcha_word', $captcha['word']);
        return $captcha;
    }
	
	function submit()
	{
		print_r($_POST);
	}
}
