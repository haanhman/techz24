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
                    <i class="fa fa-coffee"></i>
                </div>
                <div class="tile-object">
                    <div class="name">Cnet</div>
                    <div class="number"><?php echo $data['cnet_crawler'] ?></div>
                </div>
            </div>
            <div class="tile bg-green" onclick="window.location='/crawler/techcrunch/detail';">
                <div class="tile-body">
                    <i class="fa fa-coffee"></i>
                </div>
                <div class="tile-object">
                    <div class="name">Cechcrunch</div>
                    <div class="number"><?php echo $data['techcrunch_crawler'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>