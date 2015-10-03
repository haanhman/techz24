<div class="boxed-content-wrapper clearfix">

    <div class="nav-shaddow"></div>
    <div style="margin-top:-17px; margin-bottom:20px;"></div>
    <div class="inner">

        <div class="main_container">
            <div class="main-col">
                <div class="category-title">
                    <div class="mom_breadcrumb breadcrumb breadcrumbs">
                        <div class="breadcrumbs-plus">
                            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                <a itemprop="url" href="<?php echo $this->createUrl('index/index') ?>" class="home">
                                    <span itemprop="title">Home</span>
                                </a>
                            </span>
                            <span class="separator">
                                <i class="sep fa-icon-double-angle-right"></i>
                            </span>

                            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                <a itemprop="url" href="<?php echo $this->createUrl('video/index') ?>" class="home">
                                    <span itemprop="title">Video</span>
                                </a>
                            </span>

                            <span class="separator">
                                <i class="sep fa-icon-double-angle-right"></i>
                            </span>

                            <?php
                            $keyword = isset($_GET['keyword']) ? urlGETParams('keyword') : '';
                            ?>

                            <?php echo $keyword ?>

                        </div>
                    </div>
                </div>
                <div
                    class="base-box blog-post p-single bp-horizontal-share post-198 post type-post status-publish format-standard has-post-thumbnail category-sports category-world tag-design tag-momizat tag-templates tag-themes tag-tutorial tag-wordpress"
                    itemscope="" itemtype="http://schema.org/Article">
                    <h1 class="post-tile entry-title" itemprop="name"><?php echo $data['row']['name'] ?></h1>
                    <?php
                    $lists = array_chunk($data['listVideo'], 2);
                    foreach ($lists as $rows) {
                        $i = 1;
                        foreach ($rows as $item) {
                            $video_url = $this->createUrl('video/detail', array('alias' => $item['alias']));
                            ?>
                            <div class="one_half <?php if ($i == 2) echo 'last'; ?>">
                                <div class="video-item">
                                    <a href="<?php echo $video_url ?>">
                                        <div class="thumbnail">
                                            <div class="over">
                                                <i class="icon-play"></i>
                                            </div>
                                            <img src="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                                                 data-hidpi="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                                                 alt="<?php echo CHtml::encode($item['title']) ?>"
                                                 class="disappear appear">
                                        </div>
                                    </a>

                                    <h2><a href="<?php echo $video_url ?>"><?php echo $item['title'] ?></a></h2>
                                </div>
                            </div>
                            <?php
                            if ($i == 2) {
                                echo '<div class="clear"></div>';
                            }
                            $i++;
                        }
                    }
                    ?>
                    <!-- entry content -->
                </div>
                <!-- base box -->
                <div class="clear"></div>
                <?php
                if (!empty($data['listVideo'])) {
                    echo '<div class="dataTables_paginate paging_bootstrap">';
                    $this->widget('CLinkPager', array(
                        'header' => '',
                        'pages' => $pages,
                    ));
                    echo '</div>';
                }
                ?>

            </div>
            <!--main column-->

            <div class="clear"></div>
        </div>
        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->renderPartial('//index/ads-small', array('data' => $data)) ?>
            <?php $this->widget('RecentVideoAndTagWidget'); ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>

        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>