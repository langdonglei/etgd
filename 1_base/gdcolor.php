<?php
$i = imagecreatetruecolor(300,200);
//$c = imagecolorallocate($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//$c = imagecolorallocate($i,0xff,0x00,0xff);//#ff00ff

$c = imagecolorallocatealpha($i,255,255,0,0);
imagefill($i,0,0,$c);
//0-255   reg green blue  255 0 0  相当于16进制颜色 0xff 0x00 0x00
$cc = imagecolorallocatealpha($i,255,0,0,0); //透明色 alpha 0(不透明)-127(全透明) 
imagestring($i,5,20,50,'php-hello',$cc);

header('content-type:image/jpeg');
imagejpeg($i);
//将画布资源保存成文件
//imagejpeg($i,uniqid().'.jpg',75);
imagedestroy($i);
?>