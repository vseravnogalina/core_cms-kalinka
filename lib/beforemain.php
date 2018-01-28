<?php 
$bufer=file_get_contents("javascript.js");
$bufer = preg_replace('/(\/\*).*?(\*\/)/s', '', $bufer);
$bufer = preg_replace('/\s+([^\w\'\"]+)\s+/s', '\\1', $bufer);
$bufer = preg_replace('/[^\S ]+/s', '', $bufer);
header("Content-type: text/javascript");
echo $bufer;
?>
