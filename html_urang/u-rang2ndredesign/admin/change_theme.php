<?php
$page="admin_panel.php";
require("header.php");
if ($_POST[submit]=="Update"){
	$admin_template=santisize($_POST[admin_template]);	
	$sql=mysql_query("update ".PREFIX."config set admin_template='$admin_template'") or die(mysql_error());
	?>
	<script language="javascript">
	window.location='change_theme.php';
	</script>
	<?
	exit;
}
$admin_template=getname("admin_template",PREFIX."config",1,1);
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
                <div id="box">
					<h3>Change Admin Theme</h3>
					 <form id="form" name="form1" action="change_theme.php" method="post">
                      <fieldset id="theme">                        
                        <label for="theme">Theme : </label> 
                        <select name="admin_template" id="admin_template">
						<option value="theme.css" <? if ($admin_template=="theme.css") echo "selected";?>>Default</option>
						<option value="theme1.css" <? if ($admin_template=="theme1.css") echo "selected";?>>Blue</option>						
						<option value="theme2.css" <? if ($admin_template=="theme2.css") echo "selected";?>>Green</option>
						<option value="theme3.css" <? if ($admin_template=="theme3.css") echo "selected";?>>Brown</option>
						<option value="theme4.css" <? if ($admin_template=="theme4.css") echo "selected";?>>Mix</option>																		
						</select>
                        <br />
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
