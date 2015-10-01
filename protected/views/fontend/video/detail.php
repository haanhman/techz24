<?php
$row = $data['row'];
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">
            <div class="eight columns">
                <div id="content">
                    <!-- main content -->
                    <section id="singlepost">
                        <header>
                            <h1><?php echo $row['title'] ?></h1>

                            <div class="postmeta">
                                <div class="share-post">SHARE :
                                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>"><i
                                            class="fa fa-facebook"></i></a>
                                    <a target="_blank" href="https://plus.google.com/share?url=<?php echo $url ?>"><i
                                            class="fa fa-google-plus"></i></a>
                                    <a target="_blank" href="https://twitter.com/share?url=<?php echo $url ?>&amp;text=<?php echo CHtml::encode($row['title']) ?>&amp;hashtags=techz24"><i
                                            class="fa fa-twitter"></i></a>
                                </div>
                            </div>

                        </header>
                        <article>
                            <div class="vidpost" style="height: 450px; margin-bottom: 20px">
                                <div class="flex-video widescreen">
                                    <iframe width="100%" height="410"
                                            src="https://www.youtube.com/embed/<?php echo $row['video_id'] ?>"
                                            frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="post-content" style="margin-top: 20px">
                                <?php echo nl2br($row['description']) ?>
                                <div class="clear"></div>
                                <?php
                                if (!empty($data['tags'])) {
                                    echo '<ul class="list-tag">';
                                    echo '<li><strong>Tags: </strong></li>';
                                    $i = 1;
                                    foreach ($data['tags'] as $tag) {
                                        echo '<li>';
                                        echo '<a href="' . $this->createUrl('video/tag', array('alias' => $tag['alias'])) . '" title="' . CHtml::encode($tag['name']) . '">' . $tag['name'] . '</a>';
                                        if ($i < count($data['tags'])) {
                                            echo ', ';
                                        }
                                        echo '</li>';
                                        $i++;
                                    }
                                    echo '</ul>';
                                }
                                $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                ?>

                            </div>
                            <div class="clear"></div>
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1638273013053132";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-comments" data-href="<?php echo $url ?>" data-width="100%"
                                 data-numposts="5"></div>
                        </article>

                        <!-- Banner Area -->
                        <?php $this->renderPartial('//layouts/banner_top') ?>

                        <h3 class="blocktitle" style="margin: 0px">Recent Videos</h3>

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
                                                        <img
                                                            src="<?php echo getYoutubeThumbnail($item['thumbnails']) ?>"
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
                    </section>
                </div>
            </div>
            <div class="four columns">
                <aside>
                    <?php $this->widget('ReviewWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>

                    <?php $this->widget('SocialWidget'); ?>
                </aside>
            </div>
        </section>
    </div>
</div>