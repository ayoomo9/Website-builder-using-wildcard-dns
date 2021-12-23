
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
?>


<?php
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_injection();
check_query();
check_browser();

check_method();
$bcon = connectdb();
if (!$bcon)
{
    $pstyle = gettheme1("1");
    echo xhtmlhead("wapbies (ERROR!)",$pstyle);
    echo "<p align=\"center\">";
    echo "<img src=\"images/exit.gif\" alt=\"*\"/><br/>";
    echo "ERROR! cannot connect to database<br/><br/>";
    echo "This error happens usually when backing up the database, please be patient, The site will be up any minute<br/><br/>";
    echo "<b>THANK YOU VERY MUCH</b>";
    echo "</p>";
  echo xhtmlfoot();
      exit();
}
if(isset($_GET['action']))
      {
$action = $_GET["action"];
}
if(isset($_GET['sid']))
      {
$sid = $_GET["sid"];
}
$uid = getuid_sid($sid);
if((islogged($sid)==false)||($uid==0))
    {
      $pstyle = gettheme($sid);
      echo xhtmlhead("wapbies",$pstyle);
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
  echo xhtmlfoot();
      exit();
    }
if(isbanned($uid))
    {
      $pstyle = gettheme($sid);
      echo xhtmlhead("wapbies",$pstyle);
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
  echo xhtmlfoot();
      exit();
    }else

//////////////////////////////////Mix A Buddy 

if($action=="mixabud") 
{ 
    addonline(getuid_sid($sid),"Mix A Buddy",""); 
    $view = $_GET["view"]; 
    if($view=="")$view="date"; 
    $pstyle = gettheme($sid);
    echo xhtmlhead("Mix A Buddy",$pstyle);
    echo "<p align=\"center\">"; 
    echo "<img src=\"images/group.gif\" alt=\"*\"/><br/>";
    echo "Here You Go Mate, This Could Be Your New Buddy/Friend! Give Him/Her A Try, Or If You Dont Think This Buddy Is Right For You, Then Feel Free To Try Again -ENJOY-!<br/>";
echo "<a href=\"ga.php?action=mixabud&amp;sid=$sid\">Try Again!</a>"; 
    echo "</p>"; 
    //////ALL LISTS SCRIPT << 

    //changable sql 
    $sql = "SELECT id, name, regdate FROM gyd_users ORDER BY RAND() LIMIT 1";
    echo "<p>"; 
    $items = mysql_query($sql); 
    
    if(mysql_num_rows($items)>0) 
    { 
    while ($item = mysql_fetch_array($items)) 
    { 
      $jdt = date("d-m-y", $item[2]); 
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> 

joined: $jdt"; 
      echo "$lnk<br/>";
      echo "If You Like The Above User/Buddy, Check His/Her Profile And See If He/She Could Become Your New Buddy/Friend!<br/>"; 
    } 
    } 
    echo "</p>"; 
  ////// UNTILL HERE >> 
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else

//////////////////////////////////Mix A Buddy Guy

if($action=="mixabudguy") 
{ 
    addonline(getuid_sid($sid),"Mix A Buddy",""); 
    $view = $_GET["view"]; 
    if($view=="")$view="date"; 
    $pstyle = gettheme($sid);
    echo xhtmlhead("Mix A Buddy",$pstyle);
    echo "<p align=\"center\">"; 
    echo "<img src=\"images/group.gif\" alt=\"*\"/><br/>";
    echo "Here You Go Mate, This Could Be Your New Buddy/Friend! Give Him A Try, Or If You Dont Think This Buddy Is Right For You, Then Feel Free To Try Again -ENJOY-!</small><br/>";
echo "<a href=\"ga.php?action=mixabudguy&amp;sid=$sid\">Try Again!</a>"; 
    echo "</p>"; 
    //////ALL LISTS SCRIPT << 

    //changable sql 
    $sql = "SELECT id, name, regdate FROM gyd_users WHERE sex='M' ORDER BY 

RAND() LIMIT 1";

    echo "<p>"; 
    $items = mysql_query($sql); 
    
    if(mysql_num_rows($items)>0) 
    { 
    while ($item = mysql_fetch_array($items)) 
    { 
      $jdt = date("d-m-y", $item[2]); 
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> 

joined: $jdt"; 
      echo "$lnk<br/>";
      echo "If You Like The Above User/Buddy, Check His Profile And See If He Could Become Your New Buddy/Friend!<br/>"; 
    } 
    } 
    echo "</p>"; 
  ////// UNTILL HERE >> 
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Fun Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else

//////////////////////////////////Mix A Buddy Girl

if($action=="mixabudgirl") 
{ 
    addonline(getuid_sid($sid),"Mix A Buddy",""); 
    $view = $_GET["view"]; 
    if($view=="")$view="date"; 
    $pstyle = gettheme($sid);
    echo xhtmlhead("Mix A Buddy",$pstyle); 
    echo "<p align=\"center\">"; 
    echo "<img src=\"images/group.gif\" alt=\"*\"/><br/>";
    echo "Here You Go Mate, This Could Be Your New Buddy/Friend! Give Her A Try, Or If You Dont Think This Buddy Is Right For You, Then Feel Free To Try Again -ENJOY-!<br/>";
echo "<a href=\"ga.php?action=mixabudgirl&amp;sid=$sid\">Try Again!</a>"; 
    echo "</p>"; 
    //////ALL LISTS SCRIPT << 

    //changable sql 
    $sql = "SELECT id, name, regdate FROM gyd_users WHERE sex='F' ORDER BY RAND() LIMIT 1";

    echo "<p>"; 
    $items = mysql_query($sql); 
    
    if(mysql_num_rows($items)>0) 
    { 
    while ($item = mysql_fetch_array($items)) 
    { 
      $jdt = date("d-m-y", $item[2]); 
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[0]&amp;sid=$sid\">$item[1]</a> 

joined: $jdt"; 
      echo "$lnk<br/>";
      echo "If You Like The Above User/Buddy, Check Her Profile And See If She Could Become Your New Buddy/Friend!<br/>"; 
    } 
    } 
    echo "</p>"; 
  ////// UNTILL HERE >> 
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else
    
/////////////////////////////////////////////////CASINO/////////////////////////////////////////   
if($action=="casinoi")
{   
    addonline(getuid_sid($sid),"Playing Casino","");
    $view = $_GET["view"];
    if($view=="")$view="date";
    $pstyle = gettheme($sid);
    echo xhtmlhead("Casino",$pstyle);
    echo "<p align=\"center\">";
    echo "<img src=\"images/roll.gif\" alt=\"*\"/><br/>";
    echo "Play our slots game to win some great prizes! Very fun game!";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

        echo "<p align=\"center\">";
    echo "<a href=\"ga.php?action=casino&amp;sid=$sid\">&#187;Start spinning Slots</a><br/>";
    echo "</p>";
      ////// UNTILL HERE >>
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}
/////////////////////////////////////////////////END OF CASINO/////////////////////////////////////////
else if($action=="casino")
{
    addonline(getuid_sid($sid),"Playing Casino","");
    $view = $_GET["view"];
    if($view=="")$view="date";
    $pstyle = gettheme($sid);
    echo xhtmlhead("Casino",$pstyle);
    echo "<p align=\"center\">";
        
    //////ALL LISTS SCRIPT <<
 
$num1 = rand(1, 9);
$num2 = rand(1, 9);
$num3 = rand(1, 9);
echo "<img src=\"images/casino.gif\" alt=\"*\"/><br/>";
echo "<b><u>These Are Your Cards:</u></b><br/>";
echo "<b>[$num1][$num2][$num3]</b><br/>";
$messege = "<b>Sorry, you lose!</b>";
if ($num1 == 7 and $num2 == 7 and $num3 == 7) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(10, 30);
  $ugpl = $gpl + $ugpl[0];
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Won $gpl Credits";
}
if ($num1 == 1 and $num2 == 1 and $num3 == 1) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(10, 30);
  $ugpl = $gpl + $ugpl[0];
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Won $gpl Credits";
}
if ($num1 == 3 and $num3 == 3) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(1, 10);
  $ugpl = $gpl + $ugpl[0];
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Won $gpl Credits";
}
if ($num2 == 5 and $num1 == 5) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(1, 10);
  $ugpl = $gpl + $ugpl[0];
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Won $gpl Credits";
}
if ($num1 == 6 and $num3 == 5) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(1, 5);
  $ugpl = $ugpl[0] - $gpl;
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Lost $gpl Credits";
}
if ($num2 == 9 and $num1 == 5) {
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $gpl = rand(1, 5);
  $ugpl = $ugpl[0] - $gpl;
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
  $messege = "*You Have Just Lost $gpl Credits";
}

echo "$messege";

echo "<br/><b><a href=\"ga.php?action=casino&amp;sid=$sid\">Spin The Wheel!</a></b>";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}
/////////////////////////////////////////////////END OF CASINO/////////////////////////////////////////

//////////////////////////////////LOTTO////////////BY ayoomo9 2009////////

else if($action=="lottoi")
{
    addonline(getuid_sid($sid),"Playing wapbies lotto","");
    $pstyle = gettheme($sid);
    echo xhtmlhead("Methos Lotto",$pstyle);
    echo "<p align=\"center\">";
    echo "<b>wapbies Lotto Draw</b><br/><small>Wanna become a wapbies millionaire? Really? Really,really? Then this game should keep you busy and entertained for HOURS! Win the lotto and be known as a millionaire here!</small><br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<
 echo "<p align=\"center\">";

 echo "<br/><a href=\"ga.php?action=lotto&amp;sid=$sid\">";
 echo "QuickPick</a><br/>";
 echo "Quickpick Price: 2 Credits<br/><br/>";
  echo "<a href=\"ga.php?action=lottop&amp;sid=$sid\">";
 echo "Millionaires rewards</a><br/>";
   echo "</p>";

   
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}

//////////////////////////////////LOTTO////////////BY AYOOMO9 2009////////

else if($action=="lotto")
{
    addonline(getuid_sid($sid),"Playing wapbies lotto","");
    $pstyle = gettheme($sid);
    echo xhtmlhead("wapbies Lotto",$pstyle);
    echo "<p align=\"center\">";
  
    echo "<b>wapbiesLotto Draw</b><br/>Heres the lucky draw =D<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<
echo "<p align=\"center\">";
 if(getplusses(getuid_sid($sid))<10)
    {
        echo "You should have at least 10 Credits to play this game!";
    }else{
echo "<u>These are the winning lotto numbers</u><br/>";
 echo "<b>(2)(9)(18)(30)(38)(42)</b><br/>";
   echo "<u>These are your numbers</u><br/>";
$xfile = @file("lotto.txt");
$random_num = rand (0,count($xfile)-1);
$udata = explode("::",$xfile[$random_num]);
echo $udata[1];
}
  $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
  $ugpl = $ugpl[0] - 2;
  mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
echo "<br/><a href=\"ga.php?action=lotto&amp;sid=$sid\">";
echo "another quickpick</a><br/>";
   echo "</p>";

  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}


else if($action=="lottow")
{
    addonline(getuid_sid($sid),"Playing wapbies lotto","");
    $pstyle = gettheme($sid);
    echo xhtmlhead("wapbies Lotto",$pstyle);
    echo "<p align=\"center\">";
    echo "<b>wapbies Lotto Draw</b><br/>This is the secret code that you must inbox WAPBIES in order to become a wapbies millionaire!<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<
echo "<p align=\"center\">";
 if(getplusses(getuid_sid($sid))<10)
    {
        echo "You should have at least 10 credits to play this game!";
    }else{
  $xfile = @file("lottowin.txt");
  echo $udata[1];
   }
   
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Fun Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
    echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}


else if($action=="lottop")
{
    addonline(getuid_sid($sid),"Playing wapbies lotto","");
    $pstyle = gettheme($sid);
    echo xhtmlhead("wapbies Lotto",$pstyle);
    echo "<p align=\"center\">";
  
    echo "<b>wapbies Lotto Draw</b><br/>Millionares get:<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<


   echo "*300 plusses<br/>";
   echo "*their status changes to wapbies millionaire<br/>";
    echo "*your name will be up in site stats as one of the lotto winners<br/>";
    echo "*you will also be added to out V.I.P list<br/>";
    

   
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    echo "<a href=\"index.php?action=funm&amp;sid=$sid\"><img src=\"images/roll.gif\" alt=\"*\"/>";
echo "</a>Games Menu<br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else
//////////////////////////////////LOTTO////////////BY QUIKSILVER 2006 quiksilver@ranterswap.net////////
/////////////////////////////////////////////////FC/////////////////////////////////////////
if($action=="fci")
{
    addonline(getuid_sid($sid),"Playing Fortune Cookie","");
    $view = $_GET["view"];
    if($view=="")$view="date";
    $pstyle = gettheme($sid);
    echo xhtmlhead("Fortune Cookie",$pstyle);
    echo "<p align=\"center\">";
    echo "<img src=\"images/roll.gif\" alt=\"*\"/><br/>";
    echo "Hmmm... So  you have come to let the cookie tell you your fortune?! Well good luck!!!!";
    echo "</p>";
    //////ALL LISTS SCRIPT <<

        echo "<p align=\"center\">";
    echo "<a href=\"ga.php?action=fc&amp;sid=$sid\">&#187;Read Fortune Cookie</a><br/>";
    echo "</p>";
      ////// UNTILL HERE >>
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else
/////////////////////////////////////////////////FC/////////////////////////////////////////
if($action=="fc")
{
    addonline(getuid_sid($sid),"Playing Fortune Cookie","");
    $view = $_GET["view"];
    if($view=="")$view="date";
    $pstyle = gettheme($sid);
    echo xhtmlhead("Fortune Cookie",$pstyle);
    echo "<p align=\"center\">";
    echo "<b>The wapbies fortune cookie tells you:</b>";
    echo "</p>";
 //////ALL LISTS SCRIPT <<
echo "<p align=\"center\">";
$xfile = @file("fortune.txt");
$random_num = rand (0,count($xfile)-1);
$udata = explode("::",$xfile[$random_num]);
echo $udata[1];
 echo "<br/><a href=\"ga.php?action=fc&amp;sid=$sid\">Another Cookie</a>";
   echo "</p>";

   
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else
/////////////////////////////////////////////////END OF FC/////////////////////////////////////////


if($action=="guessgm")
{
    addonline(getuid_sid($sid),"Playing GTN","");
    $pstyle = gettheme($sid);
    echo xhtmlhead("Guess The Number",$pstyle);
    echo "<p align=\"center\">";
    $gid = $_POST["gid"];
    $un = $_POST["un"];

  if($gid=="")
  {
        mysql_query("DELETE FROM gyd_games WHERE uid='".$uid."'");
        mt_srand((double)micro(time() - $timeadjust)*1000000);
        $rn = mt_rand(1,100);
        mysql_query("INSERT INTO gyd_games SET uid='".$uid."', gvar1='8', gvar2='".$rn."'");
        $tries = 8;
        $gameid = mysql_fetch_array(mysql_query("SELECT id FROM gyd_games WHERE uid='".$uid."'"));
        $gid=$gameid[0];
  }else{
    $ginfo = mysql_fetch_array(mysql_query("SELECT gvar1,gvar2 FROM gyd_games WHERE id='".$gid."' AND uid='".$uid."'"));
    $tries = $ginfo[0]-1;
    mysql_query("UPDATE gyd_games SET gvar1='".$tries."' WHERE id='".$gid."'");
    $rn = $ginfo[1];
  }
  if ($tries>0)
                {
                $gmsg = "Just try to guess the number before you have no more tries, the number is between 1-100<br/><br/>";
                echo $gmsg;
                $tries = $tries-1;
                $gpl = $tries*3;
                echo "Tries:$tries, Credits:$gpl<br/><br/>";
                      if ($un==$rn){
                        $gpl = $gpl+3;
                        $ugpl = mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$uid."'"));
                        $ugpl = $gpl + $ugpl[0];
                        mysql_query("UPDATE gyd_users SET plusses='".$ugpl."' WHERE id='".$uid."'");
                        echo "Congratulations! the number was $rn, $gpl Credits has been added to your Credits, <a href=\"games.php?action=guessgm&amp;sid=$sid\">New Game</a><br/><br/>";
                      }else{
                        if($un <$rn)
                        {
                          echo "Try bigger number than $un !<br/><br/>";
                        }else{
                            echo "Try smaller number than $un !<br/><br/>";
                        }
echo "<form action=\"ga.php?action=guessgm&amp;sid=$sid\" method=\"post\">";
echo "Your Guess: <input type=\"text\" name=\"un\" format=\"*N\" size=\"3\" value=\"$un\"/>";
		
		echo "<input type=\"submit\" value=\"Try\"/>";
		echo "<input type=\"hidden\" name=\"gid\" value=\"$gid\"/>";
		echo "</form><br/>";
                      }


                }else{
                    $gmsg = "<small>GAME OVER, <a href=\"games.php?action=guessgm&amp;sid=$sid\">New Game</a></small><br/><br/>";
                    echo $gmsg;
                }
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
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
	
  echo xhtmlfoot();
}else{
    $pstyle = gettheme($sid);
    echo xhtmlhead("Lost in games menu",$pstyle);
  echo "<p align=\"center\">";
  echo "Page not found!<br/><br/>";
   echo "<br/><br/><a href=\"index.php?action=funm&amp;sid=$sid\">&#171;Back to Games Menu</a><br/>";
    echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
  echo "</p>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\">Home</a>";
	 echo " | ";
	 
   echo "<a href=\"index.php?action=search&amp;sid=$sid\">Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=uset&amp;sid=$sid\">Profile</a>";
  
echo " | ";
   echo "<a href=\"http://ads.admob.com/link_list.php?s=a14a608e389dc9c\">Links</a><br />";
      echo " | ";
  echo "<a href=\"index.php?action=stats&amp;sid=$sid\">Site Stats</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a><br /><br/></div>";
	
  echo xhtmlfoot();
}
?>