<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>

    <title><?php echo $this->_meta['title'] ?></title>

    <meta property="og:site_name" content="Techz24"/>
    <meta property="og:title" content="<?php echo CHtml::encode($this->_meta['title']) ?>"/>
    <meta property="og:url" content="http://www.techz24.com/"/>
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
    <meta name="author" content="anhmantk"/>


    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/fontend/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/fontend/techz24.css">
    <script src="<?php echo base_url() ?>/public/assets/fontend/js/modernizr.foundation.js"></script>


    <!-- switch theme  remove this on live project -->
    <link href="<?php echo base_url() ?>/public/assets/fontend/css/schemes/redori.css" id="switchyuk" rel='stylesheet'
          type='text/css'/>
    <!-- end switch theme -->
    <?php $this->renderPartial('//layouts/analyticstracking') ?>


<body>
<!-- Pushy Menu -->
<?php $this->renderPartial('//layouts/nav_mobile') ?>

<!-- Site Overlay -->
<div class="site-overlay"></div>
<div id="container">

    <header>
        <?php $this->renderPartial('//layouts/nav') ?>
    </header>
    <!-- End Header and Nav -->

    <!-- main content -->
    <?php echo $content ?>

    <!-- FOOTER AREA  -->
    <footer>
        <div class="row">
            <div class="twelve columns">
                <section id="footer">
                    <!-- widget tags -->
                    <div class="four columns">
                        <div class="widget wcategory">
                            <h3 class="blocktitle"><span>TAGS POST</span></h3>

                            <div class="tagcloud">
                                <a href="#" rel="tag">Style</a>
                                <a href="#" rel="tag">masonry</a>
                                <a href="#" rel="tag">Music</a>
                                <a href="#" rel="tag">art</a>
                                <a href="#" rel="tag">design</a>
                                <a href="#" rel="tag">creative</a>
                                <a href="#" rel="tag">nature</a>
                                <a href="#" rel="tag">word</a>
                                <a href="#" rel="tag">inspiration</a>
                                <a href="#" rel="tag">video</a>
                                <a href="#" rel="tag">quote</a>
                                <a href="#" rel="tag">sytle</a>
                                <a href="#" rel="tag">life</a>
                                <a href="#" rel="tag">mas</a>
                            </div>
                        </div>
                    </div>

                    <!-- widget latest comment -->
                    <div class="four columns gridfooter">
                        <div class="widget lastcomment">
                            <h3 class="blocktitle"><span>LATEST COMMENTS</span></h3>

                            <div class="listcomment">
                                <ul class="listcomment">
                                    <li>
                                        <div class="cthumb">
                                            <a href="#"><img
                                                    src="<?php echo base_url() ?>/public/assets/fontend/images/user1.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="dcomment">
                                            <a href="#"><strong>Richard</strong> on Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit. Nullam eu convallis mi, sit amet iaculis
                                                orci. Duis v...</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cthumb">
                                            <a href="#"><img
                                                    src="<?php echo base_url() ?>/public/assets/fontend/images/user2.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="dcomment">
                                            <a href="#"><strong>Richard</strong> on Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit. Nullam eu convallis mi, sit amet iaculis
                                                orci. Duis v...</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cthumb">
                                            <a href="#"><img
                                                    src="<?php echo base_url() ?>/public/assets/fontend/images/user3.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="dcomment">
                                            <a href="#"><strong>Richard</strong> on Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit. Nullam eu convallis mi, sit amet iaculis
                                                orci. Duis v...</a>
                                        </div>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>


                    <!-- widget contact -->
                    <div class="four columns">
                        <div class="widget wcontact">
                            <h3 class="blocktitle"><span>OUR CONTACT</span></h3>

                            <div class="dcontact">
                                <img src="<?php echo base_url() ?>/public/assets/fontend/images/logo.png" alt=""><br/>

                                <p>100 Biscayne Blvd. (North) 21st Floor <br/>New World Tower Miami,<br/> Florida 33148
                                </p>
                                <br/><br/>

                                <div class="sn">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clear"></div>
                    <!-- copyright -->
                    <div class="copyright twelve columns">
                        <div class="five columns">&copy; Copyright 2013, <span style="color:#FF0000;">EXTRA</span>NEWS
                        </div>
                        <div class="seven columns">
                            <div class="backtop">
                                <a href="#container" class="toppage">
                                    <i class="fa fa-chevron-up"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </footer>


</div>


<!-- jQuery UI Widget and Effects Core -->
<script src="<?php echo base_url() ?>/public/assets/fontend/js/foundation.min.js"></script>
<script src="<?php echo base_url() ?>/public/assets/fontend/js/jquery-ui-1.8.23.custom.min.js"
        type="text/javascript"></script>
<script src="../../../cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- Latest version (3.0.6) of jQuery Mouse Wheel by Brandon Aaron -->
<script src="<?php echo base_url() ?>/public/assets/fontend/js/jquery.mousewheel.min.js"
        type="text/javascript"></script>
<!-- jQuery Kinectic (1.5) used for touch scrolling -->
<script src="<?php echo base_url() ?>/public/assets/fontend/js/jquery.kinetic.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/public/assets/fontend/js/pushy.js"></script>
<script src="<?php echo base_url() ?>/public/assets/fontend/js/plugins.js"></script>
<script src="<?php echo base_url() ?>/public/assets/fontend/js/app.js"></script>
</body>
</html>
