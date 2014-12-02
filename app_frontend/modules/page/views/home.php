  
  
<div class="container">
      <h1>WE DO STREET ART</h1>
      <h3>HIRE AUSTRALIA’S BEST GRAFFITI & STREET ARTISTS - EVENT, RETAIL, HOME & CORPORATE</h3>
      <h4>our work</h4>
</div>

<div class="container-fuild banner">
    <div class="slider-content">
      <ul id="pager2" class="container">
      </ul>
      <!-- prev/next links --> 
      
      <span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span> <span class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>
      <div class="slider slider-v1" 
      data-cycle-swipe=true
      data-cycle-prev=".prevControl"
      data-cycle-next=".nextControl" data-cycle-loader="wait">
      <?php 
	  	if($banners){ 
			$increment = 1;
	  		foreach($banners as $banner){
				$banner_image = modules::run('page/get_banner_first_image',$banner['banner_id']);
	  ?>
      	<div class="slider-item slider-item-img<?=$increment++;?> banner-img-wrap">
        	<a <?=$banner['banner_uri'] ? 'href="' . $banner['banner_uri'] . '"' : '';?> <?=$banner['new_window'] ? 'target="_blank"' : '';?>><img src="<?=base_url() . $banner_image['full_path'];?>" data-upload-id="<?=$banner_image['upload_id'];?>" data-img="<?=base_url() . $banner_image['full_path'];?>" alt="<?=$banner_image['orig_name'];?>" title="<?=$banner_image['orig_name'];?>" class="superbox-img"></a>
            
            <div class="container">
                <div class="banner-caption">
                    <h1><?=$banner['name'];?></h1>
                    <h4>retail ~ prahran victoria <i class="fa fa-map-marker"></i></h4>
                </div>
        	</div>
        </div>
        
      <?php } } ?>
      </div>
      <!--/.slider slider-v1--> 
    </div>
    <!--/.slider-content--> 

</div>
<!--/.banner style1-->

<div class="container main-container"> 
  
  <!-- Main component call to action -->
  
  <div class="row featuredPostContainer custom-padding style2 tiles-wrap fw">
		 <?php 
	  	if($tiles){ 
	  		foreach($tiles as $tile){
				$tile_image = modules::run('page/get_tiles_first_image',$tile['tile_id']);
	 	 ?>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 tiles">
        	<a <?=$tile['tile_uri'] ? 'href="' . $tile['tile_uri'] . '"' : '';?> <?=$tile['new_window'] ? 'target="_blank"' : '';?>><img src="<?=base_url() . $tile_image['full_path'];?>" data-upload-id="<?=$tile_image['upload_id'];?>" data-img="<?=base_url() . $tile_image['full_path'];?>" alt="<?=$tile_image['orig_name'];?>" title="<?=$tile_image['orig_name'];?>" class="superbox-img"></a>
         </div>
      
      <?php }} ?>
  </div>
  <!--/.featuredPostContainer--> 
</div>