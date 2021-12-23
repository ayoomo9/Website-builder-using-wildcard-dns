

<?php


$text = $_SERVER['HTTP_USER_AGENT'];
$var[0] = 'webstripper.net';
$var[1] = 'proxyblind.org';
$var[2] = 'anonymouse.org';
$var[3] = 'HTTrack';
$var[4] = 'http://www.verkata.com';
$var[5] = 'ripe';
$var[6] = 'www.iwebtool.com';
$var[7] = 'anonymouse';
$var[8] = 'hidemyass.com';
$var[9] = 'unknown';
$var[10] = 'webreaper.net';
$var[11] = 'proxiesusa.com';
$var[12] = 'eXtractor';
$var[12] = 'Nokia5500d/2.0';
$var[13] = 'Nokia5500d/';
$var[14] = 'WebZIP';
$var[15] = 'WebCopier';
$var[16] = 'Nokia5500d/';
$var[17] = 'WebsiteSite';
$var[18] = 'ExtractorPro';
$var[19] = 'LeechFTP';
$var[20] = 'Offline';
$result = count($var);

$result = count($var);

for ($i=0;$i<$result;$i++)
{
$ausg = stristr($text, $var[$i]);
if(strlen($ausg)>0)
{

  header('Location:http://easymobad.com');


break;

}

}
?>
