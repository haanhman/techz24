<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">
            <!-- Side Left Main Conten Area -->
            <div class="eight columns">
                <div id="content">
                    <!-- banner area -->
                    <?php $this->renderPartial('//layouts/banner_top') ?>
                    <!-- end banner -->

                    <?php $this->renderPartial('//index/latestnew', array('data' => $data)) ?>
                    <div class="line1"></div>
                    <?php
                    if (!empty($data['newpost'])) {
                        echo '<div class="dataTables_paginate paging_bootstrap">';
                        $this->widget('CLinkPager', array(
                            'header' => '',
                            'pages' => $pages,
                        ));
                        echo '</div>';
                    }
                    ?>

                    <!-- Banner Area -->
                    <?php $this->renderPartial('//layouts/banner_top') ?>
                </div>
            </div>

            <div class="four columns">
                <aside>
                    <!-- widget video  -->
                    <?php $this->widget('VideoWidget'); ?>

                    <!-- widget custome menus -->
                    <?php $this->widget('CategoryWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>
                </aside>
            </div>
        </section>
    </div>
</div>