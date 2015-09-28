<nav class="pushy pushy-left">
    <ul>
        <?php
        $result = $this->getListCategory();
        $categories = array();
        foreach ($result as $item) {
            if ($item['parent_id'] == 0) {
                foreach ($result as $sub) {
                    if ($sub['parent_id'] == $item['id']) {
                        $item['sub'][] = $sub;
                    }
                }
                $categories[] = $item;
            }
        }

        if (!empty($categories)) {
            echo '<ul class="dropdown">';
            foreach ($categories as $cate) {
                if($cate['id'] == 20) {
                    continue;
                }
                echo '<li>';
                echo '<a href="#">' . $cate['name'] . '</a>';
                if (!empty($cate['sub'])) {
                    echo '<ul>';
                    foreach ($cate['sub'] as $sub) {
                        echo '<li><a href="' . $this->createUrl('category/index', array('alias' => $sub['alias'])) . '">' . $sub['name'] . '</a></li>';
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
        <li><a href="/reviews.html">Reviews</a></li>
        <li><a href="<?php echo $this->createUrl('video/index') ?>">Video</a></li>
    </ul>
</nav>