
<div class="container main-container headerOffset">
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span>KLOP CHECKOUT</span></h1>
    </div>
  </div> <!--/.row-->
  
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <div class="w100 clearfix">
           	<?=modules::run('cart/checkout/order_step_header','address');?>
          </div>
          
          
          <div class="w100 clearfix">
            <div class="row userInfo">
              <div class="col-lg-12">
                <p><input id="chk-box-same-as-profile"  value="forever" checked="checked" type="checkbox"> Same address as my user profile (billing address)</p>
                <p><span class="required"><sup>*</sup></span> required field</p>
              </div>
              <div id="ajax-delivery-from">
                  <?=modules::run('cart/checkout/get_deliver_address','populate');?>
              </div>
            </div>
            <!--/row end--> 
            
          </div>
          <div class="cartFooter w100">
            <div class="box-footer">
              <div class="pull-left"> <a class="btn btn-primary" href="<?=base_url();?>"> <i class="fa fa-arrow-left"></i> &nbsp; Back to Shop </a> </div>
              <div class="pull-right"><button type="button" id="btn-save-delivery-address" class="btn btn-success"> Continue &nbsp; <i class="fa fa-arrow-circle-right"></i></button></div>
            </div>
          </div>
          <!--/ cartFooter --> 
          
        </div>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 rightSidebar">
      <div class="w100 cartMiniTable" id="rightbar-cart">
        <?=modules::run('cart/rightbar_cart',true);?>
      </div>
      <!--  /cartMiniTable--> 
      
    </div>
    <!--/rightSidebar--> 
    
  </div> <!--/row-->
  
  <div style="clear:both"></div>
</div>
<!-- /.main-container-->
<div class="gap"> </div>