<div class="form-group form-radio-checkbox">
	<label><?=$field['label'];?>
    <? if($field['required']) { ?><span class="text-danger">*</span><? } ?>
    </label>

	<?php $options = json_decode($field['options']);
    if ($options) {
        foreach($options as $option) { ?>
    <label class="radio">
        <input type="radio" name="fields[<?=$field['field_id'];?>]" value="<?=$option;?>" /> <?=$option;?>
    </label>
        <? }
    } ?>
</div>
