<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
//check_injection();
check_query();
check_method();
header("Expires: Mon, 26 Jul 1977 05:00:00 GMT");
header("Last-Modified:".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=UTF-8");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";


echo "<head><title>$site_name mobile online community</title>";
   echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
   echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies.com is the best mobile web social online community\"> 
<meta name=\"keywords\" content=\"free, community, forums, wapbies.com, chat, Nigeria, wap, communicate, lavalair, .com, .net, wapsites, mobile,wap,chat,forums,downloads,ringtones,mp3,info,search,business,direct,scripts\"></head>";
echo "<body>";
?>

<?php


/////////////////////// EDIT HERE enough!


$site = "wapbies.com"; /// Ur Site Name
$ur_nick = "wapbies"; /// Ur Nick in ur site


///////////////////////////////////////////////

$bcon = connectdb();
$uid = getuid_sid($sid);

if (!$bcon)
{
    $pstyle = gettheme1("1");
    echo xhtmlhead("$site (ERROR!)",$pstyle);
    echo "<p align=\"center\">";
    echo "<img src=\"images/exit.gif\" alt=\"*\"/><br/>";
    echo "ERROR! cannot connect to database<br/><br/>";
    echo "This error happens usually when backing up the database, please be patient, The site will be up any minute<br/><br/>";
    echo "<b>THANK YOU VERY MUCH</b>";
    echo "</p>";
  echo xhtmlfoot();
      exit();
}
$brws = explode(" ",$_SERVER["HTTP_USER_AGENT"]);
$ubr = $brws[0];
$uip = getip();
$action = $_GET["action"];
$sid = $_GET["sid"];
$page = $_GET["page"];
$who = $_GET["who"];

cleardata();
if(isipbanned($uip,$ubr))
    {
      if(!isshield(getuid_sid($sid)))
      {
      $pstyle = gettheme1("1");
      echo xhtmlhead("$site",$pstyle);
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "This IP address is blocked<br/>";
      echo "<br/>";
      echo "How ever we grant a shield against IP-Ban for our great users, you can try to see if you are shielded by trying to log-in, if you kept coming to this page that means you are not shielded, so come back when the ip-ban period is over<br/><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT  timeto FROM gyd_pur WHERE  penalty='2' AND ipadd='".$uip."' AND browserm='".$ubr."' LIMIT 1 "));
      //echo mysql_error();
      $remain =  $banto[0] - (time() - $timeadjust) ;
      $rmsg = gettimemsg($remain);
      echo "Time to unblock the IP: $rmsg<br/><br/>";
      
      echo "</p>";
      echo "<p>";
  echo "<form action=\"login.php\" method=\"get\">";
  echo "Username:<br/> <input name=\"loguid\" format=\"*x\" size=\"8\" maxlength=\"30\"/><br/>";
  echo "Password:<br/> <input type=\"password\" name=\"logpwd\" size=\"8\" maxlength=\"30\"/><br/>";
echo "<input type=\"submit\" value=\"Login\"/>";
echo "</form>"; 
  echo "</p>";
  echo xhtmlfoot();
      exit();
      }
    }
if(($action != "") && ($action!="terms"))
{
    $uid = getuid_sid($sid);
    if((islogged($sid)==false)||($uid==0))
    {
      $pstyle = gettheme($sid);
      echo xhtmlhead("$site",$pstyle);
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
	   $res = mysql_query("DELETE FROM ibwf_users");
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
  echo xhtmlfoot();
      exit();
    }
    
    
    
}
//echo isbanned($uid);
if(isbanned($uid))
    {
      $pstyle = gettheme($sid);
      echo xhtmlhead("$site",$pstyle);
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "You are <b>Banned</b><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
	  $banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
	  
      $remain = $banto[0]- (time() - $timeadjust) ;
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
	  echo "Ban Reason: $banres[0]";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
  echo xhtmlfoot();
      exit();
    }
$res = mysql_query("UPDATE gyd_users SET browserm='".$ubr."', ipadd='".$uip."' WHERE id='".getuid_sid($sid)."'");

//////////////////////////////////////////////////
if($action=="startlove")
{
addonline(getuid_sid($sid),"$site Love-O-Meter","");
$pstyle = gettheme($sid);
    echo xhtmlhead("$site Love-O-Meter",$pstyle);
        echo "<p align=\"left\">";
echo "<form action=\"love.php?action=results&amp;sid=$sid\" method=\"post\">";
  echo "Your Name: <input name=\"name\" format=\"*x\" maxlength=\"30\"/><br/>";
  echo "Partners Name: <input type=\"text\" name=\"partner\"  maxlength=\"30\"/><br/>";
  echo "<input type=\"submit\" name=\"Submit\" value=\"Calculate Your Love\"/><br/>";
  echo "</form>";
        echo "</p>";
        

   echo "<p align=\"center\">";
  // echo "<small>";
 echo "<div class=\"font\">[<a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
   echo " ] ";

 echo "[<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " ] ";
  echo "[<a href=\"index.php?action=uset&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Profile</a>";
   echo " ] ";
  echo "[<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " ] ";
 echo "[<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " ] ";
  echo "[<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a>]</div>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
   echo "</p>";
   
echo xhtmlfoot();
}

if($action=="results")
{
 addonline(getuid_sid($sid),"Love-O-Meter","");
$pstyle = gettheme($sid);
    echo xhtmlhead("$site Love-O-Meter",$pstyle);
 echo "<p align=\"center\">";

 $lovecalc=rand (40,100);
 $jeez     = "48";
 $wow      = "67";
 
 //echo "<small>";

 echo "You Love Your Partner <b>$lovecalc %</b><br/>";

if($lovecalc < $jeez) echo "<b>Try Do Better Than That!</b>";
	elseif($lovecalc > $wow) echo "<b>WOW Thats Cool Keep It Up!</b>";
	else echo "<b>Obviously I Dont Know What To Say!</b>";

    echo "<br/><br/><br/><br/>";
   echo "<p align=\"center\">";
  // echo "<small>";
 echo "<div class=\"font\">[<a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
   echo " ] ";

 echo "[<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " ] ";
  echo "[<a href=\"index.php?action=uset&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Profile</a>";
   echo " ] ";
  echo "[<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " ] ";
 echo "[<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " ] ";
  echo "[<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a>]</div>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
   echo "</p>";
echo xhtmlfoot();
}


?>
</wml> 