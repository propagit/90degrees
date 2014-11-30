<form id="delivery-address-form">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group required">
      <label>First Name <sup>*</sup> </label>
      <input required type="text" class="form-control" name="first_name" placeholder="First Name" value="<?=isset($customer['first_name']) ? $customer['first_name'] : '';?>">
    </div>
    <div class="form-group required">
      <label>Last Name <sup>*</sup> </label>
      <input required type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?=isset($customer['last_name']) ? $customer['last_name'] : '';?>">
    </div>
    <div class="form-group required">
      <label>Mobile <sup>*</sup></label>
      <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?=isset($customer['mobile']) ? $customer['mobile'] : '';?>">
    </div>
    <div class="form-group required">
      <label>Phone <sup>*</sup></label>
      <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?=isset($customer['phone']) ? $customer['phone'] : '';?>">
    </div>
    <div class="form-group">
      <label>Order Comments</label>
      <textarea rows="5" cols="26" name="order_comment" class="form-control"></textarea>
    </div>
    
  </div>
  <div class="col-xs-12 col-sm-6">
    <div class="form-group required">
      <label>Address <sup>*</sup> </label>
      <input type="text" class="form-control" name="address1" placeholder="Address" value="<?=isset($customer['address1']) ? $customer['address1'] : '';?>">
    </div>
    <div class="form-group">
      <label>Address (Line 2) </label>
      <input type="text" class="form-control" name="address2" placeholder="Address" value="<?=isset($customer['address2']) ? $customer['address2'] : '';?>">
    </div>
    <div class="form-group required">
      <label>Suburb <sup>*</sup> </label>
      <input required type="text" class="form-control" name="suburb" placeholder="Suburb" value="<?=isset($customer['suburb']) ? $customer['suburb'] : '';?>">
    </div>
    <div class="form-group required">
      <label>State <sup>*</sup> </label>

        <select class="form-control" name="state">
            <option value="ACT" <?=isset($customer['state']) ? ($customer['state'] == "ACT" ? 'selected="selected"' : '') : 'selected="selected"';?>>ACT</option>
            <option value="NSW" <?=isset($customer['state']) ? ($customer['state'] == "NSW" ? 'selected="selected"' : '') : '';?>>NSW</option>
            <option value="NT" <?=isset($customer['state']) ? ($customer['state'] == "NT" ? 'selected="selected"' : '') : '';?>>NT</option>
            <option value="VIC" <?=isset($customer['state']) ? ($customer['state'] == "VIC" ? 'selected="selected"' : '') : '';?>>VIC</option>
            <option value="QLD" <?=isset($customer['state']) ? ($customer['state'] == "QLD" ? 'selected="selected"' : '') : '';?>>QLD</option>
            <option value="SA" <?=isset($customer['state']) ? ($customer['state'] == "SA" ? 'selected="selected"' : '') : '';?>>SA</option>
            <option value="WA" <?=isset($customer['state']) ? ($customer['state'] == "WA" ? 'selected="selected"' : '') : '';?>>WA</option>
            <option value="TAS" <?=isset($customer['state']) ? ($customer['state'] == "TAS" ? 'selected="selected"' : '') : '';?>>TAS</option>
      </select>
    </div>
    <div class="form-group required">
      <label>Post Code <sup>*</sup> </label>
      <input required type="text" class="form-control" name="postcode" placeholder="Post Code" value="<?=isset($customer['state']) ? $customer['postcode'] : '';?>">
    </div>
    <div class="form-group required">
      <label>Country <sup>*</sup> </label>
        <select class="form-control" name="country">
          <option value="Australia" selected>Australia</option>
       </select>
    </div>
   
  </div>
  <div class="clearfix">
	  <div class="col-xs-12">		  
		  	<?=modules::run('customfield/view', 1, isset($customer['user_id']) ? $customer['user_id'] : '');?>
	  </div>
  </div>
</form>