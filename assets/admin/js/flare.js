function ajax_submit_form(form_id, post_url, callback) {
	$.ajax({
		type: "POST",
		url: post_url,
		data: $('#' + form_id).serialize(),
		success: function(output) {
			//console.log(output);
			var data = $.parseJSON(output);
			if (!data.ok) { // Invalid
				var errors = data.errors;
				errors.forEach(function(e){
					$('#' + form_id).find('[name="' + e.field + '"]').parent().addClass('state-error');
				});
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

/* Preloading data functions */
function preloading(obj)
{
	var h = $(obj).height();
	var w = $(obj).width();
	var id = $(obj).attr('id');
	var margin = '';
	if (id == 'wrapper_js') {
		margin = 'margin-top:-22px';
	}
	$(obj).prepend('<div id="wrapper_loading" style="height:' + h + 'px;width:' + w + 'px;line-height:' + h + 'px;' + margin + '"><img src="' + base_url + 'assets/admin/img/loading.gif" /></div>');
}
function loaded(obj,html)
{
	if (html != null) {
		setTimeout(function(){
			//console.log(html);
			$(obj).html(html);
		}, 200);
	} else {
		setTimeout(function(){
			$(obj).find('#wrapper_loading').remove();
		}, 200);
	}
}

function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}

//permalink generator
function slugify(text){
	text = text.toLowerCase();
	var   spec_chars = {a:/\u00e1/g,e:/u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
	for (var i in spec_chars) text = text.replace(spec_chars[i],i);
	var hyphens = text.replace(/\s/g,'-');
	var slug = hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
	slug = slug.toLowerCase();
	return slug;
}

//check if this parmanent already exist in the database
function slug_exist(url,slug,callback){
	$.ajax({
		type:'post',
		url:controller_url,
		dataType:"JSON",
		data:{slug:slug},
		success:function(data){
			callback(data);
		}
	});//ajax
}

//force input field to lowercase
function force_lower(selector){
	var lower = $(selector).val().toLowerCase();
	$(selector).val(lower);
}

// change status
function change_status(base_url,callback_url,event_obj){
	  var obj_type = event_obj.attr('data-obj-type');
	  var obj_id = event_obj.attr('data');
	  $.ajax({
		  type: "POST",
		  url: base_url+'common/common_ajax/change_status',
		  data: {obj_type:obj_type,obj_id:obj_id},
		  success: function(output) {
			  window.location.hash = callback_url+'/#'+(new Date).getTime();
		  }
		  
	  });	
}

function trash(base_url,callback_url,event_obj){
	 var obj_type = event_obj.attr('data-obj-type');
	 var obj_id = event_obj.attr('data');
	 $.ajax({
		  type: "POST",
		  url: base_url+'common/common_ajax/change_status',
		  data: {obj_type:obj_type,obj_id:obj_id,trashed:1},
		  success: function(output) {
			  window.location.hash = callback_url+'/#'+(new Date).getTime();
		  }
		  
	 });	
}


