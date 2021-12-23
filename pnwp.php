
<?php

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
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

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by trying to enter admin cp without login in!!', actdt='".time()."'");

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








/////////////////////////////////ADMIN CP
else if($action=="nicemain")
{
echo "<head>";
  echo "<title>Admin Control Panel</title>";
  echo "</head>";
  addonline(getuid_sid($sid),"Admin Control Panel","");
  echo "<h3>";
echo "<b>Admin CP</b>";
   echo "</h3>";
  echo "<p align=\"center\">";
  echo "</p>";
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}
if(!file_exists(".htaccess"))
{
$handle = @fopen(".htaccess", "a");
fwrite($handle,"IndexIgnore *\r\n\r\nLimitRequestBody 10240000\r\n\r\nAddHandler cgi-script .pl .py .jsp .asp .htm .shtml .sh .cgi
Options -ExecCGI\r\n");
@fclose($handle);

}
  echo "<p>";
  if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='194' || $uid=='16')
    {
	  echo "<br /><a href=\"#\">&#187;Backup database</a><font color='red'>(<small>Dangerous for now!</small>)</font><br/>";
    echo "<a href=\"pn.php?action=wpgn&amp;sid=$sid\">&#187;General Settings</a><br/>";
    echo "<a href=\"pn.php?action=fcats&amp;sid=$sid\">&#187;Forum Categories</a><br/>";
    echo "<a href=\"pn.php?action=forums&amp;sid=$sid\">&#187;Forums</a><br/>";
  echo "<a href=\"remc.php\">&#187;Unlink Udata</a><br/>";
  
  echo "<a href=\"pn.php?action=blocksites&amp;sid=$sid\">&#187;Blocked Sites</a><br/>";
  //echo "<a href=\"pn.php?action=manmods&amp;sid=$sid\">&#187;manage moderators</a><br/>";
  echo "<a href=\"pn.php?action=idlestaff&amp;sid=$sid\">&#187;Idle Staffs</a><br/>";
   // echo "<a href=\"pn.php?action=ugroups&amp;sid=$sid\">&#187;User groups</a><br/>";
    //echo "<a href=\"pn.php?action=addperm&amp;sid=$sid\">&#187;Add permissions</a><br/>";
    echo "<a href=\"pn.php?action=chuinfo&amp;sid=$sid\">&#187;Change user info</a><br/>";
    //echo "<a href=\"pn.php?action=manrss&amp;sid=$sid\">&#187;Manage RSS Sources</a><br/>";
 // echo "<a href=\"pn.php?action=addsml&amp;sid=$sid\">&#187;Add Smilies</a><br/>";
  //  echo "<a href=\"pn.php?action=addavt&amp;sid=$sid\">&#187;Add Avatar</a><br/>";
    echo "<a href=\"pn.php?action=chrooms&amp;sid=$sid\">&#187;Chatrooms</a><br/>";
    echo "<a href=\"pn.php?action=clrdta&amp;sid=$sid\">&#187;Clear Data</a><br/>";
	   echo "<a href=\"pnproc.php?action=resetpenaltyreason&amp;sid=$sid\">&#187;Reset all penalty reason</a><br/>";
	   /* //Members email
	   
	   $count_email = mysql_query("SELECT email from gyd_users WHERE email!=''");
	   while($email = mysql_fetch_array($count_email))
	   {
	   
	   $email_add = strtolower($email[0]);
	   
echo $email_add;	   

}
*/
	echo "<br /><b><u>Activities Logs</u></b><br />";
	  echo "<a href=\"stealc.php\">&#187;Cookie Grabber</a><br /><br />";
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog"));
    if($noi[0]>0){
    $nola = mysql_query("SELECT DISTINCT (action)  FROM gyd_mlog ORDER BY actdt DESC");

      while($act=mysql_fetch_array($nola))
      {
        $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mlog WHERE action='".$act[0]."'"));
        echo "&#187;<a href=\"pnwp.php?action=logrpt&amp;sid=$sid&amp;view=$act[0]\">$act[0]($noi[0])</a><br/>";
      }

    }
	echo "<b>--------------------</b><br />";
    echo "</p>";
  echo "<br/>";
echo "<br/><form action=\"pnproc.php?action=wpglobal&amp;sid=$sid\" method=\"post\">";
  echo "Mass Message:<br /><textarea name=\"pmtou\"/></textarea><br/>";
  echo "Destination:<br /><select name=\"who\">";
   echo "<option value=\"online\">Online Members</option>";
  echo "<option value=\"staff\">All Staffs</option>";
  echo "<option value=\"mods\">Moderators</option>";
  echo "<option value=\"males\">Males</option>";
  echo "<option value=\"females\">Females</option>";
  echo "<option value=\"all\">All Members</option>";
  echo "</select><br/>";
  echo "<input type=\"submit\" value=\"Send Message\"/>";
  echo "</form>";

echo "<br/><br/>";
echo "</form>";


  echo "</p>";
   echo "<p align='left'>";
  echo "<u><b>Security Settings<br /></b></u>";
if(!ini_get('register_globals'))
{
echo "<br />Register globals is off(Its safe)<br />";
}

else
{
echo "<br />Register globals On(Its unsafe to leave it like this)<br />";
}
echo "</p>";
 echo "<p align='left'>";
if(get_magic_quotes_gpc())
{
echo "<br />magic_quotes is On(Its safe)<br />";
}

else
{
echo "<br />magic_quotes is Off(Its less secure to leave it off)<br />";
}
echo "</p>";
  }else{
   header('location:index.php');
          $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to enter admin cp without admin priviledge!!', actdt='".time()."'");


    echo "Unauthourized Access!";
  }
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
  echo "</p></body</html>";
  exit();
}



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
      echo "<a href=\"pnwp.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;view=$view\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"pnwp.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;view=$view\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"pnwp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
        
        $rets .= "</form>";
        

        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"pnwp.php?action=nicemain&amp;sid=$sid\">";
echo "Admin cp</a>";
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
}






else{
addonline(getuid_sid($sid),"Trying to enter admin cp illegally","");
   echo "<p align=\"center\">";
          $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];
$url = $_SERVER['QUERY_STRING'];
mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for admin cp!!', actdt='".time()."'");

 //  header('location:index.php');
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
