<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
########################################################################################################################
#   ////////* THIS SCRIPT EDITED BY AYOOMO9 AND DOWNLOADED FROM wapbies.com*//////////////////////////                 #
#///This script allow users to send an email for free on your site/////////////////////////////////////////////////////#
#////////////////You must not edit or remove this note/////////////////////////////////////////////////////////////////#
#//////The licence of this free script remain valid except if you remove my copyright//////////////////////////////////#
#//////////I have all the the right to contact your hosting company and have it removed from your folder///////////////#
#///////////////////If you got any problem about making it work, just send me an email ayoomo9@yahoo.com///////////////#
#////////////////////////////Get more free scripts at wapbies.com//////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
########################################################################################################################

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
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>wapbies mobile social online community</title>
<script src="rotate.js" type="text/javascript"></script>
<script src="gtext.js" type="text/javascript"></script>
<script src="prt.js" type="text/javascript"></script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="StyleSheet" type="text/css" href="default.css" />
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
Ayo, Omotosho, Ayokanmi, forum, unaab, love, stories, money, free money,
free website, computer, microsoft, entertainment, news football, news, chelsea,
man united, bacerlona, soccer, celebs, live cams, love, bible, forex, messages,
sms, personals, advertise, clubs, downloads" />
<meta name="MSSmartTagsPreventParsing" content="True" />
</head>

<?php
?>

<?php
echo "<body>";


$bcon = connectdb();
if (!$bcon)
{
echo "<meta http-equiv=\"refresh\" content=\"3; URL=maintainance.php />";
    echo "<head>";
    echo "<title>Error!!!</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
	echo "<div class=\"ads\">";
	include("admob.php");
	echo "</div>";
    echo "<p align=\"center\">";
    echo "<img src=\"images/notok.gif\" alt=\"!\"/><br/>";
    echo "<strong>Cannot Connect To Database...</strong>";
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

$action = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["action"]))));
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
$page = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["page"]))));
$who = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["who"]))));
$uid = strip_tags(mysql_real_escape_string(getuid_sid($sid)));

$type1 = $_GET["type"];
cleardata();
if(isipbanned($uip,$ubr))
  {
if(!isshield(getuid_sid($sid)))
  {
  echo "<head>";
  echo "<title>Ip Blocked!!!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  echo "<p align=\"center\">";
  echo "<img src=\"images/notok.gif\" alt=\"!\"/>";
  echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
  echo "<b>This IP address is blocked!!!</b><br />";
  echo "<br />";
  echo "How ever we grant a shield against IP-Ban for our great users, you can try to see if you are shielded by trying to log-in, if you kept coming to this page that means you are not shielded, so come back when the ip-ban period is over<br/><br/>";
  $banto = mysql_fetch_array(mysql_query("SELECT  timeto FROM gyd_pur WHERE  penalty='2' AND ipadd='".$uip."' AND browserm='".$ubr."' LIMIT 1 "));
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

//echo isbanned($uid);
if(isbanned($uid))
    {
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
include("admob.php");
      echo "<br />You are <b>Banned from $sitename</b><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
	  $banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
	  
      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
	  echo "Ban Reason: $banres[0]";
	  echo "<br />";
	  echo admob_request($admob_params);
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }

$res = mysql_query("UPDATE gyd_users SET browserm='".$ubr."', ipadd='".$uip."' WHERE id='".getuid_sid($sid)."'");




if($action=="files")
{
echo "<p align=\"center\"><b><big>Search File</big><br /></b></p>";
  addonline(getuid_sid($sid),"File search","");

  echo "<form action=\"searchfile.php?action=sfiles&amp;sid=$sid\" method=\"post\"><p>";
  echo "Filename:<br/> <input id=\"inputText\" name=\"sname\" maxlength=\"30\"/><br/>";
  echo "Uploaded By:<br/> <input id=\"inputText\" name=\"sby\" maxlength=\"30\"/><br/>";
  echo "Description:<br/> <input id=\"inputText\" name=\"sdec\" maxlength=\"30\"/><br/>";
  echo "Filetype:<br/> <select id=\"inputText\" name=\"stype\">";
  echo "<option value=\"7\">All files</option>";
  echo "<option value=\"1\">Video</option>";
  echo "<option value=\"2\">Image</option>";
  echo "<option value=\"3\">Audio</option>";
  echo "<option value=\"4\">Document</option>";
  echo "<option value=\"5\">Archive</option>";
  echo "<option value=\"6\">Application</option>";
  echo "</select><br/>";
 echo "<input id=\"inputButton\" type=\"submit\" value=\"Search\"/>";
  echo "</p></form>";
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
 
 echo "</p></body><html>";
 exit();
}
else if($action=="sfiles")
{
 $fname = mysql_real_escape_string($_POST["sname"]);
 $fby = mysql_real_escape_string($_POST["sby"]);
 $ftype = mysql_real_escape_string($_POST["stype"]);
 $fdec = mysql_real_escape_string($_POST["sdec"]);
  addonline(getuid_sid($sid),"Searching for files","");
  echo "<p>";
   
  $uid = getuid_nick($fby);
if ($uid!=""){
$part="uid = '".$uid."' AND";
}
else{
$part="";
}

	  switch($ftype){
	   case 1:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='video'"));
if($page=="" || $page<1)$page=1;
$num_items = $noi[0];
$items_per_page = 10;    $num_pages = ceil($num_items/$items_per_page);
if(($page>$num_pages)&&$page!=1)$page= $num_pages;
$limit_start = ($page-1)*$items_per_page; 
     $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='video' LIMIT $limit_start, $items_per_page";
	       break;
	   case 2:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='image'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;  
     $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='image' LIMIT $limit_start, $items_per_page";
	       break;
	   case 3:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='audio'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page; 
      $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='audio' LIMIT $limit_start, $items_per_page";
	       break;
	   case 4:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='document'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page; 
      $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='document' LIMIT $limit_start, $items_per_page";
	       break;
	   case 5:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='archive'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page; 
      $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='archive' LIMIT $limit_start, $items_per_page";
	       break;
	   case 6:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='apps'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page; 
      $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='apps' LIMIT $limit_start, $items_per_page";
	       break;
	   case 7:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page; 
      $sql = "SELECT filename FROM gyd_uploads WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' LIMIT $limit_start, $items_per_page";
	       break;
	  }
	  
       
             echo "<p><center><b><u>Search Results</u></b></center><br/><br/>";
             echo "<center>$noi[0] Results Found!</center><br/>";
             echo "<hr/>";

if($noi[0]=='0')
{ echo "<center>No results! Please refine your search query!</center></p>"; }
else
{

     $items = mysql_query($sql);
     while($item=mysql_fetch_array($items))
     {
		        $tlink = "<a href=\"share.php?action=viewdetails&amp;sid=$sid&amp;file=$item[0]&amp;site=xhtml\">".$item[0]."</a><br/>";

                echo "$tlink";
           }
	   echo "<hr/></p>";
     echo "<p>";
  if($page>1)
  {
   $ppage = $page-1;
    $rets = "<form action=\"searchfile.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
    $rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
    $rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
    $rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";

    $rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
    $rets .= "<input id=\"inputButton\" type=\"submit\" value=\"&#171;Prev\"/></form> ";

    echo $rets;
   
  }
  if($page<$num_pages)
  {
   $npage = $page+1;
    $rets = "<form action=\"searchfile.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
    $rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
    $rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
    $rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";
    $rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
     $rets .= "<input id=\"inputButton\" type=\"submit\" value=\"&#187;Next\"/></form> ";

    echo $rets;
   
  }
  echo "<br/>Page $page of $num_pages<br/>";
  if($num_pages>2){
  echo "Jump to page:";
    $rets = "<form action=\"searchfile.php?action=$action&amp;sid=$sid\" method=\"post\">";
$rets .= "<input type=\"text\" name=\"page\" format=\"*N\" size=\"3\"/>";

    $rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
    $rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
    $rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";
    $rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
    $rets .= "<input id=\"inputButton\" type=\"submit\" value=\"Go\"/></form>";
      echo $rets;
 
}}    
  
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
echo "</p></body><html>";
 exit();
}


else{
 addonline(getuid_sid($sid),"Lost in search?","");
 echo "<p align=\"center\">";
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
 echo "</p></body><html>";
 exit();

}

?>
</font></body>
</html>