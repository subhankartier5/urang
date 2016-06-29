<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/class.upload.php");

$stitle = "Price List";
$ptitle = "Price List";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	 $this_page.=$current_url[$a];
}

// Add New Items
if ($_POST["submit"]=="Add"){

$itemname = santisize($_POST["itemname"]);
$price = santisize($_POST["price"]);
$catid = santisize($_POST["category"]);

$qry_add = "INSERT INTO ".PREFIX."items (item, price, categoryid) VALUES ('{$itemname}', '{$price}', {$catid})";
mysql_query($qry_add);
$msg='<div class="success">New item has been added.</div>';
}
// update items
else if ($_POST["submit"]=="Update"){
$id = santisize($_POST["id"]);
$itemname = santisize($_POST["itemname"]);
$price = santisize($_POST["price"]);

$qry_upd = "UPDATE ".PREFIX."items SET item='".$itemname."', price='".$price."' where itemid=".$id;
mysql_query($qry_upd);
$msg='<div class="success">Item <strong>'.$itemname.'</strong> Updated.</div>';

}

else if ($_GET["act"]=="delete"){
	$id=santisize($_GET["id"]);

	$sql=mysql_query("delete from ".PREFIX."items where itemid='$id'");	
	$msg='<div class="success">Item has been deleted.</div>';
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



if ($_SESSION[$this_page.'_sort']==NULL){

	$_SESSION[$this_page.'_order']="asc";
    $_SESSION[$this_page.'_sort']="itemid";
}
else if ($_GET[sort]!=NULL){
	if ($_GET[sort]==$_SESSION[$this_page.'_sort']){
		if ($_SESSION[$this_page.'_order']=="asc")
			$_SESSION[$this_page.'_order']="desc";
		else
			$_SESSION[$this_page.'_order']="asc";	
	}
	else{
		$_SESSION[$this_page.'_sort']=santisize($_GET[sort]);
		$_SESSION[$this_page.'_order']="asc";
	}
}
	
if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("select * from ".PREFIX."category as c inner join ".PREFIX."items as i on c.categoryid = i.categoryid");
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
  	$query = "select * from ".PREFIX."category as c inner join ".PREFIX."items as i on c.categoryid = i.categoryid order by itemid ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
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
                    			<a href="pricelist.php?act=add" class="footer_links">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Add New Item</strong></a>
                  			</td>
						</tr>
					</table>
                    <table width="100%">
						<thead>
							<tr>
								<th align="left" style="padding-left:10px;">Category Name</th>
                            	<th align="left" style="padding-left:10px;">Item Name</th>
                                 <th align="left" style="padding-left:10px;">Price</th>
                                <th align="center">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ $count++;
                        ?>
							<tr>
								<td align="left" style="padding-left:10px;"><?=$rs->categoryname?></td>
                            	<td align="left" style="padding-left:10px;"><?=$rs->item?></td>
                                <td align="left" style="padding-left:10px;">$<?=$rs->price?></td>
                               	
                                <td align="center">
								<a href="<?=$this_page?>.php?id=<?=$rs->itemid?>&act=edit"><img src="images/icons/brick_edit.png" title="Edit" width="16" height="16" /></a><a href="javascript:if(confirm('Are you sure you want to delete?')){window.location='<?=$this_page?>.php?id=<?=$rs->itemid?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
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
                    $sql_upd = "select * from ".PREFIX."items where itemid=".$id;
					$items_result = mysql_query($sql_upd);
					if(mysql_num_rows($items_result) > 0) {
						$itemname = mysql_result($items_result, 0, 'item');
						$price = mysql_result($items_result, 0, 'price');
					}
                    ?>
					<h3 id="update_designer">Update <?=$itemname;?></h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data">
					<input name="id" type="hidden" value="<?=$id?>"/>
                      <fieldset>
					  	<table>
							<tr>
								<td align="left" style="padding-left:15px;">
									Item Name:
								</td>
								<td>							    
							    	<input name="itemname" id="itemname" type="text" value="<?=$itemname;?>" style="width:220px;" />
                                </td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Price:
								</td>
								<td>
									<input type="text" id="price" name="price" value="<?=$price;?>" style="width:220px;" />
                                </td>
							</tr>
						</table>
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" name="submit" value="Update" />
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='<?=$this_page?>.php';"/>
                      </div>
                    </form>
					<script language="javascript">
					document.form1.submit.focus();
					</script>				
					<? } else { ?>
                	<h3>Add New Item</h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" enctype="multipart/form-data" onsubmit="return <?=$stitle?>();">
                      <fieldset>
					  	<table>
							<tr>
								<td align="left" style="padding-left:15px;">
									Category:
								</td>
								<td>
									<? 
										$get_cat = "SELECT * FROM ".PREFIX."category";
										$get_result = mysql_query($get_cat);
									?>
									<select name="category" id="category">
										<option value="">-Select Category-</option>
										<?
											while($row=mysql_fetch_array($get_result))
											{
												echo "<option value=".$row['categoryid'].">".$row['categoryname']."</option>";
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Item Name:
								</td>
								<td>
									<input type="text" id="itemname" name="itemname" style="width:220px;" />
								</td>
							</tr>
							<tr>
								<td align="left" style="padding-left:15px;">
									Price:
								</td>
								<td>
									<input type="text" id="price" name="price" style="width:220px;" />
								</td>
							</tr>
						</table>
                        <br />
                      </fieldset>
                      <div align="center">
                      <input type="hidden" name="act" value="add"/>
                      <input id="button1" type="submit" name="submit" value="Add" /> 
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
