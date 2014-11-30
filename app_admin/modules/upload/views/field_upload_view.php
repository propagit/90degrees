<div id="<?=$field_name;?>_filelist" class="upload_filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<div class="progress progress-striped active hide">
	<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="<?=$field_name;?>_upload-progress">0%</div>
</div>

<div id="<?=$field_name;?>_upload_container">
	<button id="<?=$field_name;?>_pickfiles" href="javascript:;" class="btn btn-info">Select files</button>
	<button id="<?=$field_name;?>_uploadfiles" href="javascript:;" class="btn btn-info hide">Upload files</button>
	<span id="<?=$field_name;?>_console"></span>
</div>

<div class="hide" id="<?=$field_name;?>_upload_ids"></div>

<script>
var upload_ids = new Array();
var uploader_<?=$field_name;?> = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : '<?=$field_name;?>_pickfiles',
	container: document.getElementById('<?=$field_name;?>_upload_container'),
	url : '<?=ajax_url();?>upload/ajax/uploading',
	chunk_size: '400kb',
    max_retries: 5,
	flash_swf_url : '<?=base_url() . ASSETS_PATH;?>js/plugin/plupload/Moxie.swf',
	silverlight_xap_url : '<?=base_url() . ASSETS_PATH;?>js/plugin/plupload/Moxie.xap',
	unique_names: true,
	filters : {
		max_file_size : '500mb',
		mime_types: [
			<? foreach($allowed_extensions as $a) { ?>
			{title : "<?=$a['title'];?>", extensions : "<?=$a['extensions'];?>"},
			<? } ?>
			//{title : "Image files", extensions : "jpg,gif,png"},
			//{title : "Zip files", extensions : "zip"},
			//{title : "Movie files", extensions : "mov,mp4,avi"},
			//{title : "Document files", extensions : "pdf,doc,docx,ppt,csv,xls"}
		]
	},
	init: {
		BeforeUpload: function(up, file) {
			up.settings.multipart_params =
			{
				orig_name: file.name // Passing original file name
			};
		},
		
		PostInit: function() {
			$('#<?=$field_name;?>_filelist').html('');
			$('#<?=$field_name;?>_uploadfiles').click(function(){
				uploader_<?=$field_name;?>.start();
				return false;
			});
		},

		FilesAdded: function(up, files) {
			
			$('#<?=$field_name;?>_uploadfiles').removeClass('hide');
			$('#<?=$field_name;?>_upload-progress').parent().removeClass('hide');

			plupload.each(files, function(file) {
				$('#<?=$field_name;?>_filelist').append('<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>');
			});
		},

		UploadProgress: function(up, file) {
			$('#<?=$field_name;?>_upload-progress').attr('aria-valuenow', file.percent);
			$('#<?=$field_name;?>_upload-progress').css("width", file.percent + "%");
			$('#<?=$field_name;?>_upload-progress').html(file.percent + '% completed');
		},
		UploadComplete: function() {
			$('#<?=$field_name;?>_upload-progress').css("width", "0%");
			$('#<?=$field_name;?>_upload-progress').html('');
			$('#<?=$field_name;?>_upload-progress').parent().addClass('hide');
			$('#<?=$field_name;?>_console').html('');
			$('#<?=$field_name;?>_filelist').html('');
			$('#<?=$field_name;?>_uploadfiles').addClass('hide');
			$('#<?=$field_name;?>_upload_ids').html(upload_ids.join());
			upload_ids.length = 0; // Reset upload_ids array
			<?=$callback;?>; // Fire callback function
		},
		FileUploaded: function(upldr, file, object) {
			var myData;
			try {
				myData = eval(object.response);
			} catch(err) {
				myData = eval('(' + object.response + ')');
			}
			upload_ids.push(myData.result);
		},
		Error: function(up, err) {
			$('#<?=$field_name;?>_console').html('&nbsp; <span class="text-danger">Error #' + err.code + ": " + err.message + '</span>');
		}
	}
});

uploader_<?=$field_name;?>.init();
</script>