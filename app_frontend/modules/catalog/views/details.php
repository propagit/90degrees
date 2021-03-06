<div class="container main-container">
  <?php // echo $breadcrumb;?>
  
  
  <div class="row transitionfx">
  
  	<div class="col-xs-12">
  		<div class="w100 clearfix category-top">
        	<h1 class="title-big"> SHOP 90 DEGREES</h1>
        	<?php echo modules::run('cart/get_mini_cart');?>
      </div><!--/.category-top-->
    </div>
  
   <!-- left column -->
    <div class="col-lg-6 col-md-6 col-sm-6">
    	<!-- product Image and Zoom -->
      <div class="main-image sp-wrap col-lg-12 no-padding"> 
      	<? 
		$count = 1;
		foreach($images as $image) { 
		?>
      	<a <?=$count > 2 ? 'class="hidden-xs"' : '';?> href="<?=base_url() . $image['full_path'];?>"><img src="<?=base_url() . $image['full_path'];?>" class="img-responsive" alt="img"></a>
      	<? $count++; } ?>
      </div>
    </div><!--/ left column end -->
    
    
    <!-- right column -->
    <div class="col-lg-6 col-md-6 col-sm-5">

      <h1 class="no-margin no-padding"> <?=$product['name'];?></h1>
     
      
      <div class="product-short-desc product-details">
        <?=$product['short_desc'];?>
      </div>
      
      <div class="product-tab w100 clearfix">
      
        <ul class="nav nav-pills nav-pills-alt">
          <li class="active"><a href="#details" data-toggle="tab">Description</a></li>
          <li><a href="#size" data-toggle="tab">Dimensions</a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content product-details">
          <div class="tab-pane product-desc active" id="details">
		  	<?=$product['long_desc'];?>
          </div>
          <div class="tab-pane product-desc product-dimensions" id="size">
                <p>
                	<strong>DIMENSIONS</strong><br>
                    Length : <?=isset($product['length']) && $product['length'] ? $product['length'] : 'NA';?>,  
                    Width : <?=isset($product['width']) && $product['width'] ? $product['width'] : 'NA';?>,  
                    Height : <?=isset($product['height']) && $product['height'] ? $product['height'] : 'NA';?> <br><br>
                    <strong>WEIGHT</strong><br>
                    <?=isset($product['weight']) && $product['weight'] ? $product['weight'] : 'NA';?> 
                </p>
          </div>
          
          <div class="product-share clearfix">
            <div class="socialIcon"> 
                <p class="inline">SHARE </p>
                <a target="_blank" href="<?=INSTAGRAM;?>"> <i  class="fa fa-instagram"></i></a> 
                <a target="_blank" href="<?=FACEBOOK;?>"> <i  class="fa fa-facebook-square"></i></a> 
            </div>
          </div>
          <!--/.product-share--> 
          
          <div class="product-price"> 
          	  <? if ($discount = modules::run('promotion/apply_product_promotions', $product['product_id'])) { ?>
          	  <span class="price-sales">$<?=money_format('%i', $product['price'] - $discount);?></span> 
              <span class="price-standard">$<?=money_format('%i', $product['price']);?></span> 
              <? } else if($product['sale_price'] > 0 && $product['sale_price'] != $product['price']) { ?>
              <span class="price-sales">$<?=money_format('%i', $product['sale_price']);?></span> 
              <span class="price-standard">$<?=money_format('%i', $product['price']);?></span> 
              <? } else { ?>
              <span class="price-sales"> $<?=money_format('%i', $product['price']);?></span> 
              <? } ?>
          </div>
          
        </div> <!-- /.tab content -->
        
      </div><!--/.product-tab-->
      


      
      <!-- product-form -->
      <form id="form-product">
      <input type="hidden" name="id" value="<?=$product['product_id'];?>" />
      <div class="productFilter col-xs-12 remove-gutters">
        <div class="filterBox">
          <div class="form-group required">
          	<div class="input-group input-group-alt">
          	<span class="input-group-addon">Quantity</span>
            <input required type="text" class="form-control text-center" name="qty" value="1" />
          	</div>
          </div>
        </div>
        <div class="cart-actions">
            <div class="addto">
              <a class="btn btn-primary add-to-cart" title="Add to Cart" type="button" id="btn-add-cart"><i class="fa fa-plus"></i> &nbsp;Add to Cart</a>
              <a href="<?=base_url();?>cart/checkout" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> &nbsp;Checkout</a> 
            </div>
        </div>
      </div>
      <!-- productFilter -->

      
      </form>
      <!--/.product-form -->
      
      
     
      
    </div><!--/ right column end -->
    
  </div>
  <!--/.row-->

  
  
</div> <!-- /main-container -->



