<?php include_once('antif.php');?>
 <?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_query();
check_browser();

check_method();
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
  include('admob.php');
echo "</div>";
echo "<p align=\"center\">";
	  echo logo(); 
echo "<br /><b><i>
<tt>
<u>OUR TERMS</u><br /><br />
Wapbies.com is aimed at facilitating easy communication among youths, old and young world wide.

Our staff team are always ready to attend to if you encounter any difficulty in browsing through our menus.

You must have it at the back of your mind that wapbies.com has zero tolerance for spamming and if you were caught in such act it might lead to the banning of such user.

By Entering into wapbies.com, you have agreed to be loyal to our terms and conditions.... thank you for your anticipated co-opration! 

</tt>
";
echo "</i></b>";

echo "</p>";
echo "<div class=\"ads\">";
 echo admob_request($admob_params);
echo "</div>";
echo "<p align='center'><a href='index.php'>Home page</a><==</p></body>";
echo "</html>";
?>





