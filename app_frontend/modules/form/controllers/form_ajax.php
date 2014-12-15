<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');

    }

    function refresh_captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => CAPTCHA_PATH,
            'img_url' => base_url() . CAPTCHA_PATH,
            'img_height' => 34
        );
        # Generate the captcha
        $captcha = create_captcha($vals);
        # Store the captcha value in a session to retrieve later
        $this->session->set_userdata('captcha_word', $captcha['word']);
        echo $captcha['image'];
    }

    function submit()
    {
        $input = $this->input->post();
        $form_id = $input['form_id'];
        $form = $this->form_model->get_form($form_id);
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
        if ($form['captcha']) {
            $rules[] = array(
                'field' => 'field-captcha',
                'label' => 'Code',
                'rules' => 'required'
            );
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

        $captcha_word = $this->session->userdata('captcha_word');
        if ($captcha_word != $input['field-captcha']) {
            # User input error
            $errors[] = array('field' => 'field-captcha', 'msg' => 'Wrong code');
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }


        if ($form['storing']) {
            # Save to database
        }

        if ($form['email']) {
            # Send email
            $message = '';
            foreach($fields as $field) {
                $field_name = 'field-' . $field['field_id'];
                if (isset($input[$field_name])) {
                    $message .= '<p>' . $field['label'] . ': ' . $input[$field_name] . '</p>';
                }
            }
            modules::run('email/send_email', array(
                'to' => $form['email'],
                'from' => NO_REPLY_EMAIL,
                'from_text' => SITE_NAME,
                'subject' => $form['name'],
                'message' => $message
                ));
        }

        echo json_encode(array(
            'ok' => true,
            'success' => true,
            'action' => 'Thank You'
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
