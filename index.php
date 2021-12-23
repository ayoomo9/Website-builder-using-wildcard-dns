<?php 
include_once('antif.php');

?>

<?php


########################################################################################################################
#/////////////////* THIS SCRIPT EDITED BY AYOOMO9 AND DOWNLOADED FROM wapbies.com*/////////////////////////////////////#
#///This script allow users to chat and make friends for free on your site/////////////////////////////////////////////#
#////////////////You must not edit or remove this note/////////////////////////////////////////////////////////////////#
#//////The licence of this script remain valid except if you remove my copyright//////////////////////////////////#
#//////////I have all the the right to contact your hosting company and have it removed from your folder///////////////#
#///////////////////If you got any problem about making it work, just send me an email ayoomo9@yahoo.com///////////////#
#////////////////////////////Get more free scripts at wapbies.com//////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
########################################################################################################################

require_once("config_cgh.php");
require("sec.php");

require_once("core.php");

//check_injection();
check_query();
check_browser();

 include_once('header.php');
echo "\n<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">\n";
echo "\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
?><head>
<!--
<script src="rotate.js" type="text/javascript"></script>
<script src="gtext.js" type="text/javascript"></script>
-->
<script src="prt.js" type="text/javascript"></script>

<meta http-equiv="expires" content="0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" type="image/x-icon" href="images/ni.png" />
<link rel="StyleSheet" type="text/css" media="all" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="author" content="Omotosho Ayokanmi" />
<meta name="copyright" content="Copyright Omotosho Ayokanmi" />
<meta name="revisit-after" content="7 days" />
<meta name="distribution" content="Global" />
<meta name="rating" content="general" />
<meta name="keywords" content="wapbies.com, unlimited free downloads,
unlimited sex video, nigeria movie industry, free unlimited game download,
mobile advert, film show, naked virgin, gameloft games, all tricks,
google hacking, website hacking, software serials, games serials,
downloadswapbies, wapsite, waec, neco, jamb, unilag, kwara poly,
registeration, secret, post ume, answers, wapsites, mobile.web.tr,
lust, hack, mtn, celtel, zain, glo, multilinks, starcomms, free browsing,
all network free browsing, nigeria free browsing, browsing cheatz, nigeria browsing,
nigeria wapmaster, free, porn, 2wap.org, porno,video, google, yahoo, videos, video,
mp3, eminem, anal, gay, lesbian, hard, big cook, nude, chat, mstream, nude chat,
live chat, uk, england, mobile phone porn, Cell porn, adult mobile, mobile babes,
Sexbymobi, Free Sex Videos, Free Porn Movies, Free Sex Pictures, Sex Movies,
Escorts, naughty, free sex pics, free sex pictures, free porn videos,
free nude pics, erotic stories, erotic story, escort listings, porn,sexbymobi, videos,
video, mp3, download, free download, google, yahoo, eminem, anal, gay, lesbian,
hard, big cook, nude, chat, mstream, nude chat, live chat, uk, england,
free female escorts, male escorts, shemale escorts, sex search phone sex, nokia ,
sonyericsson ,samsung, iphone, wapmasters, wapmaster wap master, wap porn,
phone porn, mobile adult london, ass, asslicking, mature, hardcore, teen, 3gp,
mobile, mobille, usa, download, mobil, fucking, fuck, group, amateur, amater, sex,
sucking, licking, south africa twilightwap.com, fun chat, jamplace, free games 3gp,
videos, mp3, ringtones, albums, full mp3, sex, sex videos, chat, amateursex,
amateur sex, downloads, java games, teen fuck, sms, wap, mobilefree, community,
forums, Nigeria, wap, communicate, lavalair, .com, .net, mobile,wap, chat, forums,
downloads, ringtones, mp3, info, search, business, direct, scripts, ayo, nigeria,
hosting, free site, football, cheatz, mtn free browsing, glo free browsing,
zain free browsing, multilinks free browsing, starcomms free browsing, .co.cc,
free domain, free girls, celtel, nairaland.com, nairaland, mocospace.com, community,
Ayo, Omotosho, Ayokanmi, ayoomo9, ayoomo, forum, unaab, love, stories, money, free money,
free website, computer, microsoft, entertainment, news football, news, chelsea,
man united, bacerlona, soccer, celebs, live cams, love, bible, forex, messages,
sms, personals, advertise, clubs, downloads" />
<meta name="MSSmartTagsPreventParsing" content="True" />

</head>
<?php
echo "<body>";

$bcon = @connectdb();
if (!$bcon)
{

    echo "<head>";
    echo "<title>Server is offline</title>";
echo "<meta http-equiv=\"refresh\" content=\"3; URL=index.php\" />";
    echo "</head>";
    echo "<body>";
  echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
    echo "<p align=\"center\">";
    echo "<img src=\"images/notok.gif\" alt=\"!\"/><br/>";
    echo "<strong>Wapbies Server is temporarily offline...<br />Backup proccess is going on, please keep refreshing your browser or come back after some minutes</strong>";
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";
    echo "</p>";
    echo "</body>";
    echo "</html>";
    exit();
}
$brws = explode(" ",$_SERVER[HTTP_USER_AGENT] );
$ubr = $brws[0];
$uip = getip();
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

$who = $_GET["who"];
	  if(!is_numeric($who))
	  {
header('location:index.php');
exit;
	  }
}

$uid = getuid_sid($sid);

//update is fucking details before any other shit
$res = @mysql_query("UPDATE gyd_users SET browserm='".$ubr."', ipadd='".$uip."' WHERE id='".getuid_sid($sid)."'");

if(account_val_time()==false)
{
echo "<font color='red'><p align='center'><strong>NOTICE</strong></p></font>";
echo "<br /><font color='red'><p align='center'>Please note that your account is not yet <strong>validated</strong>!, just stay online to get validated automatically.<br />
And you might be so lucky to get validated instantly(manually) if a staff is online at present.
<br />You can browse(read) through the forum topics, read inbox messages, chat with people in the chat rooms, view profiles, upload your pictures to the gallery and some other nice things pending the time you get validated.
</p></font><hr /></br />";

}

cleardata();
if(isipbanned($uip,$ubr))
  {
if(!isshield(getuid_sid($sid)))
  {
  echo "<head>";
  echo "<title>Ip Blocked!!!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  //header('Location:http://easymobad.com');
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  echo "<img src=\"images/notok.gif\" alt=\"!\"/>";
echo "</p>";
    echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
echo "<p align=\"center\">";
  echo "<b>This IP address is blocked!!!</b><br />";
  echo "<br />";
  echo "How ever we grant a shield against IP-Ban for our great users, you can try to see if you are shielded by trying to log-in, if you kept coming to this page that means you are not shielded, so come back when the ip-ban period is over<br/><br/>";
  $banto = @mysql_fetch_array(mysql_query("SELECT  timeto FROM gyd_pur WHERE  penalty='2' AND ipadd='".$uip."' AND browserm='".$ubr."' LIMIT 1 "));
  $remain =  $banto[0] - time();
  $rmsg = gettimemsg($remain);
  echo "<b>Time Left: </b>$rmsg<br/>";
  echo "</p>";
  echo "<center>";

echo "<form action=\"login.php\" method=\"GET\">";
  echo "<br /><u>User Name</u><br/> <input name=\"loguid\" format=\"*x\" maxlength=\"9\"/><br/>";
  echo "<u>Password</u><br/> <input type=\"password\" name=\"logpwd\" maxlength=\"9\"/><br/>";
echo "<input type=\"submit\" value=\"Login\"/>";
echo "</form>";
echo "</center>";
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";
      echo "</body>";
      echo "</html>";
      exit();
      }
   }

if(($action != "") && ($action != "faqs") && ($action!="terms") && ($action!="gviewfrm") && ($action!="gviewuser") && ($action!="gadvert") && ($action!="gviewcat") && ($action!="gforumindx") && ($action!="forumindx") && ($action!="viewuser"))
  {
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
    }




if(isbanned($uid))
    {


echo "<head>";
addonline(getuid_sid($sid),"Just got banned. lol","index.php?action=$action");
  echo "<title>Banned Notice!!!</title>";
  echo "</head>";

      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
echo "</p>";
  echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
echo "<p align=\"center\"><br />";
      $banto = @mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'"));
echo "<br /><em>You are <b>Banned from $sitename</b><br /><br /></em>";

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



////////////////////////////////////////MAIN PAGE
if($action=="main")
{

echo "<head>";

  echo "<title>Wapbies - Home (".getnumonline().")</title>";

  echo "</head>";
  addvisitor();
  addonline(getuid_sid($sid),"Main page","index.php?action=$action");
  //saveuinfo($sid);

  echo "<p align=\"center\">";



  ///////////////TIME FUNCTIONS////////////////////////
$TimeZone="0"; ////Change the TimeZone accordingly!
$New_Time = time() + ($TimeZone * 60 * 60);

$show_date=date("D dS F, Y",$New_Time);
$show_time=date("H:i",$New_Time);
$Hour=date("g:i:a",$New_Time);
   // echo "".date("D, d F Y  ")."\n";
//echo "<a href=\"time.php?sid=$sid\">".date("H:i")."</a></small><br/>";
//echo "".date("D dS F, Y",strtotime("-0 hours"))."\n";
//echo " - <a href=\"time.php?sid=$sid\">$Hour</a><br/>";
   echo "".date("l jS F Y")."\n<br />";
//echo "<a href=\"#\">".date("g:i a")."</a>";
echo logo();
   $nick = getnick_sid($sid);
////////////////////TIME FUNCTIONS ENDS/////////////////



///////////////////bank counter////////////
$now = time();
$start=date("Y-m-d")." 23:50:00";
$end=date("Y-m-d")." 23:50:10";
$tstamp1=strtotime($start);
$tstamp2=strtotime($end);if($now>$tstamp1 && $now<$tstamp2) { $sql = 'UPDATE `gyd_users` SET `bank` = `bank` * 1.05 WHERE `bank` > 100';
mysql_query($sql);}
/////////////////bank counter end/////////////////////////

  

/////////////PROGRAMMED GREETINGS/////////////
echo '<p align="center"><tt><br />';
$grt = date("D");
if ($grt=="Mon") { echo "$nick, Wishing you a wonderful Monday!"; }

else if ($grt=="Tue") { echo "$nick, Wishing you a wonderful Tuesday!"; }

else if ($grt=="Wed") { echo "$nick, Wishing you a wonderful Wednesday!"; }

else if ($grt=="Thu") { echo "$nick, Wishing you a wonderful Thursday!"; }
else if ($grt=="Sun") { echo "$nick, Happy Sunday!"; }

else { echo "$nick, Have a nice weekend!";}
echo '</tt>';
///////////////////////////////////////////////////////////////////////



////////////////FORUM MESSAGE BY ADMIN////////////////////
  $fmsg = parsemsg(getfmsg(),$sid);
  echo "<div class=\"adminmsg\"><i>$fmsg</i></div>";
 echo "<p align=\"center\">";
  echo getshoutbox($sid);
  echo "</p>";
  ////////////////////////////////////////////////////////////
   $ope = $_SERVER['HTTP_USER_AGENT'];
   $brws = explode(" ",$ope);
   $brws[0] = strtoupper($brws[0]);

   echo "<br /><div class=\"ads\">";
include('admob.php');
  echo "</div><br />";






////////FORUM NEWS(LAST POST)///////////////////////
echo  "<div class=\"ahtop\">";
$sql = @mysql_fetch_array(mysql_query("SELECT a.name, b.uid, dtpost, b.tid
FROM gyd_topics a
INNER JOIN gyd_posts b ON a.id = b.tid
ORDER BY b.id DESC
LIMIT 1"));
$a = htmlspecialchars($sql[0]);
      $b = getnick_uid($sql[1]);
      $c = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$sql[3]&amp;go=last\">$a</a>";
      $d = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$sql[1]\">$b</a>";
     $tmstamp = $sql[2];
  $tremain = time()-$tmstamp;

  $tmdt = gettimemsg($tremain)." ago"; ////////////////////this is the time thing
echo "<marquee scrollamount=\"2\" scrolldelay=\"5\">";
echo "<tt><strong>Forum News:</strong>  <i>$d  <font color='red'>just commented in the topic titled '$c' $tmdt</font></i></tt>";
echo "</marquee>";
echo "</div>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}
  echo popup($sid);
/////////////////////////////////////////////////////////////////////////////////////

/*
 $chts = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline"));
  if($chts[0]>0)
  {
  echo "<div class='preview'>";
    echo "<a href=\"lists.php?action=reqs&amp;sid=$sid\"><blink><small>$chts[0] member(s) is now in the chat room.</small></a></blink>";
  echo "</div>";
  }

*/








  echo "<p align='left'>";
  ///////////////////////MESSAGES PROCCESS/////////////////////////////////////////////
   $tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
  echo "<a href=\"inbox.php?action=main&amp;sid=$sid\" title='Access messgage box'><img src=\"images/main/inbox1.gif\" alt=\"x\"/> Message Box($umsg/$tmsg)</a><br />";


 ///////////////////////////////////////////////////////////////////////////////////////////



  $chs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline"));
  echo "<a href=\"index.php?action=chat&amp;sid=$sid\" title='start chatting with interesting people'><img src=\"images/main/chat.gif\" alt=\"x\"/> Chat Rooms($chs[0])</a><br />";
  $topics = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics"));
  $posts = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts"));
 echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\" title='Access lots of interesting forum topics and discussions'><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums($topics[0]/$posts[0])</a><br />";
  $chs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs"));
  echo "<a href=\"index.php?action=clmenu&amp;sid=$sid\" title='View members club, also create yours for free'><img src=\"images/main/clubs.gif\" alt=\"x\"/> Users Clubs($chs[0])</a>";
  $uid = getuid_sid($sid);
  $mybuds = getnbuds($uid);
  $onbuds = getonbuds($uid);
  echo "<br /><a href=\"lists.php?action=buds&amp;sid=$sid\"><img src=\"images/main/buddies.gif\" alt=\"x\"/> My Friends($onbuds/$mybuds)</a>";
  $reqs = getnreqs($uid);
  if($reqs>0)
  {
  echo "<div class='preview'>";
    echo "<a href=\"lists.php?action=reqs&amp;sid=$sid\"><blink>You have $reqs friend request.</a></blink>";
  echo "</div>";
  }
  echo "<br />";

  echo "<a href=\"index.php?action=funm&amp;sid=$sid\"><img src=\"images/main/games.gif\" alt=\"x\"/> Utilities & Games</a><br />";

  $noip = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery"));
 echo "<a href=\"usergallery.php?action=main&amp;sid=$sid\"><img src=\"images/main/usergallery.gif\" alt=\"x\"/> Photo Gallery($noip[0])</a><br/>";
  //$noi2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads"));
//echo "<a href=\"share.php?action=main&amp;sid=$sid\"><img src=\"images/main/downloads.gif\" alt=\"x\"/> Download/Upload($noi2[0])</a><br />";
 echo "<a href=\"index.php?action=chapel&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Marriage Chapel</a><br/>";

 echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\"><img src=\"images/main/cpanel.gif\" alt=\"x\"/> My Cpanel</a>";
   
   if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
	echo " [";
  $check = mysql_fetch_array(mysql_query("SELECT show_online FROM gyd_users WHERE id='".$uid."'"));

  if($check[0]==1)
 {
    echo "<a href='index.php?action=hide_online&amp;sid=$sid' style='text-decoration:none;'>H</a>]";
}
else
{
    echo "<a href='index.php?action=show_online&amp;sid=$sid' style='text-decoration:none;'>S</a>]";
}
}

  echo "<br />";
    echo "<br /><a href=\"index.php?action=mystatus&amp;sid=$sid\"><img src=\"images/new.gif\" alt=\"x\"/> My Status</a><br />";
    echo "<br /><a href=\"index.php?action=freep&amp;sid=$sid\"><img src=\"images/new.gif\" alt=\"x\"/> Get Free plusses</a><br />";
    echo "<br /><a href=\"index.php?action=provf&amp;sid=$sid\"><img src=\"images/new.gif\" alt=\"x\"/> Create Nokia s40 prov</a><br /><br />";

  echo "</p>";

  echo "<center>";

  echo "Who's Online?: <a href=\"index.php?action=online&amp;sid=$sid\">".getnumonline()."</a>";
  $timeout = 180;
  $timeon = time()-$timeout;
  echo "<br/>";
  $memid = @mysql_fetch_array(mysql_query("SELECT id, name  FROM gyd_users ORDER BY regdate DESC LIMIT 0,1"));

$nopl = @mysql_fetch_array(mysql_query("SELECT regdate FROM gyd_users WHERE id='".$memid[0]."'"));
  $membrage = time() - $nopl[0];
  $membrage = gettimemsg($membrage)." ago";
  echo '<tt>';
  echo "<b><i><a href=\"index.php?action=viewuser&amp;who=$memid[0]&amp;sid=$sid\">$memid[1]</a></i></b> Joined wapbies &#8226; $membrage<br/>";
  echo '</tt>';


   echo "<br /><div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div><br />";
  //echo "<br />";
  echo "<div class=\"font\">[<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " ] ";

   echo "[<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " ] ";
  echo "[<a href=\"index.php?action=uset&amp;sid=$sid\"><img src=\"images/star.gif\" alt=\"x\"/> Profile</a>";
      echo " ] ";
	    if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
  echo "[<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/main/stats.gif\" alt=\"x\"/> Site Stats</a>";
   echo " ] ";
   }

// if(isadmin($uid) || iscoder($uid) || ismod($uid) || isowner($uid) || $uid==194 || $uid==16)
 // {

  echo "[<a href=\"index.php?action=logout&amp;sid=$sid\" title='Logout to destroy your session'>LogOut</a>]<br /></div>";
//}
//else
//{
 // echo "[<a href=\"http://easymobad.com/adServelet?rm=NGFkMGFINzYxMDQ0Yw==\">LogOut</a>]<br /></div>";
  //}
  if (ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
     echo "<br /><a href=\"codercp.php?action=main&sid=$sid\" title='Staff control panel' style='text-decoration:none;'> <strong>STAFF CP</strong></a>";
   }
 /*echo "<br/>";
   if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
  $check = mysql_fetch_array(mysql_query("SELECT show_online FROM gyd_users WHERE id='".$uid."'"));

  if($check[0]==1)
 {
    echo "<a href='index.php?action=hide_online&amp;sid=$sid' style='text-decoration:none;'>H</a>";
}
else
{
    echo "<a href='index.php?action=show_online&amp;sid=$sid' style='text-decoration:none;'>S</a>";
}
}*/
  echo "<hr />";
     $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE ase>'5' AND lastact>'".$timeon."' AND show_online='1'"));
  if ($noi[0] >= 1)
  {
  echo "<i><b>$noi[0] staff online @ wapbies.com</i></b>";
  }
  echo "</center>";
   echo "</body></html>";

      exit();
}
elseif($action=="provf")
{
$nickn = getnick_sid($sid);
echo "<title>s40 Prov file Generator</title>";
  addonline(getuid_sid($sid),"Creating Nokia s40 series prov file","index.php?action=$action");

  ?>
  <p align='center'>
  <strong>CREATE S40 PROV FOR ANY NETWORK</strong><br /><br />
  </p>
 <?php
echo "<div class='ads'>";

include('admob.php');
echo "</div>";
?>
<?
if($_POST['ip']==""){
?>
<br/>
<div align="left">

<em><div style='padding:5px;'>Hello <em><strong><?=$nickn;?></strong></em>, the free tool below is easy to use and straight foward, it allow you to create a provisional file(.prov) online for any network and download to use for your S40 phones browsing profile settings.<br />
<br />
Please note that this is just a beta(testing) version, so pardon us incase you encounter any error during use, all bugs will be fixed soon after we compile all response from you(users).</div>
<br/>
</em>
<span style='padding:5px;'>Need any technical help? send email to <a href='mailto:admin@wapbies.com'>admin@wapbies.com</a> or pm <a href='index.php?action=viewuser&who=1&sid=<?=$sid;?>'><strong>ayoomo9</strong></a> for fast response.</span><br/><br/>

<form action="index.php?action=<?=$action;?>&sid=<?=$sid;?>" method="post">
Network: <br/><select name='network'>
<option value='MTN'>MTN Network</option>
<option value='GLO'>GLO Mobile Network</option>
<option value='ZAIN'>ZAIN Network</option>
<option value='ETISALAT'>Etisalat Network</option>
<option value='AIRTEL'>AIRTEL Network</option>
<option value='VODAFONE'>VODAFONE Network</option>
<option value='UNSPECIFIED'>Not listed here</option>

</select><br/>
Created By(<small>e.g Ayoomo9</small>): <br/><input type="text" name="by"/>

<br/>
Access Point: <br/><input type="text" name="access"/><br/>
Proxy Ip Address: <br/><input type="text" name="ip"/><br/>
Proxy Port: <br/><input type="text" name="port"/><br/>
<input type="submit" value="Generate .prov File"/>
</form><br/>
<?
}else{
$stringa = 'j%wapbies.com prov generator ÅFÆV‡wapbies ƒ by wapbiesÆ[‡;Default Rule‡9ƒÆQ‡ƒ‡ƒ
ÆR‡/ƒ
‡ ';
$ip = $_POST['ip'];
$network = $_POST['network'];

$stringb = '‡!…‡0ÆS‡#';
$port = $_POST['port'];
$site = "wapbies.com";
$creator = $_POST['by'];
$stringc = '‡"ƒÆU‡ƒ‡';
$name = "wapbiesprov";
$fn = "$site _ $network _prov _by_ $creator .prov";
$fn = str_replace(" ","",$fn);
$stringd = ' ƒ‡«‡';
$access= $_POST['access'];
$stringe = '‡	‰ÆZ‡š';
$prov = "$stringa$ip$stringb$port$stringc$name$stringd$access$stringe";
$fp = fopen("$fn", 'w');
fwrite($fp,$prov);
fclose($fp);

?>
<br />
<div align='center'><em>Your .prov file has been created successfully, download it below</em></div><br/>
<div align='center'><a href="<?=$fn;?>">Download now</a><br/><br/></div>

<div style='padding:5px;'><strong><em>File Name:</em></strong> <?=$fn;?><br/><br/>
<?PHP
$self = $_SERVER['PHP_SELF'];
$self = explode("/",$self);
?>
<strong><em>Download Link:</em></strong> <a href='http://<?=$_SERVER['HTTP_HOST'];?>/<?=$self[1];?>/<?=$fn;?>'>http://<?=$_SERVER['HTTP_HOST'];?>/<?=$self[1];?>/<?=$fn;?></a><br/><br/>
<strong><em>You can also Copy &amp; paste below link to browser:</em></strong> </div>
<form method='post' action='#'>
<textarea cols='30' rows='3'>http://<?=$_SERVER['HTTP_HOST'];?>/<?=$self[1];?>/<?=$fn;?></textarea>
</form>


<div align='center'><a href="index.php?action=<?=$action;?>&sid=<?=$sid;?>">Create another .prov file</a><br/></div><hr/>
<?
}
?>
<br/>

<?php

echo "<div class='ads'>";
echo admob_request($admob_params);
echo "</div>";
?>
<?php

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

}
elseif($action=="freep")
{
$nickn = getnick_sid($sid);
echo "<title>Free plusses menu</title>";
  addonline(getuid_sid($sid),"Getting free plusses(site coins)","index.php?action=$action");

  ?>
  <p align='center'>
  <strong>GET FREE PLUSSES</strong><br /><br />
  </p>
  <?php
  echo "<br/><div class='ads'>";
include('admob.php');
  echo "</div>";
  ?>
  <br />
  <p>
  <em>
Hello <strong><?=$nickn;?></strong>, This menu is meant for you to earn free plusses and unluck more features for your user account.<br />
To earn plusses, just visit any of the link below as many times as possible and check your plusses to see it increasing rapidly.<br />
So in the meantime, enjoy and keep clicking the links below as fast as possible to get more plusses.<br />
<?php
$ad = random_ads();
$ad2 = random_ads();
$ad3 = random_ads();
$ad4 = random_ads();
$ad5 = random_ads();
echo "$ad";
echo "$ad2";
echo "$ad3";
echo "$ad4";
echo "$ad5";

/*
        $usts = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
        $upl = $usts[0]+1;
        @mysql_query("UPDATE gyd_users SET plusses='".$upl."' WHERE id='".$uid."'");*/
?>

</em>
  </p>
  <br />

  <?php
  echo "<br/><div class='ads'>";
echo admob_request($admob_params);
  echo "</div>";
  ?>
<br /><br />
<?php

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

}
elseif($action=="mystatus")
{
$nickn = getnick_sid($sid);
echo "<title>$nickn detailed status</title>";
  addonline(getuid_sid($sid),"My status on wapbies","index.php?action=$action");

  ?>
  <p align='center'>
  <strong>MY STATUS</strong><br /><br />
  </p>
  <?php
   echo "<br /><div class=\"ads\">";
include('admob.php');
  echo "</div><br />";
  ?>
  <br />
  <p>
   <strong><u>Tip</u>: </strong>Note that you can get your status(plusses e.t.c) on wapbies increased by just inviting members here.<br />
   We have developed an automatic counter system that stores any user(s) you've invited.<br />
   The more you invite people the more your status(plusses e.t.c) will be increased.<br />
   You can be so lucky to be choosen among wapbies staff team if you can invite atleast <strong>20</strong> active members.
  </p><hr />
  <?php
$refers = mysql_fetch_array(mysql_query("SELECT count(*) FROM refer_members WHERE byuid='".$uid."'"));
//$photos = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_usergallery WHERE uid='".$uid."'"));
$plusses = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
print<<<logs
<i>
Total Member(s) refered by me: <strong>$refers[0]</strong><br />
Total Earned plusses: <strong>$plusses[0]</strong><br />
</i>
logs;
?>
  <?php
  echo "<br/><div class='ads'>";
 echo admob_request($admob_params);

 echo "</div>";
  ?>
<br /><br />
<?php

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

}
elseif($action=="show_online")
{
  if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
$update_it = mysql_query("UPDATE gyd_users SET show_online='1' WHERE id='".$uid."'");

if($update_it)
{
echo "<br /><p align='center'>You are now visible to users in the online list</p><br />";
//header('location:index.php?action=main&amp;sid=$sid');
echo "<meta http-equiv=\"refresh\" content=\"3; URL=index.php?action=main&amp;sid=$sid\" />";

}
else
{
echo mysql_error();

}
}else
{
header('location:http://fucking-faggot.com');
}

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

}

elseif($action=="hide_online")
{

  if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
$update_it = mysql_query("UPDATE gyd_users SET show_online='0' WHERE id='".$uid."'");
if(islogged($sid)==true)
{
$remove_from_online = mysql_query("DELETE FROM gyd_online WHERE userid='$uid'");
}

if($update_it)
{
echo "<br /><p align='center'>You are now invisible to users in the online list and your profile will also display you as a offline member</p><br />";
//header('location:index.php?action=main&amp;sid=$sid');
echo "<meta http-equiv=\"refresh\" content=\"3; URL=index.php?action=main&amp;sid=$sid\" />";
}
else
{
echo mysql_error();

}
}
else
{
header('location:http://fucking-faggot.com');
}



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

}
////////////////////////////////////FORUM MENU////////////////////////////////////////////////////////


else if($action=="forumindx")
{

if(isforumblocked($uid)){
  addonline(getuid_sid($sid),"Forum Banned!","index.php?action=$action");
echo "<head><title>Forum Banned!</title></head>";

  echo "<p align=\"center\">";

echo "<br /><b>You are banned from forum Menu</b>";



echo "<div class=\"font\">[<a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
   echo " ] ";

 echo "[<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
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
}
else
{
  addonline(getuid_sid($sid),"Viewing Forum Categories","index.php?action=$action");
    echo "
  <head><title>Forum Index</title></head>";
  echo "<p align=\"center\">";
 echo "<div class='whitegreen'>";
 echo "Wapbies Forums</div>";
  echo "<div class=\"ads\">";

   include('admob.php');
   
   echo "</div>";
echo "<br /></p>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

echo "<p align=\"left\">";
  echo "<a href=\"search.php?action=tpc&amp;sid=$sid\">+ Search Forum</a><br/><br />";
  $fcats = mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id");
  $iml = "<img src=\"images/1.gif\" alt=\"\"/>";
  while($fcat=mysql_fetch_array($fcats))
  {
    $catlink = "<a href=\"index.php?action=viewcat&amp;sid=$sid&amp;cid=$fcat[0]\">$iml$fcat[1]</a>";
    echo "$catlink<br/>";
    $forums = mysql_query("SELECT id, name FROM gyd_forums WHERE cid='".$fcat[0]."' AND clubid='0' ORDER BY position, id, name");
    if(getfview()==0)
    {
    echo "<br/>";
    while($forum=mysql_fetch_array($forums))
        {
  $notp = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$forum[0]."'"));
  $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts a INNER JOIN gyd_topics b ON a.tid = b.id WHERE b.fid='".$forum[0]."'"));
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$forum[0]\">+ $forum[1]($notp[0]/$nops[0])</a><br/>";
      }
    }
	echo "<hr />";
  }
  echo "</p>";
  
  echo "<br/><p align=\"center\">";
  echo "<div class=\"ads\">";
  
  echo admob_request($admob_params);

  echo "</div>";
  //echo "<br />";
echo "<div class=\"font\">[<a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
   echo " ] ";

 echo "[<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
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

  echo "</body></html>";
}
}
//////////////////////////////////////////////////////////////////////////////

else if($action=="clmop")
{

    $clid = $_GET["clid"];
    $who = $_GET["who"];
    addonline(getuid_sid($sid),"Moderating Club Member","index.php?action=$action");
    echo "<head><title>Moderate Member</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
    <meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
    <meta name=\"description\" content=\"wapbies :)\">
    <meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
    echo "<p align=\"center\">";
    $whnick = getnick_uid($who);
    echo "<b>$whnick</b>";
    echo "</p>";
    echo "<p>";
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."' AND clid=".$clid.""));
$cow = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."' AND id=".$clid.""));
if($exs[0]>0 && $cow[0]>0)
{
    echo "<a href=\"genproc.php?action=dcm&amp;sid=$sid&amp;who=$who&amp;clid=$clid\">&#187;Kick $whnick out</a><br/>";
    echo "<a href=\"index.php?action=gcp&amp;sid=$sid&amp;who=$who&amp;clid=$clid\">&#187;$whnick's Club Points</a><br/>";
    echo "<a href=\"index.php?action=gpl&amp;sid=$sid&amp;who=$who&amp;clid=$clid\">&#187;Give $whnick Plusses</a><br/>";
    }else{
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Missing Info!";
    }
    echo "</p>";

    echo "<p align=\"center\">";

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
  echo "</body></html>";

}

else if($action=="gcp")
{
    $clid = $_GET["clid"];
    $who = $_GET["who"];
    addonline(getuid_sid($sid),"Moderating Club Member","index.php?action=$action");
  echo "<head>";
  echo "<title>Moderating Club Member</title>";
  echo "</head>";
    echo "<p align=\"center\">";
    $whnick = getnick_uid($who);
    echo "<b>$whnick</b>";
    echo "</p>";
    echo "<p>";
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."' AND clid=".$clid.""));
$cow = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."' AND id=".$clid.""));
if($exs[0]>0 && $cow[0]>0)
{
    echo "<form action=\"genproc.php?action=gcp&amp;sid=$sid&amp;who=$who&amp;clid=$clid\" method=\"post\">";
    echo "Action: <select name=\"giv\">";
    echo "<option value=\"1\">Add</option>";
    echo "<option value=\"0\">Subtract</option>";
    echo "</select><br/>";
    echo "Points: <input name=\"pnt\" format=\"*N\" size=\"2\" maxlength=\"2\"/><br/>";
    echo "<input type=\"submit\" value=\"GO\"/>";
    echo "</form>";
    }else{
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Missing Info!";
    }
    echo "</p>";

    echo "<p align=\"center\">";
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
    echo "</body></html>";

}

else if($action=="gpl")
{
    $clid = $_GET["clid"];
    $who = $_GET["who"];
    addonline(getuid_sid($sid),"Moderating Club Member","index.php?action=$action");
  echo "<head>";
  echo "<title>Moderating Club Member</title>";
  echo "</head>";
    echo "<p align=\"center\">";
    $whnick = getnick_uid($who);
    echo "<b>$whnick</b>";
    echo "</p>";
    echo "<p>";
    $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."' AND clid=".$clid.""));
$cow = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."' AND id=".$clid.""));
if($exs[0]>0 && $cow[0]>0)
{
    echo "<img src=\"images/point.gif\" alt=\"!\"/>You can only give plusses, these are real plusses, you can't subtract plusses<br/>";
    $cpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_clubs WHERE id='".$clid."'"));
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Your club plusses credit is $cpl[0]<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Do not abuse giving of plusses to users, your club could be deleted<br/><br/>";
    echo "<form action=\"genproc.php?action=gpl&amp;sid=$sid&amp;who=$who&amp;clid=$clid\" method=\"post\">";
    echo "Plusses: <input name=\"pnt\" format=\"*N\" size=\"2\" maxlength=\"2\"/><br/>";
    echo "<input type=\"submit\" value=\"GO\"/>";
    echo "</form>";

    }else{
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Missing Info!";
    }
    echo "</p>";

    echo "<p align=\"center\">";

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

}
///////////////////////////////////Control Panel

else if($action=="cpanel")


{

$nick = getnick_sid($sid);
    addonline(getuid_sid($sid),"Am in my CPanel","index.php?action=$action");
  echo "<head>";
  echo "<title>$nick Control Panel</title>";
  echo "</head>";
    echo "<p align=\"center\">";


    echo "<img src=\"images/cpanel.gif\" alt=\"CPanel\"/>";
  echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
 
    echo "</p>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}


  //echo "<a href=\"index.php?action=rwidc&amp;sid=$sid\">&#187;Wapbies ID card</a><br/>";
  echo "<a href=\"index.php?action=myclub&amp;sid=$sid\">&#187;My Clubs</a><br/>";
  echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$uid\">&#187;View my Profile</a><br/>";
      if(ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
{
    echo "<a href=\"index.php?action=chngpass&amp;sid=$sid\">&#187;Change Password</a><br/>";
   }
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">&#187;Profile Settings</a><br/>";
  echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">&#187;Extended Settings</a><br/>";
    if(ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
{
 echo "<a href=\"lists.php?action=upavat&amp;sid=$sid\">&#187;Upload avatar</a><br/>";
 }
 echo "<a href=\"usergallery.php?action=upload&amp;sid=$sid\">&#187;Upload My Photo</a><br />";
 // echo "<a href=\"index.php?action=pws&amp;sid=$sid\">&#187;Personal Wap site</a><br/>";
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_ignore WHERE name='".$uid."'"));
  echo "<a href=\"lists.php?action=ignl&amp;sid=$sid\">&#187;My Ignore List($noi[0])</a><br/>";
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gbook WHERE gbowner='".$uid."'"));
  echo "<a href=\"lists.php?action=gbook&amp;sid=$sid&amp;who=$uid\">&#187;My Guestbook($noi[0])</a><br/>";
   $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gallery WHERE uid='".$uid."'"));
  echo "<a href=\"index.php?action=poll&amp;sid=$sid\">&#187;My Poll</a><br/>";
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs WHERE bowner='".$uid."'"));
  echo "<a href=\"lists.php?action=blogs&amp;sid=$sid&amp;who=$uid\">&#187;Blogs($noi[0])</a><br/>";
  echo "<a href=\"lists.php?action=chmood&amp;sid=$sid\">&#187;Chat mood</a><br/>";
  echo "<a href=\"lists.php?action=smilies&amp;sid=$sid\">&#187;Smilies/Emoticons</a><br/>";
  echo "<a href=\"lists.php?action=avatars&amp;sid=$sid\">&#187;Available Avatars</a><br/>";
  echo "<a href=\"lists.php?action=bbcode&amp;sid=$sid\">&#187;Useful BBCodes</a><br/>";
  echo "</p>";

    echo "<p align=\"center\">";

  echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";
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
   echo "</body></html>";

}

///////////////////////////////////change password

else if($action=="chngpass")
{


  addonline(getuid_sid($sid),"Am changing my password","index.php?action=$action");
  echo "<head>";
  echo "<title>Change Password</title>";
  echo "</head>";
  echo "<p align=\"center\">";
  echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
  echo "</p>";
 $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}


  echo "<b>Change Password</b>";
  echo "<p>";
  echo "<br /><form action=\"genproc.php?action=upwd&amp;sid=$sid\" method=\"post\">";
  echo "Old Password: <input type=\"password\" name=\"opwd\" style=\"-wap-input-format: '*x'\" maxlength=\"15\"/><br/>";
  echo "New Password: <input type=\"password\" name=\"npwd\" style=\"-wap-input-format: '*x'\" maxlength=\"15\"/><br/>";
  echo "New Password again: <input type=\"password\" name=\"cpwd\" style=\"-wap-input-format: '*x'\" maxlength=\"15\"/><br/>";
  echo "<input type=\"submit\" value=\"Change\"/>";
  echo "</form>";
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";
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
  echo "</body></html>";

}

///////////////////////////////////Control Panel

else if($action=="clmenu")
{

    addonline(getuid_sid($sid),"Clubs Menu","index.php?action=$action");
  echo "<head>";
  echo "<title>Club Menu</title>";
  echo "</head>";
  echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
   echo "<p align=\"center\">";
      echo "<b>Clubs Menu</b><br />";
    echo "</p>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

    echo "<p>";
    $myid = getuid_sid($sid);
  echo "<a href=\"index.php?action=clubs&amp;sid=$sid\">&#187;All Clubs</a><br/>";
  echo "<a href=\"index.php?action=myclub&amp;sid=$sid\">&#187;My Clubs</a><br/>";
  echo "<a href=\"lists.php?action=clm&amp;who=$myid&amp;sid=$sid&amp;who=$uid\">&#187;Clubs I'm a member of</a><br/>";
  echo "<a href=\"lists.php?action=pclb&amp;sid=$sid&amp;who=$uid\">&#187;Clubs By popularity</a><br/>";
  echo "<a href=\"lists.php?action=aclb&amp;sid=$sid&amp;who=$uid\">&#187;Clubs By Activity</a><br/>";
  echo "<a href=\"lists.php?action=rclb&amp;sid=$sid&amp;who=$uid\">&#187;5 Random Clubs</a><br/><br/>";
  $ncl = mysql_fetch_array(mysql_query("SELECT id, name FROM gyd_clubs ORDER BY created DESC LIMIT 1"));
  echo "The Newest Club Is: <a href=\"index.php?action=gocl&amp;clid=$ncl[0]&amp;sid=$sid\">".htmlspecialchars($ncl[1])."</a><br/>";

  echo "</p>";

    echo "<p align=\"center\">";
echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
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
  echo "</body></html>";

}


else if($action=="rwidc")
{
   echo "<head>";
  echo "<title>Id Card</title>";
  echo "</head>";
   addonline(getuid_sid($sid),"Viewing My $site_name ID","index.php?action=$action");
    echo "<p align=\"center\">";
  echo "<b>$site_name! ID card</b><br/>";
    $uid = getuid_sid($sid);
    echo "<img src=\"rwidc.php?id=$uid\" alt=\"ll id\"/><br/><br/>";
    echo "This ID card is updated automatically everytime someone request it, the source to your card is wapbies.com/rwidc.php?id=$uid<br/><br/>";
    echo "you can use it as an avatar in other sites<br/><br/>";
    echo "To look at others cards view the user profile then go to more information&gt;$site_name ID card.";
    echo "</p>";
    echo "<p align=\"center\">";
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
    echo "</body></html>";

}
///////////////////////////////////My Clubs

else if($action=="myclub")
{

echo "<head>";

  echo "<title>My Clubs</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"My Clubs","index.php?action=$action");
    echo "<p align=\"center\">";
    echo "<b><u>My Clubs</b></u>";
    echo "</p>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

    echo "<br /><p>";
    $uid = getuid_sid($sid);
    if(getplusses($uid)<100)
    {
      echo "Clubs are small communities that users can create, every community should have things in common, for example a community for wapmasters, sex freaks, alocholics, rappers and anythin else you can think of, currently people who have more than 100 plusses can only create clubs, every user can create up to maximum of 3 clubs, to get plusses post in the forums, or invite friends";
    }else{
      $uclubs = @mysql_query("SELECT id, name FROM gyd_clubs WHERE owner='".$uid."'");
      while($club=mysql_fetch_array($uclubs))
      {
        echo "<br/><a href=\"index.php?action=gocl&amp;clid=$club[0]&amp;sid=$sid\">$club[1]</a>";
        echo ", <a href=\"genproc.php?action=dlcl&amp;clid=$club[0]&amp;sid=$sid\">[DELETE]</a><br/><br/>";
      }
      $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."'"));
      if($noi[0]<3)
      {
      echo "<a href=\"index.php?action=addcl&amp;sid=$sid\">Add Club</a>";
      }
    }
  echo "</p>";

    echo "<br /><p align=\"center\">";
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
  echo "</body></html>";

}

///////////////////////////////////My Clubs

else if($action=="clubs")
{
echo "<head>";
  echo "<title>Club List</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Viewing My Clubs List","index.php?action=$action");


    echo "<p align=\"center\">";
//echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Great Mobile Sites!!</a>";
    echo "<br /><b>Clubs List</b>";
    echo "</p>";

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, owner, description, created FROM gyd_clubs ORDER BY created DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = @mysql_query($sql);
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $item[1]=htmlspecialchars($item[1]);
        $mems = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$item[0]."' AND accepted='1'"));
      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[0]&amp;sid=$sid\">$item[1]($mems[0])</a>Owner: <a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">".getnick_uid($item[2])."</a>";
      echo "$lnk<br/>";
      echo htmlspecialchars($item[3])."<br/>Creation Date: (".date("d/m/y", $item[4]).")<br/><br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"index.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
    echo "<p align=\"center\">";
  echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
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
   echo "</body></html>";
 
}

else if($action=="gocl")
{
?>
<head>
  <title>Club Menu</title>
  </head>
  <?php
  $clid = $_GET["clid"];
  $clinfo = @mysql_fetch_array(mysql_query("SELECT name, owner, description, rules, logo, plusses, created FROM gyd_clubs WHERE id='".$clid."'"));
    addonline(getuid_sid($sid),"Viewing A Club","index.php?action=$action");
    $clnm = htmlspecialchars($clinfo[0]);
    echo "<p align=\"center\">";
    echo "<b>$clnm</b><br/>";
    /*if(trim($clinfo[4])=="")
    {
      echo "<img src=\"$logo_url\" alt=\"logo\"/>";
    }else{
        echo "<img src=\"$clinfo[4]\" alt=\"logo\"/>";
    }*/
    echo "</p>";
    echo "<p>";
    echo "Club ID: <b>$clid</b><br/>";
    $uid = getuid_sid($sid);
    $cango = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND uid='".$uid."' AND accepted='1'"));
    echo "Owner: <a href=\"index.php?action=viewuser&amp;who=$clinfo[1]&amp;sid=$sid\">".getnick_uid($clinfo[1])."</a><br/>";
      $mems = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='1'"));
      echo "Members: <a href=\"lists.php?action=clmem&amp;sid=$sid&amp;clid=$clid\">$mems[0]</a><br/>";
      echo "Created On: ".date("d/m/y", $clinfo[6])."<br/>";
      echo "Plusses credit: $clinfo[5]<br/>";
      $fid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_forums WHERE clubid='".$clid."'"));
      $rid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_rooms WHERE clubid='".$clid."'"));
      $tps = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid[0]."'"));
      $pss = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts a INNER JOIN gyd_topics b ON a.tid = b.id WHERE b.fid='".$fid[0]."'"));

    if(($cango[0]>0)|| ismod($uid) || iscoder($uid) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
    {
        $noa = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_announcements WHERE clid='".$clid."'"));
        echo "<br/><a href=\"lists.php?action=annc&amp;sid=$sid&amp;clid=$clid\"><img src=\"images/annc.gif\" alt=\"!\"/>Announcements($noa[0])</a><br/>";
        $noa = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chat WHERE rid='".$rid[0]."'"));
        echo "<a href=\"chat.php?sid=$sid&amp;rid=$rid[0]\"><img src=\"images/chat.gif\" alt=\"*\"/>$clnm Chat($noa[0])</a><br/>";
        echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid[0]\"><img src=\"images/1.gif\" alt=\"*\"/>$clnm Forum($tps[0]/$pss[0])</a><br/><br/>";
    $ismem = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND uid='".getuid_sid($sid)."'"));

    if($ismem[0]>0)
    {
      //unjoin
      if($clinfo[1]!=$uid)
      {
        echo "<a href=\"genproc.php?action=unjc&amp;sid=$sid&amp;clid=$clid\">Unjoin Club</a>";
      }
    }else{
      echo "<a href=\"genproc.php?action=reqjc&amp;sid=$sid&amp;clid=$clid\">Join Now!</a>";
    }
if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
    {
      echo "<br/><a href=\"index.php?action=club&amp;sid=$sid&amp;clid=$clid\">Admin Tools</a>";
    }
        if($clinfo[1]==$uid)
      {
        //club owner
        $mems = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='0'"));
        echo "<br/><a href=\"lists.php?action=clreq&amp;sid=$sid&amp;clid=$clid\">&#187;Requests($mems[0])</a><br/>";
      }
    }else{
      echo "Topics: <b>$tps[0]</b>, Posts: <b>$pss[0]</b><br/>";
      echo "<b>Description:</b><br/>";
      echo htmlspecialchars($clinfo[2]);
      echo "<br/><br/>";
      echo "<b>Rules:</b><br/>";
      echo htmlspecialchars($clinfo[3]);
      echo "<br/><br/>";
      echo "Seems Good? <a href=\"genproc.php?action=reqjc&amp;sid=$sid&amp;clid=$clid\">Join Now!</a>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=clubs&amp;sid=$sid\">";
echo "Clubs list</a><br/>";

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
  echo "</body></html>";
}

else if($action=="addcl")
{

echo "<head>";

  echo "<title>Club Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Adding A Club","index.php?action=$action");
    echo "<p align=\"center\">";
    echo "<b>Add Club</b>";
    echo "</p>";
    echo "<p>";
    if(getplusses($uid)>=100)
    {
    $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$uid."'"));
      if($noi[0]<3)
      {
        echo "<img src=\"images/point.gif\" alt=\"*\"/>All Info are required except the logo<br/>";
        echo "<img src=\"images/point.gif\" alt=\"*\"/>Beside you, mods can moderate your club forums and chat<br/>";
        echo "<img src=\"images/point.gif\" alt=\"*\"/>Any leading spaces for description, name, logo, or rules will be removed<br/>";
        echo "<img src=\"images/point.gif\" alt=\"*\"/>Admins will delete your club and subtract your plusses if you abuse the rules of owning a club<br/>";
        echo "<img src=\"images/point.gif\" alt=\"*\"/>Admins have the right to delete your club if it wasnt active or if it was useless<br/><br/>";
        echo "<form action=\"genproc.php?action=addcl&amp;sid=$sid\" method=\"post\">";
       echo "Club Name:<input name=\"clnm\" maxlength=\"30\"/><br/>";
        echo "Description:<input name=\"clds\" maxlength=\"200\"/><br/>";
        echo "Rules:<input name=\"clrl\" maxlength=\"500\"/><br/>";
        //echo "Logo:<input name=\"cllg\" maxlength=\"200\"/><br/>";
    echo "<input type=\"submit\" value=\"Create\"/>";
        echo "</form>";
      }else{
        echo "You already have 3 clubs";
      }
      }else{

      echo "You cant add any clubs ";
      }
    echo "</p>";

    echo "<p align=\"center\">";
  echo "<div class=\"ads\">";
  include("admob.php");
  echo "<div>";
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

     echo "</body></html>";

}

///////////////////////////////////Search

else if($action=="search")
{


 echo "<head>";
  echo "<title>Search Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Am in the search menu","index.php?action=$action");

    echo "<p align=\"center\">";
    echo "<img src=\"images/search.gif\" alt=\"*\"/><br/>";
   echo "Search Menu";
    echo "</p>";
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

    echo "<p>";
   echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";
  echo "<a href=\"search.php?action=tpc&amp;sid=$sid\">&#0187;In Topics</a><br/>";
    echo "<a href=\"search.php?action=blg&amp;sid=$sid\">&#0187;In Blogs</a><br/>";
    echo "<a href=\"search.php?action=nbx&amp;sid=$sid\">&#0187;In My Inbox</a><br/>";
    echo "<a href=\"search.php?action=clb&amp;sid=$sid\">&#0187;In Clubs</a><br/><br/>";
  echo "Find Members:<br/>";
    echo "<a href=\"search.php?action=mbrn&amp;sid=$sid\">&#0187;In Nicknames</a><br/>";
  //echo "<a href=\"search.php?action=mbrl&amp;sid=$sid\">&#0187;In Location</a><br/>";
  //echo "<a href=\"search.php?action=mbrs&amp;sid=$sid\">&#0187;By sex orientation</a><br/>";
    echo "<br/>or you can just type the Username of the member and view its profile<br/>";
    echo "<form action=\"index.php?action=viewuser&amp;sid=$sid\" method=\"post\">";
    echo "<br/>Nickname <input name=\"mnick\" maxlength=\"15\"/><br/>";
    echo "<input type=\"submit\" value=\"View Profile\"/>";
    echo "</form>";
  echo "</p>";

    echo "<p align=\"center\">";
 echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
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
  echo "</body></html>";

}

///////////////////////////////////USER Settings////////////////////////////

else if($action=="uset")
{

echo "<head>";
  echo "<title>Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"My Setting Menu","index.php?action=$action");
  $ope = $_SERVER['HTTP_USER_AGENT'];
   $brws = explode("/",$ope);
   $brws[0] = strtoupper($brws[0]);
  echo "<br/><div class='ads'>";
echo "<a href='http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw=='>$brws[0] LATEST DOWNLOADS</a>";
  echo "</div><br />";

              echo "<tr>";
    $uid = getuid_sid($sid);
    $email = @mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE id='".$uid."'"));
    $bdy = @mysql_fetch_array(mysql_query("SELECT birthday FROM gyd_users WHERE id='".$uid."'"));
    $uloc = @mysql_fetch_array(mysql_query("SELECT location FROM gyd_users WHERE id='".$uid."'"));
    $lang = @mysql_fetch_array(mysql_query("SELECT lang FROM gyd_users WHERE id='".$uid."'"));
    $usig = @mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$uid."'"));
    $site = @mysql_fetch_array(mysql_query("SELECT site FROM gyd_users WHERE id='".$uid."'"));
	$sx = @mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$uid."'"));
    $realname = @mysql_fetch_array(mysql_query("SELECT realname FROM gyd_users WHERE id='".$uid."'"));
    $relstatus = @mysql_fetch_array(mysql_query("SELECT relstatus FROM gyd_users WHERE id='".$uid."'"));
    $crn = @mysql_fetch_array(mysql_query("SELECT bcrew FROM gyd_users WHERE id='".$uid."'"));

  $uloc[0] = htmlspecialchars($uloc[0]);
                echo "<td class=\"IL-R\">";
                echo "<form method=\"post\" action=\"genproc.php?action=uprof&amp;sid=$sid\">";
              //  echo "Real Name: <input name=\"realname\" maxlength=\"100\" value=\"$realname[0]\"/><br/>";
              
			   echo "Birthday <small>(YYYY-MM-DD)</small>:<br /> <input name=\"ubday\" maxlength=\"10\" value=\"$bdy[0]\"/><br/>";
                echo "Location:<br /> <input name=\"uloc\" maxlength=\"50\" value=\"$uloc[0]\"/><br/>";
              



			   // echo "Language: <input name=\"lang\" maxlength=\"50\" value=\"$lang[0]\"/><br/>";
                  echo "here for:<br /> <input name=\"usite\" maxlength=\"100\" value='$site[0]'/><br/>";
                echo "Relationship Status:<br /> <select name=\"relstatus\" value=\"$relstatus[0]\">";
                if($relstatus[0]=="Single and searching"){
                echo "<option value=\"Single and searching\" selected=\"Single\">Single and searching</option>";
                }else{
                echo "<option value=\"Single and searching\" selected=\"Single\">Single and searching</option>";
                }
                if($relstatus[0]=="In a Relationship"){
                echo "<option value=\"In a Relationship\" selected=\"In a Relationship\">In a Relationship</option>";
                }else{
                echo "<option value=\"In a Relationship\">In a Relationship</option>";
                }
                if($relstatus[0]=="Engaged"){
                echo "<option value=\"Engaged\" selected=\"Engaged\">Engaged</option>";
                }else{
                echo "<option value=\"Engaged\">Engaged</option>";
                }
                if($relstatus[0]=="Married"){
                echo "<option value=\"Married\" selected=\"Married\">Married</option>";
                }else{
                echo "<option value=\"Married\">Married</option>";
                }
                if($relstatus[0]=="Single but not searching"){
                echo "<option value=\"Single but not searching\" selected=\"Single but not searching\">Single but not searching</option>";
                }else{
                echo "<option value=\"Single but not searching\">Single but not searching</option>";
                }
                if($relstatus[0]=="Open Relationship"){
                echo "<option value=\"Open Relationship\" selected=\"Open Relationship\">Open Relationship</option>";
                }else{
                echo "<option value=\"Open Relationship\">Open Relationship</option>";
                }
                echo "</select><br/><br/>";
                echo "Sexual Orientation:<br />
				<select name='usex'><option value='Male'>Male</option>
				<option value='Female'>Female</option>
				</select><br />";
                echo "E-Mail<small>(Facebook email)</small>:<br /> <input name=\"semail\" maxlength=\"100\" value=\"$email[0]\"/><br/>";
                echo "Signature:<br /> <input name=\"usig\" maxlength=\"100\" value=\"$usig[0]\"/><br/>";
                echo "<input type=\"submit\" name=\"Submit\" value=\"Update\"/><br/>";
                echo "</form>";


    echo "<br/><br/>";
  $sml = mysql_fetch_array(mysql_query("SELECT hvia FROM gyd_users WHERE id='".getuid_sid($sid)."'"));
  if($sml[0]=="1")
  {
    echo "<a href=\"genproc.php?action=shsml&amp;sid=$sid&amp;act=dis\">Disable Smilies</a>";
  }else{
    echo "<a href=\"genproc.php?action=shsml&amp;sid=$sid&amp;act=enb\">Enable Smilies</a>";
  }
  echo "<br/><br/>";
    if(isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
{
$viewpro = mysql_fetch_array(mysql_query("SELECT viewpro FROM gyd_users WHERE id = '".getuid_sid($sid)."'"));

if($viewpro[0]=="1")
{
echo "<a href=\"genproc.php?action=profh&amp;sid=$sid&amp;act=dis\">Make Profile Private</a><br/>";
}else{
echo "<a href=\"genproc.php?action=profh&amp;sid=$sid&amp;act=enb\">Make Profile Public</a><br/>";
}
}
    echo "</p>";
	  $ope = $_SERVER['HTTP_USER_AGENT'];
   $brws = explode("/",$ope);
   $brws[0] = strtoupper($brws[0]);
	  echo "<br/><div class='ads'>";
echo "<a href='http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw=='>NIGERIAN DOWNLOADS</a>";
  echo "</div><br />";
    echo "<p align=\"center\">";

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
    echo "</body>";
  echo "</html>";

}
///////////////////////////////////Poll Topic
else if($action=="poll")
{

echo "<head>";
  echo "<title>Pool Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Administrating Poll","index.php?action=$action");
    echo "<p>";
    $uid = getuid_sid($sid);
    if(getplusses($uid)<25)
    {
      echo "Minimum plusses required to administrate your poll is 500 plusses";
    }else{
        $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$uid."'"));
        if($pid[0] == 0)
        {
          echo "<a href=\"index.php?action=crpoll&amp;sid=$sid\">Create Poll</a>";
        }else{
          echo "<a href=\"index.php?action=viewpl&amp;sid=$sid&amp;who=$uid\">View Your Poll</a><br/>";
            echo "<a href=\"genproc.php?action=dlpoll&amp;sid=$sid\">Delete Your Poll</a><br/>";
        }
    }
    echo "</p>";

    echo "<p align=\"center\">";

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
   echo "wapbies.com &#0169; 2009 - All Right Reserved";
   echo "</div>";
  echo "</p>";
    echo "</body>";


}else if($action=="crpoll")
{

echo "<head>";
  echo "<title>Pool Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Creating A New Poll","index.php?action=$action");
    echo "<p>";
    if(getplusses(getuid_sid($sid))>=25)
    {
    $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$uid."'"));
        if($pid[0] == 0)
        {
          echo "<form action=\"genproc.php?action=crpoll&amp;sid=$sid\" method=\"post\">";

          echo "Question:<input name=\"pques\" maxlength=\"250\"/><br/>";
          echo "Option 1:<input name=\"opt1\" maxlength=\"100\"/><br/>";
          echo "Option 2:<input name=\"opt2\" maxlength=\"100\"/><br/>";
          echo "Option 3:<input name=\"opt3\" maxlength=\"100\"/><br/>";
          echo "Option 4:<input name=\"opt4\" maxlength=\"100\"/><br/>";
          echo "Option 5:<input name=\"opt5\" maxlength=\"100\"/><br/>";
          echo "<input type=\"submit\" value=\"Create\"/>";
          echo "</form>";

          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You already have a poll, delete your current one before adding a new one";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You should have at least 25 plusses to create a poll";
          }
    echo "</p>";

    echo "<p align=\"center\">";

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
    echo "</body>";
  echo "</html>";

}

else if($action=="pltpc")
{

echo "<head>";
  echo "<title>Create Topic</title>";
  echo "</head>";
  $tid = $_GET["tid"];
    addonline(getuid_sid($sid),"Creating A Poll","index.php?action=$action");
    echo "<p>";
    if((getplusses(getuid_sid($sid))>=25)||ismod($uid))
    {
    $pid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_topics WHERE id='".$tid."'"));
        if($pid[0] == 0)
        {
          echo "<form action=\"genproc.php?action=pltpc&amp;sid=$sid&amp;tid=$tid\" method=\"post\">";
          echo "Question:<input name=\"pques\" maxlength=\"250\"/><br/>";
          echo "Option 1:<input name=\"opt1\" maxlength=\"100\"/><br/>";
          echo "Option 2:<input name=\"opt2\" maxlength=\"100\"/><br/>";
          echo "Option 3:<input name=\"opt3\" maxlength=\"100\"/><br/>";
          echo "Option 4:<input name=\"opt4\" maxlength=\"100\"/><br/>";
          echo "Option 5:<input name=\"opt5\" maxlength=\"100\"/><br/>";
          echo "<input type=\"submit\" value=\"Create\"/>";
          echo "</form>";
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>The topic already have a poll";
          }
          }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>You should have at least 25 plusses to create a poll";
          }
    echo "</p>";

    echo "<p align=\"center\">";

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
    echo "</body>";

}

else if($action=="stats")
{

echo "<head>";
  echo "<title>Site Statistics</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Site stats","index.php?action=$action");

   echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p><br />";
}

  echo "<br /><p align=\"center\">";

    $memid = @mysql_fetch_array(mysql_query("SELECT id, name  FROM gyd_users ORDER BY regdate DESC LIMIT 0,1"));
    echo "The Newsest Member is: <b><a href=\"index.php?action=viewuser&amp;who=$memid[0]&amp;sid=$sid\">$memid[1]</a></b><br/>";
    $mols = @mysql_fetch_array(mysql_query("SELECT name, value FROM gyd_settings WHERE id='2'"));
    echo "Most Users Online: <b>$mols[1]</b> Members on $mols[0]<br/>";
    $mols = @mysql_fetch_array(mysql_query("SELECT ppl, dtm FROM gyd_mpot WHERE ddt='".date("d m y")."'"));
    echo "Most Users Online(<a href=\"lists.php?action=moto&amp;sid=$sid\"> For today only</a>): <b>$mols[0]</b> Members at $mols[1]<br/>";
    $tm24 = time() - (24*60*60);
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE lastact>'".$tm24."'"));
    //echo mysql_error();
    echo "Active users today <b>$aut[0]</b><br/>";
    $notc = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics"));
    $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts"));
    echo "Number of Topics: <b>$notc[0]</b><br />
  Number of Posts: <b>$nops[0]</b><br/>";
    $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private"));
    echo "Number of PMs: <b>$nopm[0]</b><br/>";
    $gallery = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery"));
    echo "Number of Pictures in gallery: <b>$gallery[0]</b><br/>";
    $nopm = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='Counter'"));
    echo "Counter: <b>$nopm[0]</b><br/>";
   //if(isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')

$norm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
    echo "Registered Members: <b>$norm[0]</b> <br />";
     echo "</p>";
    echo "<p>";
    /////
    $norm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
    echo "<a href=\"index.php?action=l24&amp;sid=$sid\">&#187;Whats Happened Here In Last 24 Hours</a><br/>";
    echo "<a href=\"lists.php?action=members&amp;sid=$sid\">&#187;All Members($norm[0])</a><br/>";
  if(isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
{
   $norm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE sex='M'"));

    echo "<a href=\"lists.php?action=males&amp;sid=$sid\">&#187;Male Members($norm[0])</a><br/>";
    $norm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE sex='F'"));
    echo "<a href=\"lists.php?action=fems&amp;sid=$sid\">&#187;Female Members($norm[0])</a><br/>";
}
    $tbday=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate());"));
    echo "<a href=\"lists.php?action=bdy&amp;sid=$sid\">&#187;Today's Birthday($tbday[0])</a><br/>";
    $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs"));
    echo "<a href=\"lists.php?action=allbl&amp;sid=$sid\">&#187;Blogs($noi[0])</a><br/>";
    $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE pollid>'0'"));
    echo "<a href=\"lists.php?action=polls&amp;sid=$sid\">&#187;Polls($noi[0])</a><br/>";
echo "<a href=\"lists.php?action=tgame&amp;sid=$sid\">&#187;Top Gamers</a><br/>";
    echo "<a href=\"lists.php?action=tchat&amp;sid=$sid\">&#187;Top Chatters</a><br/>";

    echo "<a href=\"lists.php?action=topp&amp;sid=$sid\">&#187;Top Posters</a><br/>";


	
	 $noi = @mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase>'0'"));
    echo "<a href=\"lists.php?action=staffwp&amp;sid=$sid\">&#187;Staff Members($noi[0])</a><br/>";

	
	

    if(ismod(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
{

 //   echo "<a href=\"lists.php?action=tshout&amp;sid=$sid\">&#187;Top Shouters</a><br/>";

   // echo "<a href=\"lists.php?action=topb&amp;sid=$sid\">&#187;Top Battlers</a><br/>";

    $noi = @mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_judges"));
    echo "<a href=\"lists.php?action=judg&amp;sid=$sid\">&#187;Battles Judges($noi[0])</a><br/>";


$nobr=mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT browserm) FROM gyd_users WHERE browserm IS NOT NULL "));
    echo "<a href=\"lists.php?action=brows&amp;sid=$sid\">&#187;Browsers($nobr[0])</a><br/>";
   $noi = @mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='1' OR penalty='2'"));
    echo "<a href=\"lists.php?action=bannedwp&amp;sid=$sid\">&#187;Banned($noi[0])</a><br/>";
  $noi = @mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='0'"));
    echo "<a href=\"lists.php?action=trashed&amp;sid=$sid\">&#187;Trashed($noi[0])</a><br/>";
    $noi = @mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='2'"));
    echo "<a href=\"lists.php?action=ipban&amp;sid=$sid\">&#187;Banned IPs($noi[0])</a><br/>";
    }

    echo "</p>";
    echo "<p align=\"center\">";

   echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
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
    echo "</body</html>";

}

else if($action=="l24")
{

echo "<head>";
  echo "<title>Site Statistics</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Site stats","index.php?action=$action");

    echo "<p>";
    /////
    echo "Things that have happened in $site_name during last 24 hours<br/><br/>";
    $tm24 = time() - (24*60*60);
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE lastact>'".$tm24."'"));
    echo "Active Members: <b>$aut[0]</b><br/>";
$aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE regdate>'".$tm24."'"));
    echo "Registered Members: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs WHERE bgdate>'".$tm24."'"));
    echo "Blogs Created: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE joined>'".$tm24."' AND accepted='1'"));
    echo "Members Joined Clubs: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE created>'".$tm24."'"));
    echo "Clubs Created: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE reqdt>'".$tm24."' AND agreed='1'"));
    echo "Buddies Added: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gbook WHERE dtime>'".$tm24."'"));
    echo "Guestbooks Signed: <b>$aut[0]</b><br/>";
        if(ismod(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))

	{
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog WHERE actdt>'".$tm24."'"));
    echo "ModLog Actions: <b>$aut[0]</b><br/>";
  }
  $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_polls WHERE pdt>'".$tm24."'"));
    echo "Polls Added: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE dtpost>'".$tm24."'"));
    echo "Posts: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE timesent>'".$tm24."'"));
    echo "PMs Sent: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_shouts WHERE shtime>'".$tm24."'"));
    echo "Shouts: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE crdate>'".$tm24."'"));
    echo "Topics Created: <b>$aut[0]</b><br/>";
    $aut = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_vault WHERE pudt>'".$tm24."'"));
    //echo "Vault Items Added: <b>$aut[0]</b><br/>;";
    echo "</p>";
    echo "<p align=\"center\">";
echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Statistics</a><br/>";

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
    echo "</body>";

}

//////////////////////////////////View category

else if($action=="viewcat")
{

echo "<head>";
  echo "<title>Forum Categories</title>";
  echo "</head>";
    $cid = $_GET["cid"];
    addonline(getuid_sid($sid),"Viewing Forum Category","index.php?action=$action");
    $cinfo = @mysql_fetch_array(mysql_query("SELECT name from gyd_fcats WHERE id='".$cid."'"));
    echo "<p align=\"center\">";
    //echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Fantastics Downloads!!</a><br />";
  echo "<p>";
  echo "<b> Forum Categories </b><br />";
    $forums = @mysql_query("SELECT id, name FROM gyd_forums WHERE cid='".$cid."' AND clubid='0' ORDER BY position, id, name");
    //echo "<small>";
    while($forum = mysql_fetch_array($forums))
    {
      if(canaccess(getuid_sid($sid), $forum[0]))
      {
        $notp = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$forum[0]."'"));
        $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts a INNER JOIN gyd_topics b ON a.tid = b.id WHERE b.fid='".$forum[0]."'"));
      $iml = "<img src=\"images/1.gif\" alt=\"*\"/>";
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$forum[0]\">$iml$forum[1]($notp[0]/$nops[0])</a><br/>";
      $lpt = @mysql_fetch_array(mysql_query("SELECT id, name FROM gyd_topics WHERE fid='".$forum[0]."' ORDER BY lastpost DESC LIMIT 0,1"));
      $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$lpt[0]."'"));
      if($nops[0]==0)
      {
        $pinfo = @mysql_fetch_array(mysql_query("SELECT authorid FROM gyd_topics WHERE id='".$lpt[0]."'"));
        $tluid = $pinfo[0];

      }else{
        $pinfo = @mysql_fetch_array(mysql_query("SELECT  uid  FROM gyd_posts WHERE tid='".$lpt[0]."' ORDER BY dtpost DESC LIMIT 0, 1"));

        $tluid = $pinfo[0];
      }
      $tlnm = htmlspecialchars($lpt[1]);
      $tlnick = getnick_uid($tluid);
      $tpclnk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$lpt[0]&amp;go=last\">$tlnm</a>";
      $vulnk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$tluid\">$tlnick</a>";
      echo "Last Post: $tpclnk, BY: $vulnk<br/><br/>";
      }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    $tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
  if($umsg>0)
  {
  echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Inbox($umsg/$tmsg)</a><br/>";
  }

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
    echo "</body>";

}

//////////////////////////////////View Topic

else if($action=="viewtpc")
{

echo "<head>";
  echo "<title>Forum Topic</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Viewing Forum Topic","index.php?action=$action");
   echo "<div class=\"ads\">";
include('admob.php');
 echo "</div><tt>";

  $tid = $_GET["tid"];
  $go = $_GET["go"];
  $tfid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$tid."'"));
 if(!canaccess(getuid_sid($sid), $tfid[0]))
    {
      echo "<p align=\"center\">";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    

    $tinfo = @mysql_fetch_array(mysql_query("SELECT name, text, authorid, crdate, views, fid, pollid from gyd_topics WHERE id='".$tid."'"));
    $tnm = htmlspecialchars($tinfo[0]);
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p><br />";
}

    echo "<p align=\"center\">";
  echo "<strong><u>$tnm</u></strong><br />";
    $num_pages = getnumpages($tid);
    if($page==""||$page<1)$page=1;
    if($go!="")$page=getpage_go($go,$tid);
    $posts_per_page = 5;
    if($page>$num_pages)$page=$num_pages;
    $limit_start = $posts_per_page *($page-1);
    //echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid\">Post reply</a>";
    $lastlink = "<a href=\"index.php?action=$action&amp;tid=$tid&amp;sid=$sid&amp;go=last\">View Last Page</a>";
    $firstlink = "<a href=\"index.php?action=$action&amp;tid=$tid&amp;sid=$sid&amp;page=1\">View First Page</a> ";
    $golink = "";
    if($page>1)
    {
      $golink = $firstlink;
    }
    if($page<$num_pages)
    {
      $golink .= $lastlink;
    }
    if($golink !="")
    {
      echo "<br/>$golink";
    }
    echo "</p>";

    echo "<p>";
    $vws = $tinfo[4]+1;
    $rpls = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$tid."'"));
    echo "Replies: $rpls[0] - Views: $vws<br/>";
    ///fm here

    if($page==1)
    {
      $posts_per_page=4;
      @mysql_query("UPDATE gyd_topics SET views='".$vws."' WHERE  id='".$tid."'");
      $ttext = @mysql_fetch_array(mysql_query("SELECT authorid, text, crdate, pollid FROM gyd_topics WHERE id='".$tid."'"));
      $unick = getnick_uid($ttext[0]);
      if(isonline($ttext[0]))
    {
      $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    }else{
        $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
    }
    $usl = "<br/><a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$ttext[0]\">$iml$unick</a>";
    $topt = "<a href=\"index.php?action=tpcopt&amp;sid=$sid&amp;tid=$tid\">*</a>";
    if($go==$tid)
    {
      $fli = "<img src=\"images/flag.gif\" alt=\"!\"/>";
    }else{
      $fli ="";
    }
    $pst = parsemsg($ttext[1],$sid);
    echo "$usl: $fli$pst $topt<br/>";
   $tmstamp = $ttext[2];
  $tremain = time()-$tmstamp;
  //$tmdt = date("d m Y - H:i:s", $tmstamp);
  $tmdt = gettimemsg($tremain)." ago"; ////////////////////this is the time thing
 echo "<small><i><b>$tmdt</b></i></small><br/>";
    $dtot = date("D-M-Y - H:i:s",$ttext[2]);
   // echo $dtot;
  echo "<br/>";
$nopl = @mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$ttext[0]."'"));
  $sign = parsemsg($nopl[0], $sid);
  echo "<small><i><b>Signiture:</b> $sign<br/></i></small>";
  echo "<hr>";


    echo "<br/>";
    if($ttext[3]>0)
    {
      echo "<a href=\"index.php?action=viewtpl&amp;sid=$sid&amp;who=$tid\">POLL</a><br/>";
    }
  }
  if($page>1)
  {
    $limit_start--;
  }
  $sql = "SELECT id, text, uid, dtpost, quote FROM gyd_posts WHERE tid='".$tid."' ORDER BY dtpost LIMIT $limit_start, $posts_per_page";
  $posts = @mysql_query($sql);
  while($post = mysql_fetch_array($posts))
  {
    $unick = getnick_uid($post[2]);
    if(isonline($post[2]))
    {
      $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    }else{
        $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
    }
    $usl = "<br/><a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$post[2]\">$iml$unick</a>";
    $pst = parsemsg($post[1], $sid);
    $topt = "<a href=\"index.php?action=pstopt&amp;sid=$sid&amp;pid=$post[0]&amp;page=$page&amp;fid=$tinfo[5]\">*</a>";
    if($post[4]>0)
    {
        $qtl = "<i><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;pst=\">(quote:p=blaze,d=16-04-2006)</a></i>";
    }
    if($go==$post[0])
    {
      $fli = "<img src=\"images/flag.gif\" alt=\"!\"/>";
    }else{
      $fli ="";
    }
    echo "$usl: $fli$pst $topt<br/>";
   $tmstamp = $post[3];
  $tremain = time()-$tmstamp;
  //$tmdt = date("d m Y - H:i:s", $tmstamp);
  $tmdt = gettimemsg($tremain)." ago"; ////////////////////this is the time thing
 echo "<small><i><b>$tmdt</b></i></small><br/>";
    $dtot = date("d-m-y - H:i:s",$post[3]);
    //echo $dtot;
  $noplp = mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$post[2]."'"));
  $signp = parsemsg($noplp[0], $sid);
  echo "<br /><small><i><b>Signiture:</b> $signp<br/></i></small>";
      echo "<hr>";

  //echo "<br />";
  }
    ///to here
    echo "</p>";
    echo "<p align=\"center\">";
    $tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
 /* if($umsg>0)
  {
 echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Inbox($umsg/$tmsg)</a><br/>";
  }*/
   echo "<form action=\"genproc.php?action=post&amp;sid=$sid\" method=\"post\">";
    echo "<strong>Add Reply:</strong><br /><textarea name=\"reptxt\"/></textarea><br/>";
        echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
         echo "<input type=\"hidden\" name=\"qut\" value=\"$qut\"/>";
echo "<input type=\"submit\" value=\"Post Reply\"/>";
echo "</form>";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=viewtpc&amp;page=$ppage&amp;sid=$sid&amp;tid=$tid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=viewtpc&amp;page=$npage&amp;sid=$sid&amp;tid=$tid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"index.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "</form>";


        echo $rets;
    }
echo "<br/>";
    //echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid\">Post reply</a>";
    echo "</p>";
    echo "<p align=\"center\">";
    $fid = $tinfo[5];
    $fname = getfname($fid);
    $cid = mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    $cinfo = mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = $cinfo[0];

$cid = mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    if($cid[0]>0)
    {
    $cinfo = mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=viewcat&amp;sid=$sid&amp;cid=$cid[0]\">";
    echo "Back to $cname</a><br/>";
    }else{
        $cid = mysql_fetch_array(mysql_query("SELECT clubid FROM gyd_forums WHERE id='".$fid."'"));
        $cinfo = mysql_fetch_array(mysql_query("SELECT name FROM gyd_clubs WHERE id='".$cid[0]."'"));
        $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$cid[0]\">";
    echo "Back to $cname Club</a><br/>";
  }
  $fname = htmlspecialchars($fname);
    echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">Back to $fname</a>";
  echo "</p><br />";
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p><br />";
}

     echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
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
  echo "</p></tt>";
    echo "</body>";

}
    //////////////////////////////////View Forum

else if($action=="viewfrm")
{

  echo "<head>";
  echo "<title>Forum</title>";
  echo "</head>";
    $fid = $_GET["fid"];
  $view = $_GET["view"];
    if(!canaccess(getuid_sid($sid), $fid))
    {
      addonline(getuid_sid($sid),"im viewing admin forum naughty me","");
      echo "<p align=\"center\">";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    addonline(getuid_sid($sid),"Viewing Forum","");
   echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";
   $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

   $finfo = @mysql_fetch_array(mysql_query("SELECT name from gyd_forums WHERE id='".$fid."'"));
    $fnm = htmlspecialchars($finfo[0]);
    echo "<br /><center>";
    $norf = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rss WHERE fid='".$fid."'"));
    if($norf[0]>0)
    {
        echo "<a href=\"rwrss.php?action=showfrss&amp;sid=$sid&amp;fid=$fid\"><img src=\"images/rss.gif\" alt=\"rss\"/>$finfo[0] Extras</a><br/>";
    }
    echo "<a href=\"index.php?action=newtopic&amp;sid=$sid&amp;fid=$fid\">Create New Topic</a><br/><br/>";
   echo "<form action=\"index.php\" method=\"get\">";
    echo "View: <select name=\"view\">";
    echo "<option value=\"all\">All</option>";
    echo "<option value=\"new\">Since Last Visit</option>";
    echo "<option value=\"myps\">I posted In</option>";
    echo "</select>";
    echo "<input type=\"submit\" value=\"Go\"/>";
    echo "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
    echo "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
    echo "<input type=\"hidden\" name=\"sid\"  value=\"$sid\"/>";
    echo "</form>";
    echo "<br/>";
  if($view=="new")
  {
    echo "Viewing topics that has no new posts since your last visit";
  }else if($view=="myps")
  {
    echo "Viewing topics contain posts by you";
  }else {
  echo "Viewing All topics";
  }
   echo "</center>";
   echo "<p align=\"left\">";
    if($page=="" || $page<=0)$page=1;
    if($page==1)
    {
       ///////////pinned topics
      $topics = mysql_query("SELECT id, name, closed, views, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='1' ORDER BY lastpost DESC, name, id LIMIT 0,5");
      while($topic = mysql_fetch_array($topics))
    {
      $iml = "<img src=\"images/normal.gif\" alt=\"*\"/>";
      $iml = "*";
      $atxt ="";
      if($topic[2]=='1')
      {
        //closed
        $atxt = "(X)";
      }
      if($topic[4]>0)
      {
        $pltx = "(P)";
      }else{
        $pltx = "";
      }
      $tnm = htmlspecialchars($topic[1]);
      $nop = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$topic[0]."'"));
      echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$topic[0]\">$iml$pltx$tnm($nop[0])$atxt</a><br/>";

    }
    echo "<br/>";
  }
  $uid = getuid_sid($sid);
  if($view=="new")
  {

  $ulv = @mysql_fetch_array(mysql_query("SELECT lastvst FROM gyd_users WHERE id='".$uid."'"));
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' AND lastpost >='".$ulv[0]."'"));
  }
  else if($view=="myps")
  {
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT a.id) FROM gyd_topics a INNER JOIN ibwf_posts b ON a.id = b.tid WHERE a.fid='".$fid."' AND a.pinned='0' AND b.uid='".$uid."'"));
  }
  else{
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid."' AND pinned='0'"));
  }
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($limit_start<0)$limit_start=0;
  if($view=="new")
  {
  $ulv = @mysql_fetch_array(mysql_query("SELECT lastvst FROM gyd_users WHERE id='".$uid."'"));
    $topics = mysql_query("SELECT id, name, closed, views, moved, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' AND lastpost >='".$ulv[0]."' ORDER BY lastpost DESC, name, id LIMIT $limit_start, $items_per_page");
  }
  else if($view=="myps"){
  $topics = @mysql_query("SELECT a.id, a.name, a.closed, a.views, a.moved, a.pollid FROM gyd_topics a INNER JOIN ibwf_posts b ON a.id = b.tid WHERE a.fid='".$fid."' AND a.pinned='0' AND b.uid='".$uid."' GROUP BY a.id ORDER BY a.lastpost DESC, a.name, a.id  LIMIT $limit_start, $items_per_page");
  }
  else{
  $topics = @mysql_query("SELECT id, name, closed, views, moved, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' ORDER BY lastpost DESC, name, id LIMIT $limit_start, $items_per_page");
  }

    while($topic = mysql_fetch_array($topics))
    {

      $nop = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$topic[0]."'"));
      $iml = "<img src=\"images/normal.gif\" alt=\"*\"/>";
      if($nop[0]>24)
      {
        $iml = "<img src=\"images/hot.gif\" alt=\"*\"/>";
      }
      if($topic[4]=='1')
      {
        $iml = "<img src=\"images/moved.gif\" alt=\"*\"/>";
      }
      if($topic[2]=='1')
      {
        $iml = "<img src=\"images/closed.gif\" alt=\"*\"/>";
      }
      if($topic[5]>0)
      {
        $iml = "<img src=\"images/poll.gif\" alt=\"*\"/>";
      }
      $atxt ="";
      if($topic[2]=='1')
      {
        //closed
        $atxt = "(X)";
      }
      $tnm = htmlspecialchars($topic[1]);
      echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$topic[0]\">$iml$tnm($nop[0])$atxt</a><br/>";

    }

  echo "</p>";


    echo "<center>";
  echo "<p align=\"center\">";
  echo "<br />";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=viewfrm&amp;page=$ppage&amp;sid=$sid&amp;fid=$fid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=viewfrm&amp;page=$npage&amp;sid=$sid&amp;fid=$fid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
     $rets = "<form action=\"index.php\" method=\"get\">";
        $rets .= "<input name=\"page\" style=\"-wap-input-format: '*N'\" size=\"2\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
    $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        $rets .= "<input type=\"submit\" value=\"Go To Page\"/>";
        $rets .= "</form>";

        echo $rets;
    }

    //echo "<br/><br/><a href=\"index.php?action=newtopic&amp;sid=$sid&amp;fid=$fid\">New Topic</a><br/>";
    $cid = mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    if($cid[0]>0)
    {
    $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=viewcat&amp;sid=$sid&amp;cid=$cid[0]\">";
    echo "$cname</a><br/>";
    }else{
        $cid = @mysql_fetch_array(mysql_query("SELECT clubid FROM gyd_forums WHERE id='".$fid."'"));
        $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_clubs WHERE id='".$cid[0]."'"));
        $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$cid[0]\">";
    echo "$cname Club</a><br />";
    }
   echo "</center>";
   echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
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
    echo "</body></html>";

}
//////////////////////////////////CREATE TOPIC
else if($action=="newtopic")
{

echo "<head>";
  echo "<title>Create Topic</title>";
  echo "</head>";
  $fid = $_GET["fid"];
  if(!canaccess(getuid_sid($sid), $fid))
    {
        echo "<p align=\"center\">";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    addonline(getuid_sid($sid),"Creating new topic","index.php?action=$action");
    echo "<p align=\"center\">";
	  ?>
	    <strong>NEW TOPIC</strong><br /><br />
		<!--
  <strong><u>Warning:</u> <br /><small>Please note that you will get banned if you include site link(s) in your topic.
  <br />
  Posting of sites links is considered as spamming and its uncalled-for. We strongly prohibit spamming. 
  <br />Your site will be closed and your account username on wapbies will be canceled.<br />
  Be warned!(Ayoomo9 &amp; Xola)</small></strong><br /><br />
  -->
  <?php
    echo "<form action=\"genproc.php?action=newtopic&amp;sid=$sid\" method=\"post\">";
    echo "Title:<input name=\"ntitle\" maxlength=\"30\"/><br/>";
    echo "Text:<textarea name=\"tpctxt\"/></textarea><br/>";
    echo "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
    echo "<input type=\"submit\" value=\"Create\"/>";
    echo "</form>";


    echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
    $fname = getfname($fid);
echo "$fname</a><br/>";
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
    echo "</body>";
  echo "</html>";

}

//////////////////////////////////////////Post reply

else if($action=="post")
{

echo "<head>";
  echo "<title>Post Reply</title>";
  echo "</head>";
    $tid = $_GET["tid"];

    $tfid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$tid."'"));
    $fid = $tfid[0];
if(!canaccess(getuid_sid($sid), $fid))
    {
      echo "<p align=\"center\">";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    addonline(getuid_sid($sid),"Posting reply","index.php?action=$action");
    echo "<p align=\"center\">";
		  ?>
		<!--
  <strong><u>Warning:</u> <br /><small>Please note that you will get banned if you include site link(s) in your post.
  <br />
  Posting of sites links is considered as spamming and its uncalled-for. We strongly prohibit spamming. 
  <br />Your site will be closed and your account username on wapbies will be canceled.<br />
  Be warned!(Ayoomo9 &amp; Xola)</small></strong><br /><br />
  -->
  <?php
    echo "<form action=\"genproc.php?action=post&amp;sid=$sid\" method=\"post\">";
    echo "Text:<textarea name=\"reptxt\"/></textarea><br/>";
        echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
         echo "<input type=\"hidden\" name=\"qut\" value=\"$qut\"/>";
echo "<input type=\"submit\" value=\"Reply\"/>";
echo "</form>";

            $fid = getfid($tid);
         $fname = getfname($fid);
         echo "<br/><br/><a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid\">";
echo "Back to topic</a>";
      echo "<br/><a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$fid\">";
echo "$fname</a><br/>";
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
    echo "</body";
  echo "</html>";

}

//////////////////////////////////////////shout
else if($action=="shout")
{

echo "<head>";
  echo "<title>Shout Box</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Am Making ShoutOut","");
    echo "<center>";
  echo "<u><b>ShoutOut</b></u><br />";
     if (isshoutblocked(getuid_sid($sid))){
      echo "You are banned from shouting";
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
      exit();
    }
	
    if(getplusses(getuid_sid($sid))<2)
    {
        echo "<br />You need at least 2 plusses before making shoutOut!<br /><br /><a href='index.php?action=freep&sid=$sid'>Learn how to get free plusses here</a>.<br /><br />";

    }

    else{
  ?>
    <strong><br /><small>Warning: Posting of site links(urls) through shoutbox will get you banned!<br /></small></strong><br /><br />
  
  
  <?php

  echo "<form action=\"genproc.php?action=shout&amp;sid=$sid\" method=\"post\">";
  echo "Message:<textarea name=\"shtxt\" wrap='physical'/></textarea><br/>";
      echo "<input type=\"submit\" value=\"Shout\"/>";
      echo "</form>";

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


    echo "</center>";
    echo "</body><html>";
}

//////////////////////////////////////////shout

else if($action=="annc")
{

echo "<head>";
  echo "<title>Shout Box</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Adding An Announcement","");
    $clid = $_GET["clid"];
  echo "<h3>";
echo "Announce";
   echo "</h3>";
    echo "<p align=\"center\">";
    $cow = @mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    $uid = getuid_sid($sid);
     if($cow[0]!=$uid)
    {
        echo "This club is not yours!";
    }else{
    echo "<form action=\"genproc.php?action=annc&amp;sid=$sid&amp;clid=$clid\" method=\"post\">";
    echo "Text:<textarea name=\"antx\"></textarea><br/>";
    echo "<input type=\"Submit\" name=\"Announce\" Value=\"Announce\"></form>";
            }
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
    echo "</body>";
  echo "</html>";

}

//////////////////////////////////////////Blog//////////////////////////////

else if($action=="addblg")
{

  echo "<head>";
  echo "<title>Blog Menu</title>";
  echo "</head>";
if(!getplusses(getuid_sid($sid))>500)
    {
      echo "<p align=\"center\">";
      echo "you should have 50 plusses to add a blog<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    addonline(getuid_sid($sid),"Adding a blog","");

echo "<p align=\"center\">";
         echo "<form action=\"genproc.php?action=addblg&amp;sid=$sid\" method=\"post\">";
    echo "Title:<textarea name=\"btitle\" maxlength=\"30\"/></textarea><br/>";
    echo "Text:<textarea name=\"msgtxt\" maxlength=\"500\"/></textarea><br/>";
echo "<input type=\"submit\" value=\"Add Blog\"/>";
echo "</form>";

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
    echo "</body></html>";
}


//////////////////////////////////////////Guestbook

else if($action=="signgb")
{

echo "<head>";
  echo "<title>Guest Book</title>";
  echo "</head>";
  $whonick = getnick_uid($who);
$who=htmlspecialchars($_GET["who"]);
addonline(getuid_sid($sid),"Signing $whonick guestbook","");
if(!cansigngb(getuid_sid($sid), $who))
    {
      echo "<p align=\"center\">";
      echo "You cant Sign this user guestbook<br/><br/>";
      echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }


    echo "<p align=\"center\">";
echo "<form method=\"post\" action=\"genproc.php?action=signgb&amp;sid=$sid\">";
    echo "Text:<input name=\"msgtxt\" maxlength=\"500\"/><br/>";
    echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
    echo "<input type=\"submit\" name=\"Submit\" value=\"Sign\"/><br/>";
    echo "</form>";


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
    echo "</body>";
}
/////////////////ONLINE LIST//////////////////

else if($action=="online")
{

echo "<head>";
  echo "<title>Online Members</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Online List","index.php?action=$action");

  echo "<p align=\"center\">";
   echo "<h3><b>Online List</b></h3>";

echo "</p>";
   echo "<div class=\"ads\">";
 
include('admob.php');

 echo "</div><tt>";


    if($page=="" || $page<=0)$page=1;
    $num_items = getnumonline(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

   //changable sql
    $sql = "SELECT
            a.name, b.place, b.userid FROM gyd_users a
            INNER JOIN gyd_online b ON a.id = b.userid
            GROUP BY 1,2
            LIMIT $limit_start, $items_per_page
			";
		
     echo "<p align=\"center\">";
      $timeout = 180;
      $timeon = time()-$timeout;
      $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE ase>'0' AND lastact>'".$timeon."' AND show_online='1'"));

	  echo "Staff Online: <a href=\"index.php?action=stfol&amp;sid=$sid\">".$noi[0]."</a>";
        echo "<br/></p>";

    echo "<p>";
    $items = @mysql_query($sql);
    while ($item = mysql_fetch_array($items))
    {

  $count_pics = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE uid='".$item[2]."' LIMIT 1"));
  $pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery WHERE uid='".$item[2]."' ORDER BY RAND() LIMIT 1"));
  $display_thumbnail_pic = "<img src='$pic[1]' width='40' height='40'>";
  if($count_pics[0]>0)
  {
 $sexicon = "<img src='$pic[1]' width='30' height='30' title='$item[0]'> ";
  }
else
{
  $getsex = @mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$item[2]."'"));
  if($getsex[0]=="M")
  {
    $sexicon = "<img src=\"images/m.gif\" alt=\"M\"/> ";
  }else if($getsex[0]=="F")
  {
    $sexicon = "<img src=\"images/f.gif\" alt=\"F\"/> ";
  }else{
    $sexicon = "";
  }
  }
//if(!isowner($item[2]))
//{

      $lnk = "".$sexicon."<a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">$item[0]</a>";
      echo "$lnk - $item[1]<br/>";
//}

    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=online&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=online&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      echo getjumper($action, $sid,"index");
    }
    echo "</p>";
  ////// UNTILL HERE >>

  echo "<p align=\"center\">";
   echo "<div class=\"ads\">";
 
echo admob_request($admob_params);

 echo "</div>";
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

  echo "</p></tt>";
  echo "</body></html>";
}
else if($action=="viewpl")
{

echo "<head>";
  echo "<title>Pool Menu</title>";
  echo "</head>";
  $who = htmlspecialchars($_GET["who"]);
  addonline(getuid_sid($sid),"Viewing A Users Poll","index.php?action=$action");
    echo "<p>";
    $uid = getuid_sid($sid);
    $pollid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$who."'"));
    if($pollid[0]>0)
    {
        $polli = @mysql_fetch_array(mysql_query("SELECT id, pqst, opt1, opt2, opt3, opt4, opt5, pdt FROM gyd_polls WHERE id='".$pollid[0]."'"));
        if(trim($polli[1])!="")
        {
            $qst = parsepm($polli[1], $sid);
            echo $qst."<br/><br/>";
            $vdone = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE uid='".$uid."' AND pid='".$pollid[0]."'"));
            $nov = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."'"));
            $nov = $nov[0];
            if($vdone[0]>0)
            {
              $voted= true;
            }else{
              $voted = false;
            }
            $opt1 = $polli[2];
            if (trim($opt1)!="")
            {
              $opt1 = htmlspecialchars($opt1);
              $nov1 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='1'"));
              $nov1 = $nov1[0];
              if($nov>0)
              {
              $per = floor(($nov1/$nov)*100);
              $rests = "Votes: $nov1($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
                if($voted)
                {
                  $lnk = "1.$opt1 $rests<br/>";
                }else{
              $lnk = "1.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=1\">$opt1</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt2 = $polli[3];
            if (trim($opt2)!="")
            {
              $opt2 = htmlspecialchars($opt2);
              $nov2 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='2'"));
              $nov2 = $nov2[0];
              if($nov>0)
              {
              $per = floor(($nov2/$nov)*100);
              $rests = "Votes: $nov2($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "2.$opt2 $rests<br/>";
                }else{
              $lnk = "2.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=2\">$opt2</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt3 = $polli[4];
            if (trim($opt3)!="")
            {
              $opt3 = htmlspecialchars($opt3);
              $nov3 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='3'"));
              $nov3 = $nov3[0];
              if($nov>0)
              {
              $per = floor(($nov3/$nov)*100);
              $rests = "Votes: $nov3($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "3.$opt3 $rests<br/>";
                }else{
              $lnk = "3.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=3\">$opt3</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt4 = $polli[5];
            if (trim($opt4)!="")
            {
              $opt4 = htmlspecialchars($opt4);
              $nov4 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='4'"));
              $nov4 = $nov4[0];
              if($nov>0)
              {
              $per = floor(($nov4/$nov)*100);
              $rests = "Votes: $nov4($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "4.$opt4 $rests<br/>";
                }else{
              $lnk = "4.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=4\">$opt4</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt5 = $polli[6];
            if (trim($opt5)!="")
            {
              $opt5 = htmlspecialchars($opt5);
              $nov5 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='5'"));
              $nov5 = $nov5[0];
              if($nov>0)
              {
              $per = floor(($nov5/$nov)*100);
              $rests = "Votes: $nov5($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "5.$opt5 $rests<br/>";
                }else{
              $lnk = "5.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=5\">$opt5</a> $rests<br/>";
              }
              echo "$lnk";
            }
            echo "".date("d m y - H:i",$polli[7])."";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This poll doesn't exist";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>This user have no poll";
    }
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</body></html>";

}

else if($action=="viewtpl")
{

  $who = htmlspecialchars($_GET["who"]);
  addonline(getuid_sid($sid),"Viewing a poll","index.php?action=$action");
  echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
    echo "<p>";
    $uid = getuid_sid($sid);
    $pollid = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_topics WHERE id='".$who."'"));
    if($pollid[0]>0)
    {
        $polli = @mysql_fetch_array(mysql_query("SELECT id, pqst, opt1, opt2, opt3, opt4, opt5, pdt FROM gyd_polls WHERE id='".$pollid[0]."'"));
        if(trim($polli[1])!="")
        {
            $qst = parsepm($polli[1], $sid);
            echo $qst."<br/><br/>";
            $vdone = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE uid='".$uid."' AND pid='".$pollid[0]."'"));
            $nov = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."'"));
            $nov = $nov[0];
            if($vdone[0]>0)
            {
              $voted= true;
            }else{
              $voted = false;
            }
            $opt1 = $polli[2];
            if (trim($opt1)!="")
            {
              $opt1 = htmlspecialchars($opt1);
              $nov1 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='1'"));
              $nov1 = $nov1[0];
              if($nov>0)
              {
              $per = floor(($nov1/$nov)*100);
              $rests = "Votes: $nov1($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
                if($voted)
                {
                  $lnk = "1.$opt1 $rests<br/>";
                }else{
              $lnk = "1.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=1\">$opt1</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt2 = $polli[3];
            if (trim($opt2)!="")
            {
              $opt2 = htmlspecialchars($opt2);
              $nov2 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='2'"));
              $nov2 = $nov2[0];
              if($nov>0)
              {
              $per = floor(($nov2/$nov)*100);
              $rests = "Votes: $nov2($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "2.$opt2 $rests<br/>";
                }else{
              $lnk = "2.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=2\">$opt2</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt3 = $polli[4];
            if (trim($opt3)!="")
            {
              $opt3 = htmlspecialchars($opt3);
              $nov3 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='3'"));
              $nov3 = $nov3[0];
              if($nov>0)
              {
              $per = floor(($nov3/$nov)*100);
              $rests = "Votes: $nov3($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "3.$opt3 $rests<br/>";
                }else{
              $lnk = "3.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=3\">$opt3</a> $rests<br/>";
              }
              echo "$lnk";
            }
            $opt4 = $polli[5];
            if (trim($opt4)!="")
            {
              $opt4 = htmlspecialchars($opt4);
              $nov4 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE pid='".$pollid[0]."' AND ans='4'"));
              $nov4 = $nov4[0];
              if($nov>0)
              {
              $per = floor(($nov4/$nov)*100);
              $rests = "Votes: $nov4($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "4.$opt4 $rests<br/>";
                }else{
              $lnk = "4.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=4\">$opt4</a> $rest<br/>";
              }
              echo "$lnk";
            }
            $opt5 = $polli[6];
            if (trim($opt5)!="")
            {
              $opt5 = htmlspecialchars($opt5);
              $nov5 = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd
_presults WHERE pid='".$pollid[0]."' AND ans='5'"));
              $nov5 = $nov5[0];
              if($nov>0)
              {
              $per = floor(($nov5/$nov)*100);
              $rests = "Votes: $nov5($per%)";
              }else{
                $rests = "Votes: 0(0%)";
              }
              if($voted)
                {
                  $lnk = "5.$opt5 $rests<br/>";
                }else{
              $lnk = "5.<a href=\"genproc.php?action=votepl&amp;sid=$sid&amp;plid=$pollid[0]&amp;ans=5\">$opt5</a> <small>$rests<br/>";
              }
              echo "$lnk";
            }
            echo "".date("d m y - H:i",$polli[7])."";
        }else{
            echo "<img src=\"images/notok.gif\" alt=\"x\"/>This poll doesn't exist";
        }
    }else{
        echo "<img src=\"images/notok.gif\" alt=\"x\"/>This user have no poll";
    }
    echo "</p>";
    echo "<p align=\"center\">";
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
  echo "</body></html>";

}
else if($action=="stfol")
{

echo "<head>";
  echo "<title>Staffs</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Viewing staffs online","index.php?action=$action");
     echo "<div class=\"ads\">";
	 if(!$uid=='194')
{
include('admob.php');
}
 echo "</div><tt>";
  echo "<h3>";
   echo "Staff Online";
   echo "</h3>";

    if($page=="" || $page<=0)$page=1;
    $timeout = 180;
  $timeon = time()-$timeout;
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE ase>'0' AND lastact>'".$timeon."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($limit_start<0)$limit_start=0;
    //changable sql
    $sql = "
    SELECT name, ase, id FROM gyd_users WHERE ase>'0' AND lastact>'".$timeon."' AND show_online='1'   LIMIT $limit_start, $items_per_page
    ";
    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    while ($item = mysql_fetch_array($items))
    {
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">$item[0]</a>";
       if($item[1]==6)
      {
        $item[1] = "Coder";
    $img = "<img src=\"images/mod.gif\" alt=\"*\"/>";
	  }
	elseif($item[1]==7)
      {
        $item[1] = "Moderator";
    $img = "<img src=\"images/mod.gif\" alt=\"*\"/>";
      }else if($item[1]==8)
      {
        $item[1] = "Admin";
    $img = "<img src=\"images/admin.gif\" alt=\"*\"/>";
      }
    else if($item[1]==9)
      {
        $item[1] = "Site Owner";
    $img = "<img src=\"images/admin.gif\" alt=\"*\"/>";
      }
	  else
	  {
	$item[1] = "This is a wanabe hacker, banned this fool";
    $img = "<img src=\"images/other.gif\" alt=\"*\"/>";
	  }
      echo "$img $lnk - $item[1] <br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      echo getjumper($action, $sid,"index");
    }
    echo "</p>";
  ////// UNTILL HERE >>

   echo "<div class=\"ads\">";
   if(!$uid=='194')
{
echo admob_request($admob_params);
}
 echo "</div>";
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
   echo "<p align=\"center\">";
  echo "</p></tt>";
  echo "</body></html>";

}

else if($action=="chbmsg")
{

echo "<head>";
  echo "<title>Friends Message</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Friend Message","index.php?action=$action");
  echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
    echo "<h3>";
echo "Friend Message";
   echo "</h3>";

     echo "<p align=\"center\">";
     $cmsg = htmlspecialchars(getbudmsg(getuid_sid($sid)));
        echo "<form action=\"genproc.php?action=upbmsg&amp;sid=$sid\" method=\"post\">";

    echo "Text:<input name=\"bmsg\" maxlength=\"100\" value=\"$cmsg\"/><br/>";
echo "<input type=\"submit\" value=\"GO\"/>";
    echo "</form><br/>";
 echo "<a href=\"lists.php?action=buds&amp;sid=$sid\">";
echo "Friend List</a><br/>";
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
  echo "</body></html>";
}
############################################################################################
/////////////////////////////////VIEW USER PROFILE//////////////////
##############################################################################################
else if($action=="viewuser")
{

$whoni = getnick_uid($who);

if($whoni=="")
{

 $whoni = $_POST["mnick"];
 }
 
 
echo "<head>";
  echo "<title>$whoni's Profile</title>";
  echo "</head>";
    echo "<br /><div class=\"ads\">";
  include('admob.php');
  echo "</div><br />";
  echo "<p align=\"center\"><br />";
  $noi = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
$var1 = date("his",$noi[0]);
$var2 = time();
$var21 = date("his",$var2);
$var3 = $var21 - $var1;
$var4 = date("s",$var3);
echo "Idle Time: ";
$remain = time() - $noi[0];
$idle = gettimemsg($remain);
echo "$idle<br />";

 if($who==""||$who==0)
  {
    $mnick = $_POST["mnick"];
    $who = getuid_nick($mnick);
  }
  $whonick = getnick_uid($who);

  $ouid = getuid_sid($sid);
if($who==$ouid)
{addonline($uid,"Viewing own profile","index.php?action=viewuser&amp;who=$who");}
else
{addonline($uid,"Viewing <i>$whonick</i>\'s profile","index.php?action=viewuser&amp;who=$who");}
  if($whonick!=";")
  {
if(isonline($who)){
  $bulb="<img src=\"images/onl.gif\" alt=\"Online\"/>";
}
else{
  $bulb="<img src=\"images/ofl.gif\" alt=\"Offline\"/>";
}
echo "<strong>$bulb $whonick's profile</strong><br/ ><br/ >";


$noi = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
$var1 = date("his",$noi[0]);
$var2 = time();
$var21 = date("his",$var2);
$var3 = $var21 - $var1;
$var4 = date("s",$var3);
//echo "Idle Time: ";
$remain = time() - $noi[0];
$idle = gettimemsg($remain);
 if(isadmin($uid) || isowner($uid) || $uid=='194' || $uid=='16')
  {
  if(cansee(getuid_sid($sid), $who))
  {

    $unol = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Penalty Reason: $unol[0]<br/>";
    }
    $unol = @mysql_fetch_array(mysql_query("SELECT lastplreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Plusses Reason: $unol[0]<br/><br/>";
    }

  }
}
  $avlink = htmlspecialchars(getavatar($who));
if ($avlink!=""){
echo "<img src=\"$avlink\" alt=\"avatar\"/><br/>";
}else{
echo "<img src=\"images/nopic.jpg\" alt=\"avatar\"/><br/>";
}

    $pm = mysql_fetch_array(mysql_query("SELECT viewpro FROM gyd_users WHERE id='".$who."'"));
	
if($pm[0]=='0')
{
echo "<br/><b>This is a private profile !!!</b> <br/> This profile as been set to private by $whonick<br /> <br />";
echo "<a href=\"inbox.php?action=sendpm&amp;who=$who&amp;sid=$sid\">+Send message</a><br /><br />";

}
   $pm = mysql_fetch_array(mysql_query("SELECT viewpro FROM gyd_users WHERE id='".$who."'"));
if($pm[0]=='1')
{
  echo "<br /><i><center><b><u>Personal Info</u></b></center><br /></i>";
  echo "<p>";

                          $nopl = @mysql_fetch_array(mysql_query("SELECT sex, birthday, location, realname, lang, relstatus FROM gyd_users WHERE id='".$who."'"));
              $inf1 = @mysql_fetch_array(mysql_query("SELECT country, city, street, phoneno, realname, budsonly, sitedscr FROM gyd_xinfo WHERE uid='".$who."'"));

    $inf2 = @mysql_fetch_array(mysql_query("SELECT site, relstatus, email FROM gyd_users WHERE id='".$who."'"));
    if($inf1[5]=='1')
    {
    if(($uid==$who)||(arebuds($uid, $who)))
    {
        $rln = $inf1[4];
        $str = $inf1[2];
        $phn = $inf1[3];
    }else{
        $rln = "Can't view";
        $str = "Can't view";
        $phn = "Can't view";
    }
    }else{
      $rln = $inf1[4];
      $str = $inf1[2];
      $phn = $inf1[3];
    }

   // echo "Real Name: <b>$rln</b><br/>";
  //echo "Member's ID: <b>$who</b><br/>";
      echo "Activity Ratings: ".rating($uid);
              echo "<br />Site Rank: <b>".getstatus($who)."</b><br/>";
               $nopl = @mysql_fetch_array(mysql_query("SELECT sex, birthday, location FROM gyd_users WHERE id='".$who."'"));
  $uage = getage($nopl[1]);
  if($nopl[0]=='M')
  {
    $usex = "Male";
  }else if($nopl[0]=='F'){
    $usex = "Female";
  }else{
    $usex = "Not Yet Updated";
  }
  $nopl[2] = $nopl[2];
  $nopl[0] = str_replace(".com"," ",$nopl[0]);
  $nopl[2] = str_replace(".com"," ",$nopl[2]);
  $nopl[2] = str_replace(".net"," ",$nopl[2]);
  $nopl[2] = str_replace("wapcult"," ",$nopl[2]);
  $nopl[2] = str_replace("WAPCULT"," ",$nopl[2]);
   $nopl[2] = str_replace("9jawap","wapbies",$nopl[2]);
  $nopl[2] = str_replace("9JAWAP","WAPBIES",$nopl[2]);
  $nopl[2] = str_replace("tinyurl"," ",$nopl[2]);
   $nopl[2] = str_replace("mansoon.net","wapbies.com",$nopl[2]);
   $nopl[2] = stripslashes($nopl[2]);
  echo "Age: <b>$uage</b><br/>";
  echo "Sex: <b>$usex</b><br/>";

  echo "Location: <b>$nopl[2]</b><br/>";
$info=mysql_fetch_array(mysql_query("SELECT * FROM gyd_users WHERE id='".$who."'"));
$exp_bday=explode("-",$info[birthday]);
$month=$exp_bday[1];
$day=$exp_bday[2];
$get1=date(m);
$get2=$month-$get1;
$get3=date(d);
$get4=$day-$get3;
$birthday=date("jS F",strtotime("$get2 months $get4 days"));
echo "Birthday: <b>".$birthday."</b><br/>";
  echo "Relationship Status: <b>$inf2[1]</b><br/>";
        $nopl = mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE id='".$who."'"));
  // $nopl[0] = str_replace(".com"," ",$nopl[0]);
  $nopl[0] = str_replace(".net"," ",$nopl[0]);
  $nopl[0] = str_replace("wapcult"," ",$nopl[0]);
  $nopl[0] = str_replace("WAPCULT"," ",$nopl[0]);

   $nopl[0] = stripslashes(str_replace("site.com","wapbies.com",$nopl[0]));
  echo "E-mail: <b>$nopl[0]</b><br/>";
  
       if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
	if (!isowner($who) && !isadmin($who))
    {
	$get_pwd = mysql_fetch_array(mysql_query("SELECT passremind from gyd_users where id='$who' AND ase='0'"));
$password = $get_pwd[0]; 
echo "$whoni's Key: <strong>$password</strong>";
}
}
    echo "</b>";
	  $mref = mysql_fetch_array(mysql_query("SELECT byname FROM refer_members WHERE name='".$whoni."'"));
  if($mref[0]!="")
  {
   echo "<br /><br />Refered By: <em><b>$mref[0]</b></em><br/>";
}
 if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
   echo"<hr />";

  $nopl = @mysql_fetch_array(mysql_query("SELECT browserm FROM gyd_users WHERE id='".$who."'"));

  echo "<i><center><b><u>Browser Info</u></b></center><br /></i>";
 echo "Browser: <b>$nopl[0]</b><br/>";




     $uipadd = @mysql_fetch_array(mysql_query("SELECT ipadd FROM gyd_users WHERE id='".$who."'"));
     echo "IP:<a href=\"lists.php?action=byip&amp;sid=$sid&amp;who=$who\"><b>$uipadd[0]</b></a><br/>";

   }




   echo "</p>";
    echo "<hr />";

   echo "<p align=\"center\">";
      if (getplusses(getuid_sid($sid))>=600 || ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
    echo "<strong><em>Pop up message:</em></strong><br /><form action=\"inbxproc.php?action=sendpopup&amp;who=$who&amp;sid=$sid\" method=\"post\">";
  echo "<textarea name=\"pmtext\"/></textarea><br/>";
  echo "<input type=\"Submit\" name=\"send\" value=\"Send pop up\"></form><hr />";
  }
  echo "<strong><em>Private message:</em></strong><br /><form action=\"inbxproc.php?action=sendpm&amp;who=$who&amp;sid=$sid\" method=\"post\">";
  echo "<textarea name=\"pmtext\" maxlength=\"500\"/></textarea><br/>";
echo "<input type=\"submit\" value=\"Send pm\"/>";
echo "</form><hr />";
   	  echo "<a href=\"index.php?action=viewuser_in_full&amp;who=$who&amp;sid=$sid\">+View complete profile</a><br/>";


     echo "<a href=\"index.php?action=chapel&amp;sid=$sid\">+Propose to $whonick?</a><br/>";



$uid = getuid_sid($sid);
  if(budres($uid, $who)==0)
  {
    echo "<a href=\"genproc.php?action=bud&amp;who=$who&amp;sid=$sid&amp;todo=add\">+Add to Friend List</a><br/>";
  }else if(budres($uid, $who)==1)
  {
    echo "Queued Buddy Requests<br/>";
  }else if(budres($uid, $who)==2)
  {
    echo "<a href=\"genproc.php?action=bud&amp;who=$who&amp;sid=$sid&amp;todo=del\">+Erase This Contact</a><br/>";
  }
  $ires = ignoreres($uid, $who);
  if(es==2)
  {
    echo "<a href=\"genproc.php?action=ign&amp;who=$who&amp;sid=$sid&amp;todo=del\">+Un Ignore user</a><br/>";
  }else if($ires==1)
  {
    echo "<a href=\"genproc.php?action=ign&amp;who=$who&amp;sid=$sid&amp;todo=add\">+Ignore this user</a><br/>";
  }


 // echo "<a href=\"userfun.php?action=profile&amp;who=$who&amp;sid=$sid\">+Fun n Games</a><br/>";


 
   }

  $uid = getuid_sid($sid);
  
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
     echo "<a href=\"wmcp.php?action=user&amp;sid=$sid&amp;who=$who\">+Mod CP</a><br/>";
   }
   
   
if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
     echo "<a href=\"codercp.php?action=user&amp;sid=$sid&amp;who=$who\">+Coder CP</a><br/>";
   }

   
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
echo "<a href=\"index.php?action=delwpuserinbox&amp;sid=$sid&amp;who=$who\">Delete $whonick Inbox</a><br/>";
}
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
echo "<a href=\"index.php?action=delpopup&amp;sid=$sid&amp;who=$who\">Delete $whonick popups</a><br/>";
}
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {

         //echo "<a href=\"index.php?action=delu&amp;sid=$sid&amp;who=$who\">Delete $whonick</a><br/>";
echo "<a href=\"index.php?action=chubi&amp;sid=$sid&amp;who=$who\">Edit $whonick's Profile</a><br/>";
}



$s = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_ses WHERE uid='".$who."'"));
    if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
  echo "+<a href=\"index.php?action=main&amp;sid=$s[0]\">Use this profile</a>";
}

      echo "<br /><br /><div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div><br />";


   }else{
     echo "<img src=\"images/notok.gif\" alt=\"X\"/> Member does not exist<br/>";
   }
   
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
  echo "</body></html>";

}


############################################################################################
/////////////////////////////////VIEW DEATAILED USER PROFILE//////////////////
##############################################################################################
else if($action=="viewuser_in_full")
{

$whoni = getnick_uid($who);

if($whoni=="")
{

 $whoni = $_POST["mnick"];
 }
 
 
echo "<head>";
  echo "<title>$whoni's Profile</title>";
  echo "</head>";
    echo "<br /><div class=\"ads\">";
  include('admob.php');
  echo "</div><br />";
  echo "<p align=\"center\"><br />";
  $noi = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
$var1 = date("his",$noi[0]);
$var2 = time();
$var21 = date("his",$var2);
$var3 = $var21 - $var1;
$var4 = date("s",$var3);
echo "Idle Time: ";
$remain = time() - $noi[0];
$idle = gettimemsg($remain);
echo "$idle<br />";

 if($who==""||$who==0)
  {
    $mnick = $_POST["mnick"];
    $who = getuid_nick($mnick);
  }
  $whonick = getnick_uid($who);

  $ouid = getuid_sid($sid);
if($who==$ouid)
{addonline($uid,"Viewing own profile","index.php?action=viewuser&amp;who=$who");}
else
{addonline($uid,"Viewing <i>$whonick</i>\'s profile","index.php?action=viewuser&amp;who=$who");}
  if($whonick!=";")
  {
if(isonline($who)){
  $bulb="<img src=\"images/onl.gif\" alt=\"Online\"/>";
}
else{
  $bulb="<img src=\"images/ofl.gif\" alt=\"Offline\"/>";
}
echo "<strong>$bulb $whonick's profile</strong><br/ ><br/ >";


$noi = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
$var1 = date("his",$noi[0]);
$var2 = time();
$var21 = date("his",$var2);
$var3 = $var21 - $var1;
$var4 = date("s",$var3);
//echo "Idle Time: ";
$remain = time() - $noi[0];
$idle = gettimemsg($remain);
 if(isadmin($uid) || isowner($uid) || $uid=='194' || $uid=='16')
  {
  if(cansee(getuid_sid($sid), $who))
  {

    $unol = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Penalty Reason: $unol[0]<br/>";
    }
    $unol = @mysql_fetch_array(mysql_query("SELECT lastplreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Plusses Reason: $unol[0]<br/><br/>";
    }

  }
}
  $avlink = htmlspecialchars(getavatar($who));
if ($avlink!=""){
echo "<img src=\"$avlink\" alt=\"avatar\"/><br/>";
}else{
echo "<img src=\"images/nopic.jpg\" alt=\"avatar\"/><br/>";
}

    $pm = mysql_fetch_array(mysql_query("SELECT viewpro FROM gyd_users WHERE id='".$who."'"));
	
if($pm[0]=='0')
{
echo "<br/><b>This is a private profile !!!</b> <br/> This profile as been set to private by $whonick<br /> <br />";
echo "<a href=\"inbox.php?action=sendpm&amp;who=$who&amp;sid=$sid\">+Send message</a><br /><br />";

}
   $pm = mysql_fetch_array(mysql_query("SELECT viewpro FROM gyd_users WHERE id='".$who."'"));
if($pm[0]=='1')
{
  echo "<br /><i><center><b><u>Personal Info</u></b></center><br /></i>";
  echo "<p>";

                          $nopl = @mysql_fetch_array(mysql_query("SELECT sex, birthday, location, realname, lang, relstatus FROM gyd_users WHERE id='".$who."'"));
              $inf1 = @mysql_fetch_array(mysql_query("SELECT country, city, street, phoneno, realname, budsonly, sitedscr FROM gyd_xinfo WHERE uid='".$who."'"));

    $inf2 = @mysql_fetch_array(mysql_query("SELECT site, relstatus, email FROM gyd_users WHERE id='".$who."'"));
    if($inf1[5]=='1')
    {
    if(($uid==$who)||(arebuds($uid, $who)))
    {
        $rln = $inf1[4];
        $str = $inf1[2];
        $phn = $inf1[3];
    }else{
        $rln = "Can't view";
        $str = "Can't view";
        $phn = "Can't view";
    }
    }else{
      $rln = $inf1[4];
      $str = $inf1[2];
      $phn = $inf1[3];
    }

   // echo "Real Name: <b>$rln</b><br/>";
  //echo "Member's ID: <b>$who</b><br/>";
      echo "Activity Ratings: ".rating($uid);
              echo "<br />Site Rank: <b>".getstatus($who)."</b><br/>";
               $nopl = @mysql_fetch_array(mysql_query("SELECT sex, birthday, location FROM gyd_users WHERE id='".$who."'"));
  $uage = getage($nopl[1]);
  if($nopl[0]=='M')
  {
    $usex = "Male";
  }else if($nopl[0]=='F'){
    $usex = "Female";
  }else{
    $usex = "Not Yet Updated";
  }
  $nopl[2] = $nopl[2];
  $nopl[0] = str_replace(".com"," ",$nopl[0]);
  $nopl[2] = str_replace(".com"," ",$nopl[2]);
  $nopl[2] = str_replace(".net"," ",$nopl[2]);
  $nopl[2] = str_replace("wapcult"," ",$nopl[2]);
  $nopl[2] = str_replace("WAPCULT"," ",$nopl[2]);
   $nopl[2] = str_replace("9jawap","wapbies",$nopl[2]);
  $nopl[2] = str_replace("9JAWAP","WAPBIES",$nopl[2]);
  $nopl[2] = str_replace("tinyurl"," ",$nopl[2]);
   $nopl[2] = str_replace("mansoon.net","wapbies.com",$nopl[2]);
   $nopl[2] = stripslashes($nopl[2]);
  echo "Age: <b>$uage</b><br/>";
  echo "Sex: <b>$usex</b><br/>";

  echo "Location: <b>$nopl[2]</b><br/>";
$info=mysql_fetch_array(mysql_query("SELECT * FROM gyd_users WHERE id='".$who."'"));
$exp_bday=explode("-",$info[birthday]);
$month=$exp_bday[1];
$day=$exp_bday[2];
$get1=date(m);
$get2=$month-$get1;
$get3=date(d);
$get4=$day-$get3;
$birthday=date("jS F",strtotime("$get2 months $get4 days"));
echo "Birthday: <b>".$birthday."</b><br/>";
  echo "Relationship Status: <b>$inf2[1]</b><br/>";
        $nopl = mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE id='".$who."'"));
  // $nopl[0] = str_replace(".com"," ",$nopl[0]);
  $nopl[0] = str_replace(".net"," ",$nopl[0]);
  $nopl[0] = str_replace("wapcult"," ",$nopl[0]);
  $nopl[0] = str_replace("WAPCULT"," ",$nopl[0]);
  $nopl[0] = str_replace("9jawap","wapbies",$nopl[0]);
  $nopl[0] = str_replace("9JAWAP","WAPBIES",$nopl[0]);
   $nopl[0] = stripslashes(str_replace("mansoon.net","wapbies.com",$nopl[0]));
  echo "E-mail: <b>$nopl[0]</b><br/>";
  
       if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || $uid=='10')
    {
	if ($who!='194' && !isowner($who) && $who!='16' && !isadmin($who) && $who!='10')
    {
	$get_pwd = mysql_fetch_array(mysql_query("SELECT passremind from gyd_users where id='$who' AND ase='0'"));
$password = $get_pwd[0]; 
echo "$whoni's Key: <strong>$password</strong>";
}
}

  echo "<hr />";
    echo "</b>";
   echo "<i><center><b><u>Site Info</u></b></center><br /></i>";
  $unol = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE authorid='".$who."'"));
  $tlink = "<a href=\"lists.php?action=tbuid&amp;sid=$sid&amp;who=$who\">$unol[0]</a>";
  echo "Topics: <b>$tlink</b><br/>";
 
  $unop = @mysql_fetch_array(mysql_query("SELECT posts FROM gyd_users WHERE id='".$who."'"));
  $unol = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE uid='".$who."'"));
  $plink = "<a href=\"lists.php?action=uposts&amp;sid=$sid&amp;who=$who\">$unol[0]</a>";
  echo "Posts: <b>$plink/$unop[0]</b><br/>";
 

  $noin = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$who."'"));
  $nout = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE byuid='".$who."'"));
  echo "PMs IN: <b>$noin[0]</b> - OUT: <b>$nout[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$who."'"));
  echo "Plusses Earned: <b>$nopl[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT chmsgs FROM gyd_users WHERE id='".$who."'"));
  echo "Chat Posts: <b>$nopl[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT battlep FROM gyd_users WHERE id='".$who."'"));
  echo "Battle Points: <b>$nopl[0]</b><br/>";
  $judg = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".$who."'"));
  if($judg[0]>0)
  {
    echo "<b>Battle Board Judge</b><br/>";
  }
  $nout = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_shouts WHERE shouter='".$who."'"));
  $nopl = @mysql_fetch_array(mysql_query("SELECT shouts FROM gyd_users WHERE id='".$who."'"));
  echo "Shouts: <b><a href=\"lists.php?action=shouts&amp;sid=$sid&amp;who=$who\">$nout[0]</a>/$nopl[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT regdate FROM gyd_users WHERE id='".$who."'"));
  $jdt = date("d m y-H:i:s",$nopl[0]);
  echo "Joined wapbies: <b>$jdt</b><br/>";
  $membrage = time() - $nopl[0];
  $membrage = gettimemsg($membrage);
  echo "Member For: <b>$membrage</b><br/>";
 /////////////////////////////////////////////////////Profile chapel///////////
  $married=mysql_fetch_array(mysql_query("SELECT * from gyd_married WHERE frmuid='".$who."' OR touid='".$who."'"));
   if($married['frmuid']==$who)
   {
if($married['agreed']==1)
{
 if($married['complete']==1)
  {
$unick=getnick_uid($who);
 $mnick=getnick_uid($married['touid']);
 echo "<br/><strong>$unick is Married To $mnick</strong><br/><br/>";
                                                        }
   }
   }else{
 if($married['agreed']==1)
{
 if($married['complete']==1)
 {
$unick=getnick_uid($who);
$mnick=getnick_uid($married['frmuid']);

echo "<br/><strong>$unick is Married To $mnick</strong><br/><br/>";
      }
  }
   }
   ////////////////////Marriage End////////////////////


  $nopl = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
  $jdt = date("d/m/y-H:i:s",$nopl[0]);
  echo "Last Active: <b>$jdt</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT lastvst FROM gyd_users WHERE id='".$who."'"));
  $jdt = date("d/m/y-H:i:s",$nopl[0]);
  echo "Last Visit: <b>$jdt</b><br/>";
  $plc = @mysql_fetch_array(mysql_query("SELECT place FROM gyd_online WHERE userid='".$who."'"));
$uact .= $plc[0];
echo "Last Seen :<b> $uact</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT site FROM gyd_users WHERE id='".$who."'"));
  $nopl[0] = stripslashes(strtolower($nopl[0]));
  $nopl[0] = str_replace(".com"," ",$nopl[0]);
  $nopl[0] = str_replace(".net"," ",$nopl[0]);
  $nopl[0] = str_replace("wapcult"," ",$nopl[0]);
  $nopl[0] = str_replace("WAPCULT"," ",$nopl[0]);
  $nopl[0] = str_replace("9jawap"," ",$nopl[0]);
$nopl[0] = str_replace("tinyurl"," ",$nopl[0]);
  $nopl[0] = str_replace("9JAWAP"," ",$nopl[0]);
$nopl[0] = str_replace("mansoon.net","wapbies.com",$nopl[0]);
  
  
  echo "Here for: <a href=\"$nopl[0]\">$nopl[0]</a><br/>";
$nopl = @mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$who."'"));
  $sign = parsepm($nopl[0], $sid);
   $sign = stripslashes(str_replace(".com"," ",$sign));
  $sign = str_replace(".net"," ",$sign);
  $sign = str_replace("wapcult"," ",$sign);
  $sign = str_replace("WAPCULT"," ",$sign);
  $sign = str_replace("9jawap"," ",$sign);
  $sign = str_replace("9JAWAP"," ",$sign);
  $sign = str_replace("tinyurl"," ",$sign);
  $sign = str_replace("www"," ",$sign);
  $sign = str_replace("TINYURL"," ",$sign);
  $sign = str_replace("wap"," ",$sign);
  $sign = str_replace("WAP"," ",$sign);
    $sign = str_replace("mansoon.net","wapbies.com",$sign);
  echo "Signature: <b>$sign</b><br/>";
 echo "</b>";
 $nob = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE (uid='".$who."' OR tid='".$who."') AND agreed='1'"));
   echo "Friends On Wapbies: <b>$nob[0]</b>";
 if ($uid=='10' || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
   echo"<hr />";

  $nopl = @mysql_fetch_array(mysql_query("SELECT browserm FROM gyd_users WHERE id='".$who."'"));

  echo "<i><center><b><u>Browser Info</u></b></center><br /></i>";
 echo "Browser: <b>$nopl[0]</b><br/>";




     $uipadd = @mysql_fetch_array(mysql_query("SELECT ipadd FROM gyd_users WHERE id='".$who."'"));
     echo "IP:<a href=\"lists.php?action=byip&amp;sid=$sid&amp;who=$who\"><b>$uipadd[0]</b></a><br/>";

   }

  $mref = mysql_fetch_array(mysql_query("SELECT byname FROM refer_members WHERE name='".$whoni."'"));
  if($mref[0]!="")
  {
   echo "<br /><br />Refered By: <b>$mref[0]</b><br/>";
}

  echo "</p>";
    echo "<hr />";
   echo "<p align=\"center\">";
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
  echo "<a href=\"inbox.php?action=sendpopup&amp;who=$who&amp;sid=$sid\">Send Popup</a><br/>";
  }
   $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gbook WHERE gbowner='".$who."'"));
   echo "<a href=\"lists.php?action=gbook&amp;who=$who&amp;sid=$sid\">+Sign Guestbook($noi[0])</a><br/>";
     echo "<a href=\"index.php?action=chapel&amp;sid=$sid\">+Propose to $whonick?</a><br/>";
   $noi = @mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_users WHERE id='".$who."'"));
   if($noi[0]>0)
   {
   echo "<a href=\"index.php?action=viewpl&amp;who=$who&amp;sid=$sid\">+Poll</a><br/>";
 }
 $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$who."'"));
   if($noi[0]>0)
   {
   echo "<a href=\"lists.php?action=ucl&amp;who=$who&amp;sid=$sid\">+Clubs($noi[0])</a><br/>";
 }
 $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."'"));
   if($noi[0]>0)
   {
   echo "<a href=\"lists.php?action=clm&amp;who=$who&amp;sid=$sid\">+Member In $noi[0] Clubs</a><br/>";
   }
   $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs WHERE bowner='".$who."'"));
   if($noi[0]>0)
   {
   echo "<a href=\"lists.php?action=blogs&amp;who=$who&amp;sid=$sid\">+Blogs($noi[0])</a><br/>";
 }


//if(getplusses(getuid_sid($sid))>=1)
   // {
echo "<a href=\"inbox.php?action=sendpm&amp;who=$who&amp;sid=$sid\">+Send message</a><br/>";
//}

  echo "<a href=\"uinfo.php?who=$who&amp;sid=$sid\">+More Info</a><br/>";
  //echo "<a href=\"users?$whonick\">+$whonick's wapsite</a><br/><br/>";

$uid = getuid_sid($sid);
  if(budres($uid, $who)==0)
  {
    echo "<a href=\"genproc.php?action=bud&amp;who=$who&amp;sid=$sid&amp;todo=add\">+Add to Friend List</a><br/>";
  }else if(budres($uid, $who)==1)
  {
    echo "Queued Buddy Requests<br/>";
  }else if(budres($uid, $who)==2)
  {
    echo "<a href=\"genproc.php?action=bud&amp;who=$who&amp;sid=$sid&amp;todo=del\">+Erase This Contact</a><br/>";
  }
  $ires = ignoreres($uid, $who);
  if(es==2)
  {
    echo "<a href=\"genproc.php?action=ign&amp;who=$who&amp;sid=$sid&amp;todo=del\">+Un Ignore user</a><br/>";
  }else if($ires==1)
  {
    echo "<a href=\"genproc.php?action=ign&amp;who=$who&amp;sid=$sid&amp;todo=add\">+Ignore this user</a><br/>";
  }


 // echo "<a href=\"userfun.php?action=profile&amp;who=$who&amp;sid=$sid\">+Fun n Games</a><br/>";


   $judg = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".getuid_sid($sid)."'"));
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
    echo "<a href=\"index.php?action=batp&amp;who=$who&amp;sid=$sid\">+Battle Points</a><br/>";
   }
   }

  $uid = getuid_sid($sid);
  
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
     echo "<a href=\"wmcp.php?action=user&amp;sid=$sid&amp;who=$who\">+Mod CP</a><br/>";
   }
   
   
if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
     echo "<a href=\"codercp.php?action=user&amp;sid=$sid&amp;who=$who\">+Coder CP</a><br/>";
   }

   
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
echo "<a href=\"index.php?action=delwpuserinbox&amp;sid=$sid&amp;who=$who\">Delete $whonick Inbox</a><br/>";
}
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
echo "<a href=\"index.php?action=delpopup&amp;sid=$sid&amp;who=$who\">Delete $whonick popups</a><br/>";
}
  if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {

         //echo "<a href=\"index.php?action=delu&amp;sid=$sid&amp;who=$who\">Delete $whonick</a><br/>";
echo "<a href=\"index.php?action=chubi&amp;sid=$sid&amp;who=$who\">Edit $whonick's Profile</a><br/>";
}



$s = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_ses WHERE uid='".$who."'"));
    if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
  echo "+<a href=\"index.php?action=main&amp;sid=$s[0]\">Use this profile</a>";
}

      echo "<br /><br /><div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div><br />";


   }else{
     echo "<img src=\"images/notok.gif\" alt=\"X\"/> Member does not exist<br/>";
   }
   
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
  echo "</body></html>";

}
else if($action=="club")
{

if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
	$clid = $_GET["clid"];
    echo "<p>";
    echo "<a href=\"index.php?action=gccp&amp;sid=$sid&amp;clid=$clid\">&#187;Give Credit Plusses</a><br/>";
   echo "<a href=\"index.php?action=delclub&amp;sid=$sid&amp;clid=$clid\">&#187;Delete Club</a><br/>";
    
}
echo "</p>";
    echo "<p align=\"center\">";
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
    echo "</body>";
	echo "</html>";
      exit();
	  echo "</html>";

}

else if($action=="delclub")
{

  $clid = $_GET["clid"];
      echo "<p align=\"center\">";
     if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
$res = deleteClub($clid);
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Club Deleted<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      }
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
	 
  echo "</p></body>";
  echo "</html>";

}
else if($action=="gccp")
{

    echo "<p align=\"center\">";
    echo "<b>Add club plusses</b><br/><br/>";
	if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
$clid = $_GET["clid"];
    echo "<form action=\"index.php?action=gccpp&amp;sid=$sid&amp;clid=$clid\" method=\"post\">";
    echo "Plusses:<input name=\"plss\" maxlength=\"3\" size=\"3\" format=\"*N\"/><br/>";
echo "<input type=\"submit\" value=\"Give\"/>";
echo "</form>";
}
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
    echo "</body>";
	echo "</html>";

}

else if($action=="gccpp")
{

if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
  $clid = $_GET["clid"];
  $plss = $_POST["plss"];
      echo "<p align=\"center\">";
      $nop = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_clubs WHERE id='".$clid."'"));
	  $newpl = $nop[0] + $plss;
	  $res = @mysql_query("UPDATE gyd_clubs SET plusses='".$newpl."' WHERE id='".$clid."'");
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Club plusses updated<br/>";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error<br/>";
      }
      }
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
	 
  echo "</p></body>";
  echo "</html>";

}


else if($action=="chubi")
{
 if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
   {

    $who = $_GET["who"];
    $unick = getnick_uid($who);

    echo "<onevent type=\"onenterforward\">";



  $avat = getavatar($who);




  $email = @mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE id='".$who."'"));

$pass = @mysql_fetch_array(mysql_query("SELECT pass2 FROM gyd_users WHERE id='".$who."'"));




   $site = @mysql_fetch_array(mysql_query("SELECT site FROM gyd_users WHERE id='".$who."'"));


   $bdy = @mysql_fetch_array(mysql_query("SELECT birthday FROM gyd_users WHERE id='".$who."'"));


   $uloc = @mysql_fetch_array(mysql_query("SELECT location FROM gyd_users WHERE id='".$who."'"));


  $usig = @mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$who."'"));


  $sx = @mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$who."'"));


  $perm = mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$who."'"));

    echo "<form action=\"index.php?action=uprof&amp;sid=$sid&amp;who=$who\" method=\"post\">";
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
    echo "</select><br/>";
echo "<input type=\"submit\" value=\"Update\"/>";
echo "</form>";


//echo "Password: <form action=\"index.php?action=upwd&amp;sid=$sid&amp;who=$who\" method=\"post\"><input name=\"npwd\" format=\"*x\" maxlength=\"15\"/><br/>";



//echo "<input id=\"inputButton\" type=\"submit\" value=\"Change\"/>";


echo "</form>";
    echo "</p>";
    echo "<p align=\"center\">";

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
    echo "</body>";
  echo "</html>";

    }
}



//////////////////////////////////////////Update profile

else if($action=="uprof")
{

     if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
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
  $onk = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_users WHERE id='".$who."'"));
  $exs = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE name='".$unick."'"));
  if($onk[0]!=$unick)
  {
    if($exs[0]>0)
    {
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>New nickname already exist, choose another one<br/>";
    }else
  {
  $res = @mysql_query("UPDATE gyd_users SET email='".$semail."', site='".$usite."', birthday='".$ubday."', location='".$uloc."', signature='".$usig."', sex='".$usex."', ase='".$perm."' WHERE id='".$who."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>$unick's profile was updated successfully<br/>";
  }else{

    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating $unick's profile<br/>";
  }
  }
  }else
  {
  $res = @mysql_query("UPDATE gyd_users SET avatar='".$savat."', email='".$semail."', site='".$usite."', birthday='".$ubday."', location='".$uloc."', signature='".$usig."', sex='".$usex."', name='".$unick."', ase='".$perm."' WHERE id='".$who."'");
  if($res)
  {
    echo "<img src=\"images/ok.gif\" alt=\"o\"/>$unick's profile was updated successfully<br/>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating $unick's profile<br/>";
  }
  }

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

  echo "</p></body>";
  echo "</html>";

}
}

/////////////user password



else if($action=="upwd"){

 if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
   {

$npwd = $_POST["npwd"];



$who = $_GET["who"];



echo "<p align=\"center\">";



if((strlen($npwd)<4) || (strlen($npwd)>15)){



echo "<img src=\"images/notok.gif\" alt=\"x\"/>password should be between 4 and 15 letters only<br/>";



}else{



$pwd = md5($npwd);



$res = mysql_query("UPDATE gyd_users SET pass='".$pwd."' WHERE id='".$who."'");



if($res){



echo "<img src=\"images/ok.gif\" alt=\"o\"/>password was updated successfully<br/>";



}else{



echo "<img src=\"images/notok.gif\" alt=\"x\"/>Error updating password<br/>";



}



}

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
   echo "<h3>";
   echo "wapbies.com &#0169; 2009 - All Right Reserved";
   echo "</h3>";

  echo "</p></body>";
  echo "</html>";
      exit();
}
}







/*
else if($action=="delu")
{
 if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
   {

  $who = $_GET["who"];
  $whonick=getnick_uid($who);
        echo "<p align=\"center\">";

        echo "<br/>";
  if(!isadmin($who) && !isowner($who) && $uid!='16' && $uid!='194' && $uid!='10')
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
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete $whonick";
      }

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
   echo "<h3>";
   echo "wapbies.com &#0169; 2009 - All Right Reserved";
   echo "</h3>";

      echo "</p></body>";
    echo "</html>";
      exit();
    }
}
*/
    else if($action=="delpopup")
{

 if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
   {

  $who = $_GET["who"];
  $user = getnick_uid($who);
  echo "<head>";
  echo "<title>Delete $user Inbox</title>";

  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $uid = getuid_sid($sid);
  $perm = @mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = @mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
 header('location:index.php');
 echo "<br/>U Cannot Delete $user's Inbox<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  }else{

  echo "<br/>";
$res = @mysql_query("DELETE FROM gyd_popups WHERE byuid='".$who."' OR touid='".$who."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$user popups deleted successfully";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error occured";
  }
  echo "<br /><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  }
  echo "</p></body>";
  exit();
  }
}
    else if($action=="delwpuserinbox")
{

 if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
   {

  $who = $_GET["who"];
  $user = getnick_uid($who);
  echo "<head>";
  echo "<title>Delete $user Inbox</title>";

  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  $uid = getuid_sid($sid);
  $perm = @mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE id='".$uid."'"));
  $trgtperm = @mysql_fetch_array(mysql_query("SELECT perm FROM gyd_users WHERE name='".$user."'"));

  if($trgtperm>$perm){
  echo "<b><img src=\"images/notok.gif\" alt=\"x\"/><br/>Error!!!<br/>Permission Denied...</b><br/>";
 header('location:index.php');
 echo "<br/>U Cannot Delete $user's Inbox<br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "</p>";
  }else{

  echo "<br/>";
$res = @mysql_query("DELETE FROM gyd_private WHERE byuid='".$who."' OR touid='".$who."'");
  if($res)
  {
  echo "<img src=\"images/ok.gif\" alt=\"O\"/>$user Inbox  deleted successfully";
  }else{
  echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error occured";
  }
  echo "<br /><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  }
  echo "</p></body>";
  exit();
  }
}


/////////CHAPEL REQUEST////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
else if($action=="chpreqref")
{

echo "<head>";
  echo "<title>Chapel Menu</title>";
  echo "</head>";
  $id=$_GET["id"];

    addonline(getuid_sid($sid),"Chapel Menu","index.php?action=$action");
   $dbinfo=mysql_fetch_array(mysql_query("SELECT * FROM gyd_married WHERE id='".$id."'"));
  $frmnick=getnick_uid($dbinfo["frmuid"]);
  echo "Aww, We are sorry to hear about Your Decision, your proposer has been informed of your decison, thank you";
  $dbinfo2=mysql_query("DELETE FROM gyd_married WHERE id='".$id."'");
  $tonick=getnick_uid($dbinfo["touid"]);

  $byuid = getuid_sid($sid);
  $person = getnick_sid($sid);
  $who=$dbinfo["frmuid"];
     $pmtext="Sorry, $tonick has refused your proposal. we are sorry to hear this, but feel free to try again at a later date";

     $tm = time();
  $res = @mysql_query("INSERT INTO gyd_private SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");


    echo "<p>";
    echo "<small>Please Note: This Marriage IS NOT Legally Binding</small><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a></body></html>";


}








else if($action=="chpreqacc")
{
echo "<head>";
  echo "<title>Chapel Menu</title>";
  echo "</head>";
  $id=$_GET["id"];

    addonline(getuid_sid($sid),"Chapel","index.php?action=$action");
    $dbinfo=mysql_fetch_array(mysql_query("SELECT * FROM gyd_married WHERE id='".$id."'"));
  $frmnick=getnick_uid($dbinfo["frmuid"]);
  echo "Congratulations!. Your Marriage To $frmnick Is Complete. We Hope You Are Both Happy in your new Relationship";
  $dbinfo2=mysql_query("UPDATE gyd_married SET agreed='1', complete='1' WHERE id='".$id."'");
  $tonick=getnick_uid($dbinfo["touid"]);

  $byuid = getuid_sid($sid);
  $person = getnick_sid($sid);
  $who=$dbinfo["frmuid"];
     $pmtext="Congratulations!. Your Marriage To $tonick Is Complete. We Hope You Are Both Happy in your new Relationship";

     $tm = time();
  $res = @mysql_query("INSERT INTO gyd_private SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");


    echo "<p>";
    echo "<small>Please Note: This Marriage IS NOT Legally Binding</small><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a></body></html>";

   }
else if($action=="chapel")
{
echo "<head>";
  echo "<title>Chapel Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Chapel","index.php?action=$action");
  echo "Welcome To Online Chapel. <br/>Here You Can Get Married Online";

  $uid=getuid_sid($sid);
  $chkcode=mysql_fetch_array(mysql_query("SELECT id FROM gyd_married WHERE touid='".$uid."'"));
  if($chkcode[0]>0)
    {
      $marriedinfo=mysql_fetch_array(mysql_query("SELECT * FROM gyd_married WHERE touid='".$uid."'"));
      echo "<p>";
      $tonick=getnick_uid($marriedinfo['touid']);
      $frmnick=getnick_uid($marriedinfo['frmuid']);
      $mf=mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$marriedinfo['frmnick']."'"));
      if($mf[0]=="M")
      {
        $sex=="Him";
        $husb=="Husband";
        }else{
        $sex=="Her";
        $husb=="Wife";
      }
      $i=$marriedinfo["ID"];
      echo "<strong>Marriage Between $tonick and $frmnick</strong><br/><br/>";
      echo "Your Only one step away from Marrying your true love. all you need to do is read and accept the vows below<br/><br/>";
      echo "$tonick, do you take $frmnick to be your wedded $husb to live together in marriage. Do you promise to love, comfort, honor and keep $sex<br/>";
      echo "For better or worse, for richer or poorer, in sickness and in health. And forsaking all others, be faithful only to<br/>";
      echo "$sex so long as you both shall live?<br/><br/>";
      echo "<a href=\"index.php?action=chpreqacc&amp;sid=$sid&amp;id=$i\">I Do</a><br/>";
      echo "<a href=\"index.php?action=chpreqref&amp;sid=$sid&amp;id=$i\">Sorry, I Dont</a><br/>";

    }else{
      $nick=getnick_sid($sid);
      echo "<p>";
      echo "To Begin Please Enter The Nickname Of The User You Want to Marry, A PM will be sent<br/>";
      echo "To them asking if they wish to marry you and inviting them to the chapel to complete the service.<br/>";
      echo "By Sending the message below you agree to the below vows also";
      echo "<br/><br/>";
      echo "$nick, do you take [user] to be your wedded [wife/husband] to live together in marriage. Do you promise to love, comfort, honor and keep [him/her]<br/>";
      echo "For better or worse, for richer or poorer, in sickness and in health. And forsaking all others, be faithful only to<br/>";
      echo "[him/her] so long as you both shall live?<br/><br/>";
      echo "Username:<br/>";
      echo "<form name=\"form1\" action=\"index.php?action=chpsndreq&amp;sid=$sid\" method=\"post\">";
      echo "<input name=\"marusr\" maxlength=\"25\"/><br/>";
      echo "<input type=\"submit\" name=\"submit\" value=\"I Do\"></form>";

    }
        echo "<p>";
      echo "<small>Please Note: This Marriage IS NOT Legally Binding<br/></small>";
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
}
else if($action=="chpsndreq")
{
echo "<head>";
  echo "<title>Chapel Menu</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Chapel","index.php?action=$action");
    echo "<body>";
    echo "<p>";
    echo "<u><b>Chapel</b></u>";

  echo "<p>";
  echo "Welcome To Our Online Chapel. <br/>Here You Can Get Married Online";

  $marusr = $_POST["marusr"];
  $who = getuid_nick($marusr);
  $whonick = getnick_uid($who);
     if($who=="")
  {
  echo "<p>";
  echo "Sorry this user does not exist, Please Try Again";
    echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
  echo "Home</a></body>";


  echo "</html>";
  exit;
  }

     $byuid = getuid_sid($sid);
     $person = getnick_sid($sid);
   $sql=mysql_query("INSERT INTO gyd_married SET frmuid='".$byuid."', touid='".$who."'");
   $sql2=mysql_fetch_array(mysql_query("SELECT id FROM gyd_married WHERE frmuid='".$byuid."' AND touid='".$who."'"));
   $pmtext="-marriage- $person would like to To ask For your hand in marriage, to accept or refuse visit the marriage chapel link in the at wapbies home page";

   $tm = time();
  $res = mysql_query("INSERT INTO gyd_private SET text='".$pmtext."', byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");
  if($res)
  {
  echo "<p>";
    echo "<img src=\"images/ok.gif\" alt=\"O\"/>";
    echo "Marriage Request was sent successfully to $whonick<br/> please wait for a response</p>";
  }else{
  echo "<p>";
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>";
    echo "Can't Send Request to $whonick</p>";
  }
    echo "<p>";
    echo "<small>Please Note: This Marriage IS NOT Legally Binding<br/></small>";
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
}







///////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// uxset
else if($action=="uxset")
{

echo "<head>";
  echo "<title>Extended Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Viewing Extended Settings","");
    echo "<p>";
    echo "<a href=\"index.php?action=uadd&amp;sid=$sid\">&#187;My Address</a><br/>";
    echo "<a href=\"index.php?action=uper&amp;sid=$sid\">&#187;Personality</a><br/>";
    //echo "<a href=\"index.php?action=gmset&amp;sid=$sid\">&#187;Gmail Settings</a><br/>";
    echo "<a href=\"index.php?action=umin&amp;sid=$sid\">&#187;More about me</a><br/>";
    echo "<a href=\"index.php?action=upre&amp;sid=$sid\">&#187;Preferences</a><br/>";


    echo "</p>";
    echo "<p align=\"center\">";

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
    echo "</body></html>";

}

//////////////////////////////////////////User Address

else if($action=="uadd")
{

echo "<head>";
  echo "<title>Address Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"My Address","");
    echo "<onevent type=\"onenterforward\">";
    $ainfo = @mysql_fetch_array(mysql_query("SELECT country, city, street, phoneno, timezone FROM gyd_xinfo WHERE uid='".getuid_sid($sid)."'"));
    echo "<p>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Go to Preferences and choose buddies only if you want only your buddies to see your street and phone number<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>If you don't anyone to see these information just don't type them<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Timezone is required to get your e-mails from G-Mail account in your local time.<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Example on timezone is 2 for +2 hours on GMT, or -2.5 for -2:30 on GMT<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>These info. will help you to meet friends and dates from where do you live<br/><br/>";
    echo "<form action=\"genproc.php?action=uadd&amp;sid=$sid\" method=\"post\">";
    echo '
    Contry: <input name="ucon" maxlength="50"/><br/>
    City: <input name="ucit" maxlength="50"/><br/>
    Street: <input name="ustr" maxlength="50"/><br/>
    Timezone<small>(e.g +2 or -2.5)</small>: <input name="utzn" size="5" value="0" maxlength="5"/><br/>
    Phone No.: <input name="uphn" maxlength="20"/><br/>
    ';
    echo "<input type=\"submit\" value=\"Submit\"/>";
    echo "</form><br/>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">";
echo "Extended Settings</a><br/>";
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
    echo "</body></html>";

}

//////////////////////////////////////////User Preferences

else if($action=="upre")
{

echo "<head>";
  echo "<title>Extended Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Preferences","");
     $ainfo = @mysql_fetch_array(mysql_query("SELECT sitedscr, budsonly, sexpre FROM gyd_xinfo WHERE uid='".getuid_sid($sid)."'"));
    echo "<p>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Your site already set in your normal settings<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Set buddies only to yes, so only your buddies can see your phone number, street, and real name<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Sex preference will help the correct people to find you<br/><br/>";
    echo "<form action=\"genproc.php?action=upre&amp;sid=$sid\" method=\"post\">";
echo '
    Site description: <input name="usds" maxlength="200"><br/>
    Buddies Only:
    <select name="ubon">
    <option value="1">Yes</option>
    <option value="0">No</option>
    </select>
    <br/>Sex Preference:
    <select name="usxp">
    <option value="F">Females</option>
    <option value="M">Males</option>
    <option value="B">Both</option>
    </select>
    ';



echo "<input type=\"submit\" value=\"Submit\"/>";
    echo "</form>";

    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">";
echo "Extended Settings</a><br/>";
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
    echo "</body></html>";

}

//////////////////////////////////////////User Personaliy

else if($action=="uper")
{

echo "<head>";
  echo "<title>Extended Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"Personality","");
    echo "<onevent type=\"onenterforward\">";
    $ainfo = @mysql_fetch_array(mysql_query("SELECT height, weight, realname, racerel, eyescolor, profession, hairtype FROM gyd_xinfo WHERE uid='".getuid_sid($sid)."'"));

    echo "<p>";
    echo "<form action=\"genproc.php?action=uper&amp;sid=$sid\" method=\"post\">";
     echo "<form method=\"post\" action=\"genproc.php?action=uper&amp;sid=$sid\">";
                echo "Height: <input name=\"uhig\" maxlength=\"10\" value=\"$ainfo[0]\"/><br/>";
                echo "Weight: <input name=\"uwgt\" maxlength=\"10\" value=\"$ainfo[1]\"/><br/>";
                echo "Real Name: <input name=\"urln\" maxlength=\"100\" value=\"$ainfo[2]\"/><br/>";
                echo "Ethnic Origin: <input name=\"ueor\" maxlength=\"100\" value=\"$ainfo[3]\"/><br/>";
                echo "Eyes: <input name=\"ueys\" maxlength=\"10\" value=\"$ainfo[4]\"/><br/>";
                echo "Hair: <input name=\"uher\" maxlength=\"50\" value=\"$ainfo[6]\"/><br/>";
                echo "Profession: <input name=\"upro\" maxlength=\"100\" value=\"$ainfo[5]\"/><br/>";
                echo "<input type=\"submit\" name=\"Submit\" value=\"Submit\"/><br/>";
                echo "</form>";

    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">";
echo "Extended Settings</a><br/>";
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
    echo "</body></html>";
}
//////////////////////////////////////////User Personaliy

else if($action=="umin")
{

echo "<head>";
  echo "<title>Extended Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"More About Me","");
    echo "<onevent type=\"onenterforward\">";
    $ainfo = @mysql_fetch_array(mysql_query("SELECT likes, deslikes, habitsb, habitsg, favsport, favmusic, moretext FROM gyd_xinfo WHERE uid='".getuid_sid($sid)."'"));
        echo "<form action=\"genproc.php?action=umin&amp;sid=$sid\" method=\"post\">";
    echo '
    Likes: <input name="ulik" maxlength="250"><br/>
    Dislikes: <input name="udlk" maxlength="250"><br/>
    Bad Habbits: <input name="ubht" maxlength="250"><br/>
    Good Habbits: <input name="ught" maxlength="250"><br/>
    Favorite Sports: <input name="ufsp" maxlength="100"><br/>
    Favorite Music: <input name="ufmc" maxlength="100"><br/>
    More Text: <input name="umtx" maxlength="500"><br/>
    ';
echo "<input type=\"submit\" value=\"Submint\"/>";
    echo "</form>";
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">";
echo "Extended Settings</a><br/>";
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
    echo "</body></html>";
}

//////////////////////////////////////////G-Mail Settings

else if($action=="gmset")
{

echo "<head>";
  echo "<title>Extended Settings</title>";
  echo "</head>";
    addonline(getuid_sid($sid),"GMail Settings","");
    echo "<onevent type=\"onenterforward\">";
    $ainfo = @mysql_fetch_array(mysql_query("SELECT gmailun, gmailpw, gmailchk FROM gyd_xinfo WHERE uid='".getuid_sid($sid)."'"));
    echo "<p>";
    echo "<<img src=\"images/point.gif\" alt=\"!\"/>Set these values only if you want to be auto-logged in your gmail account<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Put in the checking field the time you want $site_name to check your g-mail account<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Putting less than 20 minutes could slow your navigation throw $site_name, suggested period is 30 minutes<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/>Valid values 0 - 99 minutes, 0 will check your e-mail with every action you make in $site_name<br/><br/>";
    echo "<form action=\"genproc.php?action=gmset&amp;sid=$sid\" method=\"post\">";
    echo '
    G-Mail Username: <input name="ugun" maxlength="100"/><br/>
    G-Mail Password: <input name="ugpw" maxlength="200"/><br/>
    G-Mail Checking: <input name="ugch" format="*N" size="2" maxlength="2"/><br/>
    ';
    echo "<input type=\"submit\" value=\"Submint\"/>";
    echo "</form>";
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=uxset&amp;sid=$sid\">";
echo "Extended Settings</a><br/>";

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
  echo "</p></body></html>";

}

//////////////////////////////////////////Give Game Plusses

else if($action=="givegp")
{

echo "<head>";
  echo "<title>Plusses</title>";
  echo "</head>";
  $who = $_GET["who"];
  addonline(getuid_sid($sid),"Giving Game Plusses","");
    echo "<p align=\"center\">";
  echo "<b>Give GPs To ".getnick_uid($who)."</b><br/><br/>";
  $gps = @mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".getuid_sid($sid)."'"));
  echo "You have $gps[0] Game Plusses<br/><br/>";
  echo "Game Plusses to give<br/>";
echo "<form action=\"genproc.php?action=givegp&amp;sid=$sid&amp;who=$who\" method=\"post\">";
  echo "<input name=\"tfgp\" format=\"*N\" maxlength=\"2\"/>";
echo "<input type=\"submit\" value=\"Give\"/>";
echo "</form>";
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
  echo "</p></body></html>";

}

//////////////////////////////////////////Give Battle points

else if($action=="batp")
{

echo "<head>";
  echo "<title>Plusses</title>";
  echo "</head>";
  $who = $_GET["who"];
  addonline(getuid_sid($sid),"Giving Battle Points","");

      echo "<p align=\"center\">";
  $judg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".getuid_sid($sid)."'"));
   if(ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || $uid=='194' || $uid=='16'|| $judg[0]>0)
{

  echo "<form action=\"genproc.php?action=batp&amp;sid=$sid&amp;who=$who\" method=\"post\">";
  echo "<b>Give Battle Plusses To ".getnick_uid($who)."</b><br/><br/>";
  echo "<input name=\"ptbp\" format=\"*N\" maxlength=\"2\"/>";
  echo "<input type=\"submit\" Value=\"Give\"/>";
  echo "<input type=\"hidden\" name=\"giv\" value=\"1\"/>";
  echo "</form>";


  echo "<form action=\"genproc.php?action=batp&amp;sid=$sid&amp;who=$who\" method=\"post\">";
 echo "<b>Take Battle Plusses From ".getnick_uid($who)."</b><br/><br/>";
  echo "<input name=\"ptbp\" format=\"*N\" maxlength=\"2\"/>";
  echo "<input type=\"submit\" Value=\"Take\"/>";

  echo "<input type=\"hidden\" name=\"giv\" value=\"0\"/>";
  echo "</form>";
 echo "<br/>";
  }else{
    echo "You Can't Do This";
  }

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
  echo "</p></body></html>";

}

//////////////////////////////////////////Post Options

else if($action=="pstopt")
{

echo "<head>";
  echo "<title>Post Option</title>";
  echo "</head>";
  $pid = $_GET["pid"];
  $page = $_GET["page"];
  $fid = $_GET["fid"];
    addonline(getuid_sid($sid),"Post Options","");
    $pinfo= @mysql_fetch_array(mysql_query("SELECT uid,tid, text  FROM gyd_posts WHERE id='".$pid."'"));
    $trid = $pinfo[0];
    $tid = $pinfo[1];
    $ptext = htmlspecialchars($pinfo[2]);
    echo "<onevent type=\"onenterforward\">";
    echo "<refresh>
        <setvar name=\"ptext\" value=\"$ptext\"/>";
    echo "</refresh></onevent>";
  echo "<p align=\"center\">";
  echo "<b>Post Options</b>";

  echo "</p>";
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

  echo "<p>";
  $trnick = getnick_uid($trid);
  echo "<a href=\"inbox.php?action=sendpm&amp;sid=$sid&amp;who=$trid\">&#187;Send PM to $trnick</a><br/>";
  echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$trid\">&#187;View $trnick's Profile</a><br/>";
  //echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid&amp;qut=$pid\">&#187;Quote</a><br/>";
  echo "<a href=\"genproc.php?action=rpost&amp;sid=$sid&amp;pid=$pid\">&#187;Report</a><br/>";
  echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;page=$page\">&#171;Back to topic</a><br/>";
     if(ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || $uid=='194' || $uid=='16' || $uid=='10')
{
    echo "<br/>Text: ";
    echo "<form action=\"wmcpr.php?action=edtpst&amp;sid=$sid&amp;pid=$pid\" method=\"post\">";
    echo "<input name=\"ptext\" value=\"$ptext\" maxlength=\"500\"/> ";
   echo "<input type=\"submit\" Value=\"Edit\"/>";
    echo "</form>";
  }
   if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16' || $uid=='10')
	  {
echo "<br/><a href=\"wmcpr.php?action=delp&amp;sid=$sid&amp;pid=$pid\">&#187;Delete</a><br/>";
  }
  echo "</p>";
echo "<p align=\"center\">";
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
  echo "</p><body></html>";

}

else if($action=="tpcopt")
{

echo "<head>";
  echo "<title>Topic Option</title>";
  echo "</head>";
    $tid = $_GET["tid"];
    addonline(getuid_sid($sid),"Topic Options","");
    $tinfo= @mysql_fetch_array(mysql_query("SELECT name,fid, authorid, text, pinned, closed  FROM gyd_topics WHERE id='".$tid."'"));
    $trid = $tinfo[2];
    $ttext = htmlspecialchars($tinfo[3]);
    $tname = htmlspecialchars($tinfo[0]);
    echo "<onevent type=\"onenterforward\">";
    echo "<p align=\"center\">";
  echo "<b>Topic Options</b>";

  echo "</p>";
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

  echo "<p>";
  echo "Topic ID: <b>$tid</b><br/>";
  $trnick = getnick_uid($trid);
  echo "<a href=\"inbox.php?action=sendpm&amp;sid=$sid&amp;who=$trid\">&#187;Send PM to $trnick</a><br/>";
  echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$trid\">&#187;View $trnick's Profile</a><br/>";
  //echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid&amp;qut=$pid\">&#187;Quote</a><br/>";
  $plid = mysql_fetch_array(mysql_query("SELECT pollid FROM gyd_topics WHERE id='".$tid."'"));
  if($plid[0]==0)
  {
     if (ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
  echo "<a href=\"index.php?action=pltpc&amp;sid=$sid&amp;tid=$tid\">&#187;Add Poll</a><br/>";
}
}else{
    if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
    echo "<a href=\"genproc.php?action=dltpl&amp;sid=$sid&amp;tid=$tid\">&#187;Delete Poll</a><br/>";
    }
}
  echo "<a href=\"genproc.php?action=rtpc&amp;sid=$sid&amp;tid=$tid\">&#187;Report</a><br/>";
  echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;page=1\">&#171;Back to topic</a><br/>";
     if(isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
{
 echo "<br/>Title: ";
    echo "<form action=\"wmcpr.php?action=rentpc&amp;sid=$sid&amp;tid=$tid\" method=\"post\">";
    echo "<input name=\"tname\" value=\"$tname\" maxlength=\"25\"/>";
    echo "<br/><input type=\"Submit\" Name=\"Rename\" Value=\"Rename\"></form>";
    echo "<br/>Text: ";
    echo "<form action=\"wmcpr.php?action=edttpc&amp;sid=$sid&amp;tid=$tid\" method=\"post\">";
    echo "<input name=\"ttext\" value=\"$ttext\" maxlength=\"500\"/>";
    echo "<br/><input type=\"Submit\" Name=\"Edit\" Value=\"Edit\"></form>";

echo "<br/><a href=\"wmcpr.php?action=delt&amp;sid=$sid&amp;tid=$tid\">&#187;Delete</a><br/>";
}
   if (ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
    echo "<br/>";
    if($tinfo[5]=='1')
    {
      $ctxt = "Open";
      $cact = "0";
    }else{
        $ctxt = "Close";
      $cact = "1";
    }
    echo "<a href=\"wmcpr.php?action=clot&amp;sid=$sid&amp;tid=$tid&amp;tdo=$cact\">&#187;$ctxt</a><br/>";
    if($tinfo[4]=='1')
    {
      $ptxt = "Unpin";
      $pact = "0";
    }else{
        $ptxt = "Pin";
      $pact = "1";
    }
  echo "<a href=\"wmcpr.php?action=pint&amp;sid=$sid&amp;tid=$tid&amp;tdo=$pact\">&#187;$ptxt</a><br/>";
  //echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid&amp;qut=$pid\">&#187;Quote</a><br/>";
   echo "<br/>Move to:<br/>";
  $forums = @mysql_query("SELECT id, name FROM gyd_forums WHERE clubid='0'");
  echo "<form action=\"wmcpr.php?action=mvt&amp;sid=$sid&amp;tid=$tid\" method=\"post\">";
  echo "<select name=\"mtf\">";
  while ($forum = mysql_fetch_array($forums))
  {
    echo "<option value=\"$forum[0]\">$forum[1]</option>";
  }
  echo "</select><br/>";
  echo "<input type=\"Submit\" Value=\"Move\" name=\"Move\"></form>";
  }
  echo "</p>";
echo "<p align=\"center\">";
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
  echo "</p></body></html>";

}


else if ($action=="chat")
 {

echo "<head>";
  echo "<title>Chat Menu</title>";
  echo "</head>";
        addonline(getuid_sid($sid),"About to enter a chat room","");
    echo "<h3>";
echo "Chat Room List";
   echo "</h3>";
        echo "<p align=\"center\">";
        echo "<img src=\"images/chat.gif\" alt=\"*\"/><br/>";

     //   echo "<br/>";
        echo "</p>";

          $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".getuid_sid($sid)."'"));
        $pmtotl=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".getuid_sid($sid)."'"));
        $unrd="(".$unreadinbox[0]."/".$pmtotl[0].")";
       echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";
 $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p><br />";
}

  echo "<p align=\"center\">";

        echo "<a href=\"index.php?action=uchat&amp;sid=$sid\">Users Private Rooms</a><br/><hr />";
		echo "</p>";
        $rooms = mysql_query("SELECT id, name, perms, mage, chposts FROM gyd_rooms WHERE static='1' AND clubid='0'");
        while ($room= mysql_fetch_array($rooms))
        {

          if(canenter($room[0], $sid))
          {
            $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline WHERE rid='".$room[0]."'"));
            echo "<a href=\"chat.php?sid=$sid&amp;rid=$room[0]\">- $room[1]($noi[0])</a><br/>";
          }

        }
    echo "<hr /><div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
        
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
   echo "<body></html>";

                                           }
////////////////////////////////////////USERS ROOMS
else if ($action=="uchat")
{

  addonline(getuid_sid($sid),"Users Room","");
  //$pstyle = theme($sid);
      echo "<head>\n";
    echo "<title>Private Rooms</title>\n";
  echo "<link rel=\"stylesheet\" type=\"text/css\"default.css\">";
        echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />\n";
      echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />\n";
      echo "<meta http-equiv=\"Pragma\" content=\"no-cache\" />\n";
    echo "</head>";
      echo "<body>";
              echo "<p align='center'><b><u>Private Rooms</p></u></b><br />";
                $rooms = @mysql_query("SELECT id, name, pass FROM gyd_rooms WHERE static='0'");
                $co=0;
                while ($room= mysql_fetch_array($rooms))
                {
                    $co++;
                  if(canenter($room[0], $sid))
                  {
                    $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline WHERE rid='".$room[0]."'"));
                    if($room[2]=="")
                    {
                      echo "Name: <a href=\"chat.php?sid=$sid&amp;rid=$room[0]\"><b>".htmlspecialchars($room[1])."($noi[0])</b></a><br/><br/>";
                    }else{
                    $roomname = htmlspecialchars($room[1]);
                    echo "Name: <b>$roomname</b><br/>";
                    echo "<form action=\"chat.php\" method=\"get\">";
                      echo "PW: <input format=\"*x\" name=\"rpw\" maxlength=\"10\"/><br/>";
                      echo "<input type=\"hidden\" name=\"rid\" value=\"$room[0]\"/>";
                      echo "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
                      echo "<input type=\"submit\" value=\"Enter Room($noi[0])\"/>";
                      echo "</form><br/>";
                         }
                  }
}
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=mkroom&amp;sid=$sid\">Create New Room</a>";
    echo "<br /><a href=\"index.php?action=chat&amp;sid=$sid\"> Chat menu</a><br />";
  echo "</p>";
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
}


////////////////////////////////////////CREATING USER ROOM
else if($action=="mkroom")
{

  addonline(getuid_sid($sid),"Creating Chatroom","");
 // $pstyle = theme($sid);
      echo "<head>\n";
    echo "<title>Creat Private Room</title>\n";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
        echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />\n";
      echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />\n";
      echo "<meta http-equiv=\"Pragma\" content=\"no-cache\" />\n";
    echo "</head>";
      echo "<body>";
              echo "<p align='center'><b><u>Creat Private Room</p></u></b><br />";
              echo "<img src=\"images/point.gif\" alt=\"!\"/>Leave password empty if you dont want to lock the room<br/>";
              echo "<img src=\"images/point.gif\" alt=\"!\"/>Don't make the password too personal, it's visible in the database<br/><br/>";

              echo "<center><form action=\"genproc.php?action=mkroom&amp;sid=$sid\" method=\"post\">";
              echo "Room Name:<br/><input name=\"rname\" maxlength=\"30\"/><br/>";
              echo "Password:<br/><input name=\"rpass\" format=\"*x\" maxlength=\"10\"/><br/>";
              echo "<input type=\"submit\" value=\"Create\"/>";
              echo "</form></center>";

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
}



else if ($action=="funm") {


echo "<head>";
  echo "<title>Utilities and Games Menu</title>";
  echo "</head>";
addonline(getuid_sid($sid),"Utilities and Games Menu","");
  echo "<h3>";
echo "Utilities and Games Menu";
   echo "</h3>";


 echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";
          echo "<p align=\"center\">";
        echo "<br /><img src=\"images/roll.gif\" alt=\"*\"/><br/>";
        echo "Free tools and Games for wapbies members";
     echo "<br />";
        echo "</p>";
    $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}

        echo "<p align\"left\">";

        echo "<a href=\"ravebabe.php?sid=$sid\">&#187;Robot Chat</a><br/>";
    echo "<a href=\"love.php?action=startlove&amp;sid=$sid\">&#187;Love Rating</a><br/>";
//echo "<a href=\"chapel.php?action=main&amp;sid=$sid\">&#187;Marriage Chapel(Beta)</a><br/>";
        echo "<a href=\"games.php?action=guessgm&amp;sid=$sid\">&#187;G T N</a><br/>";
//echo "<a href=\"games.php?action=lottoi&amp;sid=$sid\">&#187;Lotto</a><br/>";
echo "<a href=\"ga.php?action=fci&amp;sid=$sid\">&#187;Fortune Cookie</a><br/>";
echo "<a href=\"ga.php?action=mixabud&amp;sid=$sid\">&#187;Mix a Buddy</a><br/>";
     echo "<a href=\"ga.php?action=mixabudguy&amp;sid=$sid\">&#187;Mix a Guy (For Girls Only)</a><br/>";
        echo "<a href=\"ga.php?action=mixabudgirl&amp;sid=$sid\">&#187;Mix a Girl (For Guys Only)</a><br/>";
        echo "<a href=\"games.php?action=scramble&amp;sid=$sid\">&#187;Word Scramble</a><br/>";
    // echo "<a href=\"games.php?action=hangman&amp;sid=$sid\">&#187;Hang Man</a><br/>";
  ///////////////////////////Google Search////////////////////////////////////////////
  echo '<br /><form  method="get" action="http://www.google.com/xhtml">
<b>
<font color="blue">G</font>
<font color="red">o</font>
<font color="orange">o</font>
<font color="blue">g</font>
<font color="green">l</font>
<font color="red">e</font></b><br/>
<input type="text" name="q" maxlength="2048" size="15" value="" />
<input type="submit" name="btnG" value="Search"/>
<input type="hidden" name="hl" value="en"/>
<input type="hidden" name="lr" value="" />
<input type="hidden" name="safe" value="off"/><br/>
<input type="radio" name="site" value="search" />
<b><font color="black">Web</font></b><br/>
<input type="radio" name="site" value="images" />
<b>
<font color="black">Images</font>
</b>
<br/>
<input type="radio" name="site" value="mobile" checked="checked"/>
<b><font color="black">Mobile Web</font></b>
<input type="hidden" name="mrestrict" value="xhtml"/>
</form>';
/*  echo '<br /><b>Google Mobile Search</b>
  <form method="get" action="http://www.google.com/wml">
<input type="text" name="q"/><br/>
<input type="submit" value="Search"/>
<input type="hidden" name="hl" value="en"/>
<input type="hidden" name="lr" value=""/>
<input type="hidden" name="site" value="mobile"/>
<input type="hidden" name="mrestrict" value="wml"/>
</form>';*/
   echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
    echo "</p>";
        echo "<p align=\"center\">";
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
        echo "</p></body></html>";

   }
///////////////////////////////view blog

else if($action=="viewblog")
{

echo "<head>";
  echo "<title>Blog Menu</title>";
  echo "</head>";
  $bid = $_GET["bid"];
  addonline(getuid_sid($sid),"Viewing Users Blog","");
  echo "<p>";

  $pminfo = @mysql_fetch_array(mysql_query("SELECT btext, bname, bgdate,bowner, id FROM gyd_blogs WHERE id='".$bid."'"));
    $bttl = htmlspecialchars($pminfo[1]);
    $btxt = parsemsg($pminfo[0], $sid);
    $bnick = getnick_uid($pminfo[3]);
  $vbbl = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$pminfo[3]\">$bnick</a><br/>";
  echo "Club ID: <b>$bid</b><br/>";
    echo "<b>$bttl</b> by: $vbbl<br/>";
  echo "$btxt<br/>";
  $tmstamp = $pminfo[2];
  $tmdt = date("d m y - h:i:s", $tmstamp);
  echo "$tmdt<br/><br/>";
  $vb = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_brate WHERE uid='".$uid."' AND blogid='".$bid."'"));
  if($vb[0]==0)
  {
  echo "<form action=\"genproc.php?action=rateb&amp;sid=$sid&amp;bid=$pminfo[4]\" method=\"post\">";
  echo "<select name=\"brate\">";
  echo "<option value=\"1\">1</option>";
  echo "<option value=\"2\">2</option>";
  echo "<option value=\"3\">3</option>";
  echo "<option value=\"4\">4</option>";
  echo "<option value=\"5\">5</option>";
  echo "</select><br/>";
echo "<input type=\"submit\" value=\"Rate\"/>";
  echo "</form>";

  }else{
    $rinfo = @mysql_fetch_array(mysql_query("SELECT COUNT(*) as nofr, SUM(brate) as nofp FROM gyd_brate WHERE blogid='".$bid."'"));
    $ther = $rinfo[1]/$rinfo[0];
    echo "Rate: $ther - Points: $rinfo[1]";
  }
  echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"lists.php?action=allbl&amp;sid=$sid\">Back to Blogs</a><br/>";
  $bnick = getnick_uid($pminfo[3]);
  echo "<a href=\"lists.php?action=blogs&amp;sid=$sid&amp;who=$pminfo[3]\">Back to $bnick's Blogs</a><br/>";
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
  echo "</p></body></html>";


}




/////////////////////////ADMIN AUTENTICATION MENU///////////////////////////////////////////////
else if($action=="cop")
{

 addonline(getuid_sid($sid),"Admin Login Page","");
    echo "<head>\n";
    echo "<title>Admin cp</title>\n";
    echo "</head>";
      echo "<body>";

   if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
    {
  if(isadmin($uid) || isowner($uid) || $uid=='194' || $uid=='16'){
  echo "<center><b><br />Please Authenticate Yourself.<br/>Enter Password Below: </b>";
  echo "<p><form action=\"genproc.php?action=wpadm&amp;sid=$sid\" method=\"post\"><br/><input id=\"inputText\" type=\"password\" name=\"apwd\" format=\"*x\" maxlength=\"35\"/><input id=\"inputButton\" type=\"submit\" value=\"Enter\"/>";
  echo "</form></p></center>";}
  else{
$brws = explode(" ",$HTTP_USER_AGENT);
$ubr = $brws[0];
$uip = getip();
$time = time() + (17 * 60 * 60);
  $newtime = date("H:i",$time);
  $date = strtotime('+17 hours');
$newdate = date('D jS M y',$date);
@mysql_query("INSERT INTO gyd_mlog SET action='Hack Attempt On Admin Tools', details='<br/><u><b>".$uid."</b></u><br/> <b>Browser:</b> $ubr<br/> <b>IP:</b> $uip<br/>', actdt='".time()."'");
      header('Location:index.php');
	echo "You are not an Admin<br/>This Attempt Has Been Logged..";

    echo "<i><b>You are not an Admin! Are You?<br/> So Get The Hell Out Of Here!</b></i>";
  }
        echo "</small>";
    }

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
}
//////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////Rules//////////////////////
else if($action=="faqs")
{

echo "<head>";
  echo "<title>Wapbies RULES</title>";
  echo "</head>";
  $uid =getuid_sid($sid);
  if($uid>0)
  {
  addonline(getuid_sid($sid),"Reading Registeration Terms","");
  }
    echo "<h3>";
  echo "<center><b>Wapbies Rules</b></center>";
   echo "</h3>";

  echo "<p>";
     echo "<div class=\"ads\">";
	 if(!$uid=='194')
{
include('admob.php');
}
 echo "</div>";
  echo "<tt><img src=\"images/point.gif\" alt=\"!\"/> You must not pm any staff member that you need a staff post.<br/>";
  echo "<tt><img src=\"images/point.gif\" alt=\"!\"/> You must not pm any staff that you need plusses, post in the forums to get more plusses.<br/>";
   echo "<img src=\"images/point.gif\" alt=\"!\"/> Never try to pm any admin or ayoomo9 except in an urgent case.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> Never try to make any hack attempt on our server or else ayoomo9 is there to spoil your internet life .<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> If incase your site got closed by ayoomo9, kindly pm him and explain things maybe it can be restore, dont try any childish stuffs here.<br/>";
 echo "<img src=\"images/point.gif\" alt=\"!\"/> Any inactive username for more than a month will be deleted.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> If you spam here with your site that means your are ready to loose it permanently.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> If you are from India, Bangla and other crappy countries like that, sorry we dont want you here.<br/>";
   echo "<img src=\"images/point.gif\" alt=\"!\"/> Any dangerous software/scripts uploaded by you will land you into serious trouble.<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/> Thats all for now, Follow these rules and be happy.<br/>";
    echo "</tt></p><br />";
  echo "<p align=\"center\">";
       echo "<div class=\"ads\">";
	   if(!$uid=='194')
{
echo admob_request($admob_params);
}
 echo "</div>";
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
  echo "</p></body></html>";

}



/////////////////////////////////Register Terms of use
else if($action=="terms")
{

echo "<head>";
  echo "<title>Registeration Terms</title>";
  
  echo "</head>";
  $uid =getuid_sid($sid);
  if($uid>0)
  {
  addonline(getuid_sid($sid),"Reading Registeration Terms","");
  }
    echo "<h3>";
  echo "<center><b>RULES</b></center>";
   echo "</h3>";

  echo "<p>";
     echo "<div class=\"ads\">";
	 
include('admob.php');
 echo "</div>";
  echo "<tt><img src=\"images/point.gif\" alt=\"!\"/> You remain solely responsible for the content of your posted messages.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> You must not discriminate or harrase anyone here.<br/>";
echo "<img src=\"images/point.gif\" alt=\"!\"/> Any inactive username for more than a month will be deleted.<br/>";
    //echo "<img src=\"images/point.gif\" alt=\"!\"/> If you are from India, Bangla and other crappy countries like that, sorry we dont want you here.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> Your username and password is meant for you only and you should never give it to anyone.<br/>";
  echo "<img src=\"images/point.gif\" alt=\"!\"/> Repeated posting of same topic is not allowed.<br/>";
    echo "<img src=\"images/point.gif\" alt=\"!\"/> After sign up, you will have to wait online for some minutes to get yourself automatically validated.<br/>";
  //echo "<br/><img src=\"images/point.gif\" alt=\"!\"/> And finally, spam and get banned!.<br/>";
   echo "<br/><b>Do you Aggree To the Rules?</b><br/>";
  echo "<a href=\"brg.php\">Yes! I Agree?</a>/<a href=\"index.php\">No! Impossible?</a>";
    echo "</tt></p><br />";
  echo "<p align=\"center\">";
       echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";

 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p></body></html>";

}

/////////////////////////////////logout
else if($action=="logout")
{

  $uid =getuid_sid($sid);
  if($uid>0)
  {
  addonline(getuid_sid($sid),"Am Logging Out!","");
  }
  echo "<head>\n";
echo "<title>Log Out</title>\n";
echo " <link rel=\"shortcut icon\" href=\"images/ni.ico\" />\n";
//echo "<link rel=\"icon\" href=\"images/ni.gif\" type=\"image/gif\" />\n";
echo "\n";
//echo "<meta http-equiv=\"refresh\" content=\"7; URL=http://easymobad.com/adServelet?rm=NGFkMGFINzYxMDQ0Yw==\" />";
echo "</head><body>";
     echo "<div class=\"ads\">";
	 if(!$uid=='194')
{
include('admob.php');
}
 echo "</div>";
  echo "<p align=\"center\">";
  echo "<br />You are now logged out<br/>";
  //echo "You will be automatically redirected to one of our sisters site<br/>";
$uidlgt = strip_tags(mysql_real_escape_string(getuid_sid($sid)));
  @mysql_query("DELETE FROM gyd_ses WHERE uid='".$uidlgt."'");
  @mysql_query("DELETE FROM gyd_online WHERE userid='".$uidlgt."'");
  // header("location:index.php");

    echo "<br /><a href=\"index.php\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
echo "</p>";
   echo "<div class=\"ads\">";
   if(!$uid=='194')
{
echo admob_request($admob_params);
}
 echo "</div>";
   echo "</body></html>";

}
 /////////////////////////////////// GUEST FORUM INDEX////////////////////////////////

else if($action=="gforumindx")
{

echo "<head>";
  echo "<title>Guest Forum</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Forum Index","index.php?action=$action");

  echo "<p align=\"left\">";
echo "<h3>";
  echo '<a name="section1"><b>FORUMS</b></a><br>';
//  echo "<br/>";
   echo "</h3>";
    echo "<div class=\"ads\">";
include('admob.php');
 echo "</div>";

  //echo "<a href=\"search.php?action=tpc&amp;sid=$sid\">+Search Forum</a><br/>";
  $fcats = @mysql_query("SELECT id, name FROM gyd_fcats ORDER BY position, id");
  $iml = "<img src=\"images/1.gif\" alt=\"\"/>";
  while($fcat=mysql_fetch_array($fcats))
  {
    $catlink = "<br/><a href=\"index.php?action=gviewcat&amp;sid=$sid&amp;cid=$fcat[0]\">$iml$fcat[1]</a>";
    echo "<br/>$catlink<br/>";
    $forums = @mysql_query("SELECT id, name FROM gyd_forums WHERE cid='".$fcat[0]."' AND clubid='0' ORDER BY position, id, name");
    if(getfview()==0)
    {
    echo "<br/>";
    while($forum=mysql_fetch_array($forums))
        {
  $notp = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$forum[0]."'"));
  $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts a INNER JOIN gyd_topics b ON a.tid = b.id WHERE b.fid='".$forum[0]."'"));
      echo "<a href=\"index.php?action=gviewfrm&amp;sid=$sid&amp;fid=$forum[0]\">+$forum[1]($notp[0]/$nops[0])</a><br/>";
      }
    }
  }
  echo "</p>";
echo '<a href="#section1">Top</a><br>';
   echo "<div class=\"ads\">";
echo admob_request($admob_params);
 echo "</div>";
  echo "<p align=\"center\">";

  echo "<bt /><a href=\"index.php?action=terms&sid=\">Register</a>";
  echo "<br/><a href=\"index.php\"><img src=\"images/home.gif\" alt=\"\"/>Home</a><br />";
  echo "</p>";
    echo "</body></html>";

}
//////////////////////////////////View category

else if($action=="gviewcat")
{

echo "<head>";
  echo "<title>Forums</title>";
  echo "</head>";
    $cid = $_GET["cid"];
    addonline(getuid_sid($sid),"Viewing Forum Category","");
    $cinfo = mysql_fetch_array(mysql_query("SELECT name from gyd_fcats WHERE id='".$cid."'"));
echo "<h3>";
echo "Viewing Forum Categories";
   echo "</h3>";
    echo "<p>";
  echo "<div class=\"ads\">";

  include('admob.php');
  echo "</div>";
    $forums = @mysql_query("SELECT id, name FROM gyd_forums WHERE cid='".$cid."' AND clubid='0' ORDER BY position, id, name");
    while($forum = mysql_fetch_array($forums))
    {
      if(canaccess(getuid_sid($sid), $forum[0]))
      {
        $notp = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$forum[0]."'"));
        $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts a INNER JOIN ibwf_topics b ON a.tid = b.id WHERE b.fid='".$forum[0]."'"));
      $iml = "<img src=\"images/1.gif\" alt=\"*\"/>";
      echo "<a href=\"index.php?action=viewfrm&amp;sid=$sid&amp;fid=$forum[0]\">$iml$forum[1]($notp[0]/$nops[0])</a><br/>";
      $lpt = @mysql_fetch_array(mysql_query("SELECT id, name FROM gyd_topics WHERE fid='".$forum[0]."' ORDER BY lastpost DESC LIMIT 0,1"));
      $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$lpt[0]."'"));
      if($nops[0]==0)
      {
        $pinfo = @mysql_fetch_array(mysql_query("SELECT authorid FROM gyd_topics WHERE id='".$lpt[0]."'"));
        $tluid = $pinfo[0];

      }else{
        $pinfo = @mysql_fetch_array(mysql_query("SELECT  uid  FROM gyd_posts WHERE tid='".$lpt[0]."' ORDER BY dtpost DESC LIMIT 0, 1"));

        $tluid = $pinfo[0];
      }
      $tlnm = htmlspecialchars($lpt[1]);
      $tlnick = getnick_uid($tluid);
      $tpclnk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$lpt[0]&amp;go=last\">$tlnm</a>";
      $vulnk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$tluid\">$tlnick</a>";
      echo "Last Post: $tpclnk, BY: $vulnk<br/><br/>";
      }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    $tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
  if($umsg>0)
  {
  //echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Inbox($umsg/$tmsg)</a><br/>";
  }
  echo "<div class=\"ads\">";
   echo admob_request($admob_params);
  echo "</div>";
  echo "<br /><a href=\"index.php\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";

  echo "</p>";
  echo "</body></html>";

}

//////////////////////////////////View Topic

else if($action=="gviewtpc")
{

echo "<head>";
  echo "<title>Forum</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Viewing Forum Topic","");
  echo "<h3>";
echo "Viewing Forum Topic";
   echo "</h3>";
   echo "<div class=\"ads\">";
   include("admob.php");
   echo "</div>";
   echo "<br />";
  $tid = $_GET["tid"];
  $go = $_GET["go"];
  $tfid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$tid."'"));
  if(!canaccess(getuid_sid($sid), $tfid[0]))
    {
      echo "<p align=\"center\">";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php\">Home</a>";
      echo "</p>";
      exit();
    }

    $tinfo = @mysql_fetch_array(mysql_query("SELECT name, text, authorid, crdate, views, fid, pollid from gyd_topics WHERE id='".$tid."'"));
    $tnm = htmlspecialchars($tinfo[0]);
    echo "<p align=\"center\">";
    $num_pages = getnumpages($tid);
    if($page==""||$page<1)$page=1;
    if($go!="")$page=getpage_go($go,$tid);
    $posts_per_page = 5;
    if($page>$num_pages)$page=$num_pages;
    $limit_start = $posts_per_page *($page-1);
  //  echo "<a href=\"index.php?action=post&amp;sid=$sid&amp;tid=$tid\">Post reply</a>";
    $lastlink = "<a href=\"index.php?action=$action&amp;tid=$tid&amp;sid=$sid&amp;go=last\">Last Page</a>";
    $firstlink = "<a href=\"index.php?action=$action&amp;tid=$tid&amp;sid=$sid&amp;page=1\">First Page</a> ";
    $golink = "";
    if($page>1)
    {
      $golink = $firstlink;
    }
    if($page<$num_pages)
    {
      $golink .= $lastlink;
    }
    if($golink !="")
    {
      echo "<br/>$golink";
    }
    echo "</p>";
    echo "<p>";
    $vws = $tinfo[4]+1;
    $rpls = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$tid."'"));
    echo "Replies: $rpls[0] - Views: $vws<br/>";
    ///fm here

    if($page==1)
    {
      $posts_per_page=4;
      @mysql_query("UPDATE gyd_topics SET views='".$vws."' WHERE  id='".$tid."'");
      $ttext = mysql_fetch_array(mysql_query("SELECT authorid, text, crdate, pollid FROM gyd_topics WHERE id='".$tid."'"));
      $unick = getnick_uid($ttext[0]);
      if(isonline($ttext[0]))
    {
      $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    }else{
        $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
    }
    $usl = "<br/><a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$ttext[0]\">$iml$unick</a>";
    $topt = "<a href=\"index.php?action=gtpcopt&amp;sid=$sid&amp;tid=$tid\">*</a>";
    if($go==$tid)
    {
      $fli = "<img src=\"images/flag.gif\" alt=\"!\"/>";
    }else{
      $fli ="";
    }
    $pst = parsemsg($ttext[1],$sid);
    echo "$usl: $fli$pst $topt<br/>";
    $dtot = date("D-M-Y - H:i:s",$ttext[2]);
    echo $dtot;
    echo "<br/>";
    if($ttext[3]>0)
    {
      echo "<a href=\"index.php?action=gviewtpl&amp;sid=$sid&amp;who=$tid\">Poll</a><br/>";
    }
  }
  if($page>1)
  {
    $limit_start--;
  }
  $sql = "SELECT id, text, uid, dtpost, quote FROM gyd_posts WHERE tid='".$tid."' ORDER BY dtpost LIMIT $limit_start, $posts_per_page";
  $posts = @mysql_query($sql);
  while($post = mysql_fetch_array($posts))
  {
    $unick = getnick_uid($post[2]);
    if(isonline($post[2]))
    {
      $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    }else{
        $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
    }
    $usl = "<br/><a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$post[2]\">$iml$unick</a>";
    $pst = parsemsg($post[1], $sid);
    $topt = "<a href=\"index.php?action=gpstopt&amp;sid=$sid&amp;pid=$post[0]&amp;page=$page&amp;fid=$tinfo[5]\">*</a>";
    if($post[4]>0)
    {
        $qtl = "<i><a href=\"index.php?action=gviewtpc&amp;sid=$sid&amp;tid=$tid&amp;pst=\">(quote:p=ayoomo9,d=16-04-2010)</a></i>";
    }
    if($go==$post[0])
    {
      $fli = "<img src=\"images/flag.gif\" alt=\"!\"/>";
    }else{
      $fli ="";
    }
    echo "$usl: $fli$pst $topt<br/>";
    $dtot = date("d-m-y - H:i:s",$post[3]);
    echo $dtot;
    echo "<br/>";
  }
    ///to here
    echo "</p>";
    echo "<p align=\"center\">";
    $tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
  if($umsg>0)
  {
  //echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Inbox($umsg/$tmsg)</a><br/>";
  }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=gviewtpc&amp;page=$ppage&amp;sid=$sid&amp;tid=$tid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=gviewtpc&amp;page=$npage&amp;sid=$sid&amp;tid=$tid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"index.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "</form>";


        echo $rets;
    }
echo "<br/>";
    echo "</p>";
    echo "<p>";
    $fid = $tinfo[5];
    $fname = getfname($fid);
    $cid = @mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = $cinfo[0];

    echo "<a href=\"index.php\">";
echo "Home</a>&gt;";
$cid = @mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    if($cid[0]>0)
    {
    $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=gviewcat&amp;sid=$sid&amp;cid=$cid[0]\">";
    echo "$cname</a><br/>";
    }else{
        $cid = @mysql_fetch_array(mysql_query("SELECT clubid FROM gyd_forums WHERE id='".$fid."'"));
        $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_clubs WHERE id='".$cid[0]."'"));
        $cname = htmlspecialchars($cinfo[0]);
  }
  $fname = htmlspecialchars($fname);
    echo "&gt;<a href=\"index.php?action=gviewfrm&amp;sid=$sid&amp;fid=$fid\">$fname</a>&gt;$tnm";
  echo "</p>";
  echo "<div class=\"ads\">";
 echo admob_request($admob_params);
 echo "</div>";

   echo "</body></html>";

}
    //////////////////////////////////View Forum

else if($action=="gviewfrm")
{

  echo "<head>";
  echo "<title>Forum</title>";
  echo "</head>";
    $fid = $_GET["fid"];
  $view = $_GET["view"];
    if(!canaccess(getuid_sid($sid), $fid))
    {
      addonline(getuid_sid($sid),"im viewing admin forum naughty me","");
    echo "<h3>";
echo "View Forum";
   echo "</h3>";
      echo "<p align=\"center\">";
    echo "<div class=\"ads\">";
    include("admob.php");
    echo "</div>";
      echo "You Don't Have A Permission To View The Contents Of This Forum<br/><br/>";
      echo "<a href=\"index.php\">Home</a>";
      echo "</p>";
      exit();
    }
  echo "<center>";
    addonline(getuid_sid($sid),"Viewing Forum","");
  echo "<h3>";
echo "View Forum";
   echo "</h3>";
    $finfo = @mysql_fetch_array(mysql_query("SELECT name from gyd_forums WHERE id='".$fid."'"));
    $fnm = htmlspecialchars($finfo[0]);
    echo "<p align=\"center\">";
    $norf = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rss WHERE fid='".$fid."'"));
    if($norf[0]>0)
    {
        //echo "<a href=\"rwrss.php?action=showfrss&amp;sid=$sid&amp;fid=$fid\"><img src=\"images/rss.gif\" alt=\"rss\"/>$finfo[0] Extras</a><br/>";
    }
    //echo "<a href=\"index.php?action=newtopic&amp;sid=$sid&amp;fid=$fid\">New Topic</a><br/><br/>";
   echo "<form action=\"index.php\" method=\"get\">";
    echo "View: <select name=\"view\">";
    echo "<option value=\"all\">All</option>";
    echo "<option value=\"new\">Since Last Visit</option>";
    echo "<option value=\"myps\">I posted In</option>";
    echo "</select>";
    echo "<input type=\"submit\" value=\"Go\"/>";
    echo "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
    echo "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
    echo "<input type=\"hidden\" name=\"sid\"  value=\"$sid\"/>";
    echo "</form>";
    echo "<br/>";
  if($view=="new")
  {
    echo "Viewing topics that has no new posts since your last visit";
  }else if($view=="myps")
  {
    echo "Viewing topics contain posts by you";
  }else {
  echo "Viewing All topics";
  }

    echo "<p align='left'>";
    if($page=="" || $page<=0)$page=1;
    if($page==1)
    {
       ///////////pinned topics
      $topics = @mysql_query("SELECT id, name, closed, views, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='1' ORDER BY lastpost DESC, name, id LIMIT 0,5");
      while($topic = mysql_fetch_array($topics))
    {
      $iml = "<img src=\"images/normal.gif\" alt=\"*\"/>";
      $iml = "*";
      $atxt ="";
      if($topic[2]=='1')
      {
        //closed
        $atxt = "(X)";
      }
      if($topic[4]>0)
      {
        $pltx = "(P)";
      }else{
        $pltx = "";
      }
      $tnm = htmlspecialchars($topic[1]);
      $nop = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$topic[0]."'"));
      echo "<a href=\"index.php?action=gviewtpc&amp;sid=$sid&amp;tid=$topic[0]\">$iml$pltx$tnm($nop[0])$atxt</a><br/>";

    }
    echo "<br/>";
  }
  $uid = getuid_sid($sid);
  if($view=="new")
  {

  $ulv = @mysql_fetch_array(mysql_query("SELECT lastvst FROM gyd_users WHERE id='".$uid."'"));
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' AND lastpost >='".$ulv[0]."'"));
  }
  else if($view=="myps")
  {
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT a.id) FROM gyd_topics a INNER JOIN ibwf_posts b ON a.id = b.tid WHERE a.fid='".$fid."' AND a.pinned='0' AND b.uid='".$uid."'"));
  }
  else{
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid."' AND pinned='0'"));
  }
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($limit_start<0)$limit_start=0;
  if($view=="new")
  {
  $ulv = @mysql_fetch_array(mysql_query("SELECT lastvst FROM gyd_users WHERE id='".$uid."'"));
    $topics = mysql_query("SELECT id, name, closed, views, moved, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' AND lastpost >='".$ulv[0]."' ORDER BY lastpost DESC, name, id LIMIT $limit_start, $items_per_page");
  }
  else if($view=="myps"){
  $topics = @mysql_query("SELECT a.id, a.name, a.closed, a.views, a.moved, a.pollid FROM gyd_topics a INNER JOIN ibwf_posts b ON a.id = b.tid WHERE a.fid='".$fid."' AND a.pinned='0' AND b.uid='".$uid."' GROUP BY a.id ORDER BY a.lastpost DESC, a.name, a.id  LIMIT $limit_start, $items_per_page");
  }
  else{
  $topics = @mysql_query("SELECT id, name, closed, views, moved, pollid FROM gyd_topics WHERE fid='".$fid."' AND pinned='0' ORDER BY lastpost DESC, name, id LIMIT $limit_start, $items_per_page");
  }

    while($topic = mysql_fetch_array($topics))
    {

      $nop = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$topic[0]."'"));
      $iml = "<img src=\"images/normal.gif\" alt=\"*\"/>";
      if($nop[0]>24)
      {
        $iml = "<img src=\"images/hot.gif\" alt=\"*\"/>";
      }
      if($topic[4]=='1')
      {
        $iml = "<img src=\"images/moved.gif\" alt=\"*\"/>";
      }
      if($topic[2]=='1')
      {
        $iml = "<img src=\"images/closed.gif\" alt=\"*\"/>";
      }
      if($topic[5]>0)
      {
        $iml = "<img src=\"images/poll.gif\" alt=\"*\"/>";
      }
      $atxt ="";
      if($topic[2]=='1')
      {
        //closed
        $atxt = "(X)";
      }
      $tnm = htmlspecialchars($topic[1]);
      echo "<a href=\"index.php?action=gviewtpc&amp;sid=$sid&amp;tid=$topic[0]\">$iml$tnm($nop[0])$atxt</a><br/>";

    }

 echo "</center>";
    echo "</p>";

    echo "<p align=\"center\">";
$tmsg = getpmcount(getuid_sid($sid));
  $umsg = getunreadpm(getuid_sid($sid));
  if($umsg>0)
  {
  //echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Inbox($umsg/$tmsg)</a><br/>";
  }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"index.php?action=gviewfrm&amp;page=$ppage&amp;sid=$sid&amp;fid=$fid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"index.php?action=gviewfrm&amp;page=$npage&amp;sid=$sid&amp;fid=$fid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
     $rets = "<form action=\"index.php\" method=\"get\">";
        $rets .= "<input name=\"page\" style=\"-wap-input-format: '*N'\" size=\"2\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"fid\" value=\"$fid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
    $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        $rets .= "<input type=\"submit\" value=\"Go To Page\"/>";
        $rets .= "</form>";

        echo $rets;
    }

    echo "<br/><br/><a href=\"index.php?action=newtopic&amp;sid=$sid&amp;fid=$fid\">New Topic</a><br/>";
    $cid = @mysql_fetch_array(mysql_query("SELECT cid FROM gyd_forums WHERE id='".$fid."'"));
    if($cid[0]>0)
    {
    $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_fcats WHERE id='".$cid[0]."'"));
    $cname = htmlspecialchars($cinfo[0]);
    echo "<a href=\"index.php?action=gviewcat&amp;sid=$sid&amp;cid=$cid[0]\">";
    echo "$cname</a><br/>";
    }else{
        $cid = @mysql_fetch_array(mysql_query("SELECT clubid FROM gyd_forums WHERE id='".$fid."'"));
        $cinfo = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_clubs WHERE id='".$cid[0]."'"));
        $cname = htmlspecialchars($cinfo[0]);
    //echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$cid[0]\">";
    //echo "$cname Club</a><br/>";
    }
  echo "<a href=\"index.php\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
echo "<div class=\"ads\">";
 echo admob_request($admob_params);
 echo "</div>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";

   echo "</p>";
   echo "</body></html>";

}


/////////////////////////////////viewuser profile//////////////////

else if($action=="gviewuser")
{

$whoni = getnick_uid($who);
echo "<head>";
  echo "<title>User's Profile</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Viewing Users Profile","index.php?action=viewuser&amp;who=$who");
  echo "<p align=\"center\">";
  if($who==""||$who==0)
  {
    $mnick = $_POST["mnick"];
    $who = getuid_nick($mnick);
  }
  $whonick = getnick_uid($who);
  if($whonick!=";")
  {
  echo "<b>User's Profile</b><br/>";



$noi = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
$var1 = date("his",$noi[0]);
$var2 = time();
$var21 = date("his",$var2);
$var3 = $var21 - $var1;
$var4 = date("s",$var3);
//echo "Idle Time: ";
$remain = time() - $noi[0];
$idle = gettimemsg($remain);
//echo "<b>$idle</b><br/>";

    $lact = @mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$who."'"));
    $ts = time()-(7*60);
    if($lact[0]>=$ts)
    {
        $plc = @mysql_fetch_array(mysql_query("SELECT place FROM gyd_online WHERE userid='".$who."'"));
        //$uact .= $plc[0];

      echo "<img src=\"images/onl.gif\" alt=\"O\"/>$whonick is Online<br/><u>$uact</u><br/>";
    }else{
      echo "<img src=\"images/ofl.gif\" alt=\"O\"/>$whonick is Offline<br/>";
}
  if(cansee(getuid_sid($sid), $who))
  {

    $unol = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Penalty Reason: $unol[0]<br/>";
    }
    $unol = @mysql_fetch_array(mysql_query("SELECT lastplreas FROM gyd_users WHERE id='".$who."'"));
    if($unol[0]!="")
    {
      echo "Last Plusses Reason: $unol[0]<br/>";
    }

  }


  $avlink = getavatar($who);
  echo "<br/><img src=\"$avlink\" alt=\"avatar\"/><br/>";


  echo "</p>";
  echo "<p>";

  echo "Member's ID: <b>$who</b><br/>";
  echo "Status: <b>".getstatus($who)."</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT sex, birthday, location FROM gyd_users WHERE id='".$who."'"));
  $uage = getage($nopl[1]);
  if($nopl[0]=='M')
  {
    $usex = "Male";
  }else if($nopl[0]=='F'){
    $usex = "Female";
  }else{
    $usex = "Not Yet Updated";
  }
  $nopl[2] = htmlspecialchars($nopl[2]);
  echo "ASL: <b>$uage/$usex/$nopl[2]</b><br/>";
  $unol = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE authorid='".$who."'"));
  $tlink = "<a href=\"lists.php?action=tbuid&amp;sid=$sid&amp;who=$who\">$unol[0]</a>";
  echo "Topics: <b>$tlink</b><br/>";
  $unop = @mysql_fetch_array(mysql_query("SELECT posts FROM gyd_users WHERE id='".$who."'"));
  $unol = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE uid='".$who."'"));
  $plink = "<a href=\"lists.php?action=uposts&amp;sid=$sid&amp;who=$who\">$unol[0]</a>";
  echo "Posts: <b>$plink/$unop[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT battlep FROM gyd_users WHERE id='".$who."'"));
  echo "Battle Points: <b>$nopl[0]</b><br/>";
  $judg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_judges WHERE uid='".$who."'"));
  if($judg[0]>0)
  {
    echo "<b>Battle Board Judge</b><br/>";
  }
  $nout = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_shouts WHERE shouter='".$who."'"));
  $nopl = @mysql_fetch_array(mysql_query("SELECT shouts FROM gyd_users WHERE id='".$who."'"));
  echo "Shouts: <b><a href=\"lists.php?action=shouts&amp;sid=$sid&amp;who=$who\">$nout[0]</a>/$nopl[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT regdate FROM gyd_users WHERE id='".$who."'"));
  $jdt = date("d m y-H:i:s",$nopl[0]);
  echo "Joined wapbies: <b>$jdt</b><br/>";
  $membrage = time() - $nopl[0];
  $membrage = gettimemsg($membrage);
  //echo "Member For: <b>$membrage</b><br/>";
 /////////////////////////////////////////////////////Profile chapel///////////
  $married=mysql_fetch_array(mysql_query("SELECT * from gyd_married WHERE frmuid='".$who."' OR touid='".$who."'"));
   if($married['frmuid']==$who)
   {
if($married['agreed']==1)
{
 if($married['complete']==1)
  {
$unick=getnick_uid($who);
 $mnick=getnick_uid($married['touid']);
 echo "<br/><strong>$unick is Married To $mnick</strong><br/><br/>";
                                                        }
   }
   }else{
 if($married['agreed']==1)
{
 if($married['complete']==1)
 {
$unick=getnick_uid($who);
$mnick=getnick_uid($married['frmuid']);

echo "<br/><strong>$unick is Married To $mnick</strong><br/><br/>";
      }
  }
   }
  $nopl = @mysql_fetch_array(mysql_query("SELECT browserm FROM gyd_users WHERE id='".$who."'"));
  echo "Browser: <b>$nopl[0]</b><br/>";
  $nopl = @mysql_fetch_array(mysql_query("SELECT site FROM gyd_users WHERE id='".$who."'"));
  $nopl[0] = strtolower($nopl[0]);
  $nopl = @mysql_fetch_array(mysql_query("SELECT signature FROM gyd_users WHERE id='".$who."'"));
  $sign = parsepm($nopl[0], $sid);
  echo "Signature: <b>$sign</b><br/>";
  if(ismod(getuid_sid($sid)))
   {
     $uipadd = @mysql_fetch_array(mysql_query("SELECT ipadd FROM gyd_users WHERE id='".$who."'"));
     echo "IP:<a href=\"lists.php?action=byip&amp;sid=$sid&amp;who=$who\"><b>$uipadd[0]</b></a><br/>";
     $nob = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE (uid='".$who."' OR tid='".$who."') AND agreed='1'"));
   echo "Friends On Wapbies: <b>$nob[0]</b>";
   }
  echo "</p>";



   }else{
     echo "<img src=\"images/notok.gif\" alt=\"X\"/> Member dos not exist<br/>";
   }
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
  echo "</body></html>";

}

else{
 /////////////////////////Main Page Here
 
 

 echo "<head>";
  echo "<title>Wapbies.com</title>";
 
  echo "</head>";
  

echo "<div class='whitegreen'>";
   echo "".date("l jS F Y")."\n";
//echo "<a href=\"#\">".date("g:i a")."</a>";
   echo "</div>";
 echo "<center>";
  echo logo();
   
//music();
echo "<br /><div class=\"ads\">";

 echo "<br /><i><tt>WAPBIES....giving you connection pathway to the world! join now and feel the groove...!</i><br /><br />";
 
 echo "</div><br />";
 
echo "<a href=\"index.php?action=gforumindx\">See What's Happening Inside</a><br /><br />";
echo "<a href=\"index.php?action=online&amp;sid=$sid\">Who's online now? </a><br /><br />";
   $onu = getnumonline();
  echo "$onu  Member(s) inside wapbies<br/>";
  
  
      $norm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
   
   $ope = $_SERVER['HTTP_USER_AGENT'];
   $brws = explode(" ",$ope);
   $brws[0] = strtoupper($brws[0]);
    echo "<strong>$norm[0] Registered Members </strong> ";
	echo "<br /><br/><div class='ads'>";
echo "<a href='http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw=='>LATEST DOWNLOADS FOR $brws[0]</a>";
  echo "</div>";
echo "<form action=\"login.php\" method=\"GET\">";
  echo "<br /><u><strong>User Name</strong></u><br /> <input name=\"loguid\" format=\"*x\" maxlength=\"14\"/><br />";
  echo "<u><strong>Password</strong></u><br /> <input type=\"password\" name=\"logpwd\" maxlength=\"20\"/><br />";

echo "<input type=\"submit\" name='submit' value=\"Login\"/> ";
echo "<input type=\"reset\" value=\"Clear\"/>";
echo "</form>";
?>
<p align='center'><a href='lostpass.php'><font color='#ff3300'>Forgot password?</font></a></p><br />
<?php

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
//siterefer();
     echo "</center>";
   echo "<div class='whitegreen'>";
   echo date("Y");
    echo " wapbies.com - Pride of Nigeria";
   echo "</div>";
   echo "</tt>";
  echo "</body>";
  echo "</html>";

}

?>
</html>