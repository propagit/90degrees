<div class="container main-container headerOffset"> 
  
  <!-- Main component call to action -->
  
 <?php #echo $breadcrumb;?>
  
  <div class="row">
  
    <div class="col-xs-12">
  	  <div class="w100 clearfix category-top">
        	<h1> SHOP 90 DEGREES</h1>
        	<?php echo modules::run('cart/get_mini_cart');?>
      </div><!--/.category-top-->
    </div>
  
   <!--left column-->
  
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="panel-group" id="accordionNo">
       <!--Category--> 
        <div class="panel panel-default panel-alt col-xs-10">
          <div class="panel-heading">
            <h4 class="panel-title"> 
            <a data-toggle="collapse" href="#collapseCategory" class="collapseWill"> 
            	 Shop Categories 
            </a> 
            </h4>
          </div>
          
          <div id="collapseCategory" class="panel-collapse collapse in">
            <div class="panel-body">
              
              <ul class="nav nav-pills nav-stacked tree cat-panel-ul">
              	<?php foreach($parent_categories as $pc) { ?>
              	<li> <a href="<?=base_url()?>category/<?=$pc['uri_path'];?>"> <span class="badge pull-right"></span> <?=$pc['name'];?> </a> </li>
              	<?php } ?>
              </ul>

            </div>
          </div>
        </div> <!--/Category menu end--> 

      </div>
    </div>
    
    
    <!--right column-->
    <div class="col-lg-9 col-md-9 col-sm-12">

      <div class="w100 productFilter clearfix">
        <h4 class="product-count pull-left"> Showing <strong>12</strong> products </h4>
        <div class="pull-right ">
          <div class="change-order pull-right">
            <select class="form-control" name="orderby">
              <option selected="selected" >Default sorting</option>
              <option value="popularity">Sort by popularity</option>
              <option value="rating">Sort by average rating</option>
              <option value="date">Sort by newness</option>
              <option value="price">Sort by price: low to high</option>
              <option value="price-desc">Sort by price: high to low</option>
            </select>
          </div>
          <div class="change-view pull-right"> 
          <a href="#" title="Grid" class="grid-view"> <i class="fa fa-th-large"></i> </a> 
          <a href="#" title="List" class="list-view "><i class="fa fa-th-list"></i></a> </div>
        </div>
      </div> <!--/.productFilter-->
      <div class="row  categoryProduct xsResponse clearfix">
       <?php foreach($products as $product){ ?>
       		<div class="item col-sm-4 col-lg-4 col-md-4 col-xs-6">
              <div class="product">
                <div class="image"> <a href="<?=base_url();?>product/<?=$product['uri_path'];?>"><img src="<?=base_url() . modules::run('catalog/product/image', $product['product_id']);?>" alt="img" class="img-responsive"></a>
                </div>
                <div class="description">
                  <h4><a href="product-details.html"><?=$product['name'];?></a></h4>
                  <p><?=$product['short_desc'];?></p>
                </div>
                <div class="price"> 
					<?php if($product['sale_price'] > 0){ ?>
                   		<span>$<?=$product['sale_price'];?></span>
                  		<span class="old-price">$<?=$product['price'];?></span>
                    <?php } else { ?>
                   		<span>$<?=$product['price'];?></span>
                    <?php } ?>
                  </div>
                  <div class="action-control">
					<a class="btn btn-primary add-to-cart" data-pid="<?=$product['product_id'];?>"> 
                    <span class="add2cart"><i class="fa fa-plus"></i> Add to cart </span> 
                    </a>
				</div>
              </div>
            </div><!--/.item-->
            <form id="form-product-<?=$product['product_id'];?>">
            	<input type="hidden" name="id" value="<?=$product['product_id'];?>" />
            	<input type="hidden" class="form-control" name="qty" value="1" />
            </form>
       <?php } ?>
       
        
            
        
    </div> <!--/.categoryProduct || product content end-->
      
      <div class="w100 categoryFooter">
      
      	<?php if(0){ ?>
        <div class="pagination pull-left no-margin-top">
          <ul class="pagination no-margin-top">
            <li><a href="#">«</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">»</a></li>
          </ul>
        </div>
        <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
          <p>Showing 1–450 of 12 results</p>
        </div>
        <?php } ?>
        
        <?php echo modules::run('common/pagination');?>
        
      </div> <!--/.categoryFooter-->
    </div><!--/right column end-->
    
    
    
  </div><!-- /.row  --> 
</div>

