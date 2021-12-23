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
echo "<?xml version=\"1.0\"?>";
header("Content-type: text/html; charset=UTF-8");
echo "<head>";
    echo "<title>User Fun</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$bcon = connectdb();
if (!$bcon)
{
    echo "<head>";
    echo "<title>Error!!!</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "<img src=\"images/notok.gif\" alt=\"!\"/><br/>";
    echo "<b><strong>Error! Cannot Connect To Database...</strong></b><br/><br/>";
    echo "This error happens usually when backing up the database, please be patient...";
    echo "</p>";
    echo "</body>";
    echo "</html>";
    exit();
}
$brws = explode("/",$HTTP_USER_AGENT);
$ubr = $brws[0];
$uip = getip();
$action = $_GET["action"];
$sid = $_GET["sid"];
$page = $_GET["page"];
$who = $_GET["who"];
$uid = getuid_sid($sid);
$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));
$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];
cleardata();

if(($action != "") && ($action!="terms"))
{
    $uid = getuid_sid($sid);
    if((islogged($sid)==false)||($uid==0))
    {
      echo "<head>";
      echo "<title>Error!!!</title>";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
}
if(isbanned($uid))
    {
      echo "<head>";
      echo "<title>Error!!!</title>";
     echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "<b>You are Banned</b><br/><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'"));
	$banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "<b>Time Left: </b>$rmsg<br/>";
      $nick = getnick_uid($banto[2]);
	echo "<b>By: </b>$nick<br/>";
	echo "<b>Reason: </b>$banto[1]";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
	$res = mysql_query("UPDATE gyd_users SET browserm='".$ubr."', ipadd='".$uip."' WHERE id='".getuid_sid($sid)."'");
	$wnick = getnick_uid($who);
	$sex = mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$who."'"));
	if($sex[0]=="M")
	{
		$pron = "he";
		$pron2 = "him";
		$pron3 = "his";
	}else{
		$pron = "she";
		$pron2 = "her";
		$pron3 = "her";
	}
	addonline($uid,"having fun with another member :P","");
if($action=="profile")
{
	
    
      echo "<head>";
      echo "<title>$sitename</title>";
     echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
    echo "<p>";
    $nopl = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$who."'"));
  echo "Game Plusses: <b>$nopl[0]</b><br/><br/>";
  
  ///////////////////////////////////////////////////////
	echo "<img src=\"smilies/smooch.gif\" alt=\"smooch\"/><b>Smooch's:</b><br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='smooch'"));
  echo "Have smooched: <b><a href=\"lists.php?action=smc&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='smooch'"));
  echo "Have been Smooched: <b><a href=\"lists.php?action=smd&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  echo "Poor $wnick, a fat old lady have smooched $pron2 untill $pron almost choked! yes you can smooch $wnick but don't kill $pron2<br/>";
	echo "<a href=\"userfun.php?action=smooch&amp;who=$who&amp;sid=$sid\">Smooch!</a><br/><br/>";
  
  //////////////////////////////////////////////////////
  echo "<img src=\"smilies/kick.gif\" alt=\"kick\"/><b>Kicks:</b><br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='kick'"));
  echo "Have Kicked: <b><a href=\"lists.php?action=kck&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='kick'"));
  echo "Have been Kicked: <b><a href=\"lists.php?action=kcd&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  echo "And yes $wnick have been kicked on the shin untill it's smashed, I think it'll be funny to kick $wnick on the chin hehe<br/>";
	echo "<a href=\"userfun.php?action=kick&amp;who=$who&amp;sid=$sid\">Kick!</a><br/><br/>";
	
	///////////////////////////////////////////////////////
	echo "<img src=\"smilies/poke.gif\" alt=\"poke\"/><b>Pokes:</b><br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='poke'"));
  echo "Have Poked: <b><a href=\"lists.php?action=pok&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='poke'"));
  echo "Have been Poked: <b><a href=\"lists.php?action=pkd&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  echo "the last thing that $wnick needs now is another poke, $pron have a hole in $pron3 tummy because of the last poke, and no the other side of the hole is not in $pron3 back, some of us are obsessed with butts you know<br/>";
	echo "<a href=\"userfun.php?action=poke&amp;who=$who&amp;sid=$sid\">Poke!</a><br/><br/>";
	
	///////////////////////////////////////////////////////
	echo "<img src=\"smilies/cuddle.gif\" alt=\"hug\"/><b>Hugs:</b><br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='hug'"));
  echo "Have Hugged: <b><a href=\"lists.php?action=hgs&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  $nopl = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='hug'"));
  echo "Have been Hugged: <b><a href=\"lists.php?action=hgd&amp;who=$who&amp;sid=$sid\">$nopl[0]</a></b> Times<br/>";
  echo "Poor $wnick, remember that fat lady who choked $pron2? well.. she hugged $pron2 untill she broke $pron3 ribs, $pron surely needs a hug from you now<br/>";
	echo "<a href=\"userfun.php?action=hug&amp;who=$who&amp;sid=$sid\">Hug!</a>";
	
    echo "</p>";

    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=givegp&amp;who=$who&amp;sid=$sid\">Donate Game Plusses</a><br/>";
    echo "<a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick's profile</a><br/>";
     echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
	 echo " | ";
	 
 echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Update Profile</a>";
   echo " | ";
  echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a></div>";
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
	echo "</p>";
    echo "</body>";
}

else if ($action=="hug" || $action=="smooch" || $action=="kick" || $action=="poke")
{
      echo "<head>";
      echo "<title>$wnick's@wapbies</title>";
     echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
	$nopl = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'"));
	if($nopl[0]<0)
	{
		echo "<img src=\"images/notok.gif\" alt=\"X\"/>You should have at least 5 game plusses to perform an action on other members<br/><br/>";
	}else{
		$actime = mysql_fetch_array(mysql_query("SELECT actime FROM ibwf_usfun WHERE uid='".$uid."' AND target='".$who."' ORDER BY actime DESC LIMIT 1"));
		$timeout = $actime[0] + (10*24*60*60);
		if(time()<$timeout)
		{
			echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can only perform one action on the same user every 10 days<br/><br/>";
		}else{
			if($uid==$who)
			{
				echo "<img src=\"images/notok.gif\" alt=\"X\"/>Why on earth you wanna $action your self?<br/><br/>";
			}else{
				$res = mysql_query("INSERT INTO gyd_usfun SET uid='".$uid."', action='".$action."', target='".$who."', actime='".time()."'");
				if(!$res)
				{
					//echo mysql_error()."<br/>";
					echo "<img src=\"images/notok.gif\" alt=\"X\"/>DATABASE ERROR!<br/><br/>";
				}else{
					mysql_query("UPDATE gyd_users SET gplus=gplus-5 WHERE id='".$uid."'");
					echo "<img src=\"images/ok.gif\" alt=\"+\"/>You just have ".$action."ed $wnick, where did you do that, I'm not gonna tell <img src=\"smilies/spiteful.gif\" alt=\"haba\"/><br/><br/>";
					echo "5 game plusses were subtracted from you, and you can't perform any other action on $wnick for the next 10 days<br/><br/>";
				}
			}
		}
		
	}
	echo "<a href=\"index.php?action=givegp&amp;who=$who&amp;sid=$sid\">Donate Game Plusses</a><br/>";
	echo "<a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick's profile</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
	 echo " | ";
	 
 echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Update Profile</a>";
   echo " | ";
  echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a></div>";
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
 echo "</p>";
    echo "</body>";
	exit();
}
?>
</html>