<?php

$backend_settings = array(
    'name' => 'Crawler',
    'defaultController' => 'index',
    'components' => array(
        'componentConfig' => array(
            'coreMessages' => array(
                'language' => 'vi'
            )
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                'crawler' => 'index/index',
                'crawler/<controller>' => '<controller>',
                'crawler/<controller>/<action>' => '<controller>/<action>',
            ),
        )
    )
);
return CMap::mergeArray(require(dirname(__FILE__) . '/main.php'), $backend_settings);