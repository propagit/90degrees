<!-- include smoothproducts // product zoom plugin  --> 
<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/smoothproducts.min.js"></script> 

<script>
$(function(){
	$('#btn-add-cart').click(function(){
		add_to_cart('form-product'); // Function in view/common/footer.php
	})
})
</script>