<div class="row">
    <div class="col-md-12">

        <div style="margin-bottom: 10px;">
            <a href="<?php echo $this->createUrl('add') ?>" class="btn btn-circle red-sunglo btn-sm">
                <i class="fa fa-plus"></i> Thêm mới</a>
        </div>
        <?php echo showMessage(); ?>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">Nhóm người dùng</div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Tên danh mục</th>
                            <th>Crawler</th>
                            <th style="width: 5%">Sửa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($data['listItem'] as $item) {
                            ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $item['name'] ?></td>
                                <td>
                                    <?php echo intval($data['static'][$item['id']]); ?>/
                                    <strong style="color: red"><?php echo intval($data['use'][$item['id']]); ?></strong>
                                    -
                                    <a target="_blank" href="<?php echo $this->createUrl('review/index', array('cate_id' => $item['id'])) ?>">Review</a>
                                </td>
                                <td>
                                    <a href="<?php echo $this->createUrl('edit', array('id' => $item['id'])) ?>"><i class="icon-pencil"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>