<div class="arrow"></div>
<h3 class="popover-title"><?=ucwords($field['type']);?></h3>
<form id="update-field-form">
<input type="hidden" name="field_id" value="<?=$field['field_id'];?>" />
<div class="popover-content">
    <section>
        <label class="label">Label</label>
        <label class="input">
            <input type="text" name="label" value="<?=$field['label'];?>" />
        </label>
    </section>
    <? if($field['type'] == 'text' || $field['type'] == 'textarea') { ?>
    <section>
        <label class="label">Placeholder</label>
        <label class="input">
            <input type="text" name="placeholder" value="<?=$field['placeholder'];?>" />
        </label>
    </section>
    <? } ?>


    <? if( in_array($field['type'], array('radio','checkbox', 'select'))) {
        $options_value = '';
        $options = json_decode($field['options']);
        if ($options) {
            foreach($options as $option) { $options_value .= $option . "\n"; }
        }
    ?>
    <section>
        <label class="label">Options</label>
        <label class="textarea">
            <textarea class="custom-scroll" name="options" rows="<?=count($options);?>"><?=$options_value;?></textarea>
        </label>
    </section>
    <? } ?>

    <section>
        <label class="checkbox">
            <input type="checkbox" name="required" value="1" <?=($field['required']) ? ' checked' : ''; ?>>
            <i></i> Required
        </label>
    </section>

    <a class="btn btn-info" id="btn-update-field">Save</a>
    <a class="btn btn-danger" id="btn-close-popover">Cancel</a>
</div>
</form>

<script>
$(function(){
    $('#btn-update-field').click(function(){
        $.ajax({
            type: "POST",
            url: "<?=ajax_url();?>cms/form_ajax/update_field",
            data: $('#update-field-form').serialize(),
            success: function(html) {
                $('.popover').hide();
                load_fields(<?=$field['form_id'];?>);
            }
        })
    })
    $('#btn-close-popover').click(function(){
        $('.popover').hide();
    })
})
</script>
