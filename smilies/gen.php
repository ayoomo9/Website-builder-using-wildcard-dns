<?php
$han = dir("/");
while($fnm = $han->read())
{
$file = explode(".",$fnm);
}
if(strlen($file[0])>2 && count($file)==2 && $file[2]!="php")
{
echo "INSERT INTO `ibwf_smilies` 
(`id`,`scode`,`imgsrc`,`hidden`)\n";
echo "VALUES (NULL,'-".$file[0]."-','smilies/'".$fnm."','0')";
}

?>

