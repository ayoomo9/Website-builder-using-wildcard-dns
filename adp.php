<?php
require_once("config_cgh.php");
require_once("core.php");

if(isset($_GET['url']))
{

$url = $_GET['url'];


if(isset($_GET['id']))
{


$uid = $_GET['id'];
}
else
{

$uid = 194;
}
}
else
{
$url = "http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw==";
}

      $usts = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
        $upl = $usts[0]+1;
        @mysql_query("UPDATE gyd_users SET plusses='".$upl."' WHERE id='".$uid."'");
		
		
header("location:$url");

?>