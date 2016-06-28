<?php
$page="admin_panel.php";
require("header.php");
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
			Welcome to Admin Panel.	
            </div>            
   	  	<?php
	  	require("footer.php");
	  	?>
	</div>
</body>
</html>
