
<div class="container main-container headerOffset">
  
  <? //echo $breadcrumb;?>
  
  <div class="row">
    <div class="col-xs-12">
  	  <div class="w100 clearfix category-top">
        	<h1> Shopping Cart</h1>
        	<?php echo modules::run('cart/get_mini_cart');?>
      </div><!--/.category-top-->
    </div>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <div class="cartContent w100 table-responsive">
            <table class="cartTable">
              <tbody>
              
                <tr class="CartProduct cartTableHeader">
                  <td style="width:15%">Image </td>
                  <td style="width:40%">Product Name</td>
                  <td style="width:15%">Quantity</td>
                  <td style="width:5%">&nbsp;</td>
                  <td style="width:10%">Price</td>
                  <td style="width:15%" class="text-center">Sub Total</td>
                </tr>
                <? foreach($this->cart->contents() as $item) { ?>
                <tr class="CartProduct">
                  <td  class="CartProductThumb"><div> <a href="<?=base_url();?>product/<?=$item['uri_path'];?>"><img src="<?=base_url() . modules::run('catalog/product/image', $item['id']);?>" alt="img"></a> </div></td>
                  <td >
                  <div class="CartDescription">
                      <h2> <a href="<?=base_url();?>product/<?=$item['uri_path'];?>"><?=$item['name'];?> </a> </h2>	
                  </div>
                  </td>
                  <td >
                  <div class="form-group no-btm-margin">
                    <div class="input-group">
                    <span class="input-group-addon">Quantity</span>
                    <input required type="text" class="form-control text-center cart-qty-input" data-rowid="<?=$item['rowid'];?>" value="<?=$item['qty'];?>" />
                    </div>
                  </div>
				  </td>
                  <td>&nbsp;</td>
                  <td class="price">$<?=$item['price'];?></td>
                  <td class="price text-center">$<?php echo $this->cart->format_number($item['subtotal']); ?></td>
                </tr>
                <? } ?>
              </tbody>
            </table>
          </div>
          <!--cartContent-->
          
          <div class="cartFooter w100">
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary" id="btn-update-cart"> <i class="fa fa-undo"></i> &nbsp; Update cart </button>
              </div>
            </div>
          </div> <!--/ cartFooter --> 
          
        </div>
      </div>
      <!--/row end--> 
      
      
      <div class="cartFooter w100 no-padding">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 remove-gutters">
          	<div class="product-price no-btm-margin">TOTAL</div>
            <p class="hidden-xs hidden-sm">
            	PRICE INCLUDES GST<br>
                <strong>FREE SHIPPING ANYWHERE IN AUSTRALIA</strong>
            </p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 remove-gutters">
          	<div class="product-price pull-txt no-btm-margin cart-total">$<?php echo $this->cart->format_number($this->cart->total()); ?></div>
          </div>
          <div class="col-xs-12 remove-gutters visible-xs visible-sm">
          	<p class="text-center">
            	PRICE INCLUDES GST<br>
                <strong>FREE SHIPPING ANYWHERE IN AUSTRALIA</strong>
            </p>
          </div>
      </div>
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="cartFooter w100 checkout-terms-wrap">
        	<div class="col-lg-7 col-md-7 col-sm-12">
				<div class="checkbox "><label><input type="checkbox" id="agree-to-terms"> <span class="agree-terms">By ticking this checkbox and proceeding to purchase you agree and have understood our Terms + Conditions</span></label></div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 remove-gutters cart-action-wrap">
             <div class="cart-actions">
                <div class="addto">
                  <a href="<?=base_url();?>" class="link-wishlist wishlist btn-addcart btn-keep-shopping"><i class="fa fa-arrow-left"></i> &nbsp;KEEP SHOPPING</a>
                  <a id="btn-checkout" href="javascript:void(0);" class="link-wishlist wishlist btn-checkout btn-green-checkout"><i class="fa fa-shopping-cart"></i> &nbsp;Checkout</a> 
                </div>
            </div>
            </div>
        </div>
	</div>
    
  </div><!--/row-->
  
  <div style="clear:both"></div>
</div><!-- /.main-container -->

<div class="gap"> </div>