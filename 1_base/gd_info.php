<?php
if(function_exists('gd_info')){
	echo '<pre>';
	print_r(gd_info());
}else{
	exit('当前环境未开启GD库');
	//如果没有开启，请打开php.ini 
	//找到 ;extension=php_gd2.dll 去年分号，就是开启
}
