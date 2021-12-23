<?php include_once('antif.php');?>


 <?php
 ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
//include_once("xhtmlfunctions.php");
check_browser();

check_method();
check_query();
check_injection();
include_once('header.php');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="expires" content="0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>About us</title>
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

<u>ABOUT US</u><br /><br />
Wapbies was designed by a highly technical and intelligent intelectual in person of Ayo.<br />
HE programmed this site because of his love for easy communication among the youth and for his desire to the world indeed a global village.
<br />AT wapbies there are uncountable of interesting things you can do like......CHAT, share ideas in FORUM, PLAY GAMES, SEARCH anything using our google seach tool, SEND MMS to fellow users e.t.c!
<br />On behalf of the entire staff of WAPBIES.COM we wish to welcome you all to the fastest growing and best mobile community in the globe.

</tt>";
echo "</i></b>";

echo "</p>";
echo "<div class=\"ads\">";
  echo admob();
echo "</div>";
echo "<p align='center'><a href='index.php'>Home page</a><==</p></body>";
echo "</html>";
?>






