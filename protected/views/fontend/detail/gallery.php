<?php
$gallery = json_decode($data['row']['gallery'], true);
$title = $gallery['title'];
?>
<h2 style="font-size: 14px"><?php echo $title ?></h2>

<script type="text/javascript" src="/public/js/gallery/jssor.js"></script>
<script type="text/javascript" src="/public/js/gallery/jssor.slider.js"></script>
<script type="text/javascript" src="/public/js/gallery/gallery.js"></script>


<div id="slider1_container"
     style="position: relative; width: 800px; height: 600px; background-color: #000; overflow: hidden; ">

    <!-- Loading Screen -->
    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
        </div>
        <div style="position: absolute; display: block; background: url(/public/js/gallery/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
        </div>
    </div>

    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 600px;
            overflow: hidden;">
        <?php
        foreach ($gallery['images'] as $item) {
            ?>
            <div><img u="image" src="<?php echo $item ?>" alt="<?php echo CHtml::encode($title) ?>"/></div>
            <?php
        }
        ?>

    </div>
</div>
<script>
    jQuery(document).ready(function ($) {
        var options = { $AutoPlay: false };
        var jssor_slider1 = new $JssorSlider$('slider1_container', options);


        //responsive code begin
        //you can remove responsive code if you don't want the slider scales
        //while window resizes
        function ScaleSlider() {
            var parentWidth = $('#slider1_container').parent().width();
            if (parentWidth) {
                jssor_slider1.$ScaleWidth(parentWidth);
            }
            else
                window.setTimeout(ScaleSlider, 30);
        }
        //Scale slider after document ready
        ScaleSlider();

        //Scale slider while window load/resize/orientationchange.
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end

    });
</script>
<div class="clear"></div>