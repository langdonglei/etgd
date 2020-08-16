<?php
$file = 'img/1.jpg';
$i = imagecreatefromstring(file_get_contents($file));
//header('content-type:image/jpeg');
//header('content-type:image/png');
header('content-type:image/gif');
imagejpeg($i);
imagedestroy($i);
