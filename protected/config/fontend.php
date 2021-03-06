<?php

$fontend_settings = array(
    'defaultController' => 'index',
    'import' => array(
        'application.components.widget.*',
        'application.components.*'
    ),
//    'controllerMap' => array(
//        'min' => array(
//            'class' => 'ext.minScript.controllers.ExtMinScriptController'
//        ),
//    ),
    'components' => array(
//        'clientScript' => array(
//            'class' => 'ext.minScript.components.ExtMinScript'
//        ),
        'urlManager' => array(
            'class' => 'FontendUrlManager',
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                //http://jobsearcher140.com.au/min/serve?g=a64c4ff604d4e5a185c5d41b45473d39&t=1373601144&ext=css
//                'min/css/<g>-<t>' => array('min/css', 'urlSuffix' => '.css'),
//                //http://jobsearcher140.com.au/min/serve?g=8e56c78842eb25232806afeffa1e23bb&t=1373337990&ext=js
//                'min/js/<g>-<t>' => array('min/js', 'urlSuffix' => '.js'),
//                '/' => 'index/index',
//                '/nhung-cau-hoi-thuong-gap.html' => 'faq/index',
//                '/gioi-thieu.html' => 'index/aboutus',
//                '/about-us.html' => 'index/aboutus',
//                'rate-<os:(ios|android)>.html' => array('rate/index'),
//                //tac gia
                '/' => array('index/index'),
                '/m' => array('index/index'),
                '/m/' => array('index/index'),
                '/mobile' => array('index/index'),
                '/mobile/' => array('index/index'),
                'reviews.html' => array('category/index', 'defaultParams' => array('alias' => 'reviews')),
                'how-to.html' => array('category/index', 'defaultParams' => array('alias' => 'how-to')),
                'sitemap.xml' => array('sitemap/index'),
                'search' => array('search/index', 'urlSuffix' => '/'),
                'search/video' => array('search/video', 'urlSuffix' => '/'),
                'category/<alias:[a-zA-Z0-9\-]+>' => array('category/index', 'urlSuffix' => '.html'),
                'topics/<alias:[a-zA-Z0-9\-]+>' => array('tag/index', 'urlSuffix' => '.html'),
                'news/<alias:[a-zA-Z0-9\-]+>' => array('detail/index', 'urlSuffix' => '.html'),
                'reviews/<alias:[a-zA-Z0-9\-]+>' => array('review/index', 'urlSuffix' => '.html'),

                //video
                'video.html' => array('video/index'),
                'video/tag/<alias:[a-zA-Z0-9\-]+>' => array('video/tag', 'urlSuffix' => '.html'),
                'video/<alias:[a-zA-Z0-9\-]+>' => array('video/detail', 'urlSuffix' => '.html'),

                '<controller>' => '<controller>',
                '<controller>/<action>' => '<controller>/<action>',
            ),
        )
    )
);
return CMap::mergeArray(require(dirname(__FILE__) . '/main.php'), $fontend_settings);
