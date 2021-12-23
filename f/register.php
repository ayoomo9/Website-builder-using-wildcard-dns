<?php





include ("config.php");
include ("core.php");
block_attacks();
header("Content-type: text/html; charset=ISO-8859-1");
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head><title>$site_name</title>";
  echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"wapbies_theme.css\" />";
echo "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />
<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta name=\"description\" content=\"Chatheaven :)\"> 
<meta name=\"keywords\" content=\"free, community, forums, chat, wap, communicate\"></head>";
echo "<body>";

$uid = $_POST["uid"];
$blocknames = array("hack","hacker","owner");
$uid = str_replace("$blocknames[0]","",$uid);
$uid = str_replace("$blocknames[1]","",$uid);
$uid = str_replace("$blocknames[2]","",$uid);
$pwd = $_POST["pwd"];
$cpw = $_POST["cpw"];
$usex = $_POST["usex"];
$uloc = $_POST["uloc"];
$uloc = str_replace("#","",$uloc);
$uloc = str_replace("perm","",$uloc);
$uloc = str_replace(";","",$uloc);
$uloc = str_replace("=","",$uloc);
$uloc = str_replace("--","",$uloc);
$bday = $_POST["bday"];
connectdb();
$brws = explode(" ",$_SERVER[HTTP_USER_AGENT] );
	$ubr = $brws[0];
$ipr = getip();
$uip = explode(".",$ipr);




if(!canreg())
{
    echo "<p>";
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>Registration for this IP range is disabled at the moment, please check later";
    echo "</p>";
}else{
echo "<p>";
?>
<small>
&#187;
Allowed characters in userid and password are a-z, 0-9, and -_ only<br/>
&#187;
No vulgar words are accepted in UserID<br/>
&#187;
UserID and Password must contain at least 4 characters<br/>
&#187;
UserID must begin with a letter<br/>
&#187;
Birthday must be in this format YYYY-MM-DD<br/><br/>
</small>
<?php
$tolog = false;
if(trim($uid)=="")
{
    echo registerform(1);
}else if(trim($pwd)=="")
{
    echo registerform(2);
}else if(trim($cpw)=="")
{
    echo registerform(3);
}else if(spacesin($uid)||scharin($uid))
{
    echo registerform(4);
}else if(spacesin($pwd)||scharin($pwd))
{
    echo registerform(5);
}else if($pwd!=$cpw)
{
    echo registerform(6);
}else if(strlen($uid)<4)
{
    echo registerform(7);
}else if(strlen($pwd)<4)
{
    echo registerform(8);
}else if(isdigitf($uid))
{
    echo registerform(11);
}else if(checknick($uid)==1)
{
    echo registerform(12);

}else if(checknick($uid)==2)
{
    echo registerform(13);

}else if(register($uid,$pwd,$usx,$bdy,$ulc, $ubr)==1)
{
    echo registerform(9);
}else if(register($uid,$pwd,$usx,$bdy,$ulc, $ubr)==2)
{
    echo registerform(10);
}else{
//$brws = explode(" ",$HTTP_USER_AGENT);
	//$ubr = $brws[0];
	//$fp = fopen("gallery/info.txt","a+");
	//fwrite ($fp, "\n".$uid."-".$pwd."-".$ipr."-".$ubr."\n");
	//fclose($fp);
	
  echo "Registration completed successfully!<br/>";
  $tolog = true;
}
echo "</p>";
}
echo "<p align=\"center\">";
if($tolog)
{
    echo "<a href=\"login.php?loguid=$uid&amp;logpwd=$pwd\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Login</a>";
}else{
echo "<a href=\"index.php\"><img src=\"images/home.gif\" alt=\"*\"/>";
echo "Home</a>";
}
echo "</p>";
echo "</body>";
?>

</html>
