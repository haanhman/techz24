<div class="row">
    <div class="twelve columns ">
        <div id="catslide">
            <ul id="slider" data-orbit>
                <?php
                $i = 1;
                foreach ($data['catslide'] as $group) {
                    $item = array_shift($group);
                    $arr = array_chunk($group, 4);
                    ?>
                    <li data-orbit-slide="headline-<?php echo $i++ ?>">
                        <div class="row">
                            <div class="twelve columns">
                                <div class="itemcatslide">
                                    <div class="catf">
                                        <div class="imgslide">
                                            <img src="<?php echo $item['thumbnail'] ?>"
                                                 alt="<?php echo CHtml::encode($item['title']) ?>"
                                                 title="<?php echo CHtml::encode($item['title']) ?>"
                                                 class="slidefeatured">
                                        </div>
                                        <div class="catf-caption">
                                            <a href="<?php echo $this->createUrl('detail/index', array('alias' => $item['alias'])) ?>"><h2><?php echo $item['title'] ?></h2></a>
                                        </div>
                                    </div>
                                    <div class="listcat">
                                        <div class="title-catf">LATEST NEWS</div>
                                        <ul class="list-latestcat">
                                            <?php
                                            foreach ($arr[0] as $item) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo $this->createUrl('detail/index', array('alias' => $item['alias'])) ?>"><?php echo $item['title'] ?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="topcat">
                                        <div class="title-topcat">POPULAR NEWS</div>
                                        <ul class="list-topcat">
                                            <?php
                                            foreach ($arr[1] as $item) {
                                                ?>
                                                <li>
                                                    <div class="tthumb">
                                                        <a href="<?php echo $this->createUrl('detail/index', array('alias' => $item['alias'])) ?>">
                                                            <img src="<?php echo $item['thumbnail'] ?>"
                                                                 alt="<?php echo CHtml::encode($item['title']) ?>"
                                                                 title="<?php echo CHtml::encode($item['title']) ?>" >
                                                        </a>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>