<div class="row">
    <div class="twelve columns">
        <!-- off-canvas menus cho mobile -->
        <ul id="logos" class="nav-bar">
            <li class="logos"><a href="#"><img class="logo"
                                               src="<?php echo base_url() ?>/public/assets/fontend/images/logo.png"
                                               alt="" title=""></a>

                <div class="menu-btn">&#9776;</div>
            </li>
        </ul>

        <!-- Entire Navbar Code -->
        <nav class="mainbar" id="mainbar">
            <div class="two columns">
                <a href="<?php echo $this->createUrl('index/index') ?>"><img class="logo"
                                            src="<?php echo base_url() ?>/public/assets/fontend/images/logo.png" alt=""
                                            title=""></a>
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
                    <li><a href="archive_three.html">reviews</a></li>
                    <li><a class="" href="#">video</a></li>
                </ul>
            </div>
            <div class="three columns">
                <ul class="sf-menu" id="topsearch">
                    <li>
                        <div style="position: relative;margin: 12px 5px 0 0 !important;">
                            <input class="custom-text" type="text" name="search" placeholder="Search">

                            <div class="icon-ph"><i class="fa fa-search"></i></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>