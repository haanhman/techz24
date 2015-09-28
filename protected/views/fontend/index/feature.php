<!-- Featured Casousel -->
<div class="row">
    <div class="twelve columns ">
        <div class="tcarousel">
            <div class="titlefeatured four columns">
                Feature Video
            </div>
            <div class="six columns ">
                <ul class="nav-carousel right">
                    <?php
                    foreach ($data['video_tags'] as $item) {
                        ?>
                        <li>
                            <a href="<?php echo $this->createUrl('video/tag', array('alias' => $item['alias'])) ?>"><?php echo $item['name'] ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main Carousel -->
<div class="row">
    <div class="twelve columns ">
        <div id="mixedContent">
            <?php
            foreach ($data['featureVideo'] as $item) {
                $video_url = $this->createUrl('video/detail', array('alias' => $item['alias']));
                ?>
                <div class="contentBox">
                    <img src="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
                         alt="<?php echo CHtml::encode($item['title']) ?>"/>

                    <div class="overlay">
                        <div class="meta-carousel">
                            <i class="fa fa-eye"></i> <?php echo $item['viewer'] ?>
                        </div>
                        <div class="title-carousel">
                            <a href="<?php echo $video_url ?>">
                                <div class="ticarousel"><?php echo $item['title'] ?></div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>