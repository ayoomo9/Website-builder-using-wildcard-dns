<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML Mobile 1.0//EN\"". " \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mod CP</title>
<meta forua="true" http-equiv="Cache-Control" content="no-cache"/>
<meta forua="true" http-equiv="Cache-Control" content="must-revalidate"/>
<?php
connectdb();
$sid = $_GET["sid"];
$uid = getuid_sid($sid);
?>
</head>
<body>
<?php

$action = $_GET["action"];

if (!ismod(getuid_sid($sid)) && !isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)) && !$uid=='194' && !$uid=='16')
	  {
echo "<p align=\"center\">";
echo "You are not a mod!<br/>";
echo "<br/>";
echo "<a href=\"index.php\">Home</a>";
echo "</p>";
echo "</div></div></font></body></html>";
exit();
}
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


if(isbanned($uid)){
echo "<p align=\"center\">";
echo "<br/>";
echo "You are <b>Banned</b><br/>";
$banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
$remain = $banto[0]- time();
$rmsg = gettimemsg($remain);
echo "Time to finish your penalty: $rmsg<br/><br/>";
echo "</p>";
echo "</div></div></font></body></html>";


exit();
}

///////////////////////////////////////Delete shout
if($action=="chilmit"){
  echo "<head>";
      echo "<title>Delete Shout</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
$shid = $_GET["shid"];
echo "<p align=\"center\">";
$res = mysql_query("DELETE FROM ibwf_shouts WHERE id ='".$shid."'");
if($res){
$sql = mysql_fetch_array(mysql_query("SELECT shout, shouter FROM gyd_shouts WHERE id='".$shid."'"));
$modname = getnick_uid(getuid_sid($sid));
$shouter = getnick_uid($sql[1]);
$shout = substr("$sql[0]", 0, 30);
mysql_query("INSERT INTO gyd_mlog SET action='shouts', details='<b>".$modname."</b> Deleted Shout Number <b>".$shid."</b>', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shout deleted";
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
}
echo "<br/><br/>";
echo "</p>";
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
}
//////////////////////////Edit Shout/////////////////////////////
else if($action=="chileditfin"){
  echo "<head>";
      echo "<title>Edit Shout</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
$shid = $_GET["id"];
$shtxt = $_POST["shtxt"];
echo "<p align=\"center\">";
$res = mysql_query("UPDATE gyd_shouts SET shout='".$shtxt."' WHERE id='".$shid."'");
if($res){
$sql = mysql_fetch_array(mysql_query("SELECT shout, shouter FROM gyd_shouts WHERE id='".$shid."'"));
$modname = getnick_uid(getuid_sid($sid));
$shouter = getnick_uid($sql[1]);
$shout = substr("$sql[0]", 0, 30);
mysql_query("INSERT INTO gyd_mlog SET action='shouts', details='<b>".$modname."</b> Edited <b>".$shouter."</b>\'s Shout <b><i>".$shout."...</i></b>', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shout Edited!<br/><br/><a href=\"lists.php?action=shouts&amp;sid=$sid\">Shouts</a>";
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!<br/><br/><a href=\"lists.php?action=shouts&amp;sid=$sid\">Shouts</a>";
}
echo "<br/><br/>";
echo "</p>";
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
}
else
{



header("location:index.php");

}
?>