<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('form_model');

    }

    function refresh_captcha()
    {
        $captcha = modules::run('form/generate_captcha');
        echo $captcha['image'];
    }
	
	function submit()
	{
		
		$input = $this->input->post();
        $form_id = $input['form_id'];
        $form = $this->form_model->get_form($form_id);
        $fields = $this->form_model->get_fields($form_id);
		 
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
	}

    function _submit()
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
			$attachments = array();
            foreach($fields as $field) {
                $field_name = 'field-' . $field['field_id'];
                if (isset($input[$field_name])) {
					# if this is a file
					if($field['type'] == 'file'){
						if($input[$field_name]){
							$attachments[] = './uploads/forms/' . $input[$field_name];
							$message .= '<p>' . $field['label'] . ': <a href="' . base_url(). 'uploads/forms/' . $input[$field_name] . '">' . $input[$field_name] . '</a></p>';		
						}
					}else{
						$message .= '<p>' . $field['label'] . ': ' . $input[$field_name] . '</p>';		
					}
				}
				
				
				

            }
	
            modules::run('email/send_email', array(
                'to' => $form['email'],
                'from' => NO_REPLY_EMAIL,
                'from_text' => SITE_NAME,
                'subject' => $form['name'],
                'message' => $message,
				'attachment' => $attachments
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
	
	function upload_files($form_id) {
		# Make sure file is not cached (as it happens for example on iOS devices)
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		/*
		// Support CORS
		header("Access-Control-Allow-Origin: *");
		// other CORS headers if any...
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			exit; // finish preflight CORS requests here
		}
		*/

		// 5 minutes execution time
		@set_time_limit(5 * 60);

		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings
		//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
		//$targetDir = 'uploads';
		# Create dir for storing file related to the product
		$targetDir = "./uploads/forms";
		
	

		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}
		
		// Create target thumb dir
		if (!file_exists($targetThumbDir)) {
			@mkdir($targetThumbDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}

		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);
		
		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off
			rename("{$filePath}.part", $filePath);
			
			# Record upload data to the database
			$upload_data = array(
				'file_name' => $fileName,
				'file_path' => $targetDir,
				'full_path' => $filePath,
				'orig_name' => $_REQUEST['orig_name']
				
			);
			$upload_id = $this->upload_model->insert_upload($upload_data);
			
		}
		
		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : "' . $upload_id . '", "id" : "id"}');
	}


}
