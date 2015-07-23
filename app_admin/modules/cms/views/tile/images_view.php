<!-- SuperBox -->
<div class="superbox col-sm-12">
	<?php 
		$feature_img = '';
		$normal_image_list = '';
		foreach($images as $image) { 
			if($image['upload_id'] == $tile['feature_image_id']){
				$feature_img .= '<div class="superbox-list">';
				$feature_img .= '<span class="feature-image"><i class="fa fa-heart"></i></span>';
				$feature_img .= '<img src="'. base_url() . $image['full_path'] . '" data-upload-id="' . $image['upload_id'] . '" data-img="' . base_url() . $image['full_path'] .'" alt="' . $image['orig_name'] .'" title="'. $image['orig_name'] . '" class="superbox-img">';
				$feature_img .= '</div>'	;
				
			}else{
				$normal_image_list .= '<div class="superbox-list">';
				$normal_image_list .= '<img src="'. base_url() . $image['full_path'] . '" data-upload-id="' . $image['upload_id'] . '" data-img="' . base_url() . $image['full_path'] .'" alt="' . $image['orig_name'] .'" title="'. $image['orig_name'] . '" class="superbox-img">';
				$normal_image_list .= '</div>'	;		
			}
		}
	?>
	
    	<?=$feature_img . $normal_image_list;?>



	<div class="superbox-float"></div>
</div>
<!-- /SuperBox -->

<div class="superbox-show" style="height:300px; display: none"></div>	


<!-- Dynamic Modal -->  
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
    <div class="modal-dialog">  
        <div class="modal-content">
            <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Image Caption</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
            	<form id="add-image-caption-form">
					<textarea class="form-control" placeholder="Content" name="description" id="upload-description" rows="5"></textarea>
                	<input type="hidden" name="upload_id" id="caption-upload-id">
                </form>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		Cancel
	</button>
	<button type="button" class="btn btn-success btn-sm" id="btn-add-caption">
      <span class="glyphicon glyphicon-floppy-disk"></span> Save
    </button>
</div>
        </div>  
    </div>  
</div>  
<!-- /.modal --> 
<script>
$(function(){
	$('.superbox').SuperBox();
	$('#btn-add-caption').click(function(){
		add_caption();
	});
})
function delete_image() {
	var src = $('.superbox-current-img').attr('src');
	$('.superbox-img').each(function(){
		var s = $(this).attr('src');
		if (s == src) {
			var upload_id = $(this).attr('data-upload-id');
			var deleted = $(this);
			$.ajax({
				type: "POST",
				url: "<?=ajax_url();?>cms/tiles_ajax/trash_image",
				data: {upload_id: upload_id},
				success: function(html) {
					deleted.parent().remove();
					$('.superbox-show').css('display', 'none');
				}
			})
		}
	})
}

function edit_image(){
	var src = $('.superbox-current-img').attr('src');
	var upload_id = 0;
	$('#upload-description').val('Please wait while we load the current caption....');
	$('.superbox-img').each(function(){
		var s = $(this).attr('src');
		if (s == src) {
			upload_id = $(this).attr('data-upload-id');
			$('#caption-upload-id').val(upload_id);
			
			$.ajax({
				type: "POST",
				url: "<?=ajax_url();?>cms/tiles_ajax/get_image_caption",
				data: {upload_id: upload_id},
				success: function(html) {
					$('#upload-description').val(html);
				}
			});
		}
	});
	$('#remoteModal').modal('show');
}

function set_feature(){
	var src = $('.superbox-current-img').attr('src');
	$('.superbox-img').each(function(){
		var s = $(this).attr('src');
		if (s == src) {
			var upload_id = $(this).attr('data-upload-id');
			//console.log(upload_id);
			$.ajax({
				type: "POST",
				url: "<?=ajax_url();?>cms/tiles_ajax/set_feature",
				data: {upload_id: upload_id,tile_id:<?=$tile['tile_id'];?>},
				success: function(html) {
					if(html == 'successful'){
						$('#msg-tile').find('span').html('Feature image set successfully!');
						$('#msg-tile').removeClass('hide');
						setTimeout(function(){
							$('#msg-tile').addClass('hide');
						}, 2000);
						load_tile_images(<?=$tile['tile_id']?>);
					}else{
						$('#msg-error').find('span').html('Unable to set feature image. Please try again');
						$('#msg-error').removeClass('hide');	
					}
				}
			});
		}
	})
}

function add_caption(){
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>cms/tiles_ajax/add_image_caption",
		data:$('#add-image-caption-form').serialize(),
		success: function(html) {
			if(html == 'successful'){
				$('#msg-tile').find('span').html('Image caption set successfully!');
				$('#msg-tile').removeClass('hide');
			}else{
				$('#msg-error').find('span').html('Unable to set image caption. Please try again');
				$('#msg-error').removeClass('hide');	
			}
			$('#remoteModal').modal('hide');
			$("html, body").animate({ scrollTop: 0 }, "fast");
		}
	});	
}
</script>