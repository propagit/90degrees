<section class="form_field dropped" id="field_<?=$field['field_id'];?>">
    <div class="btn-group pull-right">
        <a class="btn btn-xs btn-default" onclick="edit_field(<?=$field['field_id'];?>)"><i class="fa fa-pencil"></i></a>
        <a class="btn btn-xs btn-danger" onclick="delete_field(<?=$field['field_id'];?>)"><i class="fa fa-times"></i></a>
    </div>
    <label class="label"><?=$field['label'];?></label>

    <label class="select<?=($field['multiple']) ? ' select-multiple' : '';?>">
        <select name="<?=$field['field_id'];?>"<?=($field['multiple']) ? ' class="custom-scroll" multiple=""' : '';?>>
        <?php $options = json_decode($field['options']);
		if ($options) {
			foreach($options as $option) { ?>
			<option><?=$option;?></option>
			<?php }
		} ?>
        </select>
        <?=($field['multiple']) ? '' : '<i></i>';?>
    </label>
    <input class="sort-index" type="hidden" value="<?=$field['field_order'];?>" data="<?=$field['field_id'];?>"  />
</section>
