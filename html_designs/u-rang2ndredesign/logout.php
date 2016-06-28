<? 
require('includes/config.php');
require('includes/header.php'); 
require('includes/functions.php');

if(isset($_GET['logout'])) { session_destroy(); }
echo "<script language=javascript>location.href=\"login.php\";</script>";
exit();
?>
