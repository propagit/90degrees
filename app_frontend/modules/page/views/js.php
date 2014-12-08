<!-- include custom script for only homepage  --> 
<script src="<?=base_url() . ASSETS;?>js/home.js"></script> 


<script>
$(function(){
	// Contact 
	$('#btn-contac-us').click(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>page/page_ajax/send_contact_message",
			data: $('#contact-form').serialize(),
			success: function(output) {
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
	});
	
	
	// tiles caption
	$('.tiles').mouseover(function(){
		$(this).children().children().children('.tiles-caption').addClass('fadein');
	}).mouseout(function(){
		$(this).children().children().children('.tiles-caption').removeClass('fadein');
	});
	
	//toggle job info
	// tiles caption
	$('#toggle-job-info').click(function(){
		$('#job-info').toggle().removeClass('hide').addClass('fadein');
		 $('html, body').animate({
			scrollTop: $("#job-info").offset().top
		}, 1000);
	});
	
	
});	//	Ready
</script>