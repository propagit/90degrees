<section class="form_field dropped" id="field_<?=$field['field_id'];?>">
    <div class="btn-group pull-right">
        <a class="btn btn-xs btn-default" onclick="edit_field(<?=$field['field_id'];?>)"><i class="fa fa-pencil"></i></a>
        <a class="btn btn-xs btn-danger" onclick="delete_field(<?=$field['field_id'];?>)"><i class="fa fa-times"></i></a>
    </div>
    <label class="label"><?=$field['label'];?></label>
    <label class="input input-file" for="file">
        <div class="button">
            <input name="file" onchange="this.parentNode.nextSibling.value = this.value" type="file">Browse
        </div>
        <input placeholder="Include some files" readonly="" type="text">

    </label>
    <input class="sort-index" type="hidden" value="<?=$field['field_order'];?>" data="<?=$field['field_id'];?>"  />
</section>
