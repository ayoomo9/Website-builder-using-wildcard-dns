
<?php


ini_set("display_errors", "0");
ini_set("register_globals", "0");
require("sec.php");
require_once("config_cgh.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();

check_injection();

include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<html>";
echo "<head><title>$site_name mobile community</title>"
?>
<link rel="shortcut icon" type="image/x-icon" href="images/ni.png" />
<?php
      echo "<link rel=\"StyleSheet\" type=\"text/css\" media=\"all\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"$site_name :)\">
<meta http-equiv=\"expires\" content=\"0\" />
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

echo "<head>";addonline(getuid_sid($sid),"Just got banned","index.php?action=$action");
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
      $banto = mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'")); 
echo "<br /><em>You are <b>Banned from wapbies.com</b><br /><br /></em>";

	  $banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));

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



//////////////////////////////////Members List

if($action=="members")
{
    addonline(getuid_sid($sid),"Viewing Members List","");
    $view = $_GET["view"];
    if($view=="")$view="date";
    echo "<p align=\"center\">";
    echo "<img src=\"images/bdy.gif\" alt=\"*\"/><br/>";
    echo "<a href=\"lists.php?action=members&amp;view=name&amp;sid=$sid\">Order By Name</a><br/>";
    echo "<a href=\"lists.php?action=members&amp;view=date&amp;sid=$sid\">Order By Join Date</a><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
    if($view=="name")
    {
        $sql = "SELECT id, name, regdate FROM gyd_users ORDER BY name LIMIT $limit_start, $items_per_page";
    }else{
        $sql = "SELECT id, name, regdate FROM gyd_users ORDER BY regdate DESC LIMIT $limit_start, $items_per_page";
    }

    echo "<p>";
    $items = mysql_query($sql);

    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $jdt = date("d-m-y", $item[2]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>joined: $jdt</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=members&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=members&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        $rets .= "</form>";


        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a><br />";
echo admob();
  echo "<br /></p>";
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





///////////////Upload avatar///////////////

else if($action=="upavat"){

        addonline(getuid_sid($sid),"Uploading avatar image","lists.php?action=$action");

        $whonick = getnick_uid($who);



	echo "<b>Upload avatar to your profile</b>";





        echo "<p><br/>

        <form enctype=\"multipart/form-data\" action=\"genproc.php?action=upavat&amp;sid=$sid\" method=\"post\">

        Upload JPG/JPEG image only. <br/> Size limit: 512KB<br/>Image will be resized to fit its width to 128 pixels.<br/>

        <input type=\"file\" name=\"attach\"/><br/>

        <input id=\"inputButton\" type=\"submit\" name=\"submit\" value=\"Upload\"/></form></p>

";

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











//////////////////////////////////User Inboxes(owner)

else if($action=="readmsgs")
{
  $who = $_GET["who"];
    addonline(getuid_sid($sid),"Busy Administrating!","");
	$uid = getuid_sid($sid);
   if (!isadmin(getuid_sid($sid)) && !$uid=='194' && !isowner(getuid_sid($sid)) && !$uid=='16')
	  {
      echo "<head>";
      echo "<title>Error!!!</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "Access Denied!!<br/>";
      echo "<br/>";
      echo "<a href=\"index.php\">Home</a>";
      echo "</p>";
      echo "</body>";
	  exit();
    }else{
    echo "<head>";
    echo "<title>Users Sent Inboxes</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    $uid = getuid_sid($sid);
    if($page=="" || $page<=0)$page=1;
    $myid = getuid_sid($sid);
    $pms = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE byuid=$who ORDER BY timesent"));
    //echo mysql_error();
    $num_items = $pms[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($num_items>0)
    {
      echo "<p>";
      $pms = mysql_query("SELECT byuid, touid, text, timesent FROM gyd_private WHERE byuid=$who ORDER BY timesent LIMIT $limit_start, $items_per_page");
      while($pm=mysql_fetch_array($pms))
      {
            if(isonline($pm[0]))
  {
    $onlby = "<img src=\"images/onl.gif\" alt=\"+\"/>";
  }else{
    $onlby = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
            if(isonline($pm[1]))
  {
    $onlto = "<img src=\".images/onl.gif\" alt=\"+\"/>";
  }else{
    $onlto = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
  $bylnk = "<a href=\"index.php?action=viewuser&amp;who=$pm[0]&amp;sid=$sid\">$onlby".getnick_uid($pm[0])."</a>";
  $tolnk = "<a href=\"index.php?action=viewuser&amp;who=$pm[1]&amp;sid=$sid\">$onlto".getnick_uid($pm[1])."</a>";
  echo "$bylnk <img src=\"moods/in.gif\" alt=\"-\"/> $tolnk";
  $tmopm = date("d m y - h:i:s",$pm[3]);
  echo " $tmopm<br/>";
  echo parsepm($pm[2], $sid);
  echo "<br/>--------------<br/>";
      }
      echo "</p><p align=\"center\">";
      if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=readmsgs&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;Prev</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=readmsgs&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
	$rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "<input name=\"page\" style=\"-wap-input-format: '*N'\" size=\"2\"/>";
      $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\">";
      $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
      $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\">";
      $rets .= "<input type=\"Submit\" name=\"Submit\" Value=\"Go To Page\"></form>";
      echo $rets;
      }
      }else{
        echo "<p align=\"center\">";
        echo "NO DATA";
      }
    echo "<p align=\"center\">";
    $unick = getnick_uid($who);
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">$unick's Profile</a><br/>";
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
exit();
}





////////////////////////Edit Shout
else if($action=="chiledit"){
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
    {
$shid = $_GET["shid"];
$getsht = mysql_fetch_array(mysql_query("SELECT shout FROM gyd_shouts WHERE id = '".$shid."'"));

echo "<p>";
  echo "<br/>Edit:<br/> ";
echo "<form action=\"shout.php?action=chileditfin&amp;sid=$sid&amp;id=$shid\" method=\"post\"><textarea id=\"inputText\" name=\"shtxt\">$getsht[0]</textarea> ";
echo "<br/><input id=\"inputButton\" type=\"submit\" value=\"Edit\"/>";
echo "</form>";
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
exit();
  }














//////////////////////////////////List users by IP

if($action=="byip")
{
    addonline(getuid_sid($sid),"User Ips","");
    //////ALL LISTS SCRIPT <<
    $who = $_GET["who"];
    $whoinfo = mysql_fetch_array(mysql_query("SELECT ipadd, browserm FROM gyd_users WHERE id='".$who."'"));
 if(isadmin($uid) || isowner($uid) || $uid=='194' || $uid=='16')
  {
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE ipadd='".$whoinfo[0]."' AND browserm='".$whoinfo[1]."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name FROM gyd_users WHERE ipadd='".$whoinfo[0]."' AND browserm='".$whoinfo[1]."' ORDER BY name  LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);

    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br />$page/$num_pages<br />";
    if($num_pages>2)
    {
    $rets .= "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
    }else{
      echo "<p align=\"center\">";
      echo "You can't view this list";
      echo "</p>";
    }
  ////// UNTILL HERE >>
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
	exit();
}


//////////////////////////////////Top Posters List

else if($action=="topp")
{
    addonline(getuid_sid($sid),"Top Forum Posters","");
    echo "<p align=\"center\">";
    echo "<b>Our Top Posters</b><br/>Thank you all for keeping $sitename alive<br/>";
    $weekago = time();
    $weekago -= 7*24*60*60;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_posts WHERE dtpost>'".$weekago."';"));
    echo "<a href=\"lists.php?action=tpweek&amp;sid=$sid\">This week($noi[0])</a><br/>";
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_posts ;"));
    echo "<a href=\"lists.php?action=tptime&amp;sid=$sid\">All the time($noi[0])</a><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, posts FROM gyd_users ORDER BY posts DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Posts: $item[2]</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=topp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=topp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page: <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}


//////////////////////////////////Most Credits List

else if($action=="mostc")
{
    addonline(getuid_sid($sid),"Most Credits","");
    $pstyle = gettheme($sid);
      echo xhtmlhead("Most Credits",$pstyle);
    echo "<p align=\"center\">";
    echo "<b>Most Credits (Top Ten)</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

        if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, plusses FROM gyd_users WHERE perm='0' ORDER BY plusses DESC LIMIT $limit_start, $items_per_page";

    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Credits: $item[2]</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";

  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
    $thid = mysql_fetch_array(mysql_query("SELECT themeid FROM gyd_users WHERE id='".$uid."'"));
    $themeimageset = mysql_fetch_array(mysql_query("SELECT themedir FROM gyd_iconset WHERE id='".$thid[0]."'"));
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
  echo xhtmlfoot();
}








//////////////////////////////////Most online daily list

else if($action=="moto")
{
    addonline(getuid_sid($sid),"Most Online Daily Users","");
    echo "<p align=\"center\">";
    echo "Maximum number of users was online in the last 10 Days<br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<







    //changable sql

        $sql = "SELECT ddt, dtm, ppl FROM gyd_user ORDER BY id DESC LIMIT 10";


    echo "<p>";
    $items = mysql_query($sql);

    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "$item[0]($item[1]) Members: $item[2]";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";


  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

//////////////////////////////////Top Chatters

else if($action=="tchat")
{
    addonline(getuid_sid($sid),"Top Chatters","");
    echo "<head>";
    echo "<title>Top Chatters</title>";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "<b>Top Chatters</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, chmsgs FROM gyd_users ORDER BY chmsgs DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> Chat Posts: $item[2]";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=tchat&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=tchat&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "<input name=\"page\" style=\"-wap-input-format: '*N'\" size=\"2\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"submit\" value=\"Go To Page\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"\"/>Site Stats</a><br/>";
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

//////////////////////////////////Top Chatters

else if($action=="smc")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Smoochers List","");
    	echo "<p align=\"center\">";
	echo "Members smooched by <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='smooch'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.target, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.target = b.id
		WHERE a.uid='".$who."' AND a.action='smooch'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

else if($action=="smd")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Smoochers List","");
    	echo "<p align=\"center\">";
	echo "Members smooched <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='smooch'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.uid, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.uid = b.id
		WHERE a.target='".$who."' AND a.action='smooch'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;

            }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

//////////////////////////////////Top Chatters

else if($action=="kck")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Kickers List","");
    	echo "<p align=\"center\">";
	echo "Members Kicked by <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='kick'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.target, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.target = b.id
		WHERE a.uid='".$who."' AND a.action='kick'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;

            }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

else if($action=="kcd")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Kickers List","");
    	echo "<p align=\"center\">";
	echo "Members Kicked <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='kick'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.uid, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.uid = b.id
		WHERE a.target='".$who."' AND a.action='kick'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

//////////////////////////////////Top Chatters

else if($action=="pok")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Pokers List","");
    	echo "<p align=\"center\">";
	echo "Members Poked by <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='poke'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.target, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.target = b.id
		WHERE a.uid='".$who."' AND a.action='poke'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

else if($action=="pkd")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Pokers List","");
    	echo "<p align=\"center\">";
	echo "Members Poked <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='poke'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.uid, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.uid = b.id
		WHERE a.target='".$who."' AND a.action='poke'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
                        $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Top Chatters

else if($action=="hgs")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Huggers List","");
    	echo "<p align=\"center\">";
	echo "Members Hugged by <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE uid='".$who."' AND action='hug'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.target, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.target = b.id
		WHERE a.uid='".$who."' AND a.action='hug'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
                  $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";


 $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";


 $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


 $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
}

else if($action=="hgd")
{
	$who = $_GET["who"];
	$wnick = getnick_uid($who);
    addonline(getuid_sid($sid),"Huggers List","");
    echo "<p align=\"center\">";
	echo "Members hugged <a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$wnick</a>";
	echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usfun WHERE target='".$who."' AND action='hug'")); //changable
    $num_items = $noi[0];
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "
		SELECT a.uid, b.name
		FROM gyd_usfun a INNER JOIN gyd_users b ON a.uid = b.id
		WHERE a.target='".$who."' AND a.action='hug'
		ORDER BY a.actime DESC LIMIT $limit_start, $items_per_page
		;";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
	if($num_pages>1)
	{
    echo "<br/>$page/$num_pages<br/>";
	}
    if($num_pages>2)
    {
           $rets = "<form action=\"lists.php\" method=\"get\">";
         $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
         $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
          $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
       $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
          $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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


//////////////////////////////////requests///////////

else if($action=="reqs")
{
    addonline(getuid_sid($sid),"friend Requests List","");
    echo "<p align=\"center\">";
    global $max_buds;
    $uid = getuid_sid($sid);
    echo "The following members want you to add them to your friend list<br/>";
    $remp = $max_buds - getnbuds($uid);
    echo "you have <b>$remp</b> Places left";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $nor = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE tid='".$uid."' AND agreed='0'"));
    $num_items = $nor[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT uid  FROM gyd_buddies WHERE tid='".$uid."' AND agreed='0' ORDER BY reqdt DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $rnick = getnick_uid($item[0]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$rnick</a>: <a href=\"genproc.php?action=bud&amp;who=$item[0]&amp;sid=$sid&amp;todo=add\">Accept</a>, <a href=\"genproc.php?action=bud&amp;who=$item[0]&amp;sid=$sid&amp;todo=del\">Decline</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {

  $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
         $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
         $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
         $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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




//////////////////////////////////shouts

else if($action=="shouts")
{
    addonline(getuid_sid($sid),"Viewing Shouts","");
    $who = $_GET["who"];
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    if($who=="")
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_shouts"));
    }else{
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_shouts WHERE shouter='".$who."'"));
    }
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
    if($who =="")
    {
        $sql = "SELECT id, shout, shouter, shtime  FROM gyd_shouts ORDER BY shtime DESC LIMIT $limit_start, $items_per_page";
}else{
    $sql = "SELECT id, shout, shouter, shtime  FROM gyd_shouts  WHERE shouter='".$who."'ORDER BY shtime DESC LIMIT $limit_start, $items_per_page";
}

    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $shnick = getnick_uid($item[2]);
        $sht = parsemsg($item[1],$sid);
        $shdt = date("d m y-H:i", $item[3]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">$shnick</a>: $sht<br/>$shdt";
  if (ismod(getuid_sid($sid)) || $uid=='194' || $uid=='16' || $uid=='10' || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
  {
       $dlsh = "[<a href=\"lists.php?action=chiledit&amp;sid=$sid&amp;shid=$item[0]\">E</a>]|<a href=\"wmcpr.php?action=delsh&amp;sid=$sid&amp;shid=$item[0]\">[x]</a><br/><br/>";
    //  $dlsh = "<a href=\"wmcpr.php?action=delsh&amp;sid=$sid&amp;shid=$item[0]\">[x]</a>";
      }else{
        $dlsh = "";
      }
      echo "$lnk $dlsh<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=shouts&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=shouts&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";
        echo $rets;
     }
    echo "</p>";
  ////// UNTILL HERE >>
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


//////////////////////////////////User Clubs

else if($action=="ucl")
{
    addonline(getuid_sid($sid),"User Clubs","");
    $who = $_GET["who"];
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs WHERE owner='".$who."'"));

    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT id  FROM gyd_clubs  WHERE owner='".$who."' ORDER BY id LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $nom = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$item[0]."' AND accepted='1'"));
		$clinfo = mysql_fetch_array(mysql_query("SELECT name, description FROM gyd_clubs WHERE id='".$item[0]."'"));
      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[0]&amp;sid=$sid\">".htmlspecialchars($clinfo[0])."</a>($nom[0])<br/>".htmlspecialchars($clinfo[1])."<br/>";
      echo $lnk;
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    if($num_pages>1){
    echo "<br/>$page/$num_pages<br/>";
    }
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";
         echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    $whonick = getnick_uid($who);
    echo "<a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$whonick's Profile</a><br/>";
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
}


//////////////////////////////////User Clubs

else if($action=="clm")
{
    addonline(getuid_sid($sid),"Viewing A Member's Club","");
    $who = $_GET["who"];
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$who."' AND accepted='1'"));

    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT  clid  FROM gyd_clubmembers  WHERE uid='".$who."' AND accepted='1' ORDER BY joined DESC  LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $clnm = mysql_fetch_array(mysql_query("SELECT name FROM gyd_clubs WHERE id='".$item[0]."'"));
      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[0]&amp;sid=$sid\">".htmlspecialchars($clnm[0])."</a><br/>";
      echo $lnk;
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    if($num_pages>1){
    echo "<br/>$page/$num_pages<br/>";
    }
    if($num_pages>2)
    {
      $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    $whonick = getnick_uid($who);
    echo "<a href=\"index.php?action=viewuser&amp;who=$who&amp;sid=$sid\">$whonick's Profile</a><br/>";

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

//////////////////////////////////Popular clubs

else if($action=="pclb")
{
    addonline(getuid_sid($sid),"Viewing Most Popular Clubs","");
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs"));

    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT clid, COUNT(*) as notl FROM gyd_clubmembers WHERE accepted='1' GROUP BY clid ORDER BY notl DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $clnm = mysql_fetch_array(mysql_query("SELECT name, description FROM gyd_clubs WHERE id='".$item[0]."'"));

      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[0]&amp;sid=$sid\">".htmlspecialchars($clnm[0])."</a>($item[1])<br/>".htmlspecialchars($clnm[1])."<br/>";
      echo $lnk;
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    if($num_pages>1){
    echo "<br/>$page/$num_pages<br/>";
    }
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";
        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=clmenu&amp;sid=$sid\">Clubs Menu</a><br/>";
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

//////////////////////////////////Active clubs

else if($action=="aclb")
{
    addonline(getuid_sid($sid),"Viewing Most Active Clubs","");
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubs"));

    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT COUNT(*) as notp, b.clubid FROM gyd_topics a INNER JOIN gyd_forums b ON a.fid = b.id WHERE b.clubid >'0'  GROUP BY b.clubid ORDER BY notp DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
  //  echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $clnm = mysql_fetch_array(mysql_query("SELECT name, description FROM gyd_clubs WHERE id='".$item[1]."'"));

      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[1]&amp;sid=$sid\">".htmlspecialchars($clnm[0])."</a>($item[0] Topics)<br/>".htmlspecialchars($clnm[1])."<br/>";
      echo $lnk;
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    if($num_pages>1){
    echo "<br/>$page/$num_pages<br/>";
    }
    if($num_pages>2)
    {
                    $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";
        echo $rets;
}
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=clmenu&amp;sid=$sid\">Clubs Menu</a><br/>";
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

//////////////////////////////////Random clubs

else if($action=="rclb")
{
    addonline(getuid_sid($sid),"Viewing A Random Club","");
    //////ALL LISTS SCRIPT <<

    $sql = "SELECT id, name, description FROM gyd_clubs ORDER BY RAND()  LIMIT 5";


    echo "<p>";
    $items = mysql_query($sql);
  //  echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=gocl&amp;clid=$item[0]&amp;sid=$sid\">".htmlspecialchars($item[1])."</a><br/>".htmlspecialchars($item[2])."<br/>";
      echo $lnk;
    }
    }
    echo "</p>";


  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=clmenu&amp;sid=$sid\">Clubs Menu</a><br/>";
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
//////////////////////////////////shouts

else if($action=="annc")
{
    addonline(getuid_sid($sid),"looking At An Announcement","");
    $clid = $_GET["clid"];
    //////ALL LISTS SCRIPT <<
    $uid = getuid_sid($sid);
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_announcements WHERE clid='".$clid."'"));

    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT id, antext, antime  FROM gyd_announcements WHERE clid='".$clid."' ORDER BY antime DESC LIMIT $limit_start, $items_per_page";

    $cow = mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    echo "<p>";
    $items = mysql_query($sql);
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      if($cow[0]==$uid)
      {
      $dlan = "<a href=\"genproc.php?action=delan&amp;sid=$sid&amp;anid=$item[0]&amp;clid=$clid\">[x]</a>";
      }else{
        $dlan = "";
      }
      $annc = htmlspecialchars($item[1])."<br/>".date("d/m/y (H:i)", $item[2]);
      echo "$annc $dlan<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;clid=$clid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;clid=$clid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";
         echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    if($cow[0]==$uid)
      {
      $dlan = "<a href=\"index.php?action=annc&amp;sid=$sid&amp;clid=$clid\">Announce!</a><br/><br/>";
      echo $dlan;
      }
    echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$clid\">";
echo "Back to club</a><br/>";
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
//////////////////////////////////clubs requests

else if($action=="clreq")
{
    addonline(getuid_sid($sid),"Viewing Club Requests","");
    $clid = $_GET["clid"];
    $uid = getuid_sid($sid);
    $cowner = mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    //////ALL LISTS SCRIPT <<
    if($cowner[0]==$uid)
    {
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='0'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT uid  FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='0' ORDER BY joined DESC LIMIT $limit_start, $items_per_page";
    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $shnick = getnick_uid($item[0]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$shnick</a>: <a href=\"genproc.php?action=acm&amp;who=$item[0]&amp;sid=$sid&amp;clid=$clid\">accept</a>, <a href=\"genproc.php?action=dcm&amp;who=$item[0]&amp;sid=$sid&amp;clid=$clid\">deny</a><br/>";
      echo "$lnk";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;clid=$clid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;clid=$clid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";
       echo $rets;
}
	echo "<br/><br/><a href=\"genproc.php?action=accall&amp;clid=$clid&amp;sid=$sid\">Accept All</a>, ";
	echo "<a href=\"genproc.php?action=denall&amp;clid=$clid&amp;sid=$sid\">Deny All</a>";
    echo "</p>";
    }else{
      echo "<p align=\"center\">This club isnt yours</p>";
    }
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$clid\">";
echo "Back to club</a><br/>";
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

//////////////////////////////////clubs members

else if($action=="clmem")
{
    addonline(getuid_sid($sid),"Viewing Club Members","");
    $clid = $_GET["clid"];
    $uid = getuid_sid($sid);
    $cowner = mysql_fetch_array(mysql_query("SELECT owner FROM gyd_clubs WHERE id='".$clid."'"));
    //////ALL LISTS SCRIPT <<
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT uid, joined, points  FROM gyd_clubmembers WHERE clid='".$clid."' AND accepted='1' ORDER BY joined DESC LIMIT $limit_start, $items_per_page";
    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      if($cowner[0]==$uid)
      {
        $oop = ": <a href=\"index.php?action=clmop&amp;sid=$sid&amp;who=$item[0]&amp;clid=$clid\">Options</a>";
      }else{
        $oop = "";
      }
        $shnick = getnick_uid($item[0]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$shnick</a>$oop<br/>";
      $lnk .= "Joined: ".date("d/m/y", $item[1])." - Club Points: $item[2]";

      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;clid=$clid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;clid=$clid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"clid\" value=\"$clid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";
        echo $rets;
    }
    echo "</p>";

  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$clid\">";
echo "Back to club</a><br/>";
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


//////////////////////////////////User topics

else if($action=="tbuid")
{
  $who = $_GET["who"];
    addonline(getuid_sid($sid),"Viewing A Users Topic List","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE authorid='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT id, name, crdate  FROM gyd_topics  WHERE authorid='".$who."'ORDER BY crdate DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      if(canaccess(getuid_sid($sid),getfid_tid($item[0])))
      {
        echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[0]\">".htmlspecialchars($item[1])."</a> ".date("d m y-H:i:s",$item[2])."<br/>";
        }else{
          echo "Private Topic<br/>";
        }
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                  $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    $unick = getnick_uid($who);
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">";
echo "$unick's Profile</a><br/>";
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
	exit();
}

//////////////////////////////////User topics

else if($action=="uposts")
{
  $who = $_GET["who"];
    addonline(getuid_sid($sid),"Viewing Users Posts","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE uid='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

    $sql = "SELECT id, dtpost  FROM gyd_posts  WHERE uid='".$who."'ORDER BY dtpost DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $tid = gettid_pid($item[0]);
      $tname = gettname($tid);
      if(canaccess(getuid_sid($sid),getfid_tid($tid)))
      {
        echo "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$tid&amp;go=$item[0]\">".htmlspecialchars($tname)."</a> ".date("d m y-H:i:s",$item[1])."<br/>";
        }else{
          echo "Private Post<br/>";
        }
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>

    echo "<p align=\"center\">";
    $unick = getnick_uid($who);
    echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">";
echo "$unick's Profile</a><br/>";
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

//////////////////////////////////Top Gamers

else if($action=="tgame")
{
    addonline(getuid_sid($sid),"Viewing Top Gamers List","");
    echo "<p align=\"center\">";
    echo "<b>Top Gamers</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, gplus FROM gyd_users ORDER BY gplus DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> Game Plusses: $item[2]";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=tgame&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=tgame&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                  $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Top Gammers

else if($action=="topb")
{
    addonline(getuid_sid($sid),"Viewing Top Rap Battlers","");
    echo "<p align=\"center\">";
    echo "<b>Top Battlers</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, battlep FROM gyd_users ORDER BY battlep DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Battle Points: $item[2]</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=topb&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=topb&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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


//////////////////////////////////Banned

else if($action=="bannedwp")
{
    addonline(getuid_sid($sid),"Viewing The Banned List","");
    echo "<p align=\"center\">";
    echo "<b>Banned List</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='1' OR penalty='2'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT uid, penalty, pnreas, exid FROM gyd_pur WHERE penalty='1' OR penalty='2' ORDER BY timeto LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">".getnick_uid($item[0])."</a> (".htmlspecialchars($item[2]).")";
      if($item[1]=="1")
      {
        $bt = "Normal Ban";
      }else{
        $bt = "IP Ban";
      }
      if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
        $bym = "By ".getnick_uid($item[3]);
      }else{
        $bym = "";
      }
      echo "<small>$lnk $bt $bym</small><br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=bannedwp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=bannedwp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Trashed

else if($action=="trashed")
{
    addonline(getuid_sid($sid),"Viewing The Trashed Users List","");
    echo "<p align=\"center\">";
    echo "<b>Trashed List</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='0'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT uid, penalty, pnreas, exid FROM gyd_pur WHERE penalty='0' ORDER BY timeto LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">".getnick_uid($item[0])."</a> (".htmlspecialchars($item[2]).")";
       if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
        $bym = "By ".getnick_uid($item[3]);
      }else{
        $bym = "";
      }
      echo "<small>$lnk $bym</small><br/>";
    }
  }
  }else{
    echo "You can't view this list";
  }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=trashed&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=trashed&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////ip banned/////////////

else if($action=="ipban")
{
    addonline(getuid_sid($sid),"Viewing Banned IPs List","");
    echo "<p align=\"center\">";
    echo "<b>Banned IP's List</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_pur WHERE penalty='2'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT uid, penalty, pnreas, exid, ipadd FROM gyd_pur WHERE penalty='2' ORDER BY timeto LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">".getnick_uid($item[0])."</a> (".htmlspecialchars($item[2]).")";
     if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
        $bym = "By ".getnick_uid($item[3]);
      }else{
        $bym = "";
      }
      $ipl = "IP:<a href=\"lists.php?action=byip&amp;sid=$sid&amp;who=$item[0]\">$item[4]</a>";
      echo "$lnk $bym ($ipl)<br/>";
    }
  }
  }else{
    echo "You can't view this list";
  }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
//////////////////////////////////Smilies :)

else if($action=="smilies")
{
    addonline(getuid_sid($sid),"Viewing The Smilies List","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_smilies"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, scode, imgsrc FROM gyd_smilies ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);

  //  echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   {
		 if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
			$delsl = "<a href=\"actproc.php?action=delsm&amp;sid=$sid&amp;smid=$item[0]\">[x]</a>";
		}else{
			$delsl = "";
		}
        echo "$item[1] &#187; ";
        echo "<img src=\"$item[2]\" alt=\"$item[1]\"/> $delsl<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=smilies&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=smilies&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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

//////////////////////////////////Moods :)

else if($action=="chmood")
{
    addonline(getuid_sid($sid),"Viewing The Moods List","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_moods"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT text, img, dscr, id FROM gyd_moods ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   {
        echo "<a href=\"genproc.php?action=upcm&amp;sid=$sid&amp;cmid=$item[3]\">$item[0]</a> &#187; ";
        echo "<img src=\"$item[1]\" alt=\"$item[0]\"/> &#187; $item[2] <br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"genproc.php?action=upcm&amp;sid=$sid&amp;cmid=0\">Disable Chatmood</a><br/><br/>";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=chmood&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=chmood&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=chat&amp;sid=$sid\">";
echo "Chatrooms</a><br/>";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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

//////////////////////////////////Avatars

else if($action=="avatars")
{
    addonline(getuid_sid($sid),"Viwing The Avatars List","");


    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_avatars"));
    $num_items = $noi[0]; //changable
    $items_per_page= 2;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, avlink FROM gyd_avatars ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
  //  echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   {
        echo "<img src=\"$item[1]\" alt=\"avatar\"/><br/>";
        echo "<a href=\"genproc.php?action=upav&amp;sid=$sid&amp;avid=$item[0]\">SELECT</a><br/>";
        echo "<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=avatars&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=avatars&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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
//////////////////////////////////Gallery Avatars

else if($action=="gallery")
{
    addonline(getuid_sid($sid),"Viewing Avatar Gallery List","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, uid, file FROM gyd_usergallery ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   {
        $user = getnick_uid($item[1]);
        echo "<img src=\"usergallery.php?id=$item[0]\" alt=\"avatar\"/><br/>";
        echo "<a href=\"genproc.php?action=uppic&amp;sid=$sid&amp;avid=$item[0]\">SELECT</a><br/>";
        echo "<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=gallery&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=gallery&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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
//////////////////////////////////E-cards

else if($action=="ecards")
{
    addonline(getuid_sid($sid),"Viewing E-Cards List","");

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_cards"));
    $num_items = $noi[0]; //changable
    $items_per_page= 2;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, category FROM gyd_cards ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   {
		$sl = strlen($item[0]);
		$cid="";
		if($sl<3)
		{
			for($i=$sl;$i<3;$i++)
			{
				$cid .= "0";
			}
		}
		$cid .= "$item[0]";
		$msg = "Sample Text";
        echo "<img src=\"pmcard.php?cid=$cid&amp;msg=$msg\" alt=\"$cid\"/><br/>";
        echo "[card=$cid]$msg"."[/card]";
        echo "<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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


//////////////////////////////////Guest book/////////////

else if($action=="gbook")
{
    $who = $_GET["who"];
    addonline(getuid_sid($sid),"Viewing Guestbook","");

    $uid = getuid_sid($sid);

    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_gbook WHERE gbowner='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;


        $sql = "SELECT gbowner, gbsigner, gbmsg, dtime, id FROM gyd_gbook WHERE gbowner='".$who."' ORDER BY dtime DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

          if(isonline($item[1]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";

  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
    $snick = getnick_uid($item[1]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[1]&amp;sid=$sid\">$iml$snick</a>";
      $bs = date("d m y-H:i:s",$item[3]);
      echo "$lnk<br/>";
      if(candelgb($uid, $item[4]))
      {
        $delnk = "<a href=\"genproc.php?action=delfgb&amp;sid=$sid&amp;mid=$item[4]\">[x]</a>";
      }else{
        $delnk = "";
      }
      $text = parsepm($item[2], $sid);
      echo "$text<br/>$bs $delnk<br/>";

    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";


        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    if(cansigngb($uid, $who))
    {
    echo "<a href=\"index.php?action=signgb&amp;sid=$sid&amp;who=$who\">";
echo "Add Your Message</a><br/>";
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
    echo "</body>";
}

//////////////////////////////////Buddies

else if($action=="vault")
{
    $who = $_GET["who"];
    addonline(getuid_sid($sid),"Viewing The Vault","");
    $uid = getuid_sid($sid);



    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    if($who!="")
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_vault WHERE uid='".$who."'"));
    }else{
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_vault"));
    }
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    if($who!="")
    {
        $sql = "SELECT id, title, itemurl FROM gyd_vault WHERE uid='".$who."' ORDER BY pudt DESC LIMIT $limit_start, $items_per_page";
        }else{
$sql = "SELECT id, title, itemurl, uid FROM gyd_vault  ORDER BY pudt DESC LIMIT $limit_start, $items_per_page";
        }


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $ext = getext($item[2]);
        $ime = getextimg($ext);
        $lnk = "<a href=\"$item[2]\">$ime".htmlspecialchars($item[1])."</a>";

      if(candelvl($uid, $item[0]))
      {
        $delnk = "<a href=\"genproc.php?action=delvlt&amp;sid=$sid&amp;vid=$item[0]\">[x]</a>";
      }else{
        $delnk = "";
      }
      if($who!="")
      {
        $byusr="";
      }else{
        $unick = getnick_uid($item[3]);
        $ulnk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$unick</a>";
        $byusr = "- By $ulnk";
      }
      echo "$lnk $byusr $delnk<br/>";


    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";


        echo $rets;
            }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    if($uid==$who && getplusses($uid)>25)
    {
    echo "<a href=\"index.php?action=addvlt&amp;sid=$sid\">";
echo "Add Item</a><br/>";
}
if($who!="")
{
echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">";
$whonick = getnick_uid($who);
echo "$whonick's Profile</a><br/>";
}else{
echo "<a href=\"index.php?action=stats&amp;sid=$sid\">";
echo "<img src=\"images/stat.gif\" alt=\"*\"/>Site Stats</a><br/>";
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
    echo "</body>";
}

//////////////////////////////////Ignore list

else if($action=="ignl")
{
    addonline(getuid_sid($sid),"Viewing My Ignore List","");
    $uid = getuid_sid($sid);
    echo "<p align=\"center\">";
    echo "<b>Ignore List</b>";

    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_ignore WHERE name='".$uid."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
/*
$sql = "SELECT
            a.name, b.place, b.userid FROM gyd_users a
            INNER JOIN gyd_online b ON a.id = b.userid
            GROUP BY 1,2
            LIMIT $limit_start, $items_per_page
    ";
*/
        $sql = "SELECT target FROM gyd_ignore WHERE name='".$uid."' LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $tnick = getnick_uid($item[0]);
          if(isonline($item[0]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";

  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";

  }
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$iml$tnick</a>";
      echo "$lnk: ";
      echo "<a href=\"genproc.php?action=ign&amp;who=$item[0]&amp;sid=$sid&amp;todo=del\">Remove From Ignore list</a><br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=ignl&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=ignl&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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

//////////////////////////////////Blogs

else if($action=="blogs")
{
    addonline(getuid_sid($sid),"Viewing A Users Blog","");
    $uid = getuid_sid($sid);
    $who = $_GET["who"];
    $tnick = getnick_uid($who);
    echo "<p align=\"center\">";
    echo "<b>$tnick's Blogs</b>";

    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs WHERE bowner='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

        $sql = "SELECT id, bname FROM gyd_blogs WHERE bowner='".$who."' ORDER BY bgdate DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $bname = htmlspecialchars($item[1]);
    if(candelbl($uid,$item[0]))
    {
      $dl = "<a href=\"genproc.php?action=delbl&amp;sid=$sid&amp;bid=$item[0]\">[X]</a>";
    }else{
      $dl = "";
    }
      $lnk = "<a href=\"index.php?action=viewblog&amp;bid=$item[0]&amp;sid=$sid\">&#187;$bname</a>";
      echo "$lnk $dl<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                        $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    if($who==$uid)
    {
        echo "<a href=\"index.php?action=addblg&amp;sid=$sid\">";
echo "Add a blog</a><br/>";
echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
    }
    echo "<a href=\"lists.php?action=allbl&amp;sid=$sid\">";
echo "All Blogs</a><br/>";
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

//////////////////////////////////Blogs

else if($action=="allbl")
{
    addonline(getuid_sid($sid),"Viewqing Blogs list","");
    $uid = getuid_sid($sid);
    $view = $_GET["view"];
    if($view =="")$view="time";
    echo "<p align=\"center\">";
    if($view!="time")
    {
      echo "<a href=\"lists.php?action=allbl&amp;sid=$sid&amp;view=time\">View Newest</a><br/>";
    }
    if($view!="points")
    {
      echo "<a href=\"lists.php?action=allbl&amp;sid=$sid&amp;view=points\">View by points</a><br/>";
    }
    if($view!="rate")
    {
      echo "<a href=\"lists.php?action=allbl&amp;sid=$sid&amp;view=rate\">View most rated</a><br/>";
    }
    if($view!="votes")
    {
      echo "<a href=\"lists.php?action=allbl&amp;sid=$sid&amp;view=votes\">View most voted</a>";
    }
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs"));
    $num_items = $noi[0]; //changable
    $items_per_page= 7;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
if($view=="time")
{
  $ord = "a.bgdate";
}else if($view=="votes")
{
  $ord = "nofv";
}else if($view=="rate")
{
  $ord = "avv";
}else if($view=="points")
{
  $ord = "nofp";
}
if ($view=="time"){
  $sql = "SELECT id, bname, bowner FROM gyd_blogs ORDER by bgdate DESC LIMIT $limit_start, $items_per_page";
}else{
        $sql = "SELECT a.id, a.bname, a.bowner, COUNT(b.id) as nofv, SUM(b.brate) as nofp, AVG(b.brate) as avv FROM gyd_blogs a INNER JOIN gyd_brate b ON a.id = b.blogid GROUP BY a.id ORDER BY $ord DESC LIMIT $limit_start, $items_per_page";
}
    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $bname = htmlspecialchars($item[1]);
      if($view=="time")
      {
      $bonick = getnick_uid($item[2]);

        $byview = "by <a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[2]\">$bonick</a>";
        }else if($view=="votes")
        {
          $byview = "Votes: $item[3]";
        }else if($view=="rate")
        {
          $byview = "Rate: $item[5]";
        }else if($view=="points")
        {
          $byview = "Points: $item[4]";
        }
      $lnk = "<a href=\"index.php?action=viewblog&amp;bid=$item[0]&amp;sid=$sid\">&#187;$bname</a> $byview";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
               $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";

    echo "<a href=\"index.php?action=stats&amp;sid=$sid\">";
echo "<img src=\"images/stat.gif\" alt=\"*\"/>Site Stats</a><br/>";
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
}//////////////////////////////////Blogs

else if($action=="polls")
{
    addonline(getuid_sid($sid),"Viewing Polls list","");
    $uid = getuid_sid($sid);
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE pollid>'0'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

  $sql = "SELECT id, name FROM gyd_users WHERE pollid>'0' ORDER by pollid DESC LIMIT $limit_start, $items_per_page";

    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      echo "By <a href=\"index.php?action=viewpl&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a><br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";

    echo "<a href=\"index.php?action=stats&amp;sid=$sid\">";
echo "<img src=\"images/stat.gif\" alt=\"*\"/>Site Stats</a><br/>";
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

//////////////////////////////////Top Gammers

else if($action=="tshout")
{
    addonline(getuid_sid($sid),"Viewing Top Shouters list","");
    echo "<p align=\"center\">";
    echo "<b>Top Shouters</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = regmemcount(); //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, shouts FROM gyd_users ORDER BY shouts DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> Shouts: $item[2]";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=tshout&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=tshout&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////BBCODES FOR USERS///////////////////////

else if($action=="bbcode")
{
    addonline(getuid_sid($sid),"Viewing BBcode List","");
    echo "<p align=\"center\">";
    echo "<b>BBcode</b>";
    echo "</p>";
    echo "<p>";
    echo "<b>WARNING:</b> Misusing the bbcodes may cause display errors<br/><br/>";
    echo "[b]BOLD TEXT[/b]: <b>BOLD TEXT</b><br/><br/>";
    echo "[i]ITALIC TEXT[/i]: <i>ITALIC TEXT</i><br/><br/>";
    echo "[u]UNDERLINE TEXT[/u]: <u>UNDERLINE TEXT</u><br/><br/>";
	 echo "[blink]BLINK TEXT[/blink]: <blink>BLINK TEXT</blink><br/><br/>";
	  echo "[strike]STRIKE TEXT[/strike]: <strike>STRIKE TEXT</strike><br/><br/>";
    echo "[big]BIG TEXT[/big]: <big>BIG TEXT</big><br/><br/>";
    echo "[small]SMALL TEXT[/small]: <small>SMALL TEXT</small><br/><br/>";
	 echo "[clr=<i>red</i>]<i>COLOURED TEXT</i>[/clr]: <font color=\"red\">COLOURED TEXT</font><br/><br/>";
	 //echo "[img=<i>http://wapbies.com/logo.gif</i>]: <img src=\"http://wapbies.com/logo.gif\"><br/>";
    //echo "[url=<i>http://$sitename</i>]<i>wapbies</i>[/url]: <a href=\"http://$sitename\">wapbies</a><br/>";
    echo "[topic=<i>1501</i>]<i>Topic Name</i>[/topic]: <a href=\"index.php?action=viewtpc&amp;tid=1501&amp;sid=$sid\">Topic Name</a><br/><br/>";
    echo "replace 1501 with the topic id, and replace Topic Name with any word you want<br/><br/>";
    echo "[blog=<i>1</i>]<i>Blog Name</i>[/blog]: <a href=\"index.php?action=viewblog&amp;bid=1&amp;sid=$sid\">Blog Name</a><br/>";
    echo "replace 1 with the blog id, and replace Blog Name with any word you want<br/><br/>";
    echo "[club=<i>1</i>]<i>Club Name</i>[/club]: <a href=\"index.php?action=gocl&amp;clid=1501&amp;sid=$sid\">Club Name</a><br/>";
    echo "replace 1 with the club id, and replace Club Name with any word you want<br/><br/>";
    echo "[br/]: to insert new line, like:";
    echo "hello[br/]world!:<br/>hello<br/>world!<br/><br/>";

    echo "</p>";
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=cpanel&amp;sid=$sid\">";
echo "CPanel</a><br/>";
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


//////////////////////////////////Top Gammers

else if($action=="faqs")
{
    addonline(getuid_sid($sid),"F.A.Qs","");
    echo "<p align=\"center\">";
    echo "<b>F.A.Qs</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_faqs"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT question, answer FROM gyd_faqs ORDER BY id LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $item[0] = parsepm($item[0], $sid);
        $item[1] = parsepm($item[1], $sid);
      echo "<b>Q. $item[0]</b><br/>";
      echo "A. $item[1]<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
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


//////////////////////////////////Staff

else if($action=="staffwp")
{   


    addonline(getuid_sid($sid),"Viewing Staff list","");
    echo "<p align=\"center\">";
    echo "<img src=\"smilies/order.gif\" alt=\"*\"/><br/>";
    echo "<b>Staff List</b><br/><small>";
	 $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='9'"));

	if($noi[0] > '0')
	{

    echo "<a href=\"lists.php?action=ownerwp&amp;sid=$sid\">Site Owner($noi[0])</a><br/>";
	}
	$noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='6'"));
   if($noi[0] > '0')
	{

   echo "<a href=\"lists.php?action=coderwp&amp;sid=$sid\"><small>Coder($noi[0])</a></small><br />";
    }
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='8'"));
    if($noi[0] > '0')
	{

	echo "<a href=\"lists.php?action=admnswp&amp;sid=$sid\">Admins($noi[0])</a><br/>";
    }
	
	
	$noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='7'"));
   if($noi[0] > '0')
	{

   echo "<a href=\"lists.php?action=modrwp&amp;sid=$sid\"><small>Moderators($noi[0])</a></small>";
    }
	echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase>'0'"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name, ase FROM gyd_users WHERE ase>'0' ORDER BY name LIMIT $limit_start, $items_per_page";


  echo"<p align='left'>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        if($item[2]=='9')
        {
          $tit = "Site Owner";
        }
		else if($item[2]=='8')
		{
          $tit = "Admin";
        }
		else if($item[2]=='6')
		{
          $tit = "Owner Coder";
        }
		else
		{
		$tit = "Moderator";
		}
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> - <small>$tit</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=staffwp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=staffwp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////site admin

else if($action=="admnswp")
{
    addonline(getuid_sid($sid),"Viewing Admins list","");
    echo "<p align=\"center\">";
    echo "<img src=\"smilies/order.gif\" alt=\"*\"/><br/>";
    echo "<b>Admins List</b><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='8'"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name FROM gyd_users WHERE ase='8' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=admnswp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=admnswp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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



//////////////////////////////////site admin

else if($action=="coderwp")
{
    addonline(getuid_sid($sid),"Viewing Owner_coder list","");
    echo "<p align=\"center\">";
    echo "<img src=\"smilies/order.gif\" alt=\"*\"/><br/>";
    echo "<b>Site Coder List</b><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='6'"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name FROM gyd_users WHERE ase='6' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
 //   echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=admnswp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=admnswp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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


//////////////////////////////////site owner

else if($action=="ownerwp")
{
    addonline(getuid_sid($sid),"Viewing Site owner list","");
    echo "<p align=\"center\">";
    echo "<img src=\"smilies/order.gif\" alt=\"*\"/><br/>";
    echo "<b>Site owner(s)</b><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='9'"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name FROM gyd_users WHERE ase='9' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=ownerwp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=ownerwp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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



//////////////////////////////////judges

else if($action=="judg")
{
    addonline(getuid_sid($sid),"Viewing Judges list","");
    echo "<p align=\"center\">";
    echo "<b>Battle board judges</b><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_judges"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT uid FROM gyd_judges LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">".getnick_uid($item[0])."</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=judg&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=judg&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Staff

else if($action=="modrwp")
{
    addonline(getuid_sid($sid),"Viewing Mods list","");
    echo "<p align=\"center\">";
    echo "<img src=\"smilies/order.gif\" alt=\"*\"/><br/>";
    echo "<b>Moderators List</b><br/>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE ase='7'"));

    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql

        $sql = "SELECT id, name FROM gyd_users WHERE ase='7' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
  //  echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=modrwp&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=modrwp&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                      $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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


//////////////////////////////////Top Posters List

else if($action=="tpweek")
{
    addonline(getuid_sid($sid),"Viewing Top Posters of the week","");
    echo "<p align=\"center\">";
    echo "Top Posters of The week<br/><small>Thank you, you brought the life to $wapbies in the last 7 days</small>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $weekago = time();
    $weekago -= 7*24*60*60;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid)  FROM gyd_posts WHERE dtpost>'".$weekago."';"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql


        $sql = "SELECT uid, COUNT(*) as nops FROM gyd_posts  WHERE dtpost>'".$weekago."'  GROUP BY uid ORDER BY nops DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $unick = getnick_uid($item[0]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$unick</a> <small>Posts: $item[1]</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=tpweek&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=tpweek&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Top Posters List

else if($action=="tptime")
{
    addonline(getuid_sid($sid),"Viewing Overall Top Posters ","");
    echo "<p align=\"center\">";
    echo "Top Posters of all the time";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_posts ;"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql


        $sql = "SELECT uid, COUNT(*) as nops FROM gyd_posts   GROUP BY uid ORDER BY nops DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        $unick = getnick_uid($item[0]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$unick</a> <small>Posts: $item[1]</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=tptime&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=tptime&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                     $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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


//////////////////////////////////Males List

else if($action=="males")
{
    addonline(getuid_sid($sid),"I Need A Man","");

    echo "<p align=\"center\">";
    echo "<img src=\"images/male.gif\" alt=\"*\"/><br/>";
    echo "<b>Males</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE sex='M'"));
    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT id, name, birthday FROM gyd_users WHERE sex='M' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $uage = getage($item[2]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Age: $uage</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=males&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=males&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
         $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


      $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}

//////////////////////////////////Females List

else if($action=="fems")
{
    addonline(getuid_sid($sid),"I Need A Woman","");

    echo "<p align=\"center\">";
    echo "<img src=\"images/female.gif\" alt=\"*\"/><br/>";
    echo "<b>Females</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE sex='F'"));
    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT id, name, birthday FROM gyd_users WHERE sex='F' ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $uage = getage($item[2]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Age: $uage</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=fems&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=fems&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                       $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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

//////////////////////////////////Today's Birthday'

else if($action=="bdy")
{
    addonline(getuid_sid($sid),"Viewing Birthday List ","");

    echo "<p align=\"center\">";
    echo "<img src=\"images/cake.gif\" alt=\"*\"/><br/>";
    echo "Happy Birthday to:";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi =mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate());"));
    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT id, name, birthday  FROM gyd_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate()) ORDER BY name LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
      $uage = getage($item[2]);
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> <small>Age: $uage</small>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=bdy&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=bdy&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                     $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
      $rets .= "<input type=\"submit\" value=\"GO\"/>";
      $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
      $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

      $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();
}
//////////////////////////////////Buddies

else if($action=="buds")
{
    addonline(getuid_sid($sid),"Viewing My Friends List","");
    $uid = getuid_sid($sid);
	  echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
    echo "<p align=\"center\">";
	
    echo "Message For My Friends: <br/>";
    echo parsemsg(getbudmsg($uid), $sid);
	//$nick = getnick_sid($sid);

//echo "<u><em><strong>$nick</strong> personal wall</em></u><br />";
  //  echo "</p>";
	?>
	<!--
	<br />
	<div align='center'>
	<form method='POST' action='<?//=$_SERVER['PHP_SELF'];?>?action=bud&sid=<?//=$sid;?>'>
	<input type='text' name='wallmsg' style='padding:5px;' /><br />
	<input type='submit' name='submitm' value='Post to wall' />
	</form>
	</div>
	<br />
	-->
	<?php
	if(isset($_POST['submitm']))
	{
	$wallmsg = $_POST['wallmsg'];
	echo $wallmsg;
	
	
	}
	
    //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $num_items = getnbuds($uid); //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
/*
$sql = "SELECT
            a.name, b.place, b.userid FROM gyd_users a
            INNER JOIN gyd_online b ON a.id = b.userid
            GROUP BY 1,2
            LIMIT $limit_start, $items_per_page
    ";
*/
        $sql = "SELECT a.lastact, a.name, a.id, b.uid, b.tid, b.reqdt FROM gyd_users a INNER JOIN gyd_buddies b ON (a.id = b.uid) OR (a.id=b.tid) WHERE (b.uid='".$uid."' OR b.tid='".$uid."') AND b.agreed='1' AND a.id!='".$uid."' GROUP BY 1,2  ORDER BY a.lastact DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {

          if(isonline($item[2]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    $uact = "WHERE: ";
    $plc = mysql_fetch_array(mysql_query("SELECT place FROM gyd_online WHERE userid='".$item[2]."'"));
    $uact .= $plc[0];
  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
    $uact = "Last Active: ";
    $ladt = date("d m y-H:i:s", $item[0]);
    $uact .= $ladt;
  }
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">$iml$item[1]</a>";
      echo "<br/>$lnk<br/>";
      echo "";
      $bs = date("d m y-H:i:s",$item[5]);
      echo "Friend since:$bs<br/>";
      echo "$uact<br/>";
      echo "Says: ";
      $bmsg = parsemsg(getbudmsg($item[2]), $sid);
      echo "$bmsg<br/>";
      echo "";

    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=buds&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=buds&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                 $rets = "<form action=\"lists.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";

        $rets .= "</form>";

        echo $rets;

    }
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=chbmsg&amp;sid=$sid\">";
echo "Friend Message</a><br/>";
  echo "<br /><div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div><br />";
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

//////////////////////////////////Browsers

else if($action=="brows")
{
    addonline(getuid_sid($sid),"Viewing Browsers List","");

    echo "<p align=\"center\">";
	echo admob();
	echo "<br />";
    echo "<b>browsers List</b>";
    echo "</p>";
    //////ALL LISTS SCRIPT <<
    $noi=mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT browserm) FROM gyd_users WHERE browserm IS NOT NULL "));
    if($page=="" || $page<=0)$page=1;
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    //changable sql
        $sql = "SELECT browserm, COUNT(*) as notl FROM gyd_users    WHERE browserm!='' GROUP BY browserm ORDER BY notl DESC LIMIT $limit_start, $items_per_page";
//$moderatorz=mysql_query("SELECT tlphone, COUNT(*) as notl FROM gyd_users GROUP BY tlphone ORDER BY notl DESC LIMIT  ".$pagest.",5");
    $cou = $limit_start;
    echo "<p>";
    $items = mysql_query($sql);
   // echo mysql_error();
    if(mysql_num_rows($items)>0)
    {

    while ($item = mysql_fetch_array($items))
    {
      $cou++;
      $lnk = "$cou-$item[0] <b>$item[1]</b>";
      echo "$lnk<br/>";
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"lists.php?action=brows&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"lists.php?action=brows&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
                     $rets = "<form action=\"lists.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
      $rets .= "<input type=\"submit\" value=\"GO\"/>";
      $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
      $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";


      $rets .= "</form>";

        echo $rets;
    }
    echo "</p>";
  ////// UNTILL HERE >>

    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=stats&amp;sid=$sid\"><img src=\"images/stat.gif\" alt=\"*\"/>";
echo "Site Stats</a><br/>";
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
	exit();

}

else
{
$url = $_SERVER['QUERY_STRING'];

  $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='H attempt', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for script destinations in list.php?$url', actdt='".time()."'");

	 header('location:index.php');
echo "page not found";
}

?>

</html>
