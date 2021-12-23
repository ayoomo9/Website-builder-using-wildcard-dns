<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");

require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");

include_once('header.php');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="expires" content="0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MAINTAINANCE MODE</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>

<?php
echo "<body>";
echo "<div class=\"ads\">";
include("admob.php");
echo "</div>";
echo "<p align=\"center\">";
	  echo logo(); 
echo "<tt><br /><b><i>Hello, Wapbies.com is currently undergoing maintainance by our team in other to serve you better.<br />
We shall be back shortly. Thanks for enduring the inconviniency this might have caused! (Admin)";
echo "</i></b></tt>";

echo "</p>";
echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
echo "</body>";
echo "</html>";
?>