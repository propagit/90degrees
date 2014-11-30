<?
	$total = $this->cart->total();
?>
<table id="cart-summary" class="std table">
  <tbody>
  	<tr >
      <td><strong>ORDER SUMMARY</strong></td>
      <td><a href="<?=base_url();?>cart"><i class="fa fa-search"></i> View Basket</a></td>
    </tr>
    <tr >
      <td>Total products</td>
      <td class="price" >$<?=$this->cart->total() ? $this->cart->format_number($this->cart->total()) : '0.00';?></td>
    </tr>
    <tr  style="">
      <td>Shipping</td>
      <td class="price" ><span class="success">Free shipping!</span></td>
    </tr>
    <?php
		$total_discount = 0;
		foreach($promotions as $promotion) {
			$discount_value = $promotion['discount_value'];
			$discount_text = '';
			if ($promotion['discount_type'] == 'percentage') {
				$discount_text = '(' . $discount_value .'%)';
				$discount_value = $discount_value * $total / 100;
			}
		$total_discount += $discount_value;

	?>
    <tr  style="">
      <td>
	  <?=$promotion['name'];?>
	  <? if ($this->session->userdata('coupon')) {
          echo '- Coupon Code: ' . $this->session->userdata('coupon');
      } ?>
       <?=$discount_text;?>
      </td>
      <td class="price" ><span class="success">- $<?=money_format('%i',$discount_value);?></span></td>
    </tr>
    <? } ?>
    <tr class="cart-total-price ">
      <td>Total (tax excl.)</td>
      <td class="price" >$<?=$this->cart->total() ? $this->cart->format_number($this->cart->total() - $this->cart->total()/11) : '0.00';?></td>
    </tr>
    <tr >
      <td>Total tax</td>
      <td class="price" id="total-tax">$<?=$this->cart->total() ? $this->cart->format_number($this->cart->total()/11) : '0.00'; ?></td>
    </tr>
    <tr >
      <td > Total </td>
      <td class=" site-color" id="total-price">$<?=$this->cart->total() ? $this->cart->format_number($total - $total_discount) : '0.00'; ?></td>
    </tr>
    <?php if(isset($enable_coupon) && $enable_coupon){ ?>
    <tr >
      <td colspan="2"  ><div class="input-append couponForm">
          <input class="col-lg-8" id="coupon" type="text"  placeholder="Coupon code" >
          <button class="col-lg-4 btn btn-success" type="button" id="apply-coupon">Apply!</button>
        </div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tbody>
  </tbody>
</table>
