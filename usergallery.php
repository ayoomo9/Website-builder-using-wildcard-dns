
<?php

require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_injection();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";

?>
      <!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
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

$type1 = $_GET["type"];
$whoimage = $_GET["whoimage"];
$bcon = connectdb();

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
     ?>
	 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Banned!!!</title>
<link rel="StyleSheet" type="text/css" media="all" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
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
  echo xhtmlfoot();
      exit();
    }

if($action=="main")
{


  addonline(getuid_sid($sid),"User Gallery","");
 // $pstyle = gettheme($sid);
  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>wapbies Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "<i><b><u>wapbies Members Gallery</u></b></i><br/>";

  echo "</p>";
  
  echo "<p>";
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE sex='M'"));
  echo "<a href=\"usergallery.php?action=males&amp;sid=$sid\"><img src=\"images/m.gif\" alt=\"*\"/>Males</a>($noi[0])<br /><br />";
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE sex='F'"));
  echo "<a href=\"usergallery.php?action=females&amp;sid=$sid\"><img src=\"images/f.gif\" alt=\"*\"/>Females</a>($noi[0])<br /><br /><hr />";
 $pic = mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery ORDER BY RAND() LIMIT 1"));
$user = getnick_uid($pic[0]);
echo "Random Users Pic<br />";
echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$pic[0]\"/><img src=\"$pic[1]\" width=\"140\" height=\"140\"/></a>";



 echo "<p align='left'><br /><br /><b><a href=\"usergallery.php?action=upload&amp;sid=$sid\">Upload Your Photo</a></p></b><br />";
  echo "</p>";
    echo "</p>"; 
  ////// UNTILL HERE >> 
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
  echo "</body></html>";
}else
if($action=="males")
{
  addonline(getuid_sid($sid),"Male Gallery","");
 // $pstyle = gettheme($sid);
 ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Male User Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "<i><b><u>Male Users On wapbies</u></b></i>";
  echo "<br/><br/>";
  echo "</p>";
   //////ALL LISTS SCRIPT <<
   $uid1 = getuid_sid($sid); 

       if($page=="" || $page<=0)$page=1;					
					
					    if($who!="")
					    {
					    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_usergallery WHERE sex='M'"));
					    }else{
					    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_usergallery WHERE sex='M'"));
					    }
					
					    $num_items = $noi[0]; //changable
					    $items_per_page= 10;
					    $num_pages = ceil($num_items/$items_per_page);
					    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
					    $limit_start = ($page-1)*$items_per_page;
					
						$sql = "SELECT DISTINCT `uid` FROM `gyd_usergallery` WHERE sex='M' ORDER BY `id` DESC LIMIT $limit_start , $items_per_page";
					
					    $items = mysql_query($sql);
					 //   echo mysql_error();
					    
					    if(mysql_num_rows($items)>0)
					    {
					    while ($item = mysql_fetch_array($items))
					    {
						$who = $item[0];
						
						$user=getnick_uid($who);
					
						$countpics = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usergallery WHERE uid='".$who."'"));
					        $lnk = "<a href=\"usergallery.php?action=viewuserphoto&amp;who=$who&amp;sid=$sid\">$user($countpics[0])</a><br/>";
  $count_pics = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE uid='".$who."'"));
  $pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery WHERE uid='".$who."' ORDER BY RAND() LIMIT 1"));
  if($count_pics[0]>0)
  {
  echo "<img src='$pic[1]' width='30' height='30' title='$user'> ";
  }
						  echo "$lnk"; 
					    }
					    }
					echo "</td>";
				echo "</tr>";
			echo "</table>";
		echo "</div>";
		echo "</div>";
		
  echo "</div>";   
    
    echo "<p align=\"center\">";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"usergallery.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        $rets .= "</form>";


        echo $rets;
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
  echo "</body></html>";
}




////////////////////////////////////////FEMALE GALLERY
else if($action=="females")
{
  addonline(getuid_sid($sid),"Female Gallery","");
 ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Female User Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "<i><b><u>Female Users On wapbies</u></b></i>";
  echo "<br/><br/>";
  echo "</p>";

 
				echo "<tr>";
					echo "<td class=\"IL-R\">";
					    if($page=="" || $page<=0)$page=1;					
					
					    if($who!="")
					    {
					    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_usergallery WHERE sex='F'"));
					    }else{
					    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT uid) FROM gyd_usergallery WHERE sex='F'"));
					    }
					
					    $num_items = $noi[0]; //changable
					    $items_per_page= 10;
					    $num_pages = ceil($num_items/$items_per_page);
					    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
					    $limit_start = ($page-1)*$items_per_page;
					
						$sql = "SELECT DISTINCT `uid` FROM `gyd_usergallery` WHERE sex='F' ORDER BY `id` DESC LIMIT $limit_start , $items_per_page";
					
					    $items = mysql_query($sql);
					  //  echo mysql_error();
					    
					    if(mysql_num_rows($items)>0)
					    {
					    while ($item = mysql_fetch_array($items))
					    {
						$who = $item[0];
						
						$user=getnick_uid($who);
					
						$countpics = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gyd_usergallery WHERE uid='".$who."'"));
					        $lnk = "<a href=\"usergallery.php?action=viewuserphoto&amp;who=$who&amp;sid=$sid\">$user($countpics[0])</a><br/>";
					         $count_pics = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE uid='".$who."'"));
  $pic = @mysql_fetch_array(mysql_query("SELECT uid, imageurl FROM gyd_usergallery WHERE uid='".$who."' ORDER BY RAND() LIMIT 1"));
  if($count_pics[0]>0)
  {
  echo "<img src='$pic[1]' width='30' height='30' title='$user'> ";
  }
						   echo "$lnk"; 
					    }
					    }
					echo "</td>";
				echo "</tr>";
			echo "</table>";
		echo "</div>";
		echo "</div>";
		
  echo "</div>";   
    
    echo "<p align=\"center\">";
   if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"usergallery.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        $rets .= "</form>";


        echo $rets;
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
  echo "</body></html>";
}







 elseif($action=="rate")
{
  addonline(getuid_sid($sid),"User Gallery","");
 // $pstyle = gettheme($sid);
 ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>User Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "Rate this members Photo: 1=Low, 10=High<br/>You can also leave a comment for this photo!<br/>";
  echo "<br/>";
  echo "</p>";
  echo "<p>";
    echo "<form action=\"usergallery.php?action=rateuser&amp;sid=$sid&amp;whoimage=$whoimage\" method=\"post\">";
    echo "Rate: <select name=\"rate\" value=\"$rate[0]\">";
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "<option value=\"5\">5</option>";
    echo "<option value=\"6\">6</option>";
    echo "<option value=\"7\">7</option>";
    echo "<option value=\"8\">8</option>";
    echo "<option value=\"9\">9</option>";
    echo "<option value=\"10\">10</option>";
    echo "</select><br/>";
    
  echo "Comments: <input name=\"comment\" format=\"*M\" maxlength=\"200\"/><br/>";
  echo "<input type=\"submit\" value=\"Rate\"/>";
  echo "</form>"; 
  
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
 echo "</body></html>";
}
else if($action=="comments")
{
  addonline(getuid_sid($sid),"Reading Photo''s Comments","");
      ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Read Comment</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php

      //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery_rating WHERE imageid='".$whoimage."' and commentsyn ='Y'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    
    $uidinfo = mysql_fetch_array(mysql_query("SELECT uid FROM gyd_usergallery WHERE id='".$whoimage."'"));
    $uid = getuid_sid($sid);

    
    $sql = "SELECT rating, comments, byuid, time, commentsreply, id  FROM gyd_usergallery_rating WHERE imageid ='".$whoimage."' and commentsyn ='Y' ORDER BY time DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
        
    if(isonline($item[2]))
  {
    $iml = "<img src=\"images/onl.gif\" alt=\"+\"/>";
    
  }else{
    $iml = "<img src=\"images/ofl.gif\" alt=\"-\"/>";
  }
    if(strlen($item[1])>1){
         
      $snick = getnick_uid($item[2]);
      $uid1 = getuid_sid($sid);
        
  		if($uid==$uidinfo[0])
  		{  
      		$dellnk = "<a href=\"usergallery.php?action=delvote&amp;sid=$sid&amp;whoimage=$item[5]\">*</a>";
      	}else{
			$dellnk = "";      	
      	}
      	
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[2]&amp;sid=$sid\">$iml$snick:</a> <b>$item[0]/10</b> $dellnk";
	  echo "$lnk<br/>";
      $bs = date("d/m/y",$item[3]);
      $text = parsepm($item[1], $sid);
      if(($uid==$uidinfo[0]) and (strlen($item[4])<1))
      {
        $replylink = "<a href=\"usergallery.php?action=commentreply&amp;sid=$sid&amp;id=$item[5]\">Reply to Comment</a><br/><i>$bs</i>";
      }else{
        $replylink = " <i>$bs</i>";
      }
      echo "$text";
      if(strlen($item[4])>1)
      {
      $text1 = parsepm($item[4], $sid);
      echo "<br><b><i>Reply:</i> $text1</b>";
      }
      echo "<br/>$replylink<br/><br/>";
      echo "";
    }
    }
    }
    echo "</p>";
    echo "<p><center>";
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"usergallery.php?action=$action&amp;sid=$sid&amp;page=$ppage&amp;whoimage=$whoimage\"><small>&#171; Prev</small></a> ";
    }
    echo "$page/$num_pages ";
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"usergallery.php?action=$action&amp;sid=$sid&amp;page=$npage&amp;whoimage=$whoimage\"><small>Next &#187;</small></a>";
    }
    
    if($num_pages>2)
    {
        $rets = "<center><form action=\"usergallery.php\" method=\"get\">";
        $rets .= "Jump to Photo:<input name=\"page\" format=\"*N\" size=\"3\"/><br/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        $rets .= "<input type=\"hidden\" name=\"whoimage\" value=\"$whoimage\"/>";
        $rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</form></center>";
        echo $rets;  
    }
    echo "</center></p>";    
    
  echo "<center>";
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</center>";  
  
  echo xhtmlfoot();
}



elseif($action=="commentreply")
{
  addonline(getuid_sid($sid),"User Gallery","");
 // $pstyle = gettheme($sid);
  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>User Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  $id = $_GET["id"];
  echo "<p align=\"center\">";
  echo "Reply to a Comment<br/>";
  echo "<br/>";
  echo "</p>";
  echo "<p>";
    echo "<form action=\"usergallery.php?action=commentreplyaction&amp;sid=$sid&amp;id=$id\" method=\"post\">";
  echo "Reply: <input name=\"reply\" format=\"*M\" maxlength=\"200\"/><br/>";
  echo "<input type=\"submit\" value=\"Reply\"/>";
  echo "</form>"; 
  
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>"; 
	 echo "</p>";
 echo "</body></html>";
}else
if($action=="votes")
{
  addonline(getuid_sid($sid),"User Gallery","");
 // $pstyle = gettheme($sid);
  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>User Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "<br/>";
  echo "</p>";
      //////ALL LISTS SCRIPT <<

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery_rating WHERE imageid='".$whoimage."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 20;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    
    $imageratinginfo = "SELECT rating, byuid  FROM gyd_usergallery_rating WHERE imageid='".$item[1]."'";

    
        $sql = "SELECT rating, byuid, time  FROM gyd_usergallery_rating WHERE imageid ='".$whoimage."' ORDER BY time DESC LIMIT $limit_start, $items_per_page";


    echo "<p>";
    $items = mysql_query($sql);
    //echo mysql_error();
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
      $lnk = "<a href=\"index.php?action=viewuser&amp;who=$item[1]&amp;sid=$sid\">$iml$snick:</a> <b>$item[0]/10</b>";
      echo "$lnk<br/>";
    
    }
    }
    echo "</p>";
    echo "<p align=\"center\">";
   if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">&#171;PREV</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"usergallery.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
         $rets = "<form action=\"usergallery.php\" method=\"get\">";
        $rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
        
        $rets .= "</form>";


        echo $rets;
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
  echo "</body></html>";
}else


if($action=="rateuser")
{
   addonline(getuid_sid($sid),"Rate a User","");
   $rate = $_POST["rate"];
   $comment = $_POST["comment"];
  // $pstyle = gettheme($sid);
  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Rate User</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
   echo "<p align=\"center\">";
   $uid = getuid_sid($sid);
   if((strlen($comment))>1 && !newisblocked($comment) && !isblocked($comment)){   
   $res= mysql_query("INSERT INTO gyd_usergallery_rating SET imageid='".$whoimage."', rating='".$rate."', comments='".$comment."', byuid='".$uid."', time='".(time() - $timeadjust)."', commentsyn='Y'");
   }else
   if((strlen($comment))<2 && !newisblocked($comment) && !isblocked($comment)){   
   $res= mysql_query("INSERT INTO gyd_usergallery_rating SET imageid='".$whoimage."', rating='".$rate."', comments='".$comment."', byuid='".$uid."', time='".(time() - $timeadjust)."', commentsyn='N'");
   }

   if(($res) and ((strlen($comment))>1)){
   
     echo "<img src=\"images/ok.gif\" alt=\"o\"/>Rated Successfully<br/>";
     echo "<img src=\"images/ok.gif\" alt=\"o\"/>Comments added Successfully<br/>";
   }else
   if(($res) and ((strlen($comment))<2)){
   
     echo "<img src=\"images/ok.gif\" alt=\"o\"/>Rated Successfully<br/>";
     echo "<img src=\"images/notok.gif\" alt=\"x\"/>No Comments were added<br/>";
   }
   else{
     echo "<img src=\"images/notok.gif\" alt=\"x\"/>Rated unsuccessfully<br/>";
     echo "<img src=\"images/notok.gif\" alt=\"x\"/>No Comments were added<br/>";
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
  echo "</body></html>";
}else


if($action=="commentreplyaction")
{
   addonline(getuid_sid($sid),"Reply To Comment","");
   $id = $_GET["id"];
   $reply = $_POST["reply"];
  // $pstyle = gettheme($sid);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Reply to comment</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php

   echo "<p align=\"center\">";
   $uid = getuid_sid($sid);
   $res = mysql_query("UPDATE gyd_usergallery_rating SET commentsreply='".$reply."' WHERE id='".$id."'");


   if($res){
   
     echo "<img src=\"images/ok.gif\" alt=\"o\"/>Replyed Successfully<br/>";
   }
   else{
     echo "<img src=\"images/notok.gif\" alt=\"x\"/>Replyed unsuccessfully<br/>";
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
   echo "</body></html>";
}else


if($action=="upload")
{
   addonline(getuid_sid($sid),"Uploading a Photo","");
   $rate = $_POST["rate"];
   $comment = $_POST["comment"];
  // $pstyle = gettheme($sid);
  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload to Gallery</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  set_time_limit(0);
   echo "<p>";
 
   echo "You can now upload your photo direct from your phone.<br/>";
   
 echo "<br /><small><u>Important Notice:</u> You must Update your profile to include your gender before uploading your picture(s),<br /> failure to do this will make your picture unviewable in the gallery.</small>";
            echo "<br /><br />Pick a Photo to upload, and press 'upload'<br/>";
            echo " <form name=\"form2\" enctype=\"multipart/form-data\" method=\"post\" action=\"upload.php?action=upload&amp;sid=$sid\" />";
            echo "<input type=\"file\" size=\"20\" name=\"my_field\" value=\"\" /><br/>";
			//echo "Description: <input name=\"descript\" maxlength=\"100\" size=\"20\"/>";
            echo "<input type=\"hidden\" name=\"action\" value=\"image\" />";
            echo "<input type=\"submit\" name=\"Submit\" value=\"upload\" />";
            echo "</form>";
   
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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
 echo "</body></html>";
}

else if($action=="viewuserphoto")
{
$who = $_GET["who"];
  $uid1 = getuid_sid($sid);
  $nick = getnick_uid($who);
  

  addonline(getuid_sid($sid),"Viewing $nick Photo Gallery ","");
     ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>View User Photo(s)</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php

echo "<center><h4><u>$nick photo gallery</u></h4>";

    
					    if($page=="" || $page<=0)$page=1;
					    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery WHERE uid='".$who."'"));
					    $num_items = $noi[0]; //changable
					    $items_per_page= 1;
					    $num_pages = ceil($num_items/$items_per_page);
					    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
					    $limit_start = ($page-1)*$items_per_page;
					
					    //changable sql
					
					    $sql = "SELECT uid, id, imageurl, sex, descript FROM gyd_usergallery WHERE uid='".$who."' ORDER BY time DESC LIMIT $limit_start, $items_per_page";

					    $items = mysql_query($sql);
						
					    //echo mysql_error();
					    if(mysql_num_rows($items)>0)
					    {
					    while ($item = mysql_fetch_array($items))
					    {
							$sql = "SELECT rating FROM gyd_usergallery_rating WHERE imageid='".$item[1]."'";		
							$imginfo = mysql_query($sql);
							
						//	echo mysql_error();
					        if(mysql_num_rows($imginfo)>0)
					        {
					           while ($imginfos = mysql_fetch_array($imginfo)){ 
					              $ratingtotal = $ratingtotal + $imginfos[0];}
					        }
							
					
							if($totalcomments<1){$totalcomments=0;}         
							$norm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery_rating WHERE imageid='".$item[1]."'"));
							if ($norm[0]>0){
							$rating = ceil($ratingtotal/$norm[0]);
							}else{$rating=0;}
							
							$rated = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery_rating WHERE byuid='".$uid1."' and imageid ='".$item[1]."'"));
							$totalcomments = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_usergallery_rating WHERE imageid ='".$item[1]."' and commentsyn ='Y'"));
							$userinfo = mysql_fetch_array(mysql_query("SELECT name FROM gyd_users WHERE id='".$item[0]."'"));
							
					        
					        if(canratephoto($uid1, $item[0]) and ($rated[0]==0))
					    	{
					         echo "<a href=\"usergallery.php?action=rate&amp;sid=$sid&amp;whoimage=$item[1]\">Rate This Photo</a>";
					        }
					        if($uid1==$item[0])
					    	{
					         echo "<a href=\"genproc.php?action=upavg&amp;sid=$sid&amp;avsrc=$item[2]\">Use As Avatar</a>";
					        }
							echo " |";
					        if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='10' || $uid=='194' || $uid=='16')
					    	{
					         echo "  <a href=\"usergallery.php?action=del&amp;sid=$sid&amp;whoimage=$item[1]\">Delete</a>";
					        }
					        echo "<br/><a href=\"$item[2]\"><img src=\"$item[2]\" alt=\"$userinfo[0]: $page\"/></a><br/><br />";					        
					        if($uid1==$item[0])
					    	{
					    	if(strlen($item[4])>1){
					        $edtlnk = "<a href=\"usergallery.php?action=edtdescript&amp;sid=$sid&amp;whoimage=$item[1]\">*</a>";
					        }else{
					        $edtlnk = "<a href=\"usergallery.php?action=edtdescript&amp;sid=$sid&amp;whoimage=$item[1]\">*Add Description*</a>";
					        }
					       //echo "$item[4] $edtlnk<br/><br/>";
					        }
					        echo "Rating: $rating/10 (<a href=\"usergallery.php?action=votes&amp;sid=$sid&amp;whoimage=$item[1]\">$norm[0]</a> Votes)<br /><br /><a href=\"usergallery.php?action=comments&amp;sid=$sid&amp;whoimage=$item[1]\">Comments</a>($totalcomments[0])";
					        echo "<br/>";
					        $ratingtotal = 0;
					        $sex = $item[3];        
					    }
					    }
		  
  
    echo "</center><br />";
	

	
    echo "<p><center>";
     if ($page > 1) {
			$ppage = $page-1;
			echo "<a href=\"usergallery.php?action=$action&amp;page=$ppage&amp;sid=$sid&amp;who=$who\">PREV</a> ";
		}
		if ($page < $num_pages) {
			$npage = $page+1;
			echo "<a href=\"usergallery.php?action=$action&amp;page=$npage&amp;sid=$sid&amp;who=$who\">Next</a>";
		}
		echo "<br/>$page/$num_pages<br/>";
		if ($num_pages > 2) {
			$rets = "<form action=\"usergallery.php\" method=\"get\">";
			$rets .= "Jump to page<input name=\"page\" format=\"*N\" size=\"3\"/>";
			$rets .= "<input type=\"submit\" value=\"GO\"/>";
			$rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
			$rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
			$rets .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\"/>";
			$rets .= "</form>";
			echo $rets;
		}
    echo "</p>";
    
if ($sex=="M"){
  echo "<br /><a href=\"usergallery.php?action=males&amp;sid=$sid\">Male Gallery</a>";
  
  }else{
  echo "<a href=\"usergallery.php?action=females&amp;sid=$sid\">Female Gallery</a>";
  }
   echo "</center></p>";  
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
  
  echo xhtmlfoot();
}

//////////// Delete user image
else if($action=="del")
{

  ?>
  <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Delete User Posts</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
      echo "<p align=\"center\">";
 if (isadmin(getuid_sid($sid)) || isowner(getuid_sid($sid)) || $uid=='10' || $uid=='194' || $uid=='16')
					    	{
        echo "<br/>";
			  $imageurl = mysql_fetch_array(mysql_query("SELECT imageurl FROM gyd_usergallery WHERE id='".$whoimage."'"));
//echo mysql_error();
   // $imagename = explode("/",$imageurl[0]);

    $delpath = "$imageurl[0]";
	unlink("$delpath");
		  echo "$delpath";
    $res = mysql_query("DELETE FROM gyd_usergallery WHERE id='".$whoimage."'");
    $res = mysql_query("DELETE FROM gyd_usergallery_rating WHERE imageid='".$whoimage."'");
      


        if($res)
      {

        echo "<img src=\"images/ok.gif\" alt=\"O\"/>Photo and all the Comments have been deleted";
      }else{
        echo "<img src=\"images/notok.gif\" alt=\"X\"/>Error deleting Photo";
      }
	  }
	  else
	  {
	  
	          echo "<img src=\"images/notok.gif\" alt=\"X\"/>You are not a staff";

	  }

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
 echo "<div class='whitegreen'>";
echo copyright();
	 echo "</div>";
  echo "</p>";
   echo "</body></html>";
}else

{
  addonline(getuid_sid($sid),"Lost in Gallery","");
  //$pstyle = gettheme($sid);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Page not found</title>
<link rel="StyleSheet" type="text/css" href="default.css" />
<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php
  echo "<p align=\"center\">";
  echo "Page not found!<br/><br/>";
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
  echo "</body></html>";
  echo exit();
}

?>