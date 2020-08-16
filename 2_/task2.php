<?php
function watermark(string $filename, string $text, int $size, int $position, int $red, int $green, int $blue) {
	$fileinfo = getimagesize($filename);

	$image_width = $fileinfo[0];
	$image_height = $fileinfo[1];
	$image_type = $fileinfo[2];

	$pics = array_flip(array('gif', 'jpg', 'png'));
	if (in_array($image_type, $pics)) {
		$path=realpath($filename);
		$image = imagecreatefromstring(file_get_contents($path));
		$color = imagecolorallocate($image, $red, $green, $blue);

		$size = $size;
		$angle = 0;
		$fontfile = 'msyh.TTF';
		$text = $text;
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
				imagettftext($image, $size, $angle, $x_left_top, $y_left_top, $color, $fontfile, $text);
				break;
			case 2 :
				imagettftext($image, $size, $angle, $x_middle_top, $y_middle_top, $color, $fontfile, $text);
				break;
			case 3 :
				imagettftext($image, $size, $angle, $x_right_top, $y_right_top, $color, $fontfile, $text);
				break;
			case 4 :
				imagettftext($image, $size, $angle, $x_left_bottom, $y_left_bottom, $color, $fontfile, $text);
				break;
			case 5 :
				imagettftext($image, $size, $angle, $x_middle_bottom, $y_middle_bottom, $color, $fontfile, $text);
				break;
			case 6 :
				imagettftext($image, $size, $angle, $x_right_bottom, $y_right_bottom, $color, $fontfile, $text);
				break;
			case 7 :
				imagettftext($image, $size, $angle, $x_center, $y_center, $color, $fontfile, $text);
				break;
			case 8 :
				imagettftext($image, $size, $angle, $x_random, $y_random, $color, $fontfile, $text);
				break;
		}
		imagejpeg($image);
	};
};
watermark('0.jpg', 'fasdf', 60, 7, 255, 255, 0);
