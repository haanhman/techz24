<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$title = 'Product reviews and prices, and tech news - Techz24';
?>
<div class="row">
    <div class="twelve columns">
        <!-- off-canvas menus cho mobile -->
        <ul id="logos" class="nav-bar">
            <li class="logos">
                <?php
                if ($controller == 'index' && $action == 'index') {
                    echo '<h1 style="padding: 0px; margin: 0px;">';
                }
                ?>
                <a href="#"><img class="logo"
                                 src="<?php echo base_url() ?>/public/assets/fontend/images/logo.png"
                                 alt="<?php echo CHtml::encode($title) ?>"
                                 title="<?php echo CHtml::encode($title) ?>"></a>
                <?php
                if ($controller == 'index' && $action == 'index') {
                    echo '</h1>';
                }
                ?>
                <div class="menu-btn">&#9776;</div>
            </li>
        </ul>

        <!-- Entire Navbar Code -->
        <nav class="mainbar" id="mainbar">
            <div class="two columns">
                <?php
                if ($controller == 'index' && $action == 'index') {
                    echo '<h1 style="padding: 0px; margin: 0px;">';
                }
                ?>
                <a href="<?php echo $this->createUrl('index/index') ?>"><img class="logo"
                                                                             src="<?php echo base_url() ?>/public/assets/fontend/images/logo.png"
                                                                             alt="<?php echo CHtml::encode($title) ?>"
                                                                             title="<?php echo CHtml::encode($title) ?>"></a>
                <?php
                if ($controller == 'index' && $action == 'index') {
                    echo '</h1>';
                }
                ?>
            </div>
            <div class="seven columns">
                <ul id="barnav" class="sf-menu nav-bar">
                    <li class="active">
                        <a href="#">NEWS</a>
                        <?php
                        $categories = $this->getListCategory();
                        if (!empty($categories)) {
                            echo '<ul>';
                            foreach ($categories as $cate) {
                                echo '<li><a href="' . $this->createUrl('category/index', array('alias' => $cate['alias'])) . '">' . $cate['name'] . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </li>
                    <li><a href="#">reviews</a></li>
                    <li><a href="#">video</a></li>
                </ul>
            </div>
            <div class="three columns">
                <ul class="sf-menu" id="topsearch">
                    <li>
                        <div style="position: relative;margin: 12px 5px 0 0 !important;">
                            <?php
                            $keyword = isset($_GET['keyword']) ? urlGETParams('keyword') : '';
                            ?>
                            <form action="<?php echo $this->createUrl('search/index') ?>" method="GET">
                                <input value="<?php echo CHtml::encode($keyword) ?>" class="custom-text" type="text"
                                       name="keyword" placeholder="Search">

                                <div class="icon-ph"><i class="fa fa-search"></i></div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>