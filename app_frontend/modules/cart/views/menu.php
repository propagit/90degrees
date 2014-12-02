<a class="navbar-toggle btn-success cart-btn" href="<?=base_url();?>cart"> 
<i class="fa fa-shopping-cart colorWhite"> </i> 
<span class="cartRespons colorWhite"> Cart (<strong>$<?=number_format(modules::run('cart/get_total'),2);?></strong>) </span> 
</a>