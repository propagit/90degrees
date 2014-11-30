<section>
	<label class="label">Coupon code</label>
	<label class="input">
    	<div class="pull-right" style="margin-right:-45px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
        <section class="col-5 push" style="margin-right:15px;">
    	<input type="text" class="form-control" name="conditions[<?=$condition['condition_id'];?>]" value="<?=$condition['value'];?>" />
        </section>
        <section class="col-5 push">
        <i class="icon-append" style="width:50%;">Usage: <?=$condition['actual_usages'];?></i>
        <input type="text" class="form-control" name="usages[<?=$condition['condition_id'];?>]" value="<?=$condition['allowed_usages'];?>" />
        </section>
    </label>
</section>
