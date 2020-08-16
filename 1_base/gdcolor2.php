<?php
$im = imagecreatefromjpeg('img/1.jpg');
$rgb = imagecolorat($im, 100, 100);
$r = ($rgb >> 16) & 0xFF;
$g = ($rgb >> 8) & 0xFF;
$b = $rgb & 0xFF;
echo $r,'<br>';
echo $g,'<br>';
echo $b,'<br>';
echo hexdec('0xff'),'<br>','0x'.dechex(255);
$i = @imagecreatetruecolor(20,50) or die('');
