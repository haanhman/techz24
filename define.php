<?php
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Bangkok');
ini_set('session.cookie_lifetime', 3600 * 5); //thoi gian time out
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

global $mysql_config;
$mysql_config = array(
    'host' => 'localhost',
    'username' => 'eduuser',
    'password' => 'Eadux23X',
    'dbname' => 'db_techz24',
    'db_crawler' => 'db_tech24z_crawler'
);

if($_SERVER['HTTP_HOST'] == 'techz24.com' || $_SERVER['HTTP_HOST'] == 'www.techz24.com') {
    $mysql_config['username'] = 'anhmantk_admin';
    $mysql_config['password'] = 'MAoo[T^0gT0}';
    $mysql_config['dbname'] = 'anhmantk_techz24';
    $mysql_config['db_crawler'] = 'anhmantk_tech24z_crawler';
}

//so ban ghi tren 1 trang
define('PAGE_SIZE', 20);

define('ROOT_PATH', dirname(__FILE__));
define('FRAMEWORK_PATH', ROOT_PATH . '/framework');
define('LIB_PATH', ROOT_PATH . '/lib');
define('YII_DEBUG', $_GET['bug'] == 1 ? TRUE : FALSE);

if (YII_DEBUG == TRUE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
require_once ROOT_PATH . '/lib/function.php';
// include Yii bootstrap file
if (extension_loaded('apc') && ini_get('apc.enabled')) {
    require_once(FRAMEWORK_PATH . '/yiilite.php');
} else {
    require_once(FRAMEWORK_PATH . '/yii.php');
}