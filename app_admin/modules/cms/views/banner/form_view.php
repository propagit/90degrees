<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-edit fa-fw "></i>
				Banners
			<span>>
				<?=(isset($banner)) ? 'Edit Banner "' . $banner['name'] . '"' : 'Create New Banner';?>
			</span>
		</h1>
	</div>
</div>
<div class="alert alert-success fade in hide" id="msg-banner">
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
					<h2>Banner Images</h2>

					<ul class="nav nav-tabs pull-right in" id="myTab">
                    	<li<?=($tab == 'basic') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#basic"><i class="fa fa-info-circle"></i> <span class="hidden-mobile hidden-tablet">Basic Info</span></a>
						</li>
                        <? if(isset($banner)) { ?>
						<li <?=($tab == 'image') ? ' class="active"' : '';?>>
							<a data-toggle="tab" href="#image"><i class="fa fa-image"></i> <span class="hidden-mobile hidden-tablet">Images</span></a>
						</li>
                        <?php } else{ ?>
                        <li class="disabled">
							<a><i class="fa fa-image"></i> <span class="hidden-mobile hidden-tablet">Images</span></a>
						</li>
                        <?php } ?>
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
								<form id="form-banner-basic" class="smart-form">
									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Banner Name <i class="fa fa-asterisk fa-required"></i></label>
												<label class="input">
													<input type="text" name="name" maxlength="255" value="<?=(isset($banner)) ? $banner['name'] : '';?>" />
												</label>
												<div class="note">
													<strong>Max characters</strong> 255
												</div>
											</section>

											<section class="col col-6">
												<label class="label">Banner ULR</label>
												<label class="input">
													<input type="text" name="banner_uri" maxlength="255" value="<?=(isset($banner)) ? $banner['banner_uri'] : '';?>" />
												</label>
                                                
											</section>
										</div>
										<div class="row">
                                            <section class="col col-6">
                                                <label class="select">
                                                <select name="new_window">
                                                    <option value="0" <?=isset($banner) ? ($banner['new_window'] == 0 ?' selected="selected"' : '') : '';?>>Open in Same Window</option>
                                                    <option value="1" <?=isset($banner) ? ($banner['new_window'] == '1' ? 'selected="selected"' : '') : '';?>>Open in New Window</option>
                                                </select><i></i> </label>
                                            </section>
                                            
                                            <section class="col col-6">
												<label class="input">
													<input type="text" name="caption" maxlength="255" value="<?=(isset($banner)) ? $banner['caption'] : '';?>" placeholder="banner caption" />
												</label>
                                                <div class="note">
													<strong>Max characters</strong> 255
												</div>
											</section>
                                        </div>
									</fieldset>


									<footer>
										<? if(isset($banner)) { ?>
										<input type="hidden" name="banner_id" value="<?=$banner['banner_id'];?>" />
										<button type="button" id="btn-update-banner-basic" class="btn btn-primary">
											Update Basic Info
										</button>
										<? } else { ?>
										<button type="button" id="btn-create-banner-basic" class="btn btn-primary">
											Create New Banner
										</button>
										<? } ?>
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											Back
										</button>
									</footer>
								</form>
							</div>
                            <? if(isset($banner)) { ?>
							<!-- tab: Images -->
							<div class="tab-pane tab-padding fade <?=($tab == 'image') ? ' active in' : '';?>" id="image">

								<?=modules::run('upload/field_upload',
									# Uploading options
									array(
										'name' => 'banner_images',
										'allowed_extensions' => array(array('title' => 'Image files', 'extensions' => 'jpg,gif,png'))
									),
									# Javascript callback function
									'add_banner_images(' . $banner['banner_id'] . ')');?>

								<!-- row -->
								<div class="row" id="banner_images"></div>
							</div>
                            <?php } ?>

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

		$('#btn-create-banner-basic').click(function(){

			ajax_submit_form('form-banner-basic', '<?=ajax_url() . 'cms/banner_ajax/create';?>', function(e){
				window.location.hash = '<?=ajax_url();?>banner/edit/' + e;
			});
		})
		$('#btn-update-banner-basic').click(function(){

			ajax_submit_form('form-banner-basic', '<?=ajax_url() . 'cms/banner_ajax/update/basic';?>', function(e){
				$('#msg-banner').find('span').html('The basic info of banner has been updated successfully!');
				$('#msg-banner').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				setTimeout(function(){
					$('#msg-banner').addClass('hide');
				}, 2000);
			});
		})

		<? if(isset($banner)) { ?>
			load_banner_images(<?=$banner['banner_id'];?>);
		<? } ?>

	};


	// load bootstrap-progress bar script
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/superbox/superbox.min.js", pagefunction);

function add_banner_images(banner_id) {
	var upload_ids = $('#banner_images_upload_ids').html();
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>cms/banner_ajax/add_images",
		data: {banner_id: banner_id, upload_ids: upload_ids},
		success: function(html) {
			if (html) {
				$('#msg-error').find('span').html(html);
				$('#msg-error').removeClass('hide');
			} else {
				load_banner_images(banner_id);
			}
		}
	})
}
function load_banner_images(banner_id) {
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>cms/banner_ajax/load_images",
		data: {banner_id: banner_id},
		success: function(html) {
			$('#banner_images').html(html);
		}
	})
}
</script>
