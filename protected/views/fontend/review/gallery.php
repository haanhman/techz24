<?php
$gallery = json_decode($data['row']['gallery'], true);
$title = $gallery['title'];
?>
<h2 style="font-size: 14px"><?php echo $title ?></h2>
<div class="imggallery">
    <!-- Place somewhere in the <body> of your page -->
    <div class="flexslider">
        <ul class="slides">
            <?php
            foreach ($gallery['images'] as $item) {
                ?>
                <li data-thumb="<?php echo $item ?>">
                    <img src="<?php echo $item ?>" alt="<?php echo CHtml::encode($title) ?>"/>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>