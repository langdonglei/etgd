<?php
//统计文件 指定路径不能用\
function file_count($path = '.') {
	static $arr = array('rows_php' => 0, 'count_php' => 0, 'count_gif' => 0, 'count_jpg' => 0, 'count_png' => 0, 'count_others' => 0);
	$docs = array_diff(scandir($path), array('.', '..'));
	foreach ($docs as $value) {
		$newpath = "$path/$value";
		if (is_dir($newpath)) {
			file_count($newpath);
		} else {
			$ext = strtolower(pathinfo($newpath, PATHINFO_EXTENSION));
			switch($ext) {
				case 'php' :
					$arr['rows_php'] += count(file($newpath));
					$arr['count_php']++;
					break;
				case 'gif' :
					$arr['count_gif']++;
					break;
				case 'jpg' :
					$arr['count_jpg']++;
					break;
				case 'png' :
					$arr['count_png']++;
					break;
				default :
					$arr['count_others']++;
			}
		}
	}
	return $arr;
}

function mysort(array &$arr) {
	for ($a = 0; $a < count($arr); $a++) {
		for ($b = $a; $b < count($arr); $b++) {
			if ($arr[$a] < $arr[$b]) {
				$t = $arr[$a];
				$arr[$a] = $arr[$b];
				$arr[$b] = $t;
			}
		}
	}
}

function guid($name = '') {
	static $guid = '';
	$uid = uniqid('', true);
	$s = $name;
	$s .= $_SERVER['REQUEST_TIME'];
	$s .= $_SERVER['HTTP_USER_AGENT'];
	$s .= $_SERVER['SERVER_ADDR'];
	$s .= $_SERVER['REMOTE_ADDR'];
	$s .= $_SERVER['REMOTE_PORT'];
	$ss = $uid . $guid . md5($s);
	$hash = hash('ripemd128', $s);
	$guid = substr($hash, 0, 8) . '-' . substr($hash, 8, 4) . '-' . substr($hash, 12, 4) . '-' . substr($hash, 16, 4) . '-' . substr($hash, 20, 12);
	return $guid;
}

function get_char($length = 1) {
	$s = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$char = '';
	for ($i = 0; $i < $length; $i++) {
		$pos_rand = mt_rand(0, strlen($s) - 1);
		$char .= substr($s, $pos_rand, $length);
	}
	return $char;
}

//在指定jpg文件的目录下生成指定文件的缩略图，默认宽度200像素成比例。
function thumb($path, $width = 200, $height = null, $suffix = '_s') {
	if (file_exists($path)) {
		$path_info = pathinfo($path);
		$ext = strtolower($path_info['extension']);
		$new_suffix_ext = $suffix . '.' . $path_info['extension'];
		$new_file_path = $path_info['dirname'] . $path_info['filename'] . $new_suffix_ext;
		if (!file_exists($new_file_path) && $ext == 'jpg') {
			if ($file_info[2] == 2) {
				$file_info = getimagesize($path);
				$data = file_get_contents($path);
				$src_image = imagecreatefromstring($data);
				$src_w = $file_info[0];
				$src_h = $file_info[1];

				$dst_w = $width;
				if ($height == null) {
					$dst_h = $src_h / $src_w * $dst_w;
				} else {
					$dst_h = $height;
				}
				$dst_image = imagecreatetruecolor($dst_w, $dst_h);
				imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
				imagejpeg($dst_image, $new_file_path);
				imagedestroy($src_image);
				imagedestroy($dst_image);
			} else {
				return -1;
			}
		} else {
			return -2;
		}
	} else {
		return -3;
	}
}

function capp(int $width = 200, int $height = 100) {
	global $image;
	$image = imagecreatetruecolor($width, $height);
	$fontsize = $width / 5;
	$size1 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size2 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size3 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size4 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$color = color();
	$fontfile = $_SERVER['DOCUMENT_ROOT'] . '/xm/font/msyh.ttf';
	$chars = array(get_char(), get_char(), get_char(), get_char());

	$pt1 = 5;
	$pt2 = $pt1 + $width / 20 + $fontsize;
	$pt3 = $pt2 + $width / 20 + $fontsize;
	$pt4 = $pt3 + $width / 20 + $fontsize;

	$px1 = mt_rand($pt1, $pt1 + $width / 20);
	$px2 = mt_rand($pt2, $pt2 + $width / 20);
	$px3 = mt_rand($pt3, $pt3 + $width / 20);
	$px4 = mt_rand($pt4, $pt4 + $width / 20);

	$py1 = mt_rand($height * 0.5, $height * 0.7);
	$py2 = mt_rand($height * 0.5, $height * 0.7);
	$py3 = mt_rand($height * 0.5, $height * 0.7);
	$py4 = mt_rand($height * 0.5, $height * 0.7);

	$angle1 = mt_rand(-30, 30);
	$angle2 = mt_rand(-30, 30);
	$angle3 = mt_rand(-30, 30);
	$angle4 = mt_rand(-30, 30);

	imagettftext($image, $size1, $angle1, $px1, $py1, $color, $fontfile, $chars[0]);
	imagettftext($image, $size2, $angle2, $px2, $py2, $color, $fontfile, $chars[1]);
	imagettftext($image, $size3, $angle3, $px3, $py3, $color, $fontfile, $chars[2]);
	imagettftext($image, $size4, $angle4, $px4, $py4, $color, $fontfile, $chars[3]);

	for ($i = 0; $i < 50; $i++) {
		$x1 = mt_rand(0, $width);
		$y1 = mt_rand(0, $height);
		$x2 = mt_rand(0, $width);
		$y2 = mt_rand(0, $height);
		imagesetthickness($image, mt_rand(2, 5));
		$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), mt_rand(50, 100));
		imageline($image, $x1, $y1, $x2, $y2, $color);
	}
	header('content-type:image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
}

function cap($length = 4, $width = 100, $height = 50) {
	session_start();
	global $image;
	require_once $_SERVER['DOCUMENT_ROOT'] . 'xm/inc/fun.php';
	$image = imagecreatetruecolor($width, $height);
	$size = $width / 5;
	$color = color();
	$fontfile = $_SERVER['DOCUMENT_ROOT'] . '/xm/font/msyh.ttf';
	$cap = '';
	for ($i = 0; $i < $length; $i++) {
		$angle = mt_rand(-40, 40);
		$x = $size / 5 + $i * $size;
		$y = mt_rand($height - $size, $height);
		$text = get_char();
		$cap .= $text;
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	}
	$_SESSION['cap'] = $cap;
	$_SESSION['captime'] = time();
	for ($i = 0; $i < 10; $i++) {
		$x = mt_rand(0, $width);
		$y = mt_rand(0, $height);
		$text = get_char();
		$color = color('random', mt_rand(50, 127));
		$angle = mt_rand(-30, 30);
		$size = mt_rand(10, 15);
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	}
	header('content-type:image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
}

function color($color = 'random', $alpha = 0) {
	global $image;
	switch($color) {
		case 'red' :
			$color = imagecolorallocatealpha($image, 255, 0, 0, $alpha);
			break;
		case 'green' :
			$color = imagecolorallocatealpha($image, 0, 255, 0, $alpha);
			break;
		case 'blue' :
			$color = imagecolorallocatealpha($image, 0, 0, 255, $alpha);
			break;
		case 'yellow' :
			$color = imagecolorallocatealpha($image, 255, 255, 0, $alpha);
			break;
		case 'purple' :
			$color = imagecolorallocatealpha($image, 0xff, 0x33, 0xff, $alpha);
			break;
		case 'random' :
			$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), $alpha);
			break;
		default :
			$p = '|[0-9a-f]{6}|i';
			if (preg_match_all($p, $color, $rgb)) {
				$rgbs = str_split($rgb[0][0], 2);
				$color = imagecolorallocate($image, hexdec($rgbs[0]), hexdec($rgbs[1]), hexdec($rgbs[2]));
			} else {
				$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), $alpha);
			}
			break;
	}
	return $color;
}

function back() {
	//	echo '<br>5秒后退<br>';
	echo '<script>setTimeout(function(){history.go(-1)},10000)</script>';
}

function check_file_type($filename) {
	$file = fopen($filename, "rb");
	$bin = fread($file, 2);
	fclose($file);
	$strInfo = @unpack("c2chars", $bin);
	$typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
	$fileType = '';
	switch ($typeCode) {
		case 7790 :
			$fileType = 'exe';
			break;
		case 7784 :
			$fileType = 'midi';
			break;
		case 8297 :
			$fileType = 'rar';
			break;
		case 255216 :
			$fileType = 'jpg';
			break;
		case 7173 :
			$fileType = 'gif';
			break;
		case 6677 :
			$fileType = 'bmp';
			break;
		case 13780 :
			$fileType = 'png';
			break;
		case 6033 :
			$fileType = 'html';
			break;
		case 6063 :
			$fileType = 'php';
			break;
		default :
			$fileType = 'unknown' . $typeCode;
	}
	//Fix
	if ($strInfo['chars1'] == '-1' && $strInfo['chars2'] == '-40') {
		return 'jpg';
	}
	if ($strInfo['chars1'] == '-119' && $strInfo['chars2'] == '80') {
		return 'png';
	}
	return $fileType;
}

//扫描指定路径下所有文件的MD5，返回所有文件的MD5数组。
function md5s($path) {
	$docs = array_diff(scandir($path), array('.', '..'));
	$md5s = array();
	foreach ($docs as $value) {
		$md5s[] = md5_file($path . $value);
	}
	return $md5s;
}

function download($dir, $name) {
	$path = $dir . $name;
	if (file_exists($path)) {
		$handle = fopen($path, 'r');
		$filesize = filesize($path);
		header("Content-type:application/octet-stream");
		header("Accept-Ranges:bytes");
		header("Accept-Length:" . $filesize);
		header("Content-Disposition: attachment; filename=" . $name);
		while (!feof($file)) {
			echo fread($file, 102400);
		}
		fclose($file);
		return;
	}
}

//单多标签不能混用
function upload() {
	require_once $_SERVER['DOCUMENT_ROOT'] . 'xm/inc/fun.php';
	$dir = 'upload/' . date('ym') . '/';
	if (!is_dir($dir)) {
		mkdir($dir, 0777, true);
	}
	if (!empty($_FILES)) {
		$uploads = array();
		$maxsize = 1024 * 1024 * 20;
		$allow = array('jpg', 'gif', 'png', 'rar', 'zip');
		foreach ($_FILES as $file) {
			if (!is_array($file['name'])) {
				$name = $file['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$filename = pathinfo($name, PATHINFO_FILENAME);
				if ($file['error'] == 0 && $file['size'] <= $maxsize && in_array($ext, $allow)) {
					$num = 0;
					while (file_exists($dir . $name)) {
						$num++;
						$name = $filename . '(' . $num . ')' . $ext;
					}
					if (move_uploaded_file($file['tmp_name'], $dir . $name)) {
						$uploads[] = $name;
					} else {
						return -1;
					}
				} else {
					return -2;
				}
			} else {
				foreach ($file['name'] as $key => $value) {
					$name = $value;
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					$filename = pathinfo($name, PATHINFO_FILENAME);
					if ($file['error'][$key] == 0 && $file['size'][$key] <= $maxsize && in_array($ext, $allow)) {
						$num = 0;
						while (file_exists($dir . $name)) {
							$num++;
							$name = $filename . '(' . $num . ')' . $ext;
						}
						if (move_uploaded_file($file['tmp_name'][$key], $dir . $name)) {
							$uploads[] = $name;
						} else {
							return -3;
						}
					} else {
						return -4;
					}
				}
			}
			return $uploads;
		}
	}
}



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


function mark_text($path, $text, $size = 'auto', $position = 1, $color = 'red') {
	require_once $_SERVER['DOCUMENT_ROOT'].'xm/inc/fun.php';
	global $image;
	

	$info = getimagesize($path);
	$image_width = $info[0];
	$image_height = $info[1];

	$image = imagecreatefromstring(file_get_contents($path));
	$color = imagecolorallocate($image, $red, $green, $blue);

	$size = $size;
	$angle = 0;
	$fontfile = 'msyh.TTF';
	$text = $text;
	$textbox = imagettfbbox($size, $angle, $fontfile, $text);

	$textbox_width = $textbox[4] - $textbox[0];
	$textbox_height = $textbox[1] - $textbox[5];

	if ($image_width < $textbox_width || $image_height < $textbox_height) {
		echo '字体比图片大,无法显示';
	} else {

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
	}
}


//随机验证码，位置不好，不想调了，太费时间。用循环简化代码。需另加字体文件。
function cap(int $width = 200, int $height = 100) {
	$image = imagecreatetruecolor($width, $height);

	for ($i = 0; $i < 50; $i++) {
		$x1 = mt_rand(0, $width);
		$y1 = mt_rand(0, $height);
		$x2 = mt_rand(0, $width);
		$y2 = mt_rand(0, $height);
		imagesetthickness($image, mt_rand(2, 5));
		$color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), mt_rand(50, 100));
		imageline($image, $x1, $y1, $x2, $y2, $color);
	}
	$fontfile=__DIR__.'/msyh.ttf';
	$fontsize = $width / 5;
	$pt1 = 5;
	$pt2 = $pt1 + $width / 20 + $fontsize;
	$pt3 = $pt2 + $width / 20 + $fontsize;
	$pt4 = $pt3 + $width / 20 + $fontsize;

	$px1 = mt_rand($pt1, $pt1 + $width / 20);
	$px2 = mt_rand($pt2, $pt2 + $width / 20);
	$px3 = mt_rand($pt3, $pt3 + $width / 20);
	$px4 = mt_rand($pt4, $pt4 + $width / 20);

	$py1 = mt_rand($height * 0.5, $height * 0.7);
	$py2 = mt_rand($height * 0.5, $height * 0.7);
	$py3 = mt_rand($height * 0.5, $height * 0.7);
	$py4 = mt_rand($height * 0.5, $height * 0.7);

	$size1 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size2 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size3 = mt_rand((int)$fontsize * 0.5, $fontsize);
	$size4 = mt_rand((int)$fontsize * 0.5, $fontsize);

	$angle1 = mt_rand(-30, 30);
	$angle2 = mt_rand(-30, 30);
	$angle3 = mt_rand(-30, 30);
	$angle4 = mt_rand(-30, 30);

	$color = imagecolorallocatealpha($image, mt_rand(100, 255), mt_rand(100, 255), mt_rand(100, 255), mt_rand(0, 10));
	$s = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$arr = str_split($s);
	$n[] = $arr[mt_rand(0, count($arr) - 1)];
	$n[] = $arr[mt_rand(0, count($arr) - 1)];
	$n[] = $arr[mt_rand(0, count($arr) - 1)];
	$n[] = $arr[mt_rand(0, count($arr) - 1)];
	imagettftext($image, $size1, $angle1, $px1, $py1, $color, $fontfile, $n[0]);
	imagettftext($image, $size2, $angle2, $px2, $py2, $color, $fontfile, $n[1]);
	imagettftext($image, $size3, $angle3, $px3, $py3, $color, $fontfile, $n[2]);
	imagettftext($image, $size4, $angle4, $px4, $py4, $color, $fontfile, $n[3]);

	header('content-type:image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
};


