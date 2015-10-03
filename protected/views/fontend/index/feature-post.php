<div class="feature-slider base-box nav-thumbs  new-style  " data-speed="600"
     data-timeout="4000" data-sanimation="" data-easing="easeInOutCubic" data-rndn="477"
     data-animation_new="fade" data-animation_in="" data-animation_out="fadeOut"
     data-autoplay="true" data-items="6">
    <div class="mom_visibility_mobile fs-drection-nav fs-dnav-477">
        <span class="fsd-prev"><i class="fa-icon-angle-left"></i></span>
        <span class="fsd-next"><i class="fa-icon-angle-right"></i></span>
    </div>
    <div class="fslides fc-nav-477">
        <?php
        $i = 0;
        foreach ($data['catslide'] as $item) {
            $detail_url = $this->createUrl('detail/index', $item);
            ?>
            <div class="fslide has-post-thumbnail"
                 itemscope itemtype="http://schema.org/Article" data-i="<?php echo $i++ ?>">
                <a href="<?php echo $detail_url ?>"><img
                        src="<?php echo $item['thumbnail'] ?>"
                        alt="<?php echo CHtml::encode($item['title']) ?>" width="610" height="380"></a>

                <div class="slide-caption  nav-is-thumbs">
                    <h2><a href="<?php echo $detail_url ?>"><?php echo $item['title'] ?></a>
                    </h2>

                    <p><?php echo nl2br(short_text($item['short_text'], 200)) ?></p>
                </div>
            </div>
            <?php
        }
        ?>


    </div>
    <div class="fs-image-nav">
        <span class="fs-prev"><i class="enotype-icon-arrow-left5"></i></span>
        <span class="fs-next"><i class="enotype-icon-arrow-right5"></i></span>

        <div class="fs-thumbs fc-nav-477">
            <?php
            $i = 0;
            foreach ($data['catslide'] as $item) {
                ?>
                <div class="fs-thumb" itemscope itemtype="http://schema.org/Article" data-i="<?php echo $i++ ?>">
                    <img
                        src="<?php echo $item['thumbnail'] ?>"
                        data-hidpi="<?php echo $item['thumbnail'] ?>"
                        alt="<?php echo CHtml::encode($item['title']) ?>" width="90" height="60"></div>
                <?php
            }
            ?>
        </div>
    </div>

</div>