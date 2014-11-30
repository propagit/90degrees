<!-- SuperBox -->
<div class="superbox col-sm-12">
	<? foreach($images as $image) { ?>
	<div class="superbox-list">
		<img src="<?=base_url() . $image['full_path'];?>" data-upload-id="<?=$image['upload_id'];?>" data-img="<?=base_url() . $image['full_path'];?>" alt="<?=$image['orig_name'];?>" title="<?=$image['orig_name'];?>" class="superbox-img">
	</div>
	<? } ?>
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
				url: "<?=ajax_url();?>cms/banner_ajax/trash_image",
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
</script>