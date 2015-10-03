<?php
foreach ($data['catebox'] as $cate_id => $rows) {
    $item = array_shift($rows);
    $category = $data['category'][$cate_id];
    $url_detail = $this->createUrl('detail/index', $item);
    ?>
    <div class="news-box  base-box nb-style2">
        <header class="nb-header">
            <h2 class="nb-title" style=""><a
                    href="<?php echo $this->createUrl('category/index', array('alias' => $category['alias'])) ?>">
                    <?php echo $category['name'] ?>
                </a>
            </h2>
        </header>
        <!--nb header-->
        <div class="nb-content">
            <div class="recent-news">
                <article class="" itemscope itemtype="http://schema.org/Article">
                    <div class="rn-title">
                        <h3>
                            <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                        </h3>
                    </div>
                    <!--rn title-->
                    <div class="news-image">
                        <a href="<?php echo $url_detail ?>"><img
                                src="<?php echo $item['thumbnail'] ?>"
                                data-hidpi="<?php echo $item['thumbnail'] ?>"
                                alt="<?php echo CHtml::encode($item['title']) ?>"
                                width="274" height="173"></a>
                    </div>
                    <div class="news-summary">
                        <p><?php echo nl2br($item['short_text']) ?>
                            <a href="<?php echo $url_detail ?>"
                               class="read-more-link">Read more <i
                                    class="fa-icon-double-angle-right"></i></a>
                        </p>
                    </div>
                </article>
            </div>
            <!--recent news-->

            <div class="older-articles">
                <ul class="two-cols">
                    <?php
                    foreach ($rows as $item) {
                        $url_detail = $this->createUrl('detail/index', $item);
                        ?>
                        <li class="" itemscope itemtype="http://schema.org/Article">
                            <a href="<?php echo $url_detail ?>"><img
                                    src="<?php echo $item['thumbnail'] ?>"
                                    data-hidpi="<?php echo $item['thumbnail'] ?>"
                                    alt="<?php echo CHtml::encode($item['title']) ?>" width="90" height="60"></a>

                            <div class="details has-feature-image">
                                <h4>
                                    <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                                </h4>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <footer class="nb-footer">
            <a href="<?php echo $this->createUrl('category/index', array('alias' => $category['alias'])) ?>">
                Show More <i class="fa-icon-long-arrow-right"></i>
            </a>
        </footer>

    </div>
    <?php
}
?>
