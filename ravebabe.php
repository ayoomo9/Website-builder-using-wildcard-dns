<?php include_once('antif.php');?>
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
//check_injection();
check_browser();

check_method();
check_query();
//session_start();
include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head>
<!--Scroll Bar script -->

<style>
<!-- 
body {scrollbar-face-color: #C1DD85; scrollbar-shadow-color: #3300FF; scrollbar-highlight-color: #3399FF; scrollbar-3dlight-color: #CCFFFF; scrollbar-darkshadow-color: #000000; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #FFFFFF;}
}
// -->
</style>

<title>wapbies Online Bot</title>";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"wapbies :)\"> 
<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
echo "<body>";

connectdb();

        
        //clearnc();
$action=$_GET["action"];
$id=$_GET["id"];
$sid = $_GET["sid"];
$botid = "eeb070e74e366473";
$input = $_POST["input"];
$custid=$_POST["custid"];
$hostname = "www.pandorabots.com";
$hostpath = "/pandora/talk-xml";
if(islogged($sid)==false)
    {
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
    $uid = getuid_sid($sid);
    if(isbanned($uid))
    {
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "You are <b>Banned</b><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto FROM gyd_pur WHERE uid='".$uid."' AND penalty='1'"));
      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "Time to finish your penalty: $rmsg<br/><br/>";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }


                
        echo "<p align=\"center\">";
        echo "<br/>";
        
        
        addonline(getuid_sid($sid),"Chatting with wapbies kokolet","");
    if ($input!="")
    {

        $sendData = "botid=".$botid."&input=".urlencode($input)."&custid=".$custid;
    	// Send the request to Pandorabot
    	$result = PostToHost($hostname, $hostpath, $sendData);
    	//TODO: Process the returned XML as an XML document instead of a big string.
    	// Use string manipulations to pull out the 'custid' and 'that' values.
    	$pos = strpos($result, "custid=\"");

    	// Extract the custid
    	if ($pos === false) {
    		$custid = "";
    	} else {
    		$pos += 8;
    		$endpos = strpos($result, "\"", $pos);
    		$custid = substr($result, $pos, $endpos - $pos);
    	}
    	// Extrat <that> - this is the reply from the Pandorabot
    	$pos = strpos($result, "<that>");
    	if ($pos === false) {
    		$reply = "";
    	} else {
    		$pos += 6;
    		$endpos = strpos($result, "</that>", $pos);
    		$reply = unhtmlspecialchars(substr($result, $pos, $endpos - $pos));
    	}

        //echo htmlspecialchars( $reply);
        $hers = $reply;
        $hers = parsemsg($hers);
             $input=htmlspecialchars($input);
             $nick = getnick_uid($uid);
             echo "<br/><b>$nick: </b>$input<br/>";
             echo "<b>kokolet: </b>$hers<br/>";
            echo "<form align=\"left\" action=\"ravebabe.php?sid=$sid\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
            echo "<br/><input type=\"text\" name=\"input\" maxlength=\"120\" value=\"$input\"/><anchor>";
        	echo "<postfield name=\"input\" value=\"$(input)\"/>";
		echo "<postfield name=\"custid\" value=\"$custid\"/>";
		echo "<input type=\"submit\" value=\"Say\"/><br/>";
            echo "</form>";

    }else{
      echo "Hello, now you can chat with the most intelligent robot girl o this site<br/> her name is wapbies robot a.k.a kokolet, have fun<br/>";
      echo "<form align=\"left\" action=\"ravebabe.php?sid=$sid\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
            echo "<br/><input type=\"text\" name=\"input\" maxlength=\"120\" value=\"$input\"/><anchor>";
        	echo "<postfield name=\"input\" value=\"$(input)\"/>";
		echo "<postfield name=\"custid\" value=\"$custid\"/>";
		echo "<input type=\"submit\" value=\"Say\"/><br/>";
            echo "</form>";

    }
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

function unhtmlspecialchars( $string )
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

?>
</html>
