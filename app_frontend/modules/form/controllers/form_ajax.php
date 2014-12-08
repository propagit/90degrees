<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');

    }

    function submit()
    {
        $input = $this->input->post();
        $form_id = $input['form_id'];
        $fields = $this->form_model->get_fields($form_id);

        $rules = array();
        foreach($fields as $field) {
            if ($field['required']) {
                $rules[] = array(
                    'field' => 'field-' . $field['field_id'],
                    'label' => $field['label'],
                    'rules' => 'required'
                );
            }
        }

        # Validat user data
        $errors =  modules::run('common/validate_input', $input, $rules);

        # If data invalid
        if (count($errors) > 0) {
            # User input error
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }

        # Now sending the form
        echo json_encode(array(
                'ok' => true,
                'success' => true,
                'msg' => 'Your message has been successfully sent'
            ));
    }

    function send_contact_message()
    {
        $input = $this->input->post();


        $rules = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|email'),
            array('field' => 'security', 'label' => 'Security Question', 'rules' => 'required'),
            array('field' => 'message', 'label' => 'Message', 'rules' => 'required')
        );

        # Validat user data
        $errors =  modules::run('common/validate_input', $input, $rules);

        # If data invalid
        if (count($errors) > 0) {
            # User input error
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }

        # Check if security value is 4

        if(trim($input['security']) != '4'){
            $errors[] = array('field' => 'security', 'msg' => 'The number of letters you have entered is incorrect');
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }


        modules::run('email/send_contact_us',$input);

        echo json_encode(array(
                'ok' => true,
                'success' => true,
                'msg' => 'Your message has been successfully sent'
            ));

    }


}
