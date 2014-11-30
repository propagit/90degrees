<p style="font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px;">
	Hi <strong><?=$order['first_name'];?></strong><br /><br />
    
    Thank you for shopping with KLOP.<br />
    Please keep a copy of this email as a proof of purchase. <br>
	Here is the summary of your purchase. <br /><br />
</p>




<p style="font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px;">
	<strong>Personal Information:</strong>
</p>
<table cellspacing="0" cellpadding="0" border="0"  style="border:none;font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px; margin-bottom:20px; padding:0; border-collapse:collapse">
	<tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Name</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['first_name']) ? $order['first_name'] : '';?> <?=isset($order['last_name']) ? $order['last_name'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Mobile</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['mobile']) ? $order['mobile'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Phone</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['phone']) ? $order['phone'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Email</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['email']) ? $order['email'] : '';?></td>
    </tr>
</table>

<p style="font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px;">
	<strong>Delivery Address:</strong>
</p>
<table cellspacing="0" cellpadding="0" border="0"  style="border:none;font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px; margin-bottom:20px; padding:0; border-collapse:collapse">
	<tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Address</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['address1']) ? $order['address1'] : '';?> <?=isset($order['address2']) ? $order['address2'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Postcode</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['postcode']) ? $order['postcode'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Suburb</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['suburb']) ? $order['suburb'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">State</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['state']) ? $order['state'] : '';?></td>
    </tr>
    <tr>
    	<td style="line-height:15px; padding:0; margin:0;"  width="150">Country</td>
        <td style="line-height:15px; padding:0; margin:0;" ><?=isset($order['country']) ? $order['country'] : '';?></td>
    </tr>
</table>

<p style="font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px;">
	<strong>Tax Invoice:</strong> [ <?=$order['order_id'];?> ]
</p>
<table cellspacing="0" cellpadding="0" border="0"  style="border:none;font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px; margin-bottom:20px; padding:0; border-collapse:collapse;max-width:900px;">
	<tr>
    	<td style="line-height:15px; padding:0; margin:0; width:100px;">Product </td>
        <td style="line-height:15px; padding:0; margin:0; width:400px;">Details</td>
        <td style="line-height:15px; padding:0; margin:0; width:80px;">Unit Price</td>
        <td style="line-height:15px; padding:0; margin:0; width:50px;">QNT</td>
        <td style="line-height:15px; padding:0; margin:0; width:80px;">Total</td>
    </tr>
	<?php 
		if(isset($order_items)){ 
			foreach($order_items as $item){
	?>
    <tr>
        <td style="line-height:15px; padding:0; margin:0;"><a href="<?=base_url();?>product/<?=$item['product_uri'];?>"><img src="<?=base_url() . modules::run('catalog/product/image', $item['product_id']);?>" alt="img" width="80px"></a></td>
        <td style="line-height:15px; padding:0; margin:0;"><a href="<?=base_url();?>product/<?=$item['product_uri'];?>"><?=$item['product_name'];?></a></td>
        <td style="line-height:15px; padding:0; margin:0;">$<?=$item['price'];?></td>
        <td style="line-height:15px; padding:0; margin:0;"><?=$item['quantity'];?></td>
        <td style="line-height:15px; padding:0; margin:0;">$<?=$item['quantity'] * $item['price'];?></td>
    </tr>
    <?php } } ?> 
</table>

<table cellspacing="0" cellpadding="0" border="0"  style="border:none;font-family:Arial, Helvetica, sans-serif; color:#5a5754; font-size:12px; margin-bottom:20px; padding:0; border-collapse:collapse;">
  <tr>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">SUBTOTAL</td>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">$<?=$order['subtotal'];?></td>
  </tr>
  <tr>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">SHIPPING</td>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">Free shipping!</td>
  </tr>
  <tr>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">TAX</td>
    <td style="line-height:15px; padding:0; margin:0;"  width="150">$<?=$order['tax'];?></td>
  </tr>
  <tr >
    <td style="line-height:15px; padding:0; margin:0;"  width="150"><strong>TOTAL</strong></td>
    <td style="line-height:15px; padding:0; margin:0;"  width="150"><strong>$<?=$order['total'];?></strong></td>
  </tr>

</table>


