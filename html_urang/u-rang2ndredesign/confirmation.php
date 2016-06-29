<? 
require('includes/config.php');
require('includes/header.php'); 
require('includes/functions.php');

$request = "";
if(isset($_GET["id"])) {
	
	$id = sanitize($_GET["id"]);
	$sql = "SELECT * FROM ".PREFIX."customers WHERE customerid=".$id;
	$getresult = mysql_query($sql);

	if(mysql_num_rows($getresult)>0) {
		$requestid = mysql_result($getresult,0,"requestid");
		$requestdate = mysql_result($getresult,0,"requestdate");
		$request = $requestid.$requestdate;
	}
}
?>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" class="banner_inner">
				<div class="left_box_header"><strong><span class="text_15">Confirmation</span></strong></div><br><br>
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
					  <td>
						<table border="0" cellpadding="3" width="100%" class="border_box">
						<tr>
							<td colspan="2" valign="top" class="page_heading">
								Thank You
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td colspan="2">
								Your Request for Pick-Up has been received. <strong><a href='login.php' style='text-decoration:none;'>Please Login</a></strong>
							</td>
						</tr>
						<tr>
							<td width="19%">Submitted on :</td>
							<td width="81%"><?=date("m/d/Y")." ".date("h:i:s A");?></td>
						</tr>
						<tr>
							<td width="19%">Your request id is:</td>
							<td width="81%"><strong><?=$request;?></strong></td>
						</tr>
						<tr>
							<td colspan="2">Thank You for using <a href="http://www.u-rang.com">u-rang.com</a></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						</table>
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
