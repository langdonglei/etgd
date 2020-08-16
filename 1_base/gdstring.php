<?php
$w = 500;
$h = 300;
//$i = imagecreatetruecolor($w,$h);
//$bgc = imagecolorallocate($i,255,255,255);
//imagefill($i,0,0,$bgc);
$i = imagecreatefromstring(file_get_contents('img/0.jpg'));
$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(0,80));
imagestring($i,5,50,30,'php-china2008', $color);
$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(0,80));
imagestringup($i, 4, 100,100,'mysql22222', $color);
//支持中文
$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(0,80));
imagettftext($i,30,0, 10,100, $color,'font/hz.ttf','郑州拓远教育公司');
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
