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
                            </span>Video
                        </div>
                    </div>
                </div>
                <div
                    class="base-box blog-post p-single bp-horizontal-share post-198 post type-post status-publish format-standard has-post-thumbnail category-sports category-world tag-design tag-momizat tag-templates tag-themes tag-tutorial tag-wordpress"
                    itemscope="" itemtype="http://schema.org/Article">
                    <h2 class="post-tile entry-title" itemprop="name">Feature Video</h2>
                    <?php
                    $lists = array_chunk($data['featureVideo'], 2);
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
                <h2 class="single-title">Recent video</h2>

                <div class="base-box single-box">
                    <?php
                    $lists = array_chunk($data['listVideo'], 3);
                    foreach ($lists as $rows) {
                        $i = 1;
                        foreach ($rows as $item) {
                            $video_url = $this->createUrl('video/detail', array('alias' => $item['alias']));
                            ?>
                            <div class="one_third <?php if ($i == 3) echo 'last'; ?>">
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
                            if ($i == 3) {
                                echo '<div class="clear"></div>';
                            }
                            $i++;
                        }
                    }
                    ?>
                </div>

                <div class="clear"></div>
                <h2 class="single-title">Top views week</h2>

                <div class="base-box single-box">
                    <?php
                    $lists = array_chunk($data['topView'], 3);
                    foreach ($lists as $rows) {
                        $i = 1;
                        foreach ($rows as $item) {
                            $video_url = $this->createUrl('video/detail', array('alias' => $item['alias']));
                            ?>
                            <div class="one_third <?php if ($i == 3) echo 'last'; ?>">
                                <div class="video-item">
                                    <a href="<?php echo $video_url ?>">
                                        <div class="thumbnail">
                                            <div class="meta-carousel">
                                                <i class="fa fa-eye"></i> <?php echo $item['viewer'] ?>
                                            </div>
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
                            if ($i == 3) {
                                echo '<div class="clear"></div>';
                            }
                            $i++;
                        }
                    }
                    ?>
                </div>

            </div>
            <!--main column-->

            <div class="clear"></div>
        </div>
        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->widget('AdsWidget'); ?>
            <?php $this->widget('RecentVideoAndTagWidget'); ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>

        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>