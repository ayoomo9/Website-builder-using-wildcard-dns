
<?php

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_browser();

check_method();
//session_start();
check_query();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head><title>Moderator Tools</title>";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies :)\">

<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
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
if (!ismod(getuid_sid($sid)) && !iscoder(getuid_sid($sid)) && !isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)) && !$uid=='194' && !$uid=='16' && !$uid=='10')
	  {
    echo "<meta http-equiv=\"refresh\" content=\"4; URL=index.php\"/>";
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
  header('location:index.php');
  echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
    exit();
    }
    addonline(getuid_sid($sid),"Mod CP","");
if($action=="delp")
{
  $pid = $_GET["pid"];
  $tid = gettid_pid($pid);
  $fid = getfid_tid($tid);
  echo "<p align=\"center\">";
 echo "<div class=\"ads\">";
   echo admob();
  echo "</div>";
	echo "<br />";
  $res = mysql_query("DELETE FROM gyd_posts WHERE id='".$pid."'");
  if($res)
          {
            $tname = mysql_fetch_array(mysql_query("SELECT name FROM gyd_topics WHERE id='".$tid."'"));
            mysql_query("INSERT INTO gyd_mlog SET action='posts', details='<b>".getnick_uid(getuid_sid($sid))."</b> Deleted Post Number $pid Of the thread ".mysql_escape_string($tname[0])." at the forum ".getfname($fid)."', actdt='".time()."'");

            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Post Message Deleted";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }

  echo "<br/><br/><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;page=1000\">";
echo "View Topic</a><br/>";
$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a>";
 echo "<div class=\"ads\">";
 echo admob();
echo "</div>";
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

  echo "</p></body></html>";
    exit();
}
//////////////////////////boot user//////////////////////////

if($action=="mbrboot")
{

  $who = mysql_real_escape_string($_GET["who"]);
  $user = getnick_uid($who);
  echo "<head>";
  echo "<title>Boot User</title>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $uid = getuid_sid($sid);
  $perm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
     $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to boot $user', actdt='".time()."'");

  header('location:index.php');
  echo "<br/>You Cannot Boot $user<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  }else{
  echo "<br/>";
  $res = mysql_query("DELETE FROM gyd_ses WHERE uid='".$who."'");
  $res = mysql_query("DELETE FROM gyd_online WHERE userid='".$who."'");
  if($res)
  {
  mysql_query("INSERT INTO gyd_mlog SET action='boot', details='<b>".getnick_uid(getuid_sid($sid))."</b> booted $user', actdt='".time()."'");
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$user Booted successfully";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error booting $user";
  }
  echo "<br/><br/><a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$user's Profile</a><br/>";
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
  }
  echo "</body>";
    exit();
}
/*
else if($action=="delcmt")
{
  $id = mysql_real_escape_string($_GET["id"]);

  echo "<head>";
      echo "<title>Delete Comment</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";

  echo "<p align=\"center\">";

  $res = mysql_query("DELETE FROM gyd_galcomments WHERE id ='".$id."'");
  if($res)
          {
          mysql_query("INSERT INTO gyd_mlog SET action='comment', details='<b>".getnick_uid(getuid_sid($sid))."</b> Deleted a Photo Comment', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Comment deleted";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  echo "<br/><br/>";


  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p></body>";
    exit();
}
*/
////////////////////////////////////////////Edit Post

else if($action=="edtpst")
{
  $pid = mysql_real_escape_string($_GET["pid"]);
  $ptext = mysql_real_escape_string($_POST["ptext"]);
  $tid = gettid_pid($pid);
  $fid = getfid_tid($tid);
  echo "<p align=\"center\">";
  $res = mysql_query("UPDATE gyd_posts SET text='"
  .$ptext."' WHERE id='".$pid."'");
  if($res)
          {
            $tname = mysql_fetch_array(mysql_query("SELECT name FROM gyd_topics WHERE id='".$tid."'"));
            mysql_query("INSERT INTO gyd_mlog SET action='posts', details='<b>".getnick_uid(getuid_sid($sid))."</b> Edited Post Number $pid Of the thread ".mysql_escape_string($tname[0])." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Post Message Edited";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  echo "<br/><br/>";
  echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid\">";
echo "View Topic</a><br/>";
$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a><br/>";
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
    exit();
}

////////////////////////////////////////////Edit Post

else if($action=="edttpc")
{
  $tid = mysql_real_escape_string($_GET["tid"]);
  $ttext = mysql_real_escape_string($_POST["ttext"]);
  $fid = getfid_tid($tid);
   echo "<p align=\"center\">";
  $res = mysql_query("UPDATE gyd_topics SET text='"
  .$ttext."' WHERE id='".$tid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> Edited the text Of the thread ".mysql_escape_string(gettname($tid))." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic Message Edited";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  echo "<br/><br/>";
  echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid\">";
echo "View Topic</a><br/>";
$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a><br/>";
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
    exit();
}

///////////////////////////////////////Close/ Open Topic

else if($action=="clot")
{
  $tid = mysql_real_escape_string($_GET["tid"]);
  $tdo = mysql_real_escape_string($_GET["tdo"]);
  $fid = getfid_tid($tid);
  echo "<p align=\"center\">";
  $res = mysql_query("UPDATE gyd_topics SET closed='"
  .$tdo."' WHERE id='".$tid."'");
  if($res)
          {
            if($tdo==1)
            {
              $msg = "Closed";
            }else{
                $msg = "Opened";
            }
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> Closed The thread ".mysql_escape_string(gettname($tid))." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic $msg";
			$tpci = mysql_fetch_array(mysql_query("SELECT name, authorid FROM gyd_topics WHERE id='".$tid."'"));
			$tname = htmlspecialchars($tpci[0]);
			$msg = "your thread [topic=$tid]$tname"."[/topic] is $msg"."[br/][small][i]p.s: this is an automatic pm[/i][/small]";
			autopm($msg, $tpci[1]);
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  echo "<br/><br/>";

$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a>";
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
    exit();
}

///////////////////////////////////////Untrash user

else if($action=="untrmbr")
{
  $who = mysql_real_escape_string($_GET["who"]);
  echo "<p align=\"center\">";
  $res = mysql_query("DELETE FROM gyd_pur WHERE penalty='0' AND uid='".$who."'");
  if($res)
          {
            $unick = getnick_uid($who);
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> Untrashed The user <b>".$unick."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick Untrashed";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  //echo "<br/><br/>";

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
    exit();
}

///////////////////////////////////////Unban user

else if($action=="unbnmbr")
{
  $who = mysql_real_escape_string($_GET["who"]);
   echo "<p align=\"center\">";
    echo admob();
	echo "<br />";
  $res = mysql_query("DELETE FROM gyd_pur WHERE (penalty='1' OR penalty='2') AND uid='".$who."'");
  if($res)
          {
            $unick = getnick_uid($who);
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> Unbanned The user <b>".$unick."</b>', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick Unbanned";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  //echo "<br/><br/>";


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
    exit();
}

///////////////////////////////////////Delete shout

else if($action=="delsh")
{
  $shid = mysql_real_escape_string($_GET["shid"]);
  echo "<p align=\"center\">";
  $sht = mysql_fetch_array(mysql_query("SELECT shouter, shout FROM gyd_shouts WHERE id='".$shid."'"));
  $msg = getnick_uid($sht[0]);
  $msg .= ": ".htmlspecialchars((strlen($sht[1])<20?$sht[1]:substr($sht[1], 0, 20)));
  $res = mysql_query("DELETE FROM gyd_shouts WHERE id ='".$shid."'");
  if($res)
          {
		  mysql_query("INSERT INTO gyd_mlog SET action='shouts', details='<b>".getnick_uid(getuid_sid($sid))."</b> Deleted the shout <b>".$shid."</b> - $msg', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shout deleted";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }


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
    exit();
}


///////////////////////////////////////Shield User user

else if($action=="shldmbr")
{
  $who = mysql_real_escape_string($_GET["who"]);
  echo "<p align=\"center\">";
   include("admob.php");
	echo "<br />";
  $res = mysql_query("Update gyd_users SET shield='1' WHERE id='".$who."'");
  if($res)
          {
            $unick = getnick_uid($who);
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> Shielded The user <b>".$unick."</b>', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick is Shielded";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  //echo "<br/><br/>";


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
    exit();
}

///////////////////////////////////////Unban user

else if($action=="ushldmbr")
{
  $who = mysql_real_escape_string($_GET["who"]);
  echo "<p align=\"center\">";
    echo admob();
	echo "<br />";
  $res = mysql_query("Update gyd_users SET shield='0' WHERE id='".$who."'");
  if($res)
          {
            $unick = getnick_uid($who);
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> Unshielded The user <b>".$unick."</b>', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick is Unshielded";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
 // echo "<br/><br/>";


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
    exit();
}

///////////////////////////////////////Pin/ Unpin Topic

else if($action=="pint")
{
  $tid = mysql_real_escape_string($_GET["tid"]);
  $tdo = mysql_real_escape_string($_GET["tdo"]);
  $fid = getfid_tid($tid);
   echo "<p align=\"center\">";
    echo "<div class=\"ads\">";
 echo admob();
  echo "</div>";
	//echo "<br />";
  $pnd = getpinned($fid);
  if($pnd<=5)
  {
  $res = mysql_query("UPDATE gyd_topics SET pinned='"
  .$tdo."' WHERE id='".$tid."'");
  if($res)
          {
            if($tdo==1)
            {
              $msg = "Pinned";
            }else{
                $msg = "Unpinned";
            }
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> $msg The thread ".mysql_escape_string(gettname($tid))." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic $msg";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can only pin 5 topics in every forum";
          }
  echo "<br/><br/>";

$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a>";
  echo "<div class=\"ads\">";
 echo admob();
echo "</div>";
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
    exit();
}

///////////////////////////////////Delete the damn thing

else if($action=="delt")
{
  $tid = mysql_real_escape_string($_GET["tid"]);
  $fid = getfid_tid($tid);
   echo "<p align=\"center\">";
    echo admob();
	echo "<br />";
  $tname=gettname($tid);
  $res = mysql_query("DELETE FROM gyd_topics WHERE id='".$tid."'");
  if($res)
          {
            mysql_query("DELETE FROM gyd_posts WHERE tid='".$tid."'");
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> Deleted The thread ".mysql_escape_string($tname)." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic Deleted";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  echo "<br/><br/>";

$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a>";
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
    exit();
}


////////////////////////////////////////////Edit Post

else if($action=="rentpc")
{
  $tid = mysql_real_escape_string($_GET["tid"]);
  $tname = mysql_real_escape_string($_POST["tname"]);
  $fid = getfid_tid($tid);
  echo "<p align=\"center\">";
 echo admob();
	echo "<br />";
  $otname = gettname($tid);
  if(trim($tname!=""))
  {
    $not = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE name LIKE '".$tname."' AND fid='".$fid."'"));
    if($not[0]==0)
    {
  $res = mysql_query("UPDATE gyd_topics SET name='"
  .$tname."' WHERE id='".$tid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> Renamed The thread ".mysql_escape_string($otname)." to ".mysql_escape_string($tname)." at the forum ".getfname($fid)."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic  Renamed";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>Topic Name already exist";
  }

  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You must specify a name for the topic";
  }
  echo "<br/><br/>";
  echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid\">";
echo "View Topic</a><br/>";
$fname = getfname($fid);
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a>";
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
    exit();
}

///////////////////////////////////////////////////Move topic



else if($action=="mvt")
{
  $tid = $_GET["tid"];
  $mtf = $_POST["mtf"];
  $fname = htmlspecialchars(getfname($mtf));
  //$fid = getfid_tid($tid);
   echo "<p align=\"center\">";
  echo admob();
	echo "<br />";

    $not = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE name LIKE '".$tname."' AND fid='".$mtf."'"));
    if($not[0]==0)
    {
  $res = mysql_query("UPDATE gyd_topics SET fid='"
  .$mtf."', moved='1' WHERE id='".$tid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>".getnick_uid(getuid_sid($sid))."</b> Moved The thread ".mysql_escape_string($tname)." to forum ".getfname($fid)."', actdt='".time()."'");
			$tpci = mysql_fetch_array(mysql_query("SELECT name, authorid FROM gyd_topics WHERE id='".$tid."'"));
			$tname = htmlspecialchars($tpci[0]);
			$msg = "your thread [topic=$tid]$tname"."[/topic] Was moved to $fname forum[br/][small][i]p.s: this is an automatic pm[/i][/small]";
			autopm($msg, $tpci[1]);
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic Moved";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>Topic Name already exist";
  }


  echo "<br/><br/>";


      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$mtf\">";
echo "$fname</a>";
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
    exit();
}

//////////////////////////////////////////Handle PM

else if($action=="hpm")
{
  $pid = mysql_real_escape_string($_GET["pid"]);

  echo "<p align=\"center\">";
  echo admob();
	echo "<br />";

    $info = mysql_fetch_array(mysql_query("SELECT byuid, touid FROM gyd_private WHERE id='".$pid."'"));
  $res = mysql_query("UPDATE gyd_private SET reported='2' WHERE id='".$pid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='handling', details='<b>".getnick_uid(getuid_sid($sid))."</b> handled The PM ".$pid."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM Handled";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }



  echo "<br/><br/>";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$info[0]\">PM Sender's Profile</a><br/>";
      echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$info[1]\">PM Reporter's Profile</a><br/><br/>";
      echo "<a href=\"wmcp.php?action=main&amp;sid=$sid\">";
echo "Staffs Log</a>";
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
    exit();
}

//////////////////////////////////////////Handle Post

else if($action=="hps")
{
  $pid = $_GET["pid"];

   echo "<p align=\"center\">";
 echo admob();
	echo "<br />";
    $info = mysql_fetch_array(mysql_query("SELECT uid, tid FROM gyd_posts WHERE id='".$pid."'"));
  $res = mysql_query("UPDATE gyd_posts SET reported='2' WHERE id='".$pid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='handling', details='<b>".getnick_uid(getuid_sid($sid))."</b> handled The Post ".$pid."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Post Handled";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }



  echo "<br/><br/>";
    $poster = getnick_uid($info[0]);
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$info[0]\">$poster's Profile</a><br/>";
      echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$info[1]\">View Topic</a><br/><br/>";
      echo "<a href=\"wmcpr.php?action=main&amp;sid=$sid\">";
echo "Staff Log</a>";
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
    exit();
}

//////////////////////////////////////////Handle Topic

else if($action=="htp")
{
  $pid = $_GET["tid"];

   echo "<p align=\"center\">";
  echo admob();
	echo "<br />";
    $info = mysql_fetch_array(mysql_query("SELECT authorid FROM gyd_topics WHERE id='".$pid."'"));
  $res = mysql_query("UPDATE gyd_topics SET reported='2' WHERE id='".$pid."'");
  if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='handling', details='<b>".getnick_uid(getuid_sid($sid))."</b> handled The topic ".mysql_escape_string(gettname($pid))."', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic Handled";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }



  echo "<br/><br/>";
    $poster = getnick_uid($info[0]);
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$info[0]\">$poster's Profile</a><br/>";
      echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$pid\">View Topic</a><br/><br/>";
      echo "<a href=\"codercp.php?action=main&amp;sid=$sid\">";
echo "Staff Logs</a><br/>";
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
    exit();
}

////////////////////////////////////////Punish

else if($action=="mbrpundo")
{

   if (iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
   $pid = strip_tags(trim(mysql_real_escape_string($_POST["pid"])));
    $who = strip_tags(trim(mysql_real_escape_string($_POST["who"])));
		  $check = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE id='".$who."'"));
if($check[0]==0)
{
echo "<p align='center'>User can not be find. Its either the user id is deleted or something else.</p><br />";

     echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
  echo "f<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
exit;
}
    $pres = strip_tags(trim(mysql_real_escape_string($_POST["pres"])));
    $pds = strip_tags(trim(mysql_real_escape_string($_POST["pds"])));
    $phr = strip_tags(trim(mysql_real_escape_string($_POST["phr"])));
    $pmn = strip_tags(trim(mysql_real_escape_string($_POST["pmn"])));
    $psc = strip_tags(trim(mysql_real_escape_string($_POST["psc"])));
	 $user = getnick_uid($who);
      echo "<p align=\"center\">";
	   include("admob.php");
	echo "<br />";

  $uip = "";
  $ubr = "";
  $pmsg[0]="Trashed";
  $pmsg[1]="Banned";
  $pmsg[2]="IP-Banned";
  if($pid=='2')
  {
    //ip ban
    $uip = getip_uid($who);
    $ubr = getbr_uid($who);
  }
   $timeto = $pds*24*60*60;
    $timeto += $phr*60*60;
    $timeto += $pmn*60;
    $timeto += $psc;
    $ptime = $timeto + time();
    $unick = getnick_uid($who);
  if(trim($pres)=="")
  {
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You must Specify a reson for punishing the user";
   exit();
  }
   $uid = getuid_sid($sid);
  $perm = mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
  echo "<br/>You Cannot Ban $user<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";

$res1 = mysql_query("INSERT INTO gyd_pur SET uid='".getuid_sid($sid)."', penalty='".$pid."', exid='".$who."', timeto='".$ptime."', pnreas='".mysql_escape_string($pres)."', ipadd='".$uip."', browserm='".$ubr."'");

mysql_query("UPDATE gyd_users SET lastpnreas='Banning an administrator' WHERE id='".getuid_sid($sid)."'");

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>The user ".getnick_uid(getuid_sid($sid))." got autopunished for ".$timeto." seconds because he or she attempt to a staff</b>', actdt='".time()."'");

echo "You tried to ban a vital member of wapbies so you are reverse punished!!";
  header('location:index.php');
  exit();
  }


	if(($who==0) || ($who==1) || ($who==10) || ($who==182) || ($who==194) || isadmin($unick) || isowner($unick) || ($who=='') || ($who==16) || ($who==" "))

{

$res1 = mysql_query("INSERT INTO gyd_pur SET uid='".getuid_sid($sid)."', penalty='".$pid."', exid='".$who."', timeto='".$ptime."', pnreas='".mysql_escape_string($pres)."', ipadd='".$uip."', browserm='".$ubr."'");

mysql_query("UPDATE gyd_users SET lastpnreas='Banning an administrator' WHERE id='".getuid_sid($sid)."'");

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>The user ".getnick_uid(getuid_sid($sid))." got autopunished for ".$timeto." seconds because he or she attempt to ban a staff</b>', actdt='".time()."'");

echo "You tried to ban a vital member of wapbies so you are reverse punished!!";
  header('location:index.php');
  exit();
}
else
{
    $res = mysql_query("INSERT INTO gyd_pur SET uid='".$who."', penalty='".$pid."', exid='".getuid_sid($sid)."', timeto='".$ptime."', pnreas='".mysql_escape_string($pres)."', ipadd='".$uip."', browserm='".$ubr."'");
    }
	if($res)
          {
            mysql_query("UPDATE gyd_users SET lastpnreas='".$pmsg[$pid].": ".mysql_escape_string($pres)."' WHERE id='".$who."'");
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> $pmsg[$pid] The user <b>".$unick."</b> For ".$timeto." Seconds', actdt='".time()."'");

            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick is $pmsg[$pid] for $timeto Seconds";
          
$byuid = getuid_sid($sid);
$name = getnick_uid($byuid);
$pmtext="Thanks for using wapbies.com penalty tools. Always report the person to the admin incase he keep registering";

autopm($pmtext, $uid, "Info");



}else{
            echo "<br /><img src=\"images/notok.gif\" alt=\"X\"/>Hack Attempt! Fuck you!";
			 exit();
          }
  }
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
    exit();
}
////////////////////////////////////////Punish

else if($action=="pls")
{
       $pid = strip_tags(trim(mysql_real_escape_string($_POST["pid"])));
    $who = strip_tags(trim(mysql_real_escape_string($_POST["who"])));
    $pres = strip_tags(trim(mysql_real_escape_string($_POST["pres"])));
    $pval = strip_tags(trim(mysql_real_escape_string($_POST["pval"])));
      echo "<p align=\"center\">";
  echo admob();
	echo "<br />";
$unick = getnick_uid($who);
$opl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$who."'"));

if($pid=='0')
{
  $npl = $opl[0] - $pval;
}else{
    $npl = $opl[0] + $pval;
}
if($npl<0)
{
  $npl=0;
}
  if(trim($pres)=="")
  {
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You must Specify a reson for updating $unick's Plusses";
  }else{

    $res = mysql_query("UPDATE gyd_users SET lastplreas='".mysql_escape_string($pres)."', plusses='".$npl."' WHERE id='".$who."'");
    if($res)
          {
            mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> Updated <b>".$unick."</b> plusses from ".$opl[0]." to $npl', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick's Plusses Updated From $opl[0] to $npl";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
          }
  }
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
  echo "</p></body></html>";
    exit();
}
///////////////////////////////////////Unblock inbox
 else if($action=="openinbox"){
$who = $_GET["who"];
echo "<p align=\"center\">";
$res = mysql_query("UPDATE gyd_users SET inboxb='0' WHERE id='".$who."'");
$res1 = mysql_query("DELETE FROM gyd_pur WHERE penalty='2' AND uid='".$who."'");
if($res){
$unick = getnick_uid($who);
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> unblocked the user <b>".$unick."</b> inbox', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick inbox unblocked";
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
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
}
echo "<br/></p>";
getfooter($sid);
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
///////////////////////////////////////Unblock forum
 else if($action=="openforum"){
$who = $_GET["who"];
echo "<p align=\"center\">";
$res = mysql_query("UPDATE gyd_users SET forumb='0' WHERE id='".$who."'");
if($res){
$unick = getnick_uid($who);
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> unblocked the user <b>".$unick."</b> forum access', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick forum unblocked";
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
}
echo "<br/><p/>";
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
///////////////////////////////////////Unblock Shoutbox
 else if($action=="openshout"){
$who = $_GET["who"];
echo "<p align=\"center\">";
$res = mysql_query("UPDATE gyd_users SET shoutb='0' WHERE id='".$who."'");
if($res){
$unick = getnick_uid($who);
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> unblocked the user <b>".$unick."</b> shoutbox', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick Shoutbox unblocked";
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
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
}
echo "<br/></p>";
getfooter($sid);
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


////////////////////////////////////////new Punish

else if($action=="sazadore"){
$pid = htmlentities(trim(strip_tags($_POST["pid"])));
$who = htmlentities(trim(strip_tags($_POST["who"])));
$pres = htmlentities(trim(strip_tags($_POST["pres"])));
$pds = htmlentities(trim(strip_tags($_POST["pds"])));
$phr = htmlentities(trim(strip_tags($_POST["phr"])));
$pmn = htmlentities(trim(strip_tags($_POST["pmn"])));
$psc = htmlentities(trim(strip_tags($_POST["psc"])));
echo "<p align=\"center\">";
$uip = "";
$ubr = "";
$pmsg[0]="Outgoing Blocked";
$pmsg[1]="Banned";
$pmsg[2]="Inbox Blocked";
$pmsg[3]="Forum Blocked";
$pmsg[4]="Shoutbox Blocked";

if($pid=='2'){
$res = mysql_query("UPDATE gyd_users SET inboxb='1' WHERE id='".$who."'");
}
else if($pid=='3'){
$res = mysql_query("UPDATE gyd_users SET forumb='1' WHERE id='".$who."'");
}
else if($pid=='4'){
$res = mysql_query("UPDATE gyd_users SET shoutb='1' WHERE id='".$who."'");
}
if(trim($pres)==""){
echo "<img src=\"images/notok.gif\" alt=\"X\"/>You must Specify a reson for punishing the user";
}else{
$timeto = $pds*24*60*60;
$timeto += $phr*60*60;
$timeto += $pmn*60;
$timeto += $psc;
$ptime = $timeto + time();
$unick = getnick_uid($who);
 if(($who==0) || ($who==1) || ($who==2) || ($who==3) || ($who==4) || ($who==5) || ($who==10) || ($who==182) || ($who==194) || ($who==200) || isadmin($unick) || isowner($unick) || ($who=='') || ($who==16) || ($who==" "))

{
$res1 = mysql_query("INSERT INTO gyd_pur SET uid='".getuid_sid($sid)."', penalty='".$pid."', exid='".$who."', timeto='".$ptime."', pnreas='".mysql_escape_string($pres)."', ipadd='".$uip."', browserm='".$ubr."'");
mysql_query("UPDATE gyd_users SET lastpnreas='Banning an administrator' WHERE id='".getuid_sid($sid)."'");
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>The user ".getnick_uid(getuid_sid($sid))." got autopunished for ".$timeto." seconds</b>', actdt='".time()."'");
echo "You tried to ban an important member so you are reverse punished!!";
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
else{
//$res = mysql_query("INSERT INTO gyd_pur SET uid='".$who."', penalty='".$pid."', exid='".getuid_sid($sid)."', timeto='".$ptime."', pnreas='".mysql_escape_string($pres)."', ipadd='".$uip."', browserm='".$ubr."'");
}
if($res){
mysql_query("UPDATE gyd_users SET lastpnreas='".$pmsg[$pid].": ".mysql_escape_string($pres)."' WHERE id='".$who."'");
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='<b>".getnick_uid(getuid_sid($sid))."</b> $pmsg[$pid] The user <b>".$unick."</b> For ".$timeto." Seconds', actdt='".time()."'");
echo "<img src=\"images/ok.gif\" alt=\"O\"/>$unick is $pmsg[$pid] for $timeto Seconds";
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error";
}
}
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
getfooter($sid);
exit();
}
else{
addonline(getuid_sid($sid),"Trying to enter mod cp illegally","");

  echo "<p align=\"center\">";
   $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for script destinations in modproc.php!!', actdt='".time()."'");

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
  echo "</p></body></html>";
    exit();
}
?>
</html>

