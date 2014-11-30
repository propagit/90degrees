<!-- jQuery minimalect // custom select   --> 
<script src="<?=base_url() . ASSETS;?>js/jquery.minimalect.min.js"> </script> 

<script>
$(function(){
	
	// Update Cart items
	$('#btn-update-cart').click(function(){
		var data = {};
		$('.cart-qty-input').each(function(){
			data[$(this).attr('data-rowid')] = $(this).val();
		});
		update_cart(data);
	});
	
	// Delete cart item
	$('#delete-cart-item').click(function(){
		delete_item($(this).attr('data-rowid'));
	});
	
	// Checkout - store delivery details
	$('#btn-save-delivery-address').click(function(){
		ajax_submit_form('delivery-address-form', '<?=base_url() . 'cart/checkout_ajax/add_delivery_address';?>', function(e){
			window.location.href = '<?=base_url()?>'+e;
		});
	});
	
	// Payment
	$('#btn-confirm-purchase').click(function(){
		ajax_submit_form('payment-form', '<?=base_url() . 'cart/checkout_ajax/validate_payment_form';?>', function(e){
			
			// Show modal to wait until we process their payment
			$('#site-msg').html('Please wait while we process your payment. <br><br><i class="fa fa-cog fa-spin"></i>');
			$('#ModalSiteMsg').modal('show');
			$('#payment-form').submit();
		});
	});
	
	// Populate or Reset delivery address
	$('#chk-box-same-as-profile').click(function(){
		if($(this).is(':checked')){
			get_deliver_address('populate');
		}else{
			get_deliver_address('empty');
		}
	});
	
	// Check if agreed to terms checkbox is ticked
	$('#btn-checkout').click(function(){
		if($('#agree-to-terms').is(':checked')){
			$.ajax({
			type: "POST",
			url: "<?=base_url();?>cart/checkout_ajax/set_agreed_to_terms",
			success: function(html) {
					window.location.href = '<?=base_url();?>cart/checkout';	
				}
			});	
			
		}else{
			$('#site-errors').html('You need to agree with our Terms & Conditions to procced with this purchase');
			$('#ModalSiteErrors').modal('show');	
		}
		
	});
	
	// Apply coupon if valid
	$('#apply-coupon').click(function(){
		add_coupon();
	});
});


function update_cart(data)
{
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/ajax/update",
		data: {data:data},
		dataType: "JSON",
		success: function(data) {
				if(data['status']){
					location.reload();
				}else{
					$('#site-errors').html('Update failed! Please try again');
					$('#ModalSiteErrors').modal('show');	
				}
		  	}
		});	
	
}

function delete_item(rowid)
{
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/ajax/delete_item",
		data: {rowid:rowid},
		dataType: "JSON",
		success: function(data) {
				if(data['status']){
					location.reload();
				}else{
					$('#site-errors').html('Deletion failed! Please try again');
					$('#ModalSiteErrors').modal('show');	
				}
		  	}
	});		
}

function get_deliver_address(form_data)
{
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/checkout_ajax/get_deliver_address",
		data:{form_data:form_data},
		success: function(html) {
				$('#ajax-delivery-from').html(html);
		  	}
	});		
}

function add_coupon()
{
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/checkout_ajax/add_coupon",
		data:{coupon:$('#coupon').val()},
		dataType:"JSON",
		success: function(data) {
				if(data['success']){
					// location.reload();
					reload_rightcart();	
				}else{
					$('#site-errors').html('Invalid coupon!');
					$('#ModalSiteErrors').modal('show');		
				}
		  	}
	});	
}

function reload_rightcart()
{
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/ajax/rightbar_cart",
		success: function(data) {
			$('#rightbar-cart').html(data);
		 }
	});		
}

// Checkout Functions



</script>