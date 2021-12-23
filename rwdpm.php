<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_query();
check_browser();

check_method();
//session_start();
include_once('header.php');
$action= $_GET["action"];
$pmid = $_GET["pmid"];
$sid = $_GET["sid"];
$who = $_GET["who"];
connectdb();
if(islogged($sid)==false)
{
    
      echo "You are not logged in\n";
      echo "Or Your session has been expired";
      exit();
}
if($action=="dpm")
{
	$pminfo = mysql_fetch_array(mysql_query("SELECT text, byuid, touid, timesent FROM gyd_private WHERE id='".$pmid."'"));
	if(getuid_sid($sid)==$pminfo[1]||getuid_sid($sid)==$pminfo[2])
	{
		echo "PM From: ".getnick_uid($pminfo[1])."\n";
		echo "To: ".getnick_uid($pminfo[2])."\n";
		echo "Date: ".date("l d/m/y H:i:s", $pminfo[3])."\n\n-------------------\n";
		echo "$pminfo[0]\n-------------------\n";
		echo "\wapbies.com (c)";
	}else{
		echo "This PM isn't yours";
	}
}
else if($action=="dlg")
{
	$uid = getuid_sid($sid);
	$pms = mysql_query("SELECT text, byuid, timesent FROM gyd_private WHERE (byuid='".$uid."' AND touid='".$who."') OR (byuid='".$who."' AND touid='".$uid."') ORDER BY timesent LIMIT 0, 50");
	while($pm = mysql_fetch_array($pms))
	{
		echo getnick_uid($pm[1])."(".date("d/m H:i", $pm[2])."): ".$pm[0]."\n--------\n";
	}
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
}

else{
	echo "wtf?";
}
exit();
?>