<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/class.upload.php");

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

	$sql=mysql_query("delete from ".PREFIX."customer_orders where orderid='$id'");
	$sql2=mysql_query("delete from ".PREFIX."customer_order_details where orderid='$id'");
	$msg='<div class="success">Order has been deleted.</div>';
}


	
if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("select od.orderid, od.username, od.wash_fold, od.coupon_no, od.clienttype, od.orderdate, od.totalamount, c.customer_name from ".PREFIX."customer_order_details as od inner join ".PREFIX."customers as c on c.username = od.username");
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
 $query = "select od.orderid, od.username, od.wash_fold, od.coupon_no, od.clienttype, od.orderdate, od.totalamount, c.customer_name from ".PREFIX."customer_order_details as od inner join ".PREFIX."customers as c on c.username = od.username order by orderid desc".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
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
					
                    <table width="100%">
						<thead>
							<tr>
								<th align="left" style="padding-left:10px;">Customer Name</th>
                            	<th align="center">Wash &amp; Fold</th>
                                 <th align="left" style="padding-left:10px;">Coupon #</th>
								 <th align="left" style="padding-left:10px;">Client Type</th>
								 <th align="center">Order Date</th>
								 <th align="left" style="padding-left:10px;">Total Amount</th>
                                <th align="center">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						$counter = 0;
						while ($rs=mysql_fetch_object($sql)){ $counter++;

						$od = $rs->orderdate;
						$od1 = explode(" ",$od);
						$od2 = explode("-",$od1[0]);
						$odate = $od2[1]."/".$od2[2]."/".$od2[0];
						$various = "various".$counter;
                        ?>
							<tr>
								<td align="left" style="padding-left:10px;"><?=$rs->customer_name?></td>
                            	<td align="center"><?=$rs->wash_fold?></td>
                                <td align="left" style="padding-left:10px;"><?=$rs->coupon_no?></td>
								<td align="left" style="padding-left:10px;"><?=$rs->clienttype?></td>
								<td align="center"><?=$odate?></td>
								<td align="left" style="padding-left:10px;">$<?=$rs->totalamount?></td>
                               	
                                <td align="center">
								<a href="#inline<?=$counter?>" id="<?=$various?>"><img src="images/icons/cog.png" title="View Details" width="16" height="16" /></a>
								<a href="javascript:if(confirm('Are you sure you want to delete?')){window.location='<?=$this_page?>.php?id=<?=$rs->orderid?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
                            </tr>

						<? 
						$sql_getitems = "select o.ordid, o.itemid, o.num_of_items, i.item, i.price from ".PREFIX."customer_orders as o inner join ".PREFIX."items as i on o.itemid = i.itemid where o.orderid =".$rs->orderid;
						$rResult = mysql_query($sql_getitems);

						if(mysql_num_rows($rResult) > 0) {
							$str .='<div style="display: none;">';
							$str .='<div id="inline'.$counter.'" style="overflow:auto; width: 300px">';
							while($rows=mysql_fetch_array($rResult)) {
							$str .='<span>Item Name: '.$rows["item"].'</span><br>';
							$str .='<span>No. Of Items: '.$rows["num_of_items"].'</span><br>';
							$str .='<span>Price: $'.$rows["price"].'</span><br><br>';
							}
							$str .='</div></div>';
							echo $str;
						}
						else{
							$str .='<div style="display: none;">';
							$str .='<div id="inline'.$counter.'" style="overflow:auto; width: 300px">';
							$str .='<span style="font-weight:bold;">No details available!</span><br>';
							$str .='</div></div>';
							echo $str;
						}
						
						} ?>
							
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
