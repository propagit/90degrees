<select name="<?=$field_name;?>" class="select2">
	<? foreach($products as $product){ ?>
	<option value="<?=$product['product_id'];?>"<?=($product['product_id'] == $product_id) ? ' selected' : '';?>><?=$product['name'];?></option>
	<? } ?>
</select> <i></i>