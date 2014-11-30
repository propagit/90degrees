<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-trash-o fa-fw "></i> 
				Trash
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a id="btn-empty-trash" class="btn btn-danger btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Empty Trash
		</a>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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
					<h2>Content > Pages</h2>

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
						
						<table id="datatable_col_reorder1" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Page ID</th>
									<th data-class="expand">Title</th>
									<th>URI Path</th>
									<th width="80" class="center" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($pages as $page) { ?>
							<tr>
								<td><?=$page['page_id'];?></td>
								<td><?=$page['title'];?></td>
								<td><?=$page['uri_path'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$page['page_id'];?>" data-type="page"><i class="fa fa-undo"></i></a></td>
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
		
		
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Catalog > Products</h2>

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
						
						<table id="datatable_col_reorder3" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Product ID</th>
									<th data-class="expand">Name</th>
									<th>URI Path</th>
									<th width="80" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($products as $product) { ?>
							<tr>
								<td><?=$product['product_id'];?></td>
								<td><?=$product['name'];?></td>
								<td><?=$product['uri_path'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$product['product_id'];?>" data-type="product"><i class="fa fa-undo"></i></a></td>
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
		
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Users > Customers</h2>

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
						
						<table id="datatable_col_reorder4" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">User ID</th>
									<th data-class="expand">Username</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email Address</th>
									<th width="80" class="center" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($users as $user) { ?>
							<tr>
								<td><?=$user['user_id'];?></td>
								<td><?=$user['username'];?></td>
								<td><?=$user['first_name'];?></td>
								<td><?=$user['last_name'];?></td>
								<td><?=$user['email'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$user['user_id'];?>" data-type="user"><i class="fa fa-undo"></i></a></td>
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
        
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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
					<h2>Content > Banners</h2>

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
						
						<table id="datatable_col_reorder1" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Banner ID</th>
									<th data-class="expand">Title</th>
									<th>URI Path</th>
									<th width="80" class="center" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($banners as $banner) { ?>
							<tr>
								<td><?=$banner['banner_id'];?></td>
								<td><?=$banner['name'];?></td>
								<td><?=$banner['banner_uri'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$banner['banner_id'];?>" data-type="banner"><i class="fa fa-undo"></i></a></td>
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
        
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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
					<h2>Content > Tiles</h2>

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
						
						<table id="datatable_col_reorder1" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Tile ID</th>
									<th data-class="expand">Title</th>
									<th>URI Path</th>
									<th width="80" class="center" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($tiles as $tile) { ?>
							<tr>
								<td><?=$tile['tile_id'];?></td>
								<td><?=$tile['name'];?></td>
								<td><?=$tile['tile_uri'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$tile['tile_id'];?>" data-type="tile"><i class="fa fa-undo"></i></a></td>
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
		
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Content > Menu > Url</h2>

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
						
						<table id="datatable_col_reorder2" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Url ID</th>
									<th data-class="expand">Title</th>
									<th>URI Path</th>
									<th width="80" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					
					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->
		</article>
		
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Promotion</h2>

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
						
						<table id="datatable_col_reorder2" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th width="80" data-hide="phone">Promotion ID</th>
									<th data-class="expand">Type</th>
									<th>Promotion Name</th>
									<th width="80" data-hide="phone,tablet">Restore</th>
								</tr>
							</thead>
							<tbody>
							<? foreach($promotions as $promotion) { ?>
							<tr>
								<td><?=$promotion['promotion_id'];?></td>
								<td><?=ucwords($promotion['promotion_type']);?></td>
								<td><?=$promotion['name'];?></td>
								<td class="center"><a class="btn btn-xs btn-success btn-restore" data-id="<?=$promotion['promotion_id'];?>" data-type="promotion"><i class="fa fa-undo"></i></a></td>
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
	</div>
</section>

<!-- ui-dialog -->
<div id="confirm-modal">
	<p>
		Are you sure you want to delete everything in the trash. This action cannot be undo, and all the data will be deleted completely from the system.
	</p>
</div>


<script>
	pageSetUp();
	// Empty Trash
	
	var pagefunction = function() {
	
		var responsiveHelper_datatable_col_reorder1 = undefined;
		var responsiveHelper_datatable_col_reorder2 = undefined;
		var responsiveHelper_datatable_col_reorder3 = undefined;
		var responsiveHelper_datatable_col_reorder4 = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

			

		  
    
		/* COLUMN SHOW - HIDE */
		$('#datatable_col_reorder1').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder1) {
					responsiveHelper_datatable_col_reorder1 = new ResponsiveDatatablesHelper($('#datatable_col_reorder1'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder1.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder1.respond();
			}			
		});
		$('#datatable_col_reorder2').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder2) {
					responsiveHelper_datatable_col_reorder2 = new ResponsiveDatatablesHelper($('#datatable_col_reorder2'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder2.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder2.respond();
			}			
		});
		$('#datatable_col_reorder3').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder3) {
					responsiveHelper_datatable_col_reorder3 = new ResponsiveDatatablesHelper($('#datatable_col_reorder3'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder3.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder3.respond();
			}			
		});
		$('#datatable_col_reorder4').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder4) {
					responsiveHelper_datatable_col_reorder4 = new ResponsiveDatatablesHelper($('#datatable_col_reorder4'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder4.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder4.respond();
			}			
		});
		
		
		$('.btn-restore').click(function(){
			var $this = $(this);
			var id = $this.attr('data-id');
			var type = $this.attr('data-type');
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>trash/ajax/restore',
				data: {id: id, type: type},
				success: function(html) {
					//alert(html);
					$this.parent().parent().remove();
				}
			})
		});
		
		/** CONVERT DIALOG TITLE TO HTML
		* REF: http://stackoverflow.com/questions/14488774/using-html-in-a-dialogs-title-in-jquery-ui-1-10
		*/
		$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
			_title : function(title) {
				if (!this.options.title) {
					title.html("&#160;");
				} else {
					title.html(this.options.title);
				}
			}
		}));
		
		$('#btn-empty-trash').click(function(){
			trash_id = $(this).attr('data');
			$('#confirm-modal').dialog('open');
			return false;
		});
		$('#confirm-modal').dialog({
			autoOpen : false,
			width : 600,
			resizable : false,
			modal : true,
			title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Empty Trash?</h4></div>",
			buttons : [{
				html : "<i class='fa fa-trash-o'></i>&nbsp; Empty Trash",
				"class" : "btn btn-danger",
				click : function() {
					$.ajax({
						type: "POST",
						url: '<?=ajax_url();?>trash/ajax/empty_trash',
						success: function(html) {
							location.reload();
						}
					})
				}
			}, {
				html : "<i class='fa fa-times'></i>&nbsp; Cancel",
				"class" : "btn btn-default",
				click : function() {
					$(this).dialog("close");
				}
			}]
		});
	};
	// load related plugins
	
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
				});
			});
		});
	});
	
</script>