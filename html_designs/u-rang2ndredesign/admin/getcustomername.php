<?php
require("includes/conf.php");

if(isset($_GET["q"]))
{
	$q=$_GET["q"];
}

$sql="select * from ".PREFIX."customers where customerid='".$q."'";
$result = mysql_query($sql);

if(mysql_num_rows($result) > 0)
{
	$uname = mysql_result($result,0,"username");
	$usernames='<input name="uname" id="uname" type="text" value="'.$uname.'" readonly style="width:240px;" />';
	echo $usernames;
}
else
{
	$usernames='<input name="uname" id="uname" type="text" readonly style="width:240px;" />';
	echo $usernames;
}
?> 