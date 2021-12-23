
<?php
session_start();
require("sec.php");
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";

echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();

//check_injection();
check_browser();
check_method();
connectdb();


if(isset($_GET['action']))
      {
$action = $_GET["action"];
}
if(isset($_GET['sid']))
      {
$sid = $_GET["sid"];
}
if(isset($_GET['page']))
      {
$page = $_GET["page"];
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

$uid = getuid_sid($sid);



$sitename = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];

$uid = getuid_sid($sid);
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
echo "<a href='#' title=\"$user\"><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href='#' title=\"$user\"><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href='#' title=\"$user\"><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
$pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href='#' title=\"$user\"><img src=\"$pic[1]\" width=\"50\" height=\"50\"/></a>";
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

echo "<head>";
addonline(getuid_sid($sid),"Just got banned","index.php?action=$action");
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
      $banto = @mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'")); 
echo "<br /><em>You are <b>Banned from wapbies.com</b><br /><br /></em>";

	  $banres = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));

      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "<b>Ban Duration:</b> $rmsg<br/><br/>";
       $nick = getnick_uid($banto[2]);
	//echo "<b>Ban By: </b>$nick<br/>";
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





if($action=="newtopic")
{

  $fid = $_POST["fid"];
  $ntitle = $_POST["ntitle"];
  $tpctxt = $_POST["tpctxt"];


if (isforumblocked(getuid_sid($sid))){



      echo "<head>";
	  addonline(getuid_sid($sid),"Forum banned","index.php?action=$action");
      echo "<title>Forum Banned!!!</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
echo "<p align=\"center\">";
echo "<br />Your forum access has been blocked by a moderator!!!<br/><br/>";
echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
      echo "</p>";
      echo "</body></html>";
	   exit();	

	}


  addonline(getuid_sid($sid),"Created New Topic","");
      echo "<head>";
      echo "<title>Create Topic</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      $crdate = time();
      //$uid = getuid_sid($sid);
      $texst = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE name LIKE '".$ntitle."' AND fid='".$fid."'"));
      if($texst[0]==0)
      {
        $res = false;

        $ltopic = @mysql_fetch_array(mysql_query("SELECT crdate FROM gyd_topics WHERE authorid='".$uid."' ORDER BY crdate DESC LIMIT 1"));
        global $topic_af;
        $antiflood = time()-$ltopic[0];
        if($antiflood>$topic_af)
{
  if((trim($ntitle)!="")||(trim($tpctxt)!=""))
      {
    if(!isblocked($ntitle,$uid)&&!isblocked($tpctxt,$uid) && !newisblocked($ntitle,$uid) && !newisblocked($tpctxt,$uid))
    {

      $res = @mysql_query("INSERT INTO gyd_topics SET name='".$ntitle."', fid='".$fid."', authorid='".$uid."', text='".$tpctxt."', crdate='".$crdate."', lastpost='".$crdate."'");
    }else{
        $bantime = time() + (900*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Post Topic<br/><br/>";
    echo "You just tried creating a topic with a link to one of the crapiest sites on earth<br/> The members of these sites spam here a lot, so go to that site and stay there if you don't like it here<br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    @mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>anti-spammer</b> auto banned $user for spamming forums', actdt='".time()."'");
    @mysql_query("INSERT INTO gyd_pur SET uid='".$uid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic Ban for spamming for a crap site'");
    @mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$uid."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via forum new topic named $ntitle)[/b][br/]".$tpctxt."', byuid='".$uid."', touid='194', timesent='".$tm."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via forum new topic named $ntitle)[/b][br/]".$tpctxt."', byuid='".$uid."', touid='200', timesent='".$tm."'");

      echo "</body>";
      echo "</html>";
      exit();
  }
     }
       if($res)
      {
        $usts = @mysql_fetch_array(mysql_query("SELECT posts, plusses FROM gyd_users WHERE id='".$uid."'"));
        $ups = $usts[0]+1;
        $upl = $usts[1]+1;
        @mysql_query("UPDATE gyd_users SET posts='".$ups."', plusses='".$upl."' WHERE id='".$uid."'");
        $tnm = htmlspecialchars($ntitle);
        echo "<strong>You gain 1 point!<br /><br /></strong><img src=\"images/ok.gif\" alt=\"O\"/>Topic <b>$tnm</b> Created Successfully";
        $tid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_topics WHERE name='".$ntitle."' AND fid='".$fid."'"));
        echo "<br/><br/><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid[0]\">";
echo "View Topic</a>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Unable to Create New Thread<br />Check and Remove any apostrophe from your text";
      }
      }else{
        $af = $topic_af -$antiflood;
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Antiflood Control: Wait for $af before creating another topic";
      }
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Topic Name already Exist";
      }





      $fname = getfname($fid);
      echo "<br/><br/><a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
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
  echo "</body>";
  exit();
}







/////////////////Upload avatar////////////////////////


else if($action=="upavat"){

 echo "<head>\n";
	  echo "<title>Upload Avater</title>\n";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
	  	  echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />\n";
      echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />\n";
      echo "<meta http-equiv=\"Pragma\" content=\"no-cache\" />\n";
	  echo "</head>";
      echo "<body>";
addonline(getuid_sid($sid),"Uploading avatar image","");

$size = $_FILES['attach']['size']/1024;

$origname = $_FILES['attach']['name'];

$res = false;

$ext = explode(".", strrev($origname));

switch(strtolower($ext[0])){

        case "gpj":

	$res = true;

	break;

	case "gepj":

	$res = true;

	break;

}

$tm = time();

$uploaddir = "avatars";

if($size>512){

	echo "File is larger than 512KB<br />";
echo "<br /><div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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

else if ($res!=true){



	echo "<br />File type not supported! Please attach only a JPG/JPEG.<br />";
$user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

@mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by uploading an unallowed avater image called $origname in the my cpanel menu', actdt='".time()."'");
echo "<br /><div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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

	$name = getuid_sid($sid);

	$uploadfile = $name.".".$ext;

	$uppath=$uploaddir."/".$uploadfile;

	move_uploaded_file($_FILES['attach']['tmp_name'], $uppath);

	$filewa=$uppath;

	list($width, $height, $type, $attr) = getimagesize($filewa);

	$newname=$uploaddir."/".$name."u.jpg";

	$newheight = ($height*128)/$width;

	$newimg=imagecreatetruecolor(128, $newheight);

	$largeimg=imagecreatefromjpeg($filewa);

	imagecopyresampled($newimg, $largeimg, 0, 0, 0, 0, 128, $newheight, $width, $height);

	imagejpeg($newimg, $newname);

	imagedestroy($newimg);

	imagedestroy($largeimg);

	$file1=$name."u.jpg";

	unlink($filewa);

        $res1 = @mysql_query("UPDATE gyd_users SET avatar='avatars/$file1' WHERE id='".$name."'");

}

if($res1){

	echo "Your file $origname was successfully uploaded and set to your profile!";
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

else {

	echo "File couldn't be processed! Check error messages and report to a moderator or admin.";
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


exit();
}




//////////////////////////////////////////Select Avatar
else if($action=="upavg")
{

    addonline(getuid_sid($sid),"Updating Avatar","");
    $avsrc = $_GET["avsrc"];
//$pstyle = gettheme($sid);
      echo xhtmlhead("$stitle",$pstyle);
  echo "<p align=\"center\">";
echo "<meta http-equiv=Refresh content=0;url=index.php?action=main&amp;sid=$sid>";
  //$uid = getuid_sid($sid);
  $res = @mysql_query("UPDATE gyd_users SET avatar='".$avsrc."' WHERE id='".$uid."'");
  if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Avatar Selected<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
        echo "<br/>";

         $thid = @mysql_fetch_array(mysql_query("SELECT themeid FROM gyd_users WHERE id='".$uid."'"));
    $themeimageset = @mysql_fetch_array(mysql_query("SELECT themedir FROM gyd_iconset WHERE id='".$thid[0]."'"));
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
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
   echo "</body></html>";
	   exit();
}



//////////////////////////////////
else if($action=="updtthme")
{

  addonline(getuid_sid($sid),"Updating Theme","");
  $theme = $_POST["thms"];
  $size = $_POST["size"];
  $uid = getuid_sid($sid);
  $exist = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE id='".$uid."'"));
if ($exist[0]>0)
  {
  $res = @mysql_query("UPDATE gyd_users SET theme='".$theme."_".$size.".css' WHERE id='".$uid."'");
  }else{
  $res = @mysql_query("UPDATE gyd_users SET theme='".$theme."_".$size.".css' WHERE id='".$uid."'");
  }
  echo "<head>";
  echo "<title>$sitename</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  //echo mysql_error();
if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"o\"/>Your theme has been updated successfully<br/><br/><br/>";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/><br/>";
  }
  echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">Settings</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
    echo "</body></html>";
	   exit();
}
else if($action=="post")
{

    $tid = $_POST["tid"];
    $tfid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$tid."'"));
if (isforumblocked(getuid_sid($sid))){



      echo "<head>";
      echo "<title>Forum Banned!!!</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
echo "<p align=\"center\">";
echo "<br />Your forum access has been blocked by a moderator!!!<br/><br/>";
echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
      echo "</p>";
      echo "</body></html>";
	   exit();	

	}

  $reptxt = $_POST["reptxt"];
  
  $qut = $_POST["qut"];

  addonline(getuid_sid($sid),"Posted A reply","");
    echo "<head>";
      echo "<title>Post Reply</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      $crdate = time();
      $fid = getfid($tid);
      //$uid = getuid_sid($sid);
      $res = false;
      $closed = @mysql_fetch_array(mysql_query("SELECT closed FROM gyd_topics WHERE id='".$tid."'"));

      if(($closed[0]!='1')||(ismod($uid)) || (isadmin($uid)) || (isowner($uid)) || (iscoder($uid)) || $uid==194 || $uid==16 || uid==10)
      {

        $lpost = @mysql_fetch_array(mysql_query("SELECT dtpost FROM gyd_posts WHERE uid='".$uid."' ORDER BY dtpost DESC LIMIT 1"));
        global $post_af;
        $antiflood = time()-$lpost[0];
        if($antiflood>$post_af)
{
  if($_SESSION['reptxt']==$reptxt)
{

        echo "<img src=\"images/ok.gif\" alt=\"O\"/><font color='red'>Message Posted Successfully</font>";
        echo "<br/><br/><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;go=last\">";
echo "View Topic</a>";
      $fname = getfname($fid);
      echo "<br/><br/><a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
      echo "</p>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</body></html>";
exit;


}
if(isblocked($reptxt,$uid) || newisblocked($reptxt,$uid))
{
        $bantime = time() + (900*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "You are banned<br/><br/>";
    echo "You just tried posting a link to one of the crapiest sites on earth<br/> The members of these sites spam here a lot, so go to that site and stay there if you don't like it here<br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    @mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>anti-spammer</b> auto banned $user for spamming forums', actdt='".time()."'");
    @mysql_query("INSERT INTO gyd_pur SET uid='".$uid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic Ban for spamming for a crap site'");
    @mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$uid."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via forum post[/b][br/] $reptxt', byuid='".$uid."', touid='194', timesent='".$tm."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via forum post[/b][br/] $reptxt', byuid='".$uid."', touid='200', timesent='".$tm."'");
    echo "<p align=\"center\">";

    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
      exit();
}
  if(trim($reptxt)!="")
      {
      $res = @mysql_query("INSERT INTO gyd_posts SET text='".$reptxt."', tid='".$tid."', uid='".$uid."', dtpost='".$crdate."', quote='".$qut."'");
}
      if($res)
      {
	   $_SESSION['reptxt'] = $reptxt;
        $usts = @mysql_fetch_array(mysql_query("SELECT posts, plusses FROM gyd_users WHERE id='".$uid."'"));
        $ups = $usts[0]+1;
        $upl = $usts[1]+1;
        @mysql_query("UPDATE gyd_users SET posts='".$ups."', plusses='".$upl."' WHERE id='".$uid."'");
        @mysql_query("UPDATE gyd_topics SET lastpost='".$crdate."' WHERE id='".$tid."'");
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Message Posted Successfully";
        echo "<br/><br/><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;go=last\">";
echo "View Topic</a>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>You cant make an empty to Post";
      }
      }else{
$af = $post_af -$antiflood;
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Antiflood Control: $af";
      }
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Topic is closed for posting";
      }

      $fname = getfname($fid);
      echo "<br/><br/><a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
      echo "</p>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</body></html>";

	   exit();
}


else if ($action=="uadd")
{

    $ucon = $_POST["ucon"];
    $ucit = $_POST["ucit"];
    $ustr = $_POST["ustr"];
    $utzn = $_POST["utzn"];
    $uphn = $_POST["uphn"];
    addonline(getuid_sid($sid),"My Address","");
      echo "<head>";
      echo "<title>My Address</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_xinfo WHERE uid='".$uid."'"));
    if($exs[0]>0)
    {
        $res = @mysql_query("UPDATE gyd_xinfo SET country='".$ucon."', city='".$ucit."', street='".$ustr."', timezone='".$utzn."', phoneno='".$uphn."' WHERE uid='".$uid."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Address Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }else{
        $res = @mysql_query("INSERT INTO ibwf_xinfo SET uid='".$uid."', country='".$ucon."', city='".$ucit."', street='".$ustr."', timezone='".$utzn."', phoneno='".$uphn."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Address Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">Extended Settings</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
      echo "</body></html>";
	   exit();
}

else if($action=="gcp")
{

    $clid = $_GET["clid"];
    $who = $_GET["who"];
    $giv = $_POST["giv"];
    $pnt = $_POST["pnt"];
    addonline(getuid_sid($sid),"Moderating Club Member","");
    echo "<head>";
    echo "<title>Moderating Club</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    $whnick = getnick_uid($who);
    echo "<b>$whnick</b>";
    echo "</p>";
    echo "<p>";
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."' AND clid=".$clid.""));
$cow = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."' AND id=".$clid.""));
if($exs[0]>0 && $cow[0]>0)
{
    $mpt = @mysql_fetch_array(mysql_query("SELECT points FROM gyd_clubmembers WHERE uid='".$who."' AND clid='".$clid."'"));
    if($giv=="1")
    {
      $pnt = $mpt[0]+$pnt;
    }else{
        $pnt = $mpt[0]-$pnt;
        if($pnt<0)$pnt=0;
    }
    $res = @mysql_query("UPDATE gyd_clubmembers SET points='".$pnt."' WHERE uid='".$who."' AND clid='".$clid."'");
    if($res)
    {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Club points updated successfully!";
    }else{
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
    }
    }else{
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Missing Info!";
    }
    echo "</p>";

    echo "<p align=\"center\">";

    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
	   exit();
}

else if($action=="gpl")
{

    $clid = $_GET["clid"];
    $who = $_GET["who"];
    $pnt = $_POST["pnt"];
    addonline(getuid_sid($sid),"Moderating Club Member","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $whnick = getnick_uid($who);
    echo "<b>$whnick</b>";
    echo "</p>";
    echo "<p>";
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Because people misused the plusses thing, clubs owners cant give plusses anymore";

    echo "</p>";

    echo "<p align=\"center\">";

    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
	   exit();
}

else if ($action=="upre")
{

    $ubon = $_POST["ubon"];
    $usxp = $_POST["usxp"];
    addonline(getuid_sid($sid),"Preferences","");
      echo "<head>";
      echo "<title>Preferences</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_xinfo WHERE uid='".$uid."'"));
    if($exs[0]>0)
    {
        $res = @mysql_query("UPDATE gyd_xinfo SET budsonly='".$ubon."', sexpre='".$usxp."' WHERE uid='".$uid."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Preferences Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }else{
        $res = @mysql_query("INSERT INTO gyd_xinfo SET uid='".$uid."', budsonly='".$ubon."', sexpre='".$usxp."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Preferences Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">Extended Settings</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
	   exit();
}

else if ($action=="gmset")
{

    $ugun = $_POST["ugun"];
    $ugpw = $_POST["ugpw"];
    $ugch = $_POST["ugch"];
    addonline(getuid_sid($sid),"G-Mail Settings","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_xinfo WHERE uid='".$uid."'"));
    if($exs[0]>0)
    {
        $res = @mysql_query("UPDATE gyd_xinfo SET gmailun='".$ugun."', gmailpw='".$ugpw."', gmailchk='".$ugch."', gmaillch='".time()."' WHERE uid='".$uid."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Gmail Settings Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }else{
        $res = @mysql_query("INSERT INTO gyd_xinfo SET uid='".$uid."', gmailun='".$ugun."', gmailpw='".$ugpw."', gmailchk='".$ugch."', gmaillch='".time()."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>G-Mail Settings Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">Extended Settings</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
	   exit();
}

else if ($action=="uper")
{

    $uhig = $_POST["uhig"];
    $uwgt = $_POST["uwgt"];
    $urln = $_POST["urln"];
    $ueor = $_POST["ueor"];
    $ueys = $_POST["ueys"];
    $uher = $_POST["uher"];
    $upro = $_POST["upro"];

    addonline(getuid_sid($sid),"Personality","");
      echo "<head>";
      echo "<title>Personality</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_xinfo WHERE uid='".$uid."'"));
    if($exs[0]>0)
    {
        $res = @mysql_query("UPDATE gyd_xinfo SET height='".$uhig."', weight='".$uwgt."', realname='".$urln."', eyescolor='".$ueys."', profession='".$upro."', racerel='".$ueor."',hairtype='".$uher."'  WHERE uid='".$uid."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Personal Info Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }else{
        $res = @mysql_query("INSERT INTO gyd_xinfo SET uid='".$uid."', height='".$uhig."', weight='".$uwgt."', realname='".$urln."', eyescolor='".$ueys."', profession='".$upro."', racerel='".$ueor."',hairtype='".$uher."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Personal Info Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">Extended Settings</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
     echo "</body></html>";
	   exit();
}

else if ($action=="umin")
{

    $ulik = htmlspecialchars(mysql_real_escape_string($_POST["ulik"]));
    $ulik = str_replace('"', "", $ulik);
    $ulik = str_replace("'", "", $ulik);
    $udlk = htmlspecialchars(mysql_real_escape_string($_POST["udlk"]));
    $udlk = str_replace('"', "", $udlk);
    $udlk = str_replace("'", "", $udlk);
    $ubht = htmlspecialchars(mysql_real_escape_string($_POST["ubht"]));
    $ubht = str_replace('"', "", $ubht);
    $ubht = str_replace("'", "", $ubht);
    $ught = htmlspecialchars(mysql_real_escape_string($_POST["ught"]));
    $ught = str_replace('"', "", $ught);
    $ught = str_replace("'", "", $ught);
    $ufsp = htmlspecialchars(mysql_real_escape_string($_POST["ufsp"]));
    $ufsp = str_replace('"', "", $ufsp);
    $ufsp = str_replace("'", "", $ufsp);
    $ufmc = htmlspecialchars(mysql_real_escape_string($_POST["ufmc"]));
    $ufmc = str_replace('"', "", $ufmc);
    $ufmc = str_replace("'", "", $ufmc);
    $umtx = htmlspecialchars(mysql_real_escape_string($_POST["umtx"]));
    $umtx = str_replace('"', "", $umtx);
    $umtx = str_replace("'", "", $umtx);
    addonline(getuid_sid($sid),"More about me","");
      echo "<head>";
      echo "<title>More about me</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $exs = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_xinfo WHERE uid='".$uid."'"));
    if($exs[0]>0)
    {
        $res = @mysql_query("UPDATE gyd_xinfo SET likes='".$ulik."', deslikes='".$udlk."', habitsb='".$ubht."', habitsg='".$ught."', favsport='".$ufsp."', favmusic='".$ufmc."',moretext='".$umtx."'  WHERE uid='".$uid."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Info Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }else{
        $res = @mysql_query("INSERT INTO gyd_xinfo SET uid='".$uid."', likes='".$ulik."', deslikes='".$udlk."', habitsb='".$ubht."', habitsg='".$ught."', favsport='".$ufsp."', favmusic='".$ufmc."',moretext='".$umtx."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Info Updated Successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"O\"/>Database Error!<br/><br/>";
        }
    }
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">Extended Settings</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
      echo "</body></html>";
	   exit();
}

else if($action=="mkroom")
{

        $rname = mysql_escape_string($_POST["rname"]);
        $rpass = trim($_POST["rpass"]);
        addonline(getuid_sid($sid),"Creating Chatroom","");
      echo "<head>";
      echo "<title>Creating Chatroom</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
        echo "<p align=\"center\">";
        if ($rpass=="")
        {
          $cns = 1;
        }else{
            $cns = 0;
        }
        $prooms = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rooms WHERE static='0'"));
        if($prooms[0]<10)
        {
        $res = @mysql_query("INSERT INTO gyd_rooms SET name='".$rname."', pass='".$rpass."', censord='".$cns."', static='0', lastmsg='".time()."'");
        if($res)
        {
          echo "<img src=\"images/ok.gif\" alt=\"O\"/>Room created successfully<br/><br/>";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!<br/><br/>";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>There's already 10 users rooms<br/><br/>";
        }
        echo "<a href=\"index.php?action=uchat&amp;sid=$sid\">Chat</a><br/>";
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
      echo "</body></html>";
	   exit();

}

else if($action=="signgb")
{

    $who = mysql_real_escape_string($_POST["who"]);

if(!cansigngb(getuid_sid($sid), $who))
    {
      echo "<head>";
      echo "<title>Guest Book</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "You cant Sign this user guestbook<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
      echo "</body>";
      echo "</html>";
      exit();
    }
  $msgtxt = mysql_real_escape_string(htmlspecialchars($_POST["msgtxt"]));
  //$qut = htmlspecialchars(mysql_real_escape_string($_POST["qut"]));
  addonline(getuid_sid($sid),"Signing a guestbook","");
      echo "<head>";
      echo "<title>Guest Book</title>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      $crdate = time();
      //$uid = getuid_sid($sid);
      $res = false;
 if(isblocked($msgtxt) || newisblocked($msgtxt))
{
        $bantime = time() + (900*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "You are banned<br/><br/>";
    echo "You just put a crap site link on a profile, <br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    @mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>anti-spammer</b> auto banned $user for spamming $who guestbook with $msgtxt', actdt='".time()."'");
    @mysql_query("INSERT INTO gyd_pur SET uid='".$uid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic ban  for Spamming $who guestbook'");
    @mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$uid."'");
    @mysql_query("INSERT INTO gyd_private SET text='Got banned for putting $msgtxt on $who guestbook.lolz', byuid='".$uid."', touid='194', timesent='".$tm."'");
    @mysql_query("INSERT INTO gyd_private SET text='Got banned for putting $msgtxt on $who guestbook.lolz', byuid='".$uid."', touid='200', timesent='".$tm."'");

      echo "</body>";
      echo "</html>";
      exit();
}
      if(trim($msgtxt)!="")
      {

      $res = @mysql_query("INSERT INTO gyd_gbook SET gbowner='".$who."', gbsigner='".$uid."', dtime='".$crdate."', gbmsg='".$msgtxt."'");
      }
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Message Posted Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Posting Message";
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
       echo "</body></html>";
	   exit();

}
else if($action=="votepl")
{

  //$uid = getuid_sid($sid);
  $plid = htmlspecialchars(mysql_real_escape_string($_GET["plid"]));
  $ans = htmlspecialchars(mysql_real_escape_string($_GET["ans"]));
  addonline(getuid_sid($sid),"Poll Voting ;)","");
      echo "<head>";
      echo "<title>Poll Voting</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $voted = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE uid='".$uid."' AND pid='".$plid."'"));
    if($voted[0]==0)
    {
        $res = @mysql_query("INSERT INTO gyd_presults SET uid='".$uid."', pid='".$plid."', ans='".$ans."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Thanks for your voting";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>You already voted for this poll";
    }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}
else if($action=="dlpoll")
{

  //$uid = getuid_sid($sid);
  addonline(getuid_sid($sid),"Deleting Poll","");
      echo "<head>";
      echo "<title>Deleting Poll</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$uid."'"));
        $res = @mysql_query("UPDATE gyd_users SET pollid='0' WHERE id='".$uid."'");
        if($res)
        {
          $res = @mysql_query("DELETE FROM gyd_presults WHERE pid='".$pid[0]."'");
		  $res = @mysql_query("DELETE FROM gyd_pp_pres WHERE pid='".$pid[0]."'");
          $res = @mysql_query("DELETE FROM gyd_polls WHERE id='".$pid[0]."'");
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Poll Deleted";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
    echo "</body></html>";
	   exit();
}

else if($action=="delan")
{

  //$uid = getuid_sid($sid);
  addonline(getuid_sid($sid),"Deleting Announcement","");
      echo "<head>";
      echo "<title>Deleting Announcement</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  $anid = htmlspecialchars(mysql_real_escape_string($_GET["anid"]));
  $uid = getuid_sid($sid);
    echo "<p align=\"center\">";
    $pid = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_announcements WHERE id='".$anid."' AND clid='".$clid."'"));
    if(($uid==$pid[0])&&($exs[0]>0))
    {
        $res = @mysql_query("DELETE FROM gyd_announcements WHERE id='".$anid."'");
        if($res)
        {

            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Announcement Deleted";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>Yo can't delete this announcement!";
    }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}

else if($action=="dlcl")
{

  //$uid = getuid_sid($sid);
  addonline(getuid_sid($sid),"Deleting Club","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  $uid = getuid_sid($sid);
    echo "<p align=\"center\">";
    $pid = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    if($uid==$pid[0])
    {
        $res = deleteClub($clid);
        if($res)
        {

            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Club Deleted";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>Yo can't delete this club!";
    }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}
/*
else if($action=="pws")
{

  //$uid = getuid_sid($sid);
  addonline(getuid_sid($sid),"Updating PWS","");
      echo "<head>";
      echo "<title>Updating PWS</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  $imgt = htmlspecialchars(mysql_real_escape_string($_POST["imgt"]));
  $imgo = htmlspecialchars(mysql_real_escape_string($_POST["imgo"]));
  $smsg = htmlspecialchars(mysql_real_escape_string($_POST["smsg"]));
  $thms = htmlspecialchars(mysql_real_escape_string($_POST["thms"]));

  $uid = getuid_sid($sid);
    echo "<p align=\"center\">";
    if($imgt=="idc")
	{
		$imgo = "http://wapbies.com/rwidc.php?id=$uid";
	}else if($imgt == "avt")
	{
		$av = @mysql_fetch_array(mysql_query("SELECT avatar FROM gyd_users WHERE id='".$uid."'"));
		if(strpos($av[0], "http://")===false)
		{
			$av[0] = "".$av[0];
		}
		$imgo = $av[0];
	}else if($imgt=="sml")
	{
		$sml = @mysql_fetch_array(mysql_query("SELECT imgsrc FROM gyd_smilies WHERE scode='".strtolower(trim($imgo))."'"));
		$imgo = "".$sml[0];
	}else
	{
		$imgo = strtolower(trim($imgo));
	}
    $smsg = trim($smsg);
	$isu = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mypage WHERE uid='".$uid."'"));
	if ($isu[0]>0)
	{
		$res = @mysql_query("UPDATE gyd_mypage SET thid='".$thms."', mimg='".$imgo."', msg='".$smsg."' WHERE uid='".$uid."'");
	}else{
		$res = @mysql_query("INSERT INTO gyd_mypage SET uid='".$uid."', thid='".$thms."', mimg='".$imgo."', msg='".$smsg."'");
	}
	//echo mysql_error();
    if($res)
    {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>Your Site updated successfully<br/><br/>";
	echo "<a href=\"users?".getnick_uid($uid)."\">View Your Site</a>";
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
    }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
  echo "</body></html>";
	   exit();
}
*/
else if($action=="dltpl")
{

  //$uid = getuid_sid($sid);
  $tid = htmlspecialchars(mysql_real_escape_string($_GET["tid"]));
  addonline(getuid_sid($sid),"Deleting Poll","");
      echo "<head>";
      echo "<title>Deleting Poll</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_topics WHERE id='".$tid."'"));
        $res = @mysql_query("UPDATE gyd_topics SET pollid='0' WHERE id='".$tid."'");
        if($res)
        {
          $res = @mysql_query("DELETE FROM gyd_presults WHERE pid='".$pid[0]."'");
          $res = @mysql_query("DELETE FROM gyd_polls WHERE id='".$pid[0]."'");
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Poll Deleted";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}

else if($action=="reqjc")
{

  //$uid = getuid_sid($sid);
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  addonline(getuid_sid($sid),"Joining A Club","");
      echo "<head>";
      echo "<title>Joining A Club</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $isin = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$uid."' AND clid='".$clid."'"));
    if($isin[0]==0){
        $res = @mysql_query("INSERT INTO gyd_clubmembers SET uid='".$uid."', clid='".$clid."', accepted='0', points='0', joined='".time()."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Request sent! the club owner should accept your request";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You already in this club or request sent and waiting for acception";
        }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}

else if($action=="unjc")
{

  //$uid = getuid_sid($sid);
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  addonline(getuid_sid($sid),"Unjoining club","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $isin = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$uid."' AND clid='".$clid."'"));
    if($isin[0]>0){
        $res = @mysql_query("DELETE FROM gyd_clubmembers WHERE uid='".$uid."' AND clid='".$clid."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Unjoined club successfully";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You're not a member of this club!";
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
  echo "</body>";
  exit();
}

else if($action=="acm")
{

  //$uid = getuid_sid($sid);
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  $who = htmlspecialchars(mysql_real_escape_string($_GET["who"]));
  addonline(getuid_sid($sid),"Adding a member to club","");
      echo "<head>";
      echo "<title>Adding a member to club</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $cowner = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    if($cowner[0]==$uid){
        $res = @mysql_query("UPDATE gyd_clubmembers SET accepted='1' WHERE clid='".$clid."' AND uid='".$who."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Member added to your club";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This club ain't yours";
        }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  echo "</body></html>";
	   exit();
}
else if($action=="accall")
{

  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));

  addonline(getuid_sid($sid),"Adding a member to club","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $cowner = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    if($cowner[0]==$uid){
        $res = @mysql_query("UPDATE gyd_clubmembers SET accepted='1' WHERE clid='".$clid."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>All Members Accepted";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This club ain't yours";
        }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
   echo "</body></html>";
	   exit();
}
else if($action=="denall")
{

  //$uid = getuid_sid($sid);
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));

  addonline(getuid_sid($sid),"Adding a member to club","");
      echo "<head>";
      echo "<title>Adding a member to club</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $cowner = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    if($cowner[0]==$uid){
        $res = @mysql_query("DELETE FROM gyd_clubmembers WHERE accepted='0' AND clid='".$clid."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>All Members Denied";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This club ain't yours";
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
  echo "</body>";
  exit();
}
else if($action=="dcm")
{

  //$uid = getuid_sid($sid);
  $clid = htmlspecialchars(mysql_real_escape_string($_GET["clid"]));
  $who = htmlspecialchars(mysql_real_escape_string($_GET["who"]));
  addonline(getuid_sid($sid),"Deleting a member from club","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    $cowner = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    if($cowner[0]==$uid){
        $res = @mysql_query("DELETE FROM gyd_clubmembers  WHERE clid='".$clid."' AND uid='".$who."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Member deleted from your club";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!";
        }
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This club ain't yours";
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
  echo "</body>";
  exit();
}

else if($action=="crpoll")
{

  addonline(getuid_sid($sid),"Creating Poll","");
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    //$uid = getuid_sid($sid);
    if(getplusses(getuid_sid($sid))>=25)
    {
    $pid = mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$uid."'"));
        if($pid[0] == 0)
        {
          $pques = htmlspecialchars($_POST["pques"]);
          $opt1 = htmlspecialchars($_POST["opt1"]);
          $opt2 = htmlspecialchars($_POST["opt2"]);
          $opt3 = htmlspecialchars($_POST["opt3"]);
          $opt4 = htmlspecialchars($_POST["opt4"]);
          $opt5 = htmlspecialchars($_POST["opt5"]);
          if((trim($pques)!="")&&(trim($opt1)!="")&&(trim($opt2)!=""))
          {
            $pex = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_polls WHERE pqst LIKE '".$pques."'"));
            if($pex[0]==0)
            {
              $res = @mysql_query("INSERT INTO gyd_polls SET pqst='".$pques."', opt1='".$opt1."', opt2='".$opt2."', opt3='".$opt3."', opt4='".$opt4."', opt5='".$opt5."', pdt='".time()."'");
              if($res)
              {
                $pollid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_polls WHERE pqst='".$pques."' "));
                @mysql_query("UPDATE gyd_users SET pollid='".$pollid[0]."' WHERE id='".$uid."'");
                echo "<img src=\"images/ok.gif\" alt=\"O\"/>Your poll created successfully";
              }else{
                echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Eroor!";
              }
                }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>There's already a poll with the same question";
          }

          }else{
             echo "<img src=\"images/notok.gif\" alt=\"x\"/>The poll must have a question, and at least 2 options";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You already have a poll";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You should have at least 25 plusses to create a poll";

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
  echo "</body>";
  exit();
}
else if($action=="pltpc")
{

  $tid = $_GET["tid"];
  addonline(getuid_sid($sid),"Creating Poll","");
      echo "<head>";
      echo "<title>Creating Poll</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    //$uid = getuid_sid($sid);
    if((getplusses(getuid_sid($sid))>=0)||ismod($uid))
    {
    $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_topics WHERE id='".$tid."'"));
        if($pid[0] == 0)
        {
          $pques = $_POST["pques"];
          $opt1 = $_POST["opt1"];
          $opt2 = $_POST["opt2"];
          $opt3 = $_POST["opt3"];
          $opt4 = $_POST["opt4"];
          $opt5 = $_POST["opt5"];
          if((trim($pques)!="")&&(trim($opt1)!="")&&(trim($opt2)!=""))
          {
            $pex = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_polls WHERE pqst LIKE '".$pques."'"));
            if($pex[0]==0)
            {
              $res = @mysql_query("INSERT INTO gyd_polls SET pqst='".$pques."', opt1='".$opt1."', opt2='".$opt2."', opt3='".$opt3."', opt4='".$opt4."', opt5='".$opt5."', pdt='".time()."'");
             

			 if($res)
              {
                $pollid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_polls WHERE pqst='".$pques."' "));
                @mysql_query("UPDATE gyd_topics SET pollid='".$pollid[0]."' WHERE id='".$tid."'");
                echo "<img src=\"images/ok.gif\" alt=\"O\"/>Your poll created successfully";
              }else{
                echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Eroor!";
              }
                }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>There's already a poll with the same question";
          }

          }else{
             echo "<img src=\"images/notok.gif\" alt=\"x\"/>The poll must have a question, and at least 2 options";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This Topic Already Have A poll";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You should have at least 500 plusses to create a poll";

          }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
   echo "</body></html>";
	   exit();
}
else if($action=="addblg")
{

if(!getplusses(getuid_sid($sid))>0)
    {
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "Only 0 plusses can add blogs<br/><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
  $btitle = $_POST["btitle"];
 
  $msgtxt = $_POST["msgtxt"];
  
  //$qut = $_POST["qut"];
  addonline(getuid_sid($sid),"Adding a blog","");
      echo "<head>";
      echo "<title>Add Blog</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      $crdate = time();
      //$uid = getuid_sid($sid);
      $res = false;

      if((trim($msgtxt)!="")&&(trim($btitle)!=""))
      {
     // $res = @mysql_query("INSERT INTO gyd_blogs SET bowner='".$uid."', bname='".$btitle."', bgdate='".$crdate."', btext='".$msgtxt."'");
      
 $res = @mysql_query("INSERT INTO gyd_blogs (bowner,bname,bgdate,btext) VALUES ('".$uid."','".$btitle."','".$crdate."','".$msgtxt."')");

	  }
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Message Posted Successfully";
      }else{

        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Failed Posting Message, dont use any special character like apostrophe(') in your blog text";
	
      }

      echo "<br/><br/>";
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
  echo "</body>";
  exit();

}


else if($action=="shout")
{
if(account_val_time()==false)
{
echo "<font color='red'><p align='center'><strong>NOTICE</strong></p></font>";
echo "<br /><font color='red'><p align='center'>Sorry, Please note that this your account is new and not yet validated!<br />
Some features are temporarily disabled for unvalidated users like you pending the time you get validated<br />
You must stay online for some minutes to get validated automatically.</p></font></br />";
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
exit;
}
  $shtxt = $_POST["shtxt"];

$uid = getuid_sid($sid);
    addonline(getuid_sid($sid),"Shouting","");

      echo "<head>";
      echo "<title>ShoutBox</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
      if (isshoutblocked(getuid_sid($sid))){
		    echo "You are banned from shouting";
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
    if(getplusses(getuid_sid($sid))<50)
    {
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>You should have at least 50 plusses to shout!";
    }else{
    $shtm = time();
    if(!isblocked($shtxt,$uid) && !newisblocked($shtxt,$uid))
    {
	
$res = @mysql_query("INSERT INTO gyd_shouts (shout,shouter,shtime) VALUES ('".$shtxt."','".$uid."','".$shtm."')");
	
	
	
    $ups = getplusses($uid);
                $ups -= 2;
                @mysql_query("UPDATE gyd_users SET plusses='".$ups."' WHERE id='".$uid."'");

	echo "<br /><img src=\"images/ok.gif\" alt=\"O\"/>Shoutout successfully<br /><br />";
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
	}else{
$bantime = time() + (900*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Post Shout Message<br/><br/>";
    echo "You just shouted a link to one of the crapiest sites on earth<br/> The members of these sites spam here a lot, so go to that site and stay there if you don't like it here<br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>Anti-Spammer</b> auto banned $user for spamming shoutbox', actdt='".time()."'");
    mysql_query("INSERT INTO gyd_pur SET uid='".$uid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic Ban for spamming for a crap site'");
    mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$uid."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via shoutbox)[/b][br/]".$shtxt."', byuid='".$uid."', touid='194', timesent='".$tm."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via shoutbox)[/b][br/]".$shtxt."', byuid='".$uid."', touid='200', timesent='".$tm."'");

    exit();
  }
}

    //echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
    echo "</p>";
     echo "</body>";
    echo "</html>";
}

//////////////////////////////////////////Announce

else if($action=="annc")
{

  $antx = mysql_real_escape_string($_POST["antx"]);
  $clid = mysql_real_escape_string($_GET["clid"]);
    addonline(getuid_sid($sid),"Announcing","");
$cow = mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    $uid = getuid_sid($sid);
      echo "<head>";
      echo "<title>Announcing</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    if($cow[0]!=$uid)
    {
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>This is not your club!";
    }else{
      $shtxt = $shtxt;
    //$uid = getuid_sid($sid);
    $shtm = time();
    $res = mysql_query("INSERT INTO gyd_announcements SET antext='".$antx."', clid='".$clid."', antime='".$shtm."'");
    if($res)
    {
    echo "<img src=\"images/ok.gif\" alt=\"O\"/>Announcement Added!";
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
  echo "</body>";
  exit();
}

else if($action=="rateb")
{

  $brate = $_POST["brate"];
  $bid = $_GET["bid"];
  addonline(getuid_sid($sid),"Rating a blog","");
  //$uid = getuid_sid($sid);

      echo "<head>";
      echo "<title>Rating a blog</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $vb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_brate WHERE uid='".$uid."' AND blogid='".$bid."'"));
  if($vb[0]==0)
  {
    $res = mysql_query("INSERT INTO gyd_brate SET uid='".$uid."', blogid='".$bid."', brate='".$brate."'");
    if($res)
    {
        echo "<img src=\"images/ok.gif\" alt=\"o\"/>Blog rated successfully<br/>";
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
    }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>You have rated this blog before<br/>";
  }
  echo "<br/><br/>";
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
  echo "</body>";
  exit();
}

else if($action=="delfgb")
{

    $mid = $_GET["mid"];
  addonline(getuid_sid($sid),"Deleting GB Message","");
      echo "<head>";
      echo "<title>Deleting GB Message</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  if(candelgb(getuid_sid($sid), $mid))
  {
    $res = mysql_query("DELETE FROM gyd_gbook WHERE id='".$mid."'");
    if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Message Deleted From Guestbook<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete this message";
  }
  echo "<br/><br/>";
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
  echo "</body>";
  exit();
}

else if($action=="delvlt")
{

    $vid = htmlspecialchars(mysql_real_escape_string($_GET["vid"]));
  addonline(getuid_sid($sid),"Deleting Vault Item","");
      echo "<head>";
      echo "<title>Deleting Vault Item</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $itemowner = mysql_fetch_array(mysql_query("SELECT uid FROM gyd_vault WHERE id='".$vid."'"));
  if(isadmin(getuid_sid($sid))||getuid_sid($sid)==$itemowner[0])
  {
    $res = mysql_query("DELETE FROM gyd_vault WHERE id='".$vid."'");
    if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Item Deleted From Vault<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete this item";
  }
  echo "<br/><br/>";
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
  echo "</body>";
  exit();
}

else if($action=="delbl")
{

    $bid = htmlspecialchars(mysql_real_escape_string($_GET["bid"]));
  addonline(getuid_sid($sid),"Deleting A Blog","");
      echo "<head>";
      echo "<title>Deleting A Blog</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  if(candelbl(getuid_sid($sid), $bid))
  {
    $res = mysql_query("DELETE FROM gyd_blogs WHERE id='".$bid."'");
    if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Blog Deleted<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete this blog";
  }
  echo "<br/><br/>";
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
  echo "</body>";
  exit();
}
else if($action=="rpost")
{

  $pid = htmlspecialchars($_GET["pid"]);
  addonline(getuid_sid($sid),"Reporting Post","");
      echo "<head>";
      echo "<title>Reporting Post</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $pinfo = mysql_fetch_array(mysql_query("SELECT reported FROM gyd_posts WHERE id='".$pid."'"));
          if($pinfo[0]=="0")
          {
          $str = mysql_query("UPDATE gyd_posts SET reported='1' WHERE id='".$pid."' ");
          if($str)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Post reported to mods successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't report post at the moment";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>This Post is already reported";
          }
          echo "<br/>";
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
  echo "</body>";
  exit();
}


else if($action=="rtpc")
{

  $tid = $_GET["tid"];
  addonline(getuid_sid($sid),"Reporting Topic","");
      echo "<head>";
      echo "<title>Reporting Topic</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $pinfo = mysql_fetch_array(mysql_query("SELECT reported FROM gyd_topics WHERE id='".$tid."'"));
          if($pinfo[0]=="0")
          {
          $str = mysql_query("UPDATE gyd_topics SET reported='1' WHERE id='".$tid."' ");
          if($str)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>Topic reported to mods successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't report topic at the moment";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>This Topic is already reported";
          }
          echo "<br/>";
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
  echo "</body>";
  exit();

}

else if($action=="bud")
{

  $todo = $_GET["todo"];
  $who = $_GET["who"];
  addonline(getuid_sid($sid),"Adding/Removing Buddy","");
      echo "<head>";
      echo "<title>Adding/Removing Buddy</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
    $unick = getnick_uid($uid);
    $tnick = getnick_uid($who);
  if($todo=="add")
  {
    if(budres($uid,$who)!=3){
    if(arebuds($uid,$who))
    {
      echo "<img src=\"images/notok.gif\" alt=\"x\"/>$tnick is already your buddy<br/>";
    }else if(budres($uid, $who)==0)
    {
        $res = mysql_query("INSERT INTO gyd_buddies SET uid='".$uid."', tid='".$who."', reqdt='".time()."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>A request has been sent to $tnick<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't add $tnick to your buddy list<br/>";
        }
    }
else if(budres($uid, $who)==1)
    {
        $res = mysql_query("UPDATE gyd_buddies SET agreed='1' WHERE uid='".$who."' AND tid='".$uid."'");
        if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>$tnick Added to your buddy list successfully<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't add $tnick to your buddy list<br/>";
        }
    }
    else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't add $tnick to your buddy list<br/>";
    }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't add $tnick to your buddy list<br/>";
    }
  }else if($todo="del")
  {



      $res= mysql_query("DELETE FROM gyd_buddies WHERE (uid='".$uid."' AND tid='".$who."') OR (uid='".$who."' AND tid='".$uid."')");
      if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>$tnick removed from your buddy list<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>can't remove $tnick from your buddy list<br/>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Update buddy message
else if($action=="upbmsg")
{

    addonline(getuid_sid($sid),"Updating Buddy message","");
    $bmsg = $_POST["bmsg"];
      echo "<head>";
      echo "<title>Updating friend message</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);

  $res = mysql_query("UPDATE gyd_users SET budmsg='".$bmsg."' WHERE id='".$uid."'");
  if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Friend message updated successfully<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>can't update your friend message<br/>";
        }
        echo "<br/>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Select Avatar
else if($action=="upav")
{

    addonline(getuid_sid($sid),"Updating Avatar","");
    $avid = $_GET["avid"];
      echo "<head>";
      echo "<title>Updating Avatar</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $avlnk = mysql_fetch_array(mysql_query("SELECT avlink FROM gyd_avatars WHERE id='".$avid."'"));
  $res = mysql_query("UPDATE gyd_users SET avatar='".$avlnk[0]."' WHERE id='".$uid."'");
  if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Avatar Selected<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
        echo "<br/>";

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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Select Avatar
else if($action=="upcm")
{

    addonline(getuid_sid($sid),"Updating Chatmood","");
    $cmid = $_GET["cmid"];
      echo "<head>";
      echo "<title>Updating Chatmood</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $res = mysql_query("UPDATE gyd_users SET chmood='".$cmid."' WHERE id='".$uid."'");
  if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Mood Selected<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
        echo "<br/>";
echo "<a href=\"index.php?action=chat&amp;sid=$sid\">Chat</a><br/>";
echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Give GPs
else if($action=="givegp")
{

    addonline(getuid_sid($sid),"Giving Game Plusses","");
    $who = $_GET["who"];
    $ptg = $_POST["ptg"];
      echo "<head>";
      echo "<title>Giving Game Plusses</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $gpsf = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'"));
  $gpst = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$who."'"));
  if($gpsf[0]>=$ptg){
    $gpsf = $gpsf[0]-$ptg;
    $gpst = $gpst[0]+$ptg;
    $res = mysql_query("UPDATE gyd_users SET gplus='".$gpst."' WHERE id='".$who."'");
  if($res)
        {
          $res = mysql_query("UPDATE gyd_users SET gplus='".$gpsf."' WHERE id='".$uid."'");
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Game Plusses Updated Successfully<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
      }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>You don't have enough GPs to give<br/>";
        }

        echo "<br/>";

echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "</body>";
  exit();
}

//////////////////// add club

else if($action=="addcl")
{

    addonline(getuid_sid($sid),"Adding Club","");
    $clnm = $_POST["clnm"];
    $clds = $_POST["clds"];
    $clrl = $_POST["clrl"];
    $clrl = str_replace("$", "", $clrl);
    $cllg = $_POST["cllg"];
      echo "<head>";
      echo "<title>$sitename</title>";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
    echo "<p align=\"center\">";
    $uid = getuid_sid($sid);
    if(getplusses($uid)>=100)
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."'"));
      if($noi[0]<3)
      {
        if(($clnm=="")||($clds=="")||($clrl==""))
        {
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>Please be sure to fill, club name, description and rules";
        }else{
          $nmex = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE name LIKE '".$clnm."'"));
          if($nmex[0]>0)
          {
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Club Name Already exist";
          }else{
            $res = mysql_query("INSERT INTO gyd_clubs SET name='".$clnm."', owner='".$uid."', description='".$clds."', rules='".$clrl."', logo='".$cllg."', plusses='0', created='".time()."'");
            if($res)
            {
              $clid = mysql_fetch_array(mysql_query("SELECT id FROM gyd_clubs WHERE owner='".$uid."' AND name='".$clnm."'"));
                echo "<img src=\"images/ok.gif\" alt=\"O\"/>Congratulations! you have your own club, your own rules, message board, chatroom, announcements board, 500 club points also for you";
                mysql_query("INSERT INTO gyd_clubmembers SET uid='".$uid."', clid='".$clid[0]."', accepted='1', points='500', joined='".time()."'");
                $ups = getplusses($uid);
                $ups += 50;
                mysql_query("UPDATE gyd_users SET plusses='".$ups."' WHERE id='".$uid."'");
                $fnm = $clnm;
                $cnm = $clnm;
                mysql_query("INSERT INTO gyd_forums SET name='".$fnm."', position='0', cid='0', clubid='".$clid[0]."'");
                mysql_query("INSERT INTO gyd_rooms SET name='".$cnm."', pass='', static='1', mage='0', chposts='0', perms='0', censord='0', freaky='0', lastmsg='".time()."', clubid='".$clid[0]."'");
            }else{
                echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
            }
          }
        }
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>You already have 3 clubs";
      }
      }else{

      echo "<img src=\"images/notok.gif\" alt=\"X\"/>You cant add clubs";
      }


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
    echo "</body>";
	exit();
}
//////////////////////////////////////////Give GPs
else if($action=="batp")
{

    addonline(getuid_sid($sid),"Giving Game Plusses","");
    $who = $_GET["who"];
    $ptg = $_POST["ptbp"];
    $giv = $_POST["giv"];
      echo "<head>";
      echo "<title>Giving Game Plusses</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $judg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".getuid_sid($sid)."'"));
  $gpst = mysql_fetch_array(mysql_query("SELECT battlep FROM gyd_users WHERE id='".$who."'"));
  if(ismod(getuid_sid($sid))||$judg[0]>0)
  {
    if ($giv=="1")
    {
        $gpst = $gpst[0]+$ptg;
    }else{
        $gpst = $gpst[0]-$ptg;
        if($gpst<0)$gpst=0;
    }
    $res = mysql_query("UPDATE gyd_users SET battlep='".$gpst."' WHERE id='".$who."'");
  if($res)
        {
          $vnick = getnick_uid($who);
          if ($giv=="1")
          {
            $ms1 = " Added $ptg points to ";
          }else{
            $ms1 = " removed $ptg points from ";
          }

          mysql_query("INSERT INTO gyd_mlog SET action='bpoints', details='<b>".getnick_uid(getuid_sid($sid))."</b> $ms1  $vnick', actdt='".time()."'");
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Battle Points Updated Successfully<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
      }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't do this<br/>";
        }

        echo "<br/>";

echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "</body>";
  exit();
}

/////////////////////////////Add remove from ignoire list

else if($action=="ign")
{

    addonline(getuid_sid($sid),"Updating ignore list","");
    $todo = $_GET["todo"];
    $who = $_GET["who"];
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $tnick = getnick_uid($who);
  if($todo=="add")
  {
    if(ignoreres($uid, $who)==1)
    {
      $res= mysql_query("INSERT INTO gyd_ignore SET name='".$uid."', target='".$who."'");
    if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>$tnick was added successfully to your ignore list<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error Updating Database<br/>";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>You can't Add $tnick to your ignore list<br/>";
    }
  }else if($todo="del")
  {
    if(ignoreres($uid, $who)==2)
    {
      $res= mysql_query("DELETE FROM gyd_ignore WHERE name='".$uid."' AND target='".$who."'");
      if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>$tnick was deleted successfully from your ignore list<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error Updating Database<br/>";
        }
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>$tnick is not ignored by you<br/>";
      }
  }
  echo "<br/><a href=\"lists.php?action=ignl&amp;sid=$sid\">Ignore List</a><br/>";
echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Update profile
else if($action=="uprof")
{

    addonline(getuid_sid($sid),"Updating profile Settings","");

	$savat = $_POST["savat"];
	
	
  $semail = $_POST["semail"];



  $usite = $_POST["usite"];

  $ubday = $_POST["ubday"];

  $uloc = $_POST["uloc"];

  $usig = $_POST["usig"];
  
  
  $usex = $_POST["usex"];
  $lang = $_POST["lang"];
  $realname = $_POST["realname"];
  $relstatus = $_POST["relstatus"];
    $crn = $_POST["crn"];

      echo "<head>";
      echo "<title>Updating Settings</title>";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  if(isblocked($uloc,$uid) || newisblocked($uloc,$uid) || isblocked($usite,$uid) || newisblocked($usite,$uid) || isblocked($usig,$uid) || newisblocked($usig,$uid) || isblocked($semail,$uid) || newisblocked($semail,$uid))
{
        $bantime = time() + (900*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "You are banned<br/><br/>";
    echo "You just put a crap site link on your profile, <br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    @mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>anti-spammer</b> auto banned $user for spamming with site link on profile', actdt='".time()."'");
    @mysql_query("INSERT INTO gyd_pur SET uid='".$uid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic ban for putting site link on profile'");
    @mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$uid."'");
    @mysql_query("INSERT INTO gyd_private SET text='Got banned for putting site link on profile.lolz', byuid='".$uid."', touid='194', timesent='".$tm."'");
    @mysql_query("INSERT INTO gyd_private SET text='Got banned for putting site link on profile.lolz', byuid='".$uid."', touid='200', timesent='".$tm."'");

      echo "</body>";
      echo "</html>";
      exit();
}
if (! preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', 

                 $semail)) {

echo "<font color='red'><i><strong>Error:</strong> Invalid email address.</i></font><br /><br />";


}

else
{
  //$uid = getuid_sid($sid);
  $res = mysql_query("UPDATE gyd_users SET avatar='".$savat."', email='".$semail."', site='".$usite."', birthday='".$ubday."', location='".$uloc."', signature='".$usig."', sex='".$usex."', realname='".$realname."', relstatus='".$relstatus."' WHERE id='".$uid."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>Your profile was updated successfully<br/>";
  }else{
  //echo mysql_error();
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating your profile<br/>";
  }
  }
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Update smilies
else if($action=="shsml")
{

    addonline(getuid_sid($sid),"Updating Smilies","");
    $act = $_GET["act"];
    $acts = ($act=="dis" ? 0 : 1);
      echo "<head>";
      echo "<title>$sitename</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $res = mysql_query("UPDATE gyd_users SET hvia='".$acts."' WHERE id='".$uid."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>Smilies Visibility updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating your profile<br/>";
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
  echo "</body>";
  exit();
}

//////////////////////////////////////////Change Password

else if($action=="upwd")
{

  addonline(getuid_sid($sid),"Updating Password","");
  $opwd = $_POST["opwd"];
  $npwd = $_POST["npwd"];
  $cpwd = $_POST["cpwd"];
  $pwd = mysql_fetch_array(mysql_query("SELECT pass FROM gyd_users WHERE id='".$uid."'"));
  $epwd = md5($opwd);
  echo "<head>";
  echo "<title>Change Password</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  if($npwd!=$cpwd)
  {
  echo "<img src=\"images/notok.gif\" alt=\"x\"/>Your Password And Confirm Password Doesn't Match<br/>";
  }else if($epwd!=$pwd[0]){
  echo "<img src=\"images/notok.gif\" alt=\"x\"/>Your Old Password Is Incorrect<br/>";
  }else if((strlen($npwd)<3) || (strlen($npwd)>15)){
  echo "<img src=\"images/notok.gif\" alt=\"x\"/>Your Password Should Be Between 3 And 15 Characters<br/>";
  }else{
    $pwd = md5($npwd);
    $res = mysql_query("UPDATE gyd_users SET pass='".$pwd."', passremind='".$npwd ."' WHERE id='".$uid."'");
    if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>Your password was updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating your password<br/>";
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
  echo "</body>";
  exit();
}

/////////////////////Authorisation as Admin////////////////////

else if($action=="wpadm")

{

    addonline(getuid_sid($sid),"About to Enter Admin Area","");
     echo "<head>\n";
	  echo "<title>Admin cp</title>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
	  	  echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />\n";
      echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />\n";
      echo "<meta http-equiv=\"Pragma\" content=\"no-cache\" />\n";
	  echo "</head>";
      echo "<body>";



  echo "<p align=\"center\">";
    $apwd = $_POST["apwd"];

	$uid = getuid_sid($sid);

    $apass = "flex1990";

	if(isadmin($uid) || isowner($uid) || $uid=='194' || $uid=='16' || $uid=='10')

	{

	  if(($apwd)==($apass))

	      {
           echo "<meta http-equiv=\"refresh\" content=\"0; URL=pnwp.php?action=nicemain&amp;sid=$sid\" />";
		  echo "<b><i>Success!!<br /><a href=\"pnwp.php?action=nicemain&amp;sid=$sid\">Click Here</a> To Continue to Admin Control Panel</i></b><br/>"; }

				else {
 $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to bypass admin login page......DANGER.......', actdt='".time()."'");

				  header("location:index.php");
				echo "<b><br />Authorisation Failed!! <br/> Wrong Password! Try Again!</b>"; }

	}

	else{

    echo "<i><b><br />You are not an Admin! Are You?<br/> So Get The Hell Out Of Here!</b></i>";

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
 }

//////////////////////////////////////////Update smilies
else if($action=="profh")
{

    addonline(getuid_sid($sid),"Profile status option","");
    $act = $_GET["act"];
    $acts = ($act=="dis" ? 0 : 1);
      echo "<head>";
      echo "<title>profile status</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  //$uid = getuid_sid($sid);
  $res = mysql_query("UPDATE gyd_users SET viewpro='".$acts."' WHERE id='".getuid_sid($sid)."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>pofile Visibility updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating your profile<br/>";
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
  echo "</body>";
  exit();
}


else{
      echo "<head>";
      echo "<title>Page not found</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
 $user = getnick_sid($sid);
$url = $_SERVER['QUERY_STRING'];
$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='H attempt', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for script destinations in genproc.php?$url', actdt='".time()."'");

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
  echo "</body>";

  exit();
}
?>
</html>
