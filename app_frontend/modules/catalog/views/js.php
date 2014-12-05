<!-- include smoothproducts // product zoom plugin  --> 
<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/smoothproducts.min.js"></script> 

<script>
$(function(){
	
	$('#btn-add-cart').click(function(){
		add_to_cart('form-product'); // Function in view/common/footer.php
	});
	
	
	// order products
	$('#orderby').on('change',function(){
		var sort_by = $(this).val();
		var url = '<?=base_url();?>category/<?=$cur_category?>?layout=<?=$layout;?>&order='+sort_by;
		window.location.href = url;
	});
	
	$('.layout').click(function(){
		var cur_layout = $(this).attr('data');
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>common/common_ajax/set_layout",
			data: {layout:cur_layout},
			success: function(html) {
				// do nothing 
				//console.log(html);
			}
		});
	});
	
});


</script>