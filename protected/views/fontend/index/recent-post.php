<div class="news-box  base-box">
    <header class="nb-header">
        <h2 class="nb-title" style=""><span>Recent Posts</span></h2>
    </header>
    <!--nb header-->
    <div class="nb-content">
        <div class="news-list ">
            <?php
            foreach ($data['recent_post'] as $item) {
                $category = $data['category'][$item['cate_id']];
                $url_detail = $this->createUrl('detail/index', $item);
                $url_category = $this->createUrl('category/index', array('alias' => $category['alias']));
                ?>
                <article class="nl-item"
                         itemscope itemtype="http://schema.org/Article">
                    <div class="news-image">
                        <a href="<?php echo $url_detail ?>"><img
                                src="<?php echo $item['thumbnail'] ?>"
                                data-hidpi="<?php echo $item['thumbnail'] ?>"
                                alt="<?php echo CHtml::encode($item['title']) ?>"
                                width="190"
                                height="122"></a>
                    </div>
                    <div class="news-summary has-feature-image">
                        <h3>
                            <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                        </h3>

                        <div class="mom-post-meta nb-item-meta">
                            <span datetime="<?php echo convert_time_T($item['created']) ?>"
                                  class="entry-date"><?php echo convert_time_Normal($item['created']) ?></span>
                            <span class="category">In: <a
                                    href="<?php echo $url_category ?>"
                                    rel="category tag"><?php echo $category['name'] ?></a></span>
                        </div>
                        <!--meta-->
                        <p>
                            <?php echo nl2br($item['short_text']) ?>
                            <a
                                href="<?php echo $url_detail ?>"
                                class="read-more-link">Read more <i
                                    class="fa-icon-double-angle-right"></i></a>
                        </p>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>
        <!--news list-->
    </div>

</div>