<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en-US"> <!--<![endif]-->
<head>
    <?php
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $this->_meta['title'] ?></title>
    <meta property="og:site_name" content="Techz24"/>
    <meta property="og:title" content="<?php echo CHtml::encode($this->_meta['title']) ?>"/>
    <meta property="og:url" content="<?php echo $url ?>"/>
    <link rel="canonical" href="<?php echo $url ?>" />
    <?php
    if (!empty($this->_meta['image'])) {
        ?>
        <meta property="og:image" content="<?php echo $this->_meta['image'] ?>"/>
        <?php
    }
    ?>
    <meta property="og:description" content="<?php echo CHtml::encode($this->_meta['description']) ?>"/>

    <meta name="description" content="<?php echo CHtml::encode($this->_meta['description']) ?>"/>
    <meta name="keywords" content="<?php echo CHtml::encode($this->_meta['keywords']) ?>"/>
    <meta name="author" content="Techz24"/>

    <meta property="og:type" content="article"/>
    <meta property="og:description" content="<?php echo CHtml::encode($this->_meta['description']) ?>"/>
    <meta property="og:site_name" content="Techz24"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--    <link rel="shortcut icon" href="" />-->
    <!--    <link rel="apple-touch-icon" href="" />-->


    <!--[if lt IE 9]>
    <script src="/public/js/html5.js"></script>
    <script src="/public/js/IE9.js"></script>
    <![endif]-->

    <!-- This site is optimized with the Yoast WordPress SEO plugin v1.7.1 - https://yoast.com/wordpress/plugins/seo/ -->
    <meta name="robots" content="noindex,follow"/>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='bp-parent-css-css' href='/public/css/buddypress.css' type='text/css' media='screen'/>
    <link rel='stylesheet' id='contact-form-7-css' href='/public/css/styles.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='plugins-css' href='/public/css/plugins.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='main-css' href='/public/css/main.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='main-css' href='/public/css/techz24.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='responsive-css' href='/public/css/media.css' type='text/css' media='all'/>

    <script type='text/javascript' src='/public/js/jquery.js'></script>
    <script type='text/javascript' src='/public/js/widget-members.min.js' defer='defer'></script>
    <!--[if IE 8]><![endif]-->
    <?php
    if($_SERVER['HTTP_HOST'] == 'techz24.com' || $_SERVER['HTTP_HOST'] == 'www.techz24.com') {
        $this->renderPartial('//layouts/analyticstracking');
    }
    ?>
</head>

<body class="<?php echo $this->_style_class ?>">


<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class="boxed-wrap clearfix">
    <div id="header-wrapper">
        <!--statr topbar-->
        <!--end topbar-->
        <header class="header">
            <div class="inner">
                <div class="logo">

                    <?php
                    $have_h1 = false;
                    $controller = Yii::app()->controller->id;
                    $action = Yii::app()->controller->action->id;
                    $title = 'Product reviews and prices, and tech news - Techz24';
                    if($controller == 'video') {
                        $title = 'Video - Techz24';
                    }elseif($_SERVER['REDIRECT_URL'] == '/reviews.html') {
                        $title = 'Top 100 products reviews | Techz24';
                        $have_h1 = true;
                    }



                    if (($controller == 'video' || $controller == 'index') && $action == 'index') {
                        $have_h1 = true;
                    }


                    if($have_h1) {
                        echo '<h1>';
                    }



                    ?>

                    <a title="<?php echo CHtml::encode($title) ?>" href="<?php echo $this->createUrl('index/index') ?>">
                            <img class="tech-logo" src="/public/images/tech-logo.png"
                                 alt="<?php echo CHtml::encode($title) ?>"/>
                        <img class="mom_retina_logo tech-logo" src="/public/images/tech-logo.png"
                             alt="<?php echo CHtml::encode($title) ?>"/>
                        </a>
                    <?php
                    if($have_h1) {
                        echo '</h1>';
                    }
                    ?>
                </div>
                <div class="header-right">
                    <div class="mom-e3lanat-wrap  ">
                        <div class="mom-e3lanat " style="">
                            <div class="mom-e3lanat-inner">

                                <div class="mom-e3lan" data-id="3969" style=" ">
                                    <a target="_blank" href="http://ouo.io/ref/XiEqR34B" title="Techz24 - Make short links and earn the biggest money"><img src="<?php echo base_url() ?>/public/assets/fontend/img/ouo_ads.jpg" alt="Techz24 - Make short links and earn the biggest money"></a>
                                </div>
                                <!--mom ad-->
                            </div>
                        </div>
                        <!--Mom ads-->
                    </div>
                </div>
                <!--header right-->

                <div class="clear"></div>
            </div>
        </header>
    </div>
    <!--header wrap-->
    <?php $this->renderPartial('//layouts/nav') ?>
    <!--Navigation-->
    <?php echo $content  ?>
    <!--content boxed wrapper-->
    <?php $this->renderPartial('//layouts/footer') ?>

    <div class="clear"></div>
</div>
<!--Boxed wrap-->
<a href="#" class="scrollToTop button"><i class="enotype-icon-arrow-up"></i></a>


<script type='text/javascript' src='/public/js/sbp-lazy-load.min.js' defer='defer'></script>

<script type='text/javascript' src='/public/js/plugins.js' defer='defer'></script>
<script type='text/javascript' src='/public/js/main.js' defer='defer'></script>
<script type='text/javascript' src='/public/js/jquery.prettyPhoto.js'></script>
</body>
</html>