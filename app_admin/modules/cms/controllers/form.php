<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');
    }

    function index()
    {
        $data['forms'] = $this->form_model->get_forms();
        $this->load->view('form/table_view', isset($data) ? $data : NULL);
    }

    function create()
    {
        $data['tab'] = 'basic';
        $this->load->view('form/form_view', isset($data) ? $data : NULL);
    }

    function edit($form_id, $tab = 'fields')
    {
        $form = $this->form_model->get_form($form_id);
        if (!$form)
        {
            show_404();
        }
        $data['form'] = $form;
        $data['tab'] = $tab;
        $this->load->view('form/form_view', isset($data) ? $data : NULL);
    }


}
