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
                            </span>Reviews
                        </div>
                    </div>
                </div>

                <div class="posts-grid clearfix">
                    <?php
                    $rank = 1;
                    foreach ($data['newpost'] as $item) {
                        $detail_url = $this->createUrl('detail/index', $item);
                        ?>
                        <div class="mom-grid-item">
                            <div class="base-box blog-post default-blog-post bp-full-img bp-horizontal-share post"
                                 itemscope=""
                                 itemtype="http://schema.org/Article">
                                <div class="bp-entry">
                                    <div class="post-img">
                                        <a href="<?php echo $detail_url ?>">
                                            <img
                                                src="<?php echo $item['thumbnail'] ?>"
                                                data-hidpi="<?php echo $item['thumbnail'] ?>"
                                                alt="<?php echo CHtml::encode($item['title']) ?>"
                                                class="disappear appear"> </a>

                                        <div class="rank"><?php echo $rank++ ?></div>
                                    </div>
                                    <!--img-->
                                    <div class="bp-head">
                                        <h2>
                                            <a href="<?php echo $detail_url ?>"><?php echo $item['title'] ?></a></h2>
                                    </div>
                                    <!--blog post head-->
                                    <div class="bp-details">
                                        <p><?php echo $item['short_text'] ?></p>
                                        <div class="clear"></div>
                                    </div>
                                    <!--details-->
                                </div>
                                <!--entry-->
                                <div class="clear"></div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>

                <!-- base box -->

                <div class="clear"></div>


            </div>
            <!--main column-->

            <div class="clear"></div>
            <div class="clear"></div>
        </div>

        <!--main container-->
        <div class="sidebar main-sidebar">
            <?php $this->widget('ReviewWidget'); ?>
            <?php $this->renderPartial('//index/ads-small', array('data' => $data)) ?>
            <?php $this->widget('FeatureVideoWidget'); ?>
            <?php $this->widget('RecentVideoAndTagWidget'); ?>
            <?php $this->widget('SocialWidget'); ?>
        </div>
        <!--main sidebar-->
        <div class="clear"></div>
    </div>
    <!--main inner-->

</div>