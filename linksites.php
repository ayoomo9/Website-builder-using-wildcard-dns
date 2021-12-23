<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_browser();

check_method();
header("location:index.php");
include_once('header.php');
echo "<?xml version=\"1.0\"?>";
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
$action = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["action"]))));
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
$page = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["page"]))));
$who = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["who"]))));
$uid = strip_tags(mysql_real_escape_string(getuid_sid($sid)));

$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];
$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));
cleardata();

if(isipbanned($uip,$ubr))
    {
      if(!isshield(getuid_sid($sid)))
      {
      echo "<head>";
      echo "<title>Error</title>";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "This IP address is blocked<br/>";
      echo "<br/>";
      echo "How ever we grant a shield against IP-Ban for our great users, you can try to see if you are shielded by trying to log-in, if you kept coming to this page that means you are not shielded, so come back when the ip-ban period is over<br/><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT  timeto FROM gyd_pur WHERE  penalty='2' AND ipadd='".$uip."' AND browserm='".$ubr."' LIMIT 1 "));
      //echo mysql_error();
      $remain =  $banto[0] - time();
      $rmsg = gettimemsg($remain);
      echo " IP: $rmsg<br/><br/>";
      
      echo "</p>";
      echo "<p>";
      echo "<form action=\"login.php\" method=\"get\">";
      echo "<b>Username: </b><br/><input name=\"loguid\" format=\"*x\" size=\"12\" maxlength=\"12\"/><br/>";
      echo "<b>Password: </b><br/><input type=\"password\" name=\"logpwd\" size=\"10\" maxlength=\"10\"/><br/>";
      echo "<br/><input name=\"Login\" type=\"submit\" value=\"Login\"></form>";
  echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
      }
    }
if(($action != "") && ($action!="terms"))
{
    $uid = getuid_sid($sid);
    if((islogged($sid)==false)||($uid==0))
    {
	//echo "<meta http-equiv=\"refresh\" content=\"10; URL=index.php\" />";
      echo "<head>";
      echo "<title>Error!!! Not Login!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<strong>You are not logged in<br/>";
      echo "Or Your session has been expired</strong><br/><br />";

 
  echo "<h3>";
echo "".date("l jS F Y",strtotime("-0 hours"));
	 echo "</h3>";
 echo "<center>";
  echo logo(); 
echo "<img src=\"welcome.gif\" alt=\"loading.....\" />";
 echo "To Wapbies.com mobile web online social networking community<br />";
  echo "Meet lots of interesting people, send free e-mail, chat and gain different ideas<br /><br />";
  echo "<a href=\"index.php?action=gforumindx\">See What's Happening Inside</a><br /><br />";

$onu = getnumonline();
  echo "$onu  Member inside wapbies<br />";


    $norm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
    echo "<strong>$norm[0] Registered Members</strong>";
	 echo "<div class=\"ads\">";
include("admob.php");
 echo "</div>";
 
echo "<form action=\"login.php\" method=\"GET\">";
  echo "<br /><u>User Name</u><br /> <input name=\"loguid\" format=\"*x\" maxlength=\"20\"/><br />";
  echo "<u>Password</u><br /> <input type=\"password\" name=\"logpwd\" maxlength=\"20\"/><br />";
echo "<input type=\"submit\" value=\"Login\"/>";
echo "</form>";
 echo "Signing up is totally free and easy, <a href=\"index.php?action=terms&amp;sid=$sid\">Sign Up Now</a><br />";
 echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
 echo "<u><b>Featured Members</b></u><br /><br />";
  
  
$pic = mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"30\" height=\"30\"/></a>";
$pic = mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"30\" height=\"30\"/></a>";
$pic = mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"30\" height=\"30\"/></a>";
$pic = mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "<a href=\"index.php?action=gviewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"30\" height=\"30\"/></a>";
	   echo "<hr />
<strong>Browser:</strong> ".browser()."<br />
<strong>Ip Address:</strong> ".ip()."
<br />";
if (getenv(HTTP_X_FORWARDED_FOR)=="") {
$ip = getenv(REMOTE_ADDR);
}
else {
$ip = getenv(HTTP_X_FORWARDED_FOR);
}
$numbers=explode (".",$ip);
$code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);    
$lis="0";
$user = file("data.dat");
for($x=0;$x<sizeof($user);$x++) {
$temp = explode(";",$user[$x]);
$opp[$x] = "$temp[0];$temp[1];$temp[2];$temp[3];$temp[4];";
if($code >= $temp[0] && $code <= $temp[1]) {
$list[$lis] = $opp[$x];
$lis++; 
}
}
if(sizeof($list) != "0") {
for ($i=0; $i<sizeof($list); $i++){
$p=explode(';', $list[$i]);
echo "<strong>Country:</strong> $p[4]";
}
}else{echo "<strong>Country:</strong> Unknown"; }



//include ('dcou.php');
/*echo "<b>Total Hits:</b>";
include("newcounter.php");*/
$referer = siterefer();
$fp = fopen("refer.txt","a+");
fwrite($fp,"$referer");
fclose($fp);
	   echo "</center>";
	 echo "<h3>";
	 echo "&#0169; 2009 wapbies.com - All Right Reserved";
	 echo "</h3>";
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

////////////////////////////////////////ADVERT MENU MAIN PAGE
  echo "<head>";
  echo "<title>Adverts Menu</title>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
  echo "</head>";
  echo "<body>";
  addonline(getuid_sid($sid),"Adverts","");
  $nick = getnick_uid($uid);
  	echo "<div class=\"ads\">";
echo "<a href=\"http://easymobad.com\">Got a wapsite? Make money here!</a>";
echo "</div><br />";

  echo "<p align=\"center\"><i>Hello <b>$nick</b>, welcome to wapbies premium advert menu.<br />We can help you put your advert link here for a token fee.<br />Contact admin@wapbies.com or send a pm to Admin.</i></p><br /><br />";
 
    echo "<p>";
      $query = mysql_query("SELECT url, title FROM gyd_links");
while ($links = mysql_fetch_array($query)) 
{
   $link = "<a href=\"$links[0]\">$links[1]</a>";

   if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
   $del = "<a href=\"pnproc.php?action=linkdel&amp;sid=$sid&amp;link=$links[0]\">[X]</a>";
   }
   echo "$link $del<br/>";
}
    echo "</p>";
    echo "<p>";

   if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
  echo "<br /><a href=\"pn.php?action=addlink&amp;sid=$sid\">Add New Link</a><br/>";
  }
  
  	echo "<br /><div class=\"ads\">";
echo "<a href=\"http://easymobad.com\">Earn cool cash online!</a>";
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
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
  echo "</p>";
  echo "</body>";
?>
</html>