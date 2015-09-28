<div class="widget wcategory">
    <h3 class="blocktitle">Recent Video</h3>
    <ul class="wl-category">

        <div class="pagevideo">
            <?php
            foreach ($data['featureVideo'] as $item) {
                $video_url = $this->_controller->createUrl('video/detail', array('alias' => $item['alias']));
                ?>
                <div class="inner" style="margin-bottom: 10px">
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
                <?php
            }
            ?>
        </div>
    </ul>
</div>