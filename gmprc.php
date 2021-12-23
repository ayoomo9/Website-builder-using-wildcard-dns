<?php include_once('antif.php');?>
<?php
include("phpcls/libgmailer.php");

function getnewm($gun, $gpw, $gtz)
{
    $gm = new GMailer();
    $gm->setLoginInfo($gun, $gpw, $gtz);
    $gloged = $gm->connect();
    echo $gm->lastActionStatus();
    if(!$gloged)
    {
      return 0;
    }else{
        $gm->fetchBox(GM_STANDARD, "inbox", 0);
        $shot = $gm->getSnapshot(GM_STANDARD);
        $nml = $shot->std_box_new;
        return $nml[0];
    }
    return 0;
}
?>
