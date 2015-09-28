<!-- Block main slider  Area -->
<?php $this->renderPartial('catslide', array('data' => $data)) ?>

<div class="clear"></div>
<!-- feature -->
<?php $this->renderPartial('feature', array('data' => $data)) ?>
<div class="clear"></div>
<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">

            <!-- Side Left Main Conten Area -->
            <div class="eight columns">
                <div id="content">
                    <!-- banner area -->
                    <?php $this->renderPartial('//layouts/banner_top') ?>
                    <!-- end banner -->

                    <!-- Block Category 2 -->
                    <?php $this->renderPartial('catebox', array('data' => $data)) ?>
                    <!-- end block category 2 -->


                    <?php $this->renderPartial('latestnew', array('data' => $data)) ?>

                    <!-- Line thin  -->
                    <div class="line1"></div>
                    <!-- Banner Area -->
                    <?php $this->renderPartial('//layouts/banner_top') ?>
                </div>
            </div>

            <div class="four columns">
                <aside>
                    <!-- widget video  -->
                    <?php $this->widget('ReviewWidget'); ?>

                    <!-- widget custome menus -->
                    <?php $this->widget('CategoryWidget'); ?>

                    <?php $this->widget('AdsWidget'); ?>

                    <?php $this->widget('SocialWidget'); ?>
                </aside>
            </div>
        </section>
    </div>
</div>