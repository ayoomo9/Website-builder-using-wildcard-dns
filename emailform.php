<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
########################################################################################################################
#////////* THIS IS AN EMAIL SENDER SCRIPT WRITTEN BY AYOOMO9 AND DOWNLOADED FROM wapbies.com*//////////////////////////#
#///This script allow users to send an email for free on your site/////////////////////////////////////////////////////#
#////////////////You must not edit or remove this note/////////////////////////////////////////////////////////////////#
#//////The licence of this script remain valid except if you remove my copyright//////////////////////////////////#
#//////////I have all the the right to contact your hosting company and have it removed from your folder///////////////#
#///////////////////If you got any problem about making it work, just send me an email ayoomo9@yahoo.com///////////////#
#////////////////////////////Get more free scripts at wapbies.com//////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
########################################################################################################################

include_once('header.php');
echo "<?xml version=\"1.0\"?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("config_cgh.php");
include("core.php");
include("lang.php");
check_query();
check_browser();

check_method();
$bcon = connectdb();

if (!$bcon)
{
    echo "<head>";
    echo "<title>Error!!!</title>";
 echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "<head>";
    echo "<body>";
    echo "<p align=\"center\">";
	include("admob.php");
    echo "<br /><img src=\"images/notok.gif\" alt=\"!\"/><br/>";
    echo "<b><strong>Error! Cannot Connect To Database...</strong></b><br/><br/>";
    echo "This error happens usually when backing up the database, please be patient...";
 echo admob_request($admob_params);  
   echo "<br /></p>";
    echo "</body>";
    echo "</html>";
    exit();
}

if(isset($_GET['action']))
      {
$action = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["action"]))));
}
if(isset($_GET['sid']))
      {
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
}
if(isset($_GET['page']))
      {
$page = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["page"]))));
}
if(isset($_GET['who']))
      {
$who = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["who"]))));
	  if(!is_numeric($who))
	  {
header('location:index.php');
exit;
	  }
	  }



$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];
$uid = getuid_sid($sid);
$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));

if((islogged($sid)==false)||($uid==0))
    {
  //echo "<meta http-equiv=\"refresh\" content=\"120; URL=http://easymobad.com\" />";
      echo "<head>";
      echo "<title>Error!!! Not Login!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<strong>You are not logged in<br/>";
      echo "Or Your session has been expired</strong><br/><br />";


  echo "<h3>";
   echo "".date("l jS F Y")."\n";
//echo "<a href=\"#\">".date("g:i a")."</a>";
   echo "</h3>";
 echo "<center>";
 echo logo();
   


echo "<br /><div class=\"ads\">";

 echo "<br /><i><tt>WAPBIES....giving you connection pathway to the world! join now and feel the groove...!</i><br /><br />";
 
 echo "</div><br />";
 
echo "<a href=\"index.php?action=gforumindx\">See What's Happening Inside</a><br /><br />";
echo "<a href=\"index.php?action=online&amp;sid=$sid\">Who's online now? </a><br /><br />";
   $onu = getnumonline();
  echo "$onu  Member inside wapbies<br/>";
  
  
      $norm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
   
    echo "<strong>$norm[0] Registered Members </strong> ";
	echo "<br/><div class='ads'>";
  include("admob.php");
  echo "</div>";
echo "<form action=\"login.php\" method=\"GET\">";
  echo "<br /><u>User Name</u><br /> <input name=\"loguid\" format=\"*x\" maxlength=\"14\"/><br />";
  echo "<u>Password</u><br /> <input type=\"password\" name=\"logpwd\" maxlength=\"20\"/><br />";

echo "<input type=\"submit\" value=\"Login\"/> ";
echo "<input type=\"reset\" value=\"Clear\"/>";
echo "</form><br/>";
 echo "Signing up is totally free and easy, <a href=\"index.php?action=terms&amp;sid=$sid\"><font color='#ff3300'>Sign Up Now</font></a><br />";
 echo "<br />
 
 <div class=\"in_cont\">
 <div class=\"fontmain\">";
 //
echo "<b>Featured Members</b><br /><br />";



$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
echo "</div>";
echo '</div>';


?>

<div class="in_cont">

<br/><i><div class="ads" onmouseOver="this.className='ads'" onmouseOut="this.className='ads'">
[<a href='the_team.php'>The team</a>]</i> 
<i>[<a href='credits.php'>Credits</a>]</i> 
<i>[<a href='About_us.php'>About us</a>]</i> 
<i>[<a href='terms.php'>Terms</a>]</i></div>

</div>
<?php

     echo "</center>";
   echo "<h3>";
   echo date("Y");
    echo " wapbies.com - Pride of Nigeria";
   echo "</h3>";
   echo "</tt>";
  echo "</body>";
  echo "</html>";
      exit();
}

if(isbanned($uid))
    {

echo "<head>";addonline(getuid_sid($sid),"Just got banned","index.php?action=$action");
  echo "<title>Banned Notice!!!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";

  echo "</head>";

      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
echo "</p>";
	echo "<div class=\"ads\">";
echo admob();
	echo "</div>";
echo "<p align=\"center\"><br />";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'")); 
echo "<br /><em>You are <b>Banned from wapbies.com</b><br /><br /></em>";

	  $banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));

      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "<b>Ban Duration:</b> $rmsg<br/><br/>";
       $nick = getnick_uid($banto[2]);
	echo "<b>Ban By: </b>$nick<br/>";
	  echo "<b>Ban Reason:</b> $banto[1]";
	  echo "<br />";
echo "</p><br />";
	  	echo "<div class=\"ads\">";
echo admob();
	echo "</div>";

      
      echo "</body>";
      echo "</html>";
      exit();
    }

	if($action=="sendmail")
	{
echo "<head>";
echo "<title>wapbies email service</title>";
include("admob.php");
     echo "<br /><h3>";
	 echo "Free e-mail Service<br />";
	 echo "</h3>";
       echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
echo "<p align=\"left\">";
echo "<form method=\"post\" action=\"mailsender.php?action=proc&amp;sid=$sid\">
To:<br /><input name=\"email\" type=\"text\" value=\"@\"><br />
From:<br /><input name=\"from\" type=\"text\" value=\"@\"><br />
Subject:<br /><input name=\"subject\" type=\"text\"><br />
Message:<br /> <textarea name=\"message\" cols='15' rows='3' wrap='physical'></textarea><br />
<input name=\"Send\" type=\"submit\"><br />";
echo "</p>";
echo "<p align=\"center\">";
echo admob_request($admob_params);
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
echo "</p></body>
</html>";
 exit();
}
?>