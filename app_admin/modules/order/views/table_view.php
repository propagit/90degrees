<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-users fa-fw "></i> 
				Manage
			<span>> 
				Orders
			</span>
		</h1>
	</div>
    
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<a href="#<?=base_url();?>admin/order/export" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Export to Eparcel
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
                                	<th>Order ID</th>
									<th data-class="expand">Name</th>
									<th data-hide="phone">Mobile</th>
                                    <th>Order Items</th>
									<th data-hide="phone,tablet">Address</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Postcode</th>
                                    <th>Country</th>
                                    <th>Amount</th>
                                    <th>Status</th>
									<th data-hide="phone,tablet">Order Date</th>
								</tr>
							</thead>
							
                            <tbody>
                            	<?php if($orders){ 
									foreach($orders as $order){
										$order_items = modules::run('order/get_order_items',$order['order_id']);
								?>
                                <tr>
                                	<td><a href="#<?=base_url();?>admin/order/view/<?=$order['order_id'];?>"><?=$order['order_id'];?></a></td>
                                	<td><a href="#<?=base_url();?>admin/customer/update/<?=$order['user_id'];?>"><?=$order['first_name'] . ' '. $order['last_name'] ;?></a></td>
                                    <td><?=$order['mobile'];?></td>
                                    <td>
                                    	<?php 
											if($order_items){
												foreach($order_items as $item){
													echo $item['product_name'] . '  x '. $item['quantity'] .'';	
													if(next($item)){
														echo '<br>';	
													}
												}
											}
										?>
                                    </td>
                                    <td><?=$order['address1'] . ' ' .$order['address2'];?></td>
                                    <td><?=$order['suburb'];?></td>
                                    <td><?=$order['state'];?></td>
                                    <td><?=$order['postcode'];?></td>
                                    <td><?=$order['country'];?></td>
                                    <td>$<?=$order['total'];?></td>
                                    <td><?=$order['order_status'];?></td>
                                    <td><?=date('Y-m-d [ h:i a ]',strtotime($order['created_on']));?></td>
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

</section>
<!-- end widget grid -->

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
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
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
