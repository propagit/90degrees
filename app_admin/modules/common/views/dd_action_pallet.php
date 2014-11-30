<?php
	#config 
	$btn_class = isset($params['btn_class']) ? $params['btn_class'] : 'btn-primary';
	$links = $params['links'];
?>

<div class="btn-group">
    <a class="btn <?=$btn_class;?>" href="javascript:void(0);"><?=$params['btn_name'];?></a>
    <a class="btn <?=$btn_class;?> dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><span class="caret"></span></a>
    <ul class="dropdown-menu <?=isset($params['ul_class']) ? $params['ul_class'] : '';?>">
    	<?php 
			foreach($links as $link){ 
				$url = isset($link['url']) ? $link['url'] : 'javascript:void(0);';
				$id = isset($link['id']) ? 'id ="' . $link['id'] . '"' : '';
				$class = isset($link['class']) ? 'class ="' . $link['class'] . '"' : '';
				$data = isset($link['data']) ? 'data ="' . $link['data'] . '"' : '';
				$fa = isset($link['fa']) ? '<i class="fa ' . $link['fa'] . '"></i>' . nbs(2) : '';
				$attrs = isset($link['attrs']) ? $link['attrs'] : '';
		?>
        	<li><a <?=$id;?> <?=$class;?> href="<?=$url;?>" <?=$data;?> <?=$attrs;?>><?=$fa;?><?=$link['label'];?></a></li>
        <?php } ?>
    </ul>
</div>