<div class="form-group form-radio-checkbox">
	<label><?=$field['label'];?></label>

	<?php $options = json_decode($field['options']);
    if ($options) {
        foreach($options as $option) { ?>
    <label class="radio">
        <input type="radio" name="fields[<?=$field['field_id'];?>]" value="<?=$option;?>" /> <?=$option;?>
    </label>
        <? }
    } ?>
</div>
