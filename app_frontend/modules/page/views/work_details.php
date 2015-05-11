<div class="parallax-section parallax-fx parallax-image-aboutus parallaxOffset no-padding">
  
</div>
<!-- /.parallax -->

<div class="container main-container ">
  
  <div class="row innerPage">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
         
            
            <div id="work-banners" class="work-gallery carousel slide hidden-xs" data-ride="carousel" data-interval="false">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php
						$counter = 0;
						$pager = '';
                        foreach($work_gallery as $gallery){
							$pager .= '<li data-target="#work-banners" data-slide-to="' . $counter . '" ' . (!$counter ? 'class="active"' : '') . '></li>';
                    ?>
                    <!-- rest of the banners -->
                    <div class="item <?=!$counter ? 'active' : '';?>">
                          <img src="<?=base_url() . $gallery['full_path'];?>" title="<?=$gallery['orig_name'];?>">
                    </div>
                    <?php $counter++;} ?>
                   
                    
                </div>
                <!-- Controls -->
                <a class="left carousel-control hidden-xs" href="#work-banners" role="button" data-slide="prev">
                    <span class="slide-btn"><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control hidden-xs" href="#work-banners" role="button" data-slide="next">
                    <span class="slide-btn"><i class="fa fa-angle-right"></i></span>
                </a>
                
                 <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php echo $pager; ?>
                </ol>
                
                <div class="col-xs-12 swipe-icon visible-xs hide">
            		<img src="<?=base_url() . ASSETS;?>images/swipe.png">
            	</div>
                
                
        </div>
        
        <div class="col-xs-12 visible-xs mob-gallery">
        	<?php
				$counter = 0; 
				foreach($work_gallery as $gallery){ ?>
                <a rel="gallery-1" href="<?=base_url() . $gallery['full_path'];?>" class="swipebox <?=$counter ? 'hide' : ''; ?>">
                    <img src="<?=base_url() . $gallery['full_path'];?>" alt="image">
                </a>
			<?php $counter++;} ?>
        	
          </div>  
            
            
            <?php if(0) { ?>
            <!--<div id="toggle-job-info" class="job-info-btn-bg pointer push">
            	<div class="job-info-btn"><i class="fa fa-info-circle"></i> <h4>JOB INFO</h4></div>
                <div class="job-info-btn primary-color" style="display:none;"><i class="fa fa-minus-square-o"></i><h4>HIDE</h4></div>
            </div>-->
            <?php } # removed toggle function for now ?>
            
            <div class="col-xs-12 remove-gutters">
                 <h1 class="title-big">
                    <?=$work['name'];?>
                 </h1>
                 <span class="slogan push-txt"><?=$work['short_desc'];?> <i class="fa fa-map-marker"></i></span>
            </div>
            
             <div id="job-info" class="col-lg-8 col-md-8 col-sm-8 col-xs-12 remove-gutters job-info">
            
            	<?=$work['content'];?>
                
                <div class="share-icons">
                	<?php
						# config 
						$share_url = urlencode(base_url() . 'our-work/' . $work['tile_uri']);
						$title = $work['name'];
						$path = parse_url(base_url());
						$domain = $path['host'];
						if($work['feature_image_id']){
							$feature_img = modules::run('page/get_tiles_feature_image',$work['feature_image_id']);
						}else{
							$feature_img = modules::run('page/get_tiles_first_image',$work['tile_id']);
						} 
						$share_img_uri = urlencode(base_url() . substr($feature_img['full_path'],2));
					?>
                	<h4>SHARE</h4>
                    <a href="http://www.facebook.com/sharer/sharer.php?u=<?=$share_url;?>&title=<?=$title;?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$share_url;?>&title=<?=$title;?>&source=<?='www.'.$domain;?>" target="_blank"><i class="fa fa-linkedin-square"></i></a>
                    <a href="http://twitter.com/intent/tweet?status=<?=$work['name'];?>+<?=$share_url;?>" target="_blank"><i class="fa fa-twitter-square"></i></a>
                    <a href="http://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="http://pinterest.com/pin/create/bookmarklet/?media=<?=$share_img_uri;?>&url=<?=$share_url;?>&is_video=false&description=<?=$title;?>" target="_blank"><i class="fa fa-pinterest-square"></i></a>
                    <a href="mailto:info@<?=$domain;?>"><i class="fa fa-envelope"></i></a>
                    
      				
                </div>
                
                <?php if(!$work['home_page']){ ?>
                	<a href="<?=base_url();?>our-services.html" class="btn-back"><img src="<?=base_url();?>assets/frontend/images/back-btn.png" alt="back-btn.png" title="Back To Services"></a>
                <?php } ?>
            </div>

        </div>
      </div>  <!--/row end-->
    </div>
  </div> <!--/.innerPage-->
  <div style="clear:both">  </div>
</div><!-- /.main-container -->