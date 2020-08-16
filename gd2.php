<?php
function_exists('gd_info') || exit('error : no gd2');


$i = imagecreate(500, 500);
$red = imagecolorallocate($i, 255, 0, 0);
imagefill($i, 0, 0, $red);


header('content-type:image/jpeg');
imagejpeg($i);
imagedestroy($i);



# 添加水印 给指定的单个图片
function waterMarkOne(string $text, int $size, $red, $green, $blue, int $position) {
	$filename = '0.jpg';
	$fileinfo = getimagesize($filename);
	$pics = array('gif', 'jpg', 'png');
	$pics = array_flip($pics);
	if (in_array($fileinfo[2], $pics)) {
		$image = imagecreatefromstring(file_get_contents($filename));
		$image_width = $fileinfo[0];
		$image_height = $fileinfo[1];
		$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 0));
		$color_text = imagecolorallocate($image, $red, $green, $blue);
		//		$size = $image_width * $image_height * 0.0001;
		$angle = 0;
		//		$text = '文字水印';
		$fonts = array('msyh.ttf', 'hwhp.ttf', 'ygy.ttf');
		$fontfile = $fonts[array_rand($fonts)];
		$textbox = imagettfbbox($size, $angle, $fontfile, $text);
		$textbox_width = $textbox[4] - $textbox[0];
		$textbox_height = $textbox[1] - $textbox[5];
		//pos 1
		$x_left_top = $textbox_width * 0.1;
		$y_left_top = $textbox_height;
		//pos 2
		$x_middle_top = $image_width / 2 - $textbox_width / 2;
		$y_middle_top = $textbox_height;
		//pos 3
		$x_right_top = $image_width - $textbox_width * 1.2;
		$y_right_top = $textbox_height;
		//pos 4
		$x_left_bottom = $textbox_width * 0.1;
		$y_left_bottom = $image_height - $textbox_height * 0.5;
		//pos 5
		$x_middle_bottom = $image_width / 2 - $textbox_width / 2;
		$y_middle_bottom = $image_height - $textbox_height * 0.5;
		//pos 6
		$x_right_bottom = $image_width - $textbox_width * 1.2;
		$y_right_bottom = $image_height - $textbox_height * 0.5;
		//pos 7
		$x_center = $image_width / 2 - $textbox_width / 2;
		$y_center = $image_height / 2 - $textbox_height / 2 + $textbox_height;
		//pos 8
		$x_random = mt_rand($textbox_width * 0.1, $image_width - $textbox_width * 1.2);
		$y_random = mt_rand($textbox_height, $image_height - $textbox_height * 0.5);

		header('content-type:image/jpeg,gif,png');
		switch($position) {
			case 1 :
				imagettftext($image, $size, $angle, $x_left_top, $y_left_top, $color_text, $fontfile, $text);
				break;
			case 2 :
				imagettftext($image, $size, $angle, $x_middle_top, $y_middle_top, $color_text, $fontfile, $text);
				break;
			case 3 :
				imagettftext($image, $size, $angle, $x_right_top, $y_right_top, $color_text, $fontfile, $text);
				break;
			case 4 :
				imagettftext($image, $size, $angle, $x_left_bottom, $y_left_bottom, $color_text, $fontfile, $text);
				break;
			case 5 :
				imagettftext($image, $size, $angle, $x_middle_bottom, $y_middle_bottom, $color_text, $fontfile, $text);
				break;
			case 6 :
				imagettftext($image, $size, $angle, $x_right_bottom, $y_right_bottom, $color_text, $fontfile, $text);
				break;
			case 7 :
				imagettftext($image, $size, $angle, $x_center, $y_center, $color_text, $fontfile, $text);
				break;
			case 8 :
				imagettftext($image, $size, $angle, $x_random, $y_random, $color_text, $fontfile, $text);
				break;
		}
		imagejpeg($image);
	};
};

# 添加水印 给指定目录的所有图片
function waterMarkAll(){
	$docs = array_diff(scandir('.'), array('.', '..'));
	foreach ($docs as $v) {
		$ext = pathinfo($v, PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		if (is_dir($v)) {
		} else {
			switch($ext) {
				case 'gif' :
				case 'jpg' :
				case 'png' :
					$filename = $v;
					$fileinfo = getimagesize($filename);
					$pics = array('gif', 'jpg', 'png');
					$pics = array_flip($pics);
					if (in_array($fileinfo[2], $pics)) {
						$image = imagecreatefromstring(file_get_contents($filename));
						$image_width = $fileinfo[0];
						$image_height = $fileinfo[1];
						$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 0));
						$size = $image_width * $image_height * 0.0001;
						$angle = 0;
						$text = '文字水印';
						$fonts = array('msyh.ttf', 'hwhp.ttf', 'ygy.ttf');
						$fontfile = $fonts[array_rand($fonts)];
						$textbox = imagettfbbox($size, $angle, $fontfile, $text);
						$textbox_width = $textbox[4] - $textbox[0];
						$textbox_height = $textbox[1] - $textbox[5];
						$x_center = $image_width / 2 - $textbox_width / 2;
						$y_center = $image_height / 2 - $textbox_height / 2 + $textbox_height;
						//			$x_left_top = $textbox_width * 0.1;
						//			$y_left_top = $textbox_height;
						//			$x_middle_top = $image_width / 2 - $textbox_width / 2;
						//			$y_middle_top = $textbox_height;
						//			$x_right_top = $image_width - $textbox_width * 1.2;
						//			$y_right_top = $textbox_height;
						//			$x_left_bottom = $textbox_width * 0.1;
						//			$y_left_bottom = $image_height - $textbox_height * 0.5;
						//			$x_middle_bottom = $image_width / 2 - $textbox_width / 2;
						//			$y_middle_bottom = $image_height - $textbox_height * 0.5;
						//			$x_right_bottom = $image_width - $textbox_width * 1.2;
						//			$y_right_bottom = $image_height - $textbox_height * 0.5;
						imagettftext($image, $size, $angle, $x_center, $y_center, $color, $fontfile, $text);
						//			header('content-type:image/jpeg,gif,png');
	//					imagejpeg($image, uniqid() . ".$ext");
					};
			};
		};
	};
}

