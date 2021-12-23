<?php
header("Expires: Mon, 26 Jul 1977 05:00:00 GMT");
header("Last-Modified:".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=UTF-8");
echo "<meta http-equiv=\"expires\" content=\"0\" />";
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
$file = file_get_contents("log.txt");
  echo "$file";
?>