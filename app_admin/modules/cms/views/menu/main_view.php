<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-pencil-square-o fa-fw "></i> 
			Content
			<span>>
			Manage Menus
			</span>
		</h1>
	</div>
</div>

<?=modules::run('common/alert_error');?>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-custombutton="false">
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
					<h2>Create New Menu</h2>
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

						<form id="form-create-menu" class="smart-form">

							<fieldset>
								<section>
									<label class="label">Menu Name</label>
									<label class="input">
										<input type="text" name="name" maxlength="255" />
									</label>
									<div class="note">
										<strong>Max length</strong> 255 characters
									</div>
								</section>
							</fieldset>
							<footer>
								<button type="button" id="btn-create-menu" class="btn btn-primary">
									Create New Menu
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
			
			
			
				

		</article>
		<!-- WIDGET END -->
		
		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
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
					<h2>Manage Menus </h2>				
					
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
						<table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th data-hide="phone">ID</th>
									<th data-class="expand">Menu</th>
									<th data-hide="phone,tablet">Created Date</th>
								</tr>
							</thead>
							<tbody>
								<? foreach($menus as $menu) { ?>
								<tr>
									<td><?=$menu['menu_id'];?></td>
									<td><a href="#<?=ajax_url();?>menu/edit/<?=$menu['menu_id'];?>"><?=$menu['name'];?></a></td>
									<td><?=date('d/m/Y h:i A', strtotime($menu['created_on']));?></td>
								</tr>
								<? } ?>
							</tbody>
						</table>
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
	$('#btn-create-menu').click(function(){
		ajax_submit_form('form-create-menu', '<?=ajax_url() . 'cms/menu_ajax/create';?>', function(e){
			window.location.hash = '<?=ajax_url();?>menu/edit/' + e;
		});
	})
</script>