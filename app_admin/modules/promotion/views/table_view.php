<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-pencil-square-o fa-fw "></i> 
				Promotion 
			<span>> 
				Manage Promotions
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=base_url();?>admin/promotion/create" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Create New Promotion
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
					<h2>Manage Promotion</h2>

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
                                    <th>Promotion Type</th>
                                    <th>Discount Promotion</th>
                                    <th>Discount Amount</th>
									<th data-hide="phone,tablet">Status</th>
									<th data-hide="phone,tablet">Date Created</th>
							</thead>
							<tbody>
								<? foreach($promotions as $promotion) { 
									# config drop down action palet
									$dd_params = array(
														'status' => $promotion['status'],
														'obj_id' => $promotion['promotion_id']
														);
									
								?>
								<tr>
									<td><?=$promotion['promotion_id'];?></td>
									<td><a href="#<?=base_url();?>admin/promotion/edit/<?=$promotion['promotion_id'];?>"><?=$promotion['name'];?></a></td>
                                    <td><?=ucwords($promotion['promotion_type']);?></td>
                                    <td><?=ucwords($promotion['discount_type']);?></td>
                                    <td><?=$promotion['discount_value'];?></td>
									<td><?=modules::run('common/dd_action_palet',$dd_params);?></td>
									<td><?=date('d/m/Y h:i A', time());?></td>
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
		
			var trash_id = 0;
			
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
			var promotion_id = $(this).attr('data');
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>promotion/promotion_ajax/change_status',
				data: {promotion_id:promotion_id},
				success: function(output) {
					window.location.hash = '<?=ajax_url();?>promotion/#'+(new Date).getTime();
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
		});
		
		function trash(promotion_id)
		{
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>promotion/promotion_ajax/change_status',
				data: {promotion_id:promotion_id,trashed:1},
				success: function(output) {
					window.location.hash = '<?=ajax_url();?>promotion/#'+(new Date).getTime();
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
