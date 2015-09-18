<h3 class="blocktitle"><span>LATEST COMMENTS</span></h3>
<div class="listcomment">
    <ul class="listcomment">
        <?php
            foreach($data['listItem'] as $item) {
                ?>
                <li>
                    <div class="cthumb">
                        <a rel="nofollow" target="_blank" href="<?php echo $item['profileUrl'] ?>"><img src="<?php echo $item['avatar'] ?>" alt="<?php echo CHtml::encode($item['name']) ?>"></a>
                    </div>
                    <div class="dcomment">
                        <a><strong><?php echo $item['name'] ?></strong>
                            <?php echo nl2br($item['raw_message']) ?>
                        </a>
                    </div>
                </li>
                <?php
            }
        ?>
    </ul>
</div>