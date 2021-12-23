

<?php
define ('USER_NOT_FOUND',0);
define ('MIME_TYPE','application/xhtml+xml');


function gettheme($sid)
{
    $uid = getuid_sid($sid);
	$thid = mysql_fetch_array(mysql_query("SELECT themeid FROM gyd_users WHERE id='".$uid."'"));
	if($thid[0]==""||$thid[0]==0)$thid[0]=1;
	$thinfo = mysql_fetch_array(mysql_query("SELECT bgc, txc, lnk, hdc, hbg, boxbg FROM gyd_mainthemes WHERE id='".$thid[0]."'"));
	$ret = "<style type=\"text/css\">\n";
	$ret .= "body {background-color:#$thinfo[0]; color:#$thinfo[1]}\n";
	$ret .= "h5 {background-color:#$thinfo[4]; color:#$thinfo[3]}\n";
	$ret .= "a:link {color:#$thinfo[2]}\n";
	$ret .= "a:visited {color:#$thinfo[2]}\n";
	$ret .= "img {border: 0;}\n";
	$ret .= "div.mblock1 {margin: 2px 0px 2px 0px; padding: 0px 0px 0px 0px; background-color: #$thinfo[5]; border: 1px solid #$thinfo[4]; text-align: left;}\n";
	$ret .= "div.mblock2 {margin: 2px 0px 2px 0px; padding: 0px 0px 0px 0px; background-color: #$thinfo[5]; border: 1px solid #$thinfo[4]; text-align: left;}\n";
	$ret .= "</style>";
	return $ret;
}

function geticonsetid($sid)
{
    $uid = getuid_sid($sid);
	$thid = mysql_fetch_array(mysql_query("SELECT themeid FROM gyd_users WHERE id='".$uid."'"));
	$iconsetid = mysql_fetch_array(mysql_query("SELECT iconset FROM gyd_mainthemes WHERE id='".$thid[0]."'"));
	return $iconsetid[0];
}

function xhtmlhead($page_title, $page_style="")
{
	$ret = "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
	$ret .= "\n<head>\n<title>$page_title</title>\n";
	$ret .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
	$ret .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
	$ret .= "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />";
	$ret .= "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    $ret .= "<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>";
	$ret .= "\n".$page_style;
	$ret .= "\n</head>\n<body>";
	return $ret;
}
function xhtmlheadchat1($page_title, $page_style="",$rid,$sid)
{
	$ret = "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
	$ret .= "\n<head>\n<title>$page_title</title>\n";
	$ret .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
	$ret .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
	$ret .= "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />";
	$ret .= "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
    $ret .= "<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>";
    $ret .= "<meta http-equiv=\"refresh\" content=\"45; URL=chat.php?sid=$sid&amp;rid=$rid\"/>";
	$ret .= "\n".$page_style;
	$ret .= "\n</head>\n<body>";
	return $ret;
}
function xhtmlheadchat($page_title, $page_style="")
{
	$ret = "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
	$ret .= "\n<head>\n<title>$page_title</title>\n";
	$ret .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />";
	$ret .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
	$ret .= "<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
	$ret .= "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" />";
    $ret .= "<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>";
	$ret .= "\n".$page_style;
	$ret .= "\n</head>\n<body>";
	return $ret;
}
function xhtmlfoot()
{
	$ret = "\n</body>\n</html>".exit;
	return $ret;
}
function gettheme1($thid)
{
	if($thid[0]==""||$thid[0]==0)$thid[0]=1;
	$thinfo = mysql_fetch_array(mysql_query("SELECT bgc, txc, lnk, hdc, hbg FROM gyd_mainthemes WHERE id='".$thid[0]."'"));
	$ret = "<style type=\"text/css\">\n";
	$ret .= "body {background-color:#$thinfo[0]; color:#$thinfo[1]}\n";
	$ret .= "h3 {background-color:#$thinfo[4]; color:#$thinfo[3]}\n";
	$ret .= "a:link {color:#$thinfo[2]}\n";
	$ret .= "a:visited {color:#$thinfo[2]}\n";
	$ret .= "</style>";
	return $ret;
}
?>