<?php
foreach ($data['catebox'] as $cate_id => $rows) {
    $category = $data['category'][$cate_id];
    $item = array_shift($rows);
    $url_detail = $this->createUrl('detail/index', array('alias' => $item['alias']));
    ?>
    <h3 class="blocktitle"><?php echo $category['name'] ?><span>
            <a href="<?php echo $this->createUrl('category/index', array('alias' => $category['alias'])) ?>">MORE</a></span>
    </h3>
    <section id="cat2news">
        <!-- Block Featured  -->
        <div class="featured">
            <div class="thumb">
                <a href="<?php echo $url_detail ?>" title="<?php echo CHtml::encode($item['title']) ?>">
                    <img src="<?php echo $item['thumbnail'] ?>" alt="<?php echo CHtml::encode($item['title']) ?>"
                         title="<?php echo CHtml::encode($item['title']) ?>">
                </a>
            </div>
            <div class="excerpt">
                <h2 class="box-title">
                    <a href="<?php echo $url_detail ?>"
                       title="<?php echo CHtml::encode($item['title']) ?>"><?php echo $item['title'] ?></a>
                </h2>

                <div class="desc">
                    <p><?php echo nl2br($item['short_text']) ?></p>
                    <a href="<?php echo $url_detail ?>" title="<?php echo CHtml::encode($item['title']) ?>"><i
                            class="fa fa-external-link"></i> READMORE </a>
                </div>
            </div>
        </div>
        <!-- Block Category Area -->
        <div class="othercat">
            <div class="otitle">LATEST POST</div>
            <ul class="oc-horizon">
                <?php
                foreach ($rows as $item) {
                    $url_detail = $this->createUrl('detail/index', array('alias' => $item['alias']));
                    ?>
                    <li>
                        <div class="octhumb">
                            <a href="<?php echo $url_detail ?>" title="<?php echo CHtml::encode($item['title']) ?>"><img
                                    src="<?php echo $item['thumbnail'] ?>"
                                    alt="<?php echo CHtml::encode($item['title']) ?>"
                                    title="<?php echo CHtml::encode($item['title']) ?>"></a>
                        </div>
                        <div class="desc">
                            <h2 class="new-title">
                                <a title="<?php echo CHtml::encode($item['title']) ?>"
                                                     href="<?php echo $url_detail ?>">
                                    <?php echo $item['title'] ?>
                                </a>
                            </h2>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </section>
    <?php
}
?>