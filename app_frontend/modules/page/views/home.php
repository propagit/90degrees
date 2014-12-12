  
  
<div class="container hide">
      <h1>WE DO STREET ART</h1>
      <h3>HIRE AUSTRALIA’S BEST GRAFFITI & STREET ARTISTS - EVENT, RETAIL, HOME & CORPORATE</h3>
      <h4>our work</h4>
</div>
<div class="container">
    <div class="banner">
        <div class="slider-content">
          <ul id="pager2" class="container hide">
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
                    <div class="col-xs-6 banner-caption">
                        <h1><?=$banner['name'];?></h1>
                        <h4><?=$banner['caption'];?> <i class="fa fa-map-marker"></i></h4>
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
</div>

<div class="container main-container"> 
  
  <!-- Main component call to action -->
  
  <div class="featuredPostContainer style2 tiles-wrap fw">
		 <?php 
	  	if($tiles){ 
	  		foreach($tiles as $tile){
				if($tile['feature_image_id']){
					$tile_image = modules::run('page/get_tiles_feature_image',$tile['feature_image_id']);
				}else{
					$tile_image = modules::run('page/get_tiles_first_image',$tile['tile_id']);
				}
	 	 ?>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 remove-gutters tiles">
         	<div class="col-xs-12 remove-gutters">
        	<a <?=$tile['tile_uri'] ? 'href="our-work/' . $tile['tile_uri'] . '"' : '';?> <?=$tile['new_window'] ? 'target="_blank"' : '';?>>
                <div class="tiles-bg" style="background-image: url('<?=base_url() . substr($tile_image['full_path'],2);?>');">
                	<span class="hidden-xs">&nbsp;</span>
                	<img class="visible-xs" src="<?=base_url() . substr($tile_image['full_path'],2);?>" >
                </div>
                <div class="tiles-caption fadeout">
                    <h1><?=$tile['name'];?></h1>
                    <h4><?=$tile['short_desc'];?> <i class="fa fa-map-marker"></i></h4>
                </div>
            </a>
            </div>
         </div>
      
      <?php }} ?>
  </div>
  <!--/.featuredPostContainer--> 
</div>