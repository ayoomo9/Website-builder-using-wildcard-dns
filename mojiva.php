<?php

//
change to "live" to disable demo mode and show real ads
define("MOJIVA_MODE", "live");
function mojiva_ad($mojiva_params = array())
{ // prepare url parameters of request $mojiva_get =
'site='.urlencode('3472'); $mojiva_get .=
'&ip='.urlencode($_SERVER['REMOTE_ADDR']); $mojiva_get .=
'&ua='.urlencode($_SERVER['HTTP_USER_AGENT']); $mojiva_get .=
'&url='.urlencode(sprintf("http%s://%s%s",
(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == TRUE ? "s":
""), $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"])); $mojiva_get .=
'&zone='.urlencode('4175'); $mojiva_get .= '&adstype=3'; //
type of ads (1 - text only, 2 - images only, 3 - text + images)
$mojiva_get .= '&key=1'; //$mojiva_get .= '&lat=1';
//$mojiva_get .= '&long=1'; $mojiva_get .= '&count=1'; //
quantity of ads $mojiva_get .= '&keywords='; // keywords to search
ad delimited by commas (not necessary) $mojiva_get .=
'&whitelabel=0'; // filter by whitelabel(0 - all, 1 - only
whitelabel, 2 - only non-whitelabel) $mojiva_get .= '&premium=0';
// filter by premium status (0 - non-premium, 1 - premium only, 2 -
both) $mojiva_get .= '&over_18=0'; // filter by ad over 18 content
(0 - allow over 18 content, 1 - deny over 18 content, 2 - only over 18
content) $mojiva_get .= '&paramBORDER='.urlencode('#000000'); //
ads border color $mojiva_get .=
'&paramHEADER='.urlencode('#cccccc'); // header color $mojiva_get
.= '&paramBG='.urlencode('#eeeeee'); // background color
$mojiva_get .= '&paramTEXT='.urlencode('#000000'); // text color
$mojiva_get .= '&paramLINK='.urlencode('#ff0000'); // url color
if(MOJIVA_MODE == "test") $mojiva_get .= '&test=1'; // send request
$mojiva_request = @fsockopen('ads.mojiva.com', 80, $errno, $errstr, 1);
if ($mojiva_request) { stream_set_timeout($mojiva_request, 3000);
fwrite($mojiva_request, "GET /ad?".$mojiva_get." HTTP/1.0\r\n");
fwrite($mojiva_request, "Host: ads.mojiva.com\r\n");
fwrite($mojiva_request, "Connection: Close\r\n"); foreach ($_SERVER as
$name => $value) { fwrite($mojiva_request, "CS_$name: $value\r\n");
} fwrite($mojiva_request, "\r\n"); $mojiva_info =
stream_get_meta_data($mojiva_request); $mojiva_timeout =
$mojiva_info['timed_out']; $mojiva_contents = ""; $mojiva_body = false;
$mojiva_head = ""; while (!feof($mojiva_request) &&
!$mojiva_timeout) { $mojiva_line = fgets($mojiva_request);
if(!$mojiva_body && $mojiva_line == "\r\n") $mojiva_body =
true; if(!$mojiva_body) $mojiva_head .= $mojiva_line; if($mojiva_body
&& !empty($mojiva_line)) $mojiva_contents .= $mojiva_line;
$mojiva_info = stream_get_meta_data($mojiva_request); $mojiva_timeout =
$mojiva_info['timed_out']; } fclose($mojiva_request); if
(!preg_match('/^HTTP\/1\.\d 200 OK/', $mojiva_head)) $mojiva_timeout =
true; if($mojiva_timeout) return ""; return $mojiva_contents; }
}
?>
<?php
// copy this snippet elsewhere on your page for display more of ads
echo mojiva_ad($mojiva_params);
?>
