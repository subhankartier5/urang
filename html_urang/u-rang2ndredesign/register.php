<? 
require('includes/config.php');
require('includes/functions.php'); 
require('includes/creditcard.inc.php'); 

if(isset($_POST['submit'])){
	$username = sanitize($_POST['txtUsername']);
	$password = sanitize($_POST['txtPassword']);
	$customername = sanitize($_POST['txtName']);
	$email = sanitize($_POST['txtEmail']);
	$address = sanitize($_POST['txtAddress']);
	$phone = sanitize($_POST['txtPhone']);
	$cell = sanitize($_POST['txtCell']);
	$officephone = sanitize($_POST['txtOfficephone']);
	$special_ins = sanitize($_POST['txtSpecialInstruction']);
	$driving_ins = sanitize($_POST['txtDrivingInstruction']);
	$cardholdername = sanitize($_POST['txtCardHolderName']);
	$cardtype = sanitize($_POST['ddlCardType']);
	$credit_card = sanitize($_POST['txtCreditCard']);
	$cvv2 = sanitize($_POST['txtCVV2']);
	$exp_year = sanitize($_POST['year']);
	
	$month_exp = sanitize($_POST['month']);
	$m = explode("|",$month_exp);
	$exp_month = $m[0];
	
	$month_ex = $m[1];
	$chkExpDate = $month_ex.$exp_year;
	$newDate = date('mY');
	
	// check username already exists
	$chkusername = getField(PREFIX."customers", "username", $username, "username");
	if($chkusername != "")
	{
		$message = "Username already exists!";
	}
	else
	{
		// encrypt password and credit card number
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
				$sql_insert = "INSERT INTO ".PREFIX."customers(username, `password`, customer_name, email, address, phone, cellphone, officephone, special_instructions, driving_instructions, card_holder_name, card_type, credit_card_no, cvv2, expiration_month, expiration_year, registration_date, status, requestid, requestdate) VALUES ('{$username}', '{$pass}', '{$customername}', '{$email}', '{$address}', '{$phone}', '{$cell}', '{$officephone}', '{$special_ins}', '{$driving_ins}', '{$cardholdername}', '{$cardtype}', '{$creditcard}', '{$cvv2}', '{$exp_month}', '{$exp_year}', '{$registration_date}', 1, '{$requestid}', '{$requestdate}')";
			
				mysql_query($sql_insert);
				$customerid = mysql_insert_id();
				
				// Email Start
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
$subject = "U-Rang: Thank You For Register!";

$message = "";
$message .= "Dear ".$customername.",

Thank you for registering with us. Your account is created and your login detail is below. \n
Your request id is: ".$requestid.$requestdate."\n\n
Please Login: http://www.u-rang.com/login.php
____________________________________
Login Details:

Username: ".$username."\n
Password: ".$password."\n
____________________________________

"; 
//////////////////// Sending Email ////////////////////////
if (mail($to,$subject,$message,$headers)) {
$msg ="Your pickup request emailed to you.";				
}				
				// Email End
				
				echo "<script language=javascript>location.href=\"confirmation.php?id=$customerid\";</script>";
				exit();
				$message = "Customer has been registered successfully. <strong><a href='login.php' style='text-decoration:none;'>Please Login</a></strong>";
			} else { $message = "Exipration date is wrong";}
		} 
		else {
				$message = "Credit card information is invalid";
		}
	}
} else {
	$username = "";
	$customername = "";
	$email = "";
	$address = "";
	$phone = "";
	$cell = "";
	$officephone = "";
	$special_ins = "";
	$driving_ins = "";
	$cardholdername = "";
	$cardtype = "";
	$credit_card = "";
	$cvv2 = "";
}

?>