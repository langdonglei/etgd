<?php
$f = 'img/g.jpg';
$i = imagecreatefromstring(file_get_contents($f));
$iw = imagesx($i);//取得画布图像的宽
$ih = imagesy($i);//取得画布图像的高
$fonts = ['font/yu.ttf','font/hz.ttf','font/ww.ttf'];
$font = $fonts[array_rand($fonts)];
$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(0,0));
$size = 25;
$angle = 0;
$text = '拓远教育 版权所有';


//计算文字宽高范围
$pos = imagettfbbox($size, $angle, $font, $text);
$tw = $pos[2]-$pos[6];
$th = $pos[3]-$pos[7];
//printf('width=%d,height=%d',$tw,$th);

//水印文字左上角
$x = 10;
$y = $th+10;
//水印文字右下角
$x = $iw-$tw-10;
$y = $ih-10;
//水印文字正中央
$x = ($iw-$tw)/2;
$y = ($ih-$th)/2+$th;
//随机位置
$x = mt_rand(10,($iw-$tw-10));
$y = mt_rand($th+10,$ih-10);
//水印文字下边水平中央  位置8
$x = ($iw-$tw)/2;
$y = $ih-10;

imagettftext($i, $size, $angle, $x, $y, $color, $font, $text);

header('content-type:image/jpeg');
imagejpeg($i);
//imagejpeg($i,date('YmdHis').'.jpg',75);
imagedestroy($i);
