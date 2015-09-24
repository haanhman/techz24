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
                                href="<?php echo $this->createUrl('detail/index', array('alias' => $row['alias'])) ?>"><?php echo $row['title'] ?></a>
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
                                ?>
                                <?php $this->renderPartial('social', array('data' => $data)) ?>
                                <div id="disqus_thread"></div>
                                <script type="text/javascript">
                                    /* * * CONFIGURATION VARIABLES * * */
                                    var disqus_shortname = 'techz24';

                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                    (function () {
                                        var dsq = document.createElement('script');
                                        dsq.type = 'text/javascript';
                                        dsq.async = true;
                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                    })();
                                </script>
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
                    <?php $this->widget('VideoWidget'); ?>

                    <!-- widget custome menus -->
                    <?php $this->widget('CategoryWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>

                    <?php $this->widget('SocialWidget'); ?>

                </aside>
            </div>
        </section>
    </div>
</div>