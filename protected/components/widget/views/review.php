<div class="widget">
    <h3 class="blocktitle" style="margin: 0px;">Top Reviews</h3>

    <div class="widget-review">
        <?php
        $rank = 1;
        foreach ($data as $item) {
            $url_detail = $this->_controller->createUrl('detail/index',$item);
            ?>
            <div class="itemblog">
                <div class="lthumb">
                    <a href="<?php echo $url_detail ?>">
                        <img
                            src="<?php echo $item['thumbnail'] ?>"
                            alt="<?php echo CHtml::encode($item['title']) ?>"></a>

                    <div class="overlay">
                        <div class="rate-carousel"><?php echo $rank++ ?></div>
                    </div>
                </div>

                <div class="excerpt">
                    <h2 class="ntitle"><a
                            href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                    </h2>

                    <p class="meta-date"><?php echo nl2br($item['short_text']) ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="clear"></div>
<style pe="text/css">
    .widget-review .itemblog {
        border: none;
        border-bottom: 1px solid #d6d6d6;
    }

    .widget-review .lthumb {
        width: 100% !important;
        height: 220px !important;
        margin-bottom: 10px;
    }
    .widget-review .lthumb img {
        height: 220px !important;
    }
    .widget-review .itemblog .overlay {
        width: 48px;
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .widget-review div.rate-carousel {
        border: 2px solid white;
        border-radius: 100%;
        width: 48px;
        text-align: center;
        float: right;
        background: black;
        font-size: 20px !important;
    }
    .widget-review p.meta-date {
        text-transform: none;
        font-size: 14px;
    }
</style>