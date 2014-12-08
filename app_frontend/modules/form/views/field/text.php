<div class="form-group">
    <label for="field-<?=$field['field_id'];?>">
        <?=$field['label'];?>
        <? if($field['required']) { ?><span class="text-danger">*</span><? } ?>
    </label>
    <input id="field-<?=$field['field_id'];?>" name="field-<?=$field['field_id'];?>" placeholder="<?=$field['placeholder'];?>" class="form-control" />
</div>
