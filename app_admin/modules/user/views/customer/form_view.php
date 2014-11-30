<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-users"></i> 
				Users
			<span>>  
				<?=(isset($customer)) ? 'Update Customer "' . $customer['first_name'] . ' ' . $customer['last_name'] . '"' : 'Add New Customer';?>
			</span>
		</h1>
	</div>
</div>

<div class="alert alert-success fade in hide" id="msg-customer">
	<button class="close" data-dismiss="alert">
		×
	</button>
	<i class="fa-fw fa fa-check"></i>
	<span></span>
</div>

<div class="alert alert-danger fade in hide" id="msg-error">
	<button class="close" data-dismiss="alert">
		×
	</button>
	<i class="fa-fw fa fa-times"></i>
	<span></span>
</div>


<!-- widget grid -->
<section id="widget-grid" class="">


	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 <?=isset($customer) ? 'col-lg-12' : 'col-lg-12';?>">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Customer Info</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form id="form-customer" class="smart-form">

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="first_name" placeholder="First name" maxlength="255" value="<?=isset($customer) ? $customer['first_name'] : '';?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="last_name" placeholder="Last name"  maxlength="255" value="<?=isset($customer) ? $customer['last_name'] : '';?>">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
											<input type="email" name="email" placeholder="E-mail"  maxlength="255" value="<?=isset($customer) ? $customer['email'] : '';?>">
										</label>
									</section>
                                    <section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-calendar"></i>
											<input type="text" name="dob" id="dob" placeholder="dob" data-mask="99/99/9999" data-mask-placeholder="-" value="<?=isset($customer) ? date('d/m/Y',strtotime($customer['dob'])) : '';?>">
										</label>
									</section>
								</div>
                                <div class="row">
                                    <section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-mobile"></i>
											<input type="text" name="mobile" placeholder="Mobile"  maxlength="32" value="<?=isset($customer) ? $customer['mobile'] : '';?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-phone"></i>
											<input type="tel" name="phone" placeholder="Phone"  maxlength="32" value="<?=isset($customer) ? $customer['phone'] : '';?>">
										</label>
									</section>
								</div>
                                <div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="username" placeholder="Username"  maxlength="64" <?=isset($user) ? 'value="'.$user['username'].'" disabled="disabled"' : '';?>>
										</label>
									</section>
                                    <section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-lock"></i>
											<input type="password" name="password" placeholder="Password">
										</label>
									</section>
								</div>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-3">
										<label class="select">
											<select name="country">
												<option value="0" selected="" disabled="">Country</option>
												<option value="Australia" <?=isset($customer) ? ($customer['country'] == 'Australia' ? 'selected="selected"' : '') : '';?>>Australia</option>
											</select> <i></i> </label>
									</section>

									<section class="col col-3">
										<label class="select">
											<select name="state">
												<option value="0" selected="" disabled="">State</option>
												<option value="ACT" <?=isset($customer) ? ($customer['state'] == 'ACT' ? 'selected="selected"' : '') : '';?>>ACT</option>
												<option value="NSW" <?=isset($customer) ? ($customer['state'] == 'NSW' ? 'selected="selected"' : '') : '';?>>NSW</option>
                                                <option value="NT" <?=isset($customer) ? ($customer['state'] == 'NT' ? 'selected="selected"' : '') : '';?>>NT</option>
                                                <option value="VIC" <?=isset($customer) ? ($customer['state'] == 'VIC' ? 'selected="selected"' : '') : '';?>>VIC</option>
                                                <option value="QLD" <?=isset($customer) ? ($customer['state'] == 'QLD' ? 'selected="selected"' : '') : '';?>>QLD</option>
                                                <option value="SA" <?=isset($customer) ? ($customer['state'] == 'SA' ? 'selected="selected"' : '') : '';?>>SA</option>
                                                <option value="WA" <?=isset($customer) ? ($customer['state'] == 'WA' ? 'selected="selected"' : '') : '';?>>WA</option>
                                                <option value="TAS" <?=isset($customer) ? ($customer['state'] == 'TAS' ? 'selected="selected"' : '') : '';?>>TAS</option>
											</select> <i></i> </label>
									</section>
									
                                    <section class="col col-3">
										<label class="input">
											<input type="text" name="suburb" placeholder="Suburb" maxlength="255" value="<?=isset($customer) ? $customer['suburb'] : '';?>">
										</label>
									</section>
                                    
									<section class="col col-3">
										<label class="input">
											<input type="text" name="postcode" placeholder="Post code" maxlength="16" value="<?=isset($customer) ? $customer['postcode'] : '';?>">
										</label>
									</section>
								</div>

								<section>
									<label for="address" class="input">
										<input type="text" name="address1" placeholder="Address 1" maxlength="255" value="<?=isset($customer) ? $customer['address1'] : '';?>">
									</label>
								</section>
                                
                                <section>
									<label for="address" class="input">
										<input type="text" name="address2" placeholder="Address 2" maxlength="255" value="<?=isset($customer) ? $customer['address2'] : '';?>">
									</label>
								</section>

								<section>
									<label class="textarea"> 										
										<textarea rows="3" name="additional_info" placeholder="Additional info"><?=isset($customer) ? $customer['additional_info'] : '';?></textarea> 
									</label>
								</section>
								<? foreach($custom_fields as $field) { ?>
								<section>
									<label> 										
										<?=$field['label'];?>
										<b><?=$field['value'];?></b>
									</label>
								</section>
								<? } ?>
							</fieldset>

							<footer>
                            	<?php if(isset($customer)){ ?>
								<button type="button" id="btn-update-customer" class="btn btn-primary">
                                	<input type="hidden" name="user_id" value="<?=$user['user_id'];?>" />
                                	Update
                                </button>
                                <?php }else{ ?>
                                <button type="button" id="btn-add-customer" class="btn btn-primary">
									Save
								</button>
                                <button type="reset" class="btn btn-primary">
                                	Reset
                                </button>
                                <?php } ?>
							</footer>
						</form>

					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->
        
        <?php 
			if(0){
			#if(isset($customer)) { 
		?>
        
        <article class="col-sm-12 col-md-12 col-lg-6">
    			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Billing Address </h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form id="form-billing" class="smart-form">
							<fieldset>
								<div class="row">
									<section class="col col-3">
										<label class="select">
											<select name="billing_country">
												<option value="0" selected="" disabled="">Country</option>
												<option value="Australia" <?=isset($customer) ? ($customer['billing_country'] == 'Australia' ? 'selected="selected"' : '') : '';?>>Australia</option>
											</select> <i></i> </label>
									</section>

									<section class="col col-3">
										<label class="select">
											<select name="billing_state">
												<option value="0" selected="" disabled="">State</option>
                                                <option value="ACT" <?=isset($customer) ? ($customer['billing_state'] == 'ACT' ? 'selected="selected"' : '') : '';?>>ACT</option>
												<option value="NSW" <?=isset($customer) ? ($customer['billing_state'] == 'NSW' ? 'selected="selected"' : '') : '';?>>NSW</option>
                                                <option value="NT" <?=isset($customer) ? ($customer['billing_state'] == 'NT' ? 'selected="selected"' : '') : '';?>>NT</option>
                                                <option value="VIC" <?=isset($customer) ? ($customer['billing_state'] == 'VIC' ? 'selected="selected"' : '') : '';?>>VIC</option>
                                                <option value="QLD" <?=isset($customer) ? ($customer['billing_state'] == 'QLD' ? 'selected="selected"' : '') : '';?>>QLD</option>
                                                <option value="SA" <?=isset($customer) ? ($customer['billing_state'] == 'SA' ? 'selected="selected"' : '') : '';?>>SA</option>
                                                <option value="WA" <?=isset($customer) ? ($customer['billing_state'] == 'WA' ? 'selected="selected"' : '') : '';?>>WA</option>
                                                <option value="TAS" <?=isset($customer) ? ($customer['billing_state'] == 'TAS' ? 'selected="selected"' : '') : '';?>>TAS</option>
											</select> <i></i> </label>
									</section>
									
                                    <section class="col col-3">
										<label class="input">
											<input type="text" name="billing_suburb" placeholder="Suburb" maxlength="255" value="<?=isset($customer) ? $customer['billing_suburb'] : '';?>">
										</label>
									</section>
                                    
									<section class="col col-3">
										<label class="input">
											<input type="text" name="billing_postcode" placeholder="Post code" maxlength="16" value="<?=isset($customer) ? $customer['billing_postcode'] : '';?>"> 
										</label>
									</section>
								</div>

								<section>
									<label for="address" class="input">
										<input type="text" name="billing_address1" placeholder="Address 1" maxlength="255" value="<?=isset($customer) ? $customer['billing_address1'] : '';?>">
									</label>
								</section>
                                
                                <section>
									<label for="address" class="input">
										<input type="text" name="billing_address2" placeholder="Address 2" maxlength="255" value="<?=isset($customer) ? $customer['billing_address2'] : '';?>">
									</label>
								</section>
							</fieldset>

							<footer>
								<button type="button" id="btn-update-billing" class="btn btn-primary">
                                	<input type="hidden" name="user_id" value="<?=$user['user_id'];?>" />
									Update Billing Address
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->	
            
        </article>
        
        <?php } // end if sset customer ?>
		

	</div>

	<!-- END ROW -->

</section>
<!-- end widget grid -->

		
<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">

	pageSetUp();
	
	// pagefunction
	
	var pagefunction = function() {
		
		$('#btn-add-customer').click(function(){
			ajax_submit_form('form-customer', '<?=ajax_url() . 'user/user_ajax/add'?>', function(e){
				window.location.hash = '<?=base_url();?>admin/customer/update/'+e+'/1';
			});
		})
		
		$('#btn-update-customer').click(function(){
			ajax_submit_form('form-customer','<?=ajax_url() . 'user/user_ajax/update_basic'?>', function(e){
				$('#msg-customer').find('span').html('Customer\'s basic info updated successfully!');
				$('#msg-customer').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-customer').addClass('hide');
				}, 4000);
			});
		});
		
		$('#btn-update-billing').click(function(){
			ajax_submit_form('form-billing','<?=ajax_url() . 'user/user_ajax/update_billing'?>', function(e){
				$('#msg-customer').find('span').html('Customer\'s billing info updated successfully!');
				$('#msg-customer').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-customer').addClass('hide');
				}, 4000);
			});
		});
		
		<?php
			if(isset($is_new)){
		?>
				$('#msg-customer').find('span').html('New Customer created successfully!');
				$('#msg-customer').removeClass('hide');
				setTimeout(function(){
					$('#msg-customer').addClass('hide');
				}, 4000);
		<?php } ?>
		
		
	
	};
	
	// Load form valisation dependency 
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/jquery-form/jquery-form.min.js", pagefunction);
	

</script>
