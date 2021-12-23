<?php //include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
########################################################################################################################
#   ////////* THIS SCRIPT EDITED BY AYOOMO9 AND DOWNLOADED FROM wapbies.com*//////////////////////////                 #
#///This script allow users to send an email for free on your site/////////////////////////////////////////////////////#
#////////////////You must not edit or remove this note/////////////////////////////////////////////////////////////////#
#//////The licence of this script remain valid except if you remove my copyright//////////////////////////////////#
#//////////I have all the the right to contact your hosting company and have it removed from your folder///////////////#
#///////////////////If you got any problem about making it work, just send me an email ayoomo9@yahoo.com///////////////#
#////////////////////////////Get more free scripts at wapbies.com//////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
########################################################################################################################

require_once("config_cgh.php");
//include_once("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
//check_injection();
//check_query();
check_browser();

check_method();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Download Menu</title>
<link rel="StyleSheet" type="text/css" media="all" href="default.css" />
</head>
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
 // echo "<br /><b>AD:</b> <a href=\"http://go.mobpartner.mobi/?wsid=68819\">Free Phone BackUp</a>";
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


/////////////////////////////////////////////Main Menu////////////////////////////////////////////

if($action=="main"){
	echo "<p align=\"center\"><u><b>Wapbies file sharing menu<br /></b></u></p>";
	
	
	echo "
	<br/>
	<img src=\"images/music.gif\" alt=\"\"/><a href=\"share.php?type=audio&amp;sid=$sid\">Audio Files</a><br/>
	<img src=\"images/video.gif\" alt=\"\"/><a href=\"share.php?type=video&amp;sid=$sid\">Video Files</a><br/>
	<img src=\"images/pics.gif\" alt=\"\"/><a href=\"share.php?type=image&amp;sid=$sid\">Image Files</a><br/>
	<img src=\"images/doc.gif\" alt=\"\"/><a href=\"share.php?type=document&amp;sid=$sid\">Document Files</a><br/>
	<img src=\"images/zip.gif\" alt=\"\"/><a href=\"share.php?type=archive&amp;sid=$sid\">Archive Files</a><br/>
	<img src=\"images/games2.gif\" alt=\"\"/><a href=\"share.php?type=apps&amp;sid=$sid\">Apps &amp; Games Files</a><br/>
	<img src=\"images/unknown.gif\" alt=\"\"/><a href=\"share.php?type=all&amp;sid=$sid\">All Files</a><br/>";
	
	echo "<br/><a href=\"searchfile.php?action=files&amp;sid=$sid\">Search for files</a><br />";
	 if(ismod($uid) || isadmin($uid) || isowner($uid) || $uid==194 || $uid==16)
  {
        echo"<br/><a href=\"upload_f.php?sid=$sid\">Upload file</a><br/><br/>";
		}
$total = @mysql_result(mysql_query("SELECT COUNT(*) as Num FROM gyd_uploads"),0);

echo "&nbsp;<b>Total files: ".$total."</b><br/>";
echo "</i>";
 if(!ismod($uid) && !isadmin($uid) && !isowner($uid) && !$uid==194 && !$uid==16)
  {
echo "<br />Note: Sorry, you are limited to download files only, uploading is disabled due to misuse.<br/>";
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
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
	echo "</body></html>";
exit();	
}
//////////////////////////////Display file list////////////////////////////////////

if($action==""){

addonline(getuid_sid($sid),"Browsing $type1 files","");

  	$limit = 10;               
        if(empty($page)){
        $page = 1;
    }
        

    $limitvalue = $page * $limit - ($limit); 
   

    switch($type1){
	    case "video" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='video' ORDER BY id DESC LIMIT $limitvalue, $limit";  
        $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='video'";  
	$iml = "<img src=\"images/video.gif\" alt=\"\"/>";
    $type2 = "Videos";
    break;
    	    case "image" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='image' ORDER BY id DESC LIMIT $limitvalue, $limit";  
            $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='image'";  
	$iml = "<img src=\"images/pics.gif\" alt=\"\"/>";
        $type2 = "Images";

    break;
    	    case "audio" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='audio' ORDER BY id DESC LIMIT $limitvalue, $limit";  
            $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='audio'";  
	$iml = "<img src=\"images/music.gif\" alt=\"\"/>";

        $type2 = "Sounds";

    break;
    	    case "document" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='document' ORDER BY id DESC LIMIT $limitvalue, $limit";  
            $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='document'";  
	$iml = "<img src=\"images/doc.gif\" alt=\"\"/>";
        $type2 = "Documents";

    break;
    	    case "archive" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='archive' ORDER BY id DESC LIMIT $limitvalue, $limit";
            $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='archive'";  
	$iml = "<img src=\"images/zip.gif\" alt=\"\"/>";
        $type2 = "Archives";

    break;
    	    case "apps" :
    $query  = "SELECT filename, uid, dcount FROM gyd_uploads WHERE mime='apps' ORDER BY id DESC LIMIT $limitvalue, $limit";  
            $query1  = "SELECT filename, uid FROM gyd_uploads WHERE mime='apps'";  
	$iml = "<img src=\"images/ppt.gif\" alt=\"\"/>";
        $type2 = "Applications";
    break;
    default :
     $query  = "SELECT filename, uid, dcount FROM gyd_uploads ORDER BY id DESC LIMIT $limitvalue, $limit"; 
             $query1  = "SELECT filename, uid FROM gyd_uploads";  
	$iml = "<img src=\"images/unknown.gif\" alt=\"\"/>";
     $type2 = "All Files";
    break;   
    }
   $result = mysql_query($query) or die("Error: " . mysql_error()); 
      $totalrows      = mysql_num_rows(mysql_query($query1)); 

    if($totalrows == 0){
        echo("No uploaded content in this directory!<br/>");
    }

  while($row = mysql_fetch_array($result)){
     
 $usr = getnick_uid($row['uid']);

echo "$iml<a href=\"share.php?action=viewdetails&amp;file=".$row['filename']."&amp;sid=$sid\">".$row['filename']."</a><br/>Uploaded by: <a href=\"index.php?action=viewuser&amp;who=".$row['uid']."&amp;sid=$sid\">$usr</a><br/>Viewed/Downloaded: ".$row['dcount']." times<br/>";
    }

     if($page != 1){ 
        $pageprev = $page-1;
        
        echo("[<a href=\"share.php?sid=$sid&amp;type=$type1&amp;page=$pageprev\">Previous</a>]<br/> "); 
    }

       $pagenext = $page+1;
    $numofpages = ceil($totalrows / $limit); 
        if($page<$numofpages){
            echo("<br/>[<a href=\"share.php?sid=$sid&amp;type=$type1&amp;page=$pagenext\">Next</a>]"); 
    }

/*    
    for($i = 1; $i <= $numofpages; $i++){
        if($i == $page){
            echo("[$i]");
        }else{
            echo("[<a href=\"share.php?sid=$sid&amp;type=$type1&amp;page=$i\">$i</a>] ");
        }
    }


    if(($totalrows - ($limit * $page)) > 0){
        $pagenext = $page+1;
         
    }
*/    
    mysql_free_result($result); 

    
echo "Page $page of $numofpages<br/>";

    
echo "Jump to page:<form action=\"share.php\" method=\"get\">";
echo "<input id=\"inputText\" type=\"text\" format=\"*n\" name=\"page\" size=\"3\"/><br/>";
echo "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
echo "<input type=\"hidden\" name=\"type\" value=\"$type1\"/>";
echo "<input id=\"inputButton\" type=\"submit\" value=\"Go\"/></form>";
if ($totalrows >= 1)
{
echo "<br/>$totalrows<b> File has been uploaded in this category</b><br/>";
}
echo "<br/><a href=\"searchfile.php?action=files&amp;sid=$sid\">Search files</a><br/>";
 if(ismod($uid) || isadmin($uid) || isowner($uid) || $uid==194 || $uid==16)
  {
echo "<br/><a href=\"upload_f.php?sid=$sid\">Upload File</a><br/>";
}
echo "<a href=\"share.php?action=main&amp;sid=$sid\">Back to Download Menu</a></br>";
	  //  echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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

/////////////////////////////////////////////Delete File(admin only)////////////////////////////////////////////
if($action=="delete"){

$filename=$_GET['filename'];
echo "<p align=\"center\"><b>Deleting Files<big><br /></b></p>";

	if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=194 || $uid==16){
		$blah1=unlink("share/$filename");
		$blah2=mysql_query("DELETE FROM gyd_uploads WHERE filename='".$filename."'");
		$deleter=getnick_uid(getuid_sid($sid));
		mysql_query("INSERT INTO gyd_mlog SET action='Upload center', details='<b>$deleter</b> deleted file ".$filename." from Uploads Center', actdt='".time()."'");

					if($blah1&&$blah2){


				echo "<p>File was successfully deleted! <a href=\"share.php?sid=$sid\">Go back</a></p>";
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
				exit();
		}
		else {
				echo "<p>There was some error! The file could not be deleted, please contact an administrator to manually delete the file. <a href=\"share.php?sid=$sid\">Go back</a></p>";
		}
}		else{
		echo "You are not an Admin!";
	}
	  echo "<a href=\"share.php?action=main&amp;sid=$sid\">Back to Download Menu</a></br>";
	  //echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";	
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

//////////////////////////////////View a file////////////////////////////////////////
if($action=="viewdetails"){
	
if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid))){
$del = "<a href=\"share.php?action=delete&amp;filename=$file&amp;sid=$sid\">[DELETE]</a>";
}

$file=$_GET['file'];
$details = mysql_fetch_array(mysql_query("SELECT * FROM gyd_uploads WHERE filename = '".$file."'"));
  
echo "<p align=\"center\"><b><big>File Information</big><br /></b></p>";

echo "<p><b>File ID:</b> $details[0]<br/>";
echo "<b>Uploaded by:</b> <a href=\"index.php?action=viewuser&amp;who=$details[1]&amp;sid=$sid\">".getnick_uid($details[1])."</a><br/>";
echo "<b>Filename:</b> $details[2]<br/>";
echo "<b>Filesize:</b> $details[4]<br/>";
echo "<b>File category:</b> $details[8]<br/>";
  if(($details[1]==getuid_sid($sid)) || ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid))){
$blah="<a href=\"share.php?action=edit&amp;sid=$sid&amp;file=$details[2]\">Edit</a>";
  }
echo "<b>Uploader's comment:</b>$blah<br/> ".parsepm($details[10], $sid)."<br/>";
echo "<a href=\"share.php?action=comments&amp;fileid=$details[0]&amp;sid=$sid\">Downloader's Comments</a><br/>";
echo "<b>Uploaded on:</b> $details[3]<br/>";
echo "<b>Uploaded through:</b> $details[6]<br/>";
echo "<b>Uploaded from:</b> $details[5]<br/>";
 if(ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid))){
echo "<b>Phone Number:</b> $details[7]<br/>";
}
echo "<b>Viewed/Downloaded:</b> $details[9] times <br/>";
mysql_query("UPDATE gyd_uploads SET dcount=$details[9]+1 WHERE filename='".$file."'");
echo "<a href=\"share/$file\">Download this file</a><br/>";


if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=194 || $uid==16){
echo "<a href=\"share.php?action=delete&amp;filename=$file&amp;sid=$sid\">Delete this file</a>";
}
echo "</p>";
echo "<a href=\"share.php?action=main&amp;sid=$sid\">Back to Download Menu</a></br>";
	   // echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
	/////////////////////////////Edit uploader's comment(mod and uploader only)////////////////////
if ($action=="edit"){
$file = $_GET["file"];
echo "<p align=\"center\"><b><big>Edit Comments</big><br /></b></p>";
 
  $detail = mysql_fetch_array(mysql_query("SELECT uid, description FROM gyd_uploads WHERE filename='".$file."'"));
  if(($detail[0]==getuid_sid($sid)) || ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid))){
	
  echo "Edit comment for $file<br/><form action=\"share.php?action=edt&amp;file=$file&amp;sid=$sid\" method=\"post\"><input id=\"inputText\" type=\"text\" name=\"comment\" value=\"$detail[1]\" maxlength=\"255\"/>";
    echo "<br/><input id=\"inputButton\" type=\"submit\" name=\"Submit\"/></form>";
  }else{
      echo "You are not authorised to edit this file's comment!<a href=\"share.php?action=viewdetails&amp;sid=$sid&amp;file=$file\">Go Back</a></div></div></font></body></html>";
	  exit();
  }
  
	   // echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
//////////////////////////////////////////Display downloders' comments//////////////////////////
else if ($action=="comments"){

    $fileid = $_GET["fileid"];
    $uid = getuid_sid($sid);
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_comup WHERE fileid='".$fileid."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    
        $sql = "SELECT fileid, commenter, comment, time, id FROM gyd_comup WHERE fileid='".$fileid."' ORDER BY time DESC LIMIT $limit_start, $items_per_page";
echo "<p align=\"center\"><b><big>File Comments</big><br /></b></p>";
    
    $items = mysql_query($sql);
    echo mysql_error();
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
      $lnk = "$iml<a href=\"index.php?action=viewuser&amp;who=$item[1]&amp;sid=$sid\">$snick</a>";
      $bs = date("d/m/y h:i:s A",$item[3] + addhours());
      echo "$lnk<br/>";
      if(isowner($uid) || isadmin($uid) || $uid==194 || $uid==16)
      {
        $delnk = "<a href=\"share.php?action=delcmnt&amp;sid=$sid&amp;fileid=$item[4]\">[x]</a>";
      }else{
        $delnk = "";
      }
      $text = parsepm($item[2]);
      echo "$text<br/>$bs $delnk<br/>";
    }
    }
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"share.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;fileid=$fileid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"share.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;fileid=$fileid\">Next&#187;</a>";
    }
    echo "<br/>Page $page of $num_pages<br/>";
    if($num_pages>2){
        $rets = "<form action=\"share.php\" method=\"get\">Jump to page<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"fileid\" value=\"$fileid\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
	$rets .= "<input id=\"inputButton\" type=\"submit\" value=\"Go\"/>";
        $rets .= "</form>";	    
    }
         echo $rets;
     echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
   echo "<a href=\"share.php?action=addcmnt&amp;sid=$sid&amp;fileid=$fileid\">";
echo "Add your comment</a></p>";
echo "<a href=\"share.php?action=main&amp;sid=$sid\">Back to Download Menu</a></br>";
	   // echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
////////////////////////////////////Post a comment(downloaders)////////////////////
else if ($action=="addcmnt"){
$fileid = $_GET['fileid'];
echo "<p align=\"center\"><b><big>Post Comment</big><br /></b></p>";

echo "<p><form action=\"share.php?action=postcmnt&amp;sid=$sid\" method=\"post\">Text:<br/><input id=\"inputText\" type=\"text\" name=\"msgtxt\" maxlength=\"500\"/><br/>";
echo "<input type=\"hidden\" name=\"fileid\" value=\"$fileid\"/>";

echo "<input id=\"inputButton\" type=\"submit\" name=\"submit\" value=\"Post\"/></form></p>";
	   echo "<a href=\"share.php?action=main&amp;sid=$sid\">Back to Download Menu</a></br>";
	   echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>"; 
	   echo "</body></html>";
	   exit();
	}
/////////////////////////////////delcmnt

else if($action=="delcmnt")
{
 
echo "<p align=\"center\"><b><big>Delete Comment</big><br /></b></p>";
	
    $fileid = $_GET["fileid"];
  addonline(getuid_sid($sid),"Deleting comment","");
  echo "<p align=\"center\">";
  if(isadmin(getuid_sid($sid)) || ismod(getuid_sid($sid)) || isowner(getuid_sid($sid)))
  {
    $res = mysql_query("DELETE FROM gyd_comup WHERE id='".$fileid."'");
    if($res)
        {
            echo "<img src=\"images/ok.gif\" alt=\"o\"/>Message Deleted From Comment List<br/>";
        }else{
          echo "<img src=\"images/notok.gif\" alt=\"x\"/>Database Error!<br/>";
        }
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>You can't delete this message";
  }
  echo "<br/><br/>";
      echo "<br/><a href=\"share.php?sid=$sid\">Back to Download Menu</a></p>";
	  //  echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
///////////////////////////////////////postcmnt//////////////////////////////////
else if($action=="postcmnt"){
	    $fileid = $_POST["fileid"];
  $msgtxt = $_POST["msgtxt"];
 
  $uid = getuid_sid($sid);
  addonline(getuid_sid($sid),"Commenting a file","");
  echo "<p align=\"center\"><b><big>Posting Comment</big><br /></b></p>";
  
      echo "<p align=\"center\">";
      $crdate = time();
      //$uid = getuid_sid($sid);
      $res = false;

      if(trim($msgtxt)!="")
      {
        
      $res = mysql_query("INSERT INTO gyd_comup SET fileid='".$fileid."', commenter='".$uid."', time='".$crdate."', comment='".$msgtxt."'");
      }
      if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Message Posted Successfully";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error Posting Message";
      }
      echo "<br/><a href=\"share.php?sid=$sid\">Download Menu</a><br/>";
      echo "</p>";
  //echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
///////////////////////////////////////////////Edit uploaders comment mod and uploader only////////////////
if ($action=="edt"){
$file = $_GET["file"];
 
 echo "<p align=\"center\"><b><big>Edit Comment</big><br /></b></p>";
  
 $comment=$_POST['comment'];
  $detail = mysql_fetch_array(mysql_query("SELECT uid FROM gyd_uploads WHERE filename='".$file."'"));
  if(($detail[0]==getuid_sid($sid)) || ismod(getuid_sid($sid))){
  $blah = mysql_query("UPDATE gyd_uploads SET description='".$comment."' WHERE filename='".$file."'");
  $doer = getnick_uid(getuid_sid($sid));
$blah1 = mysql_query("INSERT INTO gyd_mlog SET action='topics', details='<b>$doer</b> edited comments for file ".$file." at File Exchange', actdt='".time()."'");
  if($blah){
	  echo "Success in editing the comment!";
  }
  else{
	  echo "Failure!!! Couldn't edit comment. Possible network congestion in database server. Try again later.";
  }
  }
  else{
    echo "You are not authorised to edit this file's comment!<a href=\"share.php?action=viewdetails&amp;sid=$sid&amp;file=$file\">Go Back</a></font></body></html>";
	  exit();
  }
  echo "<br/><a href=\"share.php?sid=$sid\">Back to Download Menu</a></p>";
  //echo "<p align=\"center\"><br /><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a></p>";
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
?>
</font></body></html>