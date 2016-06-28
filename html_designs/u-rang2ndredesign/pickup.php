<? 
require('includes/config.php');
require('includes/header.php');
require('includes/functions.php'); 

if(!isset($_SESSION['username'])) {
	echo "<script language=javascript>location.href=\"login.php\";</script>";
	exit();
}

if(isset($_POST["submit"])) { 
	$username = $_SESSION['username'];
	$address = sanitize($_POST['txtAddress']);
	$special_ins = sanitize($_POST['txtSpecialInstruction']);
	$driving_ins = sanitize($_POST['txtDrivingInstruction']);
	$pickupdate = sanitize($_POST['pickupdate']);
	$pickupdate2 = sanitize($_POST['pickupdate']);
	$schedule = sanitize($_POST['schedule']);
	$isboxed = sanitize($_POST['isboxed']);
	$ishung = sanitize($_POST['ishung']);
	$ddlShirt = sanitize($_POST['ddlShirt']);
	$is_urang_bag = sanitize($_POST['is_urang_bag']);
	$doorman = sanitize($_POST['doorman']);
	$how_to_pay = sanitize($_POST['how_to_pay']);
	$is_onlineorder = sanitize($_POST['is_onlineorder']);
	$todate = date("Y-m-d");
	
	$likeurshirt = "";
	$urangbag = "No";
	$onlineorder = "No";
	
	if($isboxed=="") {$isboxed = 0;} else {$likeurshirt .= "Boxed";}
	if($ishung=="") {$ishung = 0;} else {$likeurshirt .= " Hung";}
	if($is_urang_bag=="") {$is_urang_bag = 0;} else {$urangbag = "Yes";}
	if($is_onlineorder=="") {$is_onlineorder = 0;} else {$onlineorder = "Yes";}
	
	// date format
	$pdate = explode("/",$pickupdate);
	$pickupdate = $pdate[2]."-".$pdate[0]."-".$pdate[1];
	
	// schedule
	if($schedule==1){
		$str_schedule="For the time specified only";
	}
	else if($schedule==2){
		$str_schedule="Daily at this time except weekends";
	}
	else if($schedule==3){
		$str_schedule="Daily at this time including weekends";
	}
	else if($schedule==4){
		$str_schedule="Weekly on this day of the week";
	}
	else if($schedule==5){
		$str_schedule="Monthly on this day of the month";
	}
	
	// how to pay
	if($how_to_pay==1){
		$str_how_to_pay="Charge my credit card this time for amount $";
	}
	else if($how_to_pay==2){
		$str_how_to_pay="Pre-Authorization - Charge my card on ongoing basis for amounts I owe (recommended for regular customers)";
	}
	else if($how_to_pay==3){
		$str_how_to_pay="COD";
	}
	else if($how_to_pay==4){
		$str_how_to_pay="Check";
	}
	
	$sql_insert = "insert into ".PREFIX."customer_pickup_schedule(username, address, pickupdate, addeddate, schedule, isboxed, ishung, starch, is_urange_bag, doorman, special_instructions, driving_instructions, how_to_pay, is_onlineorder)
	values  ('{$username}', '{$address}', '{$pickupdate}', '{$todate}', '{$str_schedule}', {$isboxed}, {$ishung}, '{$ddlShirt}', {$is_urang_bag}, '{$doorman}', '{$special_ins}', '{$driving_ins}', '{$str_how_to_pay}', {$is_onlineorder})";

	mysql_query($sql_insert);
	

$chkvalid_user = "select * from ".PREFIX."customers where username='".$username."'";
$result = mysql_query($chkvalid_user);
	
if(mysql_num_rows($result) > 0)
{
	$email = mysql_result($result,0,'email');
	$customername = mysql_result($result,0,'customer_name');
	
	$from_email = "";
	$adminemail = "select * from ".PREFIX."config";
	$result_email = mysql_query($adminemail);
	if(mysql_num_rows($result_email) > 0)
	{
		$from_email = mysql_result($result_email,0,'site_email');
	}
		
// Email code start
$to = $email;
$from = $from_email;
//$cc = "irfanlateef.fsd@gmail.com";
//$from = "irfan.lateef@fsdsolutions.com";

$headers = "From: <$from>\r\n";
//$headers  .= "Cc: {$cc}\r\n";
$headers  .= "Reply-To: {$from}";
$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "Cc: vlad@u-rang.com" . "\r\n";
$subject = "U-Rang: Pickup Request!";

$message = "";
$message .= "Dear ".$customername.",

Below is your pickup information:
____________________________________
Pickup Details:

Pickup Address: ".$address."\n
Pickup Date: ".$pickupdate2."\n
Schedule: ".$str_schedule."\n
How Would You Like Your Shirts: ".$likeurshirt." - ".$ddlShirt."\n
U-Rang bag: ".$urangbag."\n
Doorman: ".$doorman."\n
Special Instructions: ".$special_ins."\n
Driving Instructions: ".$driving_ins."\n
How to pay: ".$str_how_to_pay."\n
Online order form: ".$onlineorder."\n
____________________________________

"; 
//////////////////// Sending Email ////////////////////////
if (mail($to,$subject,$message,$headers)) {
$msg ="Your pickup request emailed to you.";				
}

}	
	
	
	if($is_onlineorder == 0) {
		echo "<script language=javascript>location.href=\"loggedin.php?message=2\";</script>";
		exit();
	}
	else {
		echo "<script language=javascript>location.href=\"orderform.php?msg=1\";</script>";
		exit();
	}
	

}
else {
	$sql_query = "select * from ".PREFIX."customers where username='".$_SESSION['username']."'";
	$result = mysql_query($sql_query);
	
	if(mysql_num_rows($result) > 0)
	{
		$username = mysql_result($result,0,"username");
		$customername = mysql_result($result,0,"customer_name");
		$address = mysql_result($result,0,"address");
		$special_ins = mysql_result($result,0,"special_instructions");
		$driving_ins = mysql_result($result,0,"driving_instructions");
	}
}
?>
  
		<tr>
			<td>
				<form id="form1" name="form1" action="pickup.php" method="post">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td valign="top" class="banner_inner">
						<div class="left_box_header"><strong><span class="text_15">NYC Pick-up</span></strong><br /><br />
							<!--Olivia Tenants please leave your garments downstairs in the lobby with the concierge, not on the 7th floor, your garments will be returned promptly with the concierge.-->
						</div>
						<table cellspacing="0" cellpadding="0">
							<tr>
							  <td><table border="0" cellpadding="0" cellspacing="6">
								<tbody>
								  	<tr>
										<td colspan="2" align="left">
											<span class="page_heading">Individual Clients</span> <br /><br />
												We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery. 													
										</td>
									</tr>
									
									<tr>
										<td colspan="2" align="left" class="page_heading" height="30px">
											Schedule Pick-up - Regular Customer
										</td>
									</tr>
									
									<? if($message != "") { ?>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr><td colspan="2" class="success"><?=$message;?></td></tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<? } else { ?>
									<tr><td colspan="2">&nbsp;</td></tr>
									<? } ?>
									<tr>
										<td width="282">Today's Date:</td>
										<td width="434"><?= date('l,');?>&nbsp;<?= date('F d, Y');?></td>
									</tr>
									<tr>
										<td height="25px">Username:</td>
										<td>
											<?=$username;?>
										</td>
									</tr>
									<tr>
										<td height="25px">
											Name:
										</td>
										<td>
											<?=$customername;?>
										</td>
									</tr>
									<tr>
										<td height="75px" valign="top">
											Pick-Up Address:
										</td>
										<td>
											<textarea id="txtAddress" name="txtAddress" cols="30" rows="3"><?=$address;?></textarea> <span class="required">*</span>
										</td>
									</tr>
									<tr>
										<td>Pickup Date:</td>
										<td>
											<input type="text" id="pickupdate" name="pickupdate" readonly="readonly" value="<?=date('m/d/Y');?>" />&nbsp;<img src="images/calendar.gif" alt="Calendar" title="Calendar" style="cursor:pointer;" onClick="displayDatePicker('pickupdate');" />
											<input type="hidden" name="todate" id="todate" value="<?=date('m/d/Y');?>" />
										</td>
									</tr>
									<tr>
										<td valign="top" height="125" style="padding-top:10px;">Schedule:</td>
										<td valign="top" style="padding-top:10px;">
											<input type="radio" name="schedule" id="schedule" value="1" checked="checked" /> For the time specified only.<br />
											<input type="radio" name="schedule" id="schedule" value="2" /> Daily at this time except weekends.<br />
											<input type="radio" name="schedule" id="schedule" value="3" /> Daily at this time including weekends.<br />
											<input type="radio" name="schedule" id="schedule" value="4" /> Weekly on this day of the week.<br />
											<input type="radio" name="schedule" id="schedule" value="5" /> Monthly on this day of the month.<br />
										</td>
									</tr>
									<tr>
										<td valign="top">How Would You Like Your Shirts:</td>
										<td>
											<input type="checkbox" id="isboxed" name="isboxed" value="1" /> Boxed <br />
											<input type="checkbox" id="ishung" name="ishung" value="1" /> Hung <br />
											<select name="ddlShirt" id="ddlShirt">
												<option value="No Starch">No Starch</option>
												<option value="Very Light Starch">Very Light Starch</option>
												<option value="Light Starch">Light Starch</option>
												<option value="Medium Starch">Medium Starch</option>
												<option value="Heavy Starch">Heavy Starch</option>
											</select>
										</td>
									</tr>
									<tr>
										<td height="42" colspan="2">
											<input type="checkbox" id="is_urang_bag" name="is_urang_bag" value="1" /> Please tick this box if you need U-Rang bag.
									  </td>
									</tr>
									<tr>
										<td height="38">Doorman:</td>
										<td>
											<select name="doorman" id="doorman">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</td>
									</tr>
									<tr>
										<td height="42" colspan="2">
											We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.										</td>
									</tr>
									<tr>
										<td valign="top">
											Special Instructions:
										</td>
										<td>
											<textarea id="txtSpecialInstruction" name="txtSpecialInstruction" cols="30" rows="3"><?=$special_ins;?></textarea>
										</td>
									</tr>
									<tr>
										<td valign="top">
											Driving Instructions:
										</td>
										<td>
											<textarea id="txtDrivingInstruction" name="txtDrivingInstruction" cols="30" rows="3"><?=$driving_ins;?></textarea>
										</td>
									</tr>
									
									<tr>
										<td height="41" colspan="2">How to pay [ Select any one radio button ] :</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>
											<input type="radio" name="how_to_pay" id="how_to_pay" value="1" /> Charge my credit card this time for amount $ <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" value="2" checked="checked" /> Pre-Authorization - Charge my card on ongoing basis for amounts I owe (recommended for regular customers) <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" value="3" /> COD <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" value="4" /> Check <br />
										</td>
									</tr>
									
									<tr>
										<td class="required" colspan="2">
											To see total and specify items, please complete online form.
										</td>
									</tr>
									<tr>
										<td colspan="2">
										  <input type="checkbox" id="is_onlineorder" checked="checked" name="is_onlineorder" value="1" /> I want to use the online order form
										</td>
									</tr>
									
									<tr>
										<td colspan="2" style="height:50px;">
											<?=formButton("submit","submit","Schedule Pick-Up","onclick='return pickup_valid();'");?>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="font-weight:bold;">
											Referrals - 10 percent discount on your next order if you refer a friend.
										</td>
									</tr>
								  </tbody>
							  </table></td>
							</tr>
						  </table>
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
			</form>
				<!-- end -->
			</td>
		</tr>
		<tr>
			<td>
				<? require('includes/footer.php'); ?>
			</td>
		</tr>
	</table>
