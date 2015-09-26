<section id="postwidget">
    <div class="widget lreview">
        <h3 class="blocktitle">RELATED POST</h3>

        <div class="blogtwo">

            <?php
            $lists = array_chunk($data['relate_post'], 3);
            ?>
            <?php
            $i = 1;
            $count = count($lists);
            foreach ($lists as $rows) {
                echo '<div class="rows">';
                foreach ($rows as $item) {
                    $url_detail = $this->createUrl('detail/index', $item);
                    ?>
                    <div class="four columns">
                        <div class="itemblog">
                            <div class="lthumb">
                                <a href="<?php echo $url_detail ?>">
                                    <img
                                        src="<?php echo $item['thumbnail'] ?>"
                                        alt="<?php echo CHtml::encode($item['title']) ?>"></a>
                            </div>

                            <div class="excerpt">
                                <h2 class="ntitle"><a
                                        href="<?php echo $url_detail ?>"><?php echo $item['title'] ?></a>
                                </h2>

                                <p class="meta-date"><?php echo nl2br($item['short_text']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if ($i < $count) {
                    ?>
                    <div class="clear"></div>
                    <br/><br/>
                    <div class="line1 clearfix"></div>
                    <br/><br/>
                    <div class="clear"></div>
                    <?php
                }
                echo '</div>';
                $i++;
            }
            ?>

        </div>
    </div>
</section>
<style>
    .blogtwo .lthumb {
        height: 200px !important;
    }
    .product-feature {
        height: 280px;
    }
    .product-feature .lthumb{
        height: 280px !important;
    }
    .product-feature .lthumb img{
        height: 280px !important;
    }
    div.rate-carousel {
        border: 2px solid white;
        border-radius: 100%;
        width: 48px;
        text-align: center;
        float: right;
        background: black;
        font-size: 20px !important;
    }
    p.meta-date {
        text-transform: none;
        font-size: 14px;
    }
    .itemblog .overlay {
        width: 48px;
        position: absolute;
        top: 5px;
        right: 5px;
    }

</style>
<script type="text/javascript">
    $(function () {
        $('.rows').each(function () {
            var max_height = 0;
            $(this).find('.itemblog').each(function () {
                if ($(this).height() > max_height) {
                    max_height = $(this).height();
                }
            });
            console.log(max_height);
            $(this).find('.itemblog').each(function () {
                $(this).css('height', max_height);
            });
        });
    });
</script>