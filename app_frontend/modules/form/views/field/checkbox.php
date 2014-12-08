<div class="form-group">
    <label><?=$field['label'];?></label>

    <? if(!$field['inline']) { ?>
    <div class="checkbox">
    <? } ?>
   	<?php $options = json_decode($field['options']);
    if ($options) {
        foreach($options as $option) { ?>
    <label class="checkbox">
        <input type="checkbox" name="fields[<?=$field['field_id'];?>][]" value="<?=$option;?>" /> <?=$option;?>
    </label>
        <? }
    } ?>
    <? if(!$field['inline']) { ?>
    </div>
    <? } ?>
</div>
