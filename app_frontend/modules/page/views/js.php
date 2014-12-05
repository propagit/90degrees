<!-- include custom script for only homepage  -->
<script src="<?=base_url() . ASSETS;?>js/home.js"></script>


<script>
$(function(){
	$('.btn-form-submit').click(function(){
		var form_id = $(this).attr('data-form-id');
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>form/form_ajax/submit",
			data: $('#form-' + form_id).serialize(),
			success: function(output) {
				//alert(output); return;
				var data = $.parseJSON(output);
				if(data.ok){
					// Contact message sent
					$('#site-msg').html(data.msg);
					$('#ModalSiteMsg').modal('show');
				}else{
					var errors = data.errors;
					var msg = '';
					//add error class where applicable
					errors.forEach(function(e){
						msg += e.msg+'<br>';
					});
					$('#site-errors').html(msg);
					$('#ModalSiteErrors').modal('show');
				}
			}
		});
	})
});	//	Ready


</script>
