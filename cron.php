<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件
header("Content-type: text/html; charset=utf-8");
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_CRONTAB', 1);
if(!$argv || count($argv) < 4){
	die('parmas_is_error');
}
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
define('HTML_PATH', './Application/Runtime/');
$_GET['m'] = (!isset($_GET['m']) || !$_GET['m']) ? $argv[1] : 'admin';
$_GET['c'] = (!isset($_GET['c']) || !$_GET['c']) ? $argv[2] : 'login';
$_GET['a'] = (!isset($_GET['a']) || !$_GET['a']) ? $argv[3] : 'index';
// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单