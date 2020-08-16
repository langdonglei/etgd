<?php
$w = 300;
$h = 200;
$i = imagecreate($w,$h);//建立图像画布资源(新建一个基于调色板的图像)
header('content-type:image/jpeg');//指定当前输出流类型
$red = imagecolorallocate($i,255,0,0);//根据画布资源，建立颜色变量
imagefill($i,0,0,$red);//使用颜色$red填充画布
imagejpeg($i);//将图像直接在游览器上显示输出
imagedestroy($i);//销毁$i占用内存资源
