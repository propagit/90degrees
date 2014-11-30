<div class="container main-container headerOffset">

  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner">KLOP CHECKOUT</span> - <span class="text-success">PAYMENT SUCCESSFUL</span></h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="row userInfo">
        
        <div class="col-xs-12 col-sm-12">
        
        <div class="w100 clearfix"> 
       	<?=modules::run('cart/checkout/order_step_header','confirmation');?>
        </div>

        <div class="w100 clearfix">
        	<div class="row userInfo">

            	<div class="col-xs-12 col-sm-12">
                      <div class="cartContent w100 checkoutReview ">
                        <table class="cartTable table-responsive"   style="width:100%">
                          <tbody>
                            <tr class="CartProduct cartTableHeader">
                              <th style="width:15%">Product </th>
                              <th style="width:50%">Details</th>
                              <th style="width:15%" >Unit Price</th>
                              <th class="hidden-xs" style="width:10%">QNT</th>
                              <th style="width:10%">Total</th>
                            </tr>
                            <?php 
								if(isset($order_items)){ 
									foreach($order_items as $item){
							?>
                            <tr class="CartProduct">
                              <td  class="CartProductThumb"><div> <a href="<?=base_url();?>product/<?=$item['product_uri'];?>"><img src="<?=base_url() . modules::run('catalog/product/image', $item['product_id']);?>" alt="img"></a> </div></td>
                              <td >
                              <div class="CartDescription">
                                  <h4> <a href="<?=base_url();?>product/<?=$item['product_uri'];?>"><?=$item['product_name'];?></a> </h4>
                              </div>
                              </td>
                              <td class="delete"><div class="price ">$<?=$item['price'];?></div></td>
                              <td class="hidden-xs"><?=$item['quantity'];?></td>
                              <td class="price">$<?=$item['quantity'] * $item['price'];?></td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
                      </div>
                      <!--cartContent-->
                      
                      <div class="w100 costDetails">
                        <div class="table-block" id="order-detail-content">
                          <table class="std table" id="cart-summary">
                            <tr >
                              <td>SUBTOTAL</td>
                              <td  class="price">$<?=$order['subtotal'];?></td>
                            </tr>
                            <tr style="" >
                              <td>SHIPPING</td>
                              <td  class="price"><span class="success">Free shipping!</span></td>
                            </tr>
                            <tr >
                              <td>TAX</td>
                              <td id="total-tax" class="price">$<?=$order['tax'];?></td>
                            </tr>
                            <tr >
                              <td class="price"><h2>TOTAL</h2></td>
                              <td class="price"><h2>$<?=$order['total'];?></h2></td>
                            </tr>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!--/costDetails-->
        		</div>

            </div>
            
        </div><!--/row end-->

        </div>
     
      </div>
    </div>
    <!--/row end--> 

    
  </div>
  <!--/row-->
  
  <div style="clear:both"></div>
</div>
<!-- /wrapper --> 
<div class="gap"> </div>