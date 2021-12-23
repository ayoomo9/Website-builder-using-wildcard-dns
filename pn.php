<?php

require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
//session_start();
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
<title>$site_name</title>";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies :)\"> 
<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
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
      header('location:index.php');
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

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by trying to enter acon.php without login in!!', actdt='".time()."'");

    header('location:index.php');
	echo "<meta http-equiv=\"refresh\" content=\"4; URL=index.php\"/>";
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
    $xtm = getsxtm();
    $paf = getpmaf();
    $fvw = getfview();
    $fmsg = htmlspecialchars(getfmsg());
    if(canreg())
    {
      $arv = "e";
    }else{
      $arv= "d";
    }
  echo "<form action=\"pnproc.php?action=wpgn&amp;sid=$sid\" method=\"post\">";
  echo "Session Period: ";
  echo "<input name=\"sesp\" format=\"*N\" maxlength=\"3\" size=\"3\ value=\"$xtm\"/>";
  echo "<br/>PM Antiflood<input name=\"pmaf\" format=\"*N\" maxlength=\"3\" size=\"3\" value=\"$paf\"/>";
  echo "<br/>Forum Message: ";
  echo "<input name=\"fmsg\"  maxlength=\"300\" value=\"$fmsg\"/>";
  echo "<br/>Registration: ";
  echo "<select name=\"areg\" value=\"$arv\">";
  echo "<option value=\"e\">Enabled</option>";
 echo "<option value=\"d\">Disabled</option>";
 echo "</select><br/>";
  echo "View:";
  echo "<select name=\"fvw\" value=\"$fvw\">";
  $vname[0]="Drop Menu";
 $vname[0]="Horizontal Links";
  $vname[1]="Nothing";
  for($i=0;$i<count($vname);$i++)
  {
    echo "<option value=\"$i\">$vname[$i]</option>";
  }
  
  echo "</select>";

echo "<input type=\"submit\" value=\"submit\"/>";
echo "</form>";

  echo "</p>";
  echo "<p align=\"center\">";
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


else if($action=="pmal")
{


echo "<br/><form action=\"pnproc.php?action=wpglobal&amp;sid=$sid\" method=\"post\">";
  echo "Mass Message:<input name=\"pmtou\" maxlength=\"250\"/><br/>";
  echo "Destination:<select name=\"who\">";
   echo "<option value=\"online\">Online Members</option>";
  echo "<option value=\"staff\">All Staffs</option>";
  echo "<option value=\"mods\">Moderators</option>";
  echo "<option value=\"males\">Males</option>";
  echo "<option value=\"females\">Females</option>";
  echo "<option value=\"all\">All Members</option>";
  echo "</select><br/>";
  echo "<input type=\"submit\" value=\"Send\"/>";
  echo "</form>";

echo "<br/><br/>";
echo "</form>";
  echo "<p align=\"center\">";
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


//////////////////////////add blocked site//////////////////////////

else if($action=="addsiteproc")
{
  echo "<head>";
  echo "<title>Owner Tools</title>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $site = $_POST["site"];
  $res = mysql_query("INSERT INTO gyd_blockedsite SET site='".$site."'");
  if($res)
  {
  //echo mysql_error();
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$site has been Added Successfully to Blocked List<br/>";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Adding Site<br/>";
  }
  echo "<br/>";
  echo "<a href=\"pn.php?action=blocksites&amp;sid=$sid\">Blocked Sites List</a><br/>";
  echo "<p align=\"center\">";
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
//////////////////////////delete blocked site//////////////////////////

else if($action=="delsiteproc")
{
  echo "<head>";
  echo "<title>Owner Tools</title>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $id=$_GET["id"];
  $sitena = mysql_query("SELECT site FROM gyd_blockedsite WHERE id='".$id."'");
  $site = mysql_fetch_array($sitena);
  $site=$site[0];
  $res = mysql_query("DELETE FROM gyd_blockedsite WHERE id='".$id."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$site has been Removed Successfully from Blocked List<br/>";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Removing $site <br/>";
  }
  echo "<br/>";
  echo "<a accesskey=\"8\" href=\"pn.php?action=blocksites&amp;sid=$sid\">Blocked Sites List</a><br/>";
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



else if($action=="blocksites")
{
    echo "<head>";
    echo "<title>Owner Tools</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "<a accesskey=\"1\" href=\"pn.php?action=addsitemain&amp;sid=$sid\">Add Site</a><br/>";
    echo "<a accesskey=\"2\" href=\"pn.php?action=viewsitemain&amp;sid=$sid\">View Sites</a><br/>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
}
else if($action=="addsitemain")
{
    echo "<head>";
    echo "<title>Owner Tools</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "Please Enter The Address Of the Site To Block<br/>";
    echo "<form action=\"pn.php?action=addsiteproc&amp;sid=$sid\" method=\"post\">";
    echo "<input name=\"site\"/>";
    echo "<br/><input type=\"Submit\" Name=\"Submit\" Value=\"Block\"></form>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
}
else if($action=="viewsitemain")
{
    echo "<head>";
    echo "<title>Owner Tools</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "Currently Blocked Sites Are Listed Below";
    echo "</p><p>";
      $res = mysql_query("SELECT * FROM gyd_blockedsite");
while ($row = mysql_fetch_array($res)) 
{
   echo $row[1];
   echo " <a href=\"pn.php?action=delsiteproc&amp;sid=$sid&amp;id=$row[0]\">[X]</a>";
   echo "<br/>";
}
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
}





/////////////////////////ADVERT LINKS/////////////////
else if($action=="addlink")
{
    echo "<head>";
    echo "<title>Admin Tools</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "Please Enter The URL Of the Site To Add<br/>";
    echo "<form action=\"index.php?action=addlink&amp;sid=$sid\" method=\"post\">";
    echo "<b>URL Here</b><br/>";
    echo "<input name=\"url\" value=\"http://\"/><br/>";
    echo "<b>Site Name</b><br/>";
    echo "<input name=\"title\"/>";
    echo "<br/><input type=\"Submit\" Name=\"Submit\" Value=\"Add Link\"></form>";
    echo "</p>";
    echo "<p align=\"center\">";
  echo "<a href=\"linksites.php?sid=$sid\">Partners Links</a><br/>";
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
  echo "</p>";
    echo "</body>";
}


  else if($action=="delinbox")
{
  $who = $_GET["who"];
  $user = getnick_uid($who);
  echo "<head>";
  echo "<title>Admin Tool</title>";

  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $uid = getuid_sid($sid);
  $perm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
      header("location:index.php");
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
  echo "<br/>U Cannot Delete $user inbox<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  }else{

  echo "<br/>";
$res = mysql_query("DELETE FROM gyd_private WHERE byuid='".$who."' OR touid='".$who."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$user Inbox  deleted successfully<br />";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting $user Inbox<br />";
  }
   echo "<a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"\"/>Admin Cp</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  }
  echo "</p></body>";
}
///////////////////////////////////////////////Idle Staffs//////////////

else if($action=="idlestaff")
{
	    echo "<body>";
    echo "<p>";
  echo "<b>Idle Staff Members</b><br/>";
      $timeout = 180;
  $timeon = time()-$timeout;
   // $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE perm>'0' AND lastact>'".$timeon."'"));
  //echo "Current Staff Online:".$noi[0]."<br/><br/>";
    $timeout2 = 259200;
  $timeon2 = time()-$timeout2;
  $tdte = date("d m y-H:i:s", $timeon2);
  echo "Idle Date: $tdte,<br/><b>Only Staff Who have NOT been online after the above date are displayed below</b><br/><br/>";
  $nolq = mysql_query("SELECT * FROM gyd_users WHERE ase>'0' AND lastact<'".$timeon2."'");
  while ($row=mysql_fetch_array($nolq))
  {
	  echo "Username: <a href=\"pn.php?action=chubi&amp;who=$row[id]&amp;sid=$sid\">$row[name]</a>";
	  echo "<br/>";
	  $jdt = date("d m y-H:i:s",$row[lastact]);
	  echo "Last Online: $jdt <br/><br/>";
  }
  echo "</p>";
  echo "<p>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
  }
else if($action=="addgal")
{
     echo "<head>";
  echo "<title>AddGal</title>";
 echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  
    echo "<p align=\"center\">";
echo "<form action=\"pnproc.php?action=addgal&amp;sid=$sid\" method=\"post\">";  
echo "Username: <input name=\"user\" type=\"text\"/><br/>";
echo "Image URL: <input name=\"itemurl\" type=\"text\"/><br/>";

echo "<input type=\"submit\" value=\"Add Photo\"/>";
echo "</form>";  
    echo "</p>";
    echo "<p align=\"center\">";
    
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
	 echo "</p>";
  echo "</body>";
    
}
/*
////////////Delete Idle Members///////////////
else if($action=="deleidlembers")
{
      echo "<p>";
          $timeout2 = 7776000;
  $timeon2 = time()-$timeout2;
        $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE lastact>'".$timeon2."'"));
  echo "Current Number of Idle Members:".$noi[0]."<br/><br/>";
  $tdte = date("d m y-H:i:s", $timeon2);
  echo "Idle Date: $tdte,<br/>Only Members Who have NOT been online after this date are displayed below<br/><br/>";
  $nolq = mysql_query("SELECT * FROM gyd_users WHERE lastact<'".$timeon2."'");
  
  while ($row=mysql_fetch_array($nolq))
  {
	  $who=$row["id"];
	$whonick=getnick_uid($who);
        echo "<br/>";
        mysql_query("INSERT INTO ibwf_mlog SET action='AdminActs', details='<b>".getnick_uid(getuid_sid($sid))."</b> Deleted the User <b>$whonick</b>', actdt='".time()."'");

        $res = mysql_query("DELETE FROM ibwf_buddies WHERE tid='".$who."' OR uid='".$who."'");
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
    deleteMClubs($who);
      $res = mysql_query("DELETE FROM gyd_users WHERE id='".$who."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>User $whonick deleted successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting UGroup";
      }
}

  echo "<br /><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
  echo "Home</a>";

      echo "</p>";
 }

*/
//////////////////////////add permissions//////////////////////////

else if($action=="addperm")
{
  echo "<head>";
  echo "<title>Admin Tools</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
 if (!isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)))
	  {
  echo "Permission Denied!<br/>";
  }else{
  echo "<b>Add permission</b>";
  $forums = mysql_query("SELECT id, name FROM gyd_forums ORDER BY position, id, name");
  echo "<form action=\"pnproc.php?action=addperm&amp;sid=$sid\" method=\"post\">";
  echo "<br/><br/>Forum: <select name=\"fid\">";
  while ($forum=mysql_fetch_array($forums))
  {
  echo "<option value=\"$forum[0]\">$forum[1]</option>";
  }
  echo "</select>";
  $forums = mysql_query("SELECT id, name FROM gyd_groups ORDER BY  name, id");
  echo "<br/>UGroups: <select name=\"gid\">";
  while ($forum=mysql_fetch_array($forums))
  {
  echo "<option value=\"$forum[0]\">$forum[1]</option>";
  }
  echo "</select>";
  echo "<br/><input type=\"Submit\" Name=\"Submit\" Value=\"Submit\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
//////////////////////////////////////Manage Mods

else if($action=="manmods")
{
    echo "<p align=\"center\">";
    echo "NOTE: Some features will be added later to this page<br/><br/>";
    $mods = mysql_query("SELECT id, name FROM gyd_users WHERE ase='7'");
    echo "Mod: <select name=\"mid\">";
    while($mod=mysql_fetch_array($mods))
    {
      echo "<option value=\"$mod[0]\">$mod[1]</option>";
    }
    echo "</select><br/>";
    echo "<anchor>Add All Forums";
    echo "<go href=\"pnproc.php?action=addfmod&amp;sid=$sid\" method=\"post\">";
    echo "<postfield name=\"mid\" value=\"$(mid)\"/>";
    echo "<postfield name=\"fid\" value=\"*\"/>";
    echo "</go>";
    echo "<br/></anchor>";
    echo "<anchor>Delete All Forums";
    echo "<go href=\"pnproc.php?action=delfmod&amp;sid=$sid\" method=\"post\">";
    echo "<postfield name=\"mid\" value=\"$(mid)\"/>";
    echo "<postfield name=\"fid\" value=\"*\"/>";
    echo "</go>";
    echo "</anchor>";
    //echo "<br/><br/>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="fcats")
{
    echo "<p>";
    echo "<a href=\"pn.php?action=addcat&amp;sid=$sid\">&#187;Add Category</a><br/>";
    echo "<a href=\"pn.php?action=edtcat&amp;sid=$sid\">&#187;Edit Category</a><br/>";
   echo "<a href=\"pn.php?action=delcat&amp;sid=$sid\">&#187;Delete Category</a><br/>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="club")
{
	$clid = $_GET["clid"];
    echo "<p>";
    echo "<a href=\"pn.php?action=gccp&amp;sid=$sid&amp;clid=$clid\">&#187;Give Credit Plusses</a><br/>";
   echo "<a href=\"pnproc.php?action=delclub&amp;sid=$sid&amp;clid=$clid\">&#187;Delete Club</a><br/>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
	  echo "</html>";
      exit();
}

else if($action=="manrss")
{
    echo "<p>";
    echo "<a href=\"pn.php?action=addrss&amp;sid=$sid\">&#187;Add Source</a><br/>";
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rss"));
    if($noi[0]>0)
    {echo "<form action=\"pn.php?action=edtrss&amp;sid=$sid\" method=\"post\">";
        echo "<br/><select name=\"rssid\">";
        while($rs=mysql_fetch_array($rss))
        {
            echo "<option value=\"$rs[1]\">$rs[0]</option>";
        }
      echo "</select><br/>";
echo "<input type=\"submit\" value=\"Edit\"/>";
echo "<form action=\"pnproc.php?action=delrss&amp;sid=$sid\" method=\"post\">";
echo "<br/><select name=\"rssid\">";
while($rs1=mysql_fetch_array($rss1))
        {
            echo "<option value=\"$rs1[1]\">$rs1[0]</option>";
        }
      echo "</select><br/>";
echo "<input type=\"submit\" value=\"Delete\"/>";
echo "<br/>";
echo "</form>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
	  echo "</html>";
      exit();
}

else if($action=="chrooms")
{
    echo "<p>";
    echo "<a href=\"pn.php?action=addchr&amp;sid=$sid\">&#187;Add Room</a><br/>";
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rooms"));
    if($noi[0]>0)
    {
        $rss = mysql_query("SELECT name, id FROM gyd_rooms");
        echo "<form action=\"pnproc.php?action=delchr&amp;sid=$sid\" method=\"post\">";
        echo "<br/><select name=\"chrid\">";
        while($rs=mysql_fetch_array($rss))
        {
           $rs0 = htmlspecialchars("$rs[0]");      
          $rs1 = htmlspecialchars("$rs[1]"); 
          echo "<option value=\"$rs1\">$rs0</option>";
        }
      echo "</select><br/>";
echo "<input type=\"submit\" value=\"Delete\"/>";
//echo "Temporily Disabled";
echo "</form>";

    }
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="forums")
{
    
    echo "<p>";
    echo "<a href=\"pn.php?action=addfrm&amp;sid=$sid\">&#187;Add Forum</a><br/>";
    echo "<a href=\"pn.php?action=edtfrm&amp;sid=$sid\">&#187;Edit Forum</a><br/>";
    echo "<a href=\"pn.php?action=delfrm&amp;sid=$sid\">&#187;Delete Forum</a><br/>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
else if($action=="clrdta")
{
    
    echo "<p>";
//echo "<a href='pnproc.php?action=deleteipbansmembers&amp;sid=$sid'>&#187;Delete all read PMs(inbox)</a><br/>";
echo "<a href=\"pnproc.php?action=delreportedpms&amp;sid=$sid\">&#187;Delete reported PMs</a><br/>";
    echo "<a href=\"pnproc.php?action=delpms&amp;sid=$sid\">&#187;Delete all read PMs(inbox)</a><br/>";
   echo "<a href=\"pnproc.php?action=delrpopups&amp;sid=$sid\">&#187;Delete all read popups</a><br/>";
	   echo "<a href=\"pnproc.php?action=delpopups&amp;sid=$sid\">&#187;Delete all popups</a><br/>";
	echo "<a href=\"pnproc.php?action=clrmlog&amp;sid=$sid\">&#187;Clear ModLog</a><br/>";
    echo "<a href=\"pnproc.php?action=delsht&amp;sid=$sid\">&#187;Delete Old Shouts(5 days old)</a><br/>";
       echo "<a href=\"pnproc.php?action=delsht30&amp;sid=$sid\">&#187;Delete Old Shouts(30 days old)</a><br/>";
   echo "<a href=\"pnproc.php?action=resetpenaltyreason&amp;sid=$sid\">&#187;Reset all penalty reason</a><br/>";

	echo "<a href=\"pnproc.php?action=clrses&amp;sid=$sid\">&#187;Log Everyone Out</a><br/>";
  	echo "<a href=\"pnproc.php?action=trpur&amp;sid=$sid\">&#187;Truncate Pur</a><br/>";
 echo "<a href=\"pnproc.php?action=droppur&amp;sid=$sid\">&#187;Drop Pur</a><br/>";
  echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
else if($action=="ugroups")
{
    
    echo "<p>";
    echo "<a href=\"pn.php?action=addgrp&amp;sid=$sid\">&#187;Add User Group</a><br/>";
    //echo "<a href=\"pn.php?action=edtgrp&amp;sid=$sid\">&#187;Edit User group</a><br/>";
    echo "<a href=\"pn.php?action=delgrp&amp;sid=$sid\">&#187;Delete User group</a><br/>";
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
else if($action=="addcat")
{
     echo "<p align=\"center\">";
    echo "<form action=\"pnproc.php?action=addcat&amp;sid=$sid\" method=\"post\">";
    echo "Name:<input name=\"fcname\" maxlength=\"30\"/><br/>";
    echo "Position:<input name=\"fcpos\" format=\"*N\" size=\"3\"  maxlength=\"3\"/><br/>";
echo "<input type=\"submit\" value=\"Add\"/>";
    echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
//////////////////////////add forum//////////////////////////

else if($action=="addfrm")
{
  echo "<head>";
  echo "<title>Admin Tools</title>";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  if (!isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)))
	  {
	      header("location:index.php");
  echo "Permission Denied!<br/>";
  }else{
  echo "<b>Add Forum</b><br/><br/>";
  echo "<form action=\"pnproc.php?action=addfrm&amp;sid=$sid\" method=\"post\">";
  echo "Name:<input name=\"frname\" maxlength=\"30\"/><br/>";
  echo "Position:<input name=\"frpos\" style=\"-wap-input-format: '*N'\" size=\"3\"  maxlength=\"3\"/><br/>";
  $fcats = mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id, name");
  echo "Category: <select name=\"fcid\">";
  while ($fcat=mysql_fetch_array($fcats))
  {
  echo "<option value=\"$fcat[0]\">$fcat[1]</option>";
  }
  echo "</select><br/>";
  echo "<input type=\"Submit\" Name=\"Submit\" Value=\"Add\">";
  }
  echo "<br/><a href=\"pn.php?action=forums&amp;sid=$sid\">Forums</a>";
   echo "<br/><a href=\"index.php?action=cop&amp;sid=$sid\"><img src=\"images/admn.gif\" alt=\"*\"/>";
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
  echo "</p>";
  echo "</body>";
  echo "</html>";
      exit();
}
else if($action=="gccp")
{
    echo "<p align=\"center\">";
    echo "<b>Add club plusses</b><br/><br/>";
	$clid = $_GET["clid"];
    echo "<form action=\"pnproc.php?action=gccp&amp;sid=$sid&amp;clid=$clid\" method=\"post\">";
    echo "Plusses:<input name=\"plss\" maxlength=\"3\" size=\"3\" format=\"*N\"/><br/>";
echo "<input type=\"submit\" value=\"Give\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
else if($action=="addsml")
{
    
    echo "<p align=\"center\">";
    echo "<b>Add Smilies</b><br/><br/>";
    echo "<form action=\"pnproc.php?action=addsml&amp;sid=$sid\" method=\"post\">";
    echo "Code:<input name=\"smlcde\" maxlength=\"30\"/><br/>";
    echo "Image Source:<input name=\"smlsrc\" maxlength=\"200\"/><br/>";
 echo "<input type=\"submit\" value=\"Add\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="addavt")
{
    echo "<p align=\"center\">";
    echo "<b>Add Smilies</b><br/><br/>";
    echo "<form action=\"pnproc.php?action=addavt&amp;sid=$sid\" method=\"post\">";
    echo "Source:<input name=\"avtsrc\" maxlength=\"30\"/><br/>";
    echo "<input type=\"submit\" value=\"Add\"/>";
    echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="addrss")
{
    echo "<p align=\"center\">";
    echo "<b>Add RSS</b><br/><br/>";
    echo "<form action=\"pnproc.php?action=addrss&amp;sid=$sid\" method=\"post\">";
    echo "Name:<input name=\"rssnm\" maxlength=\"50\"/><br/>";
    echo "Source:<input name=\"rsslnk\" maxlength=\"255\"/><br/>";
    echo "Image:<input name=\"rssimg\" maxlength=\"255\"/><br/>";
    echo "Description:<input name=\"rssdsc\"  maxlength=\"255\"/><br/>";
    $forums = mysql_query("SELECT id, name FROM fun_forums ORDER BY position, id, name");
    echo "Forum: <select name=\"fid\">";
    echo "<option value=\"0\">NO FORUM</option>";
    while ($forum=mysql_fetch_array($forums))
    {
        echo "<option value=\"$forum[0]\">$forum[1]</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Add\"/>";
echo "</form>";

    echo "<br/><br/><a href=\"pn.php?action=manrss&amp;sid=$sid\">";
  echo "<img src=\"images/rss.gif\" alt=\"rss\"/>Manage RSS</a><br/>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="addchr")
{
    echo "<p align=\"center\">";
    echo "<b>Add Room</b><br/><br/>";
    echo "<form action=\"pnproc.php?action=addchr&amp;sid=$sid\" method=\"post\">";
    echo "Name:<input name=\"chrnm\" maxlength=\"30\"/><br/>";
    echo "Minimum Age:<input name=\"chrage\" format=\"*N\" maxlength=\"3\" size=\"3\"/><br/>";
    echo "Minimum Chat Posts:<input name=\"chrpst\" format=\"*N\" maxlength=\"4\" size=\"4\"/><br/>";
    echo "Permission:<select name=\"chrprm\">";
    echo "<option value=\"0\">Normal</option>";
    echo "<option value=\"1\">Moderators</option>";
    echo "<option value=\"2\">Admins</option>";
    echo "</select><br/>";
    echo "Censored:<select name=\"chrcns\">";
    echo "<option value=\"1\">Yes</option>";
    echo "<option value=\"0\">No</option>";
    echo "</select><br/>";
    echo "Fun:<select name=\"chrfun\">";
    echo "<option value=\"0\">No</option>";
    echo "<option value=\"1\">esreveR</option>";
    echo "<option value=\"2\">Fun Babe</option>";
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Add\"/>";
    echo "<form>";
    echo "<br/><br/><a href=\"pn.php?action=chrooms&amp;sid=$sid\">";
  echo "<img src=\"images/chat.gif\" alt=\"chat\"/>Chatrooms</a><br/>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="edtrss")
{
  
  $rssid = $_POST["rssid"];
  $rsinfo = mysql_fetch_array(mysql_query("SELECT title, link, imgsrc, fid, dscr FROM gyd_rss WHERE id='".$rssid."'"));
    echo "<form action=\"pnproc.php?action=edtrss&amp;sid=$sid\" method=\"post\">";
    echo "Name:<input name=\"rssnm\" maxlength=\"50\" value=\"$rsinfo[0]\"/><br/>";
    echo "Source:<input name=\"rsslnk\" maxlength=\"255\" value=\"$rsinfo[1]\"/><br/>";
    echo "Image:<input name=\"rssimg\" maxlength=\"255\" value=\"$rsinfo[2]\"/><br/>";
    echo "Description:<input name=\"rssdsc\"  maxlength=\"255\" value=\"$rsinfo[4]\"/><br/>";
    $forums = mysql_query("SELECT id, name FROM gyd_forums ORDER BY position, id, name");
    echo "Forum: <select name=\"fid\" value=\"$rsinfo[3]\">";
    echo "<option value=\"0\">NO FORUM</option>";
    while ($forum=mysql_fetch_array($forums))
    {
        echo "<option value=\"$forum[0]\">$forum[1]</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Edit\"/>";
echo "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
echo "<input type=\"hidden\" name=\"rssid\" value=\"$rssid\"/>";
echo "</form>";
    echo "<br/><br/><a href=\"pn.php?action=manrss&amp;sid=$sid\">";
  echo "<img src=\"images/rss.gif\" alt=\"rss\"/>Manage RSS</a><br/>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="addgrp")
{

    echo "<p align=\"center\">";
    echo "<b>Add Group</b><br/><br/>";
    echo "<form action=\"pnproc.php?action=addgrp&amp;sid=$sid\" method=\"post\">";
    echo "Name:<input name=\"ugname\" maxlength=\"30\"/><br/>";
    echo "Auto Assign:<select name=\"ugaa\">";
    echo "<option value=\"1\">Yes</option>";
    echo "<option value=\"0\">No</option>";
    echo "</select><br/>";
    echo "<br/><small><b>For Auto Assign Only</b></small><br/>";
    echo "Allow:<select name=\"allus\">";
    echo "<option value=\"0\">Normal Users</option>";
    echo "<option value=\"1\">Mods</option>";
    echo "<option value=\"2\">Admins</option>";
    echo "</select><br/>";
    echo "Min. Age:";
    echo "<input name=\"mage\" format=\"*N\" maxlength=\"3\" size=\"3\"/>";
    echo "<br/>Min. Posts:";
    echo "<input name=\"mpst\" format=\"*N\" maxlength=\"3\" size=\"3\"/>";
    echo "<br/>Min. Plusses:";
    echo "<input name=\"mpls\" format=\"*N\" maxlength=\"3\" size=\"3\"/><br/>";
echo "<input type=\"submit\" value=\"Add\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}



else if($action=="edtfrm")
{
    echo "<p align=\"center\">";
    echo "<b>Edit Forum</b><br/><br/>";
    $forums = mysql_query("SELECT id,name FROM gyd_forums ORDER BY position, id, name");
    echo "<form action=\"pnproc.php?action=edtfrm&amp;sid=$sid\" method=\"post\">";
    echo "Forum: <select name=\"fid\">";
    while($forum=mysql_fetch_array($forums))
    {
      echo "<option value=\"$forum[0]\">$forum[1]</option>";
    }
    echo "</select>";
    echo "<br/>Name:<input name=\"frname\" maxlength=\"30\"/><br/>";
    echo "Position:<input name=\"frpos\" format=\"*N\" size=\"3\"  maxlength=\"3\"/><br/>";
    $fcats = mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id, name");
    echo "Category: <select name=\"fcid\">";
    while ($fcat=mysql_fetch_array($fcats))
    {
        echo "<option value=\"$fcat[0]\">$fcat[1]</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Edit\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}


else if($action=="delfrm")
{
    echo "<p align=\"center\">";
    echo "<b>Delete Forum</b><br/><br/>";
    $forums = mysql_query("SELECT id,name FROM gyd_forums ORDER BY position, id, name");
   echo "<form action=\"pnproc.php?action=delfrm&amp;sid=$sid\" method=\"post\">";
    echo "Forum: <select name=\"fid\">";
    while($forum=mysql_fetch_array($forums))
    {
      $forum0 = htmlspecialchars("$forum[0]");      
      $forum1 = htmlspecialchars("$forum[1]"); 
         echo "<option value=\"$forum0\">$forum1</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Delete\"/>";
    echo "</form>";

    echo "<a href=\"pn.php?action=forums&amp;sid=$sid\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="delgrp")
{
    echo "<p align=\"center\">";
    echo "<b>Delete UGroup</b><br/><br/>";
    $forums = mysql_query("SELECT id,name FROM gyd_groups ORDER BY name, id");
    echo "<form action=\"pnproc.php?action=delgrp&amp;sid=$sid\" method=\"post\">";
    echo "UGroup: <select name=\"ugid\">";
    while($forum=mysql_fetch_array($forums))
    {
      echo "<option value=\"$forum[0]\">$forum[1]</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Delete\"/>";
echo "</form>";
    echo "<a href=\"pn.php?action=forums&amp;sid=$sid\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}
else if($action=="edtcat")
{
    echo "<p align=\"center\">";
    echo "<b>Edit Category</b><br/><br/>";
    $fcats = mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id, name");
    echo "<form action=\"pnproc.php?action=edtcat&amp;sid=$sid\" method=\"post\">";
    echo "Edit: <select name=\"fcid\">";
    while ($fcat=mysql_fetch_array($fcats))
    {
        echo "<option value=\"$fcat[0]\">$fcat[1]</option>";
    }
    echo "</select><br/>";
    echo "Name:<input name=\"fcname\" maxlength=\"30\"/><br/>";
    echo "Position:<input name=\"fcpos\" format=\"*N\" size=\"3\"  maxlength=\"3\"/><br/>";
echo "<input type=\"submit\" value=\"Edit\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

else if($action=="delcat")
{
    echo "<p align=\"center\">";
    echo "<b>Delete Category</b><br/><br/>";
    $fcats = mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id, name");
    echo "<form action=\"pnproc.php?action=delcat&amp;sid=$sid\" method=\"post\"/>";
    echo "Delete: <select name=\"fcid\">";
    
    while ($fcat=mysql_fetch_array($fcats))
    {
        echo "<option value=\"$fcat[0]\">$fcat[1]</option>";
    }
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Delete\"/>";
    echo "</form>";

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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

/////////////////////////////////user info


else if($action=="chuinfo")
{
    echo "<p align=\"center\">";
    echo "Type user nickname<br/><br/>";
   echo "<form action=\"pn.php?action=acui&amp;sid=$sid\" method=\"post\">";
    echo "User: <input name=\"unick\" format=\"*x\" maxlength=\"15\"/><br/>";
echo "<input type=\"submit\" value=\"find\"/>";
echo "</form>";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

//////////////////////////////////////Change User info

else if($action=="acui")
{
    echo "<p align=\"center\">";
    $unick = $_POST["unick"];
    $tid = getuid_nick($unick);
    if($tid==0)
    {
      echo "<img src=\"images/notok.gif\" alt=\"x\"/>User Does Not exist<br/>";
    }else{
      echo "</p>";
      echo "<p>";
      echo "<a href=\"pn.php?action=chubi&amp;sid=$sid&amp;who=$tid\">&#187;$unick's Profile</a><br/>";
      $judg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".$tid."'"));
      if($judg[0]>0)
      {
      echo "<a href=\"pnproc.php?action=deljdg&amp;sid=$sid&amp;who=$tid\">&#187;Remove $unick From Judges List</a><br/>";
      }else{
        echo "<a href=\"pnproc.php?action=addjdg&amp;sid=$sid&amp;who=$tid\">&#187;Make $unick judge</a><br/>";
      }
      //echo "<a href=\"pn.php?action=addtog&amp;sid=$sid&amp;who=$tid\">&#187;Add  $unick to a group</a><br/>";
      //echo "<a href=\"pn.php?action=umset&amp;sid=$sid&amp;who=$tid\">&#187;$unick's Mod. Settings</a><br/>";
	  echo "<a href=\"pnproc.php?action=delxp&amp;sid=$sid&amp;who=$tid\">&#187;Delete $unick's posts and topics</a><br/>";
	  	  echo "<a href=\"pnproc.php?action=dep&amp;sid=$sid&amp;who=$tid\">&#187;Delete $unick's posts only</a><br/>";
		  	  echo "<a href=\"pnproc.php?action=det&amp;sid=$sid&amp;who=$tid\">&#187;Delete $unick's topics only</a><br/>";
      echo "<a href=\"pnproc.php?action=delu&amp;sid=$sid&amp;who=$tid\">&#187;Delete $unick</a><br/>";
	  //echo "<a href=\"lists.php?action=readmsgs&amp;sid=$sid&amp;who=$who\">Read Sent Inboxes</a><br/>";
      echo "</p>";
      echo "<p align=\"center\">";
    }
    echo "<a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
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
  echo "</p>";
    echo "</body>";
	echo "</html>";
      exit();
}

////////////////////////////////////////////


else if($action=="chubi")
{
    $who = $_GET["who"];
    $unick = getnick_uid($who);
	
    echo "<onevent type=\"onenterforward\">";
    
	
	
	$avat = getavatar($who);
    
	
	
	
	$email = mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE id='".$who."'"));
   
$pass = mysql_fetch_array(mysql_query("SELECT pass2 FROM gyd_users WHERE id='".$who."'"));




   $site = mysql_fetch_array(mysql_query("SELECT site FROM gyd_users WHERE id='".$who."'"));
   

   $bdy = mysql_fetch_array(mysql_query("SELECT birthday FROM gyd_users WHERE id='".$who."'"));
   

   $uloc = mysql_fetch_array(mysql_query("SELECT location FROM gyd_users WHERE id='".$who."'"));
  

  $usig = mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$who."'"));
    
	
	$sx = mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$who."'"));
    
	
	$perm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$who."'"));
  
    echo "<form action=\"pnproc.php?action=uprof&amp;sid=$sid&amp;who=$who\" method=\"post\">";
    echo "Username: <input name=\"unick\" maxlength=\"15\" value=\"$unick\"/><br/>";
    echo "Avatar: <input name=\"savat\" maxlength=\"100\" value=\"$avat\"/><br/>";
    echo "E-Mail: <input name=\"semail\" maxlength=\"100\" value=\"$email[0]\"/><br/>";
    echo "Site: <input name=\"usite\" maxlength=\"100\" value=\"$site[0]\"/><br/>";
    echo "Birthday<small>(YYYY-MM-DD)</small>: <input name=\"ubday\" maxlength=\"50\" value=\"$bdy[0]\"/><br/>";
    echo "Location: <input name=\"uloc\" maxlength=\"50\" value=\"$uloc[0]\"/><br/>";
    echo "Signature: <input name=\"usig\" maxlength=\"100\" value=\"$usig[0]\"/><br/>";
    echo "Sex: <select name=\"usex\" value=\"$sx[0]\">";
    echo "<option value=\"M\">Male</option>";
    echo "<option value=\"F\">Female</option>";
    echo "</select><br/>";
    echo "Privileges: <select name=\"perm\" value=\"$perm[0]\">";
    echo "<option value=\"0\">Normal</option>";
    echo "<option value=\"7\">Moderator</option>";
    echo "<option value=\"8\">Admin</option>";
	echo "<option value=\"9\">Site Owner</option>";
	echo "<option value=\"6\">Coder</option>";
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Update\"/>";
echo "</form>";

       if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || $uid=='10')
    {
	if ($who!='194' && !isowner($who) && $who!='16' && !isadmin($who) && $who!='10')
    {
	$get_pwd = mysql_fetch_array(mysql_query("SELECT passremind from gyd_users where id='$who'"));
$password = $get_pwd[0]; 
echo "Registered Password: <strong>$password</strong><br /><br />";
}
}

echo "Password: <form action=\"pnproc.php?action=upwd&amp;sid=$sid&amp;who=$who\" method=\"post\"><input name=\"npwd\" format=\"*x\" maxlength=\"15\"/><br/>";



echo "<input id=\"inputButton\" type=\"submit\" value=\"Change\"/>";



echo "</form>";
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"pn.php?action=chuinfo&amp;sid=$sid\">";
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
  echo "</p>";
    echo "</body>";
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
