<div class="widget widget_momizattabber">
    <div class="main_tabs">
        <ul class="tabs"></ul>
        <div class="tabs-content-wrap">
            <?php
            if (!$video_home) {
                ?>
                <div class="tab-content"><a href="#" class="mom-tw-title">Recent video</a>

                    <div class="mom-posts-widget">
                        <?php
                        foreach ($data['recentVideo'] as $item) {
                            $video_url = $this->_controller->createUrl('video/detail', array('alias' => $item['alias']));
                            ?>
                            <div class="mpw-post">
                                <div class="video-item">
                                    <a href="<?php echo $video_url ?>">
                                        <div class="thumbnail">
                                            <img src="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                                                 data-hidpi="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                                                 alt="<?php echo CHtml::encode($item['title']) ?>">

                                            <div class="over">
                                                <i class="icon-play"></i>
                                            </div>
                                        </div>
                                    </a>

                                    <h3><a href="<?php echo $video_url ?>"><?php echo $item['title'] ?></a></h3>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
            }
            ?>
            <div class="tab-content"><a href="#" class="mom-tw-title">Tags</a>

                <div class="tagcloud">
                    <?php
                    foreach ($data['listTag'] as $item) {
                        echo '<a title="' . CHtml::encode($item['name']) . '" href="' . $this->_controller->createUrl('video/tag', array('alias' => $item['alias'])) . '" rel="tag">' . $item['name'] . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--main tabs-->

</div>