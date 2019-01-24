<?php

session_start();

header("content-type:image/png");

$_SESSION["captcha"]=rand(1000,99999);
$text=$_SESSION["captcha"];
$width=900;
$height=300;
$image=imagecreate($width,$height);
imagecolorallocate($image,255,255,255);
$color=imagecolorallocate($image,255,0,0);
$size=80;
$font="font.ttf";
imagefttext($image,$size,0,320,150,$color,$font,$text);
imagepng($image);

?>