<?php
$row = $data['row'];
?>
<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">
            <!-- Side Left Main Conten Area -->
            <div class="eight columns">
                <div id="content">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo $this->createUrl('index/index') ?>">Home</a></li>
                        <li>
                            <a href="<?php echo $this->createUrl('category/index', array('alias' => $data['category']['alias'])) ?>"><?php echo $data['category']['name'] ?></a>
                        </li>
                        <li><a
                                href="<?php echo $this->createUrl('detail/index', $row) ?>"><?php echo $row['title'] ?></a>
                        </li>
                    </ul>
                    <section id="singlepost">
                        <header>
                            <h1><?php echo $row['title'] ?></h1>
                        </header>
                        <article>
                            <div class="post-content">
                                <?php echo $row['content'] ?>
                                <?php

                                //hien thi nguon
                                if (!empty($row['short_url'])) {
                                    echo '<div class="clear"></div>';
                                    echo '<p style="text-align: right">Source: <strong><a target="_blank" href="' . $row['short_url'] . '">' . $data['source'][$row['source_id']] . '</a></strong></p>';
                                }

                                $user = Yii::app()->session['user'];
                                if (!empty($user)) {
                                    echo '<hr />';
                                    echo '<a href="/backend/archive/edit?id='. $row['id'] .'">Edit</a>';
                                    echo '<hr />';
                                }

                                //danh sach anh neu co
                                $gallery = json_decode($row['gallery'], true);
                                if (!empty($gallery)) {
                                    $this->renderPartial('gallery', array('data' => $data));
                                }

                                if (!empty($data['tags'])) {
                                    echo '<ul class="list-tag">';
                                    echo '<li><strong>Tags: </strong></li>';
                                    $i = 1;
                                    foreach ($data['tags'] as $tag) {
                                        echo '<li>';
                                        echo '<a href="' . $this->createUrl('tag/index', array('alias' => $tag['alias'])) . '" title="' . CHtml::encode($tag['name']) . '">' . $tag['name'] . '</a>';
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
                                <?php $this->renderPartial('social', array('data' => $data)) ?>
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
                            <div class="clear"></div>
                            <?php $this->renderPartial('//layouts/banner_top') ?>
                            <?php
                            if (!empty($data['relate_post'])) {
                                $this->renderPartial('related_post', array('data' => $data));
                            }
                            ?>
                        </article>
                    </section>
                </div>
            </div>

            <div class="four columns">
                <aside>
                    <!-- widget video  -->
                    <?php $this->widget('ReviewWidget'); ?>

                    <!-- widget custome menus -->
                    <?php $this->widget('CategoryWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>

                    <?php $this->widget('SocialWidget'); ?>

                </aside>
            </div>
        </section>
    </div>
</div>