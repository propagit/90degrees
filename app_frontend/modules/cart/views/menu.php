<div class="top-cart-wrap">
	<div class="col-md-8 col-lg-8 col-sm-8">
    	<ul>
        	<li><h2>KLOPS</h2></li>
        	<li><span class="cart-subhead">IN YOUR CART</span></li>
        	<li><a href="<?=base_url();?>cart"><i class="fa fa-search"></i> View Basket</a></li>
        </ul>
    </div>
	
    <div class="col-md-4 col-lg-4 col-sm-4">
    	<div class="peg">
    		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="cartRespons"><?php echo $this->cart->total_items(); ?></span></a>
        </div>
    </div>
</div>