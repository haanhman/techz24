<?php
require_once 'define.php';
$config = ROOT_PATH . '/protected/config/crontab.php';
// create a Web application instance and run
Yii::createConsoleApplication($config)->run();