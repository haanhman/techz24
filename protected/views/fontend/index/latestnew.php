<?php
$controller = Yii::app()->controller->id;
$title = 'LATEST POST';
if ($controller == 'category') {
    $title = $data['cur_cate']['name'];
}
if ($controller == 'tag') {
    $title = $data['row']['name'];
}
if ($controller == 'search') {
    $keyword = isset($_GET['keyword']) ? urlGETParams('keyword') : '';
    $title = $keyword;
}
$htag = 'h3';
if($controller != 'index') {
    $htag = 'h1';
}
?>
<<?php echo $htag ?> class="blocktitle"><?php echo $title ?></<?php echo $htag ?>>
<!-- list blog latest news -->
<section id="listnews">
    <ul>
        <?php
        foreach ($data['newpost'] as $item) {
            $category = $data['category'][$item['cate_id']];
            $url_detail = $this->createUrl('detail/index', $item);
            $url_category = $this->createUrl('category/index', array('alias' => $category['alias']));

            ?>
            <li>
                <div class="lthumb">
                    <a href="<?php echo $url_detail ?>"
                       title="<?php echo CHtml::encode($item['title']) ?>">
                        <img src="<?php echo $item['thumbnail'] ?>" alt="<?php echo CHtml::encode($item['title']) ?>"
                             title="<?php echo CHtml::encode($item['title']) ?>">
                    </a>

                </div>

                <div class="excerpt">
                    <h2 class="ntitle">
                        <a href="<?php echo $url_detail ?>"
                           title="<?php echo CHtml::encode($item['title']) ?>"><?php echo $item['title'] ?></a>
                    </h2>

                    <p class="meta-date"><?php echo date('F d,Y', $item['created']) ?> IN <a
                            href="<?php echo $url_category ?>"><?php echo $category['name'] ?></a></p>

                    <div class="desc">
                        <p><?php echo nl2br($item['short_text']) ?></p>
                    </div>
                    <?php
                    if (!empty($item['tags'])) {
                        $tags = explode(',', trim($item['tags'], ','));
                        $tags = array_filter($tags);
                        if(!empty($tags)) {
                            echo '<div class="tags">';
                            echo 'Tags: ';
                            $i = 1;
                            foreach ($tags as $tag_id) {
                                $tag = $data['tags'][$tag_id];
                                ?>
                                <a href="<?php echo $this->createUrl('tag/index', array('alias' => $tag['alias'])) ?>"><strong><?php echo $tag['name'] ?></strong></a>
                                <?php
                                if($i < count($tags)) {
                                    echo ', ';
                                }
                                $i++;
                            }
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
</section>
<!-- end list blog latest news -->