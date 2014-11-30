<select name="<?=$field_name;?>" class="select2">
	<? foreach($pages as $page){ ?>
	<option value="<?=$page['page_id'];?>"<?=($page['page_id'] == $page_id) ? ' selected' : '';?>><?=$page['title'];?></option>
	<? } ?>
</select> <i></i>