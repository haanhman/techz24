<div class="widget wcategory">
    <h3 class="blocktitle"><span>TAGS VIDEO</span></h3>
    <div class="tagcloud">
        <?php
        foreach ($data['listItem'] as $item) {
            echo '<a href="' . $this->_controller->createUrl('video/tag', array('alias' => $item['alias'])) . '" rel="tag">' . $item['name'] . '</a>';
        }
        ?>
    </div>
</div>