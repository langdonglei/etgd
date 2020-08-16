<?php
//$w = 300;
//$h = 200;
//$i = imagecreatetruecolor($w,$h);

$i = imagecreatefromjpeg('img/0.jpg');
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
