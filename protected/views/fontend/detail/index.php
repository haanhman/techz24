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
                                <a itemprop="url"
                                   href="<?php echo $this->createUrl('category/index', array('alias' => $data['category']['alias'])) ?>">
                                    <span itemprop="title"><?php echo $data['category']['name'] ?></span>
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
                    class="video_frame post-content base-box blog-post p-single bp-horizontal-share post-198 post type-post status-publish format-standard has-post-thumbnail category-sports category-world tag-design tag-momizat tag-templates tag-themes tag-tutorial tag-wordpress"
                    itemscope="" itemtype="http://schema.org/Article">

                    <h1 class="post-tile entry-title" itemprop="name"><?php echo $data['row']['title'] ?></h1>

                    <div class="mom-post-meta single-post-meta"></div>
                    <div class="entry-content">
                        <?php echo $row['content'] ?>

                        <?php

                        //hien thi nguon
                        $list_source = getNewsSource();
                        echo '<div class="clear"></div>';
                        echo '<p style="text-align: right">Source: <strong>'.$list_source[$row['source_id']].'</strong></p>';

                        $user = Yii::app()->session['user'];
                        if (!empty($user)) {
                            echo '<hr />';
                            echo '<a href="/backend/archive/edit?id=' . $row['id'] . '">Edit</a>';
                            echo '<hr />';
                        }

                        $gallery = json_decode($row['gallery'], true);
                        if (!empty($gallery)) {
                            $this->renderPartial('//detail/gallery', array('data' => $data));
                        }

                        ?>


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
                        <div class="clear"></div>
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


                <h2 class="single-title">Recent news</h2>

                <div class="base-box single-box">
                    <ul class="single-related-posts">
                        <?php
                        $i = 0;
                        foreach ($data['relate_post'] as $item) {
                            $detail_url = $this->createUrl('detail/index', $item);
                            ?>
                            <li>
                                <a href="<?php echo $detail_url ?>"><img
                                        src="<?php echo $item['thumbnail'] ?>"
                                        data-hidpi="<?php echo $item['thumbnail'] ?>"
                                        alt="<?php echo CHtml::encode($item['title']) ?>" class="disappear appear"></a>
                                <h4>
                                    <a itemprop="name" href="<?php echo $detail_url ?>"><?php echo $item['title'] ?>
                                    </a>
                                </h4>
                            </li>
                            <?php
                            if ($i == 3) {
                                echo '<div class="clear"></div>';
                            }
                            $i++;
                        }
                        ?>
                    </ul>
                </div>

            </div>
            <!--main column-->

            <div class="clear"></div>
        </div>
        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->widget('RecentVideoAndTagWidget'); ?>
            <?php $this->widget('AdsWidget'); ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>

        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>
