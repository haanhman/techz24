<nav class="pushy pushy-left">
    <ul>
        <li><a href="#">News</a>
            <?php
            $categories = $this->getListCategory();
            if (!empty($categories)) {
                echo '<ul class="dropdown">';
                foreach ($categories as $cate) {
                    echo '<li><a href="' . $this->createUrl('category/index', array('alias' => $cate['alias'])) . '">' . $cate['name'] . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </li>
        <li><a href="#">Video</a></li>
        <li><a href="#">Reviews</a></li>
    </ul>
</nav>