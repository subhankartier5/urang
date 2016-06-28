<?php
$page="admin_panel.php";
require("header.php");

if ($_POST[submit]=="Update"){
	$error='';
	$email_filter="/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
	$url_filter="/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/";	
	$site_title=santisize(stripslashes(trim($_POST['site_title'])));
	$site_url=santisize(stripslashes(trim($_POST['site_url'])));
	$site_email=santisize(stripslashes(trim($_POST['site_email'])));	
	$meta_keywords=santisize(stripslashes(trim($_POST['meta_keywords'])));
	$meta_description=santisize(stripslashes(trim($_POST['meta_description'])));
	$contractor_reg_fee=santisize(stripslashes(trim($_POST['contractor_reg_fee'])));
	$zip_expire_days=santisize(stripslashes(trim($_POST['zip_expire_days'])));
	$adminemail=santisize(stripslashes(trim($_POST['adminemail'])));
	
	if ($site_title=="")
		$error.="Please Enter Site Title.<br />";
		
	if ($site_url=="")
		$error.="Please Enter Site URL.<br />";
	
	//else if (!preg_match($url_filter,$site_url))
		//$error.="Invalid Site URL.<br />";
		
	if ($site_email=="")
		$error.="Please Enter Site Email.<br />";	
	
	else if (!preg_match($email_filter,$site_email))
		$error.="Invalid Site Email.<br />";
	
	if ($meta_keywords=="")
		$error.="Please Enter Meta Keywords.<br />";		
	
	if ($meta_description=="")
		$error.="Please Enter Meta Description.<br />";	
		
		
	if ($error!="")
		$msg='<div class="error"><b>Errors:</b><br /><br />'.$error.'</div>';		
	
	else{
		$sql=mysql_query("update ".PREFIX."config set
						  site_title='$site_title',
						  site_url='$site_url',
						  site_email='$site_email',
						  meta_keywords='$meta_keywords',
						  meta_description='$meta_description'
						  ") or die(mysql_error());
						  
		$msg='<div class="success">Site Configuration Updated!</div>';
	}
}

if ($error==NULL){
	$site_title=getname("site_title",PREFIX."config",1,1);
	$site_url=getname("site_url",PREFIX."config",1,1);
	$site_email=getname("site_email",PREFIX."config",1,1);
	$meta_keywords=getname("meta_keywords",PREFIX."config",1,1);
	$meta_description=getname("meta_description",PREFIX."config",1,1);
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
					<h3>Change Site Configuration</h3>
					 <form id="form1" name="form1" action="change_config.php" method="post" onsubmit="return siteConfig();">
                      <fieldset id="site_config">  
					  	<legend>Site Info</legend>                      
                        <table cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<label for="site_title" style="width:150px;">Site Title<span class="required">*</span> : </label> 
								</td>
								<td>
									<input name="site_title" id="site_title" type="text" maxlength="255" value="<?=$site_title?>" size="50"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="site_url" style="width:150px;">Site URL<span class="required">*</span> : </label>
								</td>
								<td>
									<input name="site_url" id="site_url" type="text"maxlength="255" value="<?=$site_url?>" size="50"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="site_email" style="width:150px;">Site Email<span class="required">*</span> : </label>
								</td>
								<td>
									<input name="site_email" id="site_email" type="text" value="<?=$site_email?>" maxlength="50" size="50"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="meta_keywords" style="width:150px;">Meta Keywords<span class="required">*</span> : </label>
								</td>
								<td>
									<textarea name="meta_keywords" id="meta_keywords" cols="40" rows="5"><?=$meta_keywords?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="meta_description" style="width:150px;">Meta Description<span class="required">*</span> : </label>
								</td>
								<td>
									<textarea name="meta_description" id="meta_description" cols="40" rows="5"><?=$meta_description?></textarea>
								</td>
							</tr>
						</table>
					</fieldset>
					
					  <div align="center">
                      <input id="button1" name="submit" type="submit" value="Update" /> 
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
