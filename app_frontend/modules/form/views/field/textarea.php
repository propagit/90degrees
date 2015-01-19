 <div class="form-group">
    <label for="field-<?=$field['field_id'];?>">
        <?=$field['label'];?>
        <? if($field['required']) { ?><span class="text-danger">*</span><? } ?>
    </label>
    <textarea id="field-<?=$field['field_id'];?>" name="field-<?=$field['field_id'];?>" placeholder="<?=$field['placeholder'];?>" class="form-control" rows="6"></textarea>
</div>
