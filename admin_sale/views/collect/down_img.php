<?php


$file = "public/certificate/".$url.".jpg" ;
// var_dump($file);exit;
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".$file.";");
header("Content-Length:".filesize($file));
readfile($file);
exit;

?>