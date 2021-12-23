

<?php


require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
//check_injection();
check_query();

include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
connectdb();
if(isset($_GET['action']))
      {
$action = $_GET["action"];
}
if(isset($_GET['sid']))
      {
$sid = $_GET["sid"];
}
if(isset($_GET['page']))
      {
$page = $_GET["page"];
}
if(isset($_GET['who']))
      {
$who = $_GET["who"];
}

$uid = getuid_sid($sid);

$pmid = $_GET["pmid"];
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


$uid = getuid_sid($sid);
if(isbanned($uid))
    {

echo "<head>";
addonline(getuid_sid($sid),"Just got banned","index.php?action=$action");
  echo "<title>Banned Notice!!!</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";

  echo "</head>";

      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
echo "</p>";
	echo "<div class=\"ads\">";
echo admob();
	echo "</div>";
echo "<p align=\"center\"><br />";
      $banto = @mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'")); 
echo "<br /><em>You are <b>Banned from wapbies.com</b><br /><br /></em>";

	  $banres = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));

      $remain = $banto[0]- time();
      $rmsg = @gettimemsg($remain);
      echo "<b>Ban Duration:</b> $rmsg<br/><br/>";
       $nick = getnick_uid($banto[2]);
	echo "<b>Ban By: </b>$nick<br/>";
	  echo "<b>Ban Reason:</b> $banto[1]";
	  echo "<br />";
echo "</p><br />";
	  	echo "<div class=\"ads\">";
echo admob();
	echo "</div>";

      
      echo "</body>";
      echo "</html>";
      exit();
    }



if(isinboxblocked($uid)){
addonline(getuid_sid($sid),"Banned from Message Menu!","index.php?action=$action");
	echo "<head>";

	echo "<title>Inbox Banned!!</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

	echo "<body>";  
      echo "<p align=\"center\">";


echo "<b><br />You are banned from Messages menu</b><br />";




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



if($action=="sendpm")
{

	echo "<head>";

	echo "<title>Send Message</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

	echo "<body>";
	if(account_val_time()==false)
{
echo "<font color='red'><p align='center'><strong>NOTICE</strong></p></font>";
echo "<br /><font color='red'><p align='center'>Sorry, Please note that this your account is new and not yet validated!<br />
Some features are temporarily disabled for unvalidated users like you pending the time you get validated<br />
You must stay online for some minutes to get validated automatically.</p></font></br />";
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
$whonick = getnick_uid($who);
  addonline(getuid_sid($sid),"Composing PM to $whonick","");
  
  echo "<p align=\"center\">";
  
  echo "Send PM to $whonick<br/><br/>";
  ?>
  <!--
    <strong><u>Warning:</u> <br /><small>Please note that you will get banned if you tried putting site links in your pm messages.
  <br />
  Sending of sites links is considered as spamming and its uncalled-for. We strongly prohibit spamming. 
  <br />Your site will be closed and your account username on wapbies will be canceled.<br />
  Be warned!(Ayoomo9 &amp; Xola)</small></strong><br /><br />
  -->
  
  <?php
echo "<form action=\"inbxproc.php?action=sendpm&amp;who=$who&amp;sid=$sid\" method=\"post\">";
  echo "<textarea name=\"pmtext\" maxlength=\"500\"/></textarea><br/>";
echo "<input type=\"submit\" value=\"Send\"/>";
echo "</form>";
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
    


}
else if($action=="sendpopup")
{
  addonline(getuid_sid($sid),"Sending Flash pm","lists.php?action=buds");
      echo "<head>";
      echo "<title>Send Popup</title>";
      	
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $whonick = getnick_uid($who);
  echo "Send Popup to $whonick<br/><br/>";
  ?>
  <!--
    <strong><u>Warning:</u> <br /><small>Please note that you will get banned if you tried putting site links in your popup messages.
  <br />
  Sending of sites links is considered as spamming and its uncalled-for. We strongly prohibit spamming. 
  <br />Your site will be closed and your account username on wapbies will be canceled.<br />
  Be warned!(Ayoomo9 &amp; Xola)</small></strong><br /><br />
  -->
  <?php
  echo "<form action=\"inbxproc.php?action=sendpopup&amp;who=$who&amp;sid=$sid\" method=\"post\">";
  echo "<textarea name=\"pmtext\" maxlength=\"500\"/></textarea><br/>";
  echo "<input type=\"Submit\" name=\"send\" value=\"Send\"></form>";
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

}

else if($action=="sendto"){
addonline(getuid_sid($sid),"Sending Message","");

	echo "<title>Send Message</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";
boxstart("Create new messages");

echo "Username: <form action=\"inbxproc.php?action=sendto&amp;sid=$sid\" method=\"post\"><input id=\"inputText\" name=\"pmtou\" maxlength=\"30\"/><br/>";
echo "Message: <br/><textarea id=\"inputText\" name=\"pmtext\"></textarea><br/>";
echo "<input id=\"inputButton\" type=\"submit\" value=\"Send\"/></form>";
echo "<br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to Messages</a></br>";
echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
	 echo " | ";
	 
 echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a></div>";
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
}
else if($action=="main")
{

	echo "<head>";

	echo "<title>Message Menu</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

	echo "<body>";
  addonline(getuid_sid($sid),"User Inbox","inbox.php?action=$action");
 echo "<div class='whitegreen'>";
	 echo "Private Message(s) Menu";
	 echo "</div>";
    echo "<div class=\"ads\">";
	if(!$uid=='194')
{
include('admob.php');
}
  echo "</div>";
    echo "<p align=\"center\">";
	echo "<a href=\"emailform.php?action=sendmail&amp;sid=$sid\"><img src=\"images/message.gif\" alt=\"x\"/> Send e-mail</a><br/><br/>";

	echo "<form action=\"inbox.php\" method=\"get\">";
    echo "View: <select name=\"view\">";
  echo "<option value=\"all\">All</option>";
  echo "<option value=\"snt\">Sent</option>";
  echo "<option value=\"str\">Starred</option>";
  echo "<option value=\"urd\">Unread</option>";
  echo "</select>";
echo "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
echo "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
echo "<input type=\"submit\" value=\"View\"/>";
echo "</form>";
      echo "</p>";
    $view = $_GET["view"];
    //////ALL LISTS SCRIPT <<
    if($view=="")$view="all";
    if($page=="" || $page<=0)$page=1;
    $myid = getuid_sid($sid);
    $doit=false;
    $num_items = getpmcount($myid,$view); //changable
    $items_per_page= 7;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($num_items>0)
    {
      if($doit)
      {
        $exp = "&amp;rwho=$myid";
      }else
      {
        $exp = "";
      }
    //changable sql
    if($view=="all")
  {
    $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page
    ";
  }else if($view=="snt")
  {
    $sql = "SELECT
            a.name, b.id, b.touid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.touid
            WHERE b.byuid='".$myid."'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page
    ";
  }else if($view=="str")
  {
    $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.starred='1'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page
    ";
  }else if($view=="urd")
  {
    $sql = "SELECT
            a.name, b.id, b.byuid, b.unread, b.starred FROM gyd_users a
            INNER JOIN gyd_private b ON a.id = b.byuid
            WHERE b.touid='".$myid."' AND b.unread='1'
            ORDER BY b.timesent DESC
            LIMIT $limit_start, $items_per_page
    ";
  }
    
    echo "<p>";
	
    $items = mysql_query($sql);
   // echo mysql_error();
    while ($item = mysql_fetch_array($items))
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
      $lnk = "<a href=\"inbox.php?action=readpm&amp;pmid=$item[1]&amp;sid=$sid\">$iml $item[0]</a>";
      echo "$lnk<br/>";
    }
    echo "</p>";
    echo "<p align=\"center\">";
    
      $npage = $page+1;
      echo "<a href=\"inbox.php?action=sendto&amp;sid=$sid\">Send to</a><br/>";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"inbox.php?action=main&amp;page=$ppage&amp;sid=$sid&amp;view=$view$exp\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"inbox.php?action=main&amp;page=$npage&amp;sid=$sid&amp;view=$view$exp\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
$rets = "<form action=\"inbox.php\" method=\"get\">";
      $rets .= "Jump to page: <input name=\"page\" format=\"*N\" size=\"3\"/>";
$rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
         
        $rets .= "<input type=\"hidden\" name=\"view\" value=\"$view\"/>";
$rets .= "</form>";
        echo $rets;
      echo "<br/>";
    }
    echo "<br/>";
echo "<form action=\"inbxproc.php?action=proall&amp;sid=$sid\" method=\"post\">";
      echo "Delete: <select name=\"pmact\">";
  echo "<option value=\"ust\">Unstarred</option>";
  echo "<option value=\"red\">Read</option>";
  echo "<option value=\"all\">All</option>";
  echo "</select>";
echo "<input type=\"submit\" value=\"Delete\"/>";
echo "</form>";

    echo "</p>";
    }else{
      echo "<p align=\"center\">";
      echo "No Private Message(s) at the moment!";
      echo "</p>";
    }
  ////// UNTILL HERE >>

    
  echo "<div class=\"ads\">";
  if(!$uid=='194')
{
echo admob_request($admob_params);
}
  echo "</div>";
echo "<p align=\"center\">";
  echo "</p>";
	echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
	 echo " | ";
	 
 echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
     echo " | ";
  echo "<a href=\"index.php?action=forumindx&amp;sid=$sid\"><img src=\"images/main/forum.gif\" alt=\"x\"/> Forums</a>";
   echo " | ";
 echo "<a href=\"index.php?action=online&amp;sid=$sid\">Onlines</a>";
   echo " | ";
  echo "<a href=\"index.php?action=logout&amp;sid=$sid\">LogOut</a></div>";
	 echo "<div class='whitegreen'>";
	 echo copyright();
	 echo "</div>";
  }
else if($action=="readpm")
{

	echo "<head>";
echo "<meta http-equiv=\"expires\" content=\"0\" />";
	echo "<title>Read Message</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";
$whonick = getnick_uid($who);
	echo "<body>";
  addonline(getuid_sid($sid),"Reading PM","inbox.php?action=$action");
 echo "<div class='whitegreen'>";
	 echo "Private Message";
	 echo "</div>";
    echo "<div class=\"ads\">";
	if(!$uid=='194')
{
include('admob.php');
}
  echo "</div>";

  echo "<p>";

  $pminfo = @mysql_fetch_array(mysql_query("SELECT text, byuid, timesent,touid, reported FROM gyd_private WHERE id='".$pmid."'"));
  if(getuid_sid($sid)==$pminfo[3])
  {
    $chread = @mysql_query("UPDATE gyd_private SET unread='0' WHERE id='".$pmid."'");
  }
  
  if(($pminfo[3]==getuid_sid($sid))||($pminfo[1]==getuid_sid($sid)))
  {
  
  if(getuid_sid($sid)==$pminfo[3])
  {
    if(isonline($pminfo[1]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
    $ptxt = "A message From: ";
    
        $bylnk = "<a href=\"index.php?action=viewuser&amp;who=$pminfo[1]&amp;sid=$sid\"><b>".getnick_uid($pminfo[1])." $iml</b></a>";
  }else{
    if(isonline($pminfo[3]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
    $ptxt = "PM To: ";
    
    $bylnk = "<a href=\"index.php?action=viewuser&amp;who=$pminfo[3]&amp;sid=$sid\">$iml".getnick_uid($pminfo[3])."</a>";
    
  }
   $count_pics = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE uid='".$pminfo[1]."' LIMIT 1"));
  $pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery WHERE uid='".$pminfo[1]."' ORDER BY RAND() LIMIT 1"));
  $display_thumbnail_pic = "<img src='$pic[1]' width='40' height='40'>";
  if($count_pics[0]>0)
  {
  echo "$display_thumbnail_pic<br />";
  }
  echo "$ptxt $bylnk<br/>";

   $tmstamp = $pminfo[2];
  $pmtext = parsepm($pminfo[0], $sid);
    $pmtext = stripslashes(str_replace("/reader",getnick_uid($pminfo[3]), $pmtext));
    if(isspam($pmtext))
    {
      if(($pminfo[4]=="0") && ($pminfo[1]!=1))
      {
        @mysql_query("UPDATE gyd_private SET reported='1' WHERE id='".$pmid."'");
      }
    }
	echo "<br />";
    echo $pmtext;
  echo "</p>";
  echo "<center>";
  echo "<form action=\"inbxproc.php?action=proc&amp;sid=$sid\" method=\"post\">";
  echo "Action: <select name=\"pmact\">";

  echo "<option value=\"rep-$pmid\">Reply</option>";
  echo "<option value=\"del-$pmid\">Delete</option>";
  if(isstarred($pmid))
  {
    echo "<option value=\"ust-$pmid\">Unstar</option>";
  }else{
  echo "<option value=\"str-$pmid\">Star</option>";
  }
  echo "<option value=\"rpt-$pmid\">Report</option>";
  echo "<option value=\"frd-$pmid\">Email To</option>";
	echo "<option value=\"dnl-$pmid\">Download</option>"; 
  echo "</select>";
echo "<input type=\"submit\" value=\"GO\"/>";
echo "</form>";
  echo "<br/><br/><a href=\"inbox.php?action=dialog&amp;sid=$sid&amp;who=$pminfo[1]\">Dialog</a><br />";
 echo "<p align=\"left\">"; 
  echo "<br /><b><small><i>This Message was received ";
   $tmstamp = $pminfo[2];
  $tremain = time()-$tmstamp;
  //$tmdt = date("d m Y - H:i:s", $tmstamp);
  $tmdt = gettimemsg($tremain)." ago"; ////////////////////this is the time thing
  echo "$tmdt</small></b><br/>";
  echo "</p>";
  }else{
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>This pm does not exit";
  }
  echo "<br/><br/><a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/><br />";
    echo "</center>";
  echo "<div class=\"ads\">";
  if(!$uid=='194')
{
echo admob_request($admob_params);
}
  echo "</div>";
  echo "<div class=\"font\"><a href=\"index.php?action=main&amp;sid=$sid\"> <img src=\"images/home.gif\" alt=\"\"/>Home</a>";
	 echo " | ";
	 
 echo "<a href=\"index.php?action=search&amp;sid=$sid\"><img src=\"images/search.gif\" alt=\"x\"/> Search</a>";
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
	 
}else if($action=="dialog")
{

	echo "<head>";

	echo "<title>Message Dialog</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";
$whonick = getnick_uid($who);
	echo "<body>";
    addonline(getuid_sid($sid),"Viewing PM Dialog","");
 echo "<div class='whitegreen'>";
	 echo "PM Dialogue";
	 echo "</div>";
    echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
  $uid = getuid_sid($sid);
  if($page=="" || $page<=0)$page=1;
    $myid = getuid_sid($sid);
    $pms = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE (byuid=$uid AND touid=$who) OR (byuid=$who AND touid=$uid) ORDER BY timesent"));
    //echo mysql_error();
    $num_items = $pms[0]; //changable
    $items_per_page= 7;
    $num_pages = ceil($num_items/$items_per_page);
    if($page>$num_pages)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    if($num_items>0)
    {
      echo "<p>";
      $pms = @mysql_query("SELECT byuid, text, timesent FROM gyd_private WHERE (byuid=$uid AND touid=$who) OR (byuid=$who AND touid=$uid) ORDER BY timesent LIMIT $limit_start, $items_per_page");
      while($pm=mysql_fetch_array($pms))
      {
            if(isonline($pm[0]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
  $bylnk = "<a href=\"index.php?action=viewuser&amp;who=$pm[0]&amp;sid=$sid\">$iml".getnick_uid($pm[0])."</a>";
  echo $bylnk;
  $tmopm = date("d m y - h:i:s",$pm[2]);
  echo " $tmopm<br/>";
  
        echo parsepm($pm[1], $sid);

  echo "<br/>--------------<br/>";
      }
      echo "</p><p align=\"center\">";
      if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"inbox.php?action=dialog&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"inbox.php?action=dialog&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
$rets = "<form action=\"inbox.php\" method=\"get\">";
      $rets .= "Jump to page: <input name=\"page\" format=\"*N\" size=\"3\"/>";
$rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
$rets .= "</form>";
        echo $rets;
      }
      }else{
        echo "<p align=\"center\">";
        echo "NO DATA";
      }
      echo "<br/><br/><a href=\"rwdpm.php?action=dlg&amp;sid=$sid&amp;who=$who\">Download</a><br/>only first 50 messages<br/>";
       echo "<a href=\"inbox.php?action=main&amp;sid=$sid\">Back to inbox</a><br/>";
	    echo "</p>";
    
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
}
    else{
	
	echo "<head>";

	echo "<title>Page Not Found</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	echo "</head>";

	echo "<body>";
      addonline(getuid_sid($sid),"Lost in inbox lol","");
    
  echo "<p align=\"center\">";
    echo "<div class=\"ads\">";
include('admob.php');
  echo "</div>";
  echo "Page not found!";
  header('location:index.php');
   echo "</p>";
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
}

	echo "</body>";
	echo "</html>";

?>
