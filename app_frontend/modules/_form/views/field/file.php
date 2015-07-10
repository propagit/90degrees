<p id="filelist_<?=$field['field_id'];?>" class="text-muted" style="margin:0;"><!-- Your browser doesn't have Flash, Silverlight or HTML5 support. --></p>
<div class="progress progress-striped active" style="visibility: hidden; display:none;">
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="upload-progress_<?=$field['field_id'];?>">
   		 0%
    </div>
</div>
<p style="margin-bottom:5px;" class="text-muted">
	<?=$field['label'];?>
	<? if($field['required']) { ?><span class="text-danger">*</span><? } ?>
    <i style="font-size:14px;">[select a file and hit upload files]</i>
</p>
<div id="upload_container_<?=$field['field_id'];?>" style="margin-bottom:20px;">
    <button type="button" id="pickfiles_<?=$field['field_id'];?>" href="javascript:;" class="btn btn-core">Select files</button>
    <button type="button" id="uploadfiles_<?=$field['field_id'];?>" href="javascript:;" class="btn btn-core">Upload files</button>
    <span id="console_<?=$field['field_id'];?>"></span>
</div>
<input type="hidden" name="field-<?=$field['field_id'];?>" />
<p class="up_file" id="uploaded_file_<?=$field['field_id'];?>" class="text-muted" style="margin:0;"></p>
<div style="clear:both;"></div>					
<script>
var uploader_<?=$field['field_id'];?> = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles_<?=$field['field_id'];?>', // you can pass in id...
	multi_selection:false,  //disable multi-selection
	container: document.getElementById('upload_container_<?=$field['field_id'];?>'), // ... or DOM Element itself
	url : '<?=base_url();?>form/form_ajax/upload_files/<?=$form['form_id'];?>/',
	chunk_size: '400kb',
    max_retries: 5,    
    unique_names: true,
	flash_swf_url : '<?=base_url();?>assets/js/plupload/Moxie.swf',
	silverlight_xap_url : '<?=base_url();?>assets/js/plupload/Moxie.xap',

	filters : {
		max_file_size : '20mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Document files", extensions : "pdf,doc,docx,ppt,xls"}
		]
	},

	init: {
		PostInit: function() {
			$('#console_<?=$field['field_id'];?>').html('');
			$('#filelist_<?=$field['field_id'];?>').html('');
			$('#uploadfiles_<?=$field['field_id'];?>').click(function() {
				uploader_<?=$field['field_id'];?>.start();
				return false;
			});
		},

		FilesAdded: function(up, files) {
			if(uploader_<?=$field['field_id'];?>.files.length > 1)
			{
			    uploader_<?=$field['field_id'];?>.removeFile(uploader_<?=$field['field_id'];?>.files[0]);
			    uploader_<?=$field['field_id'];?>.refresh();// must refresh for flash runtime
			}
			$('#upload-progress_<?=$field['field_id'];?>').parent().css("visibility", "visible");

			plupload.each(files, function(file) {
				document.getElementById('filelist_<?=$field['field_id'];?>').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			$('#upload-progress_<?=$field['field_id'];?>').attr('aria-valuenow', 60);
			$('#upload-progress_<?=$field['field_id'];?>').css("width", file.percent + "%");
			$('#upload-progress_<?=$field['field_id'];?>').html(file.percent + '% completed');
		},
		UploadComplete: function(up, files) {
			// On complete
			$('#upload-progress_<?=$field['field_id'];?>').parent().css("visibility", "hidden");
			$('#upload-progress_<?=$field['field_id'];?>').css("width", "0%");
			$('#upload-progress_<?=$field['field_id'];?>').html('0%');
			$('#console_<?=$field['field_id'];?>').html('');
			$('#filelist_<?=$field['field_id'];?>').html('');
			$('#uploaded_file_<?=$field['field_id'];?>').html('<span>' + files[0].name);
			$('input[name="field-<?=$field['field_id'];?>"]').val(files[0].target_name);
		},

		Error: function(up, err) {
			$('#console_<?=$field['field_id'];?>').html('\n&nbsp;<span class="text-danger">Error: ' + err.message + '</span>');
		}
	}
});

uploader_<?=$field['field_id'];?>.init();
uploader_<?=$field['field_id'];?>.bind('FilesAdded', function(up, files) {
    $.each(files, function(i, file) {
        if(i){up.removeFile(file); return;}
    });
});
</script>