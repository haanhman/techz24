<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <?php $controller = Yii::app()->controller->id; ?>
            <li class="start <?php if($controller == 'index') echo 'active'; ?>">
                <a href="<?php echo $this->createUrl('index/index') ?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li <?php if($controller == 'user') echo 'class="active"'; ?>>
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Người dùng</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo $this->createUrl('user/index') ?>">
                            <i class="icon-briefcase"></i> Danh sách</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->createUrl('rule/index') ?>">
                            <i class="icon-users"></i> Nhóm người dùng</a>
                    </li>
                </ul>
            </li>
            <li <?php if($controller == 'category') echo 'class="active"'; ?>>
                <a href="<?php echo $this->createUrl('category/index') ?>">
                    <i class="icon-present"></i>
                    <span class="title">Danh mục</span>
                </a>
            </li>
            <li <?php if($controller == 'archive') echo 'class="active"'; ?>>
                <a href="<?php echo $this->createUrl('archive/index') ?>">
                    <i class="icon-puzzle"></i>
                    <span class="title">News</span>
                </a>
            </li>
            <li <?php if($controller == 'youtube') echo 'class="active"'; ?>>
                <a href="<?php echo $this->createUrl('youtube/index') ?>">
                    <i class="icon-social-youtube"></i>
                    <span class="title">Youtube</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo $this->createUrl('youtube/index') ?>">
                            <i class="icon-briefcase"></i> Danh sách video</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->createUrl('youtube/tag') ?>">
                            <i class="icon-briefcase"></i> Tags</a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>