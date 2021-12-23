<?php //include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
//include_once("xhtmlfunctions.php");
include('class.upload.php');
check_query();

check_injection();
include_once('header.php');
$bcon = connectdb();


if(isset($_GET['sid']))
      {
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
}


$uid = getuid_sid($sid);
//$descript = $_POST["descript"];
set_time_limit(0);

if(islogged($sid)==false)
{
     // $pstyle = gettheme1("1");
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
<title>Not Login</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>
<body>
<?php
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
   echo "</body></html>";
      exit();
    }

if(isbanned($uid))
    {
    //  $pstyle = gettheme($sid);
	  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
    ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Banned!!</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>
<body>
<?php
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "You are <b>Banned</b><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
	  $banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
	  
      $remain = $banto[0]- (time() - $timeadjust) ;
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
	  echo "Ban Reason: $banres[0]";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
   echo "</body></html>";
      exit();
    }

//////////////////////////////////Members List

error_reporting(E_ALL); 

// we first include the upload class, as we will need it here to deal with the uploaded file

$userinfo = mysql_fetch_array(mysql_query("SELECT name, sex FROM gyd_users WHERE id='".$uid."'"));
$membername = $userinfo[0];

// we have three forms on the test page, so we redirect accordingly
if ($_POST['action'] == 'image') {
     // $pstyle = gettheme($sid);
	  header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=UTF-8");
	  echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
      ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uploading Picture.......</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>
<body>
<?php
      echo "<p align=\"center\">";

    // ---------- IMAGE UPLOAD ----------
    
    // we create an instance of the class, giving as argument the PHP object 
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {
        
        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 150;

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/');
        $handle->Process('wpgal/');
        
        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !

            echo '  file uploaded with success<br/>';
            echo '  <img src="wpgal/' . $handle->file_dst_name . '" /><br/>';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  link to the file just uploaded: <a href="wpgal/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            $byuid = getuid_sid($sid);
$name = getnick_uid($byuid);
$pmtext="Thanks for using wapbies.com gallery";

autopm($pmtext, $uid, "Info");
 $imageurl = "wpgal/$handle->file_dst_name";
               $reg = mysql_query("INSERT INTO gyd_usergallery SET uid='".$uid."', imageurl='".$imageurl."', sex='".$userinfo[1]."', time='".time()."', descript='".$descript."'");

        } else {
            // one error occured

            echo '  file not uploaded to the wanted location<br/>';
            echo '  Error: ' . $handle->error . '<br/>';

        }

        // we delete the temporary files
        $handle-> Clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file

        echo '  file not uploaded on the server<br/>';
        echo '  Error: ' . $handle->error . '';
    }
    

    echo "</p>"; 
  ////// UNTILL HERE >> 
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"usergallery.php?action=main&amp;sid=$sid\">&#171;Back to Gallery</a><br/>";
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

 echo "</body></html>";
}
?>