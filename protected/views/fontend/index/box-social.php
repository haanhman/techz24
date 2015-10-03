<?php
$category = $data['social']['category'];
$items = $data['social']['post'];
$cate_url = $this->createUrl('category/index', array('alias' => $category['alias']));
$item = array_shift($items);
$url_detail = $this->createUrl('detail/index', $item);
?>
<div class="news-box  base-box nb-style2 nb-2col ">
    <header class="nb-header">
        <h2 class="nb-title" style=""><a
                href="<?php echo $cate_url ?>"><?php echo $category['name'] ?></a></h2>
    </header>
    <!--nb header-->
    <div class="nb-content">
        <div class="recent-news">
            <article class=""
                     itemscope itemtype="http://schema.org/Article">
                <div class="news-image">
                    <a href="<?php echo $url_detail ?>"><img
                            src="<?php echo $item['thumbnail'] ?>"
                            data-hidpi="<?php echo $item['thumbnail'] ?>"
                            alt="<?php echo CHtml::encode($item['title']) ?>"
                            width="274"
                            height="173"></a>
                </div>
                <div class="news-summary">
                    <h3>
                        <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                    </h3>

                    <p>
                        <?php echo nl2br(short_text($item['short_text'], 120)) ?>
                        <a
                            href="<?php echo $url_detail ?>"
                            class="read-more-link">Read more <i
                                class="fa-icon-double-angle-right"></i></a>
                    </p>

                </div>
            </article>

        </div>
        <!--recent news-->
        <div class="older-articles">
            <ul>
                <?php
                foreach ($items as $item) {
                    $url_detail = $this->createUrl('detail/index', $item);
                    ?>
                    <li class="" itemscope itemtype="http://schema.org/Article">
                        <a href="<?php echo $url_detail ?>"><img
                                src="<?php echo $item['thumbnail'] ?>"
                                data-hidpi="<?php echo $item['thumbnail'] ?>"
                                alt="<?php echo CHtml::encode($item['title']) ?>" width="90" height="60"></a>

                        <div class="details has-feature-image">
                            <h4>
                                <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a></h4>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <footer class="nb-footer">
        <a href="<?php echo $cate_url ?>">Show More <i
                class="fa-icon-long-arrow-right"></i> </a>
    </footer>

</div>