<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-edit fa-fw "></i> 
				Product 
			<span>> 
				<?=(isset($product)) ? 'Edit Product "' . $product['name'] . '"' : 'Create New Product';?>
			</span>
		</h1>
	</div>
</div>
<div class="alert alert-success fade in hide" id="msg-product">
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
					<h2>Product Details</h2>
					
					<ul class="nav nav-tabs pull-right in" id="myTab">
						
						<li<?=($tab == 'basic') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#basic"><i class="fa fa-info-circle"></i> <span class="hidden-mobile hidden-tablet">Basic Info</span></a>
						</li>
						<? if(isset($product)) { ?>
						<li<?=($tab == 'price') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#price"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">Price</span></a>
						</li>
						<li>
							<a data-toggle="tab" href="#image"><i class="fa fa-image"></i> <span class="hidden-mobile hidden-tablet">Images</span></a>
						</li>
						<li>
							<a data-toggle="tab" href="#categories"><i class="fa fa-tags"></i> <span class="hidden-mobile hidden-tablet">Categories</span></a>
						</li>
						<li>
							<a data-toggle="tab" href="#dimensions"><i class="fa fa-arrows"></i> <span class="hidden-mobile hidden-tablet">Dimensions</span></a>
						</li>
						<? } else { ?>
						<li class="disabled">
							<a><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">Price</span></a>
						</li>
						<li class="disabled">
							<a><i class="fa fa-image"></i> <span class="hidden-mobile hidden-tablet">Images</span></a>
						</li>
						<li class="disabled">
							<a><i class="fa fa-tags"></i> <span class="hidden-mobile hidden-tablet">Categories</span></a>
						</li>
						<li class="disabled">
							<a><i class="fa fa-arrows"></i> <span class="hidden-mobile hidden-tablet">Dimensions</span></a>
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
								<form id="form-product-basic" class="smart-form">
									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Product Name <i class="fa fa-asterisk fa-required"></i></label>
												<label class="input">
													<input id="product-name" type="text" name="name" maxlength="255" value="<?=(isset($product)) ? $product['name'] : '';?>" />
												</label>
												<div class="note">
													<strong>Max characters</strong> 255
												</div>
											</section>
											
											<section class="col col-6">
												<label class="label">URI Path</label>
												<label class="input">
													<input id="product-uri" type="text" name="uri_path" maxlength="255" value="<?=(isset($product)) ? $product['uri_path'] : '';?>" />
												</label>
												<div class="note">
													Relative to Website Base URL
												</div>
											</section>
										</div>
										
										<section>
											<label class="label">Short Description</label>
											<label class="input">
												<input type="text" name="short_desc" maxlength="255" value="<?=(isset($product)) ? $product['short_desc'] : '';?>" />
											</label>
											<div class="note">
												<strong>Max characters</strong> 255
											</div>							
										</section>
										
										<section>
											<label class="label">Long Description</label>
											<label class="textarea textarea-resizable">
												<textarea class="custom-scroll" name="long_desc" rows="5"><?=(isset($product)) ? $product['long_desc'] : '';?></textarea>
											</label>
											<div class="note"></div>								
										</section>
									</fieldset>
									
									
									<footer>
										<? if(isset($product)) { ?>
										<input type="hidden" name="product_id" value="<?=$product['product_id'];?>" />
										<button type="button" id="btn-update-product-basic" class="btn btn-primary">
											Update Basic Info
										</button>
										<? } else { ?>
										<button type="button" id="btn-create-product-basic" class="btn btn-primary">
											Create New Product
										</button>
										<? } ?>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
							
							<? if(isset($product)) { ?>
							<!-- tab: Price -->
							<div class="tab-pane fade<?=($tab == 'price') ? ' active in' : '';?>" id="price">
								<form id="form-product-price" class="smart-form">
									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Price</label>
												<label class="input"> <i class="icon-prepend fa fa-dollar"></i>
													<input type="text" name="price" value="<?=$product['price'];?>" />
												</label>
												<div class="note">
												</div>
											</section>
											<section class="col col-6">
												<label class="label">Sale Price</label>
												<label class="input"> <i class="icon-prepend fa fa-dollar"></i>
													<input type="text" name="sale_price" value="<?=$product['sale_price'];?>" />
												</label>
												<div class="note">
												</div>
											</section>
										</div>
									</fieldset>
									<footer>
										<input type="hidden" name="product_id" value="<?=$product['product_id'];?>" />
										<button type="button" id="btn-update-product-price" class="btn btn-primary">
											Update Price
										</button>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
							<!-- end price tab pane -->
							
							<!-- tab: Images -->
							<div class="tab-pane tab-padding fade<?=($tab == 'image') ? ' active in' : '';?>" id="image">
								
								<?=modules::run('upload/field_upload', 
									# Uploading options
									array(
										'name' => 'product_image',
										'allowed_extensions' => array(array('title' => 'Image files', 'extensions' => 'jpg,gif,png'))
									),
									# Javascript callback function
									'add_product_images(' . $product['product_id'] . ')');?>
								
								<!-- row -->
								<div class="row" id="product_images"></div>
							</div>
							
							<!-- tab: Categories -->
							<div class="tab-pane tab-padding fade" id="categories">
								<?=modules::run('catalog/product/categories', $product['product_id']);?>
							</div>
							
							<!-- tab: Dimensions -->
							<div class="tab-pane fade<?=($tab == 'dimensions') ? ' active in' : '';?>" id="dimensions">
								<form id="form-product-dimension" class="smart-form">
									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Length</label>
												<label class="input"> 
													<input type="text" name="length" value="<?=$product['length'];?>" placeholder="30 cm" />
												</label>
												<div class="note">
												</div>
											</section>
											<section class="col col-6">
												<label class="label">Width</label>
												<label class="input"> 
													<input type="text" name="width" value="<?=$product['width'];?>" placeholder="10 cm"/>
												</label>
												<div class="note">
												</div>
											</section>
										</div>
                                        <div class="row">
											<section class="col col-6">
												<label class="label">Height</label>
												<label class="input">
													<input type="text" name="height" value="<?=$product['height'];?>" placeholder="6 cm"/>
												</label>
												<div class="note">
												</div>
											</section>
											<section class="col col-6">
												<label class="label">Sale Price</label>
												<label class="input"> 
													<input type="text" name="weight" value="<?=$product['weight'];?>" placeholder="1.2 kg"/>
												</label>
												<div class="note">
												</div>
											</section>
										</div>
									</fieldset>
									<footer>
										<input type="hidden" name="product_id" value="<?=$product['product_id'];?>" />
										<button type="button" id="btn-update-product-dimensions" class="btn btn-primary">
											Update Dimensions
										</button>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
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


<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/ckeditor/ckeditor.js"></script>
<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/ckeditor/config.js"></script>
<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/ckeditor/styles.js"></script>
<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/ckfinder/ckfinder.js"></script>
<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/ckfinder/config.js"></script>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">

	var editor = CKEDITOR.replace( 'long_desc' );
	
	CKEDITOR.config.toolbar = [
    	<?=ENVIRONMENT == 'development' ? DEV_CK_TOOLS : LIVE_CK_TOOLS;?>
	] ;
	
	
	CKFinder.setupCKEditor( editor, '<?=base_url() . ASSETS_PATH;?>js/plugin/ckfinder/' );
	
	pageSetUp();	
	
	var pagefunction = function() {
		$('#btn-create-product-basic').click(function(){
			CKupdate();
			
			ajax_submit_form('form-product-basic', '<?=ajax_url() . 'catalog/product_ajax/create';?>', function(e){
				window.location.hash = '<?=ajax_url();?>product/edit/' + e + '/price';
			});
		})
		$('#btn-update-product-basic').click(function(){
			CKupdate();
			
			ajax_submit_form('form-product-basic', '<?=ajax_url() . 'catalog/product_ajax/update/basic';?>', function(e){
				$('#msg-product').find('span').html('The basic info of product has been updated successfully!');
				$('#msg-product').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-product').addClass('hide');
				}, 2000);
			});
		})
		$('#btn-update-product-price').click(function(){
			ajax_submit_form('form-product-price', '<?=ajax_url() . 'catalog/product_ajax/update/price';?>', function(e){
				$('#msg-product').find('span').html('The product prices have been updated successfully!');
				$('#msg-product').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-product').addClass('hide');
				}, 2000);
			});
		})
		<? if(isset($product)) { ?>
			load_product_images(<?=$product['product_id'];?>);
		<? } ?>
		
		$('#btn-update-product-dimensions').click(function(){
			ajax_submit_form('form-product-dimension', '<?=ajax_url() . 'catalog/product_ajax/update/dimensions';?>', function(e){
				$('#msg-product').find('span').html('The product dimensions have been updated successfully!');
				$('#msg-product').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-product').addClass('hide');
				}, 2000);
			});
		})
		
		
		$('#product-name').on('keyup',function(){
			var uri = slugify($('#product-name').val());
			$('#product-uri').val(uri);
		});
		
		$('#product-uri').on('keyup',function(){
			force_lower('#product-uri');
		});
	};
	

	// load bootstrap-progress bar script
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/superbox/superbox.min.js", pagefunction);
	
function add_product_images(product_id) {
	var upload_ids = $('#product_image_upload_ids').html();
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>catalog/product_ajax/add_images",
		data: {product_id: product_id, upload_ids: upload_ids},
		success: function(html) {
			if (html) {
				$('#msg-error').find('span').html(html);
				$('#msg-error').removeClass('hide');
			} else {
				load_product_images(product_id);
			}
		}
	})
}
function load_product_images(product_id) {
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>catalog/product_ajax/load_images",
		data: {product_id: product_id},
		success: function(html) {
			$('#product_images').html(html);
		}
	})
}
</script>