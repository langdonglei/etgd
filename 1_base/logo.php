<?php
$f = 'img/g.jpg';
$i = imagecreatefromstring(file_get_contents($f));
$w = imagesx($i);
$h = imagesy($i);

//水印图标
$logo = imagecreatefromstring(file_get_contents('inc/logo3.png'));
$lw = imagesx($logo);
$lh = imagesy($logo);
//左上角
//$x = 15;$y = 15;
//正中央
//$x = ($w-$lw)/2;$y = ($h-$lh)/2;

for($n=0;$n<$h;$n++){
	$x = mt_rand(10,$w-$lw-10);
	if($n % ($lh+10) == 0 ){
		$y = $n + 10;
		//printf('x=%d,y=%d<br>',$x,$y);
	    imagecopy($i,$logo,$x,$y,0,0,$lw,$lh);
	}
}
header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);
