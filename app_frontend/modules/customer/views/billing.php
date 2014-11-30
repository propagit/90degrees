
<div class="container main-container headerOffset">
  
   <?=$breadcrumb;?>
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-user"></i> My personal information </span></h1>
      <div class="row userInfo">
        <div class="col-lg-12">
          <h2 class="block-title-2"> Please be sure to update your personal information if it has changed. </h2>
          <p class="required"><sup>*</sup> Required field</p>
        </div>
        <form method="post" id="update-billing-form">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group required">
              <label>Address <sup>*</sup> </label>
              <input type="text" class="form-control" name="address1" placeholder="Address"  value="<?=isset($customer['billing_address1']) ? $customer['billing_address1'] : '';?>">
            </div>
            <div class="form-group">
              <label>Address (Line 2) </label>
              <input type="text" class="form-control" name="address2" placeholder="Address Line 2"  value="<?=isset($customer['billing_address2']) ? $customer['billing_address2'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Suburb <sup>*</sup> </label>
              <input required type="text" class="form-control" name="suburb" placeholder="Suburb"  value="<?=isset($customer['billing_suburb']) ? $customer['billing_suburb'] : '';?>">
            </div>
         </div>
         <div class="col-xs-12 col-sm-6">
            <div class="form-group required">
              <label>State <sup>*</sup> </label>
        
                <select class="form-control" name="state">
                    <option value="ACT" <?=isset($customer['state']) ? ($customer['state'] == 'ACT' ? 'selected="selected"' : '') : '';?>>ACT</option>
                    <option value="NSW" <?=isset($customer['state']) ? ($customer['state'] == 'NSW' ? 'selected="selected"' : '') : '';?>>NSW</option>
                    <option value="NT" <?=isset($customer['state']) ? ($customer['state'] == 'NT' ? 'selected="selected"' : '') : '';?>>NT</option>
                    <option value="VIC" <?=isset($customer['state']) ? ($customer['state'] == 'VIC' ? 'selected="selected"' : '') : '';?>>VIC</option>
                    <option value="QLD" <?=isset($customer['state']) ? ($customer['state'] == 'QLD' ? 'selected="selected"' : '') : '';?>>QLD</option>
                    <option value="SA" <?=isset($customer['state']) ? ($customer['state'] == 'SA' ? 'selected="selected"' : '') : '';?>>SA</option>
                    <option value="WA" <?=isset($customer['state']) ? ($customer['state'] == 'WA' ? 'selected="selected"' : '') : '';?>>WA</option>
                    <option value="TAS" <?=isset($customer['state']) ? ($customer['state'] == 'TAS' ? 'selected="selected"' : '') : '';?>>TAS</option>
              </select>
            </div>
            <div class="form-group required">
              <label>Post Code <sup>*</sup> </label>
              <input required type="text" class="form-control" name="postcode" placeholder="Post Code"  value="<?=isset($customer['billing_postcode']) ? $customer['billing_postcode'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Country <sup>*</sup> </label>
                <select class="form-control" name="country">
                  <option value="Australia" selected>Australia</option>
               </select>
            </div>
          </div>
          <div style="clear:both"></div>
          <div col-lg-12>
          	<div class="col-lg-12">
            	<button type="button" class="btn   btn-primary" id="btn-update-billing"><i class="fa fa-save"></i> &nbsp; Save </button>
          	</div>
          </div>
        </form>
        <?=modules::run('customer/account_footer_nav');?>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5"> </div>
  </div> <!--/row-->
  
  
  
  <div style="clear:both"></div>
  
</div>
<!-- /.main-container-->
<div class="gap"> </div>

