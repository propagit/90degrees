// JavaScript Document

function ajax_submit_form(form_id, post_url, callback) {
	var $btn = $('#' + form_id).find('button[type="button"]');
	$btn.button('loading');
	$.ajax({
		type: "POST",
		url: post_url,
		data: $('#' + form_id).serialize(),
		success: function(output) {
			// alert(output); return; // Debug
			$btn.button('reset');
			var data = $.parseJSON(output);
			if (!data.ok) { // Invalid
				var errors = data.errors;
				//reset error class in form as they will need to be re validated
				remove_error_class(form_id);

				//add error class where applicable
				var msg = '';
				errors.forEach(function(e){
					$('#' + form_id).find('[name="' + e.field + '"]').parent().addClass('has-error');
					msg += e.msg+'<br>';
				});
				$('#site-errors').html(msg);
				$('#ModalSiteErrors').modal('show');


			} else { // Validated
				if (data.success) { // Success, fire callback function
					callback(data.action);
				} else { // Failed, alert output
					$('#msg-error').find('span').html(data.msg);
					$('#msg-error').removeClass('hide');
					 // scroll up
					$("html, body").animate({
						scrollTop: 0
					}, "fast");
				}
			}
		}
	});
}

function remove_error_class(form_id)
{
	$('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select,#'+form_id+' date#'+form_id+' email').each(function(){
		$(this).parent().removeClass('has-error');
	});
}

