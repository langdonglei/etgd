<?php
$w = 200;
$h = 100;
$i = imagecreatetruecolor($w,$h);

$bgc = imagecolorallocate($i,255,255,255);
imagefill($i,0,0,$bgc);


for($n=0;$n<=50;$n++){
	$x1 = mt_rand(0,$w);
	$x2 = mt_rand(0,$w);
	$y1 = mt_rand(0,$h);
	$y2 = mt_rand(0,$h);
	imagesetthickness($i,mt_rand(3,10)); //控制线条粗细
	$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(110,120));
	imageline($i, $x1, $y1, $x2, $y2, $color);//两个坐标确定一条直线
}
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
