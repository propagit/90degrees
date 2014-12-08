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
	
<script>
$(function(){
	$('.superbox').SuperBox();
	
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
</script>