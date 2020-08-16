<?php
//原图
$f = 'img/f.jpg';
$s = imagecreatefromstring(file_get_contents($f));
$sw = imagesx($s);
$sh = imagesy($s);
//目标图缩略
$w = 100;

//$h = 160;
//高度按比例
$h = $w/$sw*$sh;
$i = imagecreatetruecolor($w, $h);
//imagecopyresized($i, $s, 0, 0, 0, 0, $w, $h,$sw, $sh);
imagecopyresampled($i, $s, 0, 0, 0, 0, $w, $h,$sw, $sh);

//保存缩略图
imagejpeg($i,'img/f_s1.jpg');
//header('content-type:image/jpeg');
//imagejpeg($i);
//imagedestroy($i);
