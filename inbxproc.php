
<?php
session_start();
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");

check_query();

include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

  echo "<head>";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
  echo "<title>Messages</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";

  echo "<body>";
connectdb();
if(isset($_GET['action']))
      {
$action = htmlentities(strip_tags(mysql_real_escape_string($_GET["action"])));
}
if(isset($_GET['sid']))
      {
$sid = htmlentities(strip_tags(mysql_real_escape_string($_GET["sid"])));
}
if(isset($_GET['page']))
      {
$page = htmlentities(strip_tags(mysql_real_escape_string($_GET["page"])));
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

$pmtext = $_POST["pmtext"];

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

echo "<head>";
addonline(getuid_sid($sid),"Just got banned","index.php?action=$action");
  echo "<title>Banned Notice!!!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";

  echo "</head>";

      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
echo "</p>";
  echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
echo "<p align=\"center\"><br />";
      $banto = @mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'"));
echo "<br /><em>You are <b>Banned from wapbies.com</b><br /><br /></em>";

    $banres = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));

      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "<b>Ban Duration:</b> $rmsg<br/><br/>";
       $nick = getnick_uid($banto[2]);
  echo "<b>Ban By: </b>$nick<br/>";
    echo "<b>Ban Reason:</b> $banto[1]";
    echo "<br />";
echo "</p><br />";
      echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";


      echo "</body>";
      echo "</html>";
      exit();
    }






if(isinboxblocked($uid)){
addonline(getuid_sid($sid),"Banned from Messages Menu!","index.php?action=$action");
  echo "<head>";

  echo "<title>Inbox Banned!!</title>";
  echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";

  echo "<body>";
      echo "<p align=\"center\">";


echo "<b><br />You are banned from Messages menu</b><br />";




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


exit();
}



if($action=="sendpm")
{


if($_SESSION['storedmsg']==$pmtext)
{

echo "<font color='red'><p align='center'>Message sent successfully!.</br /><br />";
echo "<i>$pmtext</i>";
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a></div>";
   echo "<h3>";
   echo "wapbies.com &#0169; 2009 - All Right Reserved";
   echo "</h3>";
  echo "</p>";
exit;


}

if(account_val_time()==false)
{
echo "<font color='red'><p align='center'><strong>NOTICE</strong></p></font>";
echo "<br /><font color='red'><p align='center'>Sorry, Please not that this your account is new and not yet validated!<br />
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
  echo "<p align=\"center\">";
  $whonick = getnick_uid($who);
  $byuid = getuid_sid($sid);
  $tm = time();
  $lastpm = @mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  $pmfl = $lastpm[0]+getpmaf();
  if($byuid==1)$pmfl=0;
  if($pmfl<$tm)
  {
    if(!isblocked($pmtext,$byuid) && !newisblocked($pmtext,$byuid))
    {
    if((!isignored($byuid, $who))&&(!istrashed($byuid)))
    {
  $res = @mysql_query("INSERT INTO gyd_private SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");
$_SESSION['storedmsg'] = $pmtext;
  }else{
    $res = true;
  }
  if($res)
  {

    echo "<img src=\"images/ok.gif\" alt=\"O\"/>";
    echo "PM was sent successfully to $whonick<br/><br/>";
    echo stripslashes(parsepm($pmtext, $sid));

  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Send PM to $whonick<br/><br/>";
  }
  }else{
    $bantime = time() + (30*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Send PM to $whonick<br/><br/>";
    echo "You just sent a link to one of the crapiest sites on earth<br/> The members of these sites spam here a lot, so go to that site and stay there if you don't like it here<br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
    @mysql_query("INSERT INTO gyd_pur SET uid='".$byuid."', penalty='1', exid='1', timeto='".$bantime."', pnreas='Banned $byuid: Automatic Ban for spamming for a crap site'");
    @mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$byuid."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via pm to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='194', timesent='".$tm."'");  
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via pm to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='200', timesent='".$tm."'");
exit();
}
  }else{
    $rema = $pmfl - $tm;
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Flood control: Wait for $rema Seconds before sending another pm<br/><br/>";
  }
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
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
else if($action=="sendpopup")
{
if($_SESSION['sentmsg']==$pmtext)
{

echo "<font color='red'><p align='center'>Flash pm sent successfully.</br /><br />";
echo "<i>$pmtext</i>";
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
  echo "<head>";
  echo "<title>Send flash pm</title>";
 
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $pmid = $_GET["pmid"];
$who = htmlentities(strip_tags(mysql_real_escape_string($_GET["who"])));
  $whonick = getnick_uid($who);
  $byuid = getuid_sid($sid);
  $tm = time();
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_popups WHERE byuid='".$byuid."'"));
  $pmfl = $lastpm[0]+getpmaf();
  $pmurd = mysql_query("UPDATE gyd_popups SET unread='0' WHERE id='".$pmid."'");

  if($byuid==1)$pmfl=0;
  if($pmfl>$tm)
  {
  $rema = $pmfl - $tm;
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
  echo "Flood control: $rema Seconds<br/><br/>";
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
  $uid = getuid_sid($sid);

  if (!arebuds($uid, $who) && !iscoder(getuid_sid($sid)) && !isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)) && !$uid=='194' && !$uid=='16' && !$uid=='10')
  {
  echo "<br />$whonick is not in your friend list, add $whonick to your friend list and let $whonick confirm you as friend before sending flash pm to each other............<br/><br/>";
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
if(isignored($uid, $who))
    {
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Failed Sending flash pm to $whonick, $whonick has put you on ignore list...<br/><br/>";
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
else if(newisblocked($pmtext,$byuid))
    {
    $bantime = time() + (28*24*60*60);
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Send PM to $whonick<br/><br/>";
    echo "You just sent a link to one of the crapiest sites on earth<br/> The members of these sites spam here a lot, so go to that site and stay there if you don't like it here<br/> as a result of your stupid action:<br/>1. you have lost your sheild<br/>2. you have lost all your plusses<br/>3. You are BANNED!";
        $user = getnick_sid($sid);
    mysql_query("INSERT INTO gyd_mlog SET action='autoban', details='<b>Autoban</b> auto banned $user for spamming through popups', actdt='".time()."'"); 
    mysql_query("INSERT INTO gyd_pur SET uid='".$byuid."', penalty='1', exid='2', timeto='".$bantime."', pnreas='Banned: Automatic Ban for spamming for a crap site'");
    mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$byuid."'");
    mysql_query("INSERT INTO gyd_popups SET text='".$pmtext."', byuid='".$byuid."', touid='1', timesent='".$tm."'");
    mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via popups to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='194', timesent='".$tm."'");
    mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via popups to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='200', timesent='".$tm."'");

    echo "</p></body></html>";
    exit();
    }
  $res = mysql_query("INSERT INTO gyd_popups SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");
  if($res)
  {

    echo "<img src=\"images/ok.gif\" alt=\"O\"/>";
    echo "Flash pm was sent successfully to $whonick<br/><br/>";
    echo parsepm($pmtext, $sid);
	$_SESSION['sentmsg']=$pmtext;
    }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Failed Sending flash pm to $whonick<br/><br/>";
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
    }

else if($action=="sendto"){

if($_SESSION['senttomsg']==$pmtext)
{

echo "<font color='red'><p align='center'>Message sent successfully.</br /><br />";
echo "<i>$pmtext</i>";
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
echo "<p align=\"center\">";
$pmtou = $_POST["pmtou"];
$who = getuid_nick($pmtou);
if($who==0){
echo "<img src=\"images/notok.gif\" alt=\"x\"/>User does not exist!<br/>";
}else{
$whonick = getnick_uid($who);
addonline(getuid_sid($sid),"Sending mail to $whonick","");
$byuid = getuid_sid($sid);
$tm = time();
$lastpm = @mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
$pmfl = $lastpm[0]+getpmaf();
if($pmfl<$tm){
if(trim($pmtext)!=""){
if(!isblocked($pmtext,$byuid) && !newisblocked($pmtext,$byuid)){
if((!isignored($byuid, $who))&&(!istrashed($byuid))){
$res = @mysql_query("INSERT INTO gyd_private SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");


}else{
$res = false;
}
if($res){
echo "<img src=\"images/ok.gif\" alt=\"O\"/>";
echo "PM was sent successfully to $whonick<br/><br/>";
echo parsepm($pmtext, $sid);
$_SESSION['senttomsg']=$pmtext;
$totin=mysql_fetch_array(mysql_query("SELECT totin FROM gyd_users WHERE
id='$who'"));
$totout=mysql_fetch_array(mysql_query("SELECT totout FROM gyd_users WHERE id='$byuid'"));
$totin[0]++;
$totout[0]++;
@mysql_query("UPDATE gyd_users SET totin='$totin[0]' WHERE id='$who'");
@mysql_query("UPDATE gyd_users SET totout='$totout[0]' WHERE id='$byuid'");
}else{
echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
echo "Your message wasn't sent because either $whonick has put you in his/her ignore list or your outgoing messaging has been barred by an admin!<br/><br/>";
}
}else{
$bantime = time() + (7*24*60*60);
echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
echo "Can't Send PM to $whonick<br/><br/>";
echo "Read Site Rules! You have lost your shield. You have lost all your plussess. You are BANNED!";
@mysql_query("INSERT INTO gyd_pur SET uid='".$byuid."', penalty='1', exid='1', timeto='".$bantime."', pnreas='Banned: Automatic ban for spamming.'");
@mysql_query("UPDATE gyd_users SET plusses='0', shield='0' WHERE id='".$byuid."'");
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via composed pm to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='194', timesent='".$tm."'");  
    @mysql_query("INSERT INTO gyd_private SET text='[b](forwarded spam via composed pm to $whonick)[/b][br/]".$pmtext."', byuid='".$byuid."', touid='200', timesent='".$tm."'");
exit();
}
}
else{
echo "You tried to send a blank message! Please go back and compose your message correctly.";
}
}else{
$rema = $pmfl - $tm;
echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
echo "Flood control: $rema Seconds<br/><br/>";
}
}
echo "<br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to Messages</a><br/>";
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
else if($action=="proc")
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
    $pmact = $_POST["pmact"];
    $pact = explode("-",$pmact);
    $pmid = $pact[1];
    $pact = $pact[0];

    echo "<p align=\"center\">";
    $pminfo = @mysql_fetch_array(mysql_query("SELECT text, byuid, touid, reported FROM gyd_private WHERE id='".$pmid."'"));
    if($pact=="rep")
    {
      addonline(getuid_sid($sid),"Sending PM","");

      $whonick = getnick_uid($pminfo[1]);
  echo "Composing PM $whonick<br/><br/>";
  ?>
  <!--
  <strong><u>Warning:</u> <br /><small>Please note that you will get banned if you tried putting site links in your pm messages.
  <br />
  Sending of sites links is considered as spamming and its uncalled-for. We strongly prohibit spamming. 
  <br />Your site will be closed and your account username on wapbies will be canceled.<br />
  Be warned!(Ayoomo9 &amp; Xola)</small></strong><br /><br />
  -->
  <?php
  echo "<form action=\"inbxproc.php?action=sendpm&amp;who=$pminfo[1]&amp;sid=$sid\" method=\"post\">";
  echo "<textarea name=\"pmtext\" maxlength=\"500\"/></textarea><br/>";
  echo "<input type=\"submit\" value=\"Send\"/>";
echo "</form>";

    }else if($pact=="del")
    {
        addonline(getuid_sid($sid),"Deleting PM","");
        if(getuid_sid($sid)==$pminfo[2])
        {
          if($pminfo[3]=="1")
          {

            echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is reported, so it can't be deleted";
          }else{
          $del = @mysql_query("DELETE FROM gyd_private WHERE id='".$pmid."' ");
          if($del)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM deleted successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>You Can't Delete PM at the moment";
          }
          }

        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }else if($pact=="str")
    {
        addonline(getuid_sid($sid),"Starring PM","");
        if(getuid_sid($sid)==$pminfo[2])
        {
          $str = @mysql_query("UPDATE gyd_private SET starred='1' WHERE id='".$pmid."' ");
          if($str)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM starred successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't star PM at the moment";
          }
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }else if($pact=="ust")
    {
        addonline(getuid_sid($sid),"Unstarring PM","");
        if(getuid_sid($sid)==$pminfo[2])
        {
          $str = @mysql_query("UPDATE gyd_private SET starred='0' WHERE id='".$pmid."' ");
          if($str)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM unstarred successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't unstar PM at the moment";
          }
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }else if($pact=="rpt")
    {
        addonline(getuid_sid($sid),"Reporting PM","");
        if(getuid_sid($sid)==$pminfo[2])
        {
          if($pminfo[3]=="0")
          {
          $str = @mysql_query("UPDATE gyd_private SET reported='1' WHERE id='".$pmid."' ");
          if($str)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>PM reported to staffs successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't report PM at the moment";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is already reported";
          }
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }
  else if($pact=="frd")
    {
        addonline(getuid_sid($sid),"Forwarding Inbox","");
        if(getuid_sid($sid)==$pminfo[2]||getuid_sid($sid)==$pminfo[1])
        {
  echo "<form action=\"inbxproc.php?action=frdpm&amp;sid=$sid\" method=\"post\">";
  echo "Forward to e-mail:<br/><br/>";
  echo "<input name=\"email\" maxlength=\"250\"/><br/><input type=\"hidden\" value=\"$pmid\" name=\"pmid\"><br/>";
  echo "<input type=\"Submit\" name=\"forward\" Value=\"Forward\"></form>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }
  else if($pact=="dnl")
    {
        addonline(getuid_sid($sid),"Downloading PM","");
        if(getuid_sid($sid)==$pminfo[2]||getuid_sid($sid)==$pminfo[1])
        {
          echo "<img src=\"images/ok.gif\" alt=\"X\"/>request processed successfully<br/><br/>";
      echo "<a href=\"rwdpm.php?action=dpm&amp;pmid=$pmid&amp;sid=$sid\">Download PM</a>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
        }
    }
    echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
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

else if($action=="proall")
{
    $pact = $_POST["pmact"];

    echo "<p align=\"center\">";
    addonline(getuid_sid($sid),"Deleting PMs","");
      $uid = getuid_sid($sid);
    if($pact=="ust")
    {

      $del = @mysql_query("DELETE FROM gyd_private WHERE touid='".$uid."' AND reported !='1' AND starred='0' And unread='0'");
      if($del)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>All PMS except starred and unread are deleted successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't Delete PM at the moment";
          }
    }else if($pact=="red")
    {

        $del = @mysql_query("DELETE FROM gyd_private WHERE touid='".$uid."' AND reported !='1' and unread='0'");
      if($del)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>All PMS except unread, including starred are deleted successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't Delete PM at the moment";
          }

    }else if($pact=="all")
    {
        $del = @mysql_query("DELETE FROM gyd_private WHERE touid='".$uid."' AND reported !='1'");
      if($del)
          {
            echo "<img src=\"images/ok.gif\" alt=\"O\"/>All PMS except reported, including starred and unread are deleted successfully";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"X\"/>Can't Delete PM at the moment";
          }
    }

    echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
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
else if($action=="frdpm")
{
  $email = $_POST["email"];
  $pmid = $_POST["pmid"];
  addonline(getuid_sid($sid),"Forwarding PM","");

  echo "<p align=\"center\">";

  $pminfo = @mysql_fetch_array(mysql_query("SELECT text, byuid, timesent,touid, reported FROM gyd_private WHERE id='".$pmid."'"));


  if(($pminfo[3]==getuid_sid($sid))||($pminfo[1]==getuid_sid($sid)))
  {
  $from_head = "From: noreply@$sitename";
  $subject = "PM By ".getnick_uid($pminfo[1])." To ".getnick_uid($pminfo[3])." (wapbies.com)";
  $content = "Date: ".date("l d/m/y H:i:s", $pminfo[2])."\n\n";
  $content .= $pminfo[0]."\n------------------------\n";
  $content .= "$sitename: The best mobile web community!";
  mail($email, $subject, $content, $from_head);
 echo "<img src=\"images/ok.gif\" alt=\"X\"/>PM forwarded to $email";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>This PM is probably already deleted";
  }
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
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


}

  else{
    addonline(getuid_sid($sid),"Lost in inbox lol","");

  echo "<p align=\"center\">";
  echo "Page not found<br/><br/>";
  header('location:index.php');
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
  echo "</html>";

?>