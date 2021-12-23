

<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
check_query();
check_browser();

check_method();
include("xhtmlfunctions.php");
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
?>

<?php

connectdb();
if(isset($_GET['action']))
      {
$action=trim(strip_tags(htmlentities($_GET["action"])));
}
if(isset($_GET['id']))
      {
$id=trim(strip_tags(htmlentities($_GET["id"])));
}
if(isset($_GET['sid']))
      {
$sid = trim(strip_tags(htmlentities($_GET["sid"])));
}
if(isset($_GET['rid']))
      {
$rid=trim(strip_tags(htmlentities($_GET["rid"])));
}
if(isset($_GET['rpw']))
      {
$rpw=trim(strip_tags(htmlentities($_GET["rpw"])));
}
$uid = getuid_sid($sid);
if(isset($_GET['who']))
      {
$who = htmlentities(trim(strip_tags(mysql_real_escape_string($_GET["who"]))));
	  if(!is_numeric($who))
	  {
header('location:index.php');
exit;
	  }
  }
 $uexist = isuser($uid);

if((islogged($sid)==false)||!$uexist)
    {
     // $pstyle = gettheme($sid);
      echo xhtmlheadchat("wapbies",$pstyle);
      echo "<p align=\"center\">";
	 echo admob();
      echo "<br />You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
	  echo admob();
      echo "<br /></p>";
  echo xhtmlfoot();
      exit();
    }
    
if(isbanned($uid))
    {
      //$pstyle = gettheme($sid);
      echo xhtmlheadchat("wapbies",$pstyle);
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "You are <b>Banned</b><br/>";
      $banto = @mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
	  $banres = @mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
	  
      $remain = $banto[0]- (time() - $timeadjust) ;
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
	  echo "Ban Reason: $banres[0]";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
  echo xhtmlfoot();
      exit();
    }
    $isroom = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_rooms WHERE id='".$rid."'"));
    if($isroom[0]==0)
    {
     // $pstyle = gettheme($sid);
      echo xhtmlheadchat("wapbies",$pstyle);
      echo "<p align=\"center\">";
      echo "This room doesn't exist anymore<br/>";
      echo "Please chat in another room<br/><br/>";
      echo "<a href=\"index.php?action=chat&amp;sid=$sid\">Chatrooms</a>";
      echo "</p>";
      echo xhtmlfoot();
      exit();
    }
    $passworded = @mysql_fetch_array(mysql_query("SELECT pass FROM gyd_rooms WHERE id='".$rid."'"));
    if($passworded[0]!="")
    {
      if($rpw!=$passworded[0] && !isowner(getuid_sid($sid)))
      {
     // $pstyle = gettheme($sid);
      echo xhtmlheadchat("wapbies",$pstyle);
      echo "<p align=\"center\">";
	include('admob.php');
      echo "<br />You can't enter this room<br/>";
      echo "Please stay away<br/><br/>";
      echo "<a href=\"index.php?action=chat&amp;sid=$sid\">Chatrooms</a>";
	  echo admob_request($admob_params);
      echo "<br /></p>";
      echo xhtmlfoot();
      exit();
      }
    }
    if(!canenter($rid,$sid) && !isowner(getuid_sid($sid)))
    {
     // $pstyle = gettheme($sid);
      echo xhtmlheadchat("Chat Menu",$pstyle);
      echo "<p align=\"center\">";
      echo "You can't enter this room<br/>";
      echo "Please stay away<br/><br/>";
      echo "<a href=\"index.php?action=chat&amp;sid=$sid\">Chatrooms</a>";
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
      echo xhtmlfoot();
      exit();
    }
    addtochat($uid, $rid);
        //want to see main menu...
        $timeto = 600;
            $timenw = (time() - $timeadjust);
            $timeout = $timenw-$timeto;
            $deleted = @mysql_query("DELETE FROM gyd_chat WHERE timesent<".$timeout."");
            
        if ($action=="")
                         {
          
        //$pstyle = gettheme($sid);
        echo xhtmlheadchat1("Chat Room",$pstyle,$rid,$sid);
        
         //start of main
         
        echo "<timer value=\"200\"/><p align=\"center\">";
        addonline($uid,"Chatting in the Chat Room","");
		
		//echo admob();
        
        echo "<br /><br /><a href=\"chat.php?action=say&amp;sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">Options</a> / ";
        $time = date('dmHis');
        echo "<a href=\"chat.php?time=$time&amp;sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">Refresh</a>";

        $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        $pmtotl=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE touid='".$uid."'"));
        $unrd="(".$unreadinbox[0]."/".$pmtotl[0].")";
       
      echo "</p>";
	  $unreadinbox=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_private WHERE unread='1' AND touid='".$uid."'"));
        if ($unreadinbox[0]>0)
        {
echo "<br /><p align='center'><a href=\"inbox.php?action=main&amp;sid=$sid\"><font color='red'>You have $unreadinbox[0] new message(s)</font></a></p>";
}
 
        echo "<p align=\"left\">";
            echo "<form action=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\" method=\"post\">";
            echo "<br/><br/>Message:<input name=\"message\" type=\"text\" value=\"\" maxlength=\"255\"/><br/>";
            echo "<input type=\"submit\" value=\"Say\"/>";
            echo "</form>";
            echo "</p>";
			if(isset($_POST['message']))
      {
        $message=trim(htmlentities(strip_tags(stripslashes($_POST["message"]))));
		}
        $who = trim(htmlentities(strip_tags(mysql_real_escape_string($_POST["who"]))));
        $rinfo = @mysql_fetch_array(mysql_query("SELECT censord, freaky FROM gyd_rooms WHERE id='".$rid."'"));
        if (trim($message) != "")
        {
          $nosm = @mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chat WHERE msgtext='".$message."'"));
          if($nosm[0]==0){
            
            $chatok = @mysql_query("INSERT INTO gyd_chat SET  chatter='".$uid."', who='".$who."', timesent='".(time() - $timeadjust)."', msgtext='".$message."', rid='".$rid."';");
            $lstmsg = @mysql_query("UPDATE gyd_rooms SET lastmsg='".(time() - $timeadjust)."' WHERE id='".$rid."'");
            
            $hehe=mysql_fetch_array(mysql_query("SELECT chmsgs FROM gyd_users WHERE id='".$uid."'"));
            $totl = $hehe[0]+1;
            $msgst= @mysql_query("UPDATE gyd_users SET chmsgs='".$totl."' WHERE id='".$uid."'");
            if($rinfo[1]==2)
            {
              //oh damn i gotta post this message to ravebabe :(
              //will it succeed?
              $botid = "c6f6b1059e3602f7";
              $hostname = "www.pandorabots.com";
              $hostpath = "/pandora/talk-xml";
              $sendData = "botid=".$botid."&input=".urlencode($message)."&custid=".$custid;
              
              $result = PostToHost($hostname, $hostpath, $sendData);
              
              $pos = strpos($result, "custid=\"");
              $pos = strpos($result, "<that>");
    	if ($pos === false) {
    		$reply = "";
    	} else {
    		$pos += 6;
    		$endpos = strpos($result, "</that>", $pos);
    		$reply = unhtmlspecialchars2(substr($result, $pos, $endpos - $pos));
    		$reply = mysql_escape_string($reply);
    	}
    	
    	$chatok = @mysql_query("INSERT INTO gyd_chat SET  chatter='8152', who='', timesent='".(time() - $timeadjust)."', msgtext='".$reply." @".getnick_uid($uid)."', rid='".$rid."';");
            }
          }
          $message = "";
            }
            
            echo "<p>";
            $chats = @mysql_query("SELECT chatter, who, timesent, msgtext, exposed FROM gyd_chat WHERE rid='".$rid."' ORDER BY timesent DESC, id DESC");
            $counter=0;

            while($chat = @mysql_fetch_array($chats))
            {
                $canc = true;
               
                
                if($counter<10)
                {
                  if(istrashed($chat[0])){
                        if($uid!=$chat[0])
                        {
                          $canc = false;
                        }
                  }
                //////good
                if(isignored($chat[0],$uid)){
                  $canc = false;
                }
                //////////good
                if($chat[0]!=$uid)
                {
                  if($chat[1]!=0)
                  {
                    if($chat[1]!=$uid)
                    {
                      $canc = false;
                    }
                  }
                }
                if($chat[4]=='1' && ismod($uid))
                {
                  $canc = true;
                }
                if($canc)
                {
                   $cmid = @mysql_fetch_array(mysql_query("SELECT  chmood FROM gyd_users WHERE id='".$chat[0]."'"));
                   
                   $iml = "";
                if(($cmid[0]!=0))
                {
                  $mlnk = @mysql_fetch_array(mysql_query("SELECT img, text FROM gyd_moods WHERE id='".$cmid[0]."'"));
                  $iml = "<img src=\"$mlnk[0]\" alt=\"$mlnk[1]\"/>";

                }
                  $chnick = getnick_uid($chat[0]);
                    $optlink = $iml.$chnick;
                  if(($chat[1]!=0)&&($chat[0]==$uid))
                  {
                    ///out
                    $iml = "<img src=\"moods/out.gif\" alt=\"!\"/>";
                    $chnick = getnick_uid($chat[1]);
                    $optlink = $iml."PM to ".$chnick;
                  }
                  if($chat[1]==$uid)
                  {
                    ///out
                    $iml = "<img src=\"moods/in.gif\" alt=\"!\"/>";
                    $chnick = getnick_uid($chat[0]);
                    $optlink = $iml."PM by ".$chnick;
                  }
                    if($chat[4]=='1')
                  {
                    ///out
                    $iml = "<img src=\"moods/point.gif\" alt=\"!\"/>";
                    $chnick = getnick_uid($chat[0]);
                    $tonick = getnick_uid($chat[1]);
                    $optlink = "$iml by ".$chnick." to ".$tonick;
                  }
                  
                  $ds= date("H.i.s", $chat[2]);
                  $text = parsepm($chat[3], $sid);
                  $nos = substr_count($text,"<img src=");
                  if(isspam($text) || isblocked($text) || newisblocked($text) && !isadmin(getuid_sid($sid)))
                  {
                    $chnick = getnick_uid($chat[0]);
                    echo "<b>Warning!:&#187;<i>$chnick, you may get banned for spamming*</i></b><br/>";
					
                  }
                  else if($nos>10){
                    $chnick = getnick_uid($chat[0]);
                    echo "<b>Warning:&#187;<i>$chnick, you can only use ten smilies per message*</i></b><br/>";
                  }else{
                    $sres = substr($chat[3],0,3);
                    
                    if($sres == "/me")
                    {
                        $chco = strlen($chat[3]);
                        $goto = $chco - 3;
                        $rest = substr($chat[3],3,$goto);
                        $tosay = parsepm($rest, $sid);
                        
                        echo "<b><i>*$chnick $tosay*</i></b><br/>";
                    }else{
                      
                      $tosay = parsepm($chat[3], $sid);
                      
                      if($rinfo[0]==1)
                      {
                        
						 $tosay = str_replace("arawap.net","*********",$tosay);
						 $tosay = str_replace("wap.net.ph","*******",$tosay);
					    $tosay = str_replace("9jawap","*********",$tosay);
						 $tosay = str_replace("dotcom","*******",$tosay);
						 
						 	
                         $tosay = str_replace("muf.mobi","*********",$tosay);
						 $tosay = str_replace("oslive.","*******",$tosay);
						 $tosay = str_replace("dotcom","*******",$tosay);
						 $tosay = str_replace("dot","*******",$tosay);

							
					   }
                      
                      if($rinfo[1]==1)
                      {
                          $tosay = htmlspecialchars($chat[3]);
                          $tosay = strrev($tosay);
                        }
                  echo "<a href=\"chat.php?action=say2&amp;sid=$sid&amp;who=$chat[0]&amp;rid=$rid&amp;rpw=$rpw\">$optlink</a>&#187;$ds<br/>";
                  echo $tosay."<br/>";
                  }
                }
               
                  $counter++;
                }
                }
            }
            echo "</p>";
        /*
        echo "<p align=\"center\">";
            echo "<form action=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\" method=\"post\">";
            echo "<br/><br/>Message:<input name=\"message\" type=\"text\" value=\"\" maxlength=\"255\"/><br/>";
            echo "<input type=\"submit\" value=\"Say\"/>";
            echo "</form>";
            echo "</p>";
*/
            echo "<p align=\"center\">";
        $inside=mysql_query("SELECT DISTINCT * FROM gyd_chonline WHERE rid='".$rid."' and uid IS NOT NULL");
        
        while($ins=mysql_fetch_array($inside))
        {
          $unick = getnick_uid($ins[1]);
          $userl = "<small><i><a href=\"chat.php?action=say2&amp;sid=$sid&amp;who=$ins[1]&amp;rid=$rid&amp;rpw=$rpw\">$unick</a></i></small>";
          echo " | $userl ";
        }
        $chatters=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gyd_chonline where rid='".$rid."'"));
       // echo "<br/><a href=\"chat.php?action=inside&amp;sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">Who's Inside($chatters[0])</a><br/>";
        echo "<br/><br/><a href=\"index.php?action=chat&amp;sid=$sid\">Swap Room</a><br/>";
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
	 echo "<h3>";
	 echo "wapbies.com &#0169; 2009 - All Right Reserved";
	 echo "</h3>";
	 
      echo xhtmlfoot();
	  exit();
}
/////////////////////////////////////////////////////SAY
        else if ($action=="say")                   {
        //$pstyle = gettheme($sid);
      echo xhtmlheadchat("wapbies",$pstyle);
        
        addonline($uid,"Writing Chat Message","");
       
 			echo "<p align=\"center\">";
        
            echo "<form action=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\" method=\"post\">";
            echo "Message:<input name=\"message\" type=\"text\" value=\"\" maxlength=\"255\"/><br/>";
            echo "<input type=\"submit\" value=\"Say\"/>";
            echo "</form>";
            

            
            echo "<a href=\"lists.php?action=chmood&amp;sid=$sid&amp;page=1\">&#187;Chat mood</a><br/>";
            //echo "<small><a href=\"chat.php?action=inside&amp;sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#187;Who's Inside</a></small><br/>";
            echo "<a href=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#171;Back to Chatroom</a></p>";
        //end
        
        echo "<p align=\"center\"><a href=\"index.php?action=chat&amp;sid=$sid\"><img src=\"images/chat.gif\" alt=\"*\"/>Swap Rooms</a><br/>";
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
	 
      echo xhtmlfoot();
	  exit();
        		}
				                
        ////////////////////////////////////////////
    /////////////////////////////////////////////////////SAY2
        else if ($action=="say2") 
                          {
        //$pstyle = gettheme($sid);
        echo xhtmlheadchat("wapbies",$pstyle);
        echo "<p align=\"center\">";
        $unick = getnick_uid($who);
        
        echo "<b>Private chat to $unick</b>";
        echo "</p>";
        
        addonline($uid,"Writing private chat message","");
        
            echo "<form action=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\" method=\"post\">";
            echo "<p>Message:<input name=\"message\" type=\"text\" value=\" \" maxlength=\"255\"/><br/>";
            echo "<input type=\"submit\" value=\"Say\"/>";
            echo "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
            echo "</form>";
            
            echo "<br/>";
            echo "<a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$who\">&#187;View $unick's Profile</a><br/>";
            echo "<a href=\"chat.php?action=expose&amp;sid=$sid&amp;who=$who&amp;rid=$rid&amp;rpw=$rpw\">&#187;Expose $unick</a><br/>";
            
            //echo "<small><a href=\"chat.php?action=inside&amp;sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#187;Who's Inside</a></small><br/>";
            echo "<a href=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#171;Back to Chatroom</a></p>";
        //end
        echo "<p align=\"center\"><br/><br/><a href=\"index.php?action=chat&amp;sid=$sid\"><img src=\"images/chat.gif\" alt=\"*\"/> Swap Room</a><br/>";

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
	 
      echo xhtmlfoot();
	  exit();
                                               }
        ////////////////////////////////////////////
        //////////////////////////////inside//////////
        else if ($action=="inside")           {
          
          addonline($uid,"Checking Users Inside Chat Room","");
        //$pstyle = gettheme($sid);
      echo xhtmlheadchat("Inside List",$pstyle);
        echo "<p align=\"center\"><br/>";
        $inside=mysql_query("SELECT DISTINCT * FROM gyd_chonline WHERE rid='".$rid."' and uid IS NOT NULL");
        
        while($ins=mysql_fetch_array($inside))
        {
          $unick = getnick_uid($ins[1]);
          $userl = "<small><a href=\"chat.php?action=say2&amp;sid=$sid&amp;who=$ins[1]&amp;rid=$rid&amp;rpw=$rpw\">$unick</a>, </small>";
          echo "$userl";
        }
        echo "<br/><br/>";
        echo "<a href=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#171;Chatroom</a><br/>";
        echo "<br/><a href=\"index.php?action=chat&amp;sid=$sid\"><img src=\"images/chat.gif\" alt=\"*\"/>Chatrooms</a><br/>";
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
	 
      echo xhtmlfoot();
	  exit();
                                           }
        else if ($action=="expose")           {
$unick = getnick_uid($who);
        addonline($uid,"Exposing $unick chat msg to staffs","");
        echo "<p align=\"center\"><br/>";
        mysql_query("UPDATE gyd_chat SET exposed='1' WHERE chatter='".$who."' AND who='".$uid."'");
        echo "$unick messages to you are exposed to staffs";
        echo "<br/><br/>";
        echo "<a href=\"chat.php?sid=$sid&amp;rid=$rid&amp;rpw=$rpw\">&#171;Chatroom</a><br/>";
        echo "<br/><a href=\"index.php?action=chat&amp;sid=$sid\"><img src=\"images/chat.gif\" alt=\"*\"/>Chatrooms</a><br/>";
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
	 
      echo xhtmlfoot();
	  exit();
                                           }
        
 else{
    addonline(getuid_sid($sid),"Lost in chat room.","");
    
  echo "<p align=\"center\">";
 include('admob.php');
  echo "<br />page not found<br/><br/>";
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
}
echo "</body>";
	echo "</html>"; 
exit();	
?>