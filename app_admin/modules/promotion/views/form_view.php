<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-edit fa-fw "></i> 
				Promotion 
			<span>> 
				<?=(isset($promotion)) ? 'Edit Promotion "' . $promotion['name'] . '"' : 'Create New Promotion';?>
			</span>
		</h1>
	</div>
</div>
<div class="alert alert-success fade in hide" id="msg-success">
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
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-collapsed="false">
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
					<h2>Promotion Details</h2>
					
					<ul class="nav nav-tabs pull-right in" id="myTab">
						
						<li<?=($tab == 'basic') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#basic"><i class="fa fa-info-circle"></i> <span class="hidden-mobile hidden-tablet">Basic Info</span></a>
						</li>
						<? if(isset($promotion)) { ?>
						<li<?=($tab == 'conditions') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#conditions"><i class="fa fa-site-map"></i> <span class="hidden-mobile hidden-tablet">Conditions</span></a>
						</li>
						<? } else { ?>
						<li class="disabled">
							<a><i class="fa fa-site-map"></i> <span class="hidden-mobile hidden-tablet">Conditions</span></a>
						</li>
					<? } ?>

					</ul>

				</header>

				<!-- widget div-->
				<div role="content">

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">
						<!-- content -->
						<div id="myTabContent" class="tab-content">
							<!-- new tab: API interface -->
							<div class="tab-pane fade<?=($tab == 'basic') ? ' active in' : '';?>" id="basic">							
								<form id="form-promotion-basic" class="smart-form">
									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Promotion Type</label>
												<label class="select">
													<select name="promotion_type">
                                                        <option value="cart">Cart Order</option>
                                                        <option value="catalog" <?=isset($promotion) ? ($promotion['promotion_type'] == 'catalog' ? 'selected="selected"' : '') : '';?>>Product Catalog</option>
                                                    </select>
												</label>
											</section>
											
											<section class="col col-6">
												<label class="label">Name <i class="fa fa-asterisk fa-required"></i></label>
												<label class="input">
													<input type="text" name="name" maxlength="255" value="<?=(isset($promotion)) ? $promotion['name'] : '';?>" />
												</label>
												<div class="note">
													<strong>Max characters</strong> 255
												</div>
											</section>
										</div>
                                        
                                        <div class="row">
											<section class="col col-6">
												<label class="label">Discount Type</label>
												<label class="select">
													<select name="discount_type">
                                                        <option value="percentage" <?=isset($promotion) ? ($promotion['discount_type'] == 'percentage' ? 'selected="selected"' : '') : '';?>>Percentage</option>
                                                        <option value="fixed" <?=isset($promotion) ? ($promotion['discount_type'] == 'fixed' ? 'selected="selected"' : '') : '';?>>Fixed Amount</option>
                                                    </select>
												</label>
											</section>
											
											<section class="col col-6">
												<label class="label">Discount Value</label>
                                                
                                                <div id="discount_fixed">
													<label class="input"> <i class="icon-prepend">$</i>
													<input class="form-control" type="text" name="discount_value[fixed]" value="<?=(isset($promotion)) ? $promotion['discount_value'] : '';?>">
                                                    </label>
												</div>
                                                
                                                <div id="discount_percentage">
                                                	<label class="input"> <i class="icon-append">%</i>
													<input class="form-control" type="text" name="discount_value[percentage]" value="<?=(isset($promotion)) ? $promotion['discount_value'] : '';?>">
                                                    </label>
												</div>
 
											</section>
										</div>
										
                                        <div class="row">
											<section class="col col-6">
                                            	<label class="label">Use Valid period</label>
												<label class="checkbox">
                                                <input type="checkbox" name="valid_period" <?=(isset($promotion)) ? ($promotion['valid_period'] ? 'checked="checked"' : '' ) : '';?> >
                                                <i></i>(If not ticked, this promotion will be valid as long as it is actived)</label>
                                          	</section>
                                            <section class="col col-6">
                                            	<label class="label">Status</label>
												<label class="checkbox">
                                                <input type="checkbox" name="status" <?=(isset($promotion)) ? ($promotion['status'] ? 'checked="checked"' : '' ) : '';?>>
                                                <i></i>(If ticked, this promotion will be set as active on creation)</label>
                                          	</section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-6">
                                            	<label class="label">Valid From</label>
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" class="form-control date-picker" name="date_from" id="startdate" placeholder="Promotion valid from date" value="<?=(isset($promotion) && $promotion['valid_period']) ? date('d-m-Y',strtotime($promotion['date_from'])) : '';?>">
                                                </label>
                                            </section>
                                            <section class="col col-6">
                                            	<label class="label">Valid To</label>
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" class="form-control date-picker" name="date_to" id="finishdate" placeholder="Promotion valid until date" value="<?=(isset($promotion) && $promotion['valid_period']) ? date('d-m-Y',strtotime($promotion['date_to'])) : '';?>">
                                                </label>
                                            </section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-6">
                                            	<label class="label">Description</label>
                                                <label class="textarea"> 										
                                                    <textarea rows="3" name="description"><?=isset($promotion) ? $promotion['description'] : '';?></textarea> 
                                                </label>
                                            </section>
                                        </div>
										
									</fieldset>
									
									
									<footer>
										<? if(isset($promotion)) { ?>
										<input type="hidden" name="promotion_id" value="<?=$promotion['promotion_id'];?>" />
										<button type="button" id="btn-update-promotion-basic" class="btn btn-primary">
											Update Basic Info
										</button>
										<? } else { ?>
										<button type="button" id="btn-create-promotion-basic" class="btn btn-primary">
											Create New Promotion
										</button>
										<? } ?>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
							
							<? if(isset($promotion)) { ?>
							<!-- tab: Conditions -->
							<div class="tab-pane fade<?=($tab == 'conditions') ? ' active in' : '';?>" id="conditions">
								<form id="form-promotion-conditions" class="smart-form">
									<fieldset>
										<div class="row col col-6">
											<section>
												<label class="label">Promotion Type</label>
												<label class="select">
													<select name="promotion_type">
                                                        <option value="cart">Cart Order</option>
                                                        <option value="catalog" <?=isset($promotion) ? ($promotion['promotion_type'] == 'catalog' ? 'selected="selected"' : '') : '';?>>Product Catalog</option>
                                                    </select>
												</label>
											</section>
                                            
                                            <div id="list-conditions"></div>
                                            
                                            <div style=" clear:both"></div>
                                            
                                            <section>
                                            	<label class="label">Select Condition</label>
												<label class="select">
													<select name="condition_type" class="custom-select">
													<? if($promotion['promotion_type'] == 'catalog') { ?>
                                                        <option value="product">Products</option>
                                                    <? } else { ?>
                                                        <option value="order">Order Subtotal</option>
                                                        <option value="coupon">Coupon code</option>
                                                    <? } ?>
                                                    </select>
												</label>
                                            </section>
                                            
                                            <section>
                                            	<button type="button" class="btn btn-default flare-btn"  onclick="add_condition()"><i class="fa fa-plus"></i> 
                                                	Add condition
                                                </button>
                                            </section>
                                            
										</div>
                                       
									</fieldset>
									<footer>
										<input type="hidden" name="promotion_id" value="<?=$promotion['promotion_id'];?>" />
										<button type="button" id="btn-update-promotion-conditions" class="btn btn-primary">
											Update Conditions
										</button>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
							<!-- end conditions tab pane -->
							<? } ?>
						</div>
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->
		</article>
		<!-- END COL -->
	</div>
	<!-- END ROW -->
</section>
<!-- end widget grid -->


<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">

	pageSetUp();	
	
	var pagefunction = function() {
		$('#btn-create-promotion-basic').click(function(){
			
			ajax_submit_form('form-promotion-basic', '<?=ajax_url() . 'promotion/promotion_ajax/create';?>', function(e){
				window.location.hash = '<?=ajax_url();?>promotion/edit/' + e + '/conditions';
			});
		})
		
		$('#btn-update-promotion-basic').click(function(){
			
			ajax_submit_form('form-promotion-basic', '<?=ajax_url() . 'promotion/promotion_ajax/update_basic';?>', function(e){
				$('#msg-success').find('span').html('The basic info of this Promotion has been updated successfully!');
				$('#msg-success').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-success').addClass('hide');
				}, 2000);
			});
		})
		
		$('#btn-update-promotion-conditions').click(function(){
			
			ajax_submit_form('form-promotion-conditions', '<?=ajax_url() . 'promotion/promotion_ajax/update_conditions';?>', function(e){
				$('#msg-success').find('span').html('The conditions for this Promotion has been updated successfully!');
				$('#msg-success').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-success').addClass('hide');
				}, 2000);
			});
		})
		
		
		check_discount_type();
		$('select[name="discount_type"]').change(function(){
			check_discount_type();
		});
		
		check_valid_period();
		$('input[name="valid_period"]').click(function(){
			check_valid_period();
		});
		
		// START AND FINISH DATE
		$('#startdate').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
			}
		});
		
		$('#finishdate').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#startdate').datepicker('option', 'maxDate', selectedDate);
			}
		});
		
		// Conditions
		
		<?php if(isset($promotion)) { ?>
		
		list_conditions();
		$('select[name="promotion_type"]').change(function(){
			$.ajax({
				type: "POST",
				url: "<?=ajax_url();?>/promotion/promotion_ajax/reset_conditions",
				data: $("#form-promotion-conditions").serialize(),
				success: function(html) {
					window.location.hash = '<?=ajax_url();?>promotion/edit/<?=$promotion['promotion_id'];?>/conditions/#'+ $.now();
				}
			})
		})
		
		<?php } ?>
		
		
	};
	
	function check_discount_type() {
		var discount_type = $('select[name="discount_type"]').val();
		if (discount_type == 'percentage') {
			$('#discount_percentage').show();
			$('#discount_fixed').hide();
		} else {
			$('#discount_fixed').show();
			$('#discount_percentage').hide();
		}
	}
	
	function check_valid_period() {
		var valid_period = $('input[name="valid_period"]').is(':checked');
		if(valid_period) {
			$('.date-picker').attr('disabled', false);
		} else {
			$('.date-picker').attr('disabled', true);
		}
	}
	
	function add_condition() {
		var condition_type = $('select[name="condition_type"]').val();
		var promotion_id = $('input[name="promotion_id"]').val();
		$.ajax({
			type: "POST",
			url: "<?=ajax_url();?>promotion/promotion_ajax/add_condition",
			data: {promotion_id: promotion_id, condition_type: condition_type},
			success: function(html) {
				list_conditions();
			}
		})
	}
	function list_conditions() {
		var promotion_id = $('input[name="promotion_id"]').val();
		$.ajax({
			type: "POST",
			url: "<?=ajax_url();?>promotion/promotion_ajax/list_conditions",
			data: {promotion_id: promotion_id},
			success: function(html) {
				$('#list-conditions').html(html);
			}
		})
	}
	function delete_condition(condition_id) {
		  $.ajax({
			  type: "POST",
			  url: "<?=ajax_url();?>promotion/promotion_ajax/delete_condition",
			  data: {condition_id: condition_id},
			  success: function(html) {
				  list_conditions();
			  }
		  })

	}
	

	// load bootstrap-progress bar script
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/superbox/superbox.min.js", pagefunction);
	

</script>