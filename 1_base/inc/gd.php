<?php
$i = imagecreatetruecolor(600,300);
//$i = imagecreate(300,200);
$bgc = imagecolorallocate($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
imagefill($i, 0, 0,$bgc);


//绘制文字
$c = imagecolorallocate($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

imagettftext($i,35,0,30,220,$c,'../font/ww.ttf','郑州市经七路888号');

$c = imagecolorallocate($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

imagettftext($i,35,0,30,180,$c,'../font/yu.ttf','郑州市经七路888号');

$c = imagecolorallocate($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

imagettftext($i,35,1,30,120,$c,'../font/hz.ttf','郑州市经七路888号');

header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
