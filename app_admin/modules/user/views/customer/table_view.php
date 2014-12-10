<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-users fa-fw "></i> 
				Users
			<span>> 
				Customers
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=base_url();?>admin/customer/add" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Add New Customer
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
					<h2>Export to PDF / Excel</h2>
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

						<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
                                	<th>Customer Type</th>
									<th data-class="expand">Name</th>
									<th>Email</th>
									<th data-hide="phone">Mobile</th>
									<th data-hide="phone,tablet">Address</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <td>Status</td>
									<th data-hide="phone,tablet">Joined</th>
								</tr>
							</thead>
							
                            <tbody>
                            	<?php if($customers){ 
									foreach($customers as $cust){
										# config drop down action palet
										$dd_params = array(
														'status' => $cust['status'],
														'obj_id' => $cust['u_user_id'],
														'obj_type' => 'users'
														);
								?>
                                <tr>
                                	<td><?=isset($cust['customer_id']) ? 'Customer' : 'Subscriber';?></td>
                                	<td><a href="#<?=base_url();?>admin/customer/update/<?=$cust['user_id'];?>"><?=$cust['first_name'] . ' '. $cust['last_name'] ;?></a></td>
                                    <td><?=$cust['username'];?></td>
                                    <td><?=$cust['mobile'];?></td>
                                    <td><?=$cust['address1'] . ' ' .$cust['address2'];?></td>
                                    <td><?=$cust['suburb'];?></td>
                                    <td><?=$cust['state'];?></td>
                                    <td><?=$cust['country'];?></td>
                                    <td><?=modules::run('common/dd_action_palet',$dd_params);?></td>
                                    <td><?=date('d F, Y',strtotime($cust['u_created_on']));?></td>
                                </tr>
                                <?php } }?>
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
		

		/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};


		/* TABLETOOLS */
		$('#datatable_tabletools').dataTable({
			
			// Tabletools options: 
			//   https://datatables.net/extensions/tabletools/button_options
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'CT>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
	        "oTableTools": {
	        	 "aButtons": [
	             "copy",
	             "csv",
	                {
	                    "sExtends": "pdf",
	                    "sTitle": "Customers_PDF",
	                    "sPdfMessage": "Customers PDF Export",
	                    "sPdfSize": "letter"
	                },
	             	{
                    	"sExtends": "print",
                    	"sMessage": "Customers <i>(press Esc to close)</i>"
                	}
	             ],
	            "sSwfPath": "<?=base_url() . ASSETS_PATH;?>js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
	        },
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_tabletools) {
					responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_tabletools.respond();
			}
		});
		
		/* END TABLETOOLS */
		
		// CHANGE STATUS
		$('.change-status').click(function(){
			change_status('<?=ajax_url();?>','<?=ajax_url();?>customer',$(this));
		});
		
		// TRASH
		$('.trash').click(function(){
			trash('<?=ajax_url();?>','<?=ajax_url();?>customer',$(this));
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
			title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Trash this Customer/Subscriber?</h4></div>",
			buttons : [{
				html : "<i class='fa fa-trash-o'></i>&nbsp; Trash",
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
