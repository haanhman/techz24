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
                            <h1><?php echo $data['cur_cate']['name'] ?></h1>
                        </div>
                    </div>
                </div>


                <?php
                foreach($data['newpost'] as $item) {
                    $detail_url = $this->createUrl('detail/index', $item);
                    $category = $data['category'][$item['cate_id']];
                    $category_url = $this->createUrl('category/index', array('alias' => $category['alias']));
                    ?>
                    <div class="base-box blog-post default-blog-post bp-horizontal-share" itemscope=""
                         itemtype="http://schema.org/Article">
                        <div class="bp-entry">
                            <div class="bp-head">
                                <h2>
                                    <a href="<?php echo $detail_url ?>"><?php echo $item['title'] ?></a></h2>

                                <div class="mom-post-meta bp-meta">
                                <span><time datetime="<?php echo convert_time_T($item['created']) ?>" itemprop="datePublished"
                                                class="updated"><?php echo convert_time_Normal($item['created']) ?>
                                    </time></span>
                                    <span>In: <a href="<?php echo $category_url ?>" title="View all posts in <?php echo $category['name'] ?>"><?php echo $category['name'] ?></a></span>
                                </div>
                            </div>
                            <div class="bp-details">
                                <div class="post-img">
                                    <a href="<?php echo $detail_url ?>">
                                        <img
                                            src="<?php echo $item['thumbnail'] ?>"
                                            data-hidpi="<?php echo $item['thumbnail'] ?>"
                                            alt="<?php echo CHtml::encode($item['title']) ?>" width="220" height="140"
                                            class="disappear appear"> </a>
                                    <span class="post-format-icon"></span>
                                </div>
                                <!--img-->
                                <p>
                                    <?php echo nl2br($item['short_text']) ?>
                                    <a href="<?php echo $detail_url ?>" class="read-more-link">Read more <i
                                            class="fa-icon-double-angle-right"></i></a>
                                </p>

                                <?php
                                if (!empty($item['tags'])) {



                                    $tags = explode(',', trim($item['tags'], ','));
                                    $tags = array_filter($tags);
                                    if(!empty($tags)) {
                                        echo '<div class="post-tags"><span class="pt-title">Tags: </span>';
                                        foreach ($tags as $tag_id) {
                                            $tag = $data['tags'][$tag_id];
                                            ?>
                                            <a  rel="tag" href="<?php echo $this->createUrl('tag/index', array('alias' => $tag['alias'])) ?>"><strong><?php echo $tag['name'] ?></strong></a>
                                            <?php
                                        }
                                        echo '</div>';
                                    }

                                }
                                ?>

                                <div class="clear"></div>
                            </div>
                            <!--details-->
                        </div>
                        <!--entry-->

                        <div class="clear"></div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <!--main column-->
            <div class="clear"></div>

            <div class="clear"></div>
            <?php
            if (!empty($data['newpost'])) {
                echo '<div class="dataTables_paginate paging_bootstrap">';
                $this->widget('CLinkPager', array(
                    'header' => '',
                    'pages' => $pages,
                ));
                echo '</div>';
            }
            ?>

            <div class="clear"></div>
        </div>


        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->widget('AdsWidget'); ?>
            <?php $this->widget('FeatureVideoWidget'); ?>
            <?php $this->widget('RecentVideoAndTagWidget'); ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>

        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>