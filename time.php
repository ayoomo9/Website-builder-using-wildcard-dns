<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_browser();

check_method();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head><title>$site_name mobile online community</title>";
   echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies.com is the best mobile web social online community\"> 
<meta name=\"keywords\" content=\"free, community, forums, wapbies.com, chat, Nigeria, wap, communicate, lavalair, .com, .net, wapsites, mobile,wap,chat,forums,downloads,ringtones,mp3,info,search,business,direct,scripts\"></head>";
echo "<body>";
 
$New_Time = time() + (0 * 60 * 60);
$time=date("H:i",$New_Time); 
?>
<p align="center">
<b>Countries Time Zone</b><br/>
<small>
<?
$gerNew_Time = time() + (0 * 60 * 60);
$gertime=date("H:i",$gerNew_Time);
echo "<br/>Berlin, Paris, Rome, Johhanesburg: $gertime";
$helNew_Time = time() + (1 * 60 * 60);
$heltime=date("H:i",$helNew_Time);
echo "<br/>Helsinki, Ankara, Capetown: $heltime";
$mosNew_Time = time() + (2 * 60 * 60);
$mostime=date("H:i",$mosNew_Time);
echo "<br/>Moscow, St. Petersburg, Baghdad: $mostime";
$banNew_Time = time() + (6 * 60 * 60);
$bantime=date("H:i",$banNew_Time);
echo "<br/>Bangkok, Jakarta: $bantime";
$bjinNew_Time = time() + (7 * 60 * 60);
$bjintime=date("H:i",$bjinNew_Time);
echo "<br/>Beijing: $bjintime";
$tokNew_Time = time() + (8 * 60 * 60);
$toktime=date("H:i",$tokNew_Time);
echo "<br/>Tokyo, Seoul: $toktime";
$sydNew_Time = time() + (9 * 60 * 60);
$sydtime=date("H:i",$sydNew_Time);
echo "<br/>Sydney: $sydtime";
$welNew_Time = time() + (11 * 60 * 60);
$weltime=date("H:i",$welNew_Time);
echo "<br/>Wellington, Auckland: $weltime";
$alsNew_Time = time() + (14 * 60 * 60);
$alstime=date("H:i",$alsNew_Time);
echo "<br/>Alaska: $alstime";
$seaNew_Time = time() + (15 * 60 * 60);
$seatime=date("H:i",$seaNew_Time);
echo "<br/>Seattle, San Fransisco, LA: $seatime";
$slcNew_Time = time() + (16 * 60 * 60);
$slctime=date("H:i",$slcNew_Time);
echo "<br/>SaltLake City, Phoenix, LA: $slctime";
$chicNew_Time = time() + (17 * 60 * 60);
$chictime=date("H:i",$chicNew_Time);
echo "<br/>Chicago, Dallas, Mexico LA: $chictime";
$nycNew_Time = time() + (18 * 60 * 60);
$nyctime=date("H:i",$nycNew_Time);
echo "<br/>New York, Miami, Quebec: $nyctime";
$bNew_Time = time() + (20 * 60 * 60);
$btime=date("H:i",$bNew_Time);
echo "<br/>Beunos Aires, Brasilia: $btime";
$hereNew_Time = time() + (23 * 60 * 60);
$heretime=date("H:i",$hereNew_Time);
echo "<br/>London, Dublin, Lisbon: $heretime";

echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";


?>
</small>
</p>
</body> 
</html>





