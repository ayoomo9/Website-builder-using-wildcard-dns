<?php //include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_injection();
check_browser();

check_method();
include_once('header.php');
connectdb();
$sid = $_GET["sid"];
$page = $_GET["page"];
$who = $_GET["who"];
$uid = mysql_real_escape_string(getuid_sid($sid));
$desc = mysql_real_escape_string($_POST['desc']);
$upload = mysql_real_escape_string(htmlentities(trim(($_POST['upload']))));
$superdat = $_FILES['superdat']['tmp_name'];
$superdat_name=$_FILES['superdat']['name'];
$superdat_size=$_FILES['superdat']['size'];
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=UTF-8");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload File</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>
<?php
echo "<body>";
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
		boxstart("Error!");

echo "<p align=\"center\"><img src=\"images/notok.gif\" alt=\"\"/>
You have been <b>BANNED!</b><br/>";
$banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
$banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
$remain = $banto[0] - time();
$rmsg = gettimemsg($remain);
echo "Ban Reason: ".$banres[0]." <br/>You can login again after ".$rmsg."
</p></div></div>
</body>
</html>";
exit();
    }
    
  echo "<u><p align=\"center\"> <b>Upload File</b><br /><br /></p></u>";
echo "<p>";
addonline(getuid_sid($sid),"Uploading a file at Download Menu","");
if ($upload="upload"&&$superdat_name){
if (!eregi("\.(mid|midi|3gp|avi|mp3|wav|jar|amr|sis|wbmp|pdf|mp4|rar|gif|jpg|jpeg|png|nth|zip|rar)$",$superdat_name)){
print "<small><b>Unsupported File Extention!</b></small>";
 $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by uploading an on allowed file called $superdat_name', actdt='".time()."'");
 
 header('Location:index.php');

}



else{
$superdat_name = preg_replace(
             '/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/'
             ,'',str_replace(array(' ','%20',"'"),array('_','_', ""),$superdat_name));
if(strlen($superdat_name)>53){ print "<b>File Name Is Too Long!</b>";
}else{
if (empty($superdat)) {
print "<b>No input file specified!!!</b>";
}


else{	
$indiatime = time() + (12.5 * 60 * 60);
$date=date("l, FdS,  Y", $indiatime)."  ".date("h:i:s A", $indiatime);
$fsize=round($superdat_size/1024,1);
$exi1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_uploads WHERE filename='".$superdat_name."' AND filesize='".$fsize." KB'"));
if($exi1[0]>0){
	print "<b>File already exists with same name and file size!!!</b>";
	exit();
}


else{
$exi2 = mysql_fetch_array(mysql_query("SELECT COUNT(id), MAX(id) FROM gyd_uploads WHERE filename='".$superdat_name."' AND filesize!='".$fsize." KB'"));
if($exi2[0]>0){
$superdat_name="1".$superdat_name;
$flag1="<br/>Filename already existed but file didnt match so it was renamed and prefixed witha 1";
}
}


//echo mysql_error();
$ext = explode(".", strrev($superdat_name));
switch(strtolower($ext[0])){
	case "dim":
	     $type="audio";
	     break;
	case "idim":
	     $type="audio";
	     break;
	case "3pm":
	     $type="audio";
	     break;
	case "vaw":
	     $type="audio";
	     break;
	case "fmm":
	     $type="audio";
	     break;
	case "rma":
	     $type="audio";
	     break;
	case "a4m":
	     $type="audio";
	     break;
	case "fig":
	     $type="image";
	     break;
	case "gnp":
	     $type="image";
	     break;
	case "gpj":
	     $type="image";
	     break;
	case "gepj":
	     $type="image";
	     break;
	case "pmb":
	     $type="image";
	     break;
	case "pmbw":
	     $type="image";
	     break;
	case "pg3":
	     $type="video";
	     break;
	case "iva":
	     $type="video";
	     break;
	case "4pm":
	     $type="video";
	     break;
	case "gpm":
	     $type="video";
	     break;
	case "gepm":
	     $type="video";
	     break;
	case "cod":
	     $type="document";
	     break;
	case "ftr":
	     $type="document";
	     break;
	case "txt":
	     $type="document";
	     break;
	case "fdp":
	     $type="document";
	     break;
	case "piz":
	     $type="archive";
	     break;
	case "z7":
	     $type="archive";
	     break;
	case "rar":
	     $type="archive";
	     break;
	case "raj":
	     $type="apps";
	     break;
	case "daj":
	     $type="apps";
	     break;
	case "sis":
	     $type="apps";
	     break;
	case "xsis":
	     $type="apps";
	     break;
	case "exe":
	     $type="apps";
	     break;
	case "htn":
	     $type="apps";
	     break;
	case "mht":
	     $type="apps";
	     break;

}
move_uploaded_file("$superdat", "share/$superdat_name") or
die("Couldn't copy file.");
$mysql=mysql_query("INSERT INTO gyd_uploads SET id='', uid='".$uid."', mime='".$type."', filename='".$superdat_name."', filesize='".$fsize." KB', description='".$desc."', date='".$date."', device='".$HTTP_USER_AGENT."', number='".$HTTP_MSISDN.$HTTP_X_MSISDN.$HTTP_X_NOKIA_MSISDN.$HTTP_X_NETWORK_INFO."', uip='".$REMOTE_ADDR."'");
$upplsel=mysql_fetch_array(mysql_query("SELECT plusses from gyd_users WHERE id='".$uid."'"));
$afuppl=$upplsel[0]+2;
   mysql_query("UPDATE gyd_users SET plusses='".$afuppl."' WHERE id='".$uid."'");

echo "<b>$superdat_name</b> has successfully been uploaded to the Uploads Menu!$flag1";
            $byuid = getuid_sid($sid);
$name = getnick_uid($byuid);
$pmtext="Thanks for using wapbies.com Download Menu";

autopm($pmtext, $uid, "Info");
}
}
}
}

?>
<?php
echo "<form align=\"center\" action=\"upload_f.php?sid=$sid\" method=\"post\" enctype=\"multipart/form-data\">";
?>Note: You can only upload file less than 2MB<br/><br/>
File description(Maximum 500 chars):<br/>
<input id="inputText" align="center" type="text" name="desc" maxlength="500"/><br/>
Select file to be uploaded :<br/>
<input id="inputText" align="center" type="file" name="superdat"/><br/>
<input id="inputText" align="center" type="hidden" name="upload" value="upload"/>
<input id="inputButton" align="center" type="submit" name="submit" value="Upload"/><br/><br/> <u>You can upload files with the following extentions:</u><br/>
Audio: mid, midi, mp3, wav, amr<br/>Image: gif, jpg, jpeg, png<br/>Video: 3gp, mpg, avi, mp4 <br/>
Applications: jar, sis<br/>Archives:  Zip, Rar<br/>Documents: pdf<br/>
<hr/>
<?php 

echo "<br/><a href=\"share.php?sid=$sid\">Browse uploaded files</a>"; 
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
?>
</form>
</p>
</body></html>