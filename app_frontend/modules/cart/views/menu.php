<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
    <i class="fa fa-shopping-cart"> </i>
       <span class="cartRespons"> (<?=modules::run('cart/get_total_items');?> Items) - $<?=number_format(modules::run('cart/get_total'),2);?> </span> 
    <b class="caret"> </b> 
</a>


