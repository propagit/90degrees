<?php
  $active_tab = 'quote';
  if(isset($_SERVER['QUERY_STRING'])){
	 $active_tab = $_SERVER['QUERY_STRING']; 
  }
?>
<!-- include custom script for only homepage  -->
<script src="<?=base_url() . ASSETS;?>js/home.js"></script>
<script src="<?=base_url() . ASSETS;?>js/jquery/touch/jquery.mobile.custom.min.js"></script>
<script src="<?=base_url() . ASSETS;?>/swipe-box/js/jquery.swipebox.js"></script>
<script>
$(function(){
	<?php if(0){ ?>
	// Contact 
	/*$('#btn-contac-us').click(function(){

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

	});*/

	
	// tiles caption
	
	/*$('.tiles').mouseover(function(){
		$(this).children().children().children('.tiles-caption').addClass('fadein');
	}).mouseout(function(){
		$(this).children().children().children('.tiles-caption').removeClass('fadein');
	});*/
	
	
	//toggle job info
	// tiles caption
	/*$('#toggle-job-info').click(function(){
		$('#job-info').toggle().removeClass('hide').addClass('fadein');
		$('.job-info-btn').toggle();
		$(this).toggleClass('job-info-btn-bg');
		 $('html, body').animate({
			scrollTop: $("#job-info").offset().top
		}, 1000);
	});*/
	<?php } ?>
	// pause slide show
	/*$('#pager2 span').hover(function(){
		$('.slider-v1').cycle('pause');
	},function(){
		$('.slider-v1').cycle('resume');
	});*/
	
	$( '.swipebox' ).swipebox({hideBarsDelay : 60000});
	
	$('.mob-gallery-pager').swipebox({hideBarsDelay : 60000});


	$('#work-banners').swiperight(function() {  
		$('#work-banners').carousel('prev'); 
		$('.swipe-icon').html(''); 
	 });  
	 $('#work-banners').swipeleft(function() {  
		$('#work-banners').carousel('next'); 
		$('.swipe-icon').html(''); 
	 });
	 
	 make_tab_active();
	
});	//	Ready
	
function make_tab_active(){
	$('.flare-cms-tabs a[href="#<?=$active_tab;?>"]').tab('show');
	$('.flare-cms-tabs a[href="#<?=$active_tab . '_msg';?>"]').tab('show');
}


</script>
