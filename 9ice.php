

<?php
ini_set("display_errors", "0");
ini_set("register_globals", "0");
require_once("config_cgh.php");
//include_once ("lang.php");
require_once("core.php");
include_once("xhtmlfunctions.php");
check_query();
check_browser();

check_method();

 include_once('header.php');
echo "<?xml version=\"1.0\"?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$bcon = connectdb();
if (!$bcon)
{
echo "<head>";
echo "<title>Error!!!</title>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
echo "</head>";
echo "<body>";
echo "<p align=\"center\">";
echo "<img src=\"images/notok.gif\" alt=\"!\"/><br/>";
echo "<b><strong>Error! Cannot Connect To Database...</strong></b><br/><br/>";
echo "This error happens usually when backing up the database, please be patient...";
echo "</p>";
echo "</body>";
echo "</html>";
exit();
}
$brws = explode("/",$HTTP_USER_AGENT);
$ubr = $brws[0];
$uip = getip();
$action = $_GET["action"];
$sid = $_GET["sid"];
$page = $_GET["page"];
$who = $_GET["who"];
$sitename = mysql_fetch_array(mysql_query("SELECT value FROM gyd_settings WHERE name='sitename'"));
$sitename = $sitename[0];
$uid = getuid_sid($sid);
$theme = mysql_fetch_array(mysql_query("SELECT theme FROM gyd_users WHERE id='".$uid."'"));
cleardata();

if(($action != "") && ($action!="terms"))
{
$uid = getuid_sid($sid);
if((islogged($sid)==false)||($uid==0))
{
echo "<head>";
echo "<title>Error</title>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
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
}


////////////////////////////////////////MAIN PAGE
echo "<head>";
echo "<title>9ice-Pamurogo</title>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"default.css\">";
?>
</head>
<body>

<?php
echo "<p align=\"center\">";
echo "<b><u>PAMUROGO</u></b><br /><br />";
echo "

<b>Chorus:</b><br /> 
Pamurogo domurogo lolaye<br />
pamuragba timu ragba timu ragba tipapa<br />
Oni tibi bami lale jo un oti seyisi<br />
Kin jela kin je resi afomi ojo<br />
Omi ladun omi sororo ojo weli weli<br />

Show me your Talent babe boo<br />
You are gifted<br />
Show me your Talent babe boo<br />
You are gifted<br />
Omo na so, omo na so<br />
Dey wine deh go, deh go<br /><br />



<b>1st Verse:</b><br />

Have been searching for a girl<br />
That can satisfy me my speed and move is everlasting<br />
Ole kole ro toba ro kole wo<br />
You can test me babe monawo ro<br />
Moti mu opa enyin with ale afato<br />
Nibi nima kusi omo mio lo<br />
Ije ana dun mo eworo omo mio lo<br />
Ask about me am the guy that makes the ladies scream<br />
Oremiti afibi eshin<br />
You friend can testify if you fail to realize<br />
That am bonafide<br />
Babe dont test me, test me, test me<br /><br />


<b>Chorus</b><br />

Pamurogo domurogo lolaye<br />
pamuragba timu ragba timu ragba tipapa<br />
Oni tibi bami lale jo un oti seyisi<br />
Kin jela kin je resi afomi ojo<br />
Omi ladun omi sororo ojo weli weli<br />

Show me your Talent babe boo<br />
You are gifted<br />
Show me your Talent babe boo<br />
You are gifted<br />
Omo na so, omo na so
Dey wine deh go, deh go<br /><br />

<b>2nd Verse</b><br />

Call me your Nanny if i never debe ri<br />
Call me gbewu dani mofi jo broda mi<br />
I cant control it nature is calling<br />
If i say i like the way you are winening it<br />
You must be sexy that makes me want it<br />


On the field of play mio lekeji<br />
Moriamo ilekeji otitesi<br />

Pemi loruko fami nirugbon<br />
Am not that old naaw jekin gbonmi si mojo
Tale yi ayato ose alomoko<br />
Tidaji onise ko emi gan okanran<br />

Kama yata yayo, eji nana ba bo<br /><br />

<b>Chorus</b><br />

Pamurogo domurogo lolaye<br />
pamuragba timu ragba timu ragba tipapa<br />
Oni tibi bami lale jo un oti seyisi<br />
Kin jela kin je resi afomi ojo<br />
Omi ladun omi sororo ojo weli weli<br />

Show me your Talent babe boo<br />
You are gifted<br />
Show me your Talent babe boo<br />
You are gifted<br />
Omo na so, omo na so<br />
Dey wine deh go, deh go<br />

Repeat chrs till it fades<br /><br />

";
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
echo "</body>";
?>