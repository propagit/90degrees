<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-tags fa-fw "></i> 
			Catalog
			<span>>
			Categories
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=base_url();?>admin/category" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Create New Category
		</a>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
					<h2>Manage Categories</h2>
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

						<div class="tree smart-form">
							<ul>
								<li>
									<span>ROOT Category</span>
									<ul>
										<?=modules::run('catalog/category/tree', isset($category) ? $category['category_id'] : 0);?>										
									</ul>
								</li>
							</ul>
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
			<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-tag"></i> </span>
					<h2><?=isset($category) ? $category['name'] : 'New Category';?></h2>

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

						<form id="form-category" class="smart-form">

							<fieldset>
								
											
								<section>
									<label class="label">Parent Category</label>
									<label class="select">
										<select name="parent_id">
											<option value="0">No Parent</option>
											<?=modules::run('catalog/category/field_category', isset($parent_id) ? $parent_id : 0);?>
										</select> <i></i> </label>
								</section>

								<section>
									<label class="label">Name</label>
									<label class="input">
										<input id="cat-name" type="text" name="name" value="<?=(isset($category)) ? $category['name'] : '';?>" maxlength="255" />
									</label>
									<div class="note">
										<strong>Maxlength</strong> 255 characters
									</div>
								</section>														
								
								<section>
									<label class="label">URI Path</label>
									<label class="input">
										<input id="cat-uri" type="text" name="uri_path" value="<?=(isset($category)) ? $category['uri_path'] : '';?>" maxlength="255" />
									</label>
								</section>
							
							</fieldset>
							
							<footer>
								<? if(isset($category)) { ?>
                                <input type="hidden" name="category_id" value="<?=$category['category_id'];?>" />
								<button type="button" id="btn-update-category" class="btn btn-primary">
									Update Category
								</button>
								<? } else { ?>
								<button type="button" id="btn-create-category" class="btn btn-primary">
									Create New Category
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
</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">

	var pagefunction = function() {
		$('#btn-create-category').click(function(){
			ajax_submit_form('form-category', '<?=ajax_url() . 'catalog/category_ajax/create';?>', function(e){
				window.location.hash = '<?=ajax_url();?>category/create/' + e;
			});
		})
		$('#btn-update-category').click(function(){
			ajax_submit_form('form-category', '<?=ajax_url() . 'catalog/category_ajax/update';?>', function(e){
				window.location.hash = '<?=ajax_url();?>category/edit/' + e + '/#' + $.now();
			});
		})
		$('.tree').find('i.fa-has-sub').click(function(){
			if ($(this).hasClass('fa-minus-circle')) {
				$(this).removeClass('fa-minus-circle');
				$(this).addClass('fa-plus-circle');
				$(this).parent().parent().find('ul').addClass('hide');
			} else {
				$(this).removeClass('fa-plus-circle');
				$(this).addClass('fa-minus-circle');
				$(this).parent().parent().find('ul').removeClass('hide');
			}
			
		})
		
		$('#cat-name').on('keyup',function(){
			var uri = slugify($('#cat-name').val());
			$('#cat-uri').val(uri);
		});
		
		$('#cat-uri').on('keyup',function(){
			force_lower('#cat-uri');
		});
	};
	
	pagefunction();

</script>
