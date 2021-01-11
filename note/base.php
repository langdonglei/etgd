<?php
$file  = 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=4132666838,2688935165&fm=26&gp=0.jpg';

# 创建资源
$image = imagecreatefromjpeg($file);
//$image = imagecreatefromstring(file_get_contents($file));
//$image = imagecreate(500, 500);
//$image = imagecreatetruecolor(500, 500);

# 资源信息
//$rgb = imagecolorat($image, 100, 100);
//$r = ($rgb >> 16) & 0xFF;
//$g = ($rgb >> 8) & 0xFF;
//$b = $rgb & 0xFF;
//var_dump($r, $g, $b);
//var_dump(getimagesize($file));
//var_dump(imagesx($image),imagesy($image));
//$box       = imagettfbbox(25, 0, 'font/yu.ttf', '汉');
//$boxWidth  = $box[2] - $box[6];
//$boxHeight = $box[3] - $box[7];

# 调整颜色
//$red = imagecolorallocatealpha($image, 255, 0, 0, 0);
//$green = imagecolorallocatealpha($image, 0, 255, 0, 20);
//$blue = imagecolorallocatealpha($image, 0, 0, 255, 30);

# 调整笔刷
//imagesetthickness($image, 3);

# 动作
//imagefill($image, 0, 0, $blue);
//imagesetpixel($image, 50, 100, $red);
//imagesetpixel($image, 50, 101, $red);
//imagesetpixel($image, 50, 102, $red);
//imageline($image, 0, 0, 100, 100, $red);
//imagestring($image, 5, 20, 50, 'hehe', $red);
//imagestringup($image, 4, 100, 100, 'hehe', $red);
//imagettftext($image, 30, 0, 10, 100, $red, 'font/hz.ttf', '呵呵');
//imagettftext(
//    $image,
//    25,
//    0,
//    0,
//    $boxHeight,
//    imagecolorallocatealpha(
//        $image,
//        255,
//        0,
//        0,
//        0),
//    'font/yu.ttf',
//    '呵呵'
//);
//imagecopyresized($dest = imagecreatetruecolor(1000,1000),$image,0,0,0,0,111,111,imagesx($image),imagesx($image));

# 输出
header('content-type:image/jpg');
imagejpeg($image);
