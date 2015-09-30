<?php
//phpinfo();

//  /opt/php54/bin/php /home4/anhmantk/public_html/a.php
//  php -q /home4/anhmantk/public_html/a.php
//  http://support.hostgator.com/articles/cpanel/what-do-i-put-for-the-cron-job-command
$str = 'vai ca hang 2222  2222: ' . date('d/m/Y H:i:s');
file_put_contents(dirname(__FILE__) . '/a.txt', $str);