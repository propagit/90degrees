<div class="row">
	<div class="breadcrumbDiv col-lg-12">
		<ul class="breadcrumb">
			<li><a href="<?=base_url();?>">Home</a> </li>
			<? for($i = 0; $i < count($pages); $i++) { ?>
			<? if ($i < count($pages) - 1) { ?>
			<li><a href="<?=$pages[$i]['url'];?>"><?=$pages[$i]['label'];?></a></li>
			<? } else { ?>
			<li class="active"><?=$pages[$i]['label'];?></li>
			<? } ?>
			<? } ?>
		</ul>
	</div>
</div>