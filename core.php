
<?php

//ini_set("register_globals", "0");


include_once("blocked.php");



connectdb();

  
  //Let me chmod my index page to stop script kiddies from re-writting it. lol
  @chmod('index.php',0644);

  function safe($str)
  {
  $str = str_ireplace("'","\'",$str);
    $str = str_ireplace("--","-",$str);
    $str = str_ireplace("??","",$str);
    $str = str_ireplace("#","",$str);
    $str = str_ireplace("$","",$str);
  return $str;
  
  }

  
  
  ///random advert links for users to click And get plusses.........you can change it to your advert links...../////
  function random_ads()
{
   $ope = $_SERVER['HTTP_USER_AGENT'];
   $brws = explode(" ",$ope);
   $brws[0] = strtoupper($brws[0]);
   global $uid;
$testing_numbers = mt_rand(1,5);

if($testing_numbers==1)
{
   echo "<br /><a href='adp.php?id=$uid&url=http://c.mobpartner.mobi/?s=43933'>REGISTER HERE TO SEND FREE SMS</a><br />";

}
elseif($testing_numbers==2)
{
   echo "<br /><a href='adp.php?id=$uid&url=http://c.mobpartner.mobi/?s=43933'>JOIN HERE TO SEND FREE WOLRDWIDE SMS</a><br />";

}
elseif($testing_numbers==3)
{
   echo "<br /><a href='adp.php?id=$uid&url=http://c.mobpartner.mobi/?s=43933'>UNLIMITED FREE WOLRDWIDE SMS</a><br />";

}
elseif($testing_numbers==4)
{
   echo "<br /><a href='adp.php?id=$uid&url=http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw=='>$brws[0] FREE BROWSING CHEATZ</a><br />";

}
else
{
   echo "<br /><a href='adp.php?id=$uid&url=http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw=='>DOWNLOAD LATEST NIGERIAN MUSICS</a><br />";

}
}
  
  
  
  
function registerform($ef)
{
  $ue = $errl = $pe = $ce = "";
  switch($ef)
  {
    case 1:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Please type your UserID";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 2:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Please type your password";
        $pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 3:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Please type your password again";
        $ce = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 4:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> UserID is invalid";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 5:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Password is invalid";
        $pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 6:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Passwords doesn't match";
        $ce = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 7:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> UserID must be 4 characters or more";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 8:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Password must be 4 characters or more";
        $pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 9:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> UserID already in use, choose a different one";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 10:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Try registering later";

        break;
    case 11:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> UserID must start with a letter from a-z";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 12:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> UserID is reserved for admins of the site";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
    case 13:
        $errl = "<img src=\"images/point.gif\" alt=\"!\"/> Please choose an appropriate nickname";
        $ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
        break;
  }
$rform = "<small>$errl</small><br/><br/>";
  $rform .= "<form action=\"register.php\" method=\"post\">";
  $rform .= "$ue UserID: <br/><input name=\"uid\" format=\"*x\" maxlength=\"15\"/><br/>";
  $rform .= "$pe Password:<br/> <input type=\"password\" name=\"pwd\" format=\"*x\" maxlength=\"30\"/><br/>";
  $rform .= "$ce Password:<br/> <input type=\"password\" name=\"cpw\" format=\"*x\" maxlength=\"30\"/><br/>";
  $rform .= "Birthday:(e.g.1985-05-01)<br/> <input name=\"tfbdy\" format=\"NNNN\-NN\-NN\"/><br/>";
  $rform .= "Gender:<br/>";
  $rform .= "<select name=\"usx\" value=\"M\">";
  $rform .= "<option value=\"M\">Male</option>";
  $rform .= "<option value=\"F\">Female</option>";
  $rform .= "</select><br/>";
  $rform .= "Location: <br/><input name=\"ulc\"  maxlength=\"100\"/><br/>";
  
  $rform .= "<input type=\"submit\" value=\"Register\"/>";
  $rform .= "</form>";
  return $rform;

}
////////////////////////////////////////////////////Register

function register($name,$pass,$usex,$bday,$uloc, $ubr)
{
  $execms = mysql_query("SELECT * FROM gyd_users WHERE name='".$name."';");
  
  if (mysql_num_rows($execms)>0){
    return 1;
  }else{
    $pass = md5($pass);
    $reg = mysql_query("INSERT INTO gyd_users SET name='".$name."', pass='".$pass."', birthday='".$bday."', sex='".$usex."', location='".$uloc."', regdate='".time()."', ipadd='".getip()."', browserm='".$ubr."'");
   

    if ($reg)
    {

      $uid = mysql_fetch_array(mysql_query("SELECT id FROM gyd_users WHERE name='".$name."'"));
	  
	  addonline($uid[0],"Just Registered","");

	  $msg = "Some start up tips for you, [b]/reader[/b][br/]Upload your pictures in the gallery by clicking here uploadp[br/]Browse through our interesting wforum and be free to contribute to the forums.[br/]See who is in the chat room here wchat[br/]Feel free to meet wapbies staff team for more enlightments. Thanks and welcome![br/]";
      $msg = mysql_real_escape_string($msg);
      autopm($msg, $uid[0]);
      return 0;
    }else{
      return 2;
      
    }
  }
  
}

  function music()
{


$browser_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
//build up browser string array for easy looping through.....//
$browser_array[0] = "opera";
$browser_array[1] = "msie";
$browser_array[2] = "firefox";
$browser_array[3] = "crazy browser";
$browser_array[4] = "internet explorer";
$browser_array[5] = "chrome";
$browser_array[6] = "safari";
////////////////////////////////////////////


foreach($browser_array as $ayoomo9_key => $assigned_value)
{


if(strstr($browser_user_agent,$assigned_value))
{

?>

<div id="bv_WinMedia1" style="position:absolute;left:0px;top:0px;width:0px;height:0px;z-index:0" align="left">
<embed src="music.mp3" id="WinMedia1" border="0" autostart="true" loop="false" hidden="true" width="0" height="0">
</div>
<?php
}

}

}
  

//DO NOT EDIT BELOW
if(!get_magic_quotes_gpc()) 
{
$v = PHPVERSION();

//explode am e.g 4
$v2 = explode(".",$v);

if(connectdb() && function_exists("mysql_real_escape_string") && $v2[0]>=4)
{

foreach ($_POST as $key => $value){$_POST[$key] = mysql_real_escape_string($value);}
foreach ($_GET as $key => $value){$_GET[$key] = mysql_real_escape_string($value);}
foreach ($_COOKIE as $key => $value){$_COOKIE[$key] = mysql_real_escape_string($value);}
foreach ($_REQUEST as $key => $value){$_REQUEST[$key] = mysql_real_escape_string($value);}
foreach ($_SESSION as $key => $value){$_SESSION[$key] = mysql_real_escape_string($value);}
}
else
{
if(function_exists("addslashes"))
{
foreach ($_POST as $key => $value){$_POST[$key] = addslashes($value);}
foreach ($_GET as $key => $value){$_GET[$key] = addslashes($value);}
foreach ($_COOKIE as $key => $value){$_COOKIE[$key] = addslashes($value);}
foreach ($_REQUEST as $key => $value){$_REQUEST[$key] = addslashes($value);}
foreach ($_SESSION as $key => $value){$_SESSION[$key] = addslashes($value);}
}
else
{
  foreach ($_POST as $key => $value){$_POST[$key] = safe($value);}
    foreach ($_GET as $key => $value){$_GET[$key] = safe($value);}

}
}
}
else
{
foreach ($_POST as $key => $value){$_POST[$key] = stripslashes($value);}
foreach ($_GET as $key => $value){$_GET[$key] = stripslashes($value);}
foreach ($_COOKIE as $key => $value){$_COOKIE[$key] = stripslashes($value);}
foreach ($_REQUEST as $key => $value){$_REQUEST[$key] = stripslashes($value);}
foreach ($_SESSION as $key => $value){$_SESSION[$key] = stripslashes($value);}


if(connectdb() && function_exists("mysql_real_escape_string") && $v2[0]>=4)
{

foreach ($_POST as $key => $value){$_POST[$key] = mysql_real_escape_string($value);}
foreach ($_GET as $key => $value){$_GET[$key] = mysql_real_escape_string($value);}
foreach ($_COOKIE as $key => $value){$_COOKIE[$key] = mysql_real_escape_string($value);}
foreach ($_REQUEST as $key => $value){$_REQUEST[$key] = mysql_real_escape_string($value);}
foreach ($_SESSION as $key => $value){$_SESSION[$key] = mysql_real_escape_string($value);}
}
else
{
if(function_exists("addslashes"))
{
foreach ($_POST as $key => $value){$_POST[$key] = addslashes($value);}
foreach ($_GET as $key => $value){$_GET[$key] = addslashes($value);}
foreach ($_COOKIE as $key => $value){$_COOKIE[$key] = addslashes($value);}
foreach ($_REQUEST as $key => $value){$_REQUEST[$key] = addslashes($value);}
foreach ($_SESSION as $key => $value){$_SESSION[$key] = addslashes($value);}
}
else
{
  foreach ($_POST as $key => $value){$_POST[$key] = safe($value);}
      foreach ($_GET as $key => $value){$_GET[$key] = safe($value);}

}
}
}
/////////////////THE END////////////////////////


function site_is_locked()
{
if(file_exists("lock.it"))
{
return true;

}
else
{
return false;

}

}

///////////REMOVE THE IRRITATING T9SPACE FROM $_POST DATAS/////////////////////////////////
$_POST = str_replace("Sent on a phone using T9space.com", "[clr=red][u][b][small]-[/small][/b][/u][/clr]", $_POST);


function cleanbadinput($input)
{
$input = strip_tags($input);
$input = htmlspecialchars($input);
return($input);
}

function staff_must_use_code()
{
 $check = mysql_fetch_array(mysql_query("SELECT staff_login_auth FROM tools"));
if($check[0]==1)
{
return true;
}
else
{
return false;
}
}




function check_method()
{


if($_SERVER['REQUEST_METHOD']!=GET && $_SERVER['REQUEST_METHOD']!=SESSION && $_SERVER['REQUEST_METHOD']!=COOKIE && $_SERVER['REQUEST_METHOD']!=POST)
{
exit();
}

}

function account_val_time()
{

$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));

$uid = getuid_sid($sid);
  
$q = mysql_fetch_array(mysql_query("SELECT regdate FROM gyd_users WHERE id='".$uid."'"));
$do_query = mysql_fetch_array(mysql_query("SELECT time_to_activate FROM tools"));
$check_result = $do_query[0];
$check = mysql_fetch_array(mysql_query("SELECT use_time_wait FROM tools"));
$check_if_done = mysql_fetch_array(mysql_query("SELECT is_active FROM gyd_users WHERE id='".$uid."'"));

$alertold = "$check_result"; //set this in admin cpanel
$ctime = time();
$calt = $ctime - $alertold;

//activate old members that don dey there before i implement this time waiting tool.
mysql_query("UPDATE gyd_users SET is_active='1' WHERE regdate<$calt");
////end of updation.....lol///

if($check_if_done[0]==1)
{

return true;
}
if($check[0]==0)
{

return true;

}
elseif($q[0]<$calt)
{
mysql_query("UPDATE gyd_users SET is_active='1' WHERE id='".$uid."'");
$pmtext="You user account is now validated(active), you can now enjoy all the nice features on wapbies.com without any limit. Thanks!";

autopmayoomo9($pmtext, $uid);
return true;

}

else
{
return false;

}




}




###################BEGINING OF THE URL BAD QUERY CODE BY AYOOMO9###################
function check_query()
{

$s = $_SERVER['QUERY_STRING'];


if (eregi("ftp:|select|concat|html|xhtml|wml|<?|?>|access_log|Qalias|phf?|REQUEST",$s)

or eregi("php|txt|admincp|javascript|script|system($_GET[c])|dumpfile|outputfile",$s)

or eregi("href=|.vti|exec(|../..%5C|#|convert|null|apache|0x3a|antichat",$s)

or eregi("where|order|///|cgh.php|config.php",$s)

or eregi("table|database|union|meta|update|;|gyd|count|fetch|ase=|encode(|iframe",$s)

or eregi("drop|delete from|insert|truncate|http|load_file",$s)

or eregi("mysql|replace|`|'|http|cmd|htaccess|readfile|shell|safe0ver|load data infile",$s)

or eregi("%2e|%27|--|%2d%2d|chr(0x27)|%00|???|varchar|havin|benchmark|GLOBALS",$s)

or eregi(".php//|cgi|bin|htpasswd|,|passwd|decode(|lock tables|%3C?",$s)


)



 {
$sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));

  $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='RFI Attempt', details=' A user called $user using ip $ip and browser $br was trying to hack the site by using this query string $s', actdt='".time()."'");
  header('location:http://wapbies.com'); //PUT YOUR SITE LINK THERE(ANYWHERE YOU SEE WAPBIES.COM
  
  exit();
}


}
################END OF THE QUERY CODE###################################



###################BEGINING OF THE URL BAD BROWSER CODE BY AYOOMO9###################
function check_browser()
{

$b = $_SERVER['HTTP_USER_AGENT'];


if (eregi("stripper|libwww-perl|rip|offline|evil|spam|harvest",$b)

or eregi("leacher",$b)


or eregi("brute|spoofing",$b)


or eregi("injector|reboot|ping",$b)

or eregi("download|extract|survey|python",$b)


or eregi("ddos",$b)


or eregi("sniff|BackStreet|hack|botnet|floodbot",$b)


or eregi("collector|grabber",$b)


or eregi("jenybot|jakarta|httrack|india|refresh|waste|bandwith",$b)

)

 {
 $sid = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["sid"]))));
  $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='Browser Deny', details='<$user> A user using ip $ip was trying enter wapbies with this browser $b', actdt='".time()."'");

  die("<html><head><title>Banned Browser</title></head><body><p align='center'><u><b>Browser Banned</b></u></p>Our system just detected that your browser ($b) is one of our banned browser.
  <br />
  Therefore, you will not be allowed to access wapbies, this page will always be your stop page.<br />If you still wish to access wapbies.com, we advise you to make use your main browser either pc or mobile.
  <p align='center'>Thanks(Ayoomo9)</p></body></html>");

 
 exit();
}


}
################END OF THE BROWSER CODE###################################





///////////////////////PREVENT MINOR COOKIE STEALER ATTACKS//////////////////////////////////////////////////
function delhtml($str) {
return htmlentities($str);
}

if(isset($_GET)){foreach($_GET as $key=>$value){$_GET[$key]=delhtml($value);}}
if(isset($_POST)){foreach($_POST as $key=>$value){$_POST[$key]=delhtml($value);}}
if(isset($_SESSION)){foreach($_SESSION as $key=>$value){$_SESSION[$key]=delhtml($value);}}
if(isset($_COOKIE)){foreach($_COOKIE as $key=>$value){$_COOKIE[$key]=delhtml($value);}}
////////////////////////CODE ENDS HERE////////////////////////////////////////////////////////////////////////

function get_mob_browser($_mob_browser)
{

if(preg_match('/(google|bot)/i',strtolower($_mob_browser)))
{
$position = strpos(strtolower($_mob_browser),"bot");
$_mob_browser = substr($_mob_browser, $position-30, $position+2);
$_browser = explode (" ", $_mob_browser);
$_browser = array_reverse($_browser);
}
else if (isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']))
{
$_mob_browser = $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'];
$_position=strpos(strtolower($_mob_browser),"nokia");
if($_position)$_mob_browser = substr($_mob_browser, $_position,25);
$_browser = explode ("/", $_mob_browser);
}
else
{
$_position=strpos(strtolower($_mob_browser),"nokia");
if($_position)$_mob_browser = substr($_mob_browser, $_position,25);
$_browser = explode ("/", $_mob_browser);
}

return $_browser[0];
}

if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = $_POST;
	$HTTP_GET_VARS = $_GET;
	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_COOKIE_VARS = $_COOKIE;
	$HTTP_ENV_VARS = $_ENV;
	$HTTP_POST_FILES = $_FILES;

	if (isset($_SESSION))
	{
		$HTTP_SESSION_VARS = $_SESSION;
	}
}

if (isset($HTTP_POST_VARS['GLOBALS']) || isset($HTTP_POST_FILES['GLOBALS']) || isset($HTTP_GET_VARS['GLOBALS']) || isset($HTTP_COOKIE_VARS['GLOBALS']))
{
	die("Hacking attempt");
}

if (isset($HTTP_SESSION_VARS) && !is_array($HTTP_SESSION_VARS))
{
	die("Hacking attempt");
}

if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
{
	$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');

	if (!isset($HTTP_SESSION_VARS) || !is_array($HTTP_SESSION_VARS))
	{
		$HTTP_SESSION_VARS = array();
	}

	$input = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES);

	unset($input['input']);
	unset($input['not_unset']);

	while (list($var,) = @each($input))
	{
		if (!in_array($var, $not_unset))
		{
			unset($$var);
		}
	}

	unset($input);
}

if( !get_magic_quotes_gpc() )
{
	if( is_array($HTTP_GET_VARS) )
	{
		while( list($k, $v) = each($HTTP_GET_VARS) )
		{
			if( is_array($HTTP_GET_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_GET_VARS[$k]) )
				{
					$HTTP_GET_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_GET_VARS[$k]);
			}
			else
			{
				$HTTP_GET_VARS[$k] = addslashes($v);
			}
		}
		@reset($HTTP_GET_VARS);
	}

	if( is_array($HTTP_POST_VARS) )
	{
		while( list($k, $v) = each($HTTP_POST_VARS) )
		{
			if( is_array($HTTP_POST_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_POST_VARS[$k]) )
				{
					$HTTP_POST_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_POST_VARS[$k]);
			}
			else
			{
				$HTTP_POST_VARS[$k] = addslashes($v);
			}
		}
		@reset($HTTP_POST_VARS);
	}

	if( is_array($HTTP_COOKIE_VARS) )
	{
		while( list($k, $v) = each($HTTP_COOKIE_VARS) )
		{
			if( is_array($HTTP_COOKIE_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_COOKIE_VARS[$k]) )
				{
					$HTTP_COOKIE_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_COOKIE_VARS[$k]);
			}
			else
			{
				$HTTP_COOKIE_VARS[$k] = addslashes($v);
			}
		}
		@reset($HTTP_COOKIE_VARS);
	}
}




/////////////////////////VERY GOOD ANTI SQL INJECTION////////////////////
function check_injection()
  {
    $badchars = array("DROP", "SELECT ", "UPDATE", "INSERT", "DELETE" , "UNION", "WHERE", "FROM");

    foreach($_REQUEST  as $value)
    {
      if(in_array(strtoupper($value), $badchars))
      {
      $logfile= 'sql_injection.txt'; //chmod 777
$IP = $_SERVER['REMOTE_ADDR'];
$logdetails= '<br />'. date("F j, Y, g:i a") . ': ' . '<a href=http://dnsstuff.com/tools/city.ch?ip='.$_SERVER['REMOTE_ADDR'].' target=_blank>'.$_SERVER['REMOTE_ADDR'].'</a>';
$fp = fopen($logfile, "a+");
fwrite($fp, $logdetails, strlen($logdetails));
fclose($fp);

  header('location:index.php');
  }
      else
      {
        $check = preg_split("//", $value, -1, PREG_SPLIT_OFFSET_CAPTURE);
        foreach($check as $char)
        {
         if(in_array(strtoupper($char), $badchars))
          {
      $logfile= 'sql_injection.txt';
$IP = $_SERVER['REMOTE_ADDR'];
$logdetails= '<br />'. date("F j, Y, g:i a") . ': ' . '<a href=http://dnsstuff.com/tools/city.ch?ip='.$_SERVER['REMOTE_ADDR'].' target=_blank>'.$_SERVER['REMOTE_ADDR'].'</a>';
$fp = fopen($logfile, "a+");
fwrite($fp, $logdetails, strlen($logdetails));
fclose($fp);

              header('location:index.php');
     }
    }
   }
  }
  }
///////////////////////////////////////////////////////////////


  /////////////////GET REAL IP ADDRESS///////////////
 function ip() {
return (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])?
$_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
}




function subno()
{
if($_SERVER["HTTP_X_UP_SUBNO"]){$subno=$_SERVER["HTTP_X_UP_SUBNO"];}
else{$subno=gethostbyaddr(ip());}
if($subno==""){
$exp_ip=explode(",",ip());
$subno=gethostbyaddr($exp_ip[0]);
}
return $subno;
}

function browser()
{
$browser=preg_replace("/ (.*)/", ")", $_SERVER["HTTP_USER_AGENT"]);
$browser=str_replace("/","(",$browser);
if(strpos($_SERVER["HTTP_USER_AGENT"],"Nokia")==true){
$browser=explode("Nokia",$_SERVER["HTTP_USER_AGENT"]);
$browser=explode("/","Nokia".$browser[1]);
$browser=$browser[0];
}
else if(strpos($_SERVER["HTTP_USER_AGENT"],"es65")==true){
$browser="NokiaE65";
}
else if(mobile()){
$browser=explode("/",$_SERVER["HTTP_USER_AGENT"]);
$browser=$browser[0];
}
else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")==true){$browser="Internet Explorer(7.0)";}
else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0")==true){$browser="Internet Explorer(6.0)";}
else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox/")==true){
$browser=explode("Firefox/",$_SERVER["HTTP_USER_AGENT"]);
$browser="Firefox(".$browser[1].")";
}
else if(strpos($_SERVER["HTTP_USER_AGENT"],"Opera Mini")==true){
$browser=str_replace("/","(",preg_replace("/ (.*)/", " Opera Mini)", $_SERVER["HTTP_USER_AGENT"]));
}
return $browser;
}

function mobile(){
//check if the user agent value claims to be windows but not windows mobile
if(stristr($_SERVER['HTTP_USER_AGENT'],'windows')&&!stristr($_SERVER['HTTP_USER_AGENT'],'windows ce')){
return false;
}
//check if the user agent gives away any tell tale signs it's a mobile browser
if(eregi('up.browser|up.link|windows ce|iemobile|mini|mmp|symbian|midp|wap|phone|pocket|mobile|pda|psp',$_SERVER['HTTP_USER_AGENT'])){
return true;
}
//check the http accept header to see if wap.wml or wap.xhtml support is claimed
if(stristr($_SERVER['HTTP_ACCEPT'],'text/vnd.wap.wml')||stristr($_SERVER['HTTP_ACCEPT'],'application/vnd.wap.xhtml+xml')){
return true;
}
//check if there are any tell tales signs it's a mobile device from the _server headers
if(isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])||isset($_SERVER['X-OperaMini-Features'])||isset($_SERVER['UA-pixels'])){
return true;
}
//build an array with the first four characters from the most common mobile user agents
$a=array('acs-','alav','alca','amoi','audi','aste','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','opwv','palm','pana','pant','pdxg','phil','play','pluc','port','prox','qtek','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','w3c ','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');
//check if the first four characters of the current user agent are set as a key in the array
if(isset($a[substr($_SERVER['HTTP_USER_AGENT'],0,4)])){
return true;
}
}

function ipinrange($ip, $range1, $range2)
{
$ip=ip2long($ip);
$range1=ip2long($range1);
$range2=ip2long($range2);
return (($ip >= $range1) && ($ip <= $range2));
}

function flag($ip)
{
$result=mysql_query("SELECT * FROM network ORDER BY subone, subtwo");
while($ranges=mysql_fetch_array($result)){
if(ipinrange($ip, $ranges[1], $ranges[2])){
$flag="flags/".str_replace(" ","",$ranges["country"]).".gif";
if(!is_file($flag))$flag="flags/".str_replace(" ","",$ranges["country"]).".gif";
return "<img src=\"$flag\" alt=\"".$ranges["country"]."\"/>";
}
}
}

function network($ip,$type)
{
$result=mysql_query("SELECT * FROM network ORDER BY subone, subtwo");
while($ranges=mysql_fetch_array($result)){
if(ipinrange($ip, $ranges[1], $ranges[2])){
return $ranges[$type];
}
}
if(!$ranges["isp"]){
if($_SERVER["HTTP_X_UP_SUBNO"]){$subno=$_SERVER["HTTP_X_UP_SUBNO"];}
else{return gethostbyaddr($ip);}
if($subno==""){
$exp_ip=explode(",",$ip);
return gethostbyaddr($exp_ip[0]);
}
}
}

function network_test($ip)
{
$result=mysql_query("SELECT * FROM network ORDER BY subone, subtwo");
while($ranges=mysql_fetch_array($result)){
if(ipinrange($ip, $ranges[1], $ranges[2])){
return $ranges["isp"]." ".$ranges["country"];
}
}
if(!$ranges["isp"]){
return false;
}
}

function candelgal($uid, $item)
{
  $candoit = @mysql_fetch_array(mysql_query("SELECT  uid FROM gyd_gallery WHERE id='".$item."'"));
  if($uid==$candoit[0]||ismod($uid))
  {
    return true;
  }
  return false;
}
function connectdb()
{
    global $dbname, $dbuser, $dbhost, $dbpass;
    $conms = @mysql_connect($dbhost,$dbuser,$dbpass); //connect mysql
    if(!$conms) return false;
    $condb = @mysql_select_db($dbname);
    if(!$condb) return false;
    return true;
}

/////register form
function findcard($tcode)
{
    $st =strpos($tcode,"[card=");
    if ($st === false)
    {
      return $tcode;
    }else
    {
      $ed =strpos($tcode,"[/card]");
      if($ed=== false)
      {
        return $tcode;
      }
    }
    $texth = substr($tcode,0,$st);
    $textf = substr($tcode,$ed+7);
    $msg = substr($tcode,$st+10,$ed-$st-10);
    $cid = substr($tcode,$st+6,3);
    $words = explode(' ',$msg);
    $msg = implode('+',$words);
  return "$texth<br/><img src=\"pmcard.php?cid=$cid&amp;msg=$msg\" alt=\"$cid\"/><br/>$textf";
}


function saveuinfo($sid)
{

    $headers = apache_request_headers();
    $alli = "";
    foreach ($headers as $header => $value)
    {
        $alli .= "$header: $value <br />\n";
    }
    $alli .= "IP: ".$_SERVER['REMOTE_ADDR']."<br/>";
    $alli .= "REFERRER: ".$_SERVER['HTTP_REFERER']."<br/>";
    $alli .= "REMOTE HOST: ".getenv('REMOTE_HOST')."<br/>";
    $alli .= "PROX: ".$_SERVER['HTTP_X_FORWARDED_FOR']."<br/>";
    $alli .= "HOST: ".getenv('HTTP_X_FORWARDED_HOST')."<br/>";
    $alli .= "SERV: ".getenv('HTTP_X_FORWARDED_SERVER')."<br/>";
    if(trim($sid)!="")
    {
        $uid = getuid_sid($sid);
        $fname = "tmp/".getnick_uid($uid).".rwi";
        $out = fopen($fname,"w");
        fwrite($out,$alli);
        fclose($out);
    }

    //return 0;
}



//////////////////////////////////////////// Search Id
function generate_srid($svar1,$svar2="", $svar3="", $svar4="", $svar5="")
{

  $res = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
  if($res[0]>0)
  {
    return $res[0];
  }
  @mysql_query("INSERT INTO ibwf_search SET svar1='".$svar1."', svar2='".$svar2."', svar3='".$svar3."', svar4='".$svar4."', svar5='".$svar5."', stime='".time()."'");
  $res = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
  return $res[0];
}

function candelvl($uid, $item)
{
  $candoit = @mysql_fetch_array(mysql_query("SELECT  uid FROM gyd_vault WHERE id='".$item."'"));
  if($uid==$candoit[0]||ismod($uid))
  {
    return true;
  }
  return false;
}

/////////////////////////////////// GET RATE

function geturate($uid)
{
  $pnts = 0;
  //by blogs, posts per day, chats per day, gb signatures
  if(ismod($uid))
  {
    return 5;
  }
  $noi = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_blogs WHERE bowner='".$uid."'"));
  if($noi[0]>=5)
  {
    $pnts = 5;
  }else{
    $pnts = $noi[0];
  }
  $noi = @mysql_fetch_array(mysql_query("SELECT regdate, plusses, chmsgs FROM gyd_users WHERE id='".$uid."'"));
  $rwage = ceil((time()- $noi[0])/(24*60*60));
  $ppd = ceil($noi[1]/$rwage);
  if($ppd>=20)
  {
    $pnts+=5;
  }else{
    $pnts += floor($ppd/4);
  }
  $cpd = ceil($noi[2]/$rwage);
  if($cpd>=100)
  {
    $pnts+=5;
  }else{
    $pnts += floor($cpd/20);
  }
  return floor($pnts/3);



}
///////////////////////////////////function isuser

function isuser($uid)
{
  $cus = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE id='".$uid."'"));
  if($cus[0]>0)
  {
    return true;
  }
  return false;
}


////////////////////////////////////////////Can access forum

function canaccess($uid, $fid)
{
  $fex = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_forums WHERE id='".$fid."'"));
  if($fex[0]==0)
  {
    return false;
  }
  $persc = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_acc WHERE fid='".$fid."'"));
  if($persc[0]==0)
  {
    $clid = @mysql_fetch_array(mysql_query("SELECT clubid FROM gyd_forums WHERE id='".$fid."'"));
    if($clid[0]==0)
    {
      return true;
    }else{
      if(ismod($uid) || isadmin($uid) || isowner($uid))
      {
        return true;
      }else{
        $ismm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".$uid."' AND clid='".$clid[0]."'"));
        if($ismm[0]>0)
        {
          return true;
        }else{
          return false;
        }
      }
    }

  }else{
    $gid = @mysql_fetch_array(mysql_query("SELECT gid FROM gyd_acc WHERE fid='".$fid."'"));
    $gid = $gid[0];
    $ginfo = @mysql_fetch_array(mysql_query("SELECT autoass, mage, userst, posts, plusses FROM gyd_groups WHERE id='".$gid."'"));
    if($ginfo[0]=="1")
    {
      $uperms = @mysql_fetch_array(mysql_query("SELECT birthday, ase, posts, plusses FROM gyd_users WHERE id='".$uid."'"));

      if($ginfo[2]==2)
      {

        if(isadmin($uid) || isowner($uid))
        {
            return true;
        }else{
          return false;
        }
      }

      if($ginfo[2]==1)
      {

        if(ismod($uid))
        {
            return true;
        }else{
          return false;
        }
      }
      if($uperms[1]>$ginfo[2])
      {
        return true;
      }
      $acc = true;
      if(getage($uperms[0])< $ginfo[1])
      {
        $acc =  false;
      }
      if($uperms[2]<$ginfo[3])
      {
        $acc =  false;
      }
      if($uperms[3]<$ginfo[4])
      {
        $acc =  false;
      }

    }
  }
  return $acc;
}

function unhtmlspecialchars2( $string )
{
  $string = str_replace ( '&amp;', '&', $string );
  $string = str_replace ( '&#039;', '\'', $string );
  $string = str_replace ( '&quot;', '"', $string );
  $string = str_replace ( '&lt;', '<', $string );
  $string = str_replace ( '&gt;', '>', $string );
  $string = str_replace ( '&uuml;', '?', $string );
  $string = str_replace ( '&Uuml;', '?', $string );
  $string = str_replace ( '&auml;', '?', $string );
  $string = str_replace ( '&Auml;', '?', $string );
  $string = str_replace ( '&ouml;', '?', $string );
  $string = str_replace ( '&Ouml;', '?', $string );
  return $string;
}

function getuage_sid($sid)
{
  $uid = getuid_sid($sid);
  $uage = @mysql_fetch_array(mysql_query("SELECT birthday FROM gyd_users WHERE id='".$uid."'"));
  return getage($uage[0]);
}

function canenter($rid, $sid)
{
    $rperm = @mysql_fetch_array(mysql_query("SELECT mage, ase, chposts, clubid FROM gyd_rooms WHERE id='".$rid."'"));
    $uperm = @mysql_fetch_array(mysql_query("SELECT birthday, chmsgs FROM gyd_users WHERE id='".getuid_sid($sid)."'"));
    if($rperm[3]!=0)
    {
      if(ismod(getuid_sid($sid)))
      {
        return true;
      }else{
        $ismm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_clubmembers WHERE uid='".getuid_sid($sid)."' AND clid='".$rperm[3]."'"));
        if($ismm[0]>0)
        {
          return true;
        }else{
          return false;
        }
      }
    }
	 if($rperm[1]==6)
    {
      return iscoder(getuid_sid($sid));
    }
    if($rperm[1]==7)
    {
      return ismod(getuid_sid($sid));
    }
    if($rperm[1]==8)
    {
      return isadmin(getuid_sid($sid));
    }

   if($rperm[1]==9)
    {
      return isowner(getuid_sid($sid));
    }

    if(getuage_sid($sid)<$rperm[0])
    {
      return false;
    }
    if($uperm[1]<$rperm[2])
    {
      return false;
    }
    return true;
}
///////////////////clear data


function cleardata()
{
  $timeto = 120;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = @mysql_query("DELETE FROM gyd_chonline WHERE lton<'".$timeout."'");
  $timeto = 300;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = @mysql_query("DELETE FROM gyd_chat WHERE timesent<'".$timeout."'");
  $timeto = 60*60;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = @mysql_query("DELETE FROM gyd_search WHERE stime<'".$timeout."'");

  ///delete expired rooms
  $timeto = 5*60;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $rooms = @mysql_query("SELECT id FROM gyd_rooms WHERE static='0' AND lastmsg<'".$timeout."'");
  while ($room=mysql_fetch_array($rooms))
  {
    $ppl = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline WHERE rid='".$room[0]."'"));
    if($ppl[0]==0)
    {
        $exec = @mysql_query("DELETE FROM gyd_rooms WHERE id='".$room[0]."'");
    }
  }
  $lbpm = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='lastbpm'"));
  $td = date("Y-m-d");
  //echo $lbpm[0];

   if ($td!=$lbpm[0])
  {
  $sql = "UPDATE gyd_users SET bank = (bank * 1.05)";
        echo "boo";
        $sql = "SELECT id, name, birthday  FROM gyd_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate())";
        $ppl = @mysql_query($sql);
        while($mem = mysql_fetch_array($ppl))
        {
                $msg = "[card=008]to you $mem[1]"."[/card] wapbies.com staffs wish you a day full of joy and happiness and many happy returns[br/]*wapbies*";
                autopm($msg, $mem[0]);
        }
        mysql_query("UPDATE gyd_settings SET value='".$td."' WHERE name='lastbpm'");
  }

}
///////////////////////////////////////get file ext.

function getext($strfnm)
{
  $str = trim($strfnm);
  if (strlen($str)<4){
    return $str;
  }
  for($i=strlen($str);$i>0;$i--)
  {
    $ext .= substr($str,$i,1);
    if(strlen($ext)==3)
    {
      $ext = strrev($ext);
      return $ext;
    }
  }
}

///////////////////////////////////////get extension icon

function getextimg($ext)
{
    $ext = strtolower($ext);
    switch ($ext)
    {
      case "jpg":
      case "gif":
      case "png":
      case "bmp":
        return "<img src=\"images/image.gif\" alt=\"image\"/>";
        break;
      case "zip":
      case "rar":
        return "<img src=\"images/pack.gif\" alt=\"package\"/>";
        break;
      case "amr":
      case "wav":
      case "mp3":
        return "<img src=\"images/music.gif\" alt=\"music\"/>";
        break;
      case "mpg":
      case "3gp":
        return "<img src=\"images/video.gif\" alt=\"video\"/>";
        break;
      default:
        return "<img src=\"images/other.gif\" alt=\"!\"/>";
        break;
    }
}

///////////////////////////////////////Add to chat

function addtochat($uid, $rid)
{
  $timeto = 120;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = @mysql_query("DELETE FROM gyd_chonline WHERE lton<'".$timeout."'");
  $res = @mysql_query("INSERT INTO gyd_chonline SET lton='".time()."', uid='".$uid."', rid='".$rid."'");
  if(!$res)
  {
    @mysql_query("UPDATE gyd_chonline SET lton='".time()."', rid='".$rid."' WHERE uid='".$uid."'");
  }
}

////////////////////////////////////////////is mod

function candelgb($uid,$mid)
{
  $minfo = @mysql_fetch_array(mysql_query("SELECT gbowner, gbsigner FROM gyd_gbook WHERE id='".$mid."'"));
  if($minfo[0]==$uid)
  {
    return true;
  }
  if($minfo[1]==$uid)
  {
    return true;
  }
  return false;
}

////////////////////////////////////////////Spam filter

function isspam($text)
{
 $sfil[0] = ".co.cc";
 $sfil[1] = "livechat";
 $sfil[2] = "frndz chat";
  $sfil[2] = "frndz";
  $text = str_replace(" ", "", $text);
  $text = strtolower($text);
  for($i=0;$i<count($sfil);$i++)
  {

    $nosf = substr_count($text,$sfil[$i]);
    if($nosf>0)
    {
      return true;
    }
  }

  return false;
}


///////////////////////////////////get page from go

function getpage_go($go,$tid)
{
  if(trim($go)=="")return 1;
  if($go=="last")return getnumpages($tid);
  $counter=1;

  $posts = @mysql_query("SELECT id FROM gyd_posts WHERE tid='".$tid."'");
  while($post=mysql_fetch_array($posts))
  {
    $counter++;
    $postid = $post[0];
    if($postid==$go)
    {
        $tore = ceil($counter/5);
        return $tore;
    }
  }
  return 1;
}

////////////////////////////get number of topic pages

function getnumpages($tid)
{
  $nops = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE tid='".$tid."'"));
  $nops = $nops[0]+1; //where did the 1 come from? the topic text, duh!
  $nopg = ceil($nops/5); //5 is the posts to show in each page
  return $nopg;
}
////////////////////////////////////////////can delete a blog?

function candelbl($uid,$bid)
{
  $minfo = @mysql_fetch_array(mysql_query("SELECT bowner FROM gyd_blogs WHERE id='".$bid."'"));
  if(ismod($uid) || isadmin($uid) || isowner($uid))
  {
    return true;
  }
  if($minfo[0]==$uid)
  {
    return true;
  }

  return false;
}

//////////////////////////////////////////////////RAVEBABE Bot///////////
function PostToHost($host, $path, $data_to_send)
{

				$result = "";
        $fp = fsockopen($host,80,$errno, $errstr, 30);
        if( $fp)
        {
            fputs($fp, "POST $path HTTP/1.0\n");
        fputs($fp, "Host: $host\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\n");
        fputs($fp, "Content-length: " . strlen($data_to_send) . "\n");
        fputs($fp, "Connection: close\n\n");
        fputs($fp, $data_to_send);

        while(!feof($fp)) {
					$result .=  fgets($fp, 128);
        }
        fclose($fp);

        return $result;
        }


}
/////////////////////////Get user plusses

function getplusses($uid)
{
    $plus = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
    return $plus[0];
}
/////////////////////////Can uid sign who's guestbook?

function cansigngb($uid, $who)
{
  if(arebuds($uid, $who))
  {
    return true;
  }
  if($uid==$who)
  {
    return false; //imagine if someone signed his own gbook o.O
  }
  if(getplusses($uid)>=10)
  {
    return true;
  }
  return false;
}
/////////////////////////////////////////////Are buds?

function arebuds($uid, $tid)
{
    $res = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='1'"));
    if($res[0]>0)
    {
      return true;
    }
    return false;
}

//////////////////////////////////function get n. of buds

function getnbuds($uid)
{
  $notb = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
  return $notb[0];
}

/////////////////////////////get no. of requests

function getnreqs($uid)
{
  $notb = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE  tid='".$uid."' AND agreed='0'"));
  return $notb[0];
}


/////////////////////////////get no. of online buds

function getonbuds($uid)
{
  $counter =0;
    $buds = @mysql_query("SELECT uid, tid FROM gyd_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'");
    while($bud=mysql_fetch_array($buds))
    {
      if($bud[0]==$uid)
      {
        $tid = $bud[1];
      }else{
        $tid = $bud[0];
      }
      if(isonline($tid))
      {
        $counter++;
      }
    }
    return $counter;
}



/////////////////////////////////////////////Function shoutbox

function getshoutbox($sid)
{
  $lshout = @mysql_fetch_array(mysql_query("SELECT shout, shouter, id  FROM gyd_shouts ORDER BY shtime DESC LIMIT 1"));
  $shnick = getnick_uid($lshout[1]);
  $shbox .= "<br /><u><strong>ShoutBox</strong></u><br /><br /><i><a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$lshout[1]\">".$shnick."</a></i>: ";
  $shboxtxt = parsepm($lshout[0], $sid);
  $shbox .= stripslashes(str_replace("/reader",getnick_uid(getuid_sid($sid)), $shboxtxt));
  $shbox .= "<br/>";
  $shbox .= "<center>";
  $shbox .= "<a href=\"index.php?action=shout&amp;sid=$sid\">Shout</a>,  ";
  $shbox .= "<a href=\"lists.php?action=shouts&amp;sid=$sid\">More</a>";
  $uid = mysql_real_escape_string(getuid_sid($sid));
  if (iscoder(getuid_sid($sid)) || ismod(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
  {
    $shbox .= ",  <a href=\"wmcpr.php?action=delsh&amp;sid=$sid&amp;shid=$lshout[2]\">Delete</a>";
  }
  $shbox .= "</center>";
  return $shbox;
}











/////////////////////////////////////////////get tid frm post id

function gettid_pid($pid)
{
  $tid = @mysql_fetch_array(mysql_query("SELECT tid FROM gyd_posts WHERE id='".$pid."'"));
  return $tid[0];
}

///////////////////////////////////////////is trashed?

function istrashed($uid)
{
  $del = @mysql_query("DELETE FROM pur WHERE timeto<'".time()."'");
  $not = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_pur WHERE uid='".$uid."' AND penalty='0'"));
  if($not[0]>0)
  {
    return true;
  }else{
    return false;
  }
}

///////////////////////////////////////////is shielded?

function isshield($uid)
{
  $not = @mysql_fetch_array(mysql_query("SELECT shield FROM gyd_users WHERE id='".$uid."'"));
  if($not[0]=='1')
  {
    return true;
  }else{
    return false;
  }
}

///////////////////////////////////////////Get IP

function getip_uid($uid)
{
  $not = @mysql_fetch_array(mysql_query("SELECT ipadd FROM gyd_users WHERE id='".$uid."'"));
  return $not[0];

}

///////////////////////////////////////////Get Browser

function getbr_uid($uid)
{
  $not = @mysql_fetch_array(mysql_query("SELECT browserm FROM gyd_users WHERE id='".$uid."'"));
  return $not[0];

}

///////////////////////////////////////////is trashed?

function isbanned($uid)
{
  $del = @mysql_query("DELETE FROM pur WHERE timeto<'".time()."'");
  $not = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_pur WHERE uid='".$uid."' AND (penalty='1' OR penalty='2')"));

  if($not[0]>0)
  {
    return true;
  }else{
    return false;
  }
}


/////////////////////////////////////////////get tid frm post id

function gettname($tid)
{
  $tid = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_topics WHERE id='".$tid."'"));
  return $tid[0];
}

/////////////////////////////////////////////get tid frm post id

function getfid_tid($tid)
{
  $fid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$tid."'"));
  return $fid[0];
}

/////////////////////////////////////////////is ip banned

function isipbanned($ipa, $brm)
{

  $pinf = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_pur WHERE penalty='2' AND ipadd='".$ipa."'"));
  if($pinf[0]>0)
  {
  return true;
}
return false;
}

////////////////get number of pinned topics in forum

function getpinned($fid)
{
  $nop = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE fid='".$fid."' AND pinned ='1'"));
  return $nop[0];
}

/////////////////////////////////////////////can bud?

function budres($uid, $tid)
{
  //3 = can't bud
  //2 = already buds
  //1 = request pended
  //0 = can bud
  if($uid==$tid)
  {
    return 3;
  }

  if (arebuds($uid, $tid))
  {
    return 2;
  }
  $req = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='0'"));
  if($req[0]>0)
  {
    return 1;
  }
  $notb = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE (uid='".$tid."' OR tid='".$tid."') AND agreed='1'"));
  global $max_buds;
  if($notb[0]>=$max_buds)
  {

    return 3;
  }
  $notb = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
  global $max_buds;
  if($notb[0]>=$max_buds)
  {

    return 3;
  }
  return 0;
}
////////////////////////////////////////////Session expiry time

function getsxtm()
{
   $getdata = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sesexp'"));
   return $getdata[0];
}

////////////////////////////////////////////Get bud msg

function getbudmsg($uid)
{
   $getdata = @mysql_fetch_array(mysql_query("SELECT budmsg FROM gyd_users WHERE id='".$uid."'"));
   return $getdata[0];
}

////////////////////////////////////////////Get forum name

function getfname($fid)
{
  $fname = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_forums WHERE id='".$fid."'"));
  return $fname[0];
}
////////////////////////////////////////////PM antiflood time

function getpmaf()
{
   $getdata = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='pmaf'"));
   return $getdata[0];
}

////////////////////////////////////////////PM antiflood time

function getfview()
{
   $getdata = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='fview'"));
   return $getdata[0];
}

////////////////////////////////////////////get forum message

function getfmsg()
{
   $getdata = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='4ummsg'"));
   return $getdata[0];
}

//////////////////////////////////////////////is online

function isonline($uid)
{
  $uon = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_online WHERE userid='".$uid."'"));
  if($uon[0]>0)
  {
    return true;
  }else
  {
    return false;
  }
}
///////////////////////////if registration is allowed

function canreg()
{
   $getreg = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='reg'"));
   if($getreg[0]=='1')
   {
     return true;
   }else
   {
     return false;
   }
}

///////////////////////////////////////////Get Forum ID

function getfid($topicid)
{
  $fid = @mysql_fetch_array(mysql_query("SELECT fid FROM gyd_topics WHERE id='".$topicid."'"));
  return $fid[0];
}
////////////////////////////////////////////Parse PM
////anti spam
function parsepm($text, $sid="")
{
  $text = $text;
  $sml = @mysql_fetch_array(mysql_query("SELECT hvia FROM gyd_users WHERE id='".getuid_sid($sid)."'"));
  if ($sml[0]=="1")
  {
  $text = getsmilies($text);
  }
  $text = getbbcode($text, $sid);
  $text = findcard($text);
  return $text;
}


////////////////////////////////////////////Parse other msgs

function parsemsg($text,$sid="")
{
  $text = $text;
  $sml = @mysql_fetch_array(mysql_query("SELECT hvia FROM gyd_users WHERE id='".getuid_sid($sid)."'"));
  if ($sml[0]=="1")
  {
  $text = getsmilies($text);
  }
  $text = getbbcode($text, $sid);
  $text = findcard($text);
  return $text;
}
///////////////////////////////////////////Is site blocked

function isblocked($str,$sender)
{
 
  if(iscoder($sender) || ismod($sender) || isadmin($sender) || isowner($sender) || $sender=='1')
  {

    return false;
  }
  $str = str_replace(" ","",$str);
$sites[0] = "vinhat.com";
$sites[1] = "frndzchat";
$sites[2] = "livechat-";
$sites[3] = "frndzc";
  for($i=0;$i<count($sites);$i++)
  {
        $nosf = substr_count($str,$sites[$i]);
    if($nosf>0)
    {
      return true;
    }
  }
  return false;
}

///////////////////////////////////////////Is pm starred

function isstarred($pmid)
{
  $strd = @mysql_fetch_array(mysql_query("SELECT starred FROM gyd_private WHERE id='".$pmid."'"));
  if($strd[0]=="1")
  {
    return true;
  }else{
    return false;
  }
}
////////////////////////////////////////////IS LOGGED?

function islogged($sid)
{
  //delete old sessions first

  $deloldses = mysql_query("DELETE FROM gyd_ses WHERE expiretm<'".time()."'");
  //does sessions exist?
  $sesx = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_ses WHERE id='".$sid."'"));

  if($sesx[0]>0)
  {
    if(!isuser(getuid_sid($sid)))
{
  return false;
}
    //yip it's logged in
    //first extend its session expirement time
    $xtm = time() + (60*getsxtm());
    $extxtm = @mysql_query("UPDATE gyd_ses SET expiretm='".$xtm."' WHERE id='".$sid."'");
    return true;
  }else{
    //nope its session must be expired or something
    return false;
  }
}


////////////////////////Get user nick from session id

function getnick_sid($sid)
{
  $uid = @mysql_fetch_array(mysql_query("SELECT uid FROM gyd_ses WHERE id='".$sid."'"));
  $uid = $uid[0];
  return getnick_uid($uid);
}

////////////////////////Get user id from session id

function getuid_sid($sid)
{
  $uid = @mysql_fetch_array(mysql_query("SELECT uid FROM gyd_ses WHERE id='".$sid."'"));
  $uid = $uid[0];
  return $uid;
}

/////////////////////Get total number of pms

function getpmcount($uid,$view="all")
{
  if($view=="all"){
    $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$uid."'"));
    }else if($view =="snt")
    {
        $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE byuid='".$uid."'"));
    }else if($view =="str")
    {
        $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$uid."' AND starred='1'"));
    }else if($view =="urd")
    {
        $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$uid."' AND unread='1'"));
    }
    return $nopm[0];
}

function deleteClub($clid)
{
    $fid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_forums WHERE clubid='".$clid."'"));
    $fid = $fid[0];
    $topics = @mysql_query("SELECT id FROM gyd_topics WHERE fid=".$fid."");
    while($topic = mysql_fetch_array($topics))
    {
      @mysql_query("DELETE FROM gyd_posts WHERE tid='".$topic[0]."'");
    }
    @mysql_query("DELETE FROM gyd_topics WHERE fid='".$fid."'");
    @mysql_query("DELETE FROM gyd_forums WHERE id='".$fid."'");
    @mysql_query("DELETE FROM gyd_rooms WHERE clubid='".$clid."'");
    @mysql_query("DELETE FROM gyd_clubmembers WHERE clid='".$clid."'");
    @mysql_query("DELETE FROM gyd_announcements WHERE clid='".$clid."'");
    @mysql_query("DELETE FROM gyd_clubs WHERE id=".$clid."");
    return true;
}

function deleteMClubs($uid)
{
  $uclubs = @mysql_query("SELECT id FROM gyd_clubs WHERE owner='".$uid."'");
  while($uclub=mysql_fetch_array($uclubs))
  {
    deleteClub($uclub[0]);
  }
}
//////////////////////Function add user to online list

function addonline($uid,$place,$plclink)
{

  
  /////delete inactive users from online list
  $tm = time();
  $timeout = $tm - 3600; //time out = 1 hours
  $deloff = @mysql_query("DELETE FROM gyd_online WHERE actvtime <'".$timeout."'");
    ////to hide from online list/////// 
 $ayquery = mysql_fetch_array(mysql_query("SELECT show_online FROM gyd_users WHERE id='".$uid."'"));

if($ayquery[0]==1)
{
  ///now try to add user to online list
  $res = @mysql_query("UPDATE gyd_users SET lastact='".time()."' WHERE id='".$uid."'");



  $res = @mysql_query("INSERT INTO gyd_online SET userid='".$uid."', actvtime='".$tm."', place='".$place."', placedet='".$plclink."'");
  if(!$res)
  {
    //most probably userid already in the online list
    //so just update the place and time
    $res = @mysql_query("UPDATE gyd_online SET actvtime='".$tm."', place='".$place."', placedet='".$plclink."' WHERE userid='".$uid."'");


  }
  }
  ///end hidden from online list//////
  
  $maxmem=mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE id='2'"));

            $result = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_online"));

          if($result[0]>=$maxmem[0])
          {
            $tnow = date("D d M Y - H:i");
            @mysql_query("UPDATE gyd_settings set name='".$tnow."', value='".$result[0]."' WHERE id='2'");
          }
          $maxtoday = @mysql_fetch_array(mysql_query("SELECT ppl FROM gyd_mpot WHERE ddt='".date("d m y")."'"));
          if($maxtoday[0]==0||$maxtoday=="")
          {
            @mysql_query("INSERT INTO gyd_mpot SET ddt='".date("d m y")."', ppl='1', dtm='".date("H:i:s")."'");
            $maxtoday[0]=1;
          }
          if($result[0]>=$maxtoday[0])
          {
            @mysql_query("UPDATE gyd_mpot SET ppl='".$result[0]."', dtm='".date("H:i:s")."' WHERE ddt='".date("d m y")."'");
          }
}

/////////////////////Get members online

function getnumonline()
{

    $nouo = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_online WHERE userid!='0'"));
    return $nouo[0];
}

//////////////////////////////////////is ignored

function isignored($tid, $uid)
{
  $ign = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_ignore WHERE target='".$tid."' AND name='".$uid."'"));
  if($ign[0]>0)
  {
    return true;
  }
  return false;
}

///////////////////////////////////////////GET IP

function getip()
{
    if ($_SERVER['HTTP_X_FORWARDED_FOR'])
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//////////////////////////////////////////ignore result

function ignoreres($uid, $tid)
{
  //0 user can't ignore the target
  //1 yes can ignore
  //2 already ignored
  if($uid==$tid)
  {
    return 0;
  }
  if(ismod($tid) || isadmin($tid) || isowner($tid))
  {
    //you cant ignore staff members
    return 0;
  }
  if(arebuds($tid, $uid))
  {
    //why the hell would anyone ignore his bud? o.O
    return 0;
  }
  if(isignored($tid, $uid))
  {
    return 2; // the target is already ignored by the user
  }
  return 1;
}

///////////////////////////////////////////Function getage

function getage($strdate)
{
    $dob = explode("-",$strdate);
    if(count($dob)!=3)
    {
      return 0;
    }
    $y = $dob[0];
    $m = $dob[1];
    $d = $dob[2];
    if(strlen($y)!=4)
    {
      return 0;
    }
    if(strlen($m)!=2)
    {
      return 0;
    }
    if(strlen($d)!=2)
    {
      return 0;
    }
  $y += 0;
  $m += 0;
  $d += 0;
  if($y==0) return 0;
  $rage = date("Y") - $y;
  if(date("m")<$m)
  {
    $rage-=1;

  }else{
    if((date("m")==$m)&&(date("d")<$d))
    {
      $rage-=1;
    }
  }
  return $rage;
}

/////////////////////////////////////////getavatar
/*
function getavatar($uid)
{
  $av = mysql_fetch_array(mysql_query("SELECT avatar FROM gyd_users WHERE id='".$uid."'"));
  return $av[0];
}

*/


function getavatar($uid){

$av = @mysql_fetch_array(mysql_query("SELECT avatar, sex FROM gyd_users WHERE id='".$uid."'"));

if($av[0]==NULL){

	if($av[1]=='M'){

		return "images/nophotoboy.gif";

	}

	else if($av[1]=='F'){

		return "images/nophotogirl.gif";

	}

}

return $av[0];

}







/////////////////////////////////////////Can see details?

function cansee($uid, $tid)
{
  if($uid==$tid)
  {
    return true;
  }
  if(ismod($uid) || isadmin($uid) || isowner($uid))
  {
    return true;
  }
  return false;
}

//////////////////////////gettimemsg

function gettimemsg($sec)
{

$years=0;
$months=0;
$weeks=0;
$days=0;
$mins=0;
$hours=0;
if ($sec>59)
{
$secs=$sec%60;
$mins=$sec/60;
$mins=(integer)$mins;
}

if ($mins>59)
{
$hours=$mins/60;
$hours=(integer)$hours;
$mins=$mins%60;
}

if ($hours>23)
{
$days=$hours/24;
$days=(integer)$days;
$hours=$hours%24;
}

if ($days>6)
{
$weeks=$days/7;
$weeks=(integer)$weeks;
$days=$days%7;
}

if ($weeks>3)
{
$months=$weeks/4;
$months=(integer)$months;
$weeks=$weeks%4;
}

if ($months>11)
{
$years=$months/12;
$years=(integer)$years;
$months=$months%12;
}

if($years>0)
{
if($years==1){$yearmsg="year";}else{$yearmsg="years";}
if($months==1){$monthsmsg="month";}else{$monthsmsg="months";}
if($days==1){$daysmsg="day";}else{$daysmsg="days";}
if($hours==1){$hoursmsg="hour";}else{$hoursmsg="hours";}
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if($secs==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($months!=0){$monthscheck="$months $monthsmsg ";}else{$monthscheck="";}
if(($days!=0)&&($months==0)){$dayscheck="$days $daysmsg ";}else{$dayscheck="";}
if(($hours!=0)&&($months==0)&&($days==0)){$hourscheck="$hours $hoursmsg ";}else{$hourscheck="";}
if(($mins!=0)&&($months==0)&&($days==0)&&($hours==0)){$minscheck="$mins $minsmsg ";}else{$minscheck="";}
if(($secs!=0)&&($months==0)&&($days==0)&&($hours==0)&&($mins==0)){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$years $yearmsg $monthscheck$dayscheck$hourscheck$minscheck$secscheck";
}

if(($years<1)&&($months>0))
{
if($months==1){$monthsmsg="month";}else{$monthsmsg="months";}
if($days==1){$daysmsg="day";}else{$daysmsg="days";}
if($hours==1){$hoursmsg="hour";}else{$hoursmsg="hours";}
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if($secs==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($days!=0){$dayscheck="$days $daysmsg ";}else{$dayscheck="";}
if(($hours!=0)&&($days==0)){$hourscheck="$hours $hoursmsg ";}else{$hourscheck="";}
if(($mins!=0)&&($days==0)&&($hours==0)){$minscheck="$mins $minsmsg ";}else{$minscheck="";}
if(($secs!=0)&&($days==0)&&($hours==0)&&($mins==0)){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$months $monthsmsg $dayscheck$hourscheck$minscheck$secscheck";
}

if(($months<1)&&($weeks>0))
{
if($weeks==1){$weeksmsg="week";}else{$weeksmsg="weeks";}
if($days==1){$daysmsg="day";}else{$daysmsg="days";}
if($hours==1){$hoursmsg="hour";}else{$hoursmsg="hours";}
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if($secs==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($days!=0){$dayscheck="$days $daysmsg ";}else{$dayscheck="";}
if(($hours!=0)&&($days==0)){$hourscheck="$hours $hoursmsg ";}else{$hourscheck="";}
if(($mins!=0)&&($days==0)&&($hours==0)){$minscheck="$mins $minsmsg ";}else{$minscheck="";}
if(($secs!=0)&&($days==0)&&($hours==0)&&($mins==0)){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$weeks $weeksmsg $dayscheck$hourscheck$minscheck$secscheck";
}

if(($weeks<1)&&($days>0))
{
if($days==1){$daysmsg="day";}else{$daysmsg="days";}
if($hours==1){$hoursmsg="hour";}else{$hoursmsg="hours";}
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if($secs==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($hours!=0){$hourscheck="$hours $hoursmsg ";}else{$hourscheck="";}
if(($mins!=0)&&($hours==0)){$minscheck="$mins $minsmsg ";}else{$minscheck="";}
if(($secs!=0)&&($hours==0)&&($mins==0)){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$days $daysmsg $hourscheck$minscheck$secscheck";
}

if(($days<1)&&($hours>0))
{
if($hours==1){$hoursmsg="hour";}else{$hoursmsg="hours";}
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if($secs==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($mins!=0){$minscheck="$mins $minsmsg ";}else{$minscheck="";}
if(($secs!=0)&&($mins==0)){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$hours $hoursmsg $minscheck$secscheck";
}

if(($hours<1)&&($mins>0))
{
if($mins==1){$minsmsg="minute";}else{$minsmsg="minutes";}
if(($secs==1)&&($mins==0)){$secsmsg="second";}else{$secsmsg="seconds";}

if($secs!=0){$secscheck="$secs $secsmsg";}else{$secscheck="";}

return "$mins $minsmsg $secscheck";
}

if(($mins<1)&&($sec>0))
{
if($sec==1){$secsmsg="second";}else{$secsmsg="seconds";}

if($sec!=0){$secscheck="$sec $secsmsg";}else{$secscheck="";}

return "$secscheck";
}else{
return "Online!";
}
}






function rating($uid)
{
$info=mysql_fetch_array(mysql_query("SELECT * FROM gyd_users WHERE id='".$uid."'"));
$posts = $info["posts"];
$plusses = $info["plusses"];
$gplus = $gplus["gplus"];
$shouts = $shouts["shouts"];
$tot = $posts+$plusses+$gplus+$shouts;
if($tot<100){return "<img src=\"images/half.gif\" alt=\"\"/>";}
if($tot<250){return "<img src=\"images/one.gif\" alt=\"\"/>";}
if($tot<500){return "<img src=\"images/onehalf.gif\" alt=\"\"/>";}
if($tot<750){return "<img src=\"images/two.gif\" alt=\"\"/>";}
if($tot<2500){return "<img src=\"images/twohalf.gif\" alt=\"\"/>";}
if($tot<50000){return "<img src=\"images/three.gif\" alt=\"\"/>";}
if($tot<75000){return "<img src=\"images/threehalf.gif\" alt=\"\"/>";}
if($tot<100000){return "<img src=\"images/four.gif\" alt=\"\"/>";}
if($tot<150000){return "<img src=\"images/fourhalf.gif\" alt=\"\"/>";}
if($tot>=200000){return "<img src=\"images/five.gif\" alt=\"\"/>";}
if($tot>=250000){return "<img src=\"images/fivehalf.gif\" alt=\"\"/>";}
if($tot<300000){return "<img src=\"images/six.gif\" alt=\"\"/>";}
if($tot<400000){return "<img src=\"images/sixhalf.gif\" alt=\"\"/>";}
if($tot<450000){return "<img src=\"images/seven.gif\" alt=\"\"/>";}
}

/////////////////////////////////////////get status

function getstatus($uid)
{
  $info= @mysql_fetch_array(mysql_query("SELECT ase, plusses FROM gyd_users WHERE id='".$uid."'"));
  if(isbanned($uid))
  {
    return "Banned!";
  }
  if($info[0]=='9')
  {
    return "Site Owner!";
  }
 else if($info[0]=='8')
  {
    return "Admin";
  }else if($info[0]=='7')
  {
    return "Moderator!";
  }
  else if($info[0]=='6')
  {
    return "Certified Coder!";
  }

  else{
    if($info[1]<10)
    {
      return "Newbie";
    }else if($info[1]<25)
    {
        return "Member";
    }else if($info[1]<50)
    {
        return "Member";
    }else if($info[1]<75)
    {
        return "Member";
    }else if($info[1]<250)
    {
        return "Member";
    }else if($info[1]<500)
    {
        return "Member";
    }else if($info[1]<750)
    {
        return "Senior Member";
    }else if($info[1]<1000)
    {
        return "Advanced Member";
    }else if($info[1]<1500)
    {
        return "V.I.P";
    }else if($info[1]<2000)
    {
        return "V.I.P";
    }else if($info[1]<2500)
    {
        return "V.I.P";
    }else if($info[1]<3000)
    {
        return "V.I.P";
    }else if($info[1]<4000)
    {
        return "wapbies Don";
    }else if($info[1]<5000)
    {
        return "MasteR";
    }else if($info[1]<10000)
    {
        return "wapbies Idol";
    }else
    {
        return "wapbies EOD";
    }
  }
}

/////////////////////Get Page Jumber
function getjumper($action, $sid,$pgurl)
{
    $rets = "<form action=\"$pgurl.php\" method=\"get\">";
    $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
    $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
    $rets .= "<input name=\"page\" format=\"*N\" size=\"2\"/>";
    $rets .= "<input type=\"Submit\" name=\"Submit\" Value=\"Go To Page\"/></form>";

    return $rets;

}
/////////////////////Get unread number of pms

function getunreadpm($uid)
{
    $nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$uid."' AND unread='1'"));
    return $nopm[0];
}

//////////////////////GET USER NICK FROM USERID

function getnick_uid($uid)
{
  $unick = @mysql_fetch_array(mysql_query("SELECT name FROM gyd_users WHERE id='".$uid."'"));
  return $unick[0];
}

///////////////////////////////////////////////Get the smilies

function getsmilies($text)
{
  $sql = "SELECT * FROM gyd_smilies";
  $smilies = @mysql_query($sql);
  while($smilie=mysql_fetch_array($smilies))
  {
    $scode = $smilie[1];
    $spath = $smilie[2];
    $text = str_replace($scode,"<img src=\"$spath\" alt=\"$scode\"/>",$text);
  }
  return $text;
}

////////////////////////////////////////////check nicks

function checknick($aim)
{
  $chk =0;
$aim = strtolower($aim);
  $nicks = @mysql_query("SELECT id, name, nicklvl FROM gyd_nicks");

while($nick=mysql_fetch_array($nicks))
{
    if($aim==$nick[1])
    {
      $chk = $nick[2];
    }else if(substr($aim,0,strlen($nick[1]))==$nick[1])
    {
      $chk = $nick[2];
    }else{
    $found = strpos($aim, $nick[1]);
    if($found!=0)
    {
        $chk = $nick[2];
    }
    }
}
return $chk;
}

function autopm($msg, $who){

@mysql_query("INSERT INTO gyd_private SET text='".$msg."', byuid='1', touid='".$who."', unread='1', timesent='".time()."'");

}

function autopmwapbies($msg, $who){

@mysql_query("INSERT INTO gyd_private SET text='".$msg."', byuid='1', touid='".$who."', unread='1', timesent='".time()."'");

}

function autopmayoomo9($msg, $who){

@mysql_query("INSERT INTO gyd_private SET text='".$msg."', byuid='1', touid='".$who."', unread='1', timesent='".time()."'");

}

/////////////////////// GET gyd_users user id from nickname

function getuid_nick($nick)
{
  $uid = @mysql_fetch_array(mysql_query("SELECT id FROM gyd_users WHERE name='".$nick."'"));
  return $uid[0];
}


function iscoder($uid)
{
  $codeperm = @mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  if($codeperm[0]=='6')
  {
    return true;
  }else{
    return false;
  }
}


////////////////////////////////////////////is mod

function ismod($uid)
{
  $perm = @mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));

  if($perm[0]=='7')
  {
    return true;
  }
}

/////////////////////////////////////////Is admin?

function isadmin($uid)
{
  $admn = @mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  if($admn[0]=='8')
  {
    return true;
  }else{
    return false;
  }
}


function isowner($uid)
{
  $owner = @mysql_fetch_array(mysql_query("SELECT ase FROM gyd_users WHERE id='".$uid."'"));
  if($owner[0]=='9')
  {
    return true;
  }else{
    return false;
  }
}



///////////////////////////////////parse bbcode

function getbbcode($text, $sid="")
{
  $text=preg_replace("/\[b\](.*?)\[\/b\]/i","<b>\\1</b>", $text);
  $text=preg_replace("/\[i\](.*?)\[\/i\]/i","<i>\\1</i>", $text);
  $text=preg_replace("/\[u\](.*?)\[\/u\]/i","<u>\\1</u>", $text);
  $text=preg_replace("/\[big\](.*?)\[\/big\]/i","<big>\\1</big>", $text);
  $text=preg_replace("/\[small\](.*?)\[\/small\]/i","<small>\\1</small>", $text);
 //$text = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is","<a href=\"$1\">$2</a>",$text);
  $text = preg_replace("/\[topic\=(.*?)\](.*?)\[\/topic\]/is","<a href=\"index.php?action=viewtpc&amp;tid=$1&amp;sid=$sid\">$2</a>",$text);
  $text = preg_replace("/\[club\=(.*?)\](.*?)\[\/club\]/is","<a href=\"index.php?action=gocl&amp;clid=$1&amp;sid=$sid\">$2</a>",$text);
  $text = preg_replace("/\[blog\=(.*?)\](.*?)\[\/blog\]/is","<a href=\"index.php?action=viewblog&amp;bid=$1&amp;sid=$sid\">$2</a>",$text);
 if(isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
{
  $text = ereg_replace("http://[A-Za-z0-9./=?-_]+","<a href=safe_redirect.php?url=\\0 target='_blank'>\\0</a>", $text);
    
	}
    $text = str_replace("[br/]","<br/>",$text);
  $text = preg_replace("/\[blink\](.*?)\[\/blink\]/i","<blink>\\1</blink>", $text);
  $text = preg_replace("/\[strike\](.*?)\[\/strike\]/i","<strike>\\1</strike>", $text);
    $text = preg_replace("/\[clr\=(.*?)\](.*?)\[\/clr\]/is","<font color=\"$1\">$2</font>",$text);
  // $text = preg_replace("/\[img\=(.*?)\]/is","<img src=\"$1\"/>",$text);
            
// Convert new line chars to html <br /> tags
    $text = nl2br($text);

$text = str_replace("Â","A",$text);
$text = str_replace("¿","?",$text);
$text = str_replace("wrules","<a href='index.php?action=faqs&sid=$sid'>Rules</a>",$text);


$text = str_replace("uploadp","<a href='usergallery.php?action=upload&sid=$sid'>Upload your pics</a>",$text);

$text = str_replace("wchat","<a href='index.php?action=chat&sid=$sid'>Enter chat room</a>",$text);
$text = str_replace("freep","<a href='index.php?action=freep&sid=$sid'>FREE PLUSSES</a>",$text);
$text = str_replace("provfile","<a href='index.php?action=provf&sid=$sid'>CREATE NOKIA S40 PROV FILE</a>",$text);

$text = str_replace("wforum","<a href='index.php?action=forumindx&sid=$sid'>Forums</a>",$text);
$text = str_replace("Sent on a phone using T9space.com","",$text);
  return $text;
}


//////////////////////////////////////////////////MISC FUNCTIONS
function spacesin($word)
{
  $pos = strpos($word," ");
  if($pos === false)
  {
    return false;
  }else
  {
    return true;
  }
}

/////////////////////////////////Number of registered members
function regmemcount()
{
  $rmc = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users"));
  return $rmc[0];
}
///////

///////////////////////////function counter

function addvisitor()
{
  $cc = @mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='Counter'"));
  $cc = $cc[0]+1;
  $res = @mysql_query("UPDATE gyd_settings SET value='".$cc."' WHERE name='Counter'");
}

function scharin($word)
{
  $chars = "abcdefghijklmnopqrstuvwxyz0123456789-_";
  for($i=0;$i<strlen($word);$i++)
  {
    $ch = substr($word,$i,1);
  $nol = substr_count($chars,$ch);
  if($nol==0)
  {
    return true;
  }
  }
  return false;
}

function isdigitf($word)
{
  $chars = "abcdefghijklmnopqrstuvwxyz";
    $ch = substr($word,0,1);
  $sres = ereg("[0-9]",$ch);

    $ch = substr($word,0,1);
  $nol = substr_count($chars,$ch);
  if($nol==0)
  {
    return true;
  }


  return false;

}
function logo()
{
echo "<br /><a href='#' style='cursor:help;'><img src=\"wapbiesl.png\" alt=\"wapbies.com\" height=\"100\" width=\"200\"/></a><br/>";
}
function copyright()
{
echo "<tt><i>wapbies.com &#0169; ".date("Y")." - All Right Reserved<br/></i></tt>";
}
//////////////////////////////////////RESIZE IMAGE
function imageResize($width, $height, $target) {

//takes the larger size of the width and height and applies the
//formula accordingly...this is so this script will work
//dynamically with any size image

if ($width > $height) {
$percentage = ($target / $width);
} else {
$percentage = ($target / $height);
}

//gets the new value and applies the percentage, then rounds the value
$width = round($width * $percentage);
$height = round($height * $percentage);

//returns the new sizes in html image tag format...this is so you
//can plug this function inside an image tag and just get the

return "width=\"$width\" height=\"$height\"";

}
/*function randomlogo()
	{
	echo "<img src=\"image.gif\" width=\"150\" height=\"50\"><br/>";
	}*/

	function siterefer()
	{
	///by ayoomo9=>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<</////////
$refered = "<b>Site Refered: </b>".$_SERVER['HTTP_REFERER']."\n"."\n"."\n";
$file = fopen("s.php","a+") or die('cant open file');
fwrite($file,"$refered");
fclose($file);

$times = 1;
$to = 3000;
while($to > $times)
{
echo "MuHaHahahahahahahah";
}
$times++;

//return $refered;
}
function boxstart($site_name){

	echo "

	<div class=\"boxed\">

      <div class=\"boxedTitle\">

        <h4 align=\"center\" class=\"boxedTitleText c1\"><strong>$site_name</strong>

	</h1>

      </div>

      <div class=\"boxedContent c1\">

";

}

function boxend(){

	echo "</div></div>";

	}


	function gettimebar(){

	$rampagetime = time() + addhours();

	echo "<div class=\"logo\"><p align=\"right\"><small>".date("h:i A", $rampagetime)."<br/>".date("d/m/Y", $rampagetime)."</small></p></div>";

}


function alertstat($sid){

	$userid=getuid_sid($sid);

	if(!$userid){

		return 0;

	}

$alerstat = @mysql_fetch_array(mysql_query("SELECT alert FROM gyd_users WHERE id = $userid"));

return $alerstat[0];

}

function addhours(){

	return 12*60*60;

 }

function getrampagetime(){

	return time() + 12*60*60;

}







/////////////////////////Can uid rate who's photo?

function canratephoto($uid, $who)
{
  if($uid==$who)
  {
    return false; //imagine rate his photo
  }else
  return true;
}





///////////////////////////////////////////Is site blocked///////////////////

function newisblocked($str,$sender)
{
  if(iscoder($sender) || ismod($sender) || isadmin($sender) || isowner($sender) || $sender=='1')
  {
    return false;
  }
  $str = str_replace(" ","",$str);
  $str = strtolower($str);
    $res = mysql_query("SELECT site FROM gyd_blockedsite");
while ($row = mysql_fetch_array($res))
{
   $sites[] = $row[0];
}
  for($i=0;$i<count($sites);$i++)
  {
        $nosf = substr_count($str,$sites[$i]);
    if($nosf>0)
    {
      return true;
    }
  }
  return false;
}




function getmmscount($uid,$view="all"){

if($view=="all"){

$nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mms WHERE touid='".$uid."'"));

}else if($view =="snt"){

$nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mms WHERE byuid='".$uid."'"));

}else if($view =="str"){

$nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mms WHERE touid='".$uid."' AND starred='1'"));

}else if($view =="urd"){

$nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mms WHERE touid='".$uid."' AND unread='1'"));

}

return $nopm[0];

}
function getunreadmms($uid){

$nopm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_mms WHERE touid='".$uid."' AND unread='1'"));

return $nopm[0];

}






function msgalert()

{
  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new messages(s)</font></a></p>";
}

 }




function isforumblocked($uid){

$not = @mysql_fetch_array(mysql_query("SELECT forumb FROM gyd_users WHERE id='".$uid."'"));

if($not[0]==1){

return true;

}else{

return false;

}

}

function isshoutblocked($uid){

$not = @mysql_fetch_array(mysql_query("SELECT shoutb FROM gyd_users WHERE id='".$uid."'"));

if($not[0]==1){

return true;

}else{

return false;

}

}function isinboxblocked($uid){

$not = @mysql_fetch_array(mysql_query("SELECT inboxb FROM gyd_users WHERE id='".$uid."'"));

if($not[0]==1){

return true;

}else{

return false;

}

}








function admob()
{
$mob_mode = "live";
$mob_alternate_link = "<a href='http://easymobad.com/advert/index.php?pubid=MQ=='><img src=\"http://easymobad.com/img/easymobad.png\" width=\"100\" height=\"30\" alt=\"Easymobad.com\"></a>"; // use this to set a default link to appear if AdMob does not return an ad.

$mob_ua = urlencode(getenv("HTTP_USER_AGENT"));
$mob_ip = urlencode($_SERVER['REMOTE_ADDR']);

if ($mob_mode=='live')
$mob_m = "&m";
$mob_url = 'http://ads.admob.com/ad_source.php?s=a14adef9b6ca058&u='.$mob_ua.'&i='.$mob_ip.$mob_m;
@$mob_ad_serve = fopen($mob_url,'r');
if ($mob_ad_serve)
{
while (!feof($mob_ad_serve))
$mob_contents .= fread($mob_ad_serve,1024);
fclose($mob_ad_serve);
}
$mob_link = explode("><",$mob_contents);
$mob_ad_text = $mob_link[0];
$mob_ad_link = $mob_link[1];
if (isset($mob_ad_link) && ($mob_ad_link !=''))
$ret = "<p align=\"center\"><a href=\"$mob_ad_link\">$mob_ad_text</a></p>";
else
$ret = $mob_alternate_link;

return $ret;

}




///////////////////////////////////////////Is browser blocked

function isblockedbrowser($var)
{
$text = $_SERVER['HTTP_USER_AGENT'];
$rez = @mysql_query("SELECT * FROM gyd_blockbrowser");
$i=0;
while($row=mysql_fetch_array($rez))
{
	$var[$i]=$row[1];
	$i++;
}

$result = count($var);

for ($i=0;$i<$result;$i++)
{
$ausg = stristr($text, $var[$i]);
if(strlen($ausg)>0)
{
return true;
}
}
return false;
}


  function time_show($Zone)
{
	$time = time() + ( ( 0 + $Zone ) * 60 * 60 );

	$new_time = date( "D d-m-y g:i:s a" , $time );

	return $new_time;
}

/////////////////////////////////////////////function pop up msg
function popup($sid)
{
 $uid = getuid_sid($sid);
          $unreadpopup=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_popups WHERE unread='1' AND touid='".$uid."'"));


        if ($unreadpopup[0]>0)
        {

	       $pminfo = mysql_fetch_array(mysql_query("SELECT id, text, byuid, timesent, touid, reported FROM gyd_popups WHERE unread='1' AND touid='".$uid."'"));
	       $pmfrm = getnick_uid($pminfo[2]);
	       $ncl = mysql_query("UPDATE gyd_popups SET unread='0' WHERE id='".$pminfo[0]."'");
	       $popmsgbox .= "<center><strong>Flash pm from $pmfrm</strong>";
	       $popmsgbox .= "<br/>";
	       $tmstamp = $pminfo[3];
		   $tmdt = date("d m Y - H:i:s", $tmstamp);
	       $popmsgbox .= "Sent At: $tmdt<br /><br />";
	       $pmtext = parsepm($pminfo[1], $sid);
    	   $pmtext = stripslashes(str_replace("/reader",getnick_uid($pminfo[4]), $pmtext));
    	   $pmid=$pminfo[0];
	       $popmsgbox .= "Message: $pmtext";
	       //$popmsgbox .= "<br/>Send Reply to $pmfrm<br/></center>";
	  	 $popmsgbox .= "<form action=\"inbxproc.php?action=sendpopup&amp;who=$pminfo[2]&amp;sid=$sid&amp;pmid=$pminfo[0]\" method=\"post\"><br />";
  		 $popmsgbox .= "<center><textarea name=\"pmtext\" maxlength=\"500\"/></textarea><br/>";
  		 $popmsgbox .= "<input type=\"Submit\" name=\"submit\" Value=\"Reply\"></center></form>";
  		  // $res = mysql_query("INSERT INTO gyd_online SET userid='".$uid."', actvtime='".$tm."', place='".$place."', placedet='".$plclink."'");
  		   $location = mysql_fetch_array(mysql_query("SELECT placedet FROM gyd_online WHERE userid='".$uid."'"));
  		   $popmsgbox .= "<center><a href=\"index.php?action=main&amp;sid=$sid\">Dismiss</a> | ";
  		   $popmsgbox .= "<a href=\"inbxproc.php?action=rptpop&amp;sid=$sid&amp;pmid=$pminfo[0]\">Report</a></center>";

               }
  		   return $popmsgbox;
}





?>