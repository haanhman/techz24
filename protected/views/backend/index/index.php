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
                    <div class="number"><?php echo $data['total_item'] ?></div>
                </div>
            </div>

        </div>
    </div>
</div>