<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">
            <!-- Side Left Main Conten Area -->
            <div class="eight columns">
                <div id="content">
                    <h1 class="blocktitle" style="margin: 0px"><?php echo $data['row']['name'] ?></h1>


                    <div class="pagevideo">
                        <?php
                        $lists = array_chunk($data['listVideo'], 3);
                        $i = 1;
                        $count = count($lists);
                        foreach ($lists as $rows) {
                            echo '<div class="rows">';
                            foreach ($rows as $item) {
                                $video_url = $this->createUrl('video/detail', array('alias' => $item['alias']));
                                ?>
                                <div class="four columns">
                                    <div class="inner">
                                        <h2>
                                            <a class="title" href="<?php echo $video_url ?>">
                                                <div class="img">
                                                    <div class="meta-carousel">
                                                        <i class="fa fa-eye"></i> <?php echo $item['viewer'] ?>
                                                    </div>
                                                    <div class="play-icon"></div>
                                                    <img src="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                                                         alt="<?php echo CHtml::encode($item['title']) ?>">

                                                    <div class="title-carousel">
                                                        <div class="ticarousel"><?php echo $item['title'] ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                                <?php
                            }
                            if ($i < $count) {
                                ?>
                                <div class="clear"></div>
                                <div class="line1 clearfix"></div>
                                <div class="clear"></div>
                                <?php
                            }
                            $i++;
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="clear"></div>
                    <div class="line1"></div>
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
                    <?php $this->renderPartial('//layouts/banner_top') ?>
                </div>
            </div>
            <div class="four columns">
                <aside>
                    <!-- widget video  -->
                    <?php $this->widget('ReviewWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>

                    <?php $this->widget('SocialWidget'); ?>
                </aside>
            </div>
        </section>
    </div>
</div>