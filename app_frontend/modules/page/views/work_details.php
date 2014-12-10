<div class="parallax-section parallax-fx parallax-image-aboutus parallaxOffset no-padding">
  
</div>
<!-- /.parallax -->

<div class="container main-container ">
  
  <div class="row innerPage">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <h1>
              <?=$work['name'];?>
          </h1>
          <span class="slogan push-txt"><?=$work['short_desc'];?> <i class="fa fa-map-marker"></i></span>


		 	<!--gallery-->
         

            <div class="banner gallery">
                <div class="slider-content">
                  <!-- prev/next links --> 
                  <span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span> <span class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>
                  <div class="slider slider-v1" 
                  data-cycle-swipe=true
                  data-cycle-prev=".prevControl"
                  data-cycle-next=".nextControl" data-cycle-loader="wait">
                  <?php 
                    if($work_gallery){ 
                        $increment = 1;
                        foreach($work_gallery as $gallery){   
                  ?>
                    <div class="slider-item slider-item-img<?=$increment++;?> gallery-img-wrap text-center">
                        <img src="<?=base_url() . $gallery['full_path'];?>" title="<?=$gallery['orig_name'];?>" >

                    </div>
                    
                  <?php }} ?>
                  </div><!--/.slider slider-v1--> 
                </div><!--/.slider-content--> 
            </div><!--/.banner style1-->
            <ul id="pager2" class="container gallery-pager"></ul>
            
            <div id="toggle-job-info" class="pointer push fw">
            	<i class="fa fa-info-circle"></i> <h4>JOB INFO</h4>
            </div>
            
            <div id="job-info" class="col-lg-8 col-md-8 col-sm-8 col-xs-12 remove-gutters job-info hide">
            	<?=$work['content'];?>
                
                <div class="share-icons">
                	<h4>SHARE</h4>
                	<i class="fa fa-share-alt-square"></i>
                    <i class="fa fa-facebook-square"></i>
                    <i class="fa fa-linkedin-square"></i>
                    <i class="fa fa-twitter-square"></i>
                    <i class="fa fa-instagram"></i>
                    <i class="fa fa-pinterest-square"></i>
                    <i class="fa fa-envelope"></i>
                </div>
            </div>

        
        
        
        </div>
      </div>  <!--/row end-->
    </div>
  </div> <!--/.innerPage-->
  <div style="clear:both">  </div>
</div><!-- /.main-container -->

