<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_query();
check_browser();

check_method();
//session_start();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head><title>$site_name</title>";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies :)\"> 
<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
echo "<body>";

$bcon = connectdb();
if (!$bcon)
{
    echo "<p align=\"center\">";
    echo "<img src=\"images/exit.gif\" alt=\"*\"/><br/>";
    echo "ERROR! cannot connect to database<br/><br/>";
    echo "This error happens usually when backing up the database, please be patient, The site will be up any minute<br/><br/>";
    echo "Soon, we will offer services that doesn't depend on MySQL databse to let you enjoy our site, while the database is not connected<br/>";
    echo "<b>THANK YOU VERY MUCH</b>";
    echo "</p>";
    echo "</body>";
    echo "</html>";
    exit();
}
$brws = explode(" ",$HTTP_USER_AGENT);
$ubr = $brws[0];
$uip = getip();
$action = $_GET["action"];
$sid = $_GET["sid"];
$page = $_GET["page"];
$who = $_GET["who"];

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
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "You are <b>Banned</b><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
if($action=="")
{
  addonline($uid,"Viewing User Profile","");
  echo "<p align=\"center\">";
  $whonick = getnick_uid($who);
  echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick's Basic Profile</a>";
  echo "</p>";
  echo "<p>";
  $regd = mysql_fetch_array(mysql_query("SELECT regdate FROM gyd_users WHERE id='".$who."'"));
  $sage = time()-$regd[0];
  $rwage = ceil($sage/(24*60*60));
  echo "&#187;wapbies age: <b>$rwage days</b><br/>";
  echo "&#187;wapbies rating(0-5): <b>".geturate($who)."</b><br/>";
  $pstn = mysql_fetch_array(mysql_query("SELECT posts FROM gyd_users WHERE id='".$who."'"));
  $ppd = $pstn[0]/$rwage;
  echo "&#187;Posts info: <b>$pstn[0]</b> posts, with average of <b>$ppd</b> posts/day<br/>";
  $chpn = mysql_fetch_array(mysql_query("SELECT chmsgs FROM gyd_users WHERE id='".$who."'"));
  $cpd = $chpn[0]/$rwage;
  echo "&#187;Chating info: <b>$chpn[0]</b> chat messages, with average of <b>$cpd</b> chat messages/day<br/>";
  $gbsg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gbook WHERE gbsigner='".$who."'"));
  echo "&#187;Have signed: <b>$gbsg[0] Guestbooks</b><br/>";
  $brts = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_brate WHERE uid='".$who."'"));
  echo "&#187;Have rated: <b>$brts[0] Blogs</b><br/>";
  $pvts = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_presults WHERE uid='".$who."'"));
  echo "&#187;Have voted in <b>$pvts[0] Polls</b><br/>";
  $strd = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$who."' AND starred='1'"));
  echo "&#187;Starred PMs: <b>$strd[0]</b><br/><br/>";
  echo "<a href=\"uinfo.php?action=fsts&amp;sid=$sid&amp;who=$who\">&#187;Posts In forums</a><br/>";
  echo "<a href=\"uinfo.php?action=cinf&amp;sid=$sid&amp;who=$who\">&#187;Contact Info</a><br/>";
  echo "<a href=\"uinfo.php?action=look&amp;sid=$sid&amp;who=$who\">&#187;Looking</a><br/>";
  echo "<a href=\"uinfo.php?action=pers&amp;sid=$sid&amp;who=$who\">&#187;Personality</a><br/>";
  echo "<a href=\"uinfo.php?action=rwidc&amp;sid=$sid&amp;who=$who\">&#187;wapbies ID Card</a><br/>";
  echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
  echo "</body>";
}

else if($action=="rwidc")
{
    addonline(getuid_sid($sid),"wapbies ID","");
    echo "<p align=\"center\">";
    echo "<b>wapbies! ID card</b><br/>";
    echo "<img src=\"rwidc.php?id=$who\" alt=\"ll id\"/><br/><br/>";
    echo "The source for this ID card is http://wapbies.com/rwidc.php?id=$who<br/><br/>";
    echo "To look at your card Go to CPanel&gt; wapbies ID Card.";
    
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
    echo "</body>";
	 exit();
}

else if($action=="fsts")
{
    addonline($uid,"Viewing User Profile","");
    $whonick = getnick_uid($who);
    echo "<p>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Posts in forums<br/><br/>";
    $pst = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE uid='".$who."'"));
    $frms = mysql_query("SELECT id, name FROM gyd_forums WHERE clubid='0' ORDER BY name");
    while ($frm=mysql_fetch_array($frms))
    {
      $nops = mysql_fetch_array(mysql_query("SELECT COUNT(*) as nops, a.uid FROM gyd_posts a INNER JOIN ibwf_topics b ON a.tid = b.id WHERE a.uid='".$who."' AND b.fid='".$frm[0]."' GROUP BY a.uid "));
      $prc = ceil(($nops[0]/$pst[0])*100);
      echo htmlspecialchars($frm[1]).": <b>$nops[0] ($prc%)</b><br/>";
    }
    echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";
    
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Posts in forums";
    echo "</p>";
    echo "</body>";
	 exit();
}

else if($action=="cinf")
{
    addonline($uid,"Viewing User Profile","");
    $whonick = getnick_uid($who);
    echo "<p>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Contact Info<br/><br/>";
    //duh
    $inf1 = mysql_fetch_array(mysql_query("SELECT country, city, street, phoneno, realname, budsonly, sitedscr FROM gyd_xinfo WHERE uid='".$who."'"));
    
    $inf2 = mysql_fetch_array(mysql_query("SELECT site, email FROM gyd_users WHERE id='".$who."'"));
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
    echo "Real Name: $rln<br/>";
    echo "Country: $inf1[0]<br/>";
    echo "City: $inf1[1]<br/>";
    echo "Street: $str<br/>";
    echo "Site: <a href=\"$inf2[0]\">$inf2[0]</a><br/>";
    echo "Site description: $inf1[6]<br/>";
    echo "Phone No.: $phn<br/>";
    echo "E-Mail: $inf2[1]<br/>";
    
    echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Contact Info";
    echo "</p>";
    echo "</body>";
	 exit();
}

else if($action=="look")
{
    addonline($uid,"Viewing User Profile","");
    $whonick = getnick_uid($who);
    echo "<p>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Looking<br/><br/>";
    //duh
    $inf1 = mysql_fetch_array(mysql_query("SELECT sexpre, height, weight, racerel, hairtype, eyescolor FROM gyd_xinfo WHERE uid='".$who."'"));
    $inf2 = mysql_fetch_array(mysql_query("SELECT sex FROM gyd_users WHERE id='".$who."'"));
    if($inf1[0]=="M" && $inf2[0]=="F")
    {
      $sxp = "Straight";
    }else if($inf1[0]=="F" && $inf2[0]=="M")
    {
      $sxp = "Straight";
    }else if($inf1[0]=="M" && $inf2[0]=="M"){
      $sxp = "Gay";
    }else if($inf1[0]=="F" && $inf2[0]=="F"){
      $sxp = "Lesbian";
    }else if($inf1[0]=="B"){
      $sxp = "Bisexual";
    }else{
      $sxp = "inapplicable";
    }
    if($inf2[0]=="M")
    {
      $usx = "Male";
    }else if($inf2[0]=="F")
    {
      $usx = "Female";
    }else{
      $usx = "Shemale";
    }
    echo "Sex: $usx<br/>";
    echo "Orientation: $sxp<br/>";
    echo "Height: $inf1[1]<br/>";
    echo "Weight: $inf1[2]<br/>";
    echo "Ethnic origin: $inf1[3]<br/>";
    echo "Hair: $inf1[4]<br/>";
    echo "Eyes: $inf1[5]<br/>";
    //tuh
    echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Looking";
    echo "</p>";
    echo "</body>";
	 exit();
}

else if($action=="pers")
{
    addonline($uid,"Viewing User Profile","");
    $whonick = getnick_uid($who);
    echo "<p>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Personality<br/><br/>";
    //duh
    $inf1 = mysql_fetch_array(mysql_query("SELECT likes, deslikes, habitsb, habitsg, favsport, favmusic, moretext FROM ibwf_xinfo WHERE uid='".$who."'"));
    echo "<b>Likes:</b> ".parsemsg($inf1[0])."<br/>";
    echo "<b>Dislikes:</b> ".parsemsg($inf1[1])."<br/>";
    echo "<b>Bad Habits:</b> ".parsemsg($inf1[2])."<br/>";
    echo "<b>Good Habits:</b> ".parsemsg($inf1[3])."<br/>";
    echo "<b>Sport:</b> ".parsemsg($inf1[4])."<br/>";
    echo "<b>Music:</b> ".parsemsg($inf1[5])."<br/>";
    echo "<b>More text:</b> ".parsemsg($inf1[6])."<br/>";
    //tuh
    echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>&gt;";

    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$whonick</a><br/>";
    echo "&gt;<a href=\"uinfo.php?sid=$sid&amp;who=$who\">Extended Info</a>&gt;Personality";
    echo "</p>";
    echo "</body>";
	 exit();
}

else{
  echo "<p align=\"center\">";
  echo "Page not found!<br/><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p></body>";
   exit();
}
?>
</html>
