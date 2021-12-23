
<?php

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
 include_once('header.php');


echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

	echo "<head>";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
	echo "<title>Staff Tools</title>";
	echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

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
if (!ismod(getuid_sid($sid)) && !iscoder(getuid_sid($sid)) && !isadmin(getuid_sid($sid)) && !isowner(getuid_sid($sid)))
	  {
    echo "<meta http-equiv=\"refresh\" content=\"4; URL=index.php\"/>";
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
       header('location:index.php');
      echo "<p align=\"center\">";
	      echo "<div class=\"ads\">";
  include("admob.php");
  echo "</div>";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
 echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      exit();
    }
	
	
	
	
	//addonline(getuid_sid($sid),"New Staff Cp","");
if($action=="main")
{
  $nick = getnick_sid($sid);
    echo "<p align=\"center\">";
    echo "<b>Staff Cp</b>";
	 echo "</p>";
 echo "<div class=\"ads\">";
 
  include('admob.php');
  echo "</div>";
  echo "<p align=\"center\">";
  echo "<em>Hello $nick, welcome to the new wapbies staff cp still under development by <strong>ayoomo9</strong>.</em>";
    echo "</p>";

     echo "<p>";
	 if (ismod(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
    $nrps = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE reported='1'"));
    echo "<a href=\"codercp.php?action=rps&amp;sid=$sid\">&#187;Posts($nrps[0])</a><br/>";
    $nrtp = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE reported='1'"));
    echo "<a href=\"codercp.php?action=rtp&amp;sid=$sid\">&#187;Topics($nrtp[0])</a>";
       echo "<br /><a href=\"codercp.php?action=delsht30&amp;sid=$sid\">&#187;Delete Old Shouts(30 days old)</a><br/>";
       echo "<a href=\"codercp.php?action=valtime&amp;sid=$sid\">&#187;Set registeration validation time</a><br/>";
	   
if(isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
{	            

				$check_code = mysql_fetch_array(mysql_query("SELECT staff_login_auth FROM tools"));
				 if($check_code[0]==0)
				 {
			  echo "<a href=\"codercp.php?action=staff_login_auth&amp;sid=$sid\">&#187;Enable Staff login verification</a><br/>";   
}
else
{
			  echo "<a href=\"codercp.php?action=dissable_staff_login_auth&amp;sid=$sid\">&#187;Dissable Staff login verification</a><br/>";   


}
}
    $check = mysql_fetch_array(mysql_query("SELECT use_time_wait FROM tools"));

   if($check[0]==0)
{   
	  echo "<a href=\"codercp.php?action=valon&amp;sid=$sid\">&#187;Activate Delay validation</a><br/>";   
          }
		  else
		  {
		  echo "<a href=\"codercp.php?action=valoff&amp;sid=$sid\">&#187;Disable Delay validation</a><br/>";   
}
echo "<a href=\"codercp.php?action=idlestaff&amp;sid=$sid\">&#187;Idle(inactive) staffs</a><br/>";   
$count_them = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE is_active='0'"));
echo "<a href=\"codercp.php?action=unvmembers&amp;sid=$sid\">&#187;Unvalidated New members($count_them[0])</a><br/>";   

   echo "</p>";
echo "<br/><form action=\"codercp.php?action=pm&amp;sid=$sid\" method=\"post\">";
  echo "<strong>Mass Message:</strong><br /><textarea name=\"pmtou\" cols='20' rows='4'/></textarea><br/>";
  echo "<strong>Destination:</strong><br /><select name=\"who\">";
  echo "<option value=\"staff\">All Staffs</option>";
    echo "<option value=\"admin\">Wapbies admins</option>";
	  echo "<option value=\"owner\">Wapbies owner</option>";
  echo "<option value=\"mods\">Moderators</option>";
  echo "</select><br/>";
  echo "<input type=\"submit\" value=\"Send messages\"/>";
  echo "</form>";
	}
		  echo "<p align=\"center\">";
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
else if($action=="unvmembers")
{
?>
<p align='center'>
<strong><u>Unvalidated members</u></strong><br /><br />
Member(s) listed below are probably new users and not yet validated.</p>
<?php

        echo "<br/>";
$q = mysql_query("SELECT * FROM gyd_users WHERE is_active='0'");
while($rows = mysql_fetch_array($q))
{
$n = $rows['name'];
$id = $rows['id'];

echo "<a href=\"index.php?action=viewuser&amp;who=$id&amp;sid=$sid\">$n</a> <a href='codercp.php?action=validate_member&amp;id=$id&amp;sid=$sid'>[Activate]</a><br />";
}
      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
	 
      echo "</body>";
	  echo "</html>";
}
///////////////////////////////////////////////Idle Staffs//////////////

else if($action=="idlestaff")
{
	    echo "<body>";
    echo "<p>";
  echo "<p align='center'><b><u>Idle Staff Members</u></b><br/><br />";
      $timeout = 180;
  $timeon = time()-$timeout;
    $timeout2 = 259200;
  $timeon2 = time()-$timeout2;
  $tdte = date("d m y-H:i:s", $timeon2);
  echo "Idle Date: $tdte,<br/><strong>Note:</strong> Only Staff Who have NOT been online after the above date are displayed below<br/><br/></p>";
  $nolq = mysql_query("SELECT * FROM gyd_users WHERE ase='6' OR ase='7' AND lastact<'".$timeon2."'");
  while ($row=mysql_fetch_array($nolq))
  {
	  echo "Username: <a href=\"index.php?action=viewuser&amp;who=$row[id]&amp;sid=$sid\">$row[name]</a>";
	  echo "<br/>";
	  $jdt = date("d m y-H:i:s",$row[lastact]);
	  echo "Last Online: $jdt <br/><br/>";
  }
 echo "<p align='center'>";
     echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
    echo "</p>";
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
	 
      echo "</body>";
	  echo "</html>";
  }
else if($action=="unvmembers")
{
?>
<p align='center'>
<strong><u>Unvalidated members</u></strong><br /><br />
Member(s) listed below are probably new users and not yet validated.</p>
<?php

        echo "<br/>";
$q = mysql_query("SELECT * FROM gyd_users WHERE is_active='0'");
while($rows = mysql_fetch_array($q))
{
$n = $rows['name'];
$id = $rows['id'];

echo "<a href=\"index.php?action=viewuser&amp;who=$id&amp;sid=$sid\">$n</a> <a href='codercp.php?action=validate_member&amp;id=$id&amp;sid=$sid'>[Activate]</a><br />";
}
      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
	 
      echo "</body>";
	  echo "</html>";
}
else if($action=="validate_member")
{
?>
<p align='center'>
<strong><u>Unvalidated members</u></strong><br /><br />
<?php
$id = $_GET['id'];
	  if(!is_numeric($id))
	  {
header('location:index.php');
exit;
	  }
        echo "<br/>";
$q = mysql_query("UPDATE gyd_users SET is_active='1' WHERE id='$id'");
if($q)
{
echo "Member activated successfully";

$pmtext="You user account is now validated(active), you can now enjoy all the nice features on wapbies.com without any limit. Thanks!";

autopmayoomo9($pmtext, $id);

}
else
{

echo "can not activate this member due to error";
}
      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
	 
      echo "</body>";
	  echo "</html>";
      exit();
}
else if($action=="valtime")
{
?>
<p align='center'>
<u><strong>Registeration tool</strong></u><br /><br />

Use this tool to set when you want a newly registered user to get validated automatically.<br />
Please note that the default is <strong>300</strong> seconds and it mustn't be below <strong>300</strong> seonds.</p><br />
<?php

if(isset($_POST['submit']))
{

$time = mysql_real_escape_string($_POST['time']);
if(empty($time))
{
echo "<font color='red'>Form field can not be empty.</font>";


}
elseif(!is_numeric($time))
{
echo "<font color='red'>What da fuck? put only numbers in the time field(form).</font>";


}
else
{
//mysql_query("INSERT INTO tools SET time_to_activate='$time'") or die("mysql_error");

$set = mysql_query("UPDATE tools SET time_to_activate='$time'") or die("Error: Cant update time, please contact ayoomo9");
if($set)
{

echo "<font color='red'><strong>SUCCESS</strong>:Validation time successfully set!</font>";

}
}
}


$do_query = mysql_fetch_array(mysql_query("SELECT time_to_activate FROM tools"));

?>
<br /><br />
<form method='POST' action='codercp.php?action=valtime&amp;sid=<?=$sid;?>'>
Time in secs<strong><small>(eg. 300)</small></strong><br />
<input type='text' name='time' value='<?php echo "$do_query[0]"; ?>' maxlength='3' />
<input type='submit' name='submit' value='Set time' />
</form>
<?php

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
else if($action=="dissable_staff_login_auth")
{

          echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("UPDATE tools SET staff_login_auth='0'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Secret code for login is now disabled!";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Cant update this!";
      }

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
else if($action=="staff_login_auth")
{

          echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("UPDATE tools SET staff_login_auth='1'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>All staffs except Moderator will now be prompt for a secret code before login!";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Cant update this!";
      }

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
else if($action=="valon")
{

          echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("UPDATE tools SET use_time_wait='1'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>New user validation enabled successfully!";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
else if($action=="valoff")
{

          echo "<p align=\"center\">";
        echo "<br/>";
        $res = mysql_query("UPDATE tools SET use_time_wait='0'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>New user validation disabled!";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
else if($action=="delsht30")
{

          echo "<p align=\"center\">";
        $altm = time()-(30*24*60*60);
        echo "<br/>";
        $res = mysql_query("DELETE FROM gyd_shouts WHERE shtime<'".$altm."'");

        if($res)
      {
        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Shouts Older Than 30 days(a month) were deleted";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Database Error!";
      }

      echo "<br /><br /><a href=\"codercp.php?action=main&amp;sid=$sid\">";
  echo "Staff cp</a><br/>";
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
/////////////GLOBAL PM PROCCESS////////////////////
else if($action=="pm")
{
addonline(getuid_sid($sid),"Just PM Staffs","");
 if (ismod(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {   
  $who = $_POST["who"];
  $pmtou = $_POST["pmtou"];
  $byuid = getuid_sid($sid);
  $tm = time();
if($who=="staff"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All Staffs has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase>5");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all staff[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
}
		
else if($who=="mods"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "All Moderators has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase='7'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all Moderators[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
  }
  else if($who=="owner"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "Owner has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase='9'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all Moderators[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
  }
   else if($who=="admin"){ 
  $lastpm = mysql_fetch_array(mysql_query("SELECT MAX(timesent) FROM gyd_private WHERE byuid='".$byuid."'"));
  echo "Admin has been sent a pm<br/>";
  $pms = mysql_query("SELECT id, name FROM gyd_users WHERE ase='8'");
  $tm = time();
  while($pm=mysql_fetch_array($pms))
  {
  mysql_query("INSERT INTO gyd_private SET text='[b]Public Anouncment:[/b][br/]".$pmtou."[br/][i]This message was sent to all Moderators[/i]', byuid='".$byuid."', touid='".$pm[0]."', timesent='".$tm."'");
  }
  }
echo "<p align='center'>";
      echo "<br/><a href=\"codercp.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"*\"/>";
  echo "Staff cp</a><br/></p>";
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
 exit();
}

}
/////////////////////////////////Reported Posts

else if($action=="rps")
{
addonline(getuid_sid($sid),"Reported post(staff cp)","");
  $page = $_GET["page"];
    
    echo "<p align=\"center\">";
    echo "<b>Reported Posts</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_posts WHERE reported ='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, text, tid, uid, dtpost FROM gyd_posts WHERE reported='1' ORDER BY dtpost DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      $poster = getnick_uid($item[3]);
      $tname = htmlspecialchars(gettname($item[3]));
      $dtop = date("d m y - H:i:s", $item[4]);
      $text = parsemsg($item[1]);
      $flk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$poster</a>";
      $tlk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[2]\">$tname</a>";
      echo "Poster: $flk<br/>In: $tlk<br/>Time: $dtop<br/>";
       echo $text;
       echo "<br/>";
       echo "<a href=\"codercpr.php?action=hps&amp;sid=$sid&amp;pid=$item[0]\">Handle</a><br/><br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"codercp.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"codercp.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
      $rets = "<form action=\"wmcp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        
        $rets .= "</form>";

        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"codercp.php?action=main&amp;sid=$sid\">";
echo "Staffs Logs</a><br/>";
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

/////////////////////////////////Reported Topics

else if($action=="rtp")
{
addonline(getuid_sid($sid),"Reported topics (Staff Cp)","");
  $page = $_GET["page"];
    
    echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
   echo admob();
  echo "</div>";
	echo "<br />";
    echo "<b>Reported Topics</b>";
    echo "</p>";
    echo "<p>";
    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_topics WHERE reported ='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, name, text, authorid, crdate FROM gyd_topics WHERE reported='1' ORDER BY crdate DESC LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    while ($item=mysql_fetch_array($items))
    {
      $poster = getnick_uid($item[3]);
      $tname = htmlspecialchars($item[1]);
      $dtop = date("d m y - H:i:s", $item[4]);
      $text = parsemsg($item[2]);
      $flk = "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$item[3]\">$poster</a>";
      $tlk = "<a href=\"index.php?action=viewtpc&amp;sid=$sid&amp;tid=$item[0]\">$tname</a>";
      echo "Poster: $flk<br/>In: $tlk<br/>Time: $dtop<br/>";
       echo $text;
       echo "<br/>";
       echo "<a href=\"codercpr.php?action=htp&amp;sid=$sid&amp;tid=$item[0]\">Handle</a><br/><br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"codercp.php?action=$action&amp;page=$ppage&amp;sid=$sid\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"codercp.php?action=$action&amp;page=$npage&amp;sid=$sid\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
$rets = "<form action=\"codercp.php\" method=\"get\">";
      $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        $rets .= "</form>";


        echo $rets;
    }
    echo "<br/><br/>";
    echo "<a href=\"codercp.php?action=main&amp;sid=$sid\">";
echo "Staffs Log</a>";
  echo "<div class=\"ads\">";
 echo admob();
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

//////////////////////////////////////Penalties Options

if($action=="penoptmbrdo")
  
{    

addonline(getuid_sid($sid),"Purnishing a naughty member(Coder cp)","");

   if (iscoder(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
	  if(isset($_GET['who']))
      {
  $who = $_GET["who"];
    }
		  $check = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE id='".$who."'"));
if($check[0]==0)
{
echo "<p align='center'>User can not be find. Its either the user id is deleted or something else.</p><br />";

     echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
echo admob_request($admob_params);
echo "</div>";
  echo "f<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
exit;
}
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
   echo admob();
  echo "</div>";
	echo "<br />";
    $unick = getnick_uid($who);
    echo "Select appropiate purnishment for $unick";
    echo "</p>";
    echo "<p>";
    $pen[0]="Trash";
    $pen[1]="Ban";
if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
    $pen[2]="Ban Ip";
}
echo "<form action=\"codercpr.php?action=mbrpundo&amp;sid=$sid\" method=\"post\">";
    echo "Penalty: <select name=\"pid\">";
    for($i=0;$i<count($pen);$i++)
    {
      echo "<option value=\"$i\">$pen[$i]</option>";
    }
    echo "</select><br/>";
    echo "Reason: <input name=\"pres\" maxlength=\"100\"/><br/>";
if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
    echo "Days: <input name=\"pds\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";


    
}
echo "Hours: <input name=\"phr\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";

    echo "Minutes: <input name=\"pmn\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
    echo "Seconds: <input name=\"psc\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
    echo "<input type=\"submit\" value=\"GO\"/>";
    
    echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
    
    echo "</form>";
    echo "</p>";
    
     echo "<p align=\"center\">";
	  echo "<div class=\"ads\">";
 echo admob();
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
	  else
	  {
	  header("location:index.php");
	   exit();
	  }
}
//////////////////////////////////////Penalties Options

else if($action=="plsopt")
{
if(isset($_GET['who']))
      {
    $who = $_GET["who"];
    }
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
 echo admob();
  echo "</div>";
	echo "<br />";
    $unick = getnick_uid($who);
    echo "Add/Substract $unick's Plusses";
    echo "</p>";
    echo "<p>";
    $pen[0]="Substract";
   if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
 $pen[1]="Add";
    }
echo "<form action=\"codercpr.php?action=pls&amp;sid=$sid\" method=\"post\">";
    echo "Action: <select name=\"pid\">";
    for($i=0;$i<count($pen);$i++)
    {
      echo "<option value=\"$i\">$pen[$i]</option>";
    }
    echo "</select><br/>";
    echo "Reason: <input name=\"pres\" maxlength=\"100\"/><br/>";
    echo "Plusses: <input name=\"pval\" format=\"*N\" maxlength=\"3\"/><br/>";
echo "<input type=\"submit\" value=\"GO\"/>";
    
    echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
    
      echo "</form>";
    echo "</p>";

     echo "<p align=\"center\">";
	   echo "<div class=\"ads\">";
 echo admob();
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



//////////////////////////////////////New Penalties Options

else if($action=="kalamopt"){
if(isset($_GET['who']))
      {
$who = $_GET["who"];
}
$check = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE id='".$who."'"));
if($check[0]==0)
{
echo "<p align='center'>User can not be find. Its either the user id is deleted or something else.</p><br />";

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
	 
  echo "</p>";
exit;
}
echo "<p align=\"center\">";
$unick = getnick_uid($who);
echo "What do you want to do with $unick";
echo "</p>";
echo "<p>";

echo "<form method=\"post\" action=\"codercpr.php?action=sazadore&amp;sid=$sid\">Misc Penalties:<br />";
//echo "<input type=\"radio\" name=\"pid\" value=\"0\" />Block Outgoing<br/>";
//echo "<input type=\"radio\" name=\"pid\" value=\"1\" checked=\"checked\" />Ban<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"2\" checked/>Ban from Inbox<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"3\" />Ban from Forum Access<br/>";
echo "<input type=\"radio\" name=\"pid\" value=\"4\" />Ban from Shoutbox<br/>";
echo "Reason:<br/> <input id=\"inputText\" type=\"text\" name=\"pres\" maxlength=\"100\"/><br/>";
echo "Days: <br/><input id=\"inputText\" type=\"text\" name=\"pds\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "Hours: <br/><input id=\"inputText\" type=\"text\" name=\"phr\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "Minutes: <br/><input id=\"inputText\" type=\"text\" name=\"pmn\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
//echo "Seconds: <br/><input id=\"inputText\" type=\"text\" name=\"psc\" style=\"-wap-input-format: '*N'\" maxlength=\"4\"/><br/>";
echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
echo "<input id=\"inputButton\" type=\"submit\" name=\"submit\" value=\"Punish\"/></form>";

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
getfooter($sid);
exit();
}

    




///////////////////////////////////////////////Mod a user

else if($action=="user")
{
 if(isset($_GET['who']))
      {
    $who = $_GET["who"];
	}
$check = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE id='".$who."'"));
if($check[0]==0)
{
echo "<p align='center'>User can not be find. Its either the user id is deleted or something else.</p><br />";

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
	 
  echo "</p>";
exit;
}
 $whoad = getuid_sid($sid);
    echo "<p align=\"center\">";
	 echo "<div class=\"ads\">";
 echo admob();
  echo "</div>";
	echo "<br />";
    $unick = getnick_uid($who);
	
    echo "<b>Moderating $unick</b>";
    echo "</p>";
    echo "<p>";
	  if (isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
    echo "<a href=\"codercp.php?action=penoptmbrdo&amp;sid=$sid&amp;who=$who\">&#187;Penalties</a><br/>";
   }
	  if (isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)) || isowner(getuid_sid($sid)))
	  {
    echo "<a href=\"codercp.php?action=kalamopt&amp;sid=$sid&amp;who=$who\">&#187;Other Penalties</a><br/>";
   }


   echo "<a href=\"codercp.php?action=plsopt&amp;sid=$sid&amp;who=$who\">&#187;Plusses</a><br/><br/>";
    if(istrashed($who))
    {
	if (iscoder(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
      echo "<a href=\"codercpr.php?action=untrmbr&amp;sid=$sid&amp;who=$who\">&#187;Untrash</a><br/>";
    }
	}
	
	if(isshoutblocked($who)){
echo "<a href=\"codercpr.php?action=openshout&amp;sid=$sid&amp;who=$who\">&#187;Unblock Shoutbox</a><br/>";
}
if(isforumblocked($who)){
echo "<a href=\"codercpr.php?action=openforum&amp;sid=$sid&amp;who=$who\">&#187;Unblock Forum Access</a><br/>";
}
if(isinboxblocked($who)){
echo "<a href=\"codercpr.php?action=openinbox&amp;sid=$sid&amp;who=$who\">&#187;Unblock Inbox</a><br/>";
}

    if(isbanned($who))
    {
	 if (isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)) || iscoder(getuid_sid($sid)))
    {
      echo "<a href=\"codercpr.php?action=unbnmbr&amp;sid=$sid&amp;who=$who\">&#187;Unban</a><br/>";
    }
	}
    if(!isshield($who))
    {
	
      echo "<a href=\"codercpr.php?action=shldmbr&amp;sid=$sid&amp;who=$who\">&#187;Shield</a><br/>";
    }else{
        echo "<a href=\"codercpr.php?action=ushldmbr&amp;sid=$sid&amp;who=$who\">&#187;Unshield</a><br/>";
    }
	   if (iscoder(getuid_sid($sid)) || isowner(getuid_sid($sid)) || isadmin(getuid_sid($sid)))
    {
	  echo "<a href=\"codercpr.php?action=mbrboot&amp;sid=$sid&amp;who=$who\">&#187;Boot $unick</a><br/>";
    }
	
	echo "</p>";
    echo "<p align=\"center\">";
	 
  echo "<div class=\"ads\">";
 echo admob();
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


else{
    addonline(getuid_sid($sid),"Trying to enter coder cp illegally","");

  echo "<p align=\"center\">";
   $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO gyd_mlog SET action='penalties', details='A user called $user using ip $ip and browser $br was trying to hack the site by searching for script destinations in codercp!!', actdt='".time()."'");
 //  header('location:index.php');

  echo "Page not found!";
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

	echo "</body>";
	echo "</html>";
	      exit();
		  }
?>
