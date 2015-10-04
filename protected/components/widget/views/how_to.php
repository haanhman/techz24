<div class="widget widget-howto">
    <div class="widget-head"><h3 class="widget-title"><span>How to</span></h3>
    </div>
    <div class="mom-e3lanat-wrap  ">
        <div class="mom-e3lanat " style="margin-bottom:-10px;">
            <ul>
            <?php
                foreach($data as $item) {
                    $url_detail = $this->_controller->createUrl('detail/index', $item);
                    ?>
                    <li>
                        <h4>
                            <a href="<?php echo $url_detail ?>" title="<?php echo CHtml::encode($item['title']) ?>"><?php echo $item['title'] ?></a>
                        </h4>
                    </li>
                    <?php
                }
            ?>
            </ul>
        </div>
        <!--Mom ads-->
    </div>
</div>