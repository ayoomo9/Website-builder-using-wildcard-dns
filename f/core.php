<?php





include("config.php");
//include("gmprc.php");
//session_start();
if(!get_magic_quotes_gpc())
{
$_GET = array_map('trim', $_GET);
$_POST = array_map('trim', $_POST);
$_COOKIE = array_map('trim', $_COOKIE);

$_GET = array_map('addslashes', $_GET);
$_POST = array_map('addslashes', $_POST);
$_COOKIE = array_map('addslashes', $_COOKIE);
}

///////////////////////PREVENT MINOR COOKIE STEALER ATTACKS//////////////////////////////////////////////////
function delhtml($str) {
return htmlentities($str);
}

if(isset($_GET)){foreach($_GET as $key=>$value){$_GET[$key]=delhtml($value);}}
if(isset($_POST)){foreach($_POST as $key=>$value){$_POST[$key]=delhtml($value);}}
if(isset($_SESSION)){foreach($_SESSION as $key=>$value){$_SESSION[$key]=delhtml($value);}}
if(isset($_COOKIE)){foreach($_COOKIE as $key=>$value){$_COOKIE[$key]=delhtml($value);}}
////////////////////////CODE ENDS HERE////////////////////////////////////////////////////////////////////////


function block_attacks()
{

$s = $_SERVER['QUERY_STRING'];


if (eregi("ftp:|select|concat|html|xhtml|wml|<?|?>|access_log|Qalias|phf?|REQUEST",$s)

or eregi("declare|php|txt|javascript|script|system($_GET[c])|dumpfile|outputfile",$s)

or eregi("href=|root|.vti|exec(|../..%5C|#|convert|char|null|apache|0x3a|antichat",$s)

or eregi("where|1=1|rtp:|from|order|///|void|plusses=|shutdown|config.php",$s)

or eregi("table|database|union|meta|update|;|gyd|count|fetch|perm=|encode|iframe",$s)

or eregi("drop|delete from|insert|truncate|alter|http|judyellingsen.com|load_file",$s)

or eregi("mysql|apend|replace|`|'|http|cmd|htaccess|readfile|shell|safe0ver|load data infile",$s)

or eregi("%2e|%27|--|%2d%2d|chr(0x27)|www|string|%00|???|varchar|havin|benchmark|GLOBALS",$s)

or eregi(".php//|cgi|bin|htpasswd|,|passwd|decode|session|lock tables|%3C?",$s)


)



 {

$sid = $_GET["sid"];

  $user = getnick_sid($sid);

$ip = $_SERVER['REMOTE_ADDR'];
$br = $_SERVER['HTTP_USER_AGENT'];

mysql_query("INSERT INTO olu_mlog SET action='RFI Attempt', details=' A user called $user using ip $ip and browser $br was trying to hack the site by using this query string $s', actdt='".time()."'");

  header('location:http://go-suck-your-father-dot.com');
  exit();
}


}
################END OF THE QUERY CODE###################################

function check_method()
{



if($_SERVER['REQUEST_METHOD']!=GET && $_SERVER['REQUEST_METHOD']!=SESSION && $_SERVER['REQUEST_METHOD']!=COOKIE && $_SERVER['REQUEST_METHOD']!=POST)
{
die('Go back');

}

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
function getnewgml($uid)
{
  /*
    global $onver;
    if($onver)
    {
        $doit = false;
        $gmi = mysql_fetch_array(mysql_query("SELECT gmailun, gmailpw, gmailchk, gmaillch, timezone FROM olu_xinfo WHERE uid='".$uid."'"));
        $cancheck = $gmi[2]*60;
        $cancheck += $gmi[3];
        if(time()>=$cancheck)
        {
          $doit = true;
        }
        if(trim($gmi[0])!="" && trim($gmi[1])!="")
        {
          $doit = true;
        }
        if ($doit)
        {
          if($cancheck+60>time())
          {
            mysql_query("UPDATE olu_xinfo SET gmaillch='".time()."' WHERE uid='".$uid."'");
          }
            return getnewm($gmi[0],$gmi[1],$gmi[4]);

        }
        return 0;
        
    }else{
      return 0;
    }
  */
}
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
  return "$texth<br/><img src=\"pmcard.php?cid=$cid&amp;msg=$msg\" alt=\"../$cid\"/><br/>$textf";
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
  
  $res = mysql_fetch_array(mysql_query("SELECT id FROM olu_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
  if($res[0]>0)
  {
    return $res[0];
  }
  mysql_query("INSERT INTO olu_search SET svar1='".$svar1."', svar2='".$svar2."', svar3='".$svar3."', svar4='".$svar4."', svar5='".$svar5."', stime='".time()."'");
  $res = mysql_fetch_array(mysql_query("SELECT id FROM olu_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
  return $res[0];
}

function candelvl($uid, $item)
{
  $candoit = mysql_fetch_array(mysql_query("SELECT  uid FROM olu_vault WHERE id='".$item."'"));
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
  $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_blogs WHERE bowner='".$uid."'"));
  if($noi[0]>=5)
  {
    $pnts = 5;
  }else{
    $pnts = $noi[0];
  }
  $noi = mysql_fetch_array(mysql_query("SELECT regdate, plusses, chmsgs FROM olu_users WHERE id='".$uid."'"));
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
  $cus = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_users WHERE id='".$uid."'"));
  if($cus[0]>0)
  {
    return true;
  }
  return false;
}
////////////////////////////////////////////Can access forum

function canaccess($uid, $fid)
{
  $fex = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_forums WHERE id='".$fid."'"));
  if($fex[0]==0)
  {
    return false;
  }
  $persc = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_acc WHERE fid='".$fid."'"));
  if($persc[0]==0)
  {
    $clid = mysql_fetch_array(mysql_query("SELECT clubid FROM olu_forums WHERE id='".$fid."'"));
    if($clid[0]==0)
    {
      return true;
    }else{
      if(ismod($uid))
      {
        return true;
      }else{
        $ismm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_clubmembers WHERE uid='".$uid."' AND clid='".$clid[0]."'"));
        if($ismm[0]>0)
        {
          return true;
        }else{
          return false;
        }
      }
    }
    
  }else{
    $gid = mysql_fetch_array(mysql_query("SELECT gid FROM olu_acc WHERE fid='".$fid."'"));
    $gid = $gid[0];
    $ginfo = mysql_fetch_array(mysql_query("SELECT autoass, mage, userst, posts, plusses FROM olu_groups WHERE id='".$gid."'"));
    if($ginfo[0]=="1")
    {
      $uperms = mysql_fetch_array(mysql_query("SELECT birthday, perm, posts, plusses FROM olu_users WHERE id='".$uid."'"));

      if($ginfo[2]==2)
      {
        
        if(isadmin($uid))
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
  $uage = mysql_fetch_array(mysql_query("SELECT birthday FROM olu_users WHERE id='".$uid."'"));
  return getage($uage[0]);
}

function canenter($rid, $sid)
{
    $rperm = mysql_fetch_array(mysql_query("SELECT mage, perms, chposts, clubid FROM olu_rooms WHERE id='".$rid."'"));
    $uperm = mysql_fetch_array(mysql_query("SELECT birthday, chmsgs FROM olu_users WHERE id='".getuid_sid($sid)."'"));
    if($rperm[3]!=0)
    {
      if(ismod(getuid_sid($sid)))
      {
        return true;
      }else{
        $ismm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_clubmembers WHERE uid='".getuid_sid($sid)."' AND clid='".$rperm[3]."'"));
        if($ismm[0]>0)
        {
          return true;
        }else{
          return false;
        }
      }
    }
    if($rperm[1]==1)
    {
      return ismod(getuid_sid($sid));
    }
    if($rperm[1]==2)
    {
      return isadmin(getuid_sid($sid));
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
  $exec = mysql_query("DELETE FROM olu_chonline WHERE lton<'".$timeout."'");
  $timeto = 300;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = mysql_query("DELETE FROM olu_chat WHERE timesent<'".$timeout."'");
  $timeto = 60*60;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = mysql_query("DELETE FROM olu_search WHERE stime<'".$timeout."'");
  
  ///delete expired rooms
  $timeto = 5*60;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $rooms = mysql_query("SELECT id FROM olu_rooms WHERE static='0' AND lastmsg<'".$timeout."'");
  while ($room=mysql_fetch_array($rooms))
  {
    $ppl = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_chonline WHERE rid='".$room[0]."'"));
    if($ppl[0]==0)
    {
        $exec = mysql_query("DELETE FROM olu_rooms WHERE id='".$room[0]."'");
    }
  }
  $lbpm = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='lastbpm'"));
  $td = date("Y-m-d");
  //echo $lbpm[0];
  
  if ($td!=$lbpm[0])
  {
	//echo "boo";
	$sql = "SELECT id, name, birthday  FROM olu_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate())";
	$ppl = mysql_query($sql);
	while($mem = mysql_fetch_array($ppl))
	{
		$msg = "[card=008]to you $mem[1]"."[/card] chatheaven team wish you a day full of joy and happiness and many happy returns[br/]*fireworks*[br/][small][i]p.s: this is an automated pm[/i][/small]";
		autopm($msg, $mem[0]);
	}
	mysql_query("UPDATE olu_settings SET value='".$td."' WHERE name='lastbpm'");
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
        return "<img src=\"../images/image.gif\" alt=\"image\"/>";
        break;
      case "zip":
      case "rar":
        return "<img src=\"../images/pack.gif\" alt=\"package\"/>";
        break;
      case "amr":
      case "wav":
      case "mp3":
        return "<img src=\"../images/music.gif\" alt=\"music\"/>";
        break;
      case "mpg":
      case "3gp":
        return "<img src=\"../images/video.gif\" alt=\"video\"/>";
        break;
      default:
        return "<img src=\"../images/other.gif\" alt=\"!\"/>";
        break;
    }
}

///////////////////////////////////////Add to chat

function addtochat($uid, $rid)
{
  $timeto = 120;
  $timenw = time();
  $timeout = $timenw - $timeto;
  $exec = mysql_query("DELETE FROM olu_chonline WHERE lton<'".$timeout."'");
  $res = mysql_query("INSERT INTO olu_chonline SET lton='".time()."', uid='".$uid."', rid='".$rid."'");
  if(!$res)
  {
    mysql_query("UPDATE olu_chonline SET lton='".time()."', rid='".$rid."' WHERE uid='".$uid."'");
  }
}
////////////////////////////////////////////is mod

function ismod($uid)
{
  $perm = mysql_fetch_array(mysql_query("SELECT perm FROM olu_users WHERE id='".$uid."'"));
  
  if($perm[0]>0)
  {
    return true;
  }
}

////////////////////////////////////////////is mod

function candelgb($uid,$mid)
{
  $minfo = mysql_fetch_array(mysql_query("SELECT gbowner, gbsigner FROM olu_gbook WHERE id='".$mid."'"));
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
  $sfil[0] = "www.";
  $sfil[1] = "http:";
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
  
  $posts = mysql_query("SELECT id FROM olu_posts WHERE tid='".$tid."'");
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
  $nops = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_posts WHERE tid='".$tid."'"));
  $nops = $nops[0]+1; //where did the 1 come from? the topic text, duh!
  $nopg = ceil($nops/5); //5 is the posts to show in each page
  return $nopg;
}
////////////////////////////////////////////can delete a blog?

function candelbl($uid,$bid)
{
  $minfo = mysql_fetch_array(mysql_query("SELECT bowner FROM olu_blogs WHERE id='".$bid."'"));
  if(ismod($uid))
  {
    return true;
  }
  if($minfo[0]==$uid)
  {
    return true;
  }
  
  return false;
}

//////////////////////////////////////////////////RAVEBABE
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
    $plus = mysql_fetch_array(mysql_query("SELECT plusses FROM olu_users WHERE id='".$uid."'"));
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
  if(getplusses($uid)>=75)
  {
    return true;
  }
  return false;
}
/////////////////////////////////////////////Are buds?

function arebuds($uid, $tid)
{
    $res = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='1'"));
    if($res[0]>0)
    {
      return true;
    }
    return false;
}

//////////////////////////////////function get n. of buds

function getnbuds($uid)
{
  $notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
  return $notb[0];
}

/////////////////////////////get no. of requists

function getnreqs($uid)
{
  $notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE  tid='".$uid."' AND agreed='0'"));
  return $notb[0];
}


/////////////////////////////get no. of online buds

function getonbuds($uid)
{
  $counter =0;
    $buds = mysql_query("SELECT uid, tid FROM olu_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'");
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
  $shbox = "<small>";
  $shbox .= "<b>ShoutBox</b><br/>";
  $lshout = mysql_fetch_array(mysql_query("SELECT shout, shouter, id  FROM olu_shouts ORDER BY shtime DESC LIMIT 1"));
  $shnick = getnick_uid($lshout[1]);
  $shout = parsemsg($lshout[0],$sid);
  $shbox .= "<i><a href=\"index.php?action=viewuser&amp;sid=$sid&amp;who=$lshout[1]\">".$shnick."</a></i>: ";
  $shbox .= "$shout";
  $shbox .= "<br/>";
  $shbox .= "<a href=\"lists.php?action=shouts&amp;sid=$sid\">more</a>, ";
  $shbox .= "<a href=\"index.php?action=shout&amp;sid=$sid\">shout</a>";
  if (ismod(getuid_sid($sid)))
  {
    $shbox .= ", <a href=\"modproc.php?action=delsh&amp;sid=$sid&amp;shid=$lshout[2]\">delete</a>";
  }
  //$shbox .= "<br/>";
  $shbox .= "</small>";
  return $shbox;
}
/////////////////////////////////////////////get tid frm post id

function gettid_pid($pid)
{
  $tid = mysql_fetch_array(mysql_query("SELECT tid FROM olu_posts WHERE id='".$pid."'"));
  return $tid[0];
}

///////////////////////////////////////////is trashed?

function istrashed($uid)
{
  $del = mysql_query("DELETE FROM olu_penalties WHERE timeto<'".time()."'");
  $not = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_penalties WHERE uid='".$uid."' AND penalty='0'"));
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
  $not = mysql_fetch_array(mysql_query("SELECT shield FROM olu_users WHERE id='".$uid."'"));
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
  $not = mysql_fetch_array(mysql_query("SELECT ipadd FROM olu_users WHERE id='".$uid."'"));
  return $not[0];
  
}

///////////////////////////////////////////Get Browser

function getbr_uid($uid)
{
  $not = mysql_fetch_array(mysql_query("SELECT browserm FROM olu_users WHERE id='".$uid."'"));
  return $not[0];

}

///////////////////////////////////////////is trashed?

function isbanned($uid)
{
  $del = mysql_query("DELETE FROM olu_penalties WHERE timeto<'".time()."'");
  $not = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_penalties WHERE uid='".$uid."' AND (penalty='1' OR penalty='2')"));
 
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
  $tid = mysql_fetch_array(mysql_query("SELECT name FROM olu_topics WHERE id='".$tid."'"));
  return $tid[0];
}

/////////////////////////////////////////////get tid frm post id

function getfid_tid($tid)
{
  $fid = mysql_fetch_array(mysql_query("SELECT fid FROM olu_topics WHERE id='".$tid."'"));
  return $fid[0];
}

/////////////////////////////////////////////is ip banned

function isipbanned($ipa, $brm)
{
  
  $pinf = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_penalties WHERE penalty='2' AND ipadd='".$ipa."' AND browserm='".$brm."'"));
  if($pinf[0]>0)
  {
  return true;
}
return false;
}

////////////////get number of pinned topics in forum 

function getpinned($fid)
{
  $nop = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_topics WHERE fid='".$fid."' AND pinned ='1'"));
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
  $req = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='0'"));
  if($req[0]>0)
  {
    return 1;
  }
  $notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE (uid='".$tid."' OR tid='".$tid."') AND agreed='1'"));
  global $max_buds;
  if($notb[0]>=$max_buds)
  {
    
    return 3;
  }
  $notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
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
   $getdata = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='sesexp'"));
   return $getdata[0];
}

////////////////////////////////////////////Get bud msg

function getbudmsg($uid)
{
   $getdata = mysql_fetch_array(mysql_query("SELECT budmsg FROM olu_users WHERE id='".$uid."'"));
   return $getdata[0];
}

////////////////////////////////////////////Get forum name

function getfname($fid)
{
  $fname = mysql_fetch_array(mysql_query("SELECT name FROM olu_forums WHERE id='".$fid."'"));
  return $fname[0];
}
////////////////////////////////////////////PM antiflood time

function getpmaf()
{
   $getdata = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='pmaf'"));
   return $getdata[0];
}

////////////////////////////////////////////PM antiflood time

function getfview()
{
   $getdata = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='fview'"));
   return $getdata[0];
}

////////////////////////////////////////////get forum message

function getfmsg()
{
   $getdata = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='4ummsg'"));
   return $getdata[0];
}

//////////////////////////////////////////////is online

function isonline($uid)
{
  $uon = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_online WHERE userid='".$uid."'"));
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
   $getreg = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='reg'"));
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
  $fid = mysql_fetch_array(mysql_query("SELECT fid FROM olu_topics WHERE id='".$topicid."'"));
  return $fid[0];
}
////////////////////////////////////////////Parse PM
////anti spam
function parsepm($text, $sid="")
{
  $text = htmlspecialchars($text);
  $sml = mysql_fetch_array(mysql_query("SELECT hvia FROM olu_users WHERE id='".getuid_sid($sid)."'"));
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
  $text = htmlspecialchars($text);
  $sml = mysql_fetch_array(mysql_query("SELECT hvia FROM olu_users WHERE id='".getuid_sid($sid)."'"));
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
  if(ismod($sender))
  {
    return false;
  }
  $str = str_replace(" ","",$str);
  $sites[0] = "chillinlounge.co.uk";
  $sites[1] = "psycho.wen.ru";
  $sites[2] = "xcile.com";
  $sites[3] = "wickedwap.net";
  $sites[4] = "mobilelife.tk";
  $sites[5] = ".trap17.com";
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
  $strd = mysql_fetch_array(mysql_query("SELECT starred FROM olu_private WHERE id='".$pmid."'"));
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

  $deloldses = mysql_query("DELETE FROM olu_ses WHERE expiretm<'".time()."'");
  //does sessions exist?
  $sesx = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_ses WHERE id='".$sid."'"));

  if($sesx[0]>0)
  {
    if(!isuser(getuid_sid($sid)))
{
  return false;
}
    //yip it's logged in
    //first extend its session expirement time
    $xtm = time() + (60*getsxtm());
    $extxtm = mysql_query("UPDATE olu_ses SET expiretm='".$xtm."' WHERE id='".$sid."'");
    return true;
  }else{
    //nope its session must be expired or something
    return false;
  }
}

////////////////////////Get user nick from session id

function getnick_sid($sid)
{
  $uid = mysql_fetch_array(mysql_query("SELECT uid FROM olu_ses WHERE id='".$sid."'"));
  $uid = $uid[0];
  return getnick_uid($uid);
}

////////////////////////Get user id from session id

function getuid_sid($sid)
{
  $uid = mysql_fetch_array(mysql_query("SELECT uid FROM olu_ses WHERE id='".$sid."'"));
  $uid = $uid[0];
  return $uid;
}

/////////////////////Get total number of pms

function getpmcount($uid,$view="all")
{
  if($view=="all"){
    $nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_private WHERE touid='".$uid."'"));
    }else if($view =="snt")
    {
        $nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_private WHERE byuid='".$uid."'"));
    }else if($view =="str")
    {
        $nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_private WHERE touid='".$uid."' AND starred='1'"));
    }else if($view =="urd")
    {
        $nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_private WHERE touid='".$uid."' AND unread='1'"));
    }
    return $nopm[0];
}

function deleteClub($clid)
{
    $fid = mysql_fetch_array(mysql_query("SELECT id FROM olu_forums WHERE clubid='".$clid."'"));
    $fid = $fid[0];
    $topics = mysql_query("SELECT id FROM olu_topics WHERE fid=".$fid."");
    while($topic = mysql_fetch_array($topics))
    {
      mysql_query("DELETE FROM olu_posts WHERE tid='".$topic[0]."'");
    }
    mysql_query("DELETE FROM olu_topics WHERE fid='".$fid."'");
    mysql_query("DELETE FROM olu_forums WHERE id='".$fid."'");
    mysql_query("DELETE FROM olu_rooms WHERE clubid='".$clid."'");
    mysql_query("DELETE FROM olu_clubmembers WHERE clid='".$clid."'");
    mysql_query("DELETE FROM olu_announcements WHERE clid='".$clid."'");
    mysql_query("DELETE FROM olu_clubs WHERE id=".$clid."");
    return true;
}

function deleteMClubs($uid)
{
  $uclubs = mysql_query("SELECT id FROM olu_clubs WHERE owner='".$uid."'");
  while($uclub=mysql_fetch_array($uclubs))
  {
    deleteClub($uclub[0]);
  }
}
//////////////////////Function add user to online list :P

function addonline($uid,$place,$plclink)
{
  /////delete inactive users
  $tm = time();
  $timeout = $tm - 420; //time out = 5 minutes
  $deloff = mysql_query("DELETE FROM olu_online WHERE actvtime <'".$timeout."'");
  ///now try to add user to online list
  $res = mysql_query("UPDATE olu_users SET lastact='".time()."' WHERE id='".$uid."'");
  $res = mysql_query("INSERT INTO olu_online SET userid='".$uid."', actvtime='".$tm."', place='".$place."', placedet='".$plclink."'");
  if(!$res)
  {
    //most probably userid already in the online list
    //so just update the place and time
    $res = mysql_query("UPDATE olu_online SET actvtime='".$tm."', place='".$place."', placedet='".$plclink."' WHERE userid='".$uid."'");
    
    
  }
  $maxmem=mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE id='2'"));
  
            $result = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_online"));

          if($result[0]>=$maxmem[0])
          {
            $tnow = date("D d M Y - H:i");
            mysql_query("UPDATE olu_settings set name='".$tnow."', value='".$result[0]."' WHERE id='2'");
          }
          $maxtoday = mysql_fetch_array(mysql_query("SELECT ppl FROM olu_mpot WHERE ddt='".date("d m y")."'"));
          if($maxtoday[0]==0||$maxtoday=="")
          {
            mysql_query("INSERT INTO olu_mpot SET ddt='".date("d m y")."', ppl='1', dtm='".date("H:i:s")."'");
            $maxtoday[0]=1;
          }
          if($result[0]>=$maxtoday[0])
          {
            mysql_query("UPDATE olu_mpot SET ppl='".$result[0]."', dtm='".date("H:i:s")."' WHERE ddt='".date("d m y")."'");
          }
}

/////////////////////Get members online

function getnumonline()
{
    $nouo = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_online "));
    return $nouo[0];
}

//////////////////////////////////////is ignored

function isignored($tid, $uid)
{
  $ign = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_ignore WHERE target='".$tid."' AND name='".$uid."'"));
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
  if(ismod($tid))
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

function getavatar($uid)
{
  $av = mysql_fetch_array(mysql_query("SELECT avatar FROM olu_users WHERE id='".$uid."'"));
  return $av[0];
}

/////////////////////////////////////////Can see details?

function cansee($uid, $tid)
{
  if($uid==$tid)
  {
    return true;
  }
  if(ismod($uid))
  {
    return true;
  }
  return false;
}

//////////////////////////gettimemsg

function gettimemsg($sec)
{
  $ds = floor($sec/60/60/24);
  if($ds > 0)
  {
    return "$ds days";
  }
  $hs = floor($sec/60/60);
  if($hs > 0)
  {
    return "$hs hours";
  }
  $ms = floor($sec/60);
  if($ms > 0)
  {
    return "$ms minutes";
  }
  return "$sec Seconds";
}
/////////////////////////////////////////get status

function getstatus($uid)
{
  $info= mysql_fetch_array(mysql_query("SELECT perm, plusses FROM olu_users WHERE id='".$uid."'"));
  if(isbanned($uid))
  {
    return "BANNED!";
  }
  if($info[0]=='2')
  {
    return "Administrator!";
  }else if($info[0]=='1')
  {
    return "Moderator!";
  }else{
    if($info[1]<10)
    {
      return "N00b";
    }else if($info[1]<25)
    {
        return "SpaRkl3";
    }else if($info[1]<50)
    {
        return "flaR3";
    }else if($info[1]<75)
    {
        return "flaM3";
    }else if($info[1]<250)
    {
        return "buRst";
    }else if($info[1]<500)
    {
        return "ViTa1";
    }else if($info[1]<750)
    {
        return "Lava unplugged";
    }else if($info[1]<1000)
    {
        return "GuRu";
    }else if($info[1]<1500)
    {
        return "V.I.P";
    }else if($info[1]<2000)
    {
        return "FaNatic";
    }else if($info[1]<2500)
    {
        return "Lava KNight";
    }else if($info[1]<3000)
    {
        return "VeteRaN";
    }else if($info[1]<4000)
    {
        return "Lava eXpelleR";
    }else if($info[1]<5000)
    {
        return "MasteR";
    }else if($info[1]<10000)
    {
        return "ic0N";
    }else 
    {
        return "Lava volcaNo";
    }
  }
}

/////////////////////Get Page Jumber
function getjumper($action, $sid,$pgurl)
{
$rets = "Jump to page<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[GO]";
        $rets .= "<go href=\"$pgurl.php\" method=\"get\">";
        $rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "<postfield name=\"sid\" value=\"$sid\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor>";
        
        return $rets;
}
/////////////////////Get unread number of pms

function getunreadpm($uid)
{
    $nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_private WHERE touid='".$uid."' AND unread='1'"));
    return $nopm[0];
}

//////////////////////GET USER NICK FROM USERID

function getnick_uid($uid)
{
  $unick = mysql_fetch_array(mysql_query("SELECT name FROM olu_users WHERE id='".$uid."'"));
  return $unick[0];
}

///////////////////////////////////////////////Get the smilies

function getsmilies($text)
{
  $sql = "SELECT * FROM olu_smilies";
  $smilies = mysql_query($sql);
  while($smilie=mysql_fetch_array($smilies))
  {
    $scode = $smilie[1];
    $spath = $smilie[2];
    $text = str_replace($scode,"<img src=\"../$spath\" alt=\"$scode\"/>",$text);
  }
  return $text;
}

////////////////////////////////////////////check nicks

function checknick($aim)
{
  $chk =0;
$aim = strtolower($aim);
  $nicks = mysql_query("SELECT id, name, nicklvl FROM olu_nicks");

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

function autopm($msg, $who)
{
    mysql_query("INSERT INTO olu_private SET text='".$msg."', byuid='5', touid='".$who."', unread='1', timesent='".time()."'");
    
}



/////////////////////// GET olu_users user id from nickname

function getuid_nick($nick)
{
  $uid = mysql_fetch_array(mysql_query("SELECT id FROM olu_users WHERE name='".$nick."'"));
  return $uid[0];
}

/////////////////////////////////////////Is admin?

function isadmin($uid)
{
  $admn = mysql_fetch_array(mysql_query("SELECT perm FROM olu_users WHERE id='".$uid."'"));
  if($admn[0]=='2')
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
  $text = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is","<a href=\"$1\">$2</a>",$text);
  $text = preg_replace("/\[topic\=(.*?)\](.*?)\[\/topic\]/is","<a href=\"index.php?action=viewtpc&amp;tid=$1&amp;sid=$sid\">$2</a>",$text);
  $text = preg_replace("/\[club\=(.*?)\](.*?)\[\/club\]/is","<a href=\"index.php?action=gocl&amp;clid=$1&amp;sid=$sid\">$2</a>",$text);
  $text = preg_replace("/\[blog\=(.*?)\](.*?)\[\/blog\]/is","<a href=\"index.php?action=viewblog&amp;bid=$1&amp;sid=$sid\">$2</a>",$text);
  //$text = ereg_replace("http://[A-Za-z0-9./=?-_]+","<a href=\"\\0\">\\0</a>", $text);
  if(substr_count($text,"[br/]")<=3){
    $text = str_replace("[br/]","<br/>",$text);
  }
  //$text = str_replace("2wap","2crapforwap",$text);
  //$text = str_replace("2WAP","2crapforwap",$text);
  //$text = str_replace("2wAp","2crapforwap",$text);
  //$text = str_replace("2w4p","2crapforwap",$text);
  //$text = str_replace("2waP","2crapforwap",$text);
  //$text = str_replace("2Wap","2crapforwap",$text);
$text = str_replace("hiphop4u","britneyspears",$text);
  $text = str_replace("HIPHOP4U","britneyspears",$text);
  $text = str_replace("HiPhOp4U","britneyspears",$text);
  $text = str_replace("hIpHoP4u","britneyspears",$text);
  $text = str_replace("Hiphop4U","britneyspears",$text);
  $text = str_replace("Hiphop4u","britneyspears",$text);
$text = str_replace("HipHop4u","britneyspears",$text);
 $text = str_replace("hh4u","britneyspears",$text);
  $text = str_replace("HH4U","britneyspears",$text);
  $text = str_replace("Hh4u","britneyspears",$text);
 $text = str_replace("hH4U","britneyspears",$text);
  $text = str_replace("HH4u","britneyspears",$text);
  $text = str_replace("hh4U","britneyspears",$text);
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
  $rmc = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM olu_users"));
  return $rmc[0];
}
///////

///////////////////////////function counter

function addvisitor()
{
  $cc = mysql_fetch_array(mysql_query("SELECT value FROM olu_settings WHERE name='Counter'"));
  $cc = $cc[0]+1;
  $res = mysql_query("UPDATE olu_settings SET value='".$cc."' WHERE name='Counter'");
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
/////////////////////////Can uid rate who's photo?

function canratephoto($uid, $who)
{
  if($uid==$who)
  {
    return false; //imagine rate his photo
  }else
  return true;
}

function admob()
{
  /* editable area */
  $mob_mode = 'live'; // change mode from "test" to "live" when you are done testing
  $mob_alternate_link = ' <a href="http://lareq.co.cc">We are the Best</a>'; // use this to set a default link to appear if AdMob does not return an ad.

  /* end editable area */

  //used for ad targeting
  $mob_contents = '';
  $mob_ua = urlencode(getenv("HTTP_USER_AGENT"));
  $mob_ip = urlencode($_SERVER['REMOTE_ADDR']);

  $mob_m = '';
  if ($mob_mode=='test')
      $mob_m = "&m";

  $mob_url = 'http://ads.admob.com/ad_source.php?s=a14ad0be35d2087&u='.$mob_ua.'&i='.$mob_ip.$mob_m;

  @$mob_ad_serve = fopen($mob_url,'r');

  if ($mob_ad_serve) {
      while (!feof($mob_ad_serve))
          $mob_contents .= fread($mob_ad_serve,1024);
      fclose($mob_ad_serve);
  }
  $mob_link = explode("><",$mob_contents);

  $mob_ad_text = $mob_link[0];
  $mob_ad_link = $mob_link[1];

  if (isset($mob_ad_link) && ($mob_ad_link !='')) {
      //display AdMob Ad
      echo '<a href="'. $mob_ad_link .'">'. $mob_ad_text . '</a>';
  }
  else {
      //no AdMob ad, display alternate
      echo $mob_alternate_link;
  }
}
