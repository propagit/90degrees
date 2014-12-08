<form id="form-<?=$form['form_id'];?>">
<input type="hidden" name="form_id" value="<?=$form['form_id'];?>">
<? foreach($fields as $field) { echo modules::run('form/field', $field); } ?>
<button type="button" class="btn btn-primary btn-form-submit" data-form-id="<?=$form['form_id'];?>">Submit</button>
</form>
