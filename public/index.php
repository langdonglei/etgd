<?php
$image            = imagecreatetruecolor(1080, 100);
$color_background = imagecolorallocatealpha($image, 0, 51, 51, 0);
$color_number     = imagecolorallocatealpha($image, 255, 255, 255, 0);
$color_text       = imagecolorallocatealpha($image, 255, 255, 255, 0);
imagefill($image, 0, 0, $color_background);

$number_favorite  = 0;
$number_following = 0;
$number_follower  = 0;

$y = 58;
$x = 10;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', $number_favorite);
$x += 100;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', '获赞');
$x += 100;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', $number_following);
$x += 100;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', '关注');
$x += 100;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', $number_follower);
$x += 100;
imagettftext($image, 25, 0, $x, $y, $color_text, '../font/STHeiti.ttc', '粉丝');


header('content-type:image/jpeg');
imagejpeg($image);