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

echo "<p align=\"center\">";
	  echo logo(); 
echo "<tt><br /><b><i><u>TEAM MEMBERS</u>:<br /> 
Here we introduce our team of staff;<br /><br />
</p><p align=\"left\">";
echo "<tt>";
echo "
<table border='1'>
<tr>
<th>Wapbies Owner/Founder</th>
</tr>
<tr>
<td>&#187; wapbies owner/founder........Ayoomo9<br />

&#187; Wapbies owner/founder........Xola<br />
</td>
</tr>
</table>";
echo "
<table border='1'>
<tr>
<th>Wapbies Moderator(s)</th>
</tr>
<tr>
<td><li> Oginnite<br />
<li> Awhy14<br />
<li> Folepon<br />   
<li> Baabs<br />
<li> Isabella<br /></td>
</tr>
</table>
<p align='center'><a href='index.php'>Home page</a><==</p>
";
echo "</p><br /></b>";

echo "</body>";
echo "</html>";
?>




