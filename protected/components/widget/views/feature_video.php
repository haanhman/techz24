<div class="widget widget-video">
    <div class="widget-head"><h3 class="widget-title"><span>Feature Videos</span></h3></div>
    <div class="mom-posts-widget">
        <?php
        foreach ($data['featureVideo'] as $item) {
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