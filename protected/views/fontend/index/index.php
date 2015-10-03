<div class="boxed-content-wrapper clearfix">

    <div class="nav-shaddow"></div>
    <div style="margin-top:-17px; margin-bottom:20px;"></div>

    <div class="inner">
        <div class="category-title">
        </div>
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="vc_main_col wpb_column vc_column_container ">
                <div class="wpb_wrapper">
                    <?php $this->renderPartial('feature-post', array('data' => $data)) ?>
                    <?php $this->renderPartial('slide2', array('data' => $data)) ?>
                    <!--News box two-->
                    <?php $this->renderPartial('new-box', array('data' => $data)) ?>
                    <!--news box-->
                    <!--News box two-->
                    <?php $this->renderPartial('box-social', array('data' => $data)) ?>
                    <?php $this->renderPartial('box-game', array('data' => $data)) ?>

                    <!--news box-->
                    <div class="clear"></div>
                    <!--News box 2 columns-->

                    <?php $this->renderPartial('recent-post', array('data' => $data)) ?>

                </div>
            </div>

            <div class="vc_sec_sidebar sidebar secondary-sidebar wpb_column vc_column_container ">
                <div class="wpb_wrapper">

                    <div class="wpb_widgetised_column sidebar wpb_content_element">
                        <div class="wpb_wrapper">
                            <?php $this->widget('FeatureVideoWidget'); ?>
                            <?php $this->renderPartial('ads-small', array('data' => $data)) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vc_sidebar sidebar main-sidebar wpb_column vc_column_container ">
                <div class="wpb_wrapper">

                    <div class="wpb_widgetised_column sidebar wpb_content_element">

                            <?php $this->widget('ReviewWidget'); ?>
                            <?php $this->widget('RecentVideoAndTagWidget'); ?>

                            <?php $this->widget('SocialWidget'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--main inner-->

</div>