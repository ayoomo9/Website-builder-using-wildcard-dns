

 <?php
 ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_method();
check_injection();
include_once('header.php');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="expires" content="0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wapbies Team</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>

<?php
echo "<body>";
echo "<div class=\"ads\">";
  echo admob();
echo "</div>";
echo "<p align=\"center\">";
	  echo logo(); 
echo "<tt><br /><b><i>
Thanks to my friends and well wishers who gave me the encouragement to carry on till this moment......
I wish you all the very best in life!


</tt>";

echo "</i></b>";

echo "</p>";
echo "<div class=\"ads\">";
  echo admob();
echo "</div>";
echo "<p align='center'><a href='index.php'>Home page</a><==</p>";
echo "</body>";
echo "</html>";
?>



