<?php
// error reporting
error_reporting(1);

// session management
if(!session_id()){
	session_start();
}

//prefix
//define("PREFIX", "fproof_");
define("PREFIX", "urg_");


if ($_SERVER['SERVER_NAME']=="localhost")
{
	/* Local */
	$user = "root"; //Database Username here
	$pass = ""; //Database Password here
	$db = "urang"; //Database Name here
	$localhost="localhost"; //Database Server
}
else
{
	/*$localhost="74.50.13.226"; //Database Server
	$user = "webde0_adeel"; //Database Username here
	$pass = "adeel@wru"; //Database Password here
    $db = "webde0_urang"; //Database Name here*/
	
	$localhost="db2784.perfora.net"; //Database Server
	$user = "dbo355078943"; //Database Username here
	$pass = "jacob@1117"; //Database Password here
    $db = "db355078943"; //Database Name here
}


$link = mysql_connect($localhost, $user, $pass);
if ( ! $link )
	die( "Couldn't connect to MySQL" );
mysql_select_db( $db)
	or die ( "Couldn't open $db: ".mysql_error() );

//other necessary includes
require("functions.php");
?>