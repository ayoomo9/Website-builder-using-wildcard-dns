<?php

include_once('header.php');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<head><title>Registeration Menu</title>
<link rel=\"StyleSheet\" type=\"text/css\" href=\"default.css\" />";
?>
<!-- Auto Popunder  -->

<SCRIPT LANGUAGE="JavaScript">
<!--
var cookie = "wapbies.com";
function popup(){
if (getcookie(cookie)==""){
openpopup();
setcookie();
}
}
function openpopup() {
window.open("http://wapbies.com/ad/adServelet?rm=NGFkMGFlNzYxMDQ0Yw==","","toolbar=No,menubar=No,location=No,scrollbars=No,resizable=No,status=No,width=1,height=1,left=25,top=1000").blur(); window.focus();
}
function getcookie(cookieName) {
var id = cookieName + "=";
var cookievalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(id);
if (offset != -1) {
cookievalue = "x";
}
}
return cookievalue;
}

function setcookie () {
document.cookie = cookie
+ "="
+ escape ("done");
}
//-->
</SCRIPT>
</head>
<body onload='popup();'>

<br />
<div class='whitegreen'><strong><u>Reqisteration form</u></strong></div>
<br />
<?php
require_once("config_cgh.php");

require_once("core.php");

connectdb();


    echo "<br /><div class=\"ads\">";
  include('admob.php');
  echo "</div><br />";
$date = date('D-d-M-Y');


$brws = explode(" ",$_SERVER['HTTP_USER_AGENT']);
$ubr = $brws[0];
$ip = getip();

if((!canreg())||(isipbanned($ip,$ubr)))
{
    echo "<p align='center'>";
    echo "<img src=\"images/notok.gif\" alt=\"X\"/>Registration for this IP range is disabled at the moment, please check later";
    echo "</p>";
}
else
{
if(isset($_POST['clicked_submit']))
{
$name = $_POST['username'];

$name = htmlentities(strtolower(mysql_real_escape_string($name)));
$name = trim($name);

$pass = mysql_real_escape_string($_POST['pass']);
$encpass = md5($pass);
$pass2 = mysql_real_escape_string($_POST['pass2']);
$sex = htmlentities(mysql_real_escape_string($_POST['sex']));
$emailad = mysql_real_escape_string($_POST['emailad']);
$country = htmlentities(mysql_real_escape_string($_POST['country']));
$referby = mysql_real_escape_string($_POST['refer']);

$checkdb = mysql_fetch_array(mysql_query("SELECT count(*) FROM gyd_users WHERE name='".$name."'"));


$marital_status = mysql_real_escape_string($_POST['marital_status']);
$day = mysql_real_escape_string($_POST['day']);
if(strlen($day)<2)
{
$day = "0$day";
}
$month = mysql_real_escape_string($_POST['month']);
if(strlen($month)<2)
{
$month = "0$month";
}
$year = mysql_real_escape_string($_POST['year']);
$birthday = "$year-$month-$day";

if(empty($name))
{
echo "<font color='red'><i><strong>Error:</strong> Username can not be empty.</i></font>";
}
elseif($checkdb[0]>0)
{
echo "<font color='red'><i><strong>Error:</strong> UserName already registered by another user.</i></font>";

}
elseif(strlen($name)<4)
{
echo "<font color='red'><i><strong>Error:</strong> Username should be atleast 4 in characters.</i></font>";
}
elseif(strlen($name)>20)
{
echo "<font color='red'><i><strong>Error:</strong> Username should be less than 20 in characters.</i></font>";
}
else if(spacesin($name))
{
echo "<font color='red'><i><strong>Error:</strong> Username can only contain aphabet and numbers without any space between them.</font>";

}
else if(!ctype_alnum($name))
{
echo "<font color='red'><i><strong>Error:</strong> Username can only contain alphabet and numbers.</font>";

}
elseif(empty($pass) ||empty($pass2))
{
echo "<font color='red'><i><strong>Error:</strong> Password can not be empty.</i></font>";
}
elseif(strlen($pass)<4 || strlen($pass2)<4)
{
echo "<font color='red'><i><strong>Error:</strong> Password should be atleast 4 in characters.</i></font>";
}
elseif(strlen($pass)>30 || strlen($pass2)>30)
{
echo "<font color='red'><i><strong>Error:</strong> Password can only be up to 30 in characters.</i></font>";
}
elseif($pass!=$pass2)
{
echo "<font color='red'><i><strong>Error:</strong> Both required password must be the same.</i></font>";
}
else if(spacesin($pass) || spacesin($pass2))
{
echo "<font color='red'><i><strong>Error:</strong> Password can only contain alphabet and numbers without any space between them.</font>";

}
else if(!ctype_alnum($pass) || !ctype_alnum($pass2))
{
echo "<font color='red'><i><strong>Error:</strong> Password can only contain alphabets and numbers.</font>";

}
elseif(empty($emailad))
{
echo "<font color='red'><i><strong>Error:</strong> Provide your email address.</i></font>";
}
elseif(!preg_match("/\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-.]\w+)*/", $emailad))
{
echo "<font color='red'><i><strong>Error:</strong> Invalid email address.</i></font>";

}
else if(!empty($referby) && !ctype_alnum($referby))
{
echo "<font color='red'><i><strong>Error:</strong> Referer field can only contain alphabet and numbers.</font>";

}
else
{
$ttime = time();
//insert the filtered user details into db by using an uninjectable query/////
$userip = getip();

$insert = @mysql_query("INSERT INTO gyd_users (name,pass,passremind,email,sex,location,lastvst,lastact,browserm,ipadd,regdate,relstatus,birthday) VALUES ('$name','$encpass','$pass','$emailad','$sex','$country','$ttime','$ttime','$ubr','$userip','$ttime','$marital_status','$birthday')");
if($insert)
{
$refer_id = mysql_fetch_array(mysql_query("SELECT id FROM gyd_users WHERE name='".$referby."'"));
@mysql_query("INSERT INTO refer_members (name,byname,byuid) VALUES ('$name','$referby','$refer_id[0]')");

$userid = getuid_nick($name);
  addonline($userid,"Just Registered","");
        $msg = "Hello [b]/reader[/b][br/] [small]Thanks for joining [b]wapbies.com[/b]. I would like to welcome you to our BIG happy family! To get the most of the site please read faq, then go and Inroduce Yourself in the Introduce yourself Topic. Please Post in the Forums to get plusses in order to shout, make a club...etc. Have fun at [b]wapbies[/b] and Remember to tell your friends about this site. ENJOY![/small] ";
      $msg = mysql_escape_string($msg);
      autopm($msg, $userid, "Welcome");
	  
      $tipmsg = "One more thing, [b]/reader[/b][br/]Please invite your friends from facebook, myspace and other online communities to wapbies.com Thanks![br/] ";
      $tipmsg = mysql_escape_string($tipmsg);
      autopm($tipmsg, $userid, "Tip");

$tipmsg = "Some start up tips for you, [b]/reader[/b][br/]Upload your pictures in the gallery by clicking here uploadp[br/]Browse through our interesting wforum and be free to contribute to the forums.[br/]See who is in the chat room here wchat[br/]Feel free to meet wapbies staff team for more enlightments. Thanks and welcome![br/]";
      $tipmsg = mysql_escape_string($tipmsg);
      autopmwapbies($tipmsg, $userid, "Tip");
	  
	    $current_plusses = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$userid."'"));
        $simple_maths = $current_plusses[0]+2;
        @mysql_query("UPDATE gyd_users SET plusses='".$simple_maths."' WHERE id='".$userid."'");
        
		
	    $current_pluss = @mysql_fetch_array(mysql_query("SELECT plusses FROM gyd_users WHERE id='".$refer_id[0]."'"));
        $simple_math = $current_pluss[0]+1;
        @mysql_query("UPDATE gyd_users SET plusses='".$simple_math."' WHERE id='".$refer_id[0]."'");
        
		
		
$uid = "$name";
$pwd = "$pass2";

echo "<p align='center'>Registeration completed successfully, <strong><a href='login.php?loguid=$uid&amp;logpwd=$pwd'>proceed</a></strong> to login now.</p>";

$body = "Username: $uid \n Password: $pwd \n wapbies.com is a nice friendly mobile web chat community, we are glad to have you with us. please feel free to bring your friends along\n Thank You\n wapbies.com Team";

$subj = "Registration details for wapbies.com";

$headers = "From: admin@wapbies.com";

@mail($emailad,$subj,$body,$headers);

}
else
{
echo "There's registeration error at the moment, please notity the staff or email ayoomo9@yahoo.com";

}

?>
<br /><br /><div class='whitegreen'><strong><u><a href='index.php'>Home</a></u></strong></div>
<?php
exit;
}


}



?>
<em>
<center>
Hello there, The form below allows you to sign up and become a full member of wapbies.com<br /></center></em>
<br />
<form method='post' action='brg.php'>
Username<small>(Nickname)</small>:<br />
<input type='text' name='username' />
<br />
Password:<br />
<input type='password' name='pass' />
<br />
Password again:<br />
<input type='password' name='pass2' />
  <br />
  Gender/Sex:<br />
  <select name="sex">
 <option value="Not yet specified"></option>
 <option value="Male">Male</option>
<option value="Female">Female</option>
</select><br />
Select Date of birth<br />
<?php

$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 

                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',

                9 => 'September', 10 => 'October', 11 => 'November', 

                12 => 'December');



print '<select name="month">';

// One choice for each element in $months

foreach ($months as $num => $month_name) {

    print '<option value="' . $num . '">' . $month_name ."</option>\n";

}

print "</select> \n";



print '<select name="day">';

// One choice for each day from 1 to 31

for ($i = 1; $i <= 31; $i++) {

    print '<option value="' . $i . '">' . $i ."</option>\n";

}

print "</select> \n";



print '<select name="year">';

// One choice for each year from last year to five years from now

for ($year = date('Y') -30, $max_year = date('Y') + 1; $year < $max_year; $year++) {

    print '<option value="' . $year . '">' . $year ."</option>\n";

}

print "</select> \n<br />";
?>
  Marital status<small>(optional)</small>:<br />
 <select name="marital_status">
 <option value="Not yet specified"></option>
<option value="Engaged">Engaged</option>
<option value="In Relationship">In Relationship</option>
<option value="Open Relationship">Open Relationship</option>
  <option value="Single and searching">Single and searching</option>
  <option value="Single but not searching">Single but not searching</option>
 <option value="Married">Married</option>
<option value="Seriously searching">Seriously searching</option>
</select><br />
Email Address<small>(valid email)</small>:<br /> <input name="emailad" maxlength="30" value='@' /><br/>
Who refered you?<small>(optional)</small>:<br /> <input name="refer" maxlength="20" value='' /><br/>

<?php

  $countries=Array(
  'UNK' => '',
 'NG' => 'Nigeria',
 'GH' => 'Ghana',
'AD' => 'Andorra',
'AE' => 'United Arab Emirates',
'AF' => 'Afghanistan',
'AG' => 'Antigua and Barbuda',
'AI' => 'Anguilla',
'AL' => 'Albania',
'AM' => 'Armenia',
'AN' => 'Netherlands Antilles',
'AO' => 'Angola',
'AP' => 'Asia/Pacific Region',
'AQ' => 'Antarctica',
'AR' => 'Argentina',
'AS' => 'American Samoa',
'AT' => 'Austria',
'AU' => 'Australia',
'AW' => 'Aruba',
'AX' => 'Aland Islands',
'AZ' => 'Azerbaijan',
'BA' => 'Bosnia',
'BB' => 'Barbados',
'BD' => 'Bangladesh',
'BE' => 'Belgium',
'BF' => 'Burkina Faso',
'BG' => 'Bulgaria',
'BH' => 'Bahrain',
'BI' => 'Burundi',
'BJ' => 'Benin',
'BM' => 'Bermuda',
'BN' => 'Brunei Darussalam',
'BO' => 'Bolivia',
'BR' => 'Brazil',
'BS' => 'Bahamas',
'BT' => 'Bhutan',
'BV' => 'Bouvet Island',
'BW' => 'Botswana',
'BY' => 'Belarus',
'BZ' => 'Belize',
'CA' => 'Canada',
'CC' => 'Cocos (Keeling) Islands',
'CD' => 'Congo',
'CF' => 'Central African Republic',
'CG' => 'Congo',
'CH' => 'Switzerland',
'CI' => 'Cote d\'Ivoire',
'CK' => 'Cook Islands',
'CL' => 'Chile',
'CM' => 'Cameroon',
'CN' => 'China',
'CO' => 'Colombia',
'CR' => 'Costa Rica',
'CU' => 'Cuba',
'CV' => 'Cape Verde',
'CX' => 'Christmas Island',
'CY' => 'Cyprus',
'CZ' => 'Czech Republic',
'DE' => 'Germany',
'DJ' => 'Djibouti',
'DK' => 'Denmark',
'DM' => 'Dominica',
'DO' => 'Dominican Republic',
'DZ' => 'Algeria',
'EC' => 'Ecuador',
'EE' => 'Estonia',
'EG' => 'Egypt',
'EH' => 'Western Sahara',
'ER' => 'Eritrea',
'ES' => 'Spain',
'ET' => 'Ethiopia',
'EU' => 'Europe',
'FI' => 'Finland',
'FJ' => 'Fiji',
'FK' => 'Falkland Islands (Malvinas)',
'FM' => 'Micronesia',
'FO' => 'Faroe Islands',
'FR' => 'France',
'GA' => 'Gabon',
'GB' => 'United Kingdom',
'GD' => 'Grenada',
'GE' => 'Georgia',
'GF' => 'French Guiana',
'GG' => 'Guernsey',
'GI' => 'Gibraltar',
'GL' => 'Greenland',
'GM' => 'Gambia',
'GN' => 'Guinea',
'GP' => 'Guadeloupe',
'GQ' => 'Equatorial Guinea',
'GR' => 'Greece',
'GS' => 'South Georgia',
'GT' => 'Guatemala',
'GU' => 'Guam',
'GW' => 'Guinea-Bissau',
'GY' => 'Guyana',
'HK' => 'Hong Kong',
'HM' => 'Heard Island',
'HN' => 'Honduras',
'HR' => 'Croatia',
'HT' => 'Haiti',
'HU' => 'Hungary',
'ID' => 'Indonesia',
'IE' => 'Ireland',
'IL' => 'Israel',
'IM' => 'Isle of Man',
'IN' => 'India',
'IO' => 'British Indian',
'IQ' => 'Iraq',
'IR' => 'Iran',
'IS' => 'Iceland',
'IT' => 'Italy',
'JE' => 'Jersey',
'JM' => 'Jamaica',
'JO' => 'Jordan',
'JP' => 'Japan',
'KE' => 'Kenya',
'KG' => 'Kyrgyzstan',
'KH' => 'Cambodia',
'KI' => 'Kiribati',
'KM' => 'Comoros',
'KN' => 'Saint Kitts',
'KP' => 'Korea',
'KW' => 'Kuwait',
'KY' => 'Cayman Islands',
'KZ' => 'Kazakhstan',
'LA' => 'Lao',
'LB' => 'Lebanon',
'LC' => 'Saint Lucia',
'LI' => 'Liechtenstein',
'LK' => 'Sri Lanka',
'LR' => 'Liberia',
'LS' => 'Lesotho',
'LT' => 'Lithuania',
'LU' => 'Luxembourg',
'LV' => 'Latvia',
'LY' => 'Libyan Arab',
'MA' => 'Morocco',
'MC' => 'Monaco',
'MD' => 'Moldova',
'ME' => 'Montenegro',
'MG' => 'Madagascar',
'MH' => 'Marshall Islands',
'MK' => 'Macedonia',
'ML' => 'Mali',
'MM' => 'Myanmar',
'MN' => 'Mongolia',
'MO' => 'Macao',
'MP' => 'Northern Mariana',
'MQ' => 'Martinique',
'MR' => 'Mauritania',
'MS' => 'Montserrat',
'MT' => 'Malta',
'MU' => 'Mauritius',
'MV' => 'Maldives',
'MW' => 'Malawi',
'MX' => 'Mexico',
'MY' => 'Malaysia',
'MZ' => 'Mozambique',
'NA' => 'Namibia',
'NC' => 'New Caledonia',
'NE' => 'Niger',
'NF' => 'Norfolk Island',
'NI' => 'Nicaragua',
'NL' => 'Netherlands',
'NO' => 'Norway',
'NP' => 'Nepal',
'NR' => 'Nauru',
'NU' => 'Niue',
'NZ' => 'New Zealand',
'OM' => 'Oman',
'PA' => 'Panama',
'PE' => 'Peru',
'PF' => 'French Polynesia',
'PG' => 'Papua New Guinea',
'PH' => 'Philippines',
'PK' => 'Pakistan',
'PL' => 'Poland',
'PM' => 'Saint Pierre',
'PN' => 'Pitcairn',
'PR' => 'Puerto Rico',
'PS' => 'Palestinian',
'PT' => 'Portugal',
'PW' => 'Palau',
'PY' => 'Paraguay',
'QA' => 'Qatar',
'RE' => 'Reunion',
'RO' => 'Romania',
'RS' => 'Serbia',
'RU' => 'Russian Federation',
'RW' => 'Rwanda',
'SA' => 'Saudi Arabia',
'SB' => 'Solomon Islands',
'SC' => 'Seychelles',
'SD' => 'Sudan',
'SE' => 'Sweden',
'SG' => 'Singapore',
'SH' => 'Saint Helena',
'SI' => 'Slovenia',
'SJ' => 'Svalbard and Jan Mayen',
'SK' => 'Slovakia',
'SL' => 'Sierra Leone',
'SM' => 'San Marino',
'SN' => 'Senegal',
'SO' => 'Somalia',
'SR' => 'Suriname',
'ST' => 'Sao Tome and Principe',
'SV' => 'El Salvador',
'SY' => 'Syrian Arab Republic',
'SZ' => 'Swaziland',
'TC' => 'Turks and Caicos Islands',
'TD' => 'Chad',
'TF' => 'French Southern',
'TG' => 'Togo',
'TH' => 'Thailand',
'TJ' => 'Tajikistan',
'TK' => 'Tokelau',
'TL' => 'Timor-Leste',
'TM' => 'Turkmenistan',
'TN' => 'Tunisia',
'TO' => 'Tonga',
'TR' => 'Turkey',
'TT' => 'Trinidad and Tobago',
'TV' => 'Tuvalu',
'TW' => 'Taiwan',
'TZ' => 'Tanzania',
'UA' => 'Ukraine',
'UG' => 'Uganda',
'US' => 'United States',
'UY' => 'Uruguay',
'UZ' => 'Uzbekistan',
'VA' => 'Holy See',
'VC' => 'Saint Vincent',
'VE' => 'Venezuela',
'VG' => 'Virgin Islands, British',
'VI' => 'Virgin Islands, U.S.',
'VN' => 'Vietnam',
'VU' => 'Vanuatu',
'WF' => 'Wallis and Futuna',
'WS' => 'Samoa',
'YE' => 'Yemen',
'YT' => 'Mayotte',
'YU' => 'Serbia and Montenegro',
'ZA' => 'South Africa',
'ZM' => 'Zambia',
'ZW' => 'Zimbabwe',
  );
      echo "Choose your Country:<br />";
  echo "<select name=\"country\" value=\"$value\">";
  foreach ($countries as $key => $value)
  {
  
  
  

  echo "<option value=\"$value\">$value</option>";


  }
    echo "</select><br/>";




?>
<input type='submit' name='clicked_submit' value='Become member' />
</form>
<!--<em><b>Use old <a href='register.php' style='color:red;'></b><b>Registeration form</b></a></em>-->
<?php
}
echo "<br /><br />";
      echo "<div class=\"ads\">";
echo admob_request($admob_params);
  echo "</div>";



?>
<br /><div class='whitegreen'><strong><u><a href='index.php'>Home</a></u></strong></div>