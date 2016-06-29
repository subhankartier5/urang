<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/class.upload.php");

/*
query for get the customer's orders informations

select o.itemid, o.num_of_items, od.orderid, od.username, od.wash_fold, od.coupon_no, od.clienttype, od.orderdate, od.totalamount, c.customer_name   from urg_customer_order_details as od inner join urg_customer_orders as o on od.orderid = o.orderid inner join urg_customers as c on c.username = od.username

another query for show orders
select o.ordid, o.itemid, o.num_of_items, o.orderid, o.username, c.customer_name, i.item, i.price  from urg_customer_orders as o inner join urg_items as i on o.itemid = i.itemid inner join urg_customers as c on c.username = o.username

select od.orderid, od.username, od.wash_fold, od.coupon_no, od.clienttype, od.orderdate, od.totalamount, c.customer_name from urg_customer_order_details as od inner join urg_customers as c on c.username = od.username

*/

$stitle = "Customer Orders";
$ptitle = "Customer Orders";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	 $this_page.=$current_url[$a];
}

// Add New Items
if ($_GET["act"]=="delete"){
	$id=santisize($_GET["id"]);

	$sql=mysql_query("delete from ".PREFIX."items where itemid='$id'");	
	$msg='<div class="success">Item has been deleted.</div>';
}


	
if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("select o.ordid, o.itemid, o.num_of_items, o.orderid, o.username, c.customer_name, i.item, i.price  from ".PREFIX."customer_orders as o inner join ".PREFIX."items as i on o.itemid = i.itemid inner join ".PREFIX."customers as c on c.username = o.username");
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
  	$query = "select o.ordid, o.itemid, o.num_of_items, o.orderid, o.username, c.customer_name, i.item, i.price  from ".PREFIX."customer_orders as o inner join ".PREFIX."items as i on o.itemid = i.itemid inner join ".PREFIX."customers as c on c.username = o.username order by ordid ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
}
// Pagination class //
$sql=mysql_query($query);


$style_add="display: none;";
$style_list="display: block";

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
								<th align="left" style="padding-left:10px;">Customer Name</th>
                            	<th align="left" style="padding-left:10px;">Item Name</th>
                                 <th align="left" style="padding-left:10px;">Price</th>
								 <th align="center">No. Of Items</th>
                                <th align="center">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ $count++;
                        ?>
							<tr>
								<td align="left" style="padding-left:10px;"><?=$rs->customer_name?></td>
                            	<td align="left" style="padding-left:10px;"><?=$rs->item?></td>
                                <td align="left" style="padding-left:10px;">$<?=$rs->price?></td>
								<td align="center"><?=$rs->num_of_items?></td>
                               	
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
                
            </div>
            
   	  	<?php
	  	require("footer.php");
	  	?>
	</div>
</body>
</html>
