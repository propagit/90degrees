<section>
	<label class="label">Order subtotal (Equal or Greater)</label>
	<label class="input">
    	<div class="pull-right" style="margin-right:-45px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
        <i class="icon-append">$</i>
        <input type="text" class="form-control" name="conditions[<?=$condition['condition_id'];?>]" value="<?=$condition['value'];?>" onkeypress="return help.check_numeric(this, event,'nd');" />
    </label>
</section>