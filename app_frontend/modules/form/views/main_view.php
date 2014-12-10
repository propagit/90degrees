<form id="form-<?=$form['form_id'];?>">
<input type="hidden" name="form_id" value="<?=$form['form_id'];?>">
<? foreach($fields as $field) { echo modules::run('form/field', $field); } ?>
<button type="button" class="btn btn-primary btn-form-submit" data-form-id="<?=$form['form_id'];?>" onclick="submit_form()" data-loading-text="Submitting...">Submit</button>
</form>

<script>
function submit_form() {
    ajax_submit_form('form-<?=$form['form_id'];?>', '<?=base_url();?>form/form_ajax/submit', function(e){
        alert(e);
    });
}
</script>
