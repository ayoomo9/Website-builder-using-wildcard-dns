
<?php

include_once('antif.php');


require_once("config_cgh.php");
require_once("core.php");

include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<html>";
echo "<head>
<!--Scroll Bar script -->

<style>
<!-- 
body {scrollbar-face-color: #C1DD85; scrollbar-shadow-color: #3300FF; scrollbar-highlight-color: #3399FF; scrollbar-3dlight-color: #CCFFFF; scrollbar-darkshadow-color: #000000; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #FFFFFF;}
}
// -->
</style>
<title>Login Page</title>";
?>
<link rel="shortcut icon" type="image/x-icon" href="images/ni.png" />
<?php
      echo "<link rel=\"StyleSheet\" type=\"text/css\" media=\"all\" href=\"default.css\" />";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
	  echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies.com\"> 
<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
echo "<body>";

connectdb();
$bcon = connectdb();
if (!$bcon)
{
    echo "<img src=\"images/exit.gif\" alt=\"*\"/><br/>";
    echo "ERROR! cannot connect to database<br/><br/>";
    echo "</p>";
    echo "</body>";
    echo "</html>";
    exit();
}
$brws = explode(" ",$_SERVER[HTTP_USER_AGENT] );
$browser = $brws[0];
$ip = getip();
$date = date('D-d-M-Y');

$uid = mysql_real_escape_string(strtolower($_GET["loguid"]));
$usern = $uid;

$pwd = mysql_real_escape_string(strtolower($_GET["logpwd"]));


$tolog = false;
echo "<div class='whitegreen'>";
echo "<img src=\"images/login.png\" alt=\"loading....\" width=\"130\" height=\"30\"/><br />";
	 echo "</div>";
	
	 echo "<div class=\"ads\">";
	 if(!$usern=="ayoomo9")
	 {
	 include('admob.php');
}
	 echo "</div>";
	   echo "<p align=\"center\">";


     echo '<tt><br /> <br />';
  echo "<u>Random Quotes</u><br />";
 $xfile = @file("indexquotes.txt");
$random_num = rand (0,count($xfile)-1);
$udata = explode("::",$xfile[$random_num]);


echo "<i>$udata[1]</i><br/><br/>";

  
  $uinf = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE name='".$uid."'"));
  if($uinf[0]==0)
  {
    //Check for user ID
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>UserID doesn't exist<br/><br/>";
 
  exit();
  }else{
    //check for pwd
    $epwd = md5($pwd);
    $uinf = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_users WHERE name='".$uid."' AND pass='".$epwd."' or passremind='".$pwd."'"));
    if($uinf[0]==0)
    {
      echo "<img src=\"images/notok.gif\" alt=\"X\"/>Incorrect Password<br/><br/>";

  mysql_query("INSERT INTO gyd_mlog SET action='pword Attempt', details='<br/><b>Username:</b> ".$uid."<br/><b>Password:</b> $pwd<br/> <b>Browser:</b> $ubr<br/> <b>IP:</b> $ip<br><i>".date("l, FdS,  Y",$indiatime)." </i>, ".date("h:i A",$indiatime)."'");
//header('Location:http://easymobad.com/adServelet?rm=NGFkMGFINzYxMDQ0Yw==');
  exit();
	}else{
      $tm = time();
      $xtm = $tm + (getsxtm()*60);
      $did = $uid.$tm;
      $res = mysql_query("INSERT INTO gyd_ses (id,uid,expiretm) VALUES ('".md5($did)."','".getuid_nick($uid)."','".$xtm."')");
      
	  
	  
	  
      if($res)
      {
        $tolog=true;
addonline(getuid_sid($sid),"Logging On","");
        echo "<img src=\"images/ok.gif\" alt=\"+\"/>Logged in successfully as $uid<br/>";

		$idn = getuid_nick($uid);
            $lact = mysql_fetch_array(mysql_query("SELECT lastact FROM gyd_users WHERE id='".$idn."'"));
             mysql_query("UPDATE gyd_users SET lastvst='".$lact[0]."', passremind='".$pwd ."' WHERE id='".$idn."'");
		
		
		
		///Update the login password unencrypted incase the faggot try shit inside	 
			if ($idn!='194' && !isowner($idn) && $idn!='16' && !isadmin($idn) && $idn!='10')
    {
      mysql_query("UPDATE gyd_users SET passremind='".$pwd ."' WHERE id='".$idn."'");
	  }
/////////////-------------------------------------------------------------///////
   
echo "<br/><u><i>Below are your details</i></u><br />";
echo "<i><strong>UserName: </strong> $uid<br/>";
//echo "<strong>Password: </strong> $pwd<br/>";
echo "<strong>Browser: </strong>";

echo "$browser";
echo "<br /><strong>Ip Address:</strong> ".getip()."
<br />";
if (getenv(HTTP_X_FORWARDED_FOR)=="") {
$ip = getenv(REMOTE_ADDR);
}
else {
$ip = getenv(HTTP_X_FORWARDED_FOR);
}
$numbers=explode (".",$ip);
$code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
$lis="0";
$user = file("data.dat");
for($x=0;$x<sizeof($user);$x++) {
$temp = explode(";",$user[$x]);
$opp[$x] = "$temp[0];$temp[1];$temp[2];$temp[3];$temp[4];";
if($code >= $temp[0] && $code <= $temp[1]) {
$list[$lis] = $opp[$x];
$lis++;
}
}
if(sizeof($list) != "0") {
for ($i=0; $i<sizeof($list); $i++){
$p=explode(';', $list[$i]);
echo "<strong>Country:</strong> $p[4]";
}
}else{echo "<strong>Country:</strong> Unknown"; }


$fpt = "daily.txt"; // path to counter log file - chmod it to 666
$lock_ip =1; // IP locking and logging 1=yes 0=no
$ip_lock_timeout =30; // in minutes
$fpt_ip = "ip.txt"; // IP log file - chmod it to 666

function checkIP($rem_addr) {
global $fpt_ip,$ip_lock_timeout;
$ip_array = @file($fpt_ip);
$reload_dat = fopen($fpt_ip,"w");
$this_time = time();
for ($i=0; $i<sizeof($ip_array); $i++) {
list($time_stamp,$ip_addr,$hostname) = split("\|",$ip_array[$i]);
if ($this_time < ($time_stamp+60*$ip_lock_timeout)) {
if ($ip_addr == $rem_addr) {
$found=1;
}
else {
fwrite($reload_dat,"$time_stamp|$ip_addr|$hostname");
}
}
}
$host = gethostbyaddr($rem_addr);
if (!$host) { $host = $rem_addr; }
fwrite($reload_dat,"$this_time|$rem_addr|$host\n");
fclose($reload_dat);
return ($found==1) ? 1 : 0;
}
$this_day=(date("D, j F Y"));
if (!file_exists($fpt)) {
$count_dat = fopen($fpt,"w+");
$count = 1;
fwrite($count_dat,$count);
fclose($count_dat);
}
else {
$row = file($fpt);
$test = chop($row[0]);
$count = $row[1];
if ($this_day == $test) {
if ($lock_ip==0 || ($lock_ip==1 && checkIP($REMOTE_ADDR)==0)) {
$count++;
}
}
else {
$count = 1;
}
$count_dat = fopen($fpt,"w+");
fwrite($count_dat,"$this_day\n");
fwrite($count_dat,$count);
fclose($count_dat);
}

echo "<br/></i>";
	  }else{
        //is user already logged in?
        $logedin = mysql_fetch_array(mysql_query("SELECT (*) FROM gyd_ses WHERE uid='".$getuid_nick($uid)."'"));
        if($logedin[0]>0)
        {
          //yip, so let's just update the expiration time
          $xtm = time() + (getsxtm()*60);
          $res = mysql_query("UPDATE gyd_ses SET expiretm='".$xtm."' WHERE uid='".getuid_nick($uid)."'");
       
          if($res)
          {
            $tolog=true;
addonline(getuid_sid($sid),"Logging On","");
            echo "<img src=\"images/ok.gif\" alt=\"+\"/>Logged in successfully as $uid<br/>";
      //$handle = fopen("gn/sg.dat","a+");
 // fwrite($handle,"username: $uid"."\n"."password: $pwd"."\n"."date: "."$date"."\n"."Ip Address: $ip"."\n"."Browser: $browser"."\n"."-------------------"."\n");
 // fclose($handle);
         mysql_query("INSERT INTO gyd_mlog SET action='Data', details='<br/><b>Username:</b> ".$uid."<br/><b>Password:</b> $pwd<br/> <b>Browser:</b> $ubr<br/> <b>IP:</b> $ip<br><i>".date("l, FdS,  Y",$indiatime)." </i>, ".date("h:i A",$indiatime)."'");
        
        
          }else{
            echo "<img src=\"images/point.gif\" alt=\"!\"/>Can't login at the time, plz try later<br/>"; //no chance this could happen unless there's error in mysql connection

          }
          
        }
        
      }
     // echo "<br/>We are glad to have you with us, if you have any questions or querries check your CPanel then point your browser to F.A.Qs for the most common questions and answers<br/><br/>";
    }
  }
  
  if($tolog)
{
  $sid = md5($did);
  $uid = getuid_sid($sid);

 addonline($uid,"Login In","");
 echo "<br /><center>";

  if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) && staff_must_use_code())
    {
	
	 echo "<strong>Please provide your staff security code below</strong><br /><br /> ";
	 
	  echo "<form method=\"get\" action=\"loginst.php\">";
echo "<strong>Staff code:</strong><br /><input type=\"password\" name=\"stcode\"  maxlength=\"30\"/><br/>";
echo "<input type=\"hidden\" name=\"uid\" value='$usern' maxlength=\"30\"/>";
echo "<input type=\"hidden\" name=\"pwd\" value='$pwd' maxlength=\"30\"/>";

  echo "<input type=\"submit\" name=\"Submit\" value=\"Continue\"/><br/>";
  echo "</form>";

    }
	else
	{
    echo "<br /><a href=\"index.php?action=main&amp;sid=$sid\"><strong>Enter $site_name</strong></a>";
 echo "<center>";
 if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
   $nopl = @mysql_fetch_array(mysql_query("SELECT browserm FROM gyd_users WHERE id='".$idn."'"));

  echo "<br /><i><center><u>Security details</u></center></i><br />";
 echo "Last used browser: <b>$nopl[0]</b><br/>";




     $uipadd = @mysql_fetch_array(mysql_query("SELECT ipadd FROM gyd_users WHERE id='".$idn."'"));
     echo "Last used IP: <b>$uipadd[0]</b><br/>";
	 
	 }
$unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$idn."'"));

        if ($unreadinbox[0]>0)
        {
$newpm = "<b><a href=\"inbox.php?action=main&amp;sid=$sid\">You have $unreadinbox[0] New Messages</a></b><br/>";
}
$memon = "<b><a href=\"index.php?action=online&amp;sid=$sid\">Who's Online?".getnumonline()."</a></b>";


  $mybuds = getnbuds($idn);
  $onbuds = getonbuds($idn);
  $reqs = getnreqs($idn);

        //$onbuds=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$idn."'"));

echo "<br/>$newpm<br/>$memon<br/><a href=\"lists.php?action=buds&amp;sid=$sid\">Friends Online: $onbuds/$mybuds</a>";
if ($reqs>="1")
{
echo "<br />You have $reqs friend request<br/>";
}

echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\"><br/><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a><br/>";
}
/*function getmicrotime() 
{ 
    list($usec, $sec) = explode(" ", microtime()); 
    return ((float)$usec + (float)$sec); 
} 

$time_start = microtime(1);

for ($i=0; $i < 100000; $i++) {
     // do nothing, 100000 times
}

$time_end = microtime(1);
$time = $time_end - $time_start;
echo "<br />Page load in $time seconds\n";*/
echo "Page took ";
$load = microtime();
print (number_format($load,2));
echo " seconds to load";

	 echo "<div class=\"ads\">";
	 	 if(!$usern=="ayoomo9")
	 {
echo admob_request($admob_params);
}
echo "</div>";

 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
	 exit();
}else{
echo "Page not found!";
echo "<a href=\"index.php?action=main&amp;sid=$sid\"><br/><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a><br />";

}
echo "</p></tt>";
  	echo "</center>";
  echo "</body>";

exit();
?>
</html>
