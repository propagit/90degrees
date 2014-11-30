
<div class="container main-container headerOffset">
  
   <?=$breadcrumb;?>
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <p> Your account has been created. </p>
          <h2 class="block-title-2"><span>Welcome to your account. Here you can manage all of your personal information and orders.</span></h2>
          <ul class="myAccountList row">
          	<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="Orders" href="<?=base_url();?>customer/order_history"><i class="fa fa-calendar"></i> Order history </a> </div>
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="Personal information" href="<?=base_url();?>customer/personal"><i class="fa fa-cog"></i> Personal information</a> </div>
            </li>
            <?php if(0){ ?>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="My billing addresses" href="<?=base_url();?>customer/billing"><i  class="fa fa-map-marker"></i> My billing addresses</a> </div>
            </li>
            <?php } ?>
          </ul>
          <div class="clear clearfix"> </div>
        </div>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5"> </div>
  </div>
  <!--/row-->
  
  
  
  <div style="clear:both"></div>
  
</div>
<!-- /.main-container-->
<div class="gap"> </div>

