<section>
	<label class="label">Products</label>
    <label class="input">
    	<div class="pull-right" style="margin-right:-45px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
    </label> 
    
    <div class="form-common-input c-prod-list" id="c<?=$condition['condition_id'];?>-prod-list">
    </div> 
</section>


<script>
$(function(){
    $.ajax({
        type: "POST",
        url: "<?=ajax_url();?>promotion/promotion_ajax/list_products",
        data: {condition_id: <?=$condition['condition_id'];?>},
        success: function(html) {
            $('#c<?=$condition['condition_id'];?>-prod-list').html(html);
        }
    })
})
</script>
