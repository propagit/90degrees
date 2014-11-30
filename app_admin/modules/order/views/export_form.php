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

</div>


<!-- widget grid -->
<section id="widget-grid" class="">


	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
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
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Export to Eparcel</h2>				
					
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
						
						<form id="form-export" class="smart-form">

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="order_from" id="startdate" placeholder="Search order from">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="order_to" id="finishdate" placeholder="Search order to">
										</label>
									</section>
								</div>
							<footer>
                            	<span id="download-link" style="float:left; margin-top:26px;"></span>
								<button type="button" id="search-order" class="btn btn-primary">
                                	Search
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

	<!-- END ROW -->

</section>
<!-- end widget grid -->

<script type="text/javascript">
	
	pageSetUp();
	
	var pagefunction = function() {
		
		$('#search-order').click(function(){
			$.ajax({
				type: "POST",
				url: "<?=ajax_url() . 'order/order_ajax/export_csv'?>",
				data: $('#form-export').serialize(),
				dataType:"HTML",
				success: function(data) {
					$('#download-link').html(data);
				}
			});
		});
		
		
		// START AND FINISH DATE
		$('#startdate').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
			}
		});
		
		$('#finishdate').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#startdate').datepicker('option', 'maxDate', selectedDate);
			}
		});
	};
	
	// end pagefunction
	
	// Load form valisation dependency 
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>
