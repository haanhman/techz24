<h3 class="page-title">Dashboard</h3>
<div class="row">
    <div class="col-md-12">
        <?php echo showMessage() ?>
        <div class="tiles">
            <div class="tile bg-green-meadow" onclick="window.location='<?php echo $this->createUrl('latestcomment') ?>';">
                <div class="tile-body">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="tile-object">
                    <div class="name">Comment</div>
                    <div class="number"><?php echo $data['total_comment'] ?></div>
                </div>
            </div>
            <div class="tile bg-green" onclick="window.location='<?php echo $this->createUrl('review/index') ?>';">
                <div class="tile-body">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="tile-object">
                    <div class="name">Reviews</div>
                    <div class="number"><?php echo $data['total_review'] ?></div>
                </div>
            </div>
            <div class="tile bg-red-intense" onclick="window.location='/crawler/cnet/detail';">
                <div class="tile-body">
                    <div style="font-size: 30px;padding-top: 35px;text-align: center;">Cnet</div>
                </div>
                <div class="tile-object">
                    <div class="number"><?php echo $data['cnet_crawler'] ?></div>
                </div>
            </div>
            <div class="tile bg-green" onclick="window.location='/crawler/techcrunch/detail';">
                <div class="tile-body">
                    <div style="font-size: 18px;padding-top: 35px;text-align: center;">Cechcrunch</div>
                </div>
                <div class="tile-object">
                    <div class="name"></div>
                    <div class="number"><?php echo $data['techcrunch_crawler'] ?></div>
                </div>
            </div>
            <div class="tile bg-red-intense" onclick="window.location='/crawler/wpcentral/detail';">
                <div class="tile-body">
                    <div style="font-size: 20px;padding-top: 35px;text-align: center;">WPcentral</div>
                </div>
                <div class="tile-object">
                    <div class="number"><?php echo $data['wpcentral_crawler'] ?></div>
                </div>
            </div>

            <div class="tile bg-green" onclick="window.location='<?php echo $this->createUrl('tag') ?>';">
                <div class="tile-body">
                    <div style="font-size: 84px;padding-top: 35px;text-align: center;">@</div>
                </div>
                <div class="tile-object">
                    <div class="name">Tags</div>
                    <div class="number"></div>
                </div>
            </div>
        </div>
        <div class="tiles">
            <div class="tile bg-red-intense" onclick="window.location='<?php echo $this->createUrl('reviewyt/index') ?>';">
                <div class="tile-body">
                    <i class="fa fa-youtube-play"></i>
                </div>
                <div class="tile-object">
                    <div class="name">Youtube</div>
                    <div class="number"><?php echo $data['total_youtube'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>