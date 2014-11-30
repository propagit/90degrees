<div class="form-group <?=($field['required']) ? 'required' : '';?>">
	<label><?=$field['label'];?> <?=($field['required']) ? '<sup>*</sup>' : '';?></label>
	<select name="<?=$field['field_id'];?><?=($field['multiple'] == 'true' ? '[]' : '');?>" class="form-control" <?=($field['multiple'] == 'true' ? 'multiple="multiple"' : '');?>>
			<? if ($field['multiple'] != "true") { ?>
			<option value="">Select One</option>
			<? } 
		$attrs = json_decode($field['attributes']);
		if($attrs) {
			foreach($attrs as $attr) { ?>
		<option value="<?=$attr;?>"<?=(isset($value) && $value == $attr) ? ' selected' : '';?>><?=$attr;?></option>
		<? }
		} ?>
	</select>
</div>