<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');
    }


    function create()
    {
        $input = $this->input->post();

        $rules = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
        );

        $errors = modules::run('common/validate_input', $input, $rules);

        if (count($errors) > 0) {
            # User input error
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }

        $form_data = array(
            'name' => $input['name'],
            'email' => $input['email'],
            'storing' => isset($input['storing']) ? 1 : 0
        );
        $form_id = $this->form_model->insert_form($form_data);

        if (is_int($form_id))
        {
            # Form created successfully
            echo json_encode(array(
                'ok' => true,
                'success' => true,
                'action' => $form_id
            ));
        }
        else
        {
            # System error
            echo json_encode(array(
                'ok' => true,
                'success' => false,
                'msg' => $form_id
            ));
        }

    }

    function update($tab)
    {
        $input = $this->input->post();

        $rules = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
        );

        $errors = modules::run('common/validate_input', $input, $rules);

        if (count($errors) > 0) {
            # User input error
            echo json_encode(array(
                'ok' => false,
                'errors' => $errors
            ));
            return;
        }

        $updated = $this->form_model->update_form($input['form_id'], $input);
        if ($updated === true)
        {
            echo json_encode(array(
                'ok' => true,
                'success' => true,
                'action' => $input['form_id']
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

    function load_fields()
    {
        $form_id = $this->input->post('form_id');
        $fields = $this->form_model->get_fields($form_id);
        if (count($fields) == 0) {
            $this->load->view('form/empty');
        } else {
            foreach($fields as $field) {
                $data['field'] = $field;
                $this->load->view('form/field/' . $field['type'], isset($data) ? $data : NULL);
            }
        }
    }

    function add_field()
    {
        $input = $this->input->post();
        if (in_array($input['type'], array('radio', 'checkbox', 'select'))) {
            $input['options'] = json_encode(array('Option one', 'Option two'));
        }
        $input['inline'] = (isset($input['inline'])) ? 1 : 0;
        $input['multiple'] = (isset($input['multiple'])) ? 1 : 0;

        $field_id = $this->form_model->insert_field($input);
        if (is_int($field_id))
        {
            # Form created successfully
            echo json_encode(array(
                'ok' => true,
                'success' => true,
                'action' => $field_id
            ));
        }
        else
        {
            # System error
            echo json_encode(array(
                'ok' => true,
                'success' => false,
                'msg' => $field_id
            ));
        }
    }

    function load_field_edit_form()
    {
        $field_id = $this->input->post('field_id');
        $data['field'] = $this->form_model->get_field($field_id);
        $this->load->view('form/field_edit_form_view', isset($data) ? $data : NULL);
    }

    function update_field()
    {
        $input = $this->input->post();
        if (isset($input['options'])) {
            $options = explode("\n", trim($input['options']));
            $input['options'] = json_encode($options);
        }
        $input['required'] = (isset($input['required'])) ? 1 : 0;
        $this->form_model->update_field($input['field_id'], $input);
    }

    function update_field_orders()
    {
        $field_orders = $this->input->post('field_orders');
        foreach($field_orders as $field_order => $field) {
            $field = json_decode($field);
            $this->form_model->update_field($field->field_id, array('field_order' => $field_order));
        }
    }

    function delete_field()
    {
        $field_id = $this->input->post('field_id');
        if ($this->form_model->delete_field($field_id)) {
            echo 'true';
        } else {
            echo 'There was error while deleting this field';
        }
    }

    function load_images()
    {
        $input = $this->input->post();
        $data['images'] = $this->banner_model->get_images($input['banner_id']);
        $this->load->view('banner/images_view', isset($data) ? $data : NULL);
    }

    function trash_image()
    {
        $upload_id = $this->input->post('upload_id');
        $this->banner_model->trash_image($upload_id);
    }

    function change_status()
    {
        $banner_id = $this->input->post('banner_id');
        $trashed = $this->input->post('trashed');

        # If not trashed
        if(!$trashed){
            $banner = $this->banner_model->get_banner($banner_id);
            $new_status = $banner['status'] ? 0 : 1;
        }else{
            # If trashed set status to -1
            $new_status = -1;
        }
        $updated = $this->banner_model->update_banner($banner_id,array('status' => $new_status));

        if ($updated === true)
        {
            echo json_encode(array(
                'ok' => true,
                'success' => true,
                'action' => $banner_id
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


}
