<?
require('includes/config.php');
require('includes/header.php');
require('includes/functions.php');

if(!isset($_SESSION['username'])) {
	echo "<script language=javascript>location.href=\"login.php\";</script>";
	exit();
}

/*if($_POST) {
var_dump("<pre>",$_POST);
exit;
}*/

$sql_items = "select * from ".PREFIX."items";
$item_result = mysql_query($sql_items);
$item_result2 = mysql_query($sql_items);
$numofitems = mysql_num_rows($item_result);


if(isset($_POST["submit"]) || isset($_POST["submit_x"])) {

	$wash_fold = sanitize($_POST['wash_fold']);
	$coupon_no = sanitize($_POST['CouponNo']);
	$is_empergency = sanitize($_POST['nextday']);
	if($is_empergency=="") { $is_empergency = 0; }
	$clienttype = sanitize($_POST['clienttype']);
	$totalamount = sanitize($_POST['displaytotal']);
	$todate = date("Y-m-d");

	$sql_orderdet = "insert into ".PREFIX."customer_order_details (username, wash_fold, coupon_no, is_empergency, clienttype,
	orderdate, totalamount) values ('{$_SESSION['username']}', '{$wash_fold}', '{$coupon_no}', {$is_empergency}, '{$clienttype}', '{$todate}', {$totalamount})";

	mysql_query($sql_orderdet);

	$orderid = mysql_insert_id();
	$_SESSION["orderid"] = $orderid;

	while ($rs=mysql_fetch_array($item_result2)){
		
		$itemid = $rs["itemid"];
		$qty = sanitize($_POST['i_'.$itemid]);
		if($qty != 0) {

			$sql_order = "insert into ".PREFIX."customer_orders (orderid, username, itemid, num_of_items) values ({$orderid}, '{$_SESSION['username']}', {$itemid}, {$qty})";

			mysql_query($sql_order);
		}
	}
	
	//////////////////////////////////////
	/*for($i = 0; $i <= $numofitems; $i++)
	{
		$qty = sanitize($_POST['i'.$i]);
		if($qty != 0) {

			$sql_order = "insert into ".PREFIX."customer_orders (orderid, username, itemid, num_of_items) values ({$orderid}, '{$_SESSION['username']}', {$i}, {$qty})";

			mysql_query($sql_order);
		}
	}*/
	
if(!isset($_POST["submit"]) && $_POST["submit"]!="Submit Order") {
?>
	<form name="form1" id="form1" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="irfan_1295437121_biz@hotmail.com">
		<input type="hidden" name="tx" value="">
		<input type="hidden" name="at" value="">
		<input type="hidden" name="no_shipping" value="1">
		<input type="hidden" name="item_name" value="Order Amount">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="amount" value="<?=$totalamount?>">
		<input type='hidden' name='return' value='http://webdevelopersrus.com/projects/adeel/urang/ipn_process.php'>
		<input type='hidden' name='cancel_return' value='http://webdevelopersrus.com/projects/adeel/urang/orderform.php'>
		<input type='hidden' name='invoice' value='' />
	</form>
	<script type="text/javascript">
		document.form1.submit();
	</script>

<?
	exit();
	} else {
		echo "<script language=javascript>location.href=\"loggedin.php?message=1\";</script>";
		exit();
	}
}

?>

<script type="text/javascript">

function calculateprice()
{
	var stotal = 0;
<?
    $items_sql="select * from ".PREFIX."items";
    $i_result=mysql_query($items_sql);
	$icounter = 0;

    while ($item_row=mysql_fetch_array($i_result))
    {
        $price=$item_row["price"];
		$itemid=$item_row["itemid"];
		$icounter++;
?>
	var total;
	var subtotal = 0;

	frm=document.orderform;
	subtotal = (frm.i_<?=$itemid?>.options[frm.i_<?=$itemid?>.selectedIndex].value * (<?=$price?>));
	stotal += subtotal;
<? } ?>
	total = stotal;
	if (frm.nextday.checked)
	{
		total = total + 7;
	}

	frm.subtotal1.value = format_currency(total);
	//total = total - (total * frm.clienttype.options[frm.clienttype.selectedIndex].value);
	frm.displaytotal.value=format_currency(total);
	frm.total.value=format_currency(total);
	frm.subtotal.value=format_currency(subtotal);
}

function format_currency(a)
{
	if (isNaN(parseFloat(a)))
		return "";
	var p = Math.floor(a*100.0+0.5);
	var pp = (p < 0 ? -p : p);
	var c = pp % 100;
	var d = (pp-c) / 100;
	return (p < 0 ? "-" : "" ) + d + "." + (c < 10 ? "0" : "") + c;
}

</script>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" class="banner_inner">
				<div class="left_box_header"><strong><span class="text_15">Order Form</span></strong></div>
				<form action="orderform.php" method="post" name="orderform">
					<input type="hidden" name="subtotal" value="">
					<input type="hidden" name="subtotal1" value="">
					<input type="hidden" name="total" value="">
					<input type="hidden" name="orderid" value="254">
				<table cellspacing="0" cellpadding="0">
					<tr>
					  <td><table border="0" cellpadding="0" cellspacing="6">
						<tbody>
							<? if(isset($_GET["msg"])) { ?>
							<tr>
								<td class="success" colspan="2">
									Your pickup request emailed to you.
								</td>
							</tr>
							<? } ?>
							<tr>
								<!-- items table -->
								<td width="460" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: #4B69A0 1px solid">
										<tr>
											<td class="th_head"># OF ITEMS</td>
											<td class="th_head">ITEM</td>
											<td class="th_head">EACH</td>
										</tr>
										<?
										$counter = 0;
										if(mysql_num_rows($item_result) > 0)
										{
											while($row_item=mysql_fetch_array($item_result))
											{
												$counter++;
												$item = $row_item["item"];
												$price = $row_item["price"];
												$itemid = $row_item["itemid"];
												if($counter % 2==0) {
												echo '<tr class="odd">';
												} else {
												echo '<tr class="even">';
												}
												?>
													<td>
														<select name="i_<?=$itemid;?>" id="i_<?=$itemid;?>" onchange="calculateprice();">
															<? for($i=0; $i<11; $i++) {?>
																<option value="<?=$i?>"><?=$i?></option>
															<? } ?>
														</select>
													</td>
													<td><?=$item;?></td>
													<td>$<?=$price;?></td>
												</tr>
										<? } } ?>
									</table>
							  </td>

								<!-- instructions table -->
								<td width="256" valign="top">
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td height="32" class="page_heading">
												Instructions:
											</td>
										</tr>
										<tr>
											<td height="77">
												<b>1.</b> Using the pull down button under <b>#OF ITEMS</b> to select the
												number of items to be submitted.
											</td>
										</tr>
										<tr>
											<td height="101">
												<b>2.</b> If you have a credit from a previous order, it will be
												automatically deducted once you select <b>Submit</b> (or select
												<b>See Your Total</b>)
											</td>
										</tr>
										<tr>
											<td>
												<b>3.</b> Finally, check to make sure your order is complete and accurate
												and matches the total number of items you are submitting to <b>
												U-RANG.
											</td>
										</tr>
									</table>
							  </td>
							</tr>

							<!-- after order item -->
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td colspan="2" align="left">
									<table width="100%" border="2" cellpadding="0" cellspacing="0" style="background-color:#D3D3D3; border:#666666;">
										<tr>
											<td width="322" height="40px" style="padding-left:05px" align="left">
												Wash & Fold ($1.00 A POUND.  $20 MINIMUM)
											</td>
											<td width="102" style="padding-left:05px" align="left">
												<select name="wash_fold" id="wash_fold">
													<option value="No">No</option>
													<option value="Yes">Yes</option>
												</select>
										  </td>
										</tr>
										<tr>
											<td height="33" colspan="2" style="padding-left:05px" align="left">
												Your Coupon #
												  <input type="text" name="CouponNo" id="CouponNo" />
											</td>
										</tr>
										<tr>
											<td height="33" style="padding-left:05px" align="left">
												<input type="checkbox" id="nextday" name="nextday" value="1" /> Emergency Service
											</td>
											<td style="padding-left:05px" align="left">
												$7.00
											</td>
										</tr>
										<tr>
											<td style="padding-left:05px" align="left">
												Client Type
											</td>
											<td style="padding-left:05px" align="left">
												<select name="clienttype" id="clienttype">
													<option value=""></option>
													<option value="New Client">New Client</option>
													<option value="Key Client">Key Client</option>
													<option value="Referral">Referral</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center" height="40px">
												Total: <input type="text" name="displaytotal" id="displaytotal" size="6" readonly value="0">
											</td>
										</tr>
								  </table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="font-weight:bold;" align="left">* Please Note:</td>
							</tr>
							<tr>
								<td colspan="2" align="left" class="note">
									Discrepancies between your order submission and items sent for cleaning may result in delays in processing your order.
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<table cellpadding="2" cellspacing="0" border="0">
										<tr>
											<td>
												<?=formButton("submit","submit","Submit Order","");?>
											</td>
											<td>
												<?=formButton("button","total","See Your Total","onclick='calculateprice();'");?>
											</td>
											<td>
												<?=formButton("button","print","Print Order Form","onclick='javascript:window.print();'");?>
											</td>
											<td>&nbsp;</td>
											<td>
												<input type="image" src="images/btn_xpressCheckout.gif" alt="PayPal Checkout" name="submit" id="submit" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						  </tbody>
					  </table></td>
					</tr>
				  </table>
				  </form>
			</td>
			<td>&nbsp;</td>
			<td valign="top" class="box_img" width="341px"><? require('includes/right_column.php'); ?></td>
		  </tr>
		  <tr>
			<td height="10"></td>
			<td width="10" height="10"></td>
			<td height="10"></td>
		  </tr>
	</table>
		<!-- end -->
	</td>
</tr>
<tr>
	<td>
		<? require('includes/footer.php'); ?>
	</td>
</tr>
</table>
