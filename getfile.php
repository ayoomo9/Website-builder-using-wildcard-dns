
<?
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_browser();

check_method();
check_query();
connectdb();
$fileid = $_GET["fileid"];
$sid = $_GET["sid"];
	$file = mysql_fetch_array(mysql_query("SELECT filename, touid FROM gyd_mms WHERE id=$fileid"));
	$uid = mysql_fetch_array(mysql_query("SELECT uid FROM gyd_ses WHERE id='".$sid."'"));
		$uid = $uid[0];

	if ($file[1] == $uid){
	header("Location: mms/"."$file[0]");
	}
	else{
		header("Content-type: text/html");
		echo "<html><p>This file is not yours!<br/><a href=\"index.php?action=main&amp;sid=$sid\">Main Menu</a></p></html>";
	}
?>
