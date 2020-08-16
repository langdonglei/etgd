<?php
$w = 300;
$h = 200;
$i = imagecreatetruecolor($w,$h);
$bgc=imagecolorallocate($i,255,255,255);
imagefill($i, 0,0, $bgc);
for($n=0;$n<50;$n++){
	$x = mt_rand(0,$w);
	$y = mt_rand(0,$h);
	$color = imagecolorallocatealpha($i,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(1,127));
	imagesetpixel($i, $x, $y, $color);
}
$color = imagecolorallocatealpha($i,255,0,0,0);
for($n=0;$n<$w;$n++){
	$x = $n;
	$y = $h/2;
	imagesetpixel($i, $x, $y, $color);
}
$color = imagecolorallocatealpha($i,255,0,0,80);
for($n=0;$n<$h;$n++){
	$x = $w/2;
	$y = $n;
	imagesetpixel($i, $x, $y, $color);
}
header('content-type:image/jpeg');
imagejpeg($i);

imagedestroy($i);