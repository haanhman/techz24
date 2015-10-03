<div class="widget widget_categories">
    <div class="widget-head"><h3 class="widget-title"><span>TAGS POST</span></h3></div>
    <ul>
        <?php
        foreach ($data['listItem'] as $item) {
            echo '<li class="cat-item">';
            echo '<a href="' . $this->_controller->createUrl('tag/index', array('alias' => $item['alias'])) . '" rel="tag">' . $item['name'] . '</a>';
            echo '</li>';
        }
        ?>
    </ul>
</div>