<?php
require("includes/conf.php");
if ($_SESSION["admin"]==1){
	?>
		<script language="javascript">
		window.location='admin_panel.php';
		</script>
		<?
		exit;
}
$site_title=getname("site_title",PREFIX."config",1,1); // site title

if ($_POST["submit"]=="Login"){ 
	//$verify_login="admin";
	//verifyLogin($_POST["login_name"],$_POST["password"]);
	$login = santisize($_POST["login_name"]);
	$password = santisize($_POST["password"]);
	$qry = "select * from ".PREFIX."admin where login='".$login."' AND `password`='".$password."'";
	$sql=mysql_query($qry);
	mysql_num_rows($sql);
	if (mysql_num_rows($sql)==0)
		$msg='<div class="error">Login Failed.</div>';
	else{
		$_SESSION["admin"]=1;
		?>
		<script language="javascript">
		window.location='admin_panel.php';
		</script>
		<?
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$site_title?> Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script src="javascripts/validator.js" type="text/javascript"></script>




</head>
<body  id="mainLogin" class=" ">
<form name="form1" action="index.php" method="post" onSubmit="return loginCheck();">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td>
			<div class="screenBody" id="login">		
				<div class="formArea">
					<table cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td id="loginTitle">Log in to <?=$site_title?><br />Admin Control Panel  1.0</td>
						</tr>
						<tr>
							<td id="loginForm">
								<?=$msg?>
								<p>Enter the login name into "Login" and password into the "Password" fields respectively. Then click "Login".</p>
									<table class="formFields" cellspacing="0" width="100%">
										<tr>
											<td class="name"><label for="login_name"> Login</label></td>
											<td><input type="text" name="login_name" id="login_name" value="" size="25" maxlength="50" tabindex="1" />
											</td>
										</tr>
									</table>
									<table class="formFields" cellspacing="0" width="100%">
										<tr>
											<td class="name"><label for="password"> Password</label></td>
											<td><input maxlength="50" tabindex="2" name="password" id="password" type="password" value="" size="25" /></td>
										</tr>
										<tr>
											<td class="name"><label for="language">Interface language</label></td>
											<td>
												<select  name="language" id="language">	
													<option value='en-US'>ENGLISH (United States)</option>
												</select>
											</td>
										</tr>
									</table>	

									<div class="formButtons">
										<table width="100%" cellspacing="0">
											<tr>
												<td class="main" id="get_password">
													<a href="forgot_password.php">Forgot your password?</a>
												</td>
												<td class="misc"><input type="submit" value="Login" name="submit" id="submit" style="width:91px;" /></td>
											</tr>
										</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>
</form>
</body>
</html>