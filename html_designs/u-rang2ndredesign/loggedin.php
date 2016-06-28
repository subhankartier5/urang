<? 
require('includes/config.php');
require('includes/header.php');
require('includes/functions.php');

if(!isset($_SESSION['username'])) {
	echo "<script language=javascript>location.href=\"login.php\";</script>";
	exit();
}

$sql_pickup = "select * from ".PREFIX."customer_pickup_schedule where username='".$_SESSION['username']."' order by scheduleid";
$pickup_result = mysql_query($sql_pickup);

$msg = "";
if(isset($_GET["message"]))
{
	if($_GET["message"] == 1)
	{
		$msg = "Your order has been added successfully!";
	}
	if($_GET["message"] == 2)
	{
		$msg = "Your pickup request emailed to you!";
	}
	if($_GET["message"] == 3)
	{
		$msg = "Your information has been updated!";
	}
}

?>
  
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td valign="top" class="banner_inner">
						<div class="left_box_header"><strong><span class="text_15">Welcome <?=$_SESSION['customername'];?></span></strong></div>
						<table cellspacing="0" cellpadding="0" width="100%">
							<tr>
							  <td><table border="0" cellpadding="0" cellspacing="6" width="100%">
								<tbody>
									<tr><td height="10px"></td></tr>
									<? if($msg != "") { ?>
									<tr><td class="success"><?=$msg;?></td></tr>
									<? } ?>
									<tr>
										<td class="page_heading">New Pick-Up</td>
									</tr>
									<tr><td height="10px"></td></tr>
									<tr>
										<td class="simple_heading"><a href="pickup.php">Schedule Pick-Up</a></td>
									</tr>
									<tr><td height="10px"></td></tr>
									<tr>
										<td class="page_heading">Current Pick-Ups</td>
									</tr>
									<?
									if(mysql_num_rows($pickup_result) > 0)
									{
										$count = 0;
										while($row_pickup=mysql_fetch_array($pickup_result))
										{
											$scheduleid = $row_pickup["scheduleid"];
											$pickupdate = $row_pickup["pickupdate"]; 
											$pickdate = explode("-",$pickupdate);
											$day = explode(" ", $pickdate[2]);
											$pdate = $pickdate[1]."/".$day[0]."/".$pickdate[0];

											?>
											<tr>
												<td class="BulletText" style="padding-left:30px" valign="top">
													ID: <?=$scheduleid;?> - <?=$pdate;?>
												</td>
											</tr>
									 <? 
									 	}
									}
									else
									{ ?>
									<tr>
										<td class="BulletText" style="padding-left:30px">
											You currently have no scheduled pick-ups.
										</td>
									</tr>		
									<? } ?>
								  	
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
