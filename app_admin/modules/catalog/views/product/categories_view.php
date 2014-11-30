<div class="tree smart-form">
	<?=$tree;?>
</div>

<script>
$(function(){
	$('.tree').find('input[type="checkbox"]').click(function(){
		var category_id = $(this).val();
		$.ajax({
			type: "POST",
			url: "<?=ajax_url();?>catalog/product_ajax/update_category",
			data: {product_id: <?=$product_id;?>, category_id: category_id},
			success: function(html) {
				if (html) {
					$('#msg-error').find('span').html(html);
					$('#msg-error').removeClass('hide');
				}
			}
		})
	})
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/bootstraptree/bootstrap-tree.min.js");
})

</script>