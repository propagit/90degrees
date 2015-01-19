<form id="form-<?=$form['form_id'];?>" class="form-contact">
<input type="hidden" name="form_id" value="<?=$form['form_id'];?>">
<? foreach($fields as $field) { echo modules::run('form/field', $field); } ?>

<? if (isset($captcha)) { ?>
<div class="form-group">
    <label for="field-captcha">CAPTCHA</label>

    <div class="row">
        <div class="captcha" id="captcha-img"><? echo $captcha['image'];?></div>
        <div class="btn btn-default btn-refresh-captcha" onclick="refresh_captcha()"><i class="fa fa-refresh"></i></div>
        <div class="input-captcha"><input id="field-captcha" name="field-captcha" class="form-control" placeholder="* Enter code to submit message" /></div>
    </div>
</div>
<? } ?>

<button type="button" class="btn btn-primary btn-form-submit" data-form-id="<?=$form['form_id'];?>" onclick="submit_form('<?=$form['form_id']?>')" data-loading-text="Submitting...">Submit</button>
</form>

<script>
function submit_form(form_id) {
    ajax_submit_form('form-'+form_id, '<?=base_url();?>form/form_ajax/submit', function(e){
        //alert(e);
		$('#site-msg').html('Thank you for your enquiry.<br>We will get back to you shortly');
		$('#ModalSiteMsg').modal('show');
    });
}
</script>
