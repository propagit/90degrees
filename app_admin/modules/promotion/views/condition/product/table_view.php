<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th width="38" class="center">
                <input type="checkbox" id="all_selected_<?=$condition['condition_id'];?>" /></th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Sale Price</th>
            </tr>
        </thead>
        <tbody>
            <? foreach($products as $product) {
                $checked = false;
                if ($condition['value']) {
                    $checked = in_array($product['product_id'], unserialize($condition['value']));
                }
                ?>
            <tr>
                <td class="center">
                    <input type="checkbox" class="selected_product_<?=$condition['condition_id'];?>" name="conditions[<?=$condition['condition_id'];?>][]" value="<?=$product['product_id'];?>" <?=($checked) ? ' checked' : '';?> />
                </td>
                <td><a href="#<?=ajax_url();?>product/edit/<?=$product['product_id'];?>"><?=$product['name'];?></a></td>
                <? if ($checked) { ?>
                <td><strike>$<?=money_format('%i', $product['price']);?></strike></td>
                <td>$<?=money_format('%i', $product['price'] - modules::run('promotion/discount', $product['sale_price'], $promotion['promotion_id']));?></td> 
                <? } else { ?>
                <td>$<?=money_format('%i', $product['sale_price']);?></td>
                <td></td>
                <? } ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<script>
$(function(){
    $('#all_selected_<?=$condition['condition_id'];?>').click(function(){
        $('input.selected_product_<?=$condition['condition_id'];?>').prop('checked', this.checked);
    });
})
</script>
