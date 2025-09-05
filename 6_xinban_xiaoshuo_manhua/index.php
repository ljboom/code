<?php
/**
*	刀客源码网
*
*	https://www.dkewl.com
*/
unset($_GET['m']);
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('PHP 版本必须大于等于5.3.0 !');

define('DIR_SECURE_CONTENT', 'powered by https://www.dkewl.com');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);

if(!APP_DEBUG){
	ini_set('display_errors', false);
}
if(!APP_DEBUG && !strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'micromessenger') && $_GET['c'] != 'Api'){
	die('请通过微信访问');
}
define('APP_PATH','./Application/');
require './#ThinkPHP/ThinkPHP.php';