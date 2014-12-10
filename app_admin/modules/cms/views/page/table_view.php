<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-pencil-square-o fa-fw "></i> 
				Content 
			<span>> 
				Manage Pages
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=base_url();?>admin/page/create" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Create New Page
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
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
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
					<h2>Manage Pages</h2>

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
									<th data-class="expand">Title</th>
									<th>URI Path / Preview</th>
									<th data-hide="phone,tablet">Status</th>
									<th data-hide="phone,tablet">Date Created</th>
									<th data-hide="phone,tablet">Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<? foreach($pages as $page) { 
									# config drop down action palet
									$dd_params = array(
														'status' => $page['status'],
														'obj_id' => $page['page_id'],
														'obj_type' => 'cms_pages'
														);
								?>
								<tr>
									<td><?=$page['page_id'];?></td>
									<td><a href="#<?=base_url();?>admin/page/edit/<?=$page['page_id'];?>"><?=$page['title'];?></a></td>
									<td><a target="_blank" href="<?=base_url();?><?=$page['uri_path'].'.html';?>"><?=$page['uri_path'];?></td>
									<td><?=modules::run('common/dd_action_palet',$dd_params);?></td>
									<td><?=date('d/m/Y h:i A', time());?></td>
									<td><?=date('d/m/Y h:i A', strtotime($page['updated_on']));?></td>
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
<div id="confirm-modal" title="Dialog Simple Title">
	<p>
		Confirm Trash? You will be able to undo this action from Trash.
	</p>
</div>


<script type="text/javascript">

	pageSetUp();
	
	// pagefunction	
	var pagefunction = function() {
			
			var responsiveHelper_datatable_col_reorder = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

			

		  
    
		/* COLUMN SHOW - HIDE */
		$('#datatable_col_reorder').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder) {
					responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder.respond();
			}			
		});
		
		/* END COLUMN SHOW - HIDE */
		
		// CHANGE STATUS
		$('.change-status').click(function(){
			change_status('<?=ajax_url();?>','<?=ajax_url();?>page',$(this));
		});
		
		// TRASH
		$('.trash').click(function(){
			trash('<?=ajax_url();?>','<?=ajax_url();?>page',$(this));
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
		
		$('#confirm-modal').dialog({
			autoOpen : false,
			width : 600,
			resizable : false,
			modal : true,
			title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Trash this Page?</h4></div>",
			buttons : [{
				html : "<i class='fa fa-trash-o'></i>&nbsp; Trash page",
				"class" : "btn btn-danger",
				click : function() {
					trash(trash_id);
				}
			}, {
				html : "<i class='fa fa-times'></i>&nbsp; Cancel",
				"class" : "btn btn-default",
				click : function() {
					$(this).dialog("close");
				}
			}]
		});
		
		/*
		 * Remove focus from buttons
		 */
		$('.ui-dialog :button').blur();

		

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
