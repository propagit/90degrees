<?php
	/**
		if additional links are needed pass on to the links parameter
		'links' => array(
						  array('label' => 'Label name', '' , 'class' => 'class name if any', 'data' => $obj_id, 'fa' => 'fontawesome-icon-class')
					  )
	*/
	#config 
	$btn_class = $params['status'] ? 'btn-success' : 'btn-warning';
	$fa = $params['status'] ? 'fa-thumbs-o-down' : 'fa-thumbs-o-up';
	$link_label = $params['status'] ? 'Deactivate' : 'Activate';
	$links = isset($params['links']) ? $params['links'] : NULL;
?>

<div class="btn-group">
    <a class="btn <?=$btn_class;?>" href="javascript:void(0);"><?=$params['status'] ? 'Active' : 'Inactive';?></a>
    <a class="btn <?=$btn_class;?> dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><span class="caret"></span></a>
    <ul class="dropdown-menu <?=isset($params['ul_class']) ? $params['ul_class'] : '';?>">
    
    	<li><a class="change-status" href="javascript:void(0);" data="<?=$params['obj_id']?>" data-obj-type="<?=$params['obj_type'];?>"><i class="fa <?=$fa;?>"></i> <?=$link_label;?></a></li>
        <li><a class="trash" href="javascript:void(0);" data="<?=$params['obj_id']?>" data-obj-type="<?=$params['obj_type'];?>"><i class="fa fa-trash-o"></i> Trash</a></li>
    	<?php 
			if($links){
				foreach($links as $link){ 
					$url = isset($link['url']) ? $link['url'] : 'javascript:void(0);';
					$id = isset($link['id']) ? 'id ="' . $link['id'] . '"' : '';
					$class = isset($link['class']) ? 'class ="' . $link['class'] . '"' : '';
					$data = isset($link['data']) ? 'data ="' . $link['data'] . '"' : '';
					$fa = isset($link['fa']) ? '<i class="fa ' . $link['fa'] . '"></i>' . nbs(2) : '';
					$attrs = isset($link['attrs']) ? $link['attrs'] : '';
		?>
        	<li><a <?=$id;?> <?=$class;?> href="<?=$url;?>" <?=$data;?> <?=$attrs;?>><?=$fa;?><?=$link['label'];?></a></li>
        <?php }} ?>
    </ul>
</div>