<?php
$img = 'img/0.jpg';
//$info = getimagesize($img);
//echo '<pre>';
//print_r($info);
//list($w,$h,$t,$i) = $info;
//printf('w=%d,h=%d',$w,$h);
//echo $i;
//echo $t;


$i = imagecreatefromstring(file_get_contents($img));
$w = imagesx($i);
$h = imagesy($i);
printf('width=%d，height=%d',$w,$h);
