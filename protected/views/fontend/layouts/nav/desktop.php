<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<ul id="menu-main-menu" class="main-menu mom_visibility_desktop">
    <li class="menu-item <?php if ($controller == 'index') echo 'current-menu-item'; ?>">
        <a href="<?php echo $this->createUrl('index/index') ?>">
            <i class="icon_only momizat-icon-home"></i>
            <span class="icon_only_label">Home</span>
        </a>
    </li>
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
        foreach ($categories as $cate) {
            if ($cate['id'] == 20 | $cate['id'] == 22) {
                continue;
            }
            if (!empty($cate['sub'])) {
                echo '<li class="menu-item menu-item-has-children">';
            } else {
                echo '<li class="menu-item">';
            }
            echo '<a>' . $cate['name'] . '</a>';
            if (!empty($cate['sub'])) {
                echo '<ul class="sub-menu">';
                foreach ($cate['sub'] as $sub) {
                    if ($sub['id'] == 20 | $sub['id'] == 22) {
                        continue;
                    }
                    echo '<li class="menu-item"><a href="' . $this->createUrl('category/index', array('alias' => $sub['alias'])) . '">' . $sub['name'] . '</a></li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
    }

    ?>
    <li class="menu-item">
        <a href="<?php echo $this->createUrl('category/index', array('alias' => 'how-to')) ?>">How to</a>
    </li>
    <li class="menu-item">
        <a href="/reviews.html">Reviews</a>
    </li>
    <li class="menu-item">
        <a href="<?php echo $this->createUrl('video/index') ?>">Video</a>
    </li>
</ul>