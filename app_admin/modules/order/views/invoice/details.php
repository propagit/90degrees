<?php							
# config drop down action palet

$order_id = $order['order_id'];
$link_label = ucwords($order['order_status']);
switch($order['order_status']){
	case 'failed':
	case 'cancelled':
	case 'refunded':
		$btn_class = 'btn-danger';
	break;	
	
	case 'not paid':
		$btn_class = 'btn-info';
	break;
	
	case 'processing':
		$btn_class = 'btn-warning';
	break;
	
	default:
		$btn_class = 'btn-success';
	break;
}

$dd_params = array(
				'btn_name' => $link_label,
				'btn_class' => $btn_class,
				'ul_class' => 'invoice-stat-dd',
				'links' => array(
								array('label' => 'Mark as Paid', 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="paid"', 'fa' => 'fa-thumbs-o-up'),
								array('label' => 'Mark as Unpaid' , 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="not paid"', 'fa' => 'fa-thumbs-o-down'),
								array('label' => 'Mark as Processing' , 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="processing"', 'fa' => 'fa-cog'),
								array('label' => 'Mark as Failed' , 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="failed"', 'fa' => 'fa-times'),
								array('label' => 'Mark as Cancelled' , 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="cancelled"', 'fa' => 'fa-ban'),
								array('label' => 'Mark as Refunded' , 'class' => 'change-status', 'data' => $order_id, 'attrs'=>'data-status="refunded"', 'fa' => 'fa-history')
							)
			);
?>

<!--<link href="<?=base_url() . ASSETS_PATH;?> css/invoice.min.css" rel="stylesheet">-->

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-barcode"></i> </span>
					<h2>Item #44761 </h2>

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

						<div class="widget-body-toolbar">

							<div class="row">

								<div class="col-sm-4">

									<div class="input-group">
										<input class="form-control" type="text" placeholder="Type invoice number or date...">
										<div class="input-group-btn">
											<button class="btn btn-default" type="button">
												<i class="fa fa-search"></i> Search
											</button>
										</div>
									</div>
								</div>

								<div class="col-sm-8 text-align-right">

									<div class="btn-group">
										<a href="javascript:void(0)" class="btn btn-sm btn-primary" id="btn-download-invoice"> <i class="fa fa-download"></i> Download </a>
									</div>

									<div class="btn-group">
										<a href="mailto:<?=$customer['email'];?>?subject=KLOP Invoice&amp;body=Your invoice can be downloaded at the below link<br><?=$invoice_link;?>" class="btn btn-sm btn-primary"> <i class="fa fa-envelope"></i> Email </a>
									</div>
									
                                    <!--<div class="btn-group">
										<a href="javascript:void(0)" class="btn btn-sm btn-primary"> <i class="fa fa-print"></i> Print </a>
									</div>-->
								</div>

							</div>

						</div>

						<div class="padding-10" id="invoice-print-wrap">
							<br>
							<div class="pull-left">
								<img src="<?=base_url();?>assets/frontend/images/logo.png" width="150" alt="invoice icon">

								<address>
									<br>
									<strong>KLOP</strong>
									<br>
									P.O. Box 582<br>
									North Melbourne - Victoria 3051
									<br>
									<abbr title="Phone">P:</abbr> 1300 880 199
								</address>
							</div>
							<div class="pull-right">
								<h1 class="font-400">Tax Invoice</h1>
							</div>
							<div class="clearfix"></div>
							<br>
							<br>
							<div class="row">
								<div class="col-sm-9">
									<address>
										<strong><?=$customer['first_name'] . ' ' . $customer['last_name'] ?></strong>
										<br>
										<?=$customer['address1'] . ' ' . $customer['address2'];?>
										<br>
										<?=$customer['suburb'] . ', ' . $customer['state'] . ' - ' . $customer['postcode'] . ', ' . $customer['country'];?>
										<br>
										<abbr title="Phone">M:</abbr> <?=$customer['mobile'];?>
									</address>
								</div>
								<div class="col-sm-3">
                                	<div class="full-width push btm-padding">
										<div>
											<strong>INVOICE Status :</strong>
											<span class="pull-right"><?=modules::run('common/dd_action_palet',$dd_params);?></span>
										</div>

									</div>
									<div>
										<div>
											<strong>INVOICE NO :</strong>
											<span class="pull-right"> #INV - <?=$order['order_id'];?> </span>
										</div>

									</div>
									<div>
										<div class="font-md">
											<strong>INVOICE DATE :</strong>
											<span class="pull-right"> <i class="fa fa-calendar"></i> <?=date('d F, Y',strtotime($order['created_on']));?> </span>
										</div>

									</div>
									<br>
									<div class="well well-sm  bg-color-darken txt-color-white no-border">
										<div class="fa-lg">
											Amount
											<span class="pull-right"> <?=$order['total'];?> AUD** </span>
										</div>

									</div>
									<br>
									<br>
								</div>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">QTY</th>
										<th width="80%">ITEM</th>
										<th>PRICE</th>
										<th>SUBTOTAL</th>
									</tr>
								</thead>
								<tbody>
                                <?php
									$item_total = 0; 
									foreach($order_items as $item){ 
									$item_total += ($item['price'] * $item['quantity']);
								?>
                                	<tr>
										<td class="text-center"><strong><?=$item['quantity'];?></strong></td>
										<td><a href="javascript:void(0);"><?=$item['product_name'];?></a></td>
										<td>$<?=$item['price'];?></td>
										<td>$<?=number_format(($item['price'] * $item['quantity']),2);?></td>
									</tr>
                                <?php } ?>
									<tr>
										<td colspan="3">Item Total</td>
										<td><strong>$<?=number_format($item_total,2);?></strong></td>
									</tr>
                                    <tr>
										<td colspan="3">Discounts (Coupon Code Name: xxxxxx)</td>
										<td class="text-danger"><strong>-$<?=$order['discount'];?></strong></td>
									</tr>
                                    <tr>
										<td colspan="3">Sub Total</td>
										<td><strong>$<?=number_format(($item_total - $order['discount']),2);?></strong></td>
									</tr>
									<tr>
										<td colspan="3">Tax (GST)</td>
										<td><strong>$<?=$order['tax']?></strong></td>
									</tr>
                                    <tr>
										<td colspan="3">Shipping Cost (Australia Express Delivery)</td>
										<td><strong>$<?=$order['shipping_cost']?></strong></td>
									</tr>
								</tbody>
							</table>

							<div class="invoice-footer">
                            	<div class="row">
                                	<div class="col-sm-12">
                                    	<div class="invoice-sum-total pull-right">
											<h3><strong>Total: <span class="text-success">$<?=$order['total'];?> AUD</span></strong></h3>
										</div>
                                    </div>
                                </div>

								<div class="row">

									<div class="col-sm-7">
										<div class="payment-methods">
											<img src="<?=base_url() . ASSETS_PATH;?>img/invoice/mastercard.png" width="64" height="64" alt="mastercard">
											<img src="<?=base_url() . ASSETS_PATH;?>img/invoice/visa.png" width="64" height="64" alt="visa">
										</div>
									</div>
									<div class="col-sm-5">
                                        <div class="pull-right pull-text">
                                        	<strong>DELIVERY DETAILS</strong><br>
                                            <address class="no-bottom">
                                                <strong><?=$order['first_name'] . ' ' . $order['last_name'] ?></strong>
                                                <br>
                                                <?=$order['address1'];?>
                                                <?=$order['address2'] ? '<br>' . $order['address2'] : ''?>
                                                <br>
                                                <?=$order['suburb'] . ', ' . $order['state'] . ' - ' . $order['postcode'] . ', ' . $order['country'];?>
                                            </address>
                                        </div>
									</div>

								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<p class="note">**To avoid any excess penalty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
									</div>
								</div>

							</div>
						</div>

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
    
    <!-- Comments -->
    
    <!-- row -->

	<div class="row">

		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- new widget -->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false">

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
					<span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
					<h2> Order Comments </h2>
					<div class="widget-toolbar">
						<!-- add: non-hidden - to disable auto hide -->

						<div class="btn-group">
							
						</div>
					</div>
				</header>

				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<div>
							<label>Title:</label>
							<input type="text" />
						</div>
					</div>
					<!-- end widget edit box -->

					<div class="widget-body widget-hide-overflow no-padding">
						<!-- content goes here -->
						
						<!-- CHAT BODY -->
						<div id="chat-body" class="chat-body custom-scroll">
                        <?php if(isset($comments) && count($comments)) {  ?>
							<ul>
                            	<?php foreach($comments as $comment){ ?>
                                <li class="message">
									<i class="fa fa-user <?=$comment['commented_by'] == 'admin' ? 'text-primary' : '';?> fa-user-custom"></i>
									<div class="message-text msg-txt-custom">
										<time>
											<?=date('d-m-Y h:i a',strtotime($comment['created_on']));?>
										</time> <a href="javascript:void(0);" class="username"><?=$comment['commented_by'] == 'admin' ? 'Administrator Comment' : $customer['first_name'] . ' ' . $customer['last_name'];?></a> 
                                        <?=$comment['comment'];?>
									</div>
								</li>
                                <?php  } ?>								
							</ul>
						<?php } ?>
						</div>
                        
                       

						<!-- CHAT FOOTER -->
						<div class="chat-footer">
							<form method="post" id="comment-form">
                                <!-- CHAT TEXTAREA -->
                                <div class="textarea-div">
    
                                    <div class="typearea">
                                        <textarea placeholder="Write an order comment..." class="custom-scroll" name="comment"></textarea>
                                        <input type="hidden" value="<?=$order['order_id'];?>" name="order_id">
                                    </div>
    
                                </div>
    
                                <!-- CHAT REPLY/SEND -->
                                <span class="textarea-controls">
                                    <button class="btn btn-sm btn-primary pull-right" id="add-comment">
                                        Add Comment
                                    </button> <span class="pull-right smart-form" style="margin-top: 3px; margin-right: 10px;"> 
                                    <!--<label class="checkbox pull-right">
                                    <input type="checkbox" name="send_email">
                                    <i></i>Press to <strong> EMAIL </strong> comment to customer </label> </span>-->
                               </span>
                           </form>
						</div>

						<!-- end content -->
					</div>

				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->

		</article>

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

<div id="download-modal" title="Dialog Simple Title">
	<p>
    	<span class="text-success">Invoice successfully generated<br><br></span>
		Click <a href="" id="invoice-link" target="_blank">here</a> to download your invoice
	</p>
</div>


<script type="text/javascript">
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();

	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var pagefunction = function() {
		
		
		
		/*
		 * CHAT
		 */
		
		var filter_input = $('#filter-chat-list'),
			chat_users_container = $('#chat-container > .chat-list-body'),
			chat_users = $('#chat-users'),
			chat_list_btn = $('#chat-container > .chat-list-open-close'),
			chat_body = $('#chat-body');
		
		/*
		 * LIST FILTER (CHAT)
		 */
		
		// custom css expression for a case-insensitive contains()
		jQuery.expr[':'].Contains = function (a, i, m) {
		    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
		};
		
		function listFilter(list) { // header is any element, list is an unordered list
		    // create and add the filter form to the header
		
		    filter_input.change(function () {
		        var filter = $(this).val();
		        if (filter) {
		            // this finds all links in a list that contain the input,
		            // and hide the ones not containing the input while showing the ones that do
		            chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
		            chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
		        } else {
		            chat_users.find("li").slideDown();
		        }
		        return false;
		    }).keyup(function () {
		        // fire the above change event after every letter
		        $(this).change();
		
		    });
		
		}
		
		// on dom ready
		listFilter(chat_users);
		
		// open chat list
		chat_list_btn.click(function () {
		    $(this).parent('#chat-container').toggleClass('open');
		})
		
		chat_body.animate({
		    scrollTop: chat_body[0].scrollHeight
		}, 500);
		
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
		
		// Add Comment
		$('#add-comment').click(function(){
			ajax_submit_form('comment-form', '<?=ajax_url() . 'order/order_ajax/add_comment';?>', function(e){
				window.location.hash = '<?=ajax_url();?>order/view/<?=$order['order_id'];?>#' + $.now();
			});
		});
		
		// Update Order Status
		// CHANGE STATUS
		$('.change-status').click(function(){
			var order_id = $(this).attr('data');
			var new_status = $(this).attr('data-status');
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>order/order_ajax/change_status',
				data: {order_id:order_id,new_status:new_status},
				success: function(output) {
					window.location.hash = '<?=ajax_url();?>order/view/<?=$order['order_id'];?>#' + $.now();
				}
				
			});
			
		});	
		
		// Download Invoice
		$('#btn-download-invoice').click(function(){
			var order_id = <?=$order_id?>;
			$.ajax({
				type: "POST",
				url: '<?=ajax_url();?>order/order_ajax/download_invoice',
				data: {order_id:order_id},
				success: function(output) {
					// open pop up and download from there
					$('#invoice-link').attr('href',output);
					$('#download-modal').dialog('open');
					return false;
				}
				
			});
		});
		

		$('#download-modal').dialog({
			autoOpen : false,
			width : 600,
			resizable : false,
			modal : true,
			title : "<div class='widget-header'><h4><i class='fa fa-file-pdf-o'></i> Download Invoice</h4></div>",
			buttons : [{
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

		
		
	
		
	
	// end pagefunction
	
	// run pagefunction on load

	pagefunction();

</script>