<?php
session_start();

header("content-type:image/png");

$_SESSION["captcha"]=rand(1000,99999);
$text=$_SESSION["captcha"];
$width=220;
$height=70;
$image=imagecreate($width,$height);
imagecolorallocate($image,255,255,255);
$color=imagecolorallocate($image,255,0,0);
$size=30;
$font="font.ttf";
imagefttext($image,$size,10,65,60,$color,$font,$text);
imagepng($image);

?>