
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");


include_once('header.php');
//header('Content-type: application/vnd.wap.xhtml+xml'); 
echo "<?xml version=\"1.0\"?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_query();
check_browser();

check_method();
connectdb();
$action = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["action"]))));
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
$page = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["page"]))));
$who = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["who"]))));
$uid = strip_tags(mysql_real_escape_string(getuid_sid($sid)));

$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));
$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];

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
      echo "<title>Error!!!</title>";
     echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<img src=\"../images/notok.gif\" alt=\"x\"/><br/>";
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
if($action=="tpc")
{
    addonline(getuid_sid($sid),"Topics search","");
    echo "<head>";
    echo "<title>Search</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "<form action=\"search.php?action=stpc&amp;sid=$sid\" method=\"post\">";
    echo "Text: <input name=\"stext\" maxlength=\"30\"/><br/>";
    echo "In: <select name=\"sin\">";
    echo "<option value=\"1\">Topic Posts</option>";
    echo "<option value=\"2\">Topic Text</option>";
    echo "<option value=\"3\">Topic Name</option>";
    echo "</select><br/>";
    echo "Order: <select name=\"sor\">";
    echo "<option value=\"1\">Newest First</option>";
    echo "<option value=\"2\">Oldest First</option>";
    echo "</select><br/>";
    echo "<input type=\"Submit\" name=\"send\" value=\"Find It\"></form>";
    echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
 echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
 echo "</p></body>";
    exit();
}

else if($action=="blg")
{
    addonline(getuid_sid($sid),"Blogs search","");
    echo "<head>";
    echo "<title>Search</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";
    echo "<form action=\"search.php?action=sblg&amp;sid=$sid\" method=\"post\">";
    echo "Text: <input name=\"stext\" maxlength=\"30\"/><br/>";
    echo "In: <select name=\"sin\">";
    echo "<option value=\"1\">Blog Text</option>";
    echo "<option value=\"2\">Blog Name</option>";
    echo "</select><br/>";
    echo "Order: <select name=\"sor\">";
    echo "<option value=\"1\">Blog Name</option>";
    echo "<option value=\"2\">Time</option>";
    echo "</select><br/>";
    echo "<input type=\"Submit\" name=\"send\" value=\"Find It\"></form>";
    echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
 echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
 echo "</p></body>";
    exit();
}

else if($action=="clb")
{
    addonline(getuid_sid($sid),"Clubs search","");
    echo "<head>";
    echo "<title>Search</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p align=\"center\">";
    echo "<form action=\"search.php?action=sclb&amp;sid=$sid\" method=\"post\">";
    echo "Text: <input name=\"stext\" maxlength=\"30\"/><br/>";
    echo "In: <select name=\"sin\">";
    echo "<option value=\"1\">Club Description</option>";
    echo "<option value=\"2\">Club Name</option>";
    echo "</select><br/>";
    echo "Order: <select name=\"sor\">";
    echo "<option value=\"1\">Club Name</option>";
    echo "<option value=\"2\">Oldest</option>";
    echo "<option value=\"3\">Newest</option>";
    echo "</select><br/>";
    echo "<input type=\"Submit\" name=\"send\" value=\"Find It\"></form>";
    echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}

else if($action=="nbx")
{
    addonline(getuid_sid($sid),"Inbox search","");
    echo "<head>";
    echo "<title>Search</title>";
   echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";
    echo "<form action=\"search.php?action=snbx&amp;sid=$sid\" method=\"post\">";
    echo "Text: <input name=\"stext\" maxlength=\"30\"/><br/>";
    echo "In: <select name=\"sin\">";
    echo "<option value=\"1\">Recieved Messages</option>";
	echo "<option value=\"2\">Sent Messages</option>";
    echo "<option value=\"3\">Sender Name</option>";
    echo "</select><br/>";
    echo "Order: <select name=\"sor\">";
    echo "<option value=\"1\">Newest PMs</option>";
    echo "<option value=\"2\">Oldest PMs</option>";
    echo "<option value=\"2\">Sender Name</option>";
    echo "</select><br/>";
    echo "<input type=\"Submit\" name=\"send\" value=\"Find It\"></form>";
    echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";  echo "</p></body>";
 echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
 echo "</p></body>";
}

else if($action=="mbrn")
{
    addonline(getuid_sid($sid),"Members search","");
    echo "<head>";
    echo "<title>Search</title>";
 echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";
    echo "<form action=\"search.php?action=smbr&amp;sid=$sid\" method=\"post\">";
    echo "Nickname: <input name=\"stext\" maxlength=\"15\"/><br/>";
    echo "Order: <select name=\"sor\">";
    echo "<option value=\"1\">Member Name</option>";
    echo "<option value=\"2\">Last Active</option>";
    echo "<option value=\"3\">Join Date</option>";
    echo "</select><br/>";
    echo "<input type=\"Submit\" name=\"send\" value=\"Find It\"></form>";
    echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";  echo "</p></body>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}

else if($action=="stpc")
{
  $stext = $_POST["stext"];
  $sin = $_POST["sin"];
  $sor = $_POST["sor"];
    addonline(getuid_sid($sid),"Topics search","");
    echo "<head>";
    echo "<title>Search</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";

        if(trim($stext)=="")
        {
            echo "<br/>Please Specify the text to search for";
        }else{
          //begin search
          if($page=="" || $page<1)$page=1;
          if($sin=="1")
          {
            $where_table = "gyd_posts";
            $cond = "text";
            $select_fields = "id, tid";
            if($sor=="1")
            {
              $ord_fields = "dtpost DESC";
            }else{
                $ord_fields = "dtpost";
            }
          }else if($sin=="2")
          {
            $where_table = "gyd_topics";
            $cond = "text";
            $select_fields = "name, id";
            if($sor=="1")
            {
              $ord_fields = "crdate DESC";
            }else{
                $ord_fields = "crdate";
            }
          }else if($sin=="3")
          {
            $where_table = "gyd_topics";
            $cond = "name";
            $select_fields = "name, id";
            if($sor=="1")
            {
              $ord_fields = "crdate DESC";
            }else{
                $ord_fields = "crdate";
            }
          }
          $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%'"));
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    
    $sql = "SELECT ".$select_fields." FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%' ORDER BY ".$ord_fields." LIMIT $limit_start, $items_per_page";
          $items = mysql_query($sql);
          while($item=mysql_fetch_array($items))
          {
            if($sin=="1")
            {
              $tname = htmlspecialchars(gettname($item[1]));
			  
              if($tname=="" || !canaccess(getuid_sid($sid),getfid_tid($item[1]))){
                $tlink = "Unreachable<br/>";
              }else{
              $tlink = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[1]&amp;go=$item[0]\">".$tname."</a><br/>";
              }
                echo  $tlink;
            }
            else
            {
              $tname = htmlspecialchars($item[0]);
              if($tname=="" || !canaccess(getuid_sid($sid),getfid_tid($item[1]))){
                $tlink = "Unreachable<br/>";
              }else{
              $tlink = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[1]\">".$tname."</a><br/>";
              }
                echo  $tlink;
            }
          }
          echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Prev\" value=\"Prev\"></form>";

        echo $rets;
      
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Next\" value=\"Next\"></form>";

        echo $rets;
      
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$(pg)\" method=\"post\">";
        $rets .= "<input name=\"pg\" style=\"-wap-input-format: '*N'\" size=\"3\"/>";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Send\" value=\"Go To Page\"></form>";

        echo $rets;
    }
    echo "</p>";
        }
    
echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}

else if($action=="sblg")
{
  $stext = $_POST["stext"];
  $sin = $_POST["sin"];
  $sor = $_POST["sor"];
    addonline(getuid_sid($sid),"Blogs search","");
    echo "<head>";
    echo "<title>Search</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";

    
    
        if(trim($stext)=="")
        {
            echo "<br/>Failed to search for blogs";
        }else{
          //begin search
          if($page=="" || $page<1)$page=1;
          if($sin=="1")
          {
            $where_table = "gyd_blogs";
            $cond = "btext";
            $select_fields = "id, bname";
            if($sor=="1")
            {
              $ord_fields = "bname";
            }else{
                $ord_fields = "bgdate DESC";
            }
          }else if($sin=="2")
          {
            $where_table = "gyd_blogs";
            $cond = "bname";
            $select_fields = "id, bname";
            if($sor=="1")
            {
              $ord_fields = "bname";
            }else{
                $ord_fields = "bgdate DESC";
            }
          }
          $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%'"));
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT ".$select_fields." FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%' ORDER BY ".$ord_fields." LIMIT $limit_start, $items_per_page";
          $items = mysql_query($sql);
          while($item=mysql_fetch_array($items))
          {
              $tlink = "<a href=\"index.php?action=viewblog&amp;sid=$sid&amp;bid=$item[0]&amp;go=$item[0]\">".htmlspecialchars($item[1])."</a><br/>";

                echo  $tlink;
            
          }
          echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Prev\" value=\"Prev\"></form>";

        echo $rets;
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Next\" value=\"Next\"></form>";

        echo $rets;
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$(pg)\" method=\"post\">";
        $rets .= "<input name=\"pg\" style=\"-wap-input-format: '*N'\" size=\"3\"/>";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Send\" value=\"Go To Page\"></form>";

        echo $rets;
        }
    echo "</p>";
        }
    
echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}

else if($action=="sclb")
{
  $stext = $_POST["stext"];
  $sin = $_POST["sin"];
  $sor = $_POST["sor"];
    addonline(getuid_sid($sid),"Club search","");
    echo "<head>";
    echo "<title>Search</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";

    
        if(trim($stext)=="")
        {
            echo "<br/>Failed to search for club";
        }else{
          //begin search
          if($page=="" || $page<1)$page=1;
          if($sin=="1")
          {
            $where_table = "gyd_clubs";
            $cond = "description";
            $select_fields = "id, name";
            if($sor=="1")
            {
              $ord_fields = "name";
            }else if($sor=="2"){
                $ord_fields = "created";
            }else if($sor=="3"){
                $ord_fields = "created DESC";
            }
          }else if($sin=="2")
          {
            $where_table = "gyd_clubs";
            $cond = "name";
            $select_fields = "id, name";
            if($sor=="1")
            {
              $ord_fields = "name";
            }else if($sor=="2"){
                $ord_fields = "created";
            }else if($sor=="3"){
                $ord_fields = "created DESC";
            }
          }
          $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%'"));
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT ".$select_fields." FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%' ORDER BY ".$ord_fields." LIMIT $limit_start, $items_per_page";
          $items = mysql_query($sql);
          while($item=mysql_fetch_array($items))
          {
              $tlink = "<a href=\"index.php?action=gocl&amp;sid=$sid&amp;clid=$item[0]&amp;go=$item[0]\">".htmlspecialchars($item[1])."</a><br/>";

                echo  $tlink;

          }
          echo "<p align=\"center\">";
		  if($page>1)
    {
      $ppage = $page-1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Prev\" value=\"Prev\"></form>";

        echo $rets;
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Next\" value=\"Next\"></form>";

        echo $rets;
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$(pg)\" method=\"post\">";
        $rets .= "<input name=\"pg\" style=\"-wap-input-format: '*N'\" size=\"3\"/>";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Send\" value=\"Go To Page\"></form>";

        echo $rets;
    }
    echo "</p>";
        }
    
echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
 echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
 echo "</p></body>";
    exit();
}

else if($action=="snbx")
{
  $stext = $_POST["stext"];
  $sin = $_POST["sin"];
  $sor = $_POST["sor"];
    addonline(getuid_sid($sid),"Inbox search","");
    echo "<head>";
    echo "<title>Search</title>";
   echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";

        $myid = getuid_sid($sid);
        if(trim($stext)=="")
        {
            echo "<br/>Failed to search for message";
        }else{
          //begin search
          if($page=="" || $page<1)$page=1;
          if($sin==1)
          {
          $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*)  FROM gyd_private  WHERE text LIKE '%".$stext."%' AND touid='".$myid."'"));
		  }else if($sin==2)
		  {
			$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*)  FROM gyd_private  WHERE text LIKE '%".$stext."%' AND byuid='".$myid."'"));
          }else{
                $stext = getuid_nick($stext);
            $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*)  FROM gyd_private  WHERE byuid ='".$stext."' AND touid='".$myid."'"));
          }
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
          
          if($sin=="1")
          {
            /*
            $where_table = "gyd_blogs";
            $cond = "btext";
            $select_fields = "id, bname";*/
            
            if($sor=="1")
            {
              //$ord_fields = "bname";
              $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page";
            //echo $sql;
            }else if($sor=="2"){
                $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY b.timesent 
            LIMIT $limit_start, $items_per_page";
            }else{
                $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY a.name
            LIMIT $limit_start, $items_per_page";
            }
          }
		  else if($sin=="2")
		  {
			if($sor=="1")
            {
              //$ord_fields = "bname";
              $sql = "SELECT
            a.name, b.id, b.touid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.byuid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page";
            //echo $sql;
            }else if($sor=="2"){
                $sql = "SELECT
            a.name, b.id, b.touid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.byuid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY b.timesent 
            LIMIT $limit_start, $items_per_page";
            }else{
                $sql = "SELECT
            a.name, b.id, b.touid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.touid
            WHERE b.byuid='".$myid."' AND b.text like '%".$stext."%'
            ORDER BY a.name
            LIMIT $limit_start, $items_per_page";
            }
		  }
		  else if($sin=="3")
          {
            
            if($sor=="1")
            {
              //$ord_fields = "bname";
              $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.byuid ='".$stext."'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page";
            }else if($sor=="2"){
                $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.byuid ='".$stext."'
            ORDER BY b.timesent
            LIMIT $limit_start, $items_per_page";
            }else{
                $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.byuid ='".$stext."'
            ORDER BY a.name
            LIMIT $limit_start, $items_per_page";
            }
          }
          

          $items = mysql_query($sql);
          echo mysql_error();
          while($item=mysql_fetch_array($items))
          {
              if($item[3]=="1")
      {
        $iml = "<img src=\"images/npm.gif\" alt=\"+\"/>";
      }else{
        if($item[4]=="1")
        {
            $iml = "<img src=\"images/spm.gif\" alt=\"*\"/>";
        }else{

        $iml = "<img src=\"images/opm.gif\" alt=\"-\"/>";
        }
      }

      $lnk = "<a href=\"inbox.php?action=readpm&amp;pmid=$item[1]&amp;sid=$sid\">$iml ".getnick_uid($item[2])."</a>";
      echo "$lnk<br/>";

          }
          echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Prev\" value=\"Prev\"></form>";

        echo $rets;
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Next\" value=\"Next\"></form>";

        echo $rets;
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$(pg)\" method=\"post\">";
        $rets .= "<input name=\"pg\" style=\"-wap-input-format: '*N'\" size=\"3\"/>";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Submit\" value=\"Go To Page\"></form>";

        echo $rets;
    }
    echo "</p>";
        }
    
echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}

else if($action=="smbr")
{
	$stext = $_POST["stext"];
  $sin = $_POST["sin"];
  $sor = $_POST["sor"];
    addonline(getuid_sid($sid),"Club search","");
    echo "<head>";
    echo "<title>Search</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<p>";

    
        if(trim($stext)=="")
        {
            echo "<br/>Failed to search for club";
        }else{
          //begin search
          if($page=="" || $page<1)$page=1;
          
            $where_table = "gyd_users";
            $cond = "name";
            $select_fields = "id, name";
            if($sor=="1")
            {
              $ord_fields = "name";
            }else if($sor=="2"){
                $ord_fields = "lastact DESC";
            }else if($sor=="3"){
                $ord_fields = "regdate";
            }
          
          $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%'"));
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT ".$select_fields." FROM ".$where_table." WHERE ".$cond." LIKE '%".$stext."%' ORDER BY ".$ord_fields." LIMIT $limit_start, $items_per_page";
          $items = mysql_query($sql);
          while($item=mysql_fetch_array($items))
          {
              $tlink = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[0]\">".htmlspecialchars($item[1])."</a><br/>";

                echo  $tlink;

          }
          echo "<p align=\"center\">";
		  if($page>1)
    {
      $ppage = $page-1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$ppage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Prev\" value=\"Prev\"></form>";

        echo $rets;
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$npage\" method=\"post\">";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Next\" value=\"Next\"></form>";

        echo $rets;
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
        $rets = "<form action=\"search.php?action=$action&amp;sid=$sid&amp;page=$(pg)\" method=\"post\">";
        $rets .= "<input name=\"pg\" style=\"-wap-input-format: '*N'\" size=\"3\"/>";
	  $rets .= "<input type=\"hidden\" name=\"stext\" value=\"$stext\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sin\" value=\"$sin\"/>";
	  $rets .= "<input type=\"hidden\" name=\"sor\" value=\"$sor\"/>";
        $rets .= "<input type=\"Submit\" name=\"Send\" value=\"Go To Page\"></form>";

        echo $rets;
    }
    echo "</p>";
        }
    
echo "</p>";
  echo "<p align=\"center\">";
  echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"\"/>Search Menu</a><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
 echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
 echo "</p></body>";
    exit();
}
  

else{
  addonline(getuid_sid($sid),"Lost in search lol","");
    echo "<head>";
    echo "<title>Search</title>";
    echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "</head>";
    echo "<body>";
  echo "<p align=\"center\">";
  echo "Page not found!<br/><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
   echo " | ";
     if (isadmin(getuid_sid($sid)))
  {
        //echo "<a href=\"modcp.php?action=main&amp;sid=$sid\">Staff Logs($tot/$tol)</a><br />";
     // echo " | ";
	echo "<a href=\"index.php?action=admincp&amp;sid=$sid\">Admin Cp</a>";
  }
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo "</p></body>";
    exit();
}
?>
</html>