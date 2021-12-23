<?php include_once('antif.php');?>
<?Php

ini_set("display_errors", "0");
ini_set("register_globals", "0");
########################################################################################################################
#////////* THIS IS AN EMAIL SENDER SCRIPT WRITTEN BY AYOOMO9 AND DOWNLOADED FROM wapbies.com*//////////////////////////#
#///This script allow users to send an email for free on your site/////////////////////////////////////////////////////#
#////////////////You must not edit or remove this note/////////////////////////////////////////////////////////////////#
#//////The licence of this script remain valid except if you remove my copyright//////////////////////////////////#
#//////////I have all the the right to contact your hosting company and have it removed from your folder///////////////#
#///////////////////If you got any problem about making it work, just send me an email ayoomo9@yahoo.com///////////////#
#////////////////////////////Get more free scripts at wapbies.com//////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
#//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////#
########################################################################################################################
#############################All the email variables############################




include_once('header.php');
echo "<?xml version=\"1.0\"?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
if(isset($_GET['email']))
      {

$to = $_POST['email'];
$to = str_replace("'", "", $to);
$to = str_replace(";", "", $to);
$to = str_replace("..", "", $to);
$to = str_replace("../", "", $to);
$to = str_replace(",", "", $to);
$to = str_replace("=", "", $to);
$to = str_replace(")", "", $to);
$to = str_replace("(", "", $to);
$to = str_replace(">", "", $to);
$to = str_replace("<", "", $to);
$to = str_replace("system(", "", $to);
$to = str_replace("exec", "", $to);
$to = str_replace("etc", "", $to);
$to = str_replace("passwd", "", $to);
}
if(isset($_GET['subject']))
      {

$subject = $_POST['subject'];
$subject = str_replace("'", "", $subject);
$subject = str_replace(";", "", $subject);
$subject = str_replace("..", "", $subject);
$subject = str_replace("../", "", $subject);
$subject = str_replace(",", "", $subject);
$subject = str_replace("=", "", $subject);
$subject = str_replace(")", "", $subject);
$subject = str_replace("(", "", $subject);
$subject = str_replace(">", "", $subject);
$subject = str_replace("<", "", $subject);
$subject = str_replace("system(", "", $subject);
$subject = str_replace("exec", "", $subject);
$subject = str_replace("etc", "", $subject);
$subject = str_replace("passwd", "", $subject);
}
if(isset($_GET['message']))
      {
$body = $_POST['message'];
}
if(isset($_GET['from']))
      {
$from = $_POST['from'];
}

$headers = "From: $from";


##################Email Functions Start Here###########################

//////Send mail//////
  echo "<head>";
    echo "<title>Mail Sent!</title>";
 echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "<head>";
    echo "<body>";
echo "<p align=\"center\">";
mail("$to", "$from", "$subject", "
$body




		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
         FREE WAPBIES.COM EMAIL SENDER SERVICES
         ----------------------------------------------------------------------------------------------------------
         This mail is Wirelessly sent by a:
         $HTTP_USER_AGENT $REMOTE_ADDR
         through http://wapbies.com
         ----------------------------------------------------------------------------------------------------------
         wapbies.com is a mobile web social networking community. Join now!
         ----------------------------------------------------------------------------------------------------------", "$headers");
  echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
echo "<br />Mail Successfully Sent!<br />";
  echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";
//////////////////Footer//////////////////////////
echo "</p>";
echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
echo "</p></body>
</html>";
/////////Footer Ends Here///////////////
?>