<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				CMS
			<span>> 
				Work Showcase
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		 
		<a href="#<?=ajax_url();?>tiles/create" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Create New Showcase 
		</a>
        
        <a href="#<?=ajax_url();?>tiles<?=$order_mode ? '' : '/order_position';?>" class="btn btn-success btn-lg pull-right header-btn hidden-mobile" style="margin-right:15px;">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			<?=$order_mode ? 'Back To List View' : 'Manage Order';?>
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
                                	<th data-hide="phone">Tile Order</th>
									<th data-hide="phone">Tile ID</th>
									<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
									<th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Tile URL</th>
									<th>New Window</th>
                                    <th>Homepage</th>
									<th data-hide="phone,tablet">Status</th>
									
									<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<? foreach($tiles as $tile) { 
									# config drop down action palet
									$dd_params = array(
														'status' => $tile['status'],
														'obj_id' => $tile['tile_id'],
														'obj_type' => 'cms_tiles'
														);
									# config drop down for published unbublished
									$dd_params_home = array(
														'status' => $tile['home_page'],
														'obj_id' => $tile['tile_id'],
														'obj_type' => 'cms_tiles',
														'btn_label' => $tile['home_page'] ? 'Published' : 'Not Publish',
														'links' => array(
																		  array(
																		  'label' => $tile['home_page'] ? 'Un Publish' : 'Publish',
																		  'class' => 'home-page-status', 
																		  'data' => $tile['tile_id'], 
																		  'fa' => $tile['home_page'] ? 'fa-thumbs-o-down' : 'fa-thumbs-o-up'
																		  )
																	  )
														);
								?>
								<tr id="<?=$tile['tile_id']?>">
                                	<td><?=$tile['tile_order'];?></td>
									<td><?=$tile['tile_id'];?></td>
									<td><a href="#<?=ajax_url();?>tiles/edit/<?=$tile['tile_id'];?>"><?=$tile['name'];?></a></td>
									<td><a href="<?=$tile['tile_uri'];?>" target="_blank"><?=$tile['tile_uri'];?></a></td>
                                    <td><?=$tile['new_window'] ? 'Opens in new window' : 'Opens in same window';?></td>
                                    <td><?=modules::run('common/dd_action_palet_general',$dd_params_home);?></td>
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
<!--<div id="confirm-modal" title="Dialog Simple Title">
	<p>
		Confirm Trash? You will be able to undo this action from Trash.
	</p>
</div>-->

<script type="text/javascript">

	pageSetUp();
	
	var pagefunction = function() {
		
		//var trash_id = 0;
		
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
			"iDisplayLength":50,
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
		})
		<?php if($order_mode){ ?>
		.rowReordering({
			'sURL': '<?=ajax_url();?>cms/tiles_ajax/update_order', 
  			'sRequestType': "POST"
		})
		<?php } ?>
		;
		
		// with row ordering
		// http://jquery-datatables-row-reordering.googlecode.com/svn/trunk/index.html
		// https://code.google.com/p/jquery-datatables-row-reordering/wiki/Index
		
		/* END BASIC */	
		
		// CHANGE STATUS
		$('.change-status').click(function(){
			change_status('<?=ajax_url();?>','<?=ajax_url();?>tiles',$(this));
		});
		
		// TRASH
		$('.trash').click(function(){
			trash('<?=ajax_url();?>','<?=ajax_url();?>tiles',$(this));
		});
		
		// Publish From Home or Unbublish form Home
		$('.home-page-status').click(function(){
			 $this = $(this);
			 $.ajax({
				  type: "POST",
				  url: '<?=ajax_url();?>cms/tiles_ajax/update_home_visibility',
				  data: {tile_id:$this.attr('data')},
				  success: function(html) {
					  window.location.hash = '<?=ajax_url();?>tiles' + '/#' + (new Date).getTime();
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

	};

	// load related plugins
	
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/jquery.dataTables.rowReordering.js", function(){
			loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.colVis.min.js", function(){
				loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.tableTools.min.js", function(){
					loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
					});
				});
			});
		});
	});


</script>
