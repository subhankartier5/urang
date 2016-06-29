<? 
require('includes/config.php');
require('includes/header.php');
require('includes/functions.php');

if(!isset($_SESSION['username'])) {
	echo "<script language=javascript>location.href=\"login.php\";</script>";
	exit();
}
if(!isset($_SESSION["transactionid"])){
	echo "<script language=javascript>location.href=\"orderform.php\";</script>";
    exit();
}

?>
  
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" class="banner_inner">
				<div class="left_box_header"><strong><span class="text_15">Transaction Complete</span></strong></div>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
					  <td><table border="0" cellpadding="0" cellspacing="6" width="100%">
						<tbody>
							<tr><td height="10px"></td></tr>
							<tr>
								<td>
									<p>Your transaction id is: <strong><? if(isset($_SESSION["transactionid"])){ echo $_SESSION["transactionid"]; } ?></strong><br /><br />You have completed the payment of your order. Thank you for your order. </p>
								</td>
							</tr>
							<tr><td height="10px"></td></tr>
							<tr>
								<td><?=formButton("button","continue","  Continue to Home  ","onclick='javascript:location.href=\"index.php\";'");?></td>
							</tr>
							<tr><td height="10px"></td></tr>
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
		<!-- end -->
	</td>
</tr>
<tr>
	<td>
		<? require('includes/footer.php'); ?>
	</td>
</tr>
</table>
