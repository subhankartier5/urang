<?php
require("includes/conf.php");
if (!isset($_SESSION["admin"])){
	header("location: index.php");
}
$site_title=getname("site_title",PREFIX."config",1,1);
$admin_template=getname("admin_template",PREFIX."config",1,1);

$qry = "select od.orderid from urg_customer_order_details as od inner join urg_customers as c on c.username = od.username";
$r = mysql_query($qry);
$dcount = 1;
if(mysql_num_rows($r) > 0){
$dcount = mysql_num_rows($r);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$site_title?></title>
<link rel="stylesheet" type="text/css" href="css/<?=$admin_template?>" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="javascripts/validator.js" type="text/javascript"></script>
<script src="javascripts/validation.js" type="text/javascript"></script>
<script src="javascripts/datePicker.js" type="text/javascript" language="javascript"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
<link rel="stylesheet" href="js/thickbox.css" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- -->
<script>
	!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" href="style.css" />
<script type="text/javascript">
	$(document).ready(function() {
		var i;
		for(i = 0; i <= <?=$dcount?>; i++)
		{
		$("#various"+i).fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
		}
	});
</script>
<!-- -->

</head>
<body>
<div id="blockUI" class="translucent"
        onclick="return false" onmousedown="return false" onmousemove="return false"
        onmouseup="return false" ondblclick="return false">
        &nbsp;</div>
	<div id="container">
		<div id="header">
			<h2><?=$site_title?> Admin Area</h2>
			<div id="topmenu">
				<ul>
					<li <? if ($page=="admin_panel.php") echo 'class="current"';?>><a href="admin_panel.php">Dashboard</a></li>
					<li <? if ($page=="index.php") echo 'class="current"';?>><a href="customer_details.php">CMS</a></li>
					<li><a href="http://www.u-rang.com" target="_blank">Main Site</a></li>
					<li><a href="http://www.u-rang.com/invoice" target="_blank">Bamboo Invoice</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</div>
		</div>

