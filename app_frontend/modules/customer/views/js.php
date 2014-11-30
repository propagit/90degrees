<!-- include footable plugin --> 
<script src="<?=base_url() . ASSETS;?>js/footable.js" type="text/javascript"></script> 
<script src="<?=base_url() . ASSETS;?>js/footable.sortable.js" type="text/javascript"></script> 

<script src="<?=base_url() . ASSETS;?>js/jquery.mask.min.js"></script>
<script>
$(function(){
	
	$('.footable').footable();
	
	// Create Account
	$('#btn-create-account').click(function(){
		ajax_submit_form('create-account-form', '<?=base_url() . 'customer/customer_ajax/create_account';?>', function(e){
			// Account created
			// Redirect script here
			window.location.href = '<?=base_url()?>'+e;
				
		});
	});
	
	// Login
	$('#btn-login').click(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>customer/customer_ajax/login",
			data: $('#login-form').serialize(),
			success: function(output) {
				var data = $.parseJSON(output);
				if(data.ok){
					window.location.href = '<?=base_url()?>'+data.action;		
				}else{
					$('.login-input').effect('shake', {distance:12},600 );
				}
			}
		});
	});
	
	
	
	// Sign Up - Old function delete when new module is complete
	$('#btn-signup').click(function(){
		ajax_submit_form('update-personal-form', '<?=base_url() . 'customer/customer_ajax/signup';?>', function(e){
			// Sign up success
			// Redirect script here
			window.location.href = '<?=base_url()?>customer/account';
				
		});
	});	// Sign Up
	
	// Update personal info
	$('#btn-update-personal').click(function(){
		
		ajax_submit_form('update-personal-form', '<?=base_url() . 'customer/customer_ajax/update_personal';?>', function(e){
			// Update succesful
			$('#site-msg').html('Information updated successfully');
			$('#ModalSiteMsg').modal('show');
				
		});
		
	});
	
	// Update billing info
	$('#btn-update-billing').click(function(){
		
		ajax_submit_form('update-billing-form', '<?=base_url() . 'customer/customer_ajax/update_billing';?>', function(e){
			// Update succesful
			$('#site-msg').html('Information updated successfully');
			$('#ModalSiteMsg').modal('show');
				
		});
		
	});
	
	// Reset Password
	$('#btn-reset-password').click(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>customer/customer_ajax/reset_password",
			data: $('#reset-password-form').serialize(),
			success: function(output) {
				var data = $.parseJSON(output);
				if(data.ok){
					// Update succesful
					$('#site-msg').html(data.msg);
					$('#ModalSiteMsg').modal('show');	
				}else{
					$('#site-errors').html(data.msg);
					$('#ModalSiteErrors').modal('show');
				}
			}
		});
	});
	
});	//	Ready
</script>