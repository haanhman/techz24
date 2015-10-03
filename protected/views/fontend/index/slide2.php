<!--fearure slider-->
<script>
    jQuery(document).ready(function ($) {
        var rtl = false;
        var rows = 1;
        if (rows !== '' && rows > 1) {
            var divs = $(".sb-content-183 .sb-item");
            for (var i = 0; i < divs.length; i += rows) {
                divs.slice(i, i + rows).wrapAll("<div class='rows-1'></div>");
            }
        }
        $(".sb-content-small").owlCarousel({
            items: 3,
            baseClass: 'mom-carousel',
            rtl: rtl,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                1000: {
                    items: 3
                },

                671: {
                    items: 3
                },

                480: {
                    items: 2
                },

                320: {
                    items: 1
                },
                1: {
                    items: 1
                }
            }
        });
    });
</script>
<div class="news-box  base-box scrolling-box-wrap">
    <header class="nb-header">
        <h2 class="nb-title"><a>Top news</a></h2>
    </header>
    <!--nb header-->
    <div class="nb-content">
        <div class="scrolling-box">
            <div class="sb-content mom-carousel sb-content-small">
                <?php
                foreach ($data['slide2'] as $item) {
                    $detail_url = $this->createUrl('detail/index', $item);
                    ?>
                    <div class="sb-item"
                         itemscope itemtype="http://schema.org/Article">
                        <div class="sb-item-img">
                            <a href="<?php echo $detail_url ?>"><img
                                    src="<?php echo $item['thumbnail'] ?>"
                                    data-hidpi="<?php echo $item['thumbnail'] ?>"
                                    alt="<?php echo CHtml::encode($item['title']) ?>" width="265"
                                    height="168"></a>
                        </div>
                        <h3><a href="<?php echo $detail_url ?>"><?php echo $item['title'] ?></a></h3>
                    </div>
                    <?php
                }
                ?>

            </div>
            <!--sb-content-->
        </div>
        <!--scrolling box-->
    </div>
    <footer class="nb-footer">

    </footer>
</div>