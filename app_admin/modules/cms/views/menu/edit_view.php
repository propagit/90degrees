<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-pencil-square-o fa-fw "></i> 
			Content
			<span>>
			Edit Menu "<?=$menu['name'];?>"
			</span>
		</h1>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-list"></i> </span>
					<h2>Edit Menu</h2>
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

						<form id="form-update-menu" class="smart-form">
							<input type="hidden" name="menu_id" value="<?=$menu['menu_id'];?>" />
							<fieldset>
								<section>
									<label class="label">Menu Name</label>
									<label class="input">
										<input type="text" name="name" value="<?=$menu['name'];?>" maxlength="255" />
									</label>
									<div class="note">
										<strong>Max length</strong> 255 characters
									</div>
								</section>
							</fieldset>
							<footer>
								<button type="button" id="btn-update-menu" class="btn btn-primary">
									Update Menu
								</button>
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
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-fullscreenbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-link"></i> </span>
					<h2><?=(isset($url)) ? 'Edit URL' : 'Add New URL'; ?></h2>
					<ul class="nav nav-tabs pull-right in" id="myTab">						
						<li class="active">
							<a data-toggle="tab" href="#system"><span class="hidden-mobile hidden-tablet">System URL</span></a>
						</li>
						<li>
							<a data-toggle="tab" href="#custom"><span class="hidden-mobile hidden-tablet">Custom URL</span></a>
						</li>
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
							<div class="tab-pane fade active in" id="system">
								<form id="form-system-url" class="smart-form">
								<input type="hidden" name="menu_id" value="<?=$menu['menu_id'];?>" />
								<? if(isset($url)) { ?>
								<input type="hidden" name="url_id" value="<?=$url['url_id'];?>" />
								<? } ?>
									<fieldset>										
										<section>
											<label class="label">Subject</label>
											<label class="select">
												<select name="subject">
													<option value="">Please select</option>
													<option value="page">Pages</option>
													<option value="category">Categories</option>
													<option value="product">Products</option>
												</select> <i></i> 
											</label>
										</section>
										<section>
											<label class="select" id="wp_subject"></label>
										</section>
									</fieldset>
									<fieldset>
										<section>
											<label class="label">Custom Label</label>
											<label class="input">
												<input type="text" name="label" maxlength="255" value="<?=(isset($url)) ? htmlspecialchars($url['label']) : '';?>" />
											</label>
											<div class="note">
												<strong>Optional</strong> Leave empty if you want to use the default name of the subject
											</div>							
										</section>
										
										<section>
											<label class="checkbox"><input type="checkbox" name="new_window" value="1"<?=(isset($url) && $url['new_window']) ? ' checked' : '';?> /><i></i> Open in a new window</label>
										</section>
									</fieldset>
									
									
									<footer>
										<? if(isset($url)) { ?>
										<button type="button" id="btn-update-system-url" class="btn btn-primary">
											Update URL
										</button>
										<? } else { ?>
										<button type="button" id="btn-system-url" class="btn btn-primary">
											Add To Menu
										</button>
										<? } ?>
									</footer>
								</form>
							</div>
							
							
							<!-- tab: Related Products -->
							<div class="tab-pane fade" id="custom">
								<form id="form-url-custom" class="smart-form">
								<input type="hidden" name="menu_id" value="<?=$menu['menu_id'];?>" />
								<? if(isset($url)) { ?>
								<input type="hidden" name="url_id" value="<?=$url['url_id'];?>" />
								<? } ?>
									<fieldset>
										<section>
											<label class="label">Address</label>
											<label class="input"> <i class="icon-prepend fa fa-globe"></i>
												<input type="text" name="address" placeholder="http://" value="<?=(isset($url)) ? $url['address'] : '';?>" />
											</label>
										</section>
									</fieldset>
									<fieldset>
										<section>
											<label class="label">Label</label>
											<label class="input">
												<input type="text" name="label" maxlength="255" value="<?=(isset($url)) ? htmlspecialchars($url['label']) : '';?>" />
											</label>
											<div class="note">
												<strong>Max characters</strong> 255
											</div>							
										</section>
										
										<section>
											<label class="checkbox"><input type="checkbox" name="new_window" value="1"<?=(isset($url) && $url['new_window']) ? ' checked' : '';?> /><i></i> Open in a new window</label>
										</section>
									</fieldset>
									
									
									<footer>
										<? if(isset($url)) { ?>
										<button type="button" id="btn-update-custom-url" class="btn btn-primary">
											Update URL
										</button>
										<? } else { ?>
										<button type="button" id="btn-custom-url" class="btn btn-primary">
											Add To Menu
										</button>
										<? } ?>
									</footer>
								</form>
							</div>
						</div>
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->
			
				

		</article>
		<!-- WIDGET END -->
		
		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false" data-widget-custombutton="false">
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
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2><?=$menu['name'];?> </h2>
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body">
						<?=modules::run('menu/urls_tree', $menu['menu_id']);?>
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->	

		</article>
		<!-- END COL -->
		
	</div>
</section>

<script>
pageSetUp();
load_subject_list(0);
$('select[name="subject"]').change(function(){
	load_subject_list(0);		
})

$('#btn-update-menu').click(function(){
	ajax_submit_form('form-update-menu', '<?=ajax_url() . 'cms/menu_ajax/update';?>', function(e){
		window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>#' + $.now();
	});
})
$('#btn-system-url').click(function(){
	ajax_submit_form('form-system-url', '<?=ajax_url() . 'cms/menu_ajax/add_system_url';?>', function(e){
		window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>#' + $.now();
	});
})
$('#btn-update-system-url').click(function(){
	ajax_submit_form('form-system-url', '<?=ajax_url() . 'cms/menu_ajax/update_system_url';?>', function(e){
		window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>';
	});
})
$('#btn-custom-url').click(function(){
	ajax_submit_form('form-url-custom', '<?=ajax_url() . 'cms/menu_ajax/add_custom_url';?>', function(e){
		window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>#' + $.now();
	});
})
$('#btn-update-custom-url').click(function(){
	ajax_submit_form('form-url-custom', '<?=ajax_url() . 'cms/menu_ajax/update_custom_url';?>', function(e){
		window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>';
	});
})

<? if(isset($url) && $url['url_type'] == 'custom') { ?>
$('#myTab a[href="#custom"]').tab('show')
<? } ?>

<? if(isset($url) && $url['url_type'] == 'system') { ?>
$('select[name="subject"]').val('<?=$url['subject'];?>');
load_subject_list(<?=$url['subject_id'];?>);
<? } ?>
	
function edit_url(url_id) {
	window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>/' + url_id;
}
function trash_url(url_id) {
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>cms/menu_ajax/trash_url",
		data: {url_id: url_id},
		success: function(html) {
			if (html) {
				
			} else {
				$('ol.dd-list').find('li[data-id="' + url_id + '"]').remove();
				var current_url_id = 0;
				<? if(isset($url)) { ?>
				current_url_id = <?=$url['url_id'];?>;
				if (current_url_id == url_id) {
					window.location.hash = '<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>';
				}
				<? } ?>
			}
		}
	})	
}
function load_subject_list(subject_id) {
	var subject = $('select[name="subject"]').val();
	$.ajax({
		type: "POST",
		url: "<?=ajax_url();?>cms/menu_ajax/load_subject_list",
		data: {subject: subject, subject_id: subject_id},
		success: function(html) {
			$('#wp_subject').html(html);
		}
	})
}
</script>