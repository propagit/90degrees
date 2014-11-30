 <ul class="orderStep ">
  <li <?=$active == 'address' ? 'class="active"' : '';?>> <a href="#"> <i class="fa fa-map-marker"></i> <span> address</span> </a> </li>
  <li <?=$active == 'payment' ? 'class="active"' : '';?>> <a href="#"><i class="fa fa-map-marker"> </i><span>Payment</span> </a> </li>
  <li <?=$active == 'confirmation' ? 'class="active"' : '';?>><a href="#"><i class="fa fa-check-circle "> </i><span>Confirmation</span></a> </li>
</ul>