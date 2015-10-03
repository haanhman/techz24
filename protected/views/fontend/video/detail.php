<?php
$row = $data['row'];
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
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
                            <?php echo $data['row']['title'] ?>
                        </div>
                    </div>
                </div>
                <div
                    class="base-box blog-post p-single bp-horizontal-share post-198 post type-post status-publish format-standard has-post-thumbnail category-sports category-world tag-design tag-momizat tag-templates tag-themes tag-tutorial tag-wordpress"
                    itemscope="" itemtype="http://schema.org/Article">


                    <div class="video_frame">
                        <iframe width="820" height="480" src="http://www.youtube.com/embed/<?php echo $row['video_id'] ?>" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <h1 class="post-tile entry-title" itemprop="name"><?php echo $data['row']['title'] ?></h1>

                    <div class="mom-post-meta single-post-meta"></div>
                    <div class="entry-content">
                        <p><?php echo nl2br($row['description']) ?></p>

                        <?php
                        if (!empty($data['tags'])) {
                            echo '<div class="post-tags">';
                            echo '<span class="pt-title">Tags: </span>';
                            foreach ($data['tags'] as $tag) {
                                echo '<a rel="tag" href="' . $this->createUrl('video/tag', array('alias' => $tag['alias'])) . '" title="' . CHtml::encode($tag['name']) . '">' . $tag['name'] . '</a>';
                            }
                            echo '</div>';
                        }
                        ?>
                        <?php $this->renderPartial('//detail/social', array('data' => $data)) ?>
                        <div class="clear"></div>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1638273013053132";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-comments" data-href="<?php echo $url ?>" data-width="100%" data-numposts="5"></div>
                    </div>

                    <!-- entry content -->
                </div>
                <!-- base box -->


                <h2 class="single-title">Recent Videos</h2>

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

            </div>
            <!--main column-->

            <div class="clear"></div>
            <div class="clear"></div>
        </div>
        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->renderPartial('//index/ads-small', array('data' => $data)) ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>

        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>