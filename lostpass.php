<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
<title>Lost password</title>
<meta http-equiv="expires" content="0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" type="image/x-icon" href="images/ni.png" />
<link rel="StyleSheet" type="text/css" media="all" href="default.css" />
<meta name="MSSmartTagsPreventParsing" content="True" />
</head>
<body>
<u><p align='center'>Password reset</a></u>
<br /><br />

<?php
ini_set("display_errors", "0");
require_once("config_cgh.php");
require_once("core.php");
    echo "<br /><div class=\"ads\">";
  include('admob.php');
  echo "</div><br />";
if(isset($_POST['submit']))
{

$email = $_POST['email'];
$email = str_replace("'", "", $email);
$email = str_replace(";", "", $email);
$email = str_replace("..", "", $email);
$email = str_replace("../", "", $email);
$email = str_replace(",", "", $email);
$email = str_replace("=", "", $email);
$email = str_replace(")", "", $email);
$email = str_replace("\n", "", $email);
$email = str_replace("bcc", "", $email);
$email = str_replace("(", "", $email);
$email = str_replace(">", "", $email);
$email = str_replace("<", "", $email);
$email = str_replace("system(", "", $email);
$email = str_replace("exec(", "", $email);
$email = str_replace("etc", "", $email);
$email = strip_tags($email);

if(!preg_match("/\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-.]\w+)*/", $email))
{
echo "Please provide us a valid email address, go <a href='lostpass.php'>back</a> to correct your mistakes.";
echo "<br /><br />";
echo "<div class='whitegreen'>";
echo "
<a href='index.php'><strong>Home</strong></a></div>
<body></html>";
exit;
}
$check = mysql_fetch_array(mysql_query("SELECT COUNT(0) FROM gyd_users WHERE email='".$email."'")) or mysql_error();
if($check[0]>0)
{

$get_email = mysql_fetch_array(mysql_query("SELECT email FROM gyd_users WHERE email='".$email."'")) or mysql_error();

if($get_email[0])
{

$get_name = mysql_fetch_array(mysql_query("SELECT name FROM gyd_users WHERE email='".$email."'")) or mysql_error();
$get_passremind = mysql_fetch_array(mysql_query("SELECT passremind FROM gyd_users WHERE email='".$email."'")) or mysql_error();

$toemail = $get_email[0];
$fromemail = "admin@wapbies.com";
$subject = "wapbies.com Password reminder";
$passremind = $get_passremind[0];
$body = "You've requested for a password reminder\n Your password is $passremind \n Thanks for using wapbies.com free forum and chat services.\n admin";
$headers = $fromemail;
if(mail("$toemail","$subject","$body","$headers"))
{
echo "<strong>Password sent successfully to the email you specified\n Check your email in ten minutes time, if not in inbox then check your spam box for it.\n Thanks for being a true member of wapbies.com</strong>";


}
else
{
echo "Password reminder email can not be sent at the moment, please contact any staff or ayoomo9 for your password.";

}
}

}
else
{
echo "Email could not be found in our record, please make sure you typed correctly the email you registered with or contact ayoomo9 for a fast solution";

}
}


?>



<br /><br />
<form method='POST' action='<?=$_SERVER['PHP_SELF']; ?>'>
Your registered email:<br />
<input type='text' name='email' value='@' /><br />
<input type='submit' name='submit' value='Get password' />
</form>
<br />
<?php

      echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";


?>
<div class='whitegreen'>
<a href='index.php'><strong>Home</strong></a></div>
<body></html>




