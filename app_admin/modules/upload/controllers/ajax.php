<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('upload_model');
	}
	
	
	/**
	*	@desc: ajax function to upload file and store file info to the database
	*	@return: upload_id
	*/
	function uploading()
	{	
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
		$targetDir = "./uploads";
		
		$targetThumbDir = "./uploads/thumbnails";
		

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
			
			# Create thumb if necessary
			if( isset($_REQUEST['height']) && isset($_REQUEST['width']) ){
				$resize_params = array(
										'name' => $fileName,
										'directory' => 'uploads',
										'sub' => 'thumbnails',
										'width' => $_REQUEST['width'],
										'height' => $_REQUEST['height']
									);
				modules::run('upload/resize_photo',$resize_params);	
			}
		}
		
		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : "' . $upload_id . '", "id" : "id"}');
	}
	
	function delete()
	{
		$upload_id = $this->input->post('upload_id');
		$upload = $this->upload_model->get_upload($upload_id);
		if ($upload) {
			if (file_exists($upload['full_path'])) {
				unlink($upload['full_path']);
			}
			if (file_exists($upload['file_path'] . '/thumbnails/' . $upload['file_name'])) {
				unlink($upload['file_path'] . '/thumbnails/' . $upload['file_name']);
			}
			$this->upload_model->delete_upload($upload['upload_id']);
		}
	}
}