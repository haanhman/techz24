<div class="wpb_wrapper reviews-widget">
    <div class="widget momizat-reviews">
        <div class="widget-head"><h3 class="widget-title"><span>Top Reviews</span></h3>
        </div>
        <div class="mom-posts-widget">
            <?php
            foreach ($data as $item) {
                $url_detail = $this->_controller->createUrl('detail/index', $item);
                ?>
                <div class="mpw-post">
                    <div class="post-img main-sidebar-element"><a
                            href="<?php echo $url_detail ?>"><img
                                src="<?php echo $item['thumbnail'] ?>"
                                data-hidpi="<?php echo $item['thumbnail'] ?>"
                                alt="<?php echo CHtml::encode($item['title']) ?>" width="90" height="60"></a>
                    </div>

                    <div class="details has-feature-image">
                        <h4>
                            <a href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a></h4>

                        <div class="mom-post-meta mom-w-meta">
                            <span datetime="<?php echo convert_time_T($item['created']) ?>"
                                  class="entry-date"><?php echo convert_time_Normal($item['created']) ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>
