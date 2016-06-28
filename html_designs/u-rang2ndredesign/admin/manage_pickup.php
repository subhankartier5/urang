<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/class.upload.php");
require("includes/new.php");


$stitle = "Scheduled Pickup";
$ptitle = "Scheduled Pickup";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	 $this_page.=$current_url[$a];
}

// Add New Pickup
if ($_POST["submit"]=="Schedule Pickup"){

	$username = sanitize($_POST['uname']);
	$address = sanitize($_POST['txtAddress']);
	$special_ins = sanitize($_POST['txtSpecialInstruction']);
	$driving_ins = sanitize($_POST['txtDrivingInstruction']);
	$pickupdate = sanitize($_POST['pickupdate']);
	$schedule = sanitize($_POST['schedule']);
	$isboxed = sanitize($_POST['isboxed']);
	$ishung = sanitize($_POST['ishung']);
	$ddlShirt = sanitize($_POST['ddlShirt']);
	$is_urang_bag = sanitize($_POST['is_urang_bag']);
	$doorman = sanitize($_POST['doorman']);
	$how_to_pay = sanitize($_POST['how_to_pay']);
	$is_onlineorder = 0;
	$todate = date("Y-m-d");
	
	$likeurshirt = "";
	$urangbag = "No";
	$onlineorder = "No";
	
	if($isboxed=="") {$isboxed = 0;} else {$likeurshirt .= "Boxed";}
	if($ishung=="") {$ishung = 0;} else {$likeurshirt .= " Hung";}
	if($is_urang_bag=="") {$is_urang_bag = 0;} else {$urangbag = "Yes";}
	
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
	$msg = "<div class='success'>New Pickup has been scheduled.</div>";
}

// update customer
else if ($_POST["submit"]=="Update"){
	$id = santisize($_POST["id"]);
	
	$address = sanitize($_POST['txtAddress']);
	$special_ins = sanitize($_POST['txtSpecialInstruction']);
	$driving_ins = sanitize($_POST['txtDrivingInstruction']);
	$pickupdate = sanitize($_POST['pickupdate']);
	$schedule = sanitize($_POST['schedule']);
	$isboxed = sanitize($_POST['isboxed']);
	$ishung = sanitize($_POST['ishung']);
	$ddlShirt = sanitize($_POST['ddlShirt']);
	$is_urang_bag = sanitize($_POST['is_urang_bag']);
	$doorman = sanitize($_POST['doorman']);
	$how_to_pay = sanitize($_POST['how_to_pay']);
	$is_onlineorder = 0;
	$todate = date("Y-m-d");
	
	$likeurshirt = "";
	$urangbag = "No";
	$onlineorder = "No";
	
	if($isboxed=="") {$isboxed = 0;} else {$likeurshirt .= "Boxed";}
	if($ishung=="") {$ishung = 0;} else {$likeurshirt .= " Hung";}
	if($is_urang_bag=="") {$is_urang_bag = 0;} else {$urangbag = "Yes";}
	
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
	
	$pick_upd = "UPDATE ".PREFIX."customer_pickup_schedule SET address='{$address}', pickupdate='{$pickupdate}', schedule='{$str_schedule}', isboxed={$isboxed}, ishung={$ishung}, starch='{$ddlShirt}', is_urange_bag={$is_urang_bag}, doorman='{$doorman}', special_instructions='{$special_ins}', driving_instructions='{$driving_ins}', how_to_pay='{$str_how_to_pay}' WHERE scheduleid={$id}";
	
	mysql_query($pick_upd);
	$msg='<div class="success">Pickup Updated.</div>';

}

// delete customer
else if ($_GET["act"]=="delete"){
	$id=santisize($_GET["id"]);

	$sql=mysql_query("delete from ".PREFIX."customer_pickup_schedule where scheduleid='$id'");	
	$msg='<div class="success">Pickup has been deleted.</div>';
}

	
if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("SELECT c.customer_name, p.scheduleid, p.username, p.pickupdate, p.address, p.schedule, p.starch FROM ".PREFIX."customer_pickup_schedule as p INNER JOIN ".PREFIX."customers as c ON c.username = p.username");
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
  	$query = "SELECT c.customer_name, p.scheduleid, p.username, p.pickupdate, p.address, p.schedule, p.starch FROM ".PREFIX."customer_pickup_schedule as p INNER JOIN ".PREFIX."customers as c ON c.username = p.username order by p.scheduleid desc ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
}
// Pagination class //
$sql=mysql_query($query);

$style_add="";
$style_list="";
if ($_REQUEST["act"]=="edit" || $update==1 || $_REQUEST["act"]=="add")
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
                    			<a href="manage_pickup.php?act=add" class="footer_links">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>New Pickup</strong></a>
                  			</td>
						</tr>
					</table>
                    <table width="100%">
						<thead>
							<tr>
								<th align="left" style="padding-left:10px;">Customer Name</th>
                            	<th align="left" style="padding-left:10px;">Pickup Date</th>
                                 <th align="left" style="padding-left:10px;">Pickup Address</th>
								 <th align="left" style="padding-left:10px;">Schedule</th>
								 <th align="left" style="padding-left:10px;">Starch</th>
                                <th align="center">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ $count++;
						$od = $rs->pickupdate;
						$od1 = explode(" ",$od);
						$od2 = explode("-",$od1[0]);
						$pickupdate = $od2[1]."/".$od2[2]."/".$od2[0];
                        ?>
							<tr>
								<td align="left" style="padding-left:10px;"><?=$rs->customer_name?></td>
                            	<td align="left" style="padding-left:10px;"><?=$pickupdate?></td>
                                <td align="left" style="padding-left:10px;"><?=$rs->address?></td>
                               	<td align="left" style="padding-left:10px;"><?=$rs->schedule?></td>
								<td align="left" style="padding-left:10px;"><?=$rs->starch?></td>
                                <td align="center">
								<a href="<?=$this_page?>.php?id=<?=$rs->scheduleid?>&act=edit"><img src="images/icons/brick_edit.png" title="Edit" width="16" height="16" /></a><a href="javascript:if(confirm('Are you sure you want to delete?')){window.location='<?=$this_page?>.php?id=<?=$rs->scheduleid?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
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
					if ($_GET["act"]=="edit" || $update==1) {  if ($_GET["act"]=="edit") $id=santisize($_GET["id"]);
                    $sql_upd = "select * from ".PREFIX."customer_pickup_schedule where scheduleid=".$id;
					$sch_result = mysql_query($sql_upd);
					
					if(mysql_num_rows($sch_result) > 0) {
						$username = mysql_result($sch_result, 0, 'username');
						$address = mysql_result($sch_result, 0, 'address');
						$pdate = mysql_result($sch_result, 0, 'pickupdate');
						$schedule = mysql_result($sch_result, 0, 'schedule');
						$isboxed = mysql_result($sch_result, 0, 'isboxed');
						$ishung = mysql_result($sch_result, 0, 'ishung');
						$starch = mysql_result($sch_result, 0, 'starch');
						$is_urangbag = mysql_result($sch_result, 0, 'is_urange_bag');
						$doorman = mysql_result($sch_result, 0, 'doorman');
						$sp_ins = mysql_result($sch_result, 0, 'special_instructions');
						$driving_ins = mysql_result($sch_result, 0, 'driving_instructions');
						$how_to_pay = mysql_result($sch_result, 0, 'how_to_pay');
						$od1 = explode(" ",$pdate);
						$od2 = explode("-",$od1[0]);
						$pickupdate = $od2[1]."/".$od2[2]."/".$od2[0];
					}
                    ?>
					<table>
						<tr>
							<td>
								<h3>Schedule Pick-up - Regular Customer </h3>
							</td>
							<td align="right">
								<h3>The required fields are marked with <span class="required">*</span></h3>
							</td>
						</tr>
					</table>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data">
					<input name="id" type="hidden" value="<?=$id?>"/>
                      <fieldset>
					  	<table cellspacing="0" cellpadding="0">
							<tr>
							  <td><table border="0" cellpadding="0" cellspacing="6">
								<tbody>
									<tr>
										<td height="25px" align="left" style="padding-left:10px;">
											Username:
										</td>
										<td>
											<input name="uname" id="uname" type="text" value="<?=$username?>" readonly style="width:220px;" />
										</td>
									</tr>
									<tr>
										<td height="75px" valign="top" align="left" style="padding-left:10px;">
											Pick-Up Address:
										</td>
										<td>
											<textarea id="txtAddress" name="txtAddress" cols="30" rows="3"><?=$address?></textarea> <span class="required">*</span>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left:10px;">Pickup Date:</td>
										<td>
											<input type="text" id="pickupdate" name="pickupdate" readonly="readonly" value="<?=$pickupdate?>" />&nbsp;<img src="images/calendar.gif" alt="Calendar" title="Calendar" style="cursor:pointer;" onClick="displayDatePicker('pickupdate');" />
											<input type="hidden" name="todate" id="todate" value="<?=date('m/d/Y');?>" />
										</td>
									</tr>
									<tr>
										<td valign="top" height="125" style="padding-top:10px; padding-left:10px;" align="left">Schedule:</td>
										<td valign="top" style="padding-top:10px;">
											<input type="radio" name="schedule" id="schedule" value="1" <? if($schedule=="For the time specified only") {?> checked="checked" <? } ?> /> For the time specified only.<br />
											<input type="radio" name="schedule" id="schedule" <? if($schedule=="Daily at this time except weekends") {?> checked="checked" <? } ?> value="2" /> Daily at this time except weekends.<br />
											<input type="radio" name="schedule" id="schedule" <? if($schedule=="Daily at this time including weekends") {?> checked="checked" <? } ?> value="3" /> Daily at this time including weekends.<br />
											<input type="radio" name="schedule" id="schedule" <? if($schedule=="Weekly on this day of the week") {?> checked="checked" <? } ?> value="4" /> Weekly on this day of the week.<br />
											<input type="radio" name="schedule" id="schedule" <? if($schedule=="Monthly on this day of the month") {?> checked="checked" <? } ?> value="5" /> Monthly on this day of the month.<br />
										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">How Would You Like Your Shirts:</td>
										<td>
											<input type="checkbox" id="isboxed" name="isboxed" <? if($isboxed==1){ ?> checked="checked" <? } ?> value="1" /> Boxed <br />
											<input type="checkbox" id="ishung" name="ishung" <? if($ishung==1){ ?> checked="checked" <? } ?> value="1" /> Hung <br />
											<!--<select name="ddlShirt" id="ddlShirt">
												<option value="No Starch">No Starch</option>
												<option value="Very Light Starch">Very Light Starch</option>
												<option value="Light Starch">Light Starch</option>
												<option value="Medium Starch">Medium Starch</option>
												<option value="Heavy Starch">Heavy Starch</option>
											</select>-->
											<? 
												$starch_ddl='<select name="ddlShirt" id="ddlShirt">';
											
												$starch_ddl.='<option value="No Starch"';
												($starch=="No Starch" ? $starch_ddl.=' selected="selected"' : $starch_ddl.='');
												$starch_ddl.='>No Starch</option>';
									
												$starch_ddl.='<option value="Very Light Starch"';
												($starch=="Very Light Starch" ? $starch_ddl.=' selected="selected"' : $starch_ddl.='');
												$starch_ddl.='>Very Light Starch</option>';
									
												$starch_ddl.='<option value="Light Starch"';
												($starch=="Light Starch" ? $starch_ddl.=' selected="selected"' : $starch_ddl.='');
												$starch_ddl.='>Light Starch</option>';
									
												$starch_ddl.='<option value="Medium Starch"';
												($starch=="Medium Starch" ? $starch_ddl.=' selected="selected"' : $starch_ddl.='');
												$starch_ddl.='>Medium Starch</option>';
												
												$starch_ddl.='<option value="Heavy Starch"';
												($starch=="Heavy Starch" ? $starch_ddl.=' selected="selected"' : $starch_ddl.='');
												$starch_ddl.='>Heavy Starch</option>';
												
											$starch_ddl.='</select>';
											
											echo $starch_ddl;
											?>
											
										</td>
									</tr>
									<tr>
										<td height="42" colspan="2" align="left" style="padding-left:10px;">
											<input type="checkbox" id="is_urang_bag" name="is_urang_bag" <? if($is_urangbag==1) { ?> checked="checked" <? } ?> value="1" /> Please tick this box if you need U-Rang bag.
									  </td>
									</tr>
									<tr>
										<td height="38" align="left" style="padding-left:10px;">Doorman:</td>
										<td>
											<select name="doorman" id="doorman">
												<option value="Yes" <?if($doorman=="Yes") {?> selected="selected"<? } ?>>Yes</option>
												<option value="No"<?if($doorman=="No") {?> selected="selected"<?}?>>No</option>
											</select>
										</td>
									</tr>
									<tr>
										<td height="42" colspan="2" align="left" style="padding-left:10px;">
											We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">
											Special Instructions:
										</td>
										<td>
											<textarea id="txtSpecialInstruction" name="txtSpecialInstruction" cols="30" rows="3"><?=$sp_ins;?></textarea>
										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">
											Driving Instructions:
										</td>
										<td>
											<textarea id="txtDrivingInstruction" name="txtDrivingInstruction" cols="30" rows="3"><?=$driving_ins;?></textarea>
										</td>
									</tr>
									
									<tr>
										<td height="41" colspan="2" align="left" style="padding-left:10px;">How to pay [ Select any one radio button ] :</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>
											<input type="radio" name="how_to_pay" id="how_to_pay" <? if($how_to_pay=="Charge my credit card this time for amount $") { ?> checked="checked" <? } ?> value="1" /> Charge my credit card this time for amount $ <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" value="2" <? if($how_to_pay=="Pre-Authorization - Charge my card on ongoing basis for amounts I owe (recommended for regular customers)") { ?> checked="checked" <? } ?> /> Pre-Authorization - Charge my card on ongoing basis for amounts I owe (recommended for regular customers) <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" <? if($how_to_pay=="COD") { ?> checked="checked" <? } ?> value="3" /> COD <br />
											<input type="radio" name="how_to_pay" id="how_to_pay" <? if($how_to_pay=="Check") { ?> checked="checked" <? } ?> value="4" /> Check <br />
										</td>
									</tr>
								  </tbody>
							  </table></td>
							</tr>
						  </table>
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" name="submit" value="Update" onclick="return pickup_valid();" />
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
								<h3>Schedule Pick-up - Regular Customer </h3>
							</td>
							<td align="right">
								<h3>The required fields are marked with <span class="required">*</span></h3>
							</td>
						</tr>
					</table>
                	
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data" onsubmit="return <?=$stitle?>();">
                      <fieldset>
							<table cellspacing="0" cellpadding="0">
							<tr>
							  <td><table border="0" cellpadding="0" cellspacing="6">
								<tbody>
									
									<tr>
										<td width="282" align="left" style="padding-left:10px;">Today's Date:</td>
										<td width="434"><?= date('l,');?>&nbsp;<?= date('F d, Y');?></td>
									</tr>
									<tr>
										<td height="25px" align="left" style="padding-left:10px;">Customer Name:</td>
										<td>
											<select name="customername" id="customername" onchange="getcustomername(this.value)">
												<option value="">--Select Customer Name--</option>
												<?
													$sql_cus = "SELECT * FROM ".PREFIX."customers";
													$cus_result = mysql_query($sql_cus);
													$customername = "";
													if(mysql_num_rows($cus_result)>0) {
														while($rows=mysql_fetch_array($cus_result)) {
															$customername .= "<option value='".$rows['customerid']."'>".$rows['customer_name']."</option>";
														}
														echo $customername;
													}
												?>
											</select> <span class="required">*</span>
										</td>
									</tr>
									<tr>
										<td height="25px" align="left" style="padding-left:10px;">
											Username:
										</td>
										<td>
											<div id="customernames" style="float:left;">
												<input name="uname" id="uname" type="text" readonly style="width:220px;" />
											</div>
										</td>
									</tr>
									<tr>
										<td height="75px" valign="top" align="left" style="padding-left:10px;">
											Pick-Up Address:
										</td>
										<td>
											<textarea id="txtAddress" name="txtAddress" cols="30" rows="3"></textarea> <span class="required">*</span>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left:10px;">Pickup Date:</td>
										<td>
											<input type="text" id="pickupdate" name="pickupdate" readonly="readonly" value="<?=date('m/d/Y');?>" />&nbsp;<img src="images/calendar.gif" alt="Calendar" title="Calendar" style="cursor:pointer;" onClick="displayDatePicker('pickupdate');" />
											<input type="hidden" name="todate" id="todate" value="<?=date('m/d/Y');?>" />
										</td>
									</tr>
									<tr>
										<td valign="top" height="125" style="padding-top:10px; padding-left:10px;" align="left">Schedule:</td>
										<td valign="top" style="padding-top:10px;">
											<input type="radio" name="schedule" id="schedule" value="1" checked="checked" /> For the time specified only.<br />
											<input type="radio" name="schedule" id="schedule" value="2" /> Daily at this time except weekends.<br />
											<input type="radio" name="schedule" id="schedule" value="3" /> Daily at this time including weekends.<br />
											<input type="radio" name="schedule" id="schedule" value="4" /> Weekly on this day of the week.<br />
											<input type="radio" name="schedule" id="schedule" value="5" /> Monthly on this day of the month.<br />
										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">How Would You Like Your Shirts:</td>
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
										<td height="42" colspan="2" align="left" style="padding-left:10px;">
											<input type="checkbox" id="is_urang_bag" name="is_urang_bag" value="1" /> Please tick this box if you need U-Rang bag.
									  </td>
									</tr>
									<tr>
										<td height="38" align="left" style="padding-left:10px;">Doorman:</td>
										<td>
											<select name="doorman" id="doorman">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</td>
									</tr>
									<tr>
										<td height="42" colspan="2" align="left" style="padding-left:10px;">
											We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">
											Special Instructions:
										</td>
										<td>
											<textarea id="txtSpecialInstruction" name="txtSpecialInstruction" cols="30" rows="3"><?=$special_ins;?></textarea>
										</td>
									</tr>
									<tr>
										<td valign="top" align="left" style="padding-left:10px;">
											Driving Instructions:
										</td>
										<td>
											<textarea id="txtDrivingInstruction" name="txtDrivingInstruction" cols="30" rows="3"><?=$driving_ins;?></textarea>
										</td>
									</tr>
									
									<tr>
										<td height="41" colspan="2" align="left" style="padding-left:10px;">How to pay [ Select any one radio button ] :</td>
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
								  </tbody>
							  </table></td>
							</tr>
						  </table>                       
                      </fieldset>
                      <div align="center">
                      <input type="hidden" name="act" value="add"/>
                      <input id="button1" type="submit" name="submit" value="Schedule Pickup" onclick="return pickup_valid();" /> 
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='<?=$this_page?>.php'"/>
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
