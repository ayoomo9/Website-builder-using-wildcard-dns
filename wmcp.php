
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_browser();

check_method();
check_injection();
include_once('header.php');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

	echo "<head>";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
	echo "<title>Moderator Tools</title>";
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
}


$uid = strip_tags(mysql_real_escape_string(getuid_sid($sid)));
if (!ismod(getuid_sid($sid)) && !isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)) && !$uid=='194' && !$uid=='16')
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
	      echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
 echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      exit();
    }
    addonline(getuid_sid($sid),"Mod CP","");
if($action=="wp")
{
    echo "<p align=\"center\">";
    echo "<b>Reports</b>";
 echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
    echo "</p>";
     echo "<p>";
	 if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
    $nrpm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE reported='1'"));
    echo "<a href=\"wmcp.php?action=rpm&amp;sid=$sid\">&#187;Reported Messages($nrpm[0])</a><br/>";
    $nrps = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE reported='1'"));
    echo "<a href=\"wmcp.php?action=rps&amp;sid=$sid\">&#187;Posts($nrps[0])</a><br/>";
    $nrtp = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE reported='1'"));
    echo "<a href=\"wmcp.php?action=rtp&amp;sid=$sid\">&#187;Topics($nrtp[0])</a>";
	
    echo "</p>";
     echo "<p align=\"center\">";
    echo "<b>Logs</b>";
    echo "</p>";
    
     /*echo "<p>";
$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog"));
    if($noi[0]>0){
    $nola = mysql_query("SELECT DISTINCT (action)  FROM gyd_mlog ORDER BY actdt DESC");

      while($act=mysql_fetch_array($nola))
      {
        $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog WHERE action='".$act[0]."'"));
        echo "<a href=\"wmcp.php?action=logrpt&amp;sid=$sid&amp;view=$act[0]\">$act[0]($noi[0])</a><br/>";
      }

    }
    echo "</p>";*/
	}
  echo "<p align=\"center\">";
 echo "<div class=\"ads\">";
echo admob_request($admob_params);
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
	 
  echo "</p>";
        exit();
}

/////////////////////////////////Reported PMs

else if($action=="rpm")
{
  $page = $_GET["page"];
    
    echo "<p align=\"center\">";
	echo "<div class=\"ads\">";
   include('admob.php');
  echo "</div>";
	echo "<br />";
    echo "<b>Reported PMs</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE reported ='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, text, byuid, touid, timesent FROM gyd_private WHERE reported='1' ORDER BY timesent DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      $fromnk = getnick_uid($item[2]);
      $tonick = getnick_uid($item[3]);
      $dtop = date("d m y - H:i:s", $item[4]);
      $text = parsepm($item[1]);
      $flk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[2]\">$fromnk</a>";
      $tlk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$tonick</a>";
      echo "From: $flk To: $tlk<br/>Time: $dtop<br/>";
       echo $text;
       echo "<br/>";
       echo "<a href=\"wmcpr.php?action=hpm&amp;sid=$sid&amp;pid=$item[0]\">Handle</a><br/><br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
$rets = "<form action=\"wmcp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        
        $rets .= "</form>";

        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"wmcp.php?action=wp&amp;sid=$sid\">";
echo "Staff Log</a><br/>";
  echo "<div class=\"ads\">";
 echo admob_request($admob_params);
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
  echo "</p>";
        exit();
}

/////////////////////////////////Reported Posts

else if($action=="rps")
{
  $page = $_GET["page"];
    
    echo "<p align=\"center\">";
    echo "<b>Reported Posts</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE reported ='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, text, tid, uid, dtpost FROM gyd_posts WHERE reported='1' ORDER BY dtpost DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      $poster = getnick_uid($item[3]);
      $tname = htmlspecialchars(gettname($item[3]));
      $dtop = date("d m y - H:i:s", $item[4]);
      $text = parsemsg($item[1]);
      $flk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$poster</a>";
      $tlk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[2]\">$tname</a>";
      echo "Poster: $flk<br/>In: $tlk<br/>Time: $dtop<br/>";
       echo $text;
       echo "<br/>";
       echo "<a href=\"wmcpr.php?action=hps&amp;sid=$sid&amp;pid=$item[0]\">Handle</a><br/><br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"wmcp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        
        $rets .= "</form>";

        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"wmcp.php?action=wp&amp;sid=$sid\">";
echo "Staffs Logs</a><br/>";
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
/*
/////////////////////////////////Reported Posts

else if($action=="logrpt")
{
 if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
  $page = $_GET["page"];
  $view = $_GET["view"];
    
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
	echo "<br />";
    echo "<b>$view</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog WHERE  action='".$view."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT  actdt, details FROM gyd_mlog WHERE action='".$view."' ORDER BY actdt DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      echo "Time: ".date("d m y-H:i:s", $item[0])."<br/>";
      echo $item[1];
      echo "<br/>";
       
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"wmcp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        
        $rets .= "</form>";
        

        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"wmcp.php?action=wp&amp;sid=$sid\">";
echo "Staffs Logs</a>";
 echo "<div class=\"ads\">";
  echo admob_request($admob_params);
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
        exit();
}
}*/
/////////////////////////////////Reported Topics

else if($action=="rtp")
{
  $page = $_GET["page"];
    
    echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
include('admob.php');

  echo "</div>";
	echo "<br />";
    echo "<b>Reported Topics</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE reported ='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, name, text, authorid, crdate FROM gyd_topics WHERE reported='1' ORDER BY crdate DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      $poster = getnick_uid($item[3]);
      $tname = htmlspecialchars($item[1]);
      $dtop = date("d m y - H:i:s", $item[4]);
      $text = parsemsg($item[2]);
      $flk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$poster</a>";
      $tlk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[0]\">$tname</a>";
      echo "Poster: $flk<br/>In: $tlk<br/>Time: $dtop<br/>";
       echo $text;
       echo "<br/>";
       echo "<a href=\"wmcpr.php?action=htp&amp;sid=$sid&amp;tid=$item[0]\">Handle</a><br/><br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"wmcp.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
$rets = "<form action=\"wmcp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        $rets .= "</form>";


        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"wmcp.php?action=wp&amp;sid=$sid\">";
echo "Staffs Log</a>";
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
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
	 
  echo "</p>";
        exit();
}
//////////////////////////////////////Penalties Options

else if($action=="penoptmbrdo")
  
{    

addonline(getuid_sid($sid),"Purnishing a naughty member(Modcp)","");

   if (ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
	  if(isset($_GET['who']))
      {
  $who = $_GET["who"];
    }
	
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
  include('admob.php');
  echo "</div>";
  
	echo "<br />";
    $unick = getnick_uid($who);
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
    echo "Select appropiate purnishment for $unick";
    echo "</p>";
    echo "<p>";
    $pen[0]="Trash";
    $pen[1]="Ban";
if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
    $pen[2]="Ban Ip";
}
echo "<form action=\"wmcpr.php?action=mbrpundo&amp;sid=$sid&amp;who=$who\" method=\"post\">";
    echo "Penalty: <select name=\"pid\">";
    for($i=0;$i<count($pen);$i++)
    {
      echo "<option value=\"$i\">$pen[$i]</option>";
    }
    echo "</select><br/>";
    echo "Reason: <input name=\"pres\" maxlength=\"100\"/><br/>";
if (ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
    echo "Days: <input name=\"pds\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";


    
}
echo "Hours: <input name=\"phr\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";

    echo "Minutes: <input name=\"pmn\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
    echo "Seconds: <input name=\"psc\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
    echo "<input type=\"submit\" value=\"GO\"/>";
    
    echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
    
    echo "</form>";
    echo "</p>";
    
     echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
echo admob_request($admob_params);
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
	 
  echo "</p>";

	  }
	  else
	  {
	  header("location:index.php");
	
	  }
}
//////////////////////////////////////Penalties Options

else if($action=="plsopt")
{
if(isset($_GET['who']))
      {
    $who = $_GET["who"];
    }
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
 include('admob.php');
  echo "</div>";
	echo "<br />";
    $unick = getnick_uid($who);
    echo "Add/Substract $unick's Plusses";
    echo "</p>";
    echo "<p>";
    $pen[0]="Substract";
   if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
	  {
 $pen[1]="Add";
    }
echo "<form action=\"wmcpr.php?action=pls&amp;sid=$sid\" method=\"post\">";
    echo "Action: <select name=\"pid\">";
    for($i=0;$i<count($pen);$i++)
    {
      echo "<option value=\"$i\">$pen[$i]</option>";
    }
    echo "</select><br/>";
    echo "Reason: <input name=\"pres\" maxlength=\"100\"/><br/>";
    echo "Plusses: <input name=\"pval\" format=\"*N\" maxlength=\"3\"/><br/>";
echo "<input type=\"submit\" value=\"GO\"/>";
    
    echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
    
      echo "</form>";
    echo "</p>";

     echo "<p align=\"center\">";
	   echo "<div class=\"ads\">";
 echo admob_request($admob_params);
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
  echo "</p>";
      exit();
}



//////////////////////////////////////New Penalties Options

else if($action=="kalamopt"){
if(isset($_GET['who']))
      {
$who = $_GET["who"];
}
echo "<p align=\"center\">";
$unick = getnick_uid($who);
echo "What do you want to do with $unick";
echo "</p>";
echo "<p>";

echo "<form method=\"post\" action=\"wmcpr.php?action=sazadore&amp;sid=$sid\">Misc Penalties:<br />";
//echo "<input type=\"radio\" name=\"pid\" value=\"0\" />Block Outgoing<br/>";
//echo "<input type=\"radio\" name=\"pid\" value=\"1\" checked=\"checked\" />Ban<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"2\" checked/>Ban from Inbox<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"3\" />Ban from Forum Access<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"4\" />Ban from Shoutbox<br/>";
echo "Reason:<br/> <input id=\"inputText\" type=\"text\" name=\"pres\" maxlength=\"100\"/><br/>";
echo "Days: <br/><input id=\"inputText\" type=\"text\" name=\"pds\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "Hours: <br/><input id=\"inputText\" type=\"text\" name=\"phr\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "Minutes: <br/><input id=\"inputText\" type=\"text\" name=\"pmn\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
//echo "Seconds: <br/><input id=\"inputText\" type=\"text\" name=\"psc\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
echo "<input id=\"inputButton\" type=\"submit\" name=\"submit\" value=\"Punish\"/></form>";

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

}


///////////////////////////////////////////////Mod a user

else if($action=="user")
{
 if(isset($_GET['who']))
      {
    $who = $_GET["who"];
	}
 $whoad = getuid_sid($sid);
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
 include('admob.php');
  echo "</div>";
	echo "<br />";
    $unick = getnick_uid($who);
	
    echo "<b>Moderating $unick</b>";
    echo "</p>";
    echo "<p>";
	  if (isadmin(getuid_sid($sid)) || ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $whoad=='194' || $whoad=='16')
	  {
    echo "<a href=\"wmcp.php?action=penoptmbrdo&amp;sid=$sid&amp;who=$who\">&#187;Penalties</a><br/>";
   }
	  if (isadmin(getuid_sid($sid)) || ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $whoad=='194' || $whoad=='16')
	  {
    echo "<a href=\"wmcp.php?action=kalamopt&amp;sid=$sid&amp;who=$who\">&#187;Other Penalties</a><br/>";
   }


   echo "<a href=\"wmcp.php?action=plsopt&amp;sid=$sid&amp;who=$who\">&#187;Plusses</a><br/><br/>";
    if(istrashed($who))
    {
	if ($uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)) || ismod(getuid_sid($sid)))
    {
      echo "<a href=\"wmcpr.php?action=untrmbr&amp;sid=$sid&amp;who=$who\">&#187;Untrash</a><br/>";
    }
	}
	
	if(isshoutblocked($who)){
echo "<a href=\"wmcpr.php?action=openshout&amp;sid=$sid&amp;who=$who\">&#187;Unblock Shoutbox</a><br/>";
}
if(isforumblocked($who)){
echo "<a href=\"wmcpr.php?action=openforum&amp;sid=$sid&amp;who=$who\">&#187;Unblock Forum Access</a><br/>";
}
if(isinboxblocked($who)){
echo "<a href=\"wmcpr.php?action=openinbox&amp;sid=$sid&amp;who=$who\">&#187;Unblock Inbox</a><br/>";
}

    if(isbanned($who))
    {
	 if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
      echo "<a href=\"wmcpr.php?action=unbnmbr&amp;sid=$sid&amp;who=$who\">&#187;Unban</a><br/>";
    }
	}
    if(!isshield($who))
    {
	
      echo "<a href=\"wmcpr.php?action=shldmbr&amp;sid=$sid&amp;who=$who\">&#187;Shield</a><br/>";
    }else{
        echo "<a href=\"wmcpr.php?action=ushldmbr&amp;sid=$sid&amp;who=$who\">&#187;Unshield</a><br/>";
    }
	   if (isadmin(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16')
	  {
	  echo "<a href=\"lists.php?action=readmsgs&amp;sid=$sid&amp;who=$who\">&#187;Read Sent Inboxes</a><br/>";
	  }
	   if (ismod(getuid_sid($sid)) || $uid=='194' || isowner(getuid_sid($sid)) || $uid=='16' || isadmin(getuid_sid($sid)))
    {
	  echo "<a href=\"wmcpr.php?action=mbrboot&amp;sid=$sid&amp;who=$who\">&#187;Boot $unick</a><br/>";
    }
	
	echo "</p>";
    echo "<p align=\"center\">";
	 
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
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
	 
  echo "</p>";

}


else{
    addonline(getuid_sid($sid),"Trying to enter mod cp illegally","");

  echo "<p align=\"center\">";
   $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for script destinations in modcp.php!!', actdt='".time()."'");
   header('location:index.php');

  echo "Page not found!";
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
	      exit();
?>
