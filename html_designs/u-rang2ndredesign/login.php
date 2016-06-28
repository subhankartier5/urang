<? 
require('includes/config.php');
require('includes/functions.php');


if(isset($_POST['submit'])){
	
	$username = sanitize($_POST['username']);
	$password = sanitize($_POST['password']);
	$pass = encrypt($password, "abc123");
	
	//$chkvalid_user = getField(PREFIX."customers", "username", $username, "username", "And password='".$pass."'");
	$chkvalid_user = "select * from ".PREFIX."customers where username='".$username."' and password='".$pass."'";
	$result = mysql_query($chkvalid_user);
	
	if(mysql_num_rows($result) > 0)
	{
		$_SESSION['username'] = mysql_result($result,0,"username");
		$_SESSION['customername'] = mysql_result($result,0,"customer_name");
		echo "<script language=javascript>location.href=\"loggedin.php\";</script>";
		exit();
	}
	else
	{
		$msg = 'Username or Password is incorrect!';
	}
}

?>