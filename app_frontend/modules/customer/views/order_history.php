
<div class="container main-container headerOffset">
  
   <?=$breadcrumb;?>
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order List </span></h1>
      <div class="row userInfo">
        <div class="col-lg-12">
          <h2 class="block-title-2"> Your Order List  </h2>
        </div>
        
        <div class="col-xs-12 col-sm-12">
          <table class="footable">
            <thead>
              <tr>
                <th data-class="expand" data-sort-initial="true"> <span title="table sorted by this column on load">Order ID</span> </th>
                <th data-hide="default"> Total </th>
                <th data-hide="default" data-type="numeric"> Date </th>
                <th data-hide="phone" data-type="numeric"> Status </th>
              </tr>
            </thead>
            <tbody>
              <?php 
			  	if($orders){
					foreach($orders as $order){
						switch($order['order_status']){
							case 'failed':
							case 'cancelled':
							case 'refunded':
								$label_class = 'bg-danger';
							break;	
							
							case 'not paid':
								$label_class = 'bg-info';
							break;
							
							case 'processing':
								$label_class = 'bg-warning';
							break;
							
							default:
								$label_class = 'bg-success';
							break;
						}
			  ?>
               <tr>
                <td><?=$order['order_id'];?></td>
                <td>$<?=$order['total'];?></td>
                <td data-value="<?=strtotime($order['created_on']);?>"><?=date('d F Y , h:i a',strtotime($order['created_on']));?></td>
                <td data-value="3"><span class="label <?=$label_class;?>"><?=ucwords($order['order_status']);?></span></td>
              </tr>
              <?php } }?>
            </tbody>
          </table>
        </div>
        
        <?=modules::run('customer/account_footer_nav');?>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5"> </div>
  </div>
  <!--/row-->
  
  
  
  <div style="clear:both"></div>
  
</div>
<!-- /.main-container-->
<div class="gap"> </div>

