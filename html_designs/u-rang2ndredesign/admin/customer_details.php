<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/new.php");
require('includes/creditcard.inc.php'); 

$stitle = "Customer Details";
$ptitle = "Customer Details";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	 $this_page.=$current_url[$a];
}

$username = "";
$customername = "";
$email = "";
$phone = "Format: 5555555555";
$cell = "Format: 5555555555";
$officephone = "Format: 5555555555";
$address = "";
$sp_ins = "";
$driving_ins = "";
$cardholdername = "";
$cardtype = "";
$credit_card = "";
$cvv2 = "";	

// Add New Customer
if ($_POST["submit"]=="Add Customer"){

	$username = santisize($_POST["username"]);
	$password = santisize($_POST["pass"]);
	$customername = santisize($_POST["customername"]);
	$email = santisize($_POST["email"]);
	$phone = santisize($_POST["phone"]);
	$cell = santisize($_POST["cellphone"]);
	$officephone = santisize($_POST["officephone"]);
	$address = santisize($_POST["address"]);
	$sp_ins = santisize($_POST["sp_ins"]);
	$driving_ins = santisize($_POST["driving_ins"]);
	$cardholdername = santisize($_POST["cardholdername"]);
	$cardtype = santisize($_POST["cardtype"]);
	$credit_card = santisize($_POST["cardnumber"]);
	$cvv2 = santisize($_POST["cvv2"]);		
	//$exp_month = sanitize($_POST['month']);
	$exp_year = sanitize($_POST['year']);
	
	$month_exp = sanitize($_POST['month']);
	$m = explode("|",$month_exp);
	$exp_month = $m[0];
	
	$month_ex = $m[1];
	$chkExpDate = $month_ex.$exp_year;
	$newDate = date('mY');

	$chkusername = getFields(PREFIX."customers", "username", $username, "username");
	if($chkusername != "")
	{
		$msg = "<div class='error'>Username already exists!</div>";
	}
	else
	{
		$pass = encrypt($password, "abc123");
		$creditcard = encrypt($credit_card, "abc123");
		$registration_date = date('Y-m-d');
		$requestid = GenerateNumCode(6, 2);
		$requestdate = date('mdY');	
		
		// calling credit card class
		$cc=new CCVAL;
		$obj=$cc->isVAlidCreditCard($credit_card,"",true);
		$isvalid = $obj->valid;
		$cardnumber = $obj->ccnum;
		$ctype = $obj->type;
		
		if($isvalid==1 && $cardtype == $ctype) 
		{
			if($chkExpDate > $newDate) 
			{
		
				$sql_insert = "INSERT INTO ".PREFIX."customers(username, `password`, customer_name, email, address, phone, cellphone, officephone, special_instructions, driving_instructions, card_holder_name, card_type, credit_card_no, cvv2, expiration_month, expiration_year, registration_date, status, requestid, requestdate) VALUES ('{$username}', '{$pass}', '{$customername}', '{$email}', '{$address}', '{$phone}', '{$cell}', '{$officephone}', '{$sp_ins}', '{$driving_ins}', '{$cardholdername}', '{$cardtype}', '{$creditcard}', '{$cvv2}', '{$exp_month}', '{$exp_year}', '{$registration_date}', 1, '{$requestid}', '{$requestdate}')";
				
				mysql_query($sql_insert);
				$msg = "<div class='success'>Customer has been registered successfully.</div>";
				
			} else { $msg = "<div class='error'>Exipration date is wrong.</div>"; }
		} 
		else { $msg = "<div class='error'>Credit card information is invalid.</div>"; }
	}	
}

// change password
elseif ($_POST["submit"]=="Change"){
	$ids=santisize($_POST["ids"]);
	$pass=santisize($_POST["newpwd"]);
	$pass=encrypt($pass, "abc123");

	$sql_upd = "UPDATE ".PREFIX."customers SET password ='".$pass."' where customerid=".$ids;
	mysql_query($sql_upd);

	$msg='<div class="success">Password has been changed!</div>';
}

// update customer
else if ($_POST["submit"]=="Update"){
	$id = santisize($_POST["id"]);
	$customername = santisize($_POST["customername"]);
	$email = santisize($_POST["email"]);
	$phone = santisize($_POST["phone"]);
	$cellphone = santisize($_POST["cellphone"]);
	$officephone = santisize($_POST["officephone"]);
	$address = santisize($_POST["address"]);
	$sp_ins = santisize($_POST["sp_ins"]);
	$driving_ins = santisize($_POST["driving_ins"]);
	
	$cardholdername = sanitize($_POST['cardholdername']);
	$cardtype = sanitize($_POST['cardtype']);
	$credit_card = sanitize($_POST['cardnumber']);
	$cvv2 = sanitize($_POST['cvv2']);
	$year = sanitize($_POST['year']);
	$month_exp = sanitize($_POST['month']);
	
	$m = explode("|",$month_exp);
	$month = $m[0];
	
	$month_ex = $m[1];
	$chkExpDate = $month_ex.$year;
	$newDate = date('mY');
	
	// encrypt credit card number
	$creditcard = encrypt($credit_card, "abc123");
	
	// calling credit card class
	$cc=new CCVAL;
	$obj=$cc->isVAlidCreditCard($credit_card,"",true);
	$isvalid = $obj->valid;
	$cardnumber = $obj->ccnum;
	$ctype = $obj->type;
	
	if($isvalid==1 && $cardtype == $ctype) 
	{
		if($chkExpDate > $newDate) 
		{
			$qry_upd = "UPDATE ".PREFIX."customers SET customer_name='".$customername."', email='".$email."', address='".$address."', phone='".$phone."', cellphone='".$cellphone."', officephone='".$officephone."', special_instructions='".$sp_ins."', driving_instructions='".$driving_ins."', card_holder_name='".$cardholdername."', card_type='".$cardtype."', credit_card_no='".$creditcard."', cvv2='".$cvv2."', expiration_month='".$month."', expiration_year='".$year."'  where customerid=".$id;
			
			mysql_query($qry_upd);
			
			$msg='<div class="success">Customer Updated.</div>';
		} else { $msg='<div class="error">Exipration date is wrong.</div>'; }
	}
	else { $msg='<div class="error">Credit card information is invalid.</div>'; }
	

}

// delete customer
else if ($_GET["act"]=="delete"){
	$id=santisize($_GET["id"]);

	$sql=mysql_query("delete from ".PREFIX."customers where customerid='$id'");	
	$msg='<div class="success">Customer has been deleted.</div>';
}

else if ($_GET["inactive"]=="1"){
	$id=santisize($_GET["id"]);
	mysql_query("update ".PREFIX."items set status='0' where id='$id'");	
	$msg='<div class="success">'.$stitle.' deactivated.</div>';
}

else if ($_GET["active"]=="1"){
	$id=santisize($_GET["id"]);
	mysql_query("update ".PREFIX."items set status='1' where id='$id'");	
	$msg='<div class="success">'.$stitle.' activated.</div>';
}

	
if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("select * from ".PREFIX."customers");
$no_of_records=mysql_num_rows($sql);
// Pagination class //
if ($no_of_records>0){
	$limit = $_SESSION[$this_page.'_limit'];
	$PaginateIt = new pagination();
	$PaginateIt->SetItemsPerPage($limit);
	$PaginateIt->SetQueryString('');
	$PaginateIt ->SetLinksToDisplay(5);
	$PaginateIt->SetItemCount($no_of_records);
	$PaginateIt->SetLinksFormat( '<< Back', ' | ', 'Next >>' );
	
	if($_GET["page"]){			
		$pageVar = ($limit* htmlspecialchars(addslashes($_GET["page"]))) - $limit;			
	}else{
		$pageVar = 0;
	}
	
	$PageLinks = $PaginateIt->GetPageLinks();
  	$query = "select * from ".PREFIX."customers order by customerid ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
}
// Pagination class //
$sql=mysql_query($query);

$style_add="";
$style_list="";
if ($_REQUEST["act"]=="edit" || $update==1 || $_REQUEST["act"]=="add" || $_REQUEST["act"]=="change")
{
    $style_add="display: block;";
    $style_list="display: none";
}

else {
    $style_add="display: none;";
    $style_list="display: block";
}
?>
<link href="javascripts/validator.js"  type="text/javascript" />
		<div id="top-panel">
			<div id="panel">
				<ul>
					<? include ("cms_menu_links.php"); ?>
                </ul>
            </div>
		</div>
        <div id="wrapper">
			<div id="content">
				<?=$msg?>
            	<div id="box" style="<?=$style_list;?>">
                	<h3><?=$ptitle?></h3>
                    
					<form id="form" method="post" action="<?=$this_page?>.php">
					<table width="100%" border="0">
						<tr>
							<td align="right">
                    			<a href="customer_details.php?act=add" class="footer_links">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Add New Customer</strong></a>
                  			</td>
						</tr>
					</table>
                    <table width="100%">
						<thead>
							<tr>
								<th align="left" width="18%">Customer Name</th>
                            	<th align="left" width="18%">Email</th>
                                 <th align="left" width="12%">Phone</th>
								 <th align="left" width="20%">Address</th>
								 <th align="left"  width="12%">Request Id</th>
                                <th align="center" width="15%">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ $count++;
                        ?>
							<tr>
								<td align="left"><?=$rs->customer_name?></td>
                            	<td align="left"><?=$rs->email?></td>
                                <td align="left"><?=$rs->phone?></td>
                               	<td align="left"><?=$rs->address?></td>
								<td align="left"><?=$rs->requestid.$rs->requestdate?></td>
                                <td align="center">
								<a href="<?=$this_page?>.php?id=<?=$rs->customerid?>&act=change"><img src="images/icons/change1.png" title="Change Password" width="16" height="16" /></a><a href="<?=$this_page?>.php?id=<?=$rs->customerid?>&act=edit"><img src="images/icons/brick_edit.png" title="Edit" width="16" height="16" /></a><a href="javascript:if(confirm('Are you sure you want to delete?')){window.location='<?=$this_page?>.php?id=<?=$rs->customerid?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
                            </tr>

						<? } ?>
							
						</tbody>
					</table>
					</form>
					<center>
					<? if ($no_of_records>10) { ?>
					<?=$PageLinks?>&nbsp;View <select name="limit" onchange="javascript:window.location='?limit='+this.value">
                    				<option value="10" <? if ($_SESSION[$this_page.'_limit']==10) echo "selected";?>>10</option>
                                    <option value="20" <? if ($_SESSION[$this_page.'_limit']==20) echo "selected";?>>20</option>
                                    <option value="50" <? if ($_SESSION[$this_page.'_limit']==50) echo "selected";?>>50</option>
                                    <option value="100" <? if ($_SESSION[$this_page.'_limit']==100) echo "selected";?>>100</option>
                    			</select> 
                    per page<br/>
					<? } ?>
					Total <b><?=$no_of_records?></b> Records Found.
					</center>
				</div>
				<br />
                <div id="box" style="<?=$style_add;?>">
					<?php
					// Start Change Password
					if (isset($_GET["act"]) && $_GET["act"]=="change") {
					 $id=santisize($_GET["id"]);
						$password = getFields(PREFIX."customers", "customerid", $id, "password");
						$customername = getFields(PREFIX."customers", "customerid", $id, "customer_name");
						$currentpass = decrypt($password,"abc123");
					?>

					 <h3 id="update_designer">Change Password for <?=$customername?></h3>
                    <form id="form" name="form1" action="customer_details.php" method="post">

                    <input name="ids" id="ids" type="hidden" value="<?=$id?>">
                      <fieldset>
					  	<table>
							<tr>
								<td style="padding-left:15px;" align="left">
							 		<b>Current Password <span class="required">*</span>:</b>
								</td>
								<td style="padding-left:15px;" align="left">
									<label style="font-weight:bold;"><?=$currentpass;?></label>
								</td>
                             </tr>
                             <tr>
							 	<td style="padding-left:15px;" align="left">
									<b>New Password<span class="required">*</span>:</b>
								</td>
								<td style="padding-left:15px;" align="left">
									<input name="newpwd" id="newpwd" type="password" size="65" style="width: 200px;"/>
								</td>
							</tr>
							<tr>
								<td style="padding-left:15px;" align="left">
							   		<b>Confirm Password<span class="required">*</span>:</b>
								</td>
								<td style="padding-left:15px;" align="left">
								 	<input name="confirmpwd" id="confirmpwd" type="password" size="65" style="width: 200px;"/>
								</td>
							</tr>
						</table>
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" name="submit" value="Change" onclick="return chkpwd();" />
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='<?=$this_page?>.php'"/>
                      </div>
                    </form>
				<?php
					}
					else if ($_GET["act"]=="edit" || $update==1) {  if ($_GET["act"]=="edit") $id=santisize($_GET["id"]);
                    $sql_upd = "select * from ".PREFIX."customers where customerid=".$id;
					$cus_result = mysql_query($sql_upd);
					if(mysql_num_rows($cus_result) > 0) {
						$customername = mysql_result($cus_result, 0, 'customer_name');
						$email = mysql_result($cus_result, 0, 'email');
						$address = mysql_result($cus_result, 0, 'address');
						$phone = mysql_result($cus_result, 0, 'phone');
						$cellphone = mysql_result($cus_result, 0, 'cellphone');
						$officephone = mysql_result($cus_result, 0, 'officephone');
						$sp_ins = mysql_result($cus_result, 0, 'special_instructions');
						$cardholdername = mysql_result($cus_result,0,'card_holder_name');
						$driving_ins = mysql_result($cus_result, 0, 'driving_instructions');
						$cardtype = mysql_result($cus_result,0,'card_type');
						$ccno = mysql_result($cus_result,0,'credit_card_no');
						$credit_card = decrypt($ccno,"abc123");
						$cvv2 = mysql_result($cus_result,0,'cvv2');
						$month = mysql_result($cus_result,0,'expiration_month');
						$year = mysql_result($cus_result,0,'expiration_year');
					}
                    ?>
					<table>
						<tr>
							<td>
								<h3 id="update_designer">Update Customer [<?=$customername;?>]</h3>
							</td>
							<td align="right">
								<h3>The required fields are marked with <span class="required">*</span></h3>
							</td>
						</tr>
					</table>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data">
					<input name="id" type="hidden" value="<?=$id?>"/>
                      <fieldset>
					  	<table>
							<tr>
								<td align="left" style="padding-left:15px;">
									Customer Name:
								</td>
								<td>							    
							    	<input name="customername" id="customername" type="text" value="<?=$customername;?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Email:
								</td>
								<td>
									<input type="text" id="email" name="email" value="<?=$email;?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Phone:
								</td>
								<td>
									<input type="text" id="phone" name="phone" onFocus="javascript:emptyformat(document.getElementById('phone'));" onBlur="javascript:resetformat(document.getElementById('phone'));" value="<? if($phone!="") echo $phone; else echo 'Format: 5555555555'; ?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Cell Phone:
								</td>
								<td>
									<input type="text" id="cellphone" name="cellphone" onFocus="javascript:emptyformat(document.getElementById('cellphone'));" onBlur="javascript:resetformat(document.getElementById('cellphone'));" value="<? if($cellphone!="") echo $cellphone; else echo 'Format: 5555555555';?>" style="width:240px;" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Office Phone:
								</td>
								<td>
									<input type="text" id="officephone" name="officephone" onFocus="javascript:emptyformat(document.getElementById('officephone'));" onBlur="javascript:resetformat(document.getElementById('officephone'));" value="<? if($officephone!="") echo $officephone; else echo 'Format: 5555555555';?>" style="width:240px;" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Address:
								</td>
								<td>
									<textarea id="address" name="address" cols="30" rows="3"><?=$address;?></textarea>  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Special Instructions:
								</td>
								<td>
									<textarea id="sp_ins" name="sp_ins" cols="30" rows="3"><?=$sp_ins;?></textarea>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Driving Instructions:
								</td>
								<td>
									<textarea id="driving_ins" name="driving_ins" cols="30" rows="3"><?=$driving_ins;?></textarea>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Card Holder Name:
								</td>
								<td>
									<input type="text" id="cardholdername" name="cardholdername" value="<?=$cardholdername?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Card Type:
								</td>
								<td>
									<select name="cardtype" id="cardtype">
										<option value="" selected="selected">--Select Card Type--</option>
										<option value="Visa" <? if($cardtype=="Visa") {?> selected="selected" <? } ?>>Visa</option>
										<option value="Master Card"<? if($cardtype=="Master Card") {?> selected="selected" <? } ?>>Master Card</option>
										<option value="American Express"<? if($cardtype=="American Express") {?> selected="selected" <? } ?>>American Express</option>
									</select> <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Credit Card No:
								</td>
								<td>
									<input type="text" id="cardnumber" name="cardnumber" value="<?=$credit_card?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									CVV2:
								</td>
								<td>
									<input type="text" id="cvv2" name="cvv2" value="<?=$cvv2?>" style="width:40px;" maxlength="4" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Expiration Date:
								</td>
								<td>
									<? $lang = "January, February, March, April, May, June, July, August, September, October, November, December ";
									$lang = explode(",", $lang);
									?>
									<?  monthPullDown($lang,$month); monthPullYear(date('Y'),$year); ?>  <span class="required">*</span>
                                </td>
							</tr>
						</table>
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" name="submit" value="Update" onclick="return upd_customer_valid();" />
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='<?=$this_page?>.php';"/>
                      </div>
                    </form>
					<script language="javascript">
					document.form1.submit.focus();
					</script>				
					<? } else { ?>
					<table>
						<tr>
							<td>
								<h3>Add New Customer</h3>
							</td>
							<td align="right">
								<h3>The required fields are marked with <span class="required">*</span></h3>
							</td>
						</tr>
					</table>
                	
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data" onsubmit="return <?=$stitle?>();">
                      <fieldset>
					  	<table>
							<tr>
								<td align="left" style="padding-left:15px;">
									User Name:
								</td>
								<td>							    
							    	<input name="username" id="username" type="text" value="<?=$username?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Password:
								</td>
								<td>							    
							    	<input name="pass" id="pass" type="password" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Confirm Password:
								</td>
								<td>							    
							    	<input name="confirmpass" id="confirmpass" type="password" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Customer Name:
								</td>
								<td>							    
							    	<input name="customername" id="customername" value="<?=$customername?>" type="text" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Email:
								</td>
								<td>
									<input type="text" id="email" name="email" value="<?=$email?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Phone:
								</td>
								<td>
									<input type="text" id="phone" name="phone" onFocus="javascript:emptyformat(document.getElementById('phone'));" onBlur="javascript:resetformat(document.getElementById('phone'));" value="<?=$phone?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Cell Phone:
								</td>
								<td>
									<input type="text" id="cellphone" name="cellphone" onFocus="javascript:emptyformat(document.getElementById('cellphone'));" onBlur="javascript:resetformat(document.getElementById('cellphone'));" value="<?=$cell?>" style="width:240px;" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Office Phone:
								</td>
								<td>
									<input type="text" id="officephone" name="officephone" style="width:240px;" onFocus="javascript:emptyformat(document.getElementById('officephone'));" onBlur="javascript:resetformat(document.getElementById('officephone'));" value="<?=$officephone?>" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Address:
								</td>
								<td>
									<textarea id="address" name="address" cols="30" rows="3"><?=$address?></textarea>  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Special Instructions:
								</td>
								<td>
									<textarea id="sp_ins" name="sp_ins" cols="30" rows="3"><?=$sp_ins?></textarea>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Driving Instructions:
								</td>
								<td>
									<textarea id="driving_ins" name="driving_ins" cols="30" rows="3"><?=$driving_ins?></textarea>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Card Holder Name:
								</td>
								<td>
									<input type="text" id="cardholdername" name="cardholdername" value="<?=$cardholdername?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Card Type:
								</td>
								<td>
									<select name="cardtype" id="cardtype">
										<option value="" selected="selected">--Select Card Type--</option>
										<option value="Visa" <? if($cardtype=="Visa") {?> selected="selected" <? } ?>>Visa</option>
										<option value="Master Card"<? if($cardtype=="Master Card") {?> selected="selected" <? } ?>>Master Card</option>
										<option value="American Express"<? if($cardtype=="American Express") {?> selected="selected" <? } ?>>American Express</option>
									</select> <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Credit Card No:
								</td>
								<td>
									<input type="text" id="cardnumber" name="cardnumber" value="<?=$credit_card?>" style="width:240px;" />  <span class="required">*</span>
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									CVV2:
								</td>
								<td>
									<input type="text" id="cvv2" name="cvv2" value="<?=$cvv2?>" style="width:40px;" maxlength="4" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Expiration Date:
								</td>
								<td>
									<? $lang = "January, February, March, April, May, June, July, August, September, October, November, December ";
									$lang = explode(",", $lang);
									?>
									<?  monthPullDown($lang,""); monthPullYear(date('Y'),""); ?>  <span class="required">*</span>
                                </td>
							</tr>
						</table>
                        <br />
                      </fieldset>
                      <div align="center">
                      <input type="hidden" name="act" value="add"/>
                      <input id="button1" type="submit" name="submit" value="Add Customer" onclick="return registration_valid();" /> 
                      <input id="button2" type="reset" />
                      </div>
                    </form>
					<? } ?>
                </div>
            </div>
            
   	  	<?php
	  	require("footer.php");
	  	?>
	</div>
</body>
</html>
