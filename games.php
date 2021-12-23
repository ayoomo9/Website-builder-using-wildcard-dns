
<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
include_once('header.php');
echo "<?xml version=\"1.0\"?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
//check_injection();
check_query();
check_browser();

check_method();
$bcon = connectdb();

if (!$bcon)
{
    echo "<head>";
    echo "<title>Error!!!</title>";
	echo "<meta http-equiv=\"expires\" content=\"0\" />";
 echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    echo "<head>";
    echo "<body>";
    echo "<p align=\"center\">";
	include("admob.php");
    echo "<br /><img src=\"images/notok.gif\" alt=\"!\"/><br/>";
    echo "<b><strong>Error! Cannot Connect To Database...</strong></b><br/><br/>";
    echo "This error happens usually when backing up the database, please be patient...";
    
	echo admob_request($admob_params);
	echo "<br /></p>";
    echo "</body>";
    echo "</html>";
    exit();
}

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

$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];
$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));

if((islogged($sid)==false)||($uid==0))
{
      echo "<head>";
      echo "<title>Error!!!</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "You are not logged in<br/>";
      echo "Or Your session has been expired<br/><br/>";
      echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
}
if(isbanned($uid))
    {
      echo "<head>";
      echo "<title>Error!!!</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
       echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
      echo "<p align=\"center\">";
      echo "<img src=\"images/notok.gif\" alt=\"x\"/><br/>";
      echo "<b>You are Banned</b><br/><br/>";
      $banto = mysql_fetch_array(mysql_query("SELECT timeto, pnreas, exid FROM gyd_pur WHERE uid='".$uid."' AND penalty='1' OR uid='".$uid."' AND penalty='2'"));
	$banres = mysql_fetch_array(mysql_query("SELECT lastpnreas FROM gyd_users WHERE id='".$uid."'"));
      $remain = $banto[0]- time();
      $rmsg = gettimemsg($remain);
      echo "<b>Time Left: </b>$rmsg<br/>";
      $nick = getnick_uid($banto[2]);
	echo "<b>By: </b>$nick<br/>";
	echo "<b>Reason: </b>$banto[1]";
      //echo "<a href=\"index.php\">Login</a>";
      echo "</p>";
      echo "</body>";
      echo "</html>";
      exit();
    }
if($action=="guessgm")
{
    addonline(getuid_sid($sid),"Playing Gtn","");
      echo "<head>";
      echo "<title>Guess The Number</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
       echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  $gid = $_POST["gid"];
  $un = $_POST["un"];

  if($gid=="")
  {
        mysql_query("DELETE FROM gyd_games WHERE uid='".$uid."'");
        mt_srand((double)microtime()*1000000);
        $rn = mt_rand(1,100);
        mysql_query("INSERT INTO gyd_games SET uid='".$uid."', gvar1='8', gvar2='".$rn."'");
        $tries = 8;
        $gameid = mysql_fetch_array(mysql_query("SELECT id FROM gyd_games WHERE uid='".$uid."'"));
        $gid=$gameid[0];
  }else{
    $ginfo = mysql_fetch_array(mysql_query("SELECT gvar1,gvar2 FROM gyd_games WHERE id='".$gid."' AND uid='".$uid."'"));
    $tries = $ginfo[0]-1;
    mysql_query("UPDATE ibwf_games SET gvar1='".$tries."' WHERE id='".$gid."'");
    $rn = $ginfo[1];
  }
  if ($tries>0)
                {
                $gmsg = "Just try to guess the number before you have no more tries, the number is between 1-100<br/><br/>";
                echo $gmsg;
                $tries = $tries-1;
                $gpl = $tries*3;
                echo "Tries:$tries, Plusses:$gpl<br/><br/>";
                      if ($un==$rn){
                        $gpl = $gpl+3;
                        $ugpl = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'"));
                        $ugpl = $gpl + $ugpl[0];
                        mysql_query("UPDATE gyd_users SET gplus='".$ugpl."' WHERE id='".$uid."'");
                        echo "Congratulations! the number was $rn, $gpl Plusses has been added to your Game Plusses, <a href=\"games.php?action=guessgm&amp;sid=$sid\">New Game</a><br/><br/>";
                      }else{
                        if($un <$rn)
                        {
                          echo "Try bigger number than $un !<br/><br/>";
                        }else{
                            echo "Try smaller number than $un !<br/><br/>";
                        }
		echo "<form action=\"games.php?action=guessgm&amp;sid=$sid\" method=\"post\">";
		echo "Your Guess: <input type=\"text\" name=\"un\" style=\"-wap-input-format: '*N'\" size=\"3\" value=\"$un\"/>";
		echo "<input type=\"hidden\" name=\"gid\" value=\"$gid\"/>";
		echo "<input type=\"Submit\" name=\"try\" value=\"TRY\"></form><br/>";
                      }


                }else{
                    $gmsg = "GAME OVER, <a href=\"games.php?action=guessgm&amp;sid=$sid\">New Game</a><br/><br/>";
                    echo $gmsg;
                }
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
	
 echo "</p></body>";
  exit();
}
/////////////////////////////////

else if($action == "scramble")
{
    addonline(getuid_sid($sid),"playing word scramble","");
      echo "<head>";
      echo "<title>Word Scramble</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
$answer = $_POST["answer"];
if (empty($_POST["answer"]))  {

srand((float) microtime() * 10000000);
$input = array(
"dictionary",   
"recognize",
"example",
"entertainment",
"experiment",
"appreciation",
"information",
"pronunciation",
"language",
"government",
"psychic",
"blueberry",
"selection",
"automatic",
"strawberry",
"bakery",
"shopping",
"eggplant",
"chicken",
"organic ",
"angel",
"season",
"market",
"information",
"complete",
"sunset",
"unique",
"customer"
);
$rand_keys = array_rand($input, 2);
$word = $input[$rand_keys[0]];
$Sword = str_shuffle($word);
echo "<p align=\"center\">$Sword</p>
      <p align=\"center\">In the
      text box below type the correct word that is scrambled above.</p>
      <form method=\"POST\" action=\"games.php?action=scramble&amp;sid=$sid\">
        <center><input type=\"text\" name=\"answer\" size=\"20\">
<input type=\"hidden\" name=\"correct\" value=\"$word\">
<input type=\"submit\" value=\"GO!\" name=\"B1\"></center>
      </form>
<p align=\"center\"><a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a></p>

</body>";

}
else {
$answer = strtolower($answer);
if($answer == $correct){
$result = "Correct! <b>$answer</b>";
$uid = getuid_sid($sid);
$ugpl = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'"));
$ugpl = "25" + $ugpl[0];
mysql_query("UPDATE gyd_users SET gplus='".$ugpl."' WHERE id='".$uid."'");

echo "<p align=\"center\">$result<br/>You Have Had 25 game Plusses Added For Winning.
</p>
      <p align=\"center\"><a href=\"games.php?action=scramble&amp;sid=$sid\">Try Another Word?</a><br/>
<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a></p>
</body>";}


else { $result = "Sorry! The Correct Answer Was <b>$correct</b>.";
$uid = getuid_sid($sid);
$ugpl = mysql_fetch_array(mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'"));
$ugpl = $ugpl[0] - "25";
mysql_query("UPDATE gyd_users SET gplus='".$ugpl."' WHERE id='".$uid."'");

echo "<p align=\"center\">$result<br/>You Have Had 25 game Plusses Deducted For Losing.
</p>
<p align=\"center\"><a href=\"games.php?action=scramble&amp;sid=$sid\">Try Another Word?</a><br/>
<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a></p>
</body>";
}
}
}
////////////////////////////////////////

else if($action == "hangman")
{
  addonline(getuid_sid($sid),"Playing Hangman","");
  echo "<head>";
  echo "<title>Hangman</title>";
  echo "<meta http-equiv=\"expires\" content=\"0\" />";
   echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
  echo "</head>";
  echo "<body>";
  if ($cat==""){
  echo "<p align=\"center\">
  <img src=\"../images/hang_6.gif\" alt=\"Hangman\"/><br/>
  Select a category:<br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=anmls&amp;sid=$sid\">Animals</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=clrs&amp;sid=$sid\">Colours</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=comp&amp;sid=$sid\">Computers</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=frt&amp;sid=$sid\">Fruit</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=big&amp;sid=$sid\">Big Words</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=lotr&amp;sid=$sid\">Lord Of The Rings</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=mths&amp;sid=$sid\">Months</a><br/>";
  echo "<a href=\"$PHP_SELF?action=hangman&amp;cat=web&amp;sid=$sid\">Web / Wap coding</a><br/>";

  echo "<br/><a href=\"index.php?action=main&amp;sid=$sid\">Back</a><br/>";
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
	
  echo "</p></body></html>";
  exit();
  }
if ($cat==anmls){
$category="ANIMALS";
$list = "ANIMALS
BABOON
BEAR
BULL
CAMEL
CAT
COW
CROW
DOG
DONKEY
DUCKBILL PLATYPUS
EAGLE
ELEPHANT
FISH
FOX
GIRAFFE
GOAT
GOLDFISH
HAWK
HEDGEHOG
HORSE
KANGAROO
KITTEN
MOLE
MONKEY
MOUSE
MULE
OWL
PARROT
PIG
PINK ELEPHANT
POLAR BEAR
PORCUPINE
POSSUM
PUPPY
RABBIT
RACCOON
RAT
ROBIN
SEAL
SHARK
SKUNK
SQUIRREL
STOAT
WALRUS
WEASEL
WHALE
ZEBRA";}



if ($cat==clrs){
$category="COLOURS";
$list = "BLACK
BLUE
BROWN
BUBBLEGUM PINK
COLORS
CYAN
FUCHSIA
GOLD
GREEN
GREY
INDIGO
LAVENDER
LIME GREEN
MAROON
OLIVE
ORANGE
PERIWINKLE
PINK
PURPLE
RED
ROYAL BLUE
SCARLET
TEAL
TURQUOISE
VIOLET
WHITE
YELLOW"; }


if ($cat==comp){
$category="COMPUTERS";
$list = "ACCESS
ANTI-VIRUS SOFTWARE
BASIC
CD-ROM DRIVE
CHAT
COMPUTER
CPU
DATABASE
DOS
EMAIL
EXCEL
FIREWALL
FLOPPY DRIVE
FORUMS
FRONTPAGE
GAMES
HACKER
HARD DRIVE
HTML
ICQ
INTERNET
JUNK MAIL
KEYBOARD
LINUX
LOTUS
MICROSOFT
MONITOR
MOTHER BOARD
MOUSEPAD
OPERATING SYSTEM
PARALLEL PORT
PHP
PRINTER
PUBLISHING
RAM
SERIAL PORT
SOLITARE
SPEAKERS
TECHNOLOGY
UNIX
URL
VIRUS
VISUAL BASIC
WINDOWS
WORD
WORD PROCESSING
WORLD WIDE WEB
ZIP"; }


if ($cat==frt){
$category="FRUIT";
$list = "APPLE
BANANA
BLACKBERRY
BLUEBERRY
FRUIT
GRAPE
GRAPEFRUIT
KIWI
MANGO
ORANGE
PEACH
PEAR
RASBERRY
STRAWBERRY
TANGERINE
TOMATO
UGLY FRUIT"; }



if ($cat==big){
$category="BIG WORDS";
$list = "AUSTRALOPITHECINE
DEOXYRIBONUCLEIC ACID
LARGE WORDS
MITOCHONDRIA"; }

if ($cat==lotr){
$category="LORD OF THE RINGS";
$list = "AGORNATH
ARAGORN
ARWEN
BAG END
BALIN
BALROG
BARROW DOWNS
BARROW WRIGHT
BEREN
BILBO BAGGINS
BLACK RIDERS
BOROMIR
BREE
BUCKLAND
CELEBORN
DEAD MARSHES
DWARVES
EDORAS
ELENDIL
ELFSTONE
ELROND
ELVES
ENTS
EOWYN
FANGORN FOREST
FARAMIR
FRODO BAGGINS
GALADRIEL
GANDALF
GILGALAD
GLAMDRING
GLORFINDEL
GOLDBERRY
GOLLUM
GONDOR
HALDIR
HELMS DEEP
HOBBITON
HOBBITS
ISENGARD
ISILDUR
LEGOLAS
LEMBAS BREAD
LONELY MOUNTAIN
LONELY MOUNTIAN
LORD OF THE RINGS
LOTHLORIEN
LUTHIEN
MELKOR
MEN
MERRY
MIDDLE EARTH
MINAS MORGUL
MINAS TIRITH
MIRKWOOD
MITHRANDIR
MITHRIL
MORDOR
MORIA
MT. DOOM
MY PRECIOUSSS
NAZGUL
NUMENOR
OLD FOREST
OLD MAN WILLOW
ORCS
ORTHANC
PIPE WEED
PIPPIN
PLAINTIR
RANGERS
RINGWRAITHS
RIVENDELL
ROHAN
SAMWISE GAMGEE
SARUMAN
SAURON
SHADOWFAX
SHAGRAT
SHELOB
SHIRE
SILMARILLIAN
SMAUG
SMEAGOL
STEWARD OF GONDOR
STING
STRIDER
THE FELLOWSHIP OF THE RING
THE RETURN OF THE KING
THE RING
THE TWO TOWERS
THEODIN
TOM BOMBADIL
TREEBEARD
TROLLS
UNDYING LANDS
URUK-HAI
VALINOR
WARG RIDERS
WEATHERTOP
WIZARDS
WORMTONGUE";}


if ($cat==mths){
$category="MONTHS";
$list = "APRIL
AUGUST
DECEMBER
FEBRUARY
JANUARY
JULY
JUNE
MARCH
MAY
MONTHS
NOVEMBER
OCTOBER
SEPTEMBER"; }

if ($cat==web){
$category="WEB / WAP CODING";
$list = "JAVA BEANS
PHP SCRIPTS
SOURCE CODE
JAVASCRIPT GAMES
SSI IS SERVER SIDE INCLUDES
BILL GATES
COOKIES
HTTP AUTHENTICATION
ERROR HANDLING
MANIPULATING IMAGES
FILE UPLOADS
DATABASE / CONNECTION
APACHE SERVER
ZIP FILE
TAR COMPRESSION
FUNCTIONS
ENCRYPTION
MYSQL DATABASE
INITIALIZATION
FAQ - FREQUENTLY ASKED QUESTIONS
DEBUGGING
VERIFICATION
HTML VALIDATION
CASCADING STYLE SHEETS";}

# below ($alpha) is the alphabet letters to guess from.
#   you can add international (non-English) letters, in any order, such as in:
#   $alpha = "????????????????????????????ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

# below ($additional_letters) are extra characters given in words; '?' does not work
#   these characters are automatically filled in if in the word/phrase to guess
$additional_letters = " -.,;!?%& 0123456789/";

#========= do not edit below here ======================================================

$sid = $_GET["sid"];
$uid = getuid_sid($sid);
$len_alpha = strlen($alpha);

if(isset($_GET["n"])) $n=$_GET["n"];
if(isset($_GET["letters"])) $letters=$_GET["letters"];
if(!isset($letters)) $letters="";

if(isset($PHP_SELF)) $self=$PHP_SELF;
else $self=$_SERVER["PHP_SELF"];

$links="";
$max=6;
# error_reporting(0);
$list = strtoupper($list);
$words = explode("\n",$list);
srand ((double)microtime()*1000000);
$all_letters=$letters.$additional_letters;
$wrong = 0;

echo "<p align=\"center\">";
if (!isset($n)) { $n = rand(1,count($words)) - 1; }
$word_line="";
$word = trim($words[$n]);
$done = 1;
for ($x=0; $x < strlen($word); $x++)
{
  if (strstr($all_letters, $word[$x]))
  {
    if ($word[$x]==" ") $word_line.=" / "; else $word_line.=$word[$x];
  }
  else { $word_line.="_ "; $done = 0; }
}

if (!$done)
{

  for ($c=0; $c<$len_alpha; $c++)
  {
    if (strstr($letters, $alpha[$c]))
    {
      if (strstr($words[$n], $alpha[$c])) {$links .= "<b>$alpha[$c]</b> "; }
      else { $links .= " $alpha[$c] "; $wrong++; }
    }
    else
    { $links .= " <a href=\"$self?action=hangman&amp;cat=$cat&amp;letters=$alpha[$c]$letters&amp;n=$n&amp;sid=$sid\">$alpha[$c]</a> "; }
  }
  $nwrong=$wrong; if ($nwrong>6) $nwrong=6;
  echo "<br/><img src=\"images/hang_$nwrong.gif\" alt=\"Wrong: $wrong out of $max\"/><br/>";

  if ($wrong >= $max)
  {
    $n++;
    if ($n>(count($words)-1)) $n=0;
    echo "<br/><br/>$word_line";
    echo "<br/><br/><big>SORRY, YOU ARE HANGED!!!</big><br/><br/>";
    if (strstr($word, " ")) $term="answer"; else $term="word";
    echo "The $term was \"<b>$word</b>\"<br/><br/>";
    $sqlfetch=mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'");
    $sqlfet=mysql_fetch_array($sqlfetch);
    $gplusnew=$sqlfet[0] - "25";
    $sql="UPDATE gyd_users SET gplus='".$gplusnew."' WHERE id='".$uid."'";
    $res=mysql_query($sql);
    echo "You Have Had 25 game Plusses Deducted For Losing.<br/>";
    echo "<a href=\"$self?action=hangman&amp;cat=$cat&amp;n=$n&amp;sid=$sid\">Play again</a><br/>";
  echo "<a href=\"$self?action=hangman&amp;sid=$sid\">Change category</a>";
  }else{
    echo " Wrong Guesses Left: <b>".($max-$wrong)."</b><br/><br/>";
    echo "$word_line";
    echo "<br/><br/>Choose a letter:<br/>";
    echo "$links";
  }
}else{
  $n++;    # get next word
  if ($n>(count($words)-1)) $n=0;
  echo "<br/><br/>\n$word_line";
  echo "<br/><br/><b>Congratulations!!! You win!!!</b><br/><br/><br/>";
      $sqlfetch=mysql_query("SELECT gplus FROM gyd_users WHERE id='".$uid."'");
    $sqlfet=mysql_fetch_array($sqlfetch);
    $gplusnew=$sqlfet[0] + "25";
    $sql="UPDATE gyd_users SET gplus='".$gplusnew."' WHERE id='".$uid."'";
    $res=mysql_query($sql);
    echo "You Have Had 25 game Plusses Added For Winning.<br/>";
  echo "<a href=\"$self?action=hangman&amp;cat=$cat&amp;n=$n&amp;sid=$sid\">Play again</a><br/>";
  echo "<a href=\"$self?action=hangman&amp;sid=$sid\">Change category</a>";
}
  echo "<br/><br/><a href=\"index.php?action=main&amp;sid=$sid\">Back</a>";
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
	
 echo "</p></body>";
  exit();
}
////////////////////////////////////
else if($action=="lottoi")
{
    addonline(getuid_sid($sid),"Playing lotto","");
 
       echo "<p align=\"center\"><b>Lotto</b></p>";

    echo "<p align=\"center\">";
    echo "<br/>Wanna become a millionaire? Really? Really,really? Then this game should keep you busy and entertained for HOURS! Win the lotto and be known as a millionaire here!<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<
 echo "<p align=\"center\">";

 echo "<br/><a href=\"games.php?action=lotto&amp;sid=$sid\">";
 echo "QuickPick</a><br/>";
 echo "Quickpick Price: 2 coins<br/>";
  echo "<a href=\"games.php?action=lottop&amp;sid=$sid\">";
 echo "Millionaires rewards</a><br/>";
   echo "</p>";

   
  ////// UNTILL HERE >>
     echo "<p align=\"center\">";
       echo "<br/><a href=\"games.php?action=main&amp;sid=$sid\">Online Games</a><br/>";
       echo "</p>";

  
}

//////////////////////////////////LOTTO///////////

else if($action=="lotto")
{
    addonline(getuid_sid($sid),"Playing lotto","");
    
       echo "<p align=\"center\"><b>Lotto</b></p>";
    
    
    echo "<p align=\"center\">";
  
    echo "<b>LDSwapWORLD Lotto Draw</b><br/>Heres the lucky draw =D<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<
echo "<p align=\"center\">";
 if(getplusses(getuid_sid($sid))<10)
    {
        echo "You should have at least 10 points to play this game!";
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
echo "<br/><a href=\"games.php?action=lotto&amp;sid=$sid\">";
echo "another quickpick</a><br/>";
   echo "</p>";

  ////// UNTILL HERE >>
      echo "<p align=\"center\">";
       echo "<br/><a href=\"games.php?action=main&amp;sid=$sid\">Online Games</a><br/>";
       echo "</p>";

  
  
}

//////////////////////////////////LOTTO////////////

else if($action=="lottow")
{
    addonline(getuid_sid($sid),"Playing lotto","");
  
      echo "<p align=\"center\"><big><b>Playing Lotto</b></big></p>";
     
  
    echo "<p align=\"center\">";
    echo "<b>Lotto Draw</b><br/>This is the secret code that you must inbox ADMIN in order to become a LDSwapWORLD millionaire!<br/>";
   
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
       echo "<br/><a href=\"games.php?action=main&amp;sid=$sid\" Online Games</a><br/>";
       echo "</p>";
  
  
}

//////////////////////////////////LOTTO////////////

else if($action=="lottop")
{
    addonline(getuid_sid($sid),"Playing lotto","");
  
       echo "<p align=\"center\"><b>Lotto Prizes</b></p>";
     
    echo "<p align=\"center\">";
      echo "<b>Lotto Draw</b> Millionaires get:<br/>";
   
    echo "</p>";
    //////ALL LISTS SCRIPT <<


   echo "*1000 coins<br/>";
   echo "*their profile status changes to wapbies millionaire<br/>";
    //echo "*your name will be up in site stats as one of the lotto winners<br/>";
   // echo "*you will also be added to our V.I.P list<br/>";
    

   
  ////// UNTILL HERE >>
      echo "<p align=\"center\">";
       echo "<br/><a href=\"games.php?action=main&amp;sid=$sid\">Back to Online Games</a><br/>";
       echo "</p>";
 
 
}
else{
   addonline(getuid_sid($sid),"Lost in Games lol","");
      echo "<head>";
      echo "<title>Error!!!</title>";
	  echo "<meta http-equiv=\"expires\" content=\"0\" />";
      echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
      echo "</head>";
      echo "<body>";
  echo "<p align=\"center\">";
  echo "Page not found!<br/><br/>";
  echo "<a href=\"index.php?action=main&amp;sid=$sid\"><img src=\"images/home.gif\" alt=\"\"/>Home</a>";
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
	
 echo "</p></body>";
  exit();
}
?>
</html>
