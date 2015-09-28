<dl class="tabs">
    <dd class="active"><a href="#simple1">Feature Video</a></dd>
    <dd><a href="#simple2">Recent Video</a></dd>
</dl>

<ul class="tabs-content">
    <li class="active" id="simple1Tab">
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
                                     alt="">

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
    </li>
    <li class="active" id="simple2Tab">
        <div class="pagevideo">
            <?php
            foreach ($data['recentVideo'] as $item) {
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
                                     alt="">

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
    </li>

</ul>