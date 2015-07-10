<div class="form-group">
    <label for="field-<?=$field['field_id'];?>">
        <?=$field['label'];?>
        <? if($field['required']) { ?><span class="text-danger">*</span><? } ?>
    </label>
    <select class="form-control" id="field-<?=$field['field_id'];?>" name="field-<?=$field['field_id'];?>">
        <option value="">Please select</option>
        <? $options = json_decode($field['options']);
        if ($options) {
            foreach($options as $option) { ?>
        <option value="<?=$option;?>"><?=$option;?></option>
            <? }
        } ?>
    </select>
</div>
