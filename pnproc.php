
<?php

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");

check_query();

include_once("header.php");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

	echo "<head>
	<!--Scroll Bar script -->

<style>
<!-- 
body {scrollbar-face-color: #C1DD85; scrollbar-shadow-color: #3300FF; scrollbar-highlight-color: #3399FF; scrollbar-3dlight-color: #CCFFFF; scrollbar-darkshadow-color: #000000; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #FFFFFF;}
}
// -->
</style>
	";

	echo "<title>$stitle</title>";
	echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

	echo "<body>";

connectdb();
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


$uid = strip_tags(mysql_real_escape_string(getuid_sid($sid)));

if (!isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)) && !$uid=='194' && !$uid=='16')
	  {
    echo "<meta http-equiv=\"refresh\" content=\"4; URL=index.php\"/>";
		       $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by trying to enter admincp without admin priviledge!!', actdt='".time()."'");

header('location:index.php');
      echo "<p align=\"center\">";
	
      echo "<b>No hacker dare enter wapbies!!!!</b><br/>";
      echo "<br/>";
      echo "<a href=\"index.php\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
if(islogged($sid)==false)
    {
		       $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by trying to enter acon.php without admin priviledge!!', actdt='".time()."'");

  header('location:index.php');
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    addonline(getuid_sid($sid),"Admin CP","");
if($action=="wpgn")
{
  $xtm = $_POST["sesp"];
  $fmsg = $_POST["fmsg"];
  $areg = $_POST["areg"];
  $pmaf = $_POST["pmaf"];
  $fvw = $_POST["fvw"];
  if($areg=="d")
  {
    $arv = 0;
  }else{
    $arv = 1;
  }
   echo "<p align=\"center\">";
      
      
      $res = mysql_query("UPDATE gyd_settings SET value='".$fmsg."' WHERE name='4ummsg'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum Message  updated successfully<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Updating Forum message<br/>";
      }
      
      
      $res = mysql_query("UPDATE gyd_settings SET value='".$xtm."' WHERE name='sesxp'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Session Period updated successfully<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Updating Session Period<br/>";
      }
      
       $res = mysql_query("UPDATE gyd_settings SET value='".$pmaf."' WHERE name='pmaf'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM antiflood is $pmaf seconds<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Updating PM antiflood value<br/>";
      }
      
      $res = mysql_query("UPDATE gyd_settings SET value='".$arv."' WHERE name='reg'");
      
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Registration updated successfully<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Updating Registration<br/>";
      }
      
      $res = mysql_query("UPDATE gyd_settings SET value='".$fvw."' WHERE name='fview'");

      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forums View updated successfully<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Updating Forums View<br/>";
      }
      echo "<br/>";
      
      echo "<a href=\"pn.php?action=general&amp;sid=$sid\">";
  echo "Edit general settings</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}







    else if($action=="delwpuserinbox")
{
  $who = $_GET["who"];
  $user = getnick_uid($who);
  echo "<head>";
  echo "<title>Delete $user Inbox</title>";

  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $uid = getuid_sid($sid);
  $perm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
  echo "<br/>U Cannot Delete $user<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  }else{

  echo "<br/>";
$res = mysql_query("DELETE FROM gyd_private WHERE byuid='".$who."' OR touid='".$who."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$user Inbox  deleted successfully";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UGroup";
  }
   echo "<br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"\"/>Admin Tools</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  }
  echo "</p></body>";
}

//////////////////////////add site link//////////////////////////

else if($action=="addlink")
{
  echo "<head>";
  echo "<title>Admin Tools</title>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $url = $_POST["url"];
  $title = $_POST["title"];
  echo $site;
  $res = mysql_query("INSERT INTO gyd_links SET url='".$url."', title='".$title."'");
  if($res)
  {
  //echo mysql_error();
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>Site $title Added Successfully<br/>";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Adding Link<br/>";
  }
  echo "<br/>";
  echo "<a href=\"linksites.php?sid=$sid\">Partner Links</a><br/>";
  echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"\"/>Admin Tools</a><br/>";
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
  echo "</p></body>";
exit;
  }
//////////////////////////delete site link//////////////////////////

else if($action=="linkdel")
{
  echo "<head>";
  echo "<title>Admin Tools</title>";
   echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $link=$_GET["link"];
  $sitena = mysql_query("SELECT title FROM gyd_links WHERE url='".$link."'");
  $site = mysql_fetch_array($sitena);
  $site=$site[0];
  $res = mysql_query("DELETE FROM gyd_links WHERE url='".$link."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$site deleted Successfully from links<br/>";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting $site<br/>";
  }
  echo "<br/>";
  echo "<a href=\"linksites.php?sid=$sid\">Partner Links</a><br/>";
  echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"\"/>Admin Tools</a><br/>";
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
  echo "</p></body>";
}










/////////////GLOBAL PM PROCCESS////////////////////
else if($action=="wpglobal")
{
    
  $who = $_POST["who"];
  $pmtou = $_POST["pmtou"];
  $byuid = getuid_sid($sid);
  $tm = time();
if($who=="all"){
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All members has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE lastact>'".$tm24."'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all the members[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
}else if($who=="staff"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All Staffs has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase>5");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all staff[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
}else if($who=="males"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All males has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE sex='M'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all male members[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
}else if($who=="females"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All Females has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE sex='F'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all female members[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
}
	else if($who=="online")
{
$lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
echo "<br />Message Sent to online members<br/>";

	$pms = mysql_query("SELECT userid FROM gyd_online ");
$tm = microtime(get_as_float);
while($pm=mysql_fetch_array($pms))
{
mysql_query("INSERT INTO gyd_private SET text='Public Anouncment:[br/]".$pmtou."[br/]This message was sent to all online members', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
}
}	
else if($who=="mods"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All Moderators has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase='7'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all Moderators[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
  }
echo "<p align='center'>";
      echo "<br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/></p>";
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
 exit();
}


//////////////////////////Add moderating

else if($action=="addfmod")
{
    $mid = $_POST["mid"];
  $fid = $_POST["fid"];
      echo "<p align=\"center\">";
      $res = mysql_query("INSERT INTO gyd_modr SET name='".$mid."', forum='".$fid."'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Moding Privileges Added<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      echo "<br/><br/><a href=\"pn.php?action=manmods&amp;sid=$sid\">";
  echo "Manage Moderators</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}
else if($action=="delclub")
{
  $clid = $_GET["clid"];
      echo "<p align=\"center\">";
      $res = deleteClub($clid);
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Club Deleted<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      
      echo "<br/><br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}

else if($action=="gccp")
{
  $clid = $_GET["clid"];
  $plss = $_POST["plss"];
      echo "<p align=\"center\">";
      $nop = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_clubs WHERE id='".$clid."'"));
	  $newpl = $nop[0] + $plss;
	  $res = mysql_query("UPDATE gyd_clubs SET plusses='".$newpl."' WHERE id='".$clid."'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Club plusses updated<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      
      echo "<br/><br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}

else if($action=="delfmod")
{
    $mid = $_POST["mid"];
  $fid = $_POST["fid"];
       echo "<p align=\"center\">";
      $res = mysql_query("DELETE FROM gyd_modr WHERE name='".$mid."' AND forum='".$fid."'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Moding Privileges Deleted<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      echo "<br/><br/><a href=\"pn.php?action=manmods&amp;sid=$sid\">";
  echo "Manage Moderators</a>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}
///////////////////////////////////////

else if($action=="addcat")
{
  $fcname = $_POST["fcname"];
  $fcpos = $_POST["fcpos"];
        echo "<p align=\"center\">";
        echo $fcname;
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_fcats SET name='".$fcname."', position='".$fcpos."'");
        
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum Category added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Forum Category";
      }

      echo "<br/><br/><a href=\"pn.php?action=fcats&amp;sid=$sid\">";
  echo "Forum Categories</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a>";
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
	 
      echo "</p></body>";
}
else if($action=="addfrm")
{
  $frname = $_POST["frname"];
  $frpos = $_POST["frpos"];
  $fcid = $_POST["fcid"];
       echo "<p align=\"center\">";
        echo $frname;
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_forums SET name='".$frname."', position='".$frpos."', cid='".$fcid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Forum ";
      }

      echo "<br/><br/><a href=\"pn.php?action=forums&amp;sid=$sid\">";
  echo "Forums</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addsml")
{
  $smlcde = $_POST["smlcde"];
  $smlsrc = $_POST["smlsrc"];
        echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_smilies SET scode='".$smlcde."', imgsrc='".$smlsrc."', hidden='0'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Smilie  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Smilie ";
      }

      echo "<br/><br/><a href=\"pn.php?action=addsml&amp;sid=$sid\">";
  echo "Add Another Smilie</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addavt")
{
  $avtsrc = $_POST["avtsrc"];
        echo "<p align=\"center\">";
	  echo "Source: ".$avtsrc;

        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_avatars SET avlink='".$avtsrc."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Avatar  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Avatar ";
      }

      echo "<br/><br/><a href=\"pn.php?action=addavt&amp;sid=$sid\">";
  echo "Add Another Avatar</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addjdg")
{
  $who = $_GET["who"];
       echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_judges SET uid='".$who."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Judge  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Judge ";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "Users Info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="deljdg")
{
  $who = $_GET["who"];
      echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_judges WHERE uid='".$who."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Judge  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting Judge ";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "Users Info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="delsm")
{
  $smid = $_GET["smid"];
      echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_smilies WHERE id='".$smid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Smilie  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting smilie ";
      }

      echo "<br/><br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addrss")
{
  $rssnm = $_POST["rssnm"];
  $rsslnk = $_POST["rsslnk"];
  $rssimg = $_POST["rssimg"];
  $rssdsc = $_POST["rssdsc"];
  $fid = $_POST["fid"];
  
       echo "<p align=\"center\">";
        echo $rssnm;
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_rss SET title='".$rssnm."', link='".$rsslnk."', imgsrc='".$rssimg."', dscr='".$rssdsc."', fid='".$fid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Source added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding RSS Source";
      }

      echo "<br/><br/><a href=\"pn.php?action=manrss&amp;sid=$sid\">";
  echo "Manage RSS</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addchr")
{
  $chrnm = $_POST["chrnm"];
  $chrage = $_POST["chrage"];
  $chrpst = $_POST["chrpst"];
  $chrprm = $_POST["chrprm"];
  $chrcns = $_POST["chrcns"];
  $chrfun = $_POST["chrfun"];
  
  

       echo "<p align=\"center\">";
        echo $chrnm;
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_rooms SET name='".$chrnm."', static='1', pass='', mage='".$chrage."', chposts='".$chrpst."', perms='".$chrprm."', censord='".$chrcns."' , freaky='".$chrfun."'");
//echo mysql_error();
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Chatroom added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding Chat room";
      }

      echo "<br/><br/><a href=\"pn.php?action=chrooms&amp;sid=$sid\">";
  echo "Chatrooms</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 

      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="edtrss")
{
  $rssnm = $_POST["rssnm"];
  $rsslnk = $_POST["rsslnk"];
  $rssimg = $_POST["rssimg"];
  $rssdsc = $_POST["rssdsc"];
  $fid = $_POST["fid"];
  $rssid = $_POST["rssid"];
       echo "<p align=\"center\">";
        echo $rssnm;
        echo "<br/>";
        $res = mysql_query("UPDATE gyd_rss SET title='".$rssnm."', link='".$rsslnk."', imgsrc='".$rssimg."', dscr='".$rssdsc."', fid='".$fid."' WHERE id='".$rssid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Source updated successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error updating RSS Source";
      }

      echo "<br/><br/><a href=\"pn.php?action=manrss&amp;sid=$sid\">";
  echo "Manage RSS</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="addperm")
{
  $fid = $_POST["fid"];
  $gid = $_POST["gid"];
      echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_acc SET fid='".$fid."', gid='".$gid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Permission  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding permission ";
      }

      echo "<br/><br/><a href=\"pn.php?action=addperm&amp;sid=$sid\">";
  echo "Add Permission</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
//////////////////////////////////////////Update profile

else if($action=="uprof")
{
    
    $who = $_GET["who"];
    $unick = $_POST["unick"];
    $perm = $_POST["perm"];
    $savat = $_POST["savat"];
    $semail = $_POST["semail"];
    $usite = $_POST["usite"];
    $ubday = $_POST["ubday"];
    $uloc = $_POST["uloc"];
    $usig = $_POST["usig"];
    $usex = $_POST["usex"];
    echo "<p align=\"center\">";
  $onk = mysql_fetch_array(mysql_query("SELECT name FROM gyd_users WHERE id='".$who."'"));
  $exs = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE name='".$unick."'"));
  if($onk[0]!=$unick)
  {
	  if($exs[0]>0)
	  {
		echo "<img src=\"images/notok.gif\" alt=\"x\"/>New nickname already exist, choose another one<br/>";
	  }else
  {
  $res = mysql_query("UPDATE gyd_users SET avatar='".$savat."', email='".$semail."', site='".$usite."', birthday='".$ubday."', location='".$uloc."', signature='".$usig."', sex='".$usex."', name='".$unick."', ase='".$perm."' WHERE id='".$who."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>$unick's profile was updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating $unick's profile<br/>";
  }
  }
  }else
  {
  $res = mysql_query("UPDATE gyd_users SET avatar='".$savat."', email='".$semail."', site='".$usite."', birthday='".$ubday."', location='".$uloc."', signature='".$usig."', sex='".$usex."', name='".$unick."', ase='".$perm."' WHERE id='".$who."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>$unick's profile was updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating $unick's profile<br/>";
  }
  }
  echo "<br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "Users Info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}


/////////////user password



else if($action=="upwd"){



$npwd = $_POST["npwd"];



$who = $_GET["who"];



echo "<p align=\"center\">";



if((strlen($npwd)<4) || (strlen($npwd)>15)){



echo "<img src=\"images/notok.gif\" alt=\"x\"/>password should be between 4 and 15 letters only<br/>";



}else{



$pwd = md5($npwd);



$res = mysql_query("UPDATE gyd_users SET pass='".$pwd."', passremind='".$npwd ."' WHERE id='".$who."'");



if($res){



echo "<img src=\"images/ok.gif\" alt=\"o\"/>password was updated successfully<br/>";



}else{



echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating password<br/>";



}



}

echo "<br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "Users Info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();

}


///////////////add group
else if($action=="addgrp")
{
  $frname = $_POST["ugname"];
  $ugaa = $_POST["ugaa"];
  $allus = $_POST["allus"];
  $mage = $_POST["mage"];
  $mpst = $_POST["mpst"];
  $mpls = $_POST["mpls"];
  
        echo "<p align=\"center\">";
        echo $ugname;
        echo "<br/>";
        $res = mysql_query("INSERT INTO gyd_groups SET name='".$ugname."', autoass='".$ugaa."', userst='".$allus."', mage='".$mage."', posts='".$mpst."', plusses='".$mpls."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>User group  added successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error adding User group";
      }

      echo "<br/><br/><a href=\"pn.php?action=ugroups&amp;sid=$sid\">";
  echo "UGroups</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="edtfrm")
{
  $fid = $_POST["fid"];
  $frname = $_POST["frname"];
  $frpos = $_POST["frpos"];
  $fcid = $_POST["fcid"];
        echo "<p align=\"center\">";
        echo $frname;
        echo "<br/>";
        $res = mysql_query("UPDATE gyd_forums SET name='".$frname."', position='".$frpos."', cid='".$fcid."' WHERE id='".$fid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum  updated successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error updating Forum ";
      }

      echo "<br/><br/><a href=\"pn.php?action=forums&amp;sid=$sid\">";
  echo "Forums</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	    echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="edtcat")
{
  $fcid = $_POST["fcid"];
  $fcname = $_POST["fcname"];
  $fcpos = $_POST["fcpos"];
       echo "<p align=\"center\">";
        echo $fcname;
        echo "<br/>";
        $res = mysql_query("UPDATE gyd_fcats SET name='".$fcname."', position='".$fcpos."' WHERE id='".$fcid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum Category updated successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error updating Forum Category";
      }

      echo "<br/><br/><a href=\"pn.php?action=fcats&amp;sid=$sid\">";
  echo "Forum Categories</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="delfrm")
{
  $fid = $_POST["fid"];
      echo "<p align=\"center\">";
        
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_forums WHERE id='".$fid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting Forum ";
      }

      echo "<br/><br/><a href=\"pn.php?action=forums&amp;sid=$sid\">";
  echo "Forums</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="resetpenaltyreason")
{
  $get_all_users = mysql_query("SELECT id FROM gyd_users");
while($rows = mysql_fetch_array($get_all_users))
{
$list = $rows[0];
$update_it = mysql_query("UPDATE gyd_users SET lastpnreas='' WHERE id='$list'");


}
echo "Penalty reasons is now reset";
      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

/*else if($action=="deleteipbansmembers")
{
  $get_all_users = mysql_query("SELECT id FROM gyd_users WHERE ase='0'");
while($rows = mysql_fetch_array($get_all_users))
{
$list = $rows[0];
  $check = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_pur WHERE penalty='2' AND uid='$list'"));
  if($check[0]>0)
  {
$delete_them = mysql_query("DELETE FROM gyd_users WHERE uid='$list'");
}

}
echo "All members currently under ip ban are now deleted";
      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}


*/
else if($action=="delreportedpms")
{
  
       echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_private WHERE reported='1'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All reported pms deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="delpms")
{
  
       echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_private WHERE reported!='1' AND starred='0' AND unread='0'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All PMS except starred, reported, and unread were deleted";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="clrmlog")
{

      echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_mlog");
        echo mysql_error();
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>ModLog Cleared Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="delsht30")
{

          echo "<p align=\"center\">";
        $altm = time()-(30*24*60*60);
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_shouts WHERE shtime<'".$altm."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shouts Older Than 30 days(a month) were deleted";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="delsht")
{

          echo "<p align=\"center\">";
        $altm = time()-(5*24*60*60);
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_shouts WHERE shtime<'".$altm."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shouts Older Than 5 days were deleted";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}


else if($action=="delgrp")
{
  $ugid = $_POST["ugid"];
     echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_groups WHERE id='".$ugid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>UGroup  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UGroup";
      }

      echo "<br/><br/><a href=\"pn.php?action=ugroups&amp;sid=$sid\">";
  echo "UGroups</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="delrss")
{
  $rssid = $_POST["rssid"];
       echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_rss WHERE id='".$rssid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Source  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
      }

      echo "<br/><br/><a href=\"pn.php?action=manrss&amp;sid=$sid\">";
  echo "Manage RSS</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="delchr")
{
  $chrid = $_POST["chrid"];
       echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_rooms WHERE id='".$chrid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Room  deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
      }

      echo "<br/><br/><a href=\"pn.php?action=chrooms&amp;sid=$sid\">";
  echo "Chatrooms</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="delu")
{
  $who = $_GET["who"];
  $whonick=getnick_uid($who);
        echo "<p align=\"center\">";

        echo "<br/>";
		if(!isadmin($who) && !isowner($who))
	{
    $res = mysql_query("DELETE FROM gyd_buddies WHERE tid='".$who."' OR uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_gbook WHERE gbowner='".$who."' OR gbsigner='".$who."'");
    $res = mysql_query("DELETE FROM gyd_ignore WHERE name='".$who."' OR target='".$who."'");
    $res = mysql_query("DELETE FROM gyd_mangr WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_modr WHERE name='".$who."'");
    $res = mysql_query("DELETE FROM gyd_pur WHERE uid='".$who."' OR exid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_posts WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_private WHERE byuid='".$who."' OR touid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_shouts WHERE shouter='".$who."'");
    $res = mysql_query("DELETE FROM gyd_topics WHERE authorid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_brate WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_games WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_presults WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_vault WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_blogs WHERE bowner='".$who."'");
    $res = mysql_query("DELETE FROM gyd_chat WHERE chatter='".$who."'");
    $res = mysql_query("DELETE FROM gyd_chat WHERE who='".$who."'");
    $res = mysql_query("DELETE FROM gyd_chonline WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_online WHERE userid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_ses WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_xinfo WHERE uid='".$who."'");
	 $res = mysql_query("DELETE FROM gyd_popups WHERE byuid='".$who."'");
	 $res = mysql_query("DELETE FROM refer_members WHERE byuid='".$who."'");
	 $res = mysql_query("DELETE FROM refer_members WHERE name='".$whonick."'");
	 $res = mysql_query("DELETE FROM gyd_usergallery WHERE uid='".$who."'");
	  $res = mysql_query("DELETE FROM gyd_usergallery_rating WHERE byuid='".$who."'");
    deleteMClubs($who);
      $res = mysql_query("DELETE FROM gyd_users WHERE id='".$who."'");
}
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>$whonick  deleted successfully";
      }else{
 header('location:index.php');
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete $whonick";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "User info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}




//////////// Delete users posts and topics
else if($action=="delxp")
{
  $who = $_GET["who"];
      echo "<p align=\"center\">";

        echo "<br/>";
    $res = mysql_query("DELETE FROM gyd_posts WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_topics WHERE authorid='".$who."'");
      

        if($res)
      {
	  mysql_query("UPDATE gyd_users SET plusses='0' where id='".$who."'");
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>User Posts and topics deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UPosts";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "User info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}








//////////// Delete user posts only
else if($action=="dep")
{
  $who = $_GET["who"];
      echo "<p align=\"center\">";

        echo "<br/>";
    $res = mysql_query("DELETE FROM gyd_posts WHERE uid='".$who."'");
   // $res = mysql_query("DELETE FROM gyd_topics WHERE authorid='".$who."'");
      

        if($res)
      {
	  mysql_query("UPDATE gyd_users SET plusses='0' where id='".$who."'");
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>User Posts deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UPosts";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "User info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}










//////////// Delete user topics only
else if($action=="det")
{
  $who = $_GET["who"];
      echo "<p align=\"center\">";

        echo "<br/>";
    //$res = mysql_query("DELETE FROM gyd_posts WHERE uid='".$who."'");
    $res = mysql_query("DELETE FROM gyd_topics WHERE authorid='".$who."'");
      

        if($res)
      {
	  mysql_query("UPDATE gyd_users SET plusses='0' where id='".$who."'");
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>User topics deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UPosts";
      }

      echo "<br/><br/><a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
  echo "User info</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}




else if($action=="clrses")
{

      echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_ses");
       // echo mysql_error();
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All Sesions Cleared Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}


else if($action=="delcat")
{
  $fcid = $_POST["fcid"];
      echo "<p align=\"center\">";
        echo $fcname;
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_fcats WHERE id='".$fcid."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Forum Category deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting Forum Category";
      }

      echo "<br/><br/><a href=\"pn.php?action=fcats&amp;sid=$sid\">";
  echo "Forum Categories</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="trpur")
{

  
      echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("TRUNCATE table gyd_pur");
        echo mysql_error();
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Penalties Truncated Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="droppur")
{

  
      echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("drop table gyd_pur");
        echo mysql_error();
        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Penalties Dropped Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}

else if($action=="delpopups")
{
  
       echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_popups");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All Popups messgaes deleted successfully.";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else if($action=="delrpopups")
{
  
       echo "<p align=\"center\">";

        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_popups WHERE unread='0'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All read popups deleted successfully.";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br/><br/><a href=\"pn.php?action=clrdta&amp;sid=$sid\">";
  echo "Clear Data</a><br/>";
      echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
  echo "Admin CP</a><br/>";
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
	 
      echo "</p></body>";
	  echo "</html>";
      exit();
}
else{
addonline(getuid_sid($sid),"Trying to enter admin cp illegally","");
    echo "<p align=\"center\">";
   $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for admin cp!!', actdt='".time()."'");

   header('location:index.php');
  echo "Page not found!<br/><br/>";
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
	 
  echo "</p></body>";
  echo "</html>";
      exit();
}
?>
</html>

