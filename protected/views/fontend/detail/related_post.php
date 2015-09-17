<section id="postwidget">
    <div class="widget lreview">
        <h3 class="blocktitle">RELATED POST</h3>

        <div class="othercat">
            <ul class="oc-horizon related-post">
                <?php
                foreach ($data['relate_post'] as $item) {
                    $detail_url = $this->createUrl('detail/index', array('alias' => $item['alias']));
                    ?>
                    <li>
                        <div class="octhumb">
                            <a href="<?php echo $detail_url ?>"><img src="<?php echo $item['thumbnail'] ?>" alt="<?php echo CHtml::encode($item['title']) ?>"></a>
                        </div>
                        <div class="desc">
                            <h2><a href="<?php echo $detail_url ?>"><?php echo $item['title'] ?></a></h2>
                            <p class="short-desc"><?php echo nl2br($item['short_text']) ?></p>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</section>