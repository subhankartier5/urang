<? 
require('includes/config.php');
if(isset($_GET['logout'])) { session_destroy(); }
require('includes/header.php'); 
require('includes/functions.php');

if(isset($_POST['submit'])){
	
	$username = sanitize($_POST['username']);

	$chkvalid_user = "select * from ".PREFIX."customers where username='".$username."'";
	$result = mysql_query($chkvalid_user);
	
	if(mysql_num_rows($result) > 0)
	{
		$password = mysql_result($result,0,'password');
		$email = mysql_result($result,0,'email');
		$pass = decrypt($password,"abc123");

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
//$from = "irfan.lateef@fsdsolutions.com";

$headers = "From: <$from>\r\n";
$headers  .= "Reply-To: {$from}";
$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
$subject = "U-Rang: Forget Password!";

$message = "";
$message .= "Dear Customer,

Below is your login information:
____________________________________
Login Details:

Username:".$username."
Password:".$pass."
____________________________________

"; 
//////////////////// Sending Email ////////////////////////
if (mail($to,$subject,$message,$headers)) {
$msg ="Your password has been emailed to you.&nbsp;&nbsp;<strong><a href='login.php'>Please click here to login</a></strong>";				
}

	}
	else
	{
		$msg = "Sorry, we couldn't match the username you provided.";
	}
}

?>


<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" class="banner_home">
				<div class="left_box_header"><strong><span class="text_15">Forget Password</span></strong></div><br><br>
				<? if($msg!="") { ?>
				  <div class="success"><?=$msg?></div><br /><br />
				 <? } ?>				
				<table cellspacing="0" cellpadding="0" border="1" align="center">
					<tr>
					  <td>
						<form method="post" action="forgetpassword.php" name="form1">
							<table border="0" cellpadding="3" width="100%" class="border_box">
							<tr>
								<td colspan="2" valign="top" class="whitetext" style="padding-left:15px;">
									Please enter below your username to get your password.
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="whitetext">Username:</td>
								<td class="border_box" width="1%"><input type="text" name="username" id="username" style="width:270px;" maxlength=25></td>
							</tr>
							<tr>
								<td colspan="2" align="right" class="border_box">
									<?=formButton("submit","submit","  Submit  ","");?>
								</td>
							</tr>
							</table>
						</form>
					  </td>
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
		<!-- end -->
	</td>
</tr>
<tr>
	<td>
		<? require('includes/footer.php'); ?>
	</td>
</tr>
</table>
