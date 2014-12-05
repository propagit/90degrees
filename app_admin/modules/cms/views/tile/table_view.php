<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				CMS
			<span>> 
				Work Showcase
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=ajax_url();?>tiles/create" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Create New Showcase 
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
			<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">
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
					<h2>Manage tiles</h2>
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

						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>                
								<tr>
									<th data-hide="phone">Tile ID</th>
									<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
									<th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Tile URL</th>
									<th>New Window</th>
									<th data-hide="phone,tablet">Status</th>
									
									<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<? foreach($tiles as $tile) { 
									# config drop down action palet
									$dd_params = array(
														'status' => $tile['status'],
														'obj_id' => $tile['tile_id']
														);
									
								?>
								<tr>
									<td><?=$tile['tile_id'];?></td>
									<td><a href="#<?=ajax_url();?>tiles/edit/<?=$tile['tile_id'];?>"><?=$tile['name'];?></a></td>
									<td><a href="<?=$tile['tile_uri'];?>" target="_blank"><?=$tile['tile_uri'];?></a></td>
                                    <td><?=$tile['new_window'] ? 'Opens in new window' : 'Opens in same window';?></td>
									<td><?=modules::run('common/dd_action_palet',$dd_params);?></td>
									<td><?=date('d/m/Y h:i A', strtotime($tile['updated_on']));?></td>
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
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

	<!-- end row -->

</section>
<!-- end widget grid -->

<!-- ui-dialog -->
<div id="confirm-modal" title="Dialog Simple Title">
	<p>
		Confirm Trash? You will be able to undo this action from Trash.
	</p>
</div>

<script type="text/javascript">

	pageSetUp();
	
	var pagefunction = function() {
		
		var trash_id = 0;
		
		/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		var dtable = $('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		/* END BASIC */	
		
		// CHANGE STATUS
		$('.change-status').click(function(){
			var tile_id = $(this).attr('data');
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>cms/tiles_ajax/change_status',
				data: {tile_id:tile_id},
				success: function(output) {
					window.location.hash = '<?=ajax_url();?>tiles/#'+(new Date).getTime();
				}
				
			});
			
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

		
		// Trash
		$('.trash').click(function(){
			trash_id = $(this).attr('data');
			trash(trash_id);
			// $('#confirm-modal').dialog('open');
			// return false;
		});
		
		function trash(tile_id)
		{
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>cms/tiles_ajax/change_status',
				data: {tile_id:tile_id,trashed:1},
				success: function(output) {
					// $("#confirm-modal").dialog("close")
					window.location.hash = '<?=ajax_url();?>tiles/#'+(new Date).getTime();
				}
			});
		}

				

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
