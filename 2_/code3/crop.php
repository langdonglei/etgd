<?php
//原图
$f = 'img/o.jpg';
$s = imagecreatefromstring(file_get_contents($f));
$sw = imagesx($s);
$sh = imagesy($s);
//目标图缩略
$w = 200;

//$h = 160;
//高度按比例
$h = 300;
$i = imagecreatetruecolor($w, $h);
//imagecopyresized($i, $s, 0, 0, 0, 0, $w, $h,$sw, $sh);
//$x = 380;$y = 100;
$x = 120;$y = 80;
//$x = 650;$y = 5;
imagecopy($i, $s, 0, 0, $x,$y, $w, $h);
//保存缩略图
imagejpeg($i,'img/f_s1.jpg');
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
