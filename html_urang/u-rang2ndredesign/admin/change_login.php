<?php
$page="admin_panel.php";
require("header.php");
if ($_POST["submit1"]=="Update"){
	$error='';
	$email_filter="/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
	$login=santisize(stripslashes(trim($_POST[login_name])));	
	$email=santisize(stripslashes(trim($_POST[email])));
	$current_password=santisize(stripslashes(trim($_POST[current_password])));
	
	if ($login=="")
		$error.="Please Enter Login Name.<br />";
		
	if ($email=="")
		$error.="Please Enter Email Address.<br />";	
	
	if (!preg_match($email_filter,$email))
		$error.="Invalid Email Address.<br />";
	
	if ($current_password=="")
		$error.="Please Enter Current Password.<br />";
	
	else if (get_decrypted_value("password",PREFIX."admin",1,1)!=$current_password)
		$error.="Invalid Current Password.<br />";
	
	if ($error!="")
		$msg='<div class="error"><b>Errors:</b><br /><br />'.$error.'</div>';		
	
	else{		
		$sql=mysql_query("update ".PREFIX."admin set
						  login='$login',
						  email='$email'
						  ") or die(mysql_error());
		$msg='<div class="success">Login/Email Updated!</div>';
	}
}

if ($_POST["submit2"]=="Update"){
	$error='';
	$old_password=santisize(stripslashes(trim($_POST["old_password"])));
	$password1=santisize(stripslashes(trim($_POST["password1"])));
	$password2=santisize(stripslashes(trim($_POST["password2"])));	
	
	if ($old_password=="")
		$error.="Please Enter Old Password.<br />";
	
	else if (get_decrypted_value("password",PREFIX."admin",1,1)!=$old_password)
		$error.="Invalid Old Password.<br />";
		
	if ($password1=="")
		$error.="Please Enter Password.<br />";	

	//else if (strlen($password1)<8)
		//$error.="Password must be at least 8 characters long.<br />";		
		
	else if ($password1!=$password2)
		$error.="Password and confirm password doesn't match.<br />";	
	
	if ($error!="")
		$msg='<div class="error"><b>Errors:</b><br /><br />'.$error.'</div>';		
	
	else{		
		$sql=mysql_query("update ".PREFIX."admin set password='$password1'") or die(mysql_error());
		$msg='<div class="success">Password Updated!</div>';
	}
}

if ($error==NULL){
	$login=getname("login",PREFIX."admin",1,1);
	$email=getname("email",PREFIX."admin",1,1);
}
?>
		<div id="top-panel">
			<div id="panel">
				<ul>
					<li><a href="change_config.php" class="config">Site Configuration</a></li>
					<li><a href="change_login.php" class="login">Login Info</a></li>
					<li><a href="change_theme.php" class="template">Admin Theme</a></li>					
                </ul>
            </div>
		</div>
        <div id="wrapper">
			<div id="content">
				<?=$msg?>
                <div id="box">
					<h3>Change Login Info</h3>
					 <form id="form" name="form1" action="change_login.php" method="post" onsubmit="return changeLoginEmail();">
                      <fieldset id="change_login_email"> 
					  <legend>Change Login/Email</legend>
					  	<label for="login_name" style="width:150px;">Login<span class="required">*</span> : </label> 
                        <input name="login_name" id="login_name" type="text" maxlength="50" value="<?=$login?>"/>
                        <br />
                        <label for="email" style="width:150px;">Email<span class="required">*</span> : </label>
                        <input name="email" id="email" type="text" maxlength="50" value="<?=$email?>"/>
                        <br />
						<label for="current_password" style="width:150px;">Current Password<span class="required">*</span> : </label>
						<input name="current_password" id="current_password" type="password" maxlength="50" value=""/>
						<br />
                      </fieldset>
					  <div align="center">
                      <input id="button1" name="submit1" type="submit" value="Update" /> 
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='admin_panel.php'"/>
                      </div>
					  </form>
					  <form id="form" name="form2" action="change_login.php" method="post" onsubmit="return changePassword();">
					  <fieldset id="change_password">
					  <legend>Change Password</legend>
						<label for="old_password" style="width:150px;">Old Password<span class="required">*</span> : </label>
                        <input name="old_password" id="old_password" type="password" maxlength="50" value=""/>
						<br />
                        <label for="password1" style="width:150px;">New Password<span class="required">*</span> : </label>
                        <input name="password1" id="password1" type="password" maxlength="50" value=""/>
						<br />
                        <label for="password2" style="width:150px;">New Password (Confirm)<span class="required">*</span> : </label>
                        <input name="password2" id="password2" type="password" maxlength="50" value=""/>
						<br />			
						</fieldset>
					  <div align="center">
                      <input id="button1" name="submit2" type="submit" value="Update" /> 
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='admin_panel.php'"/>
                      </div>
                    </form>
				</div>
            </div>            
   	  	<?php
	  	require("footer.php");
	  	?>
	</div>
</body>
</html>
