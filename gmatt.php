
<?php

include("phpcls/libgmailer.php");
$aid = $_GET["aid"];
$mid = $_GET["mid"];
$ugun = $_GET["ugun"];
$ugpw = $_GET["ugpw"];
$b = $_GET["b"];
$gm = new GMailer();
$gm->setLoginInfo($ugun, $ugpw,0);
$gm->connect();
$gm->fetchBox(GM_CONVERSATION, $mid, $b);
$shot = $gm->getSnapshot(GM_CONVERSATION);
$att = $shot->conv[0]["attachment"][$aid];
$attid = $att["id"];
$type = $att["type"];
$fname = $att["filename"];
$size = $att["size"];
$type = correct_mime($type,$fname);
header("Content-Type: ".$type);
header("Content-Length: ".$size);
header('Content-Disposition: attachment; filename="'.str_replace(" ", "_", $fname).'"');
$gm->getAttachment($attid, $mid, "php://output", false);

function get_ext($file_name) {
	$file_ext = array_pop(explode('.', $file_name));
	return $file_ext;
}

function correct_mime($mime_type, $filename) {
	if (($mime_type == "application/zip") or ($mime_type == "application/x-zip-compressed")) {
		if (get_ext($filename) == "jar") $mime_type = "application/java-archive";
	} elseif ($mime_type == "application/octet-stream" or $mime_type == "application/x-unknown-content-type") {
		switch(get_ext($filename)) {
			case "sis":		$mime_type = "application/vnd.symbian.install";	break;
			case "nth":		$mime_type = "application/vnd.nok-s40theme"; 	break;
/* 			case "3gp":		$mime_type = "video/3gpp"; 						break; */
/* 			case "thm":		$mime_type = "application/vnd.eri.thm"; 		break; */

/*
addType application/vnd.eri.thm thm
.tsk (Pocket PC themes)
.hme (Smartphones)
*/
			default:										break;
		}
	}
	return $mime_type;
}

?>
