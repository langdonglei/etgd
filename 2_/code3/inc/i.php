<?php
function text($path, $size = 20, $text = '版权所有', $color = 'rand', $pos = 5, $flag = true, $type = "_t") {
	if (is_dir($path)) {
		$dd = array_diff(scandir($path),['.','..']);
		foreach($dd as $v){
			$vv = "$path/$v";
			text($vv,$size, $text,$color,$pos,$flag,$type);
		}
	} else {
		$i = imagecreatefromstring(file_get_contents($path));
		$w = imagesx($i);
		$h = imagesy($i);

		$angle = 0;
		$font = __DIR__ . '/t.ttf';
		$fos = imagettfbbox($size, $angle, $font, $text);
		$tw = $fos[2] - $fos[6];
		$th = $fos[3] - $fos[7];
		switch($pos) {
			case 1 :
				$x = 10;
				$y = $th + 10;
				break;
			case 2 :
				$x = 10;
				$y = $th + 10;
				break;
			case 3 :
				$x = 10;
				$y = $th + 10;
				break;
			case 4 :
				$x = 10;
				$y = $th + 10;
				break;
			case 5 :
				$x = ($w - $tw) / 2;
				$y = ($h - $th) / 2 + $th;
				break;
			case 6 :
				$x = 10;
				$y = $th + 10;
				break;
			case 7 :
				$x = 10;
				$y = $th + 10;
				break;
			case 8 :
				$x = 10;
				$y = $th + 10;
				break;
			case 9 :
				$x = 10;
				$y = $th + 10;
				break;
			default :
				$x = 0;
				$y = 0;
				break;
		}
		imagettftext($i, $size, $angle, $x, $y, c($i, $color), $font, $text);
		if ($flag) {
			imagejpeg($i, $path);
		} else {
			$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			$path = str_ireplace($ext, $type . $ext, $path);
			imagejpeg($i, $path);
		}
		imagedestroy($i);
	}
}

function logo(){
	
}

function c($i, $color = 'rand', $alpha = 0) {
	switch($color) {
		case 'red' :
			$c = imagecolorallocatealpha($i, 255, 0, 0, $alpha);
			break;
		default :
			$c = imagecolorallocatealpha($i, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 127));
			break;
	}
	return $c;
}
