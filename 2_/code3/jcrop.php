<?php
//原图
$f = 'img/o.jpg';
$s = imagecreatefromstring(file_get_contents($f));
$sw = imagesx($s);
$sh = imagesy($s);

$w = $_POST['w'];
$h = $_POST['h'];
$i = imagecreatetruecolor($w, $h);

$x = $_POST['x'];
$y = $_POST['y'];
imagecopy($i, $s, 0, 0, $x,$y, $w, $h);
//保存缩略图


imagejpeg($i,'img/f_s1.jpg');
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
