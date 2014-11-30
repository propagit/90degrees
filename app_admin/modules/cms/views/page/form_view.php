<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-edit fa-fw "></i> 
				Content 
			<span>> 
				<?=(isset($page)) ? 'Edit Page "' . $page['title'] . '"' : 'Create New Page';?>
			</span>
		</h1>
	</div>
	<? if(isset($page)) { ?>	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="<?=base_url();?><?=$page['uri_path'].'.html';?>" target="_blank" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Preview
		</a>
	</div>
	<? } ?>
	
</div>
<div class="alert alert-success fade in hide" id="msg-page">
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
			<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
					<h2>Basic Details</h2>

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

						<form id="form-page" class="smart-form">
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Page Title <i class="fa fa-asterisk fa-required"></i></label>
										<label class="input">
											<input id="title" type="text" name="title" maxlength="255" value="<?=(isset($page)) ? $page['title'] : '';?>" />
										</label>
										<div class="note">
											<strong>Max characters</strong> 255
										</div>
									</section>
									
									<section class="col col-6">
										<label class="label">URI Path</label>
										<label class="input">
											<input id="uri-path" type="text" name="uri_path" maxlength="255" value="<?=(isset($page)) ? $page['uri_path'] : '';?>" />
										</label>
										<div class="note">
											Relative to Website Base URL
										</div>
									</section>
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="label">Meta Description</label>
										<label class="textarea">
											<textarea class="custom-scroll" name="meta_description" rows="3"><?=(isset($page)) ? $page['meta_description'] : '';?></textarea>
										</label>
										<div class="note"></div>								
									</section>
									
									<section class="col col-6">
										<label class="label">Meta Keywords</label>
										<label class="textarea">
											<textarea class="custom-scroll" name="meta_keywords" rows="3"><?=(isset($page)) ? $page['meta_keywords'] : '';?></textarea>
										</label>
										<div class="note"></div>								
									</section>
								</div>
								
								<section>
									<label class="label">Content</label>
									<label class="textarea">
										<textarea class="custom-scroll" name="content_text" rows="15"><?=(isset($page)) ? $page['content'] : '';?></textarea>
									</label>
									<div class="note"></div>								
								</section>
								
							</fieldset>

							<footer>
								<? if(isset($page)) { ?>
								<input type="hidden" name="page_id" value="<?=$page['page_id'];?>" />
								<button type="button" id="btn-update-page" class="btn btn-primary">
									Update
								</button>
								<? } else { ?>
								<button type="button" id="btn-create-page" class="btn btn-primary">
									Create
								</button>
								<? } ?>
								<button type="button" class="btn btn-default" onclick="window.history.back();">
									Back
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

	var editor = CKEDITOR.replace( 'content_text' );

	CKFinder.setupCKEditor( editor, '<?=base_url() . ASSETS_PATH;?>js/plugin/ckfinder/' );
	
	pageSetUp();	
	
	var pagefunction = function() {
		$('#btn-create-page').click(function(){
			CKupdate();
	
			ajax_submit_form('form-page', '<?=ajax_url() . 'cms/page_ajax/create';?>', function(e){
				window.location.hash = '<?=ajax_url();?>page/edit/'+e;
			});
		})
		$('#btn-update-page').click(function(){
			CKupdate();
	
			ajax_submit_form('form-page', '<?=ajax_url() . 'cms/page_ajax/update';?>', function(e){
				$('#msg-page').find('span').html('The basic info of page has been updated successfully!');
				$('#msg-page').removeClass('hide');
				 // scroll up
				$("html, body").animate({
					scrollTop: 0
				}, "fast");
				/*setTimeout(function(){
					$('#msg-page').addClass('hide');
				}, 2000);*/
			});
		})
		$('#title').on('keyup',function(){
			var uri = slugify($('#title').val());
			$('#uri-path').val(uri);
		});
		
		$('#uri-path').on('keyup',function(){
			force_lower('#uri-path');
		});
	};
	
	pagefunction();

</script>
