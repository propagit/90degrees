<div class="dropdown-menu col-lg-6 col-xs-12 col-md-6">
    
    <div class="w100 miniCartTable scroll-pane">
      <table>
        <thead>
          <tr>
              <th colspan="2">Recently Added Item(s)</th>
          </tr>
        </thead>
        <tbody>
       <?php 
          # shows only three recent
          $count = 0;
          foreach($this->cart->contents() as $item) { 
          if($count >= 3){
              break;
          }
          $count++;
       ?>
          <tr class="miniCartProduct" id="min-cart-row-<?=$item['rowid'];?>">
            <td style="width:76px;" class="miniCartProductThumb"><div> <a href="<?=base_url();?>product/<?=$item['uri_path'];?>"><img src="<?=base_url() . modules::run('catalog/product/image', $item['id']);?>" alt="img"></a> </div></td>
            <td><div class="miniCartDescription">
                <h4> <a href="<?=base_url();?>product/<?=$item['uri_path'];?>"><?=$item['name'];?> </a> </h4>
                <span class="info"> <?=$item['qty'];?> x $<?=$item['subtotal'];?> </span>
                <div class="delete-mini-cart-item" data-rowid="<?=$item['rowid'];?>"><div class="trash"> <span>Remove Product <i class="fa fa-times"></i> </span> </div></div>
              </div>
            </td>
            
          </tr>
       
       <?php } ?>
        </tbody>
      </table>
    </div> <!--/.miniCartTable-->


    <div class="miniCartFooter text-right">
      <h3 class="subtotal col-xs-12 remove-gutters">
          <span class="text-left col-xs-6 remove-gutters">Sub Total</span> 
          <span class="text-right col-xs-6 remove-gutters subtotal-amount">$<?=number_format(modules::run('cart/get_total'),2);?></span></h3>
      <a class="btn btn-primary btn-sm col-xs-5" href="<?=base_url();?>cart"><i class="fa fa-search"> </i> VIEW CART </a> 
      <a class="btn btn-primary btn-sm col-xs-5 pull" href="<?=base_url();?>cart/checkout"><i class="fa fa-shopping-cart"> </i> CHECKOUT </a> 
    </div> <!--/.miniCartFooter-->


</div>