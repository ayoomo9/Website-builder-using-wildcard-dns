
<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");

$destination = $_GET['url'];


//check perhaps it get http:// before or just add http:// automatically
if(substr($destination,0,7)=="http://") // count characters from 0 to 7 and check if its http://
{
$destination = $_GET['url'];
}
else
{
$destination = "http://".$_GET['url'];
}
$stripped_url = explode("//",$destination);
?>
<!-- Meta Tags  -->

<TITLE>Redirecting to <?= $destination; ?>...bye!</TITLE>
<META NAME="MSSmartTagsPreventParsing" content="true">
<META NAME="DESCRIPTION" CONTENT="Chating Mobile site">
<META NAME="KEYWORDS" CONTENT="chat,forum, free, wapmasters,earn,program,ayoomo9,advertiser,publisher,promote,ads,mobile,free,marketing">
<META NAME="PUBLISHER" CONTENT="www.wapbies.com">
<META NAME="LANGUAGE" CONTENT="English">
<META NAME="COPYRIGHT" CONTENT="ayoomo9 (c) 2010. All right reserved">
<meta http-equiv="refresh" content="2; URL=<?= $destination; ?>" />
<META NAME="ROBOTS" CONTENT="index">
<META NAME="ROBOTS" CONTENT="follow">
<META NAME="REVISIT-AFTER" CONTENT="30 days">

<meta http-equiv="Cache-Control" content="must-revalidate" />
<meta http-equiv="Cache-Control" content="no-cache"/>
<link rel="StyleSheet" type="text/css" href="default.css" />
</head>

<body>

<br /><div class='center'><strong><u>Redirecting to <?= $destination; ?></u></strong></div>
<div class='tab'></div>
<br />
<div class='center'>
<div class='alignment'>
<?php

session_destroy();

echo "You are about to leave this site to $stripped_url[1], your logged in session is now destroyed for your safety.<br />
<br /><a href='$destination' target='_blank'><strong>Continue</strong></a><br /><br />";


?>
</div></div>
<br />
<div class='footer'>
<p align='center'>
[<a href='index.php' style='font-weight:bold; text-decoration:none; color:grey; background-color:gold;'>Home</a>]
</p>
</div>
<?php
echo "</body></html>";
?>