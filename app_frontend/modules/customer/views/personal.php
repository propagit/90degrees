
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
        <form method="post" id="update-personal-form">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group required">
              <label>First Name <sup>*</sup> </label>
              <input required type="text" class="form-control" name="first_name" placeholder="First Name" value="<?=isset($customer['first_name']) ? $customer['first_name'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Last Name <sup>*</sup> </label>
              <input required type="text" class="form-control" name="last_name" placeholder="Last Name"  value="<?=isset($customer['last_name']) ? $customer['last_name'] : '';?>">
            </div>
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="text" class="form-control" name="dob" placeholder="99/99/9999" data-mask="99/99/9999" data-mask-reverse="true" value="<?=isset($customer['dob']) ? date('d/m/Y',strtotime($customer['dob'])) : '';?>"/>
            </div>
            <div class="form-group required">
              <label>Email <sup>*</sup></label>
              <input required type="email" class="form-control" name="email" placeholder="Email" value="<?=isset($customer['email']) ? $customer['email'] : '';?>">  
            </div>
            <div class="form-group required">
              <label>Mobile <sup>*</sup></label>
              <input type="text" class="form-control" name="mobile" placeholder="Mobile"  value="<?=isset($customer['mobile']) ? $customer['mobile'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Phone <sup>*</sup></label>
              <input type="text" class="form-control" name="phone" placeholder="Phone"  value="<?=isset($customer['phone']) ? $customer['phone'] : '';?>">
            </div>
            <div class="form-group">
              <label>Additional information</label>
              <textarea rows="3" cols="26" name="additional_info" class="form-control"><?=isset($customer['additional_info']) ? $customer['additional_info'] : '';?></textarea>
            </div>
            
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group required">
              <label>Address <sup>*</sup> </label>
              <input type="text" class="form-control" name="address1" placeholder="Address"  value="<?=isset($customer['address1']) ? $customer['address1'] : '';?>">
            </div>
            <div class="form-group">
              <label>Address (Line 2) </label>
              <input type="text" class="form-control" name="address2" placeholder="Address Line 2"  value="<?=isset($customer['address2']) ? $customer['address2'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Suburb <sup>*</sup> </label>
              <input required type="text" class="form-control" name="suburb" placeholder="Suburb"  value="<?=isset($customer['suburb']) ? $customer['suburb'] : '';?>">
            </div>
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
              <input required type="text" class="form-control" name="postcode" placeholder="Post Code"  value="<?=isset($customer['postcode']) ? $customer['postcode'] : '';?>">
            </div>
            <div class="form-group required">
              <label>Country <sup>*</sup> </label>
                <select class="form-control" name="country">
                  <option value="Australia" selected>Australia</option>
               </select>
            </div>
            <div class="form-group required">
              <label>Password </label>
              <input required type="password" class="form-control" name="password" value="" autocomplete="off">
            </div>
          </div>
          <div style="clear:both"></div>
          <div col-lg-12>
          	<div class="col-lg-12">
            	<button type="button" class="btn   btn-primary" id="btn-update-personal"><i class="fa fa-save"></i> &nbsp; Save </button>
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

