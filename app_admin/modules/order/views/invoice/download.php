<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="260"><img src="<?=base_url();?>assets/frontend/images/logo.png" width="150" alt="invoice icon"></td>
    <td width="440">&nbsp;</td>
    <td width="260" valign="bottom"><h1>TAX INVOICE</h1></td>
    <td width="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="260" valign="bottom">
    	<strong>KLOP</strong> <br>
        P.O. Box 582<br>
        North Melbourne - Victoria 3051 <br>
        P: 1300 880 199
	</td>
    <td width="440">&nbsp;</td>
    <td width="260" valign="bottom">
       <strong>INVOICE Status :</strong> <?=ucwords($order['order_status']);?><br>
       <strong>INVOICE NO :</strong> #INV - <?=$order['order_id'];?><br>
       <strong>INVOICE DATE : </strong><?=date('d F, Y',strtotime($order['created_on']));?>
       </td>
    <td width="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td width="20">&nbsp;</td>
    <td width="260">
        <strong><?=$customer['first_name'] . ' ' . $customer['last_name'] ?></strong> <br>
        <?=$customer['address1'] . ' ' . $customer['address2'];?><br>
        <?=$customer['suburb'] . ', ' . $customer['state'] . ' - ' . $customer['postcode'] . ', ' . $customer['country'];?><br>
        M: <?=$customer['mobile'];?>
	</td>
    <td width="440">&nbsp;</td>
    <td width="280" valign="bottom"><table width="280" border="0" cellspacing="0" cellpadding="0" style="color:#FFF">
      <tr>
        <td width="20" height="40" align="left" valign="middle" bgcolor="#363737">&nbsp;</td>
        <td width="100" align="left" valign="middle" bgcolor="#363737"><h2><strong>Amount:</strong><h2></td>
        <td width="140" align="right" valign="middle" bgcolor="#363737"><h2><strong>$<?=$order['total'];?> AUD</strong></h2></td>
        <td width="20" align="center" valign="middle" bgcolor="#363737">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="40" bgcolor="#f3f3f3">&nbsp;</td>
    <td width="130" bgcolor="#f3f3f3"><strong>QTY</strong></td>
    <td width="570" bgcolor="#f3f3f3"><strong>ITEM</strong></td>
    <td width="130" bgcolor="#f3f3f3"><p><strong>Price</strong></p></td>
    <td width="130" align="right" bgcolor="#f3f3f3"><strong>SUBTOTAL</strong></td>
    <td width="20" bgcolor="#f3f3f3">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
   <?php
	  $item_total = 0; 
	  foreach($order_items as $item){ 
	  $item_total += ($item['price'] * $item['quantity']);
  	?>
	  <tr>
      	<td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="130" bgcolor="#FFFFFF"><strong><?=$item['quantity'];?></strong></td>
        <td width="570" bgcolor="#FFFFFF"><?=$item['product_name'];?></td>
        <td width="130" bgcolor="#FFFFFF">$<?=$item['price'];?></td>
        <td width="130" align="right" bgcolor="#FFFFFF">$<?=number_format(($item['price'] * $item['quantity']),2);?></td>
        <td width="20" bgcolor="#FFFFFF">&nbsp;</td>
	  </tr>
  <?php } ?>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF"><strong>Item Total</strong></td>
    <td width="260" align="right" bgcolor="#FFFFFF">$<?=number_format($item_total,2);?></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF"><strong>Discount</strong></td>
    <td width="260" align="right" bgcolor="#FFFFFF">-$<?=$order['discount'];?></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF"><strong>Sub Total</strong></td>
    <td width="260" align="right" bgcolor="#FFFFFF">$<?=number_format(($item_total - $order['discount']),2);?></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF"><strong>Tax (GST)</strong></td>
    <td width="260" align="right" bgcolor="#FFFFFF">$<?=$order['tax']?></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF"><strong>Shipping Cost</strong></td>
    <td width="260" align="right" bgcolor="#FFFFFF">$<?=$order['shipping_cost']?></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="260" align="right" bgcolor="#FFFFFF"><h2><strong>Total: <span class="text-success">$<?=$order['total'];?> AUD</span></strong></h2></td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="700" align="left" valign="bottom" bgcolor="#FFFFFF">
    	<img src="<?=base_url() . ASSETS_PATH;?>img/invoice/mastercard.png" width="64" height="64" alt="mastercard">
		<img src="<?=base_url() . ASSETS_PATH;?>img/invoice/visa.png" width="64" height="64" alt="visa">
    </td>
    <td width="260" align="right" bgcolor="#FFFFFF">
    
		<strong>DELIVERY DETAILS</strong><br>
        <strong><?=$order['first_name'] . ' ' . $order['last_name'] ?></strong>
        <br>
        <?=$order['address1'];?>
        <?=$order['address2'] ? '<br>' . $order['address2'] : ''?>
        <br>
        <?=$order['suburb'] . ', ' . $order['state'] . ' - ' . $order['postcode'] . ', ' . $order['country'];?>
    </td>
    <td width="20" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p></p>
<p></p>
<p></p>
<p></p>
<p>&nbsp;</p>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" bgcolor="#f3f3f3"></td>
  </tr>
</table>

