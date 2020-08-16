<?php
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
