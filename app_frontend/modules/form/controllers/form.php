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

}
