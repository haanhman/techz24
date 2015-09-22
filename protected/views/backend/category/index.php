<?php
$page = 1;
?>
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
                            <th>Parent</th>
                            <th>Source URL</th>
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
                                <td>
                                    <a href="<?php echo $this->createUrl('edit', array('id' => $item['id'])) ?>"><?php echo $item['name'] ?></a>
                                </td>
                                <td>
                                    <?php
                                    if ($item['parent_id'] == 0) {
                                        echo '<i style="color: green;" class="icon-check"></i>';
                                    }
                                    ?>
                                </td>
                                <td></td>
                                <td>
                                    <?php echo intval($data['static'][$item['id']]); ?>
                                </td>
                                <td>
                                    <a href="<?php echo $this->createUrl('edit', array('id' => $item['id'])) ?>"><i
                                            class="icon-pencil"></i></a>
                                </td>
                            </tr>
                            <?php
                            if (!empty($item['sub'])) {
                                foreach ($item['sub'] as $sub) {


                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo $this->createUrl('edit', array('id' => $sub['id'])) ?>"><?php echo $sub['name'] ?></a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <?php
                                            if (!empty($sub['cnet_url'])) {
                                                $run_url = '/crawler/cnet/category?cate_id=' . $sub['id'] . '&page=' . $page;
                                                echo 'CNet: <a rel="nofollow" href="' . $run_url . '" target="_blank">' . $sub['cnet_url'] . '</a><br />';
                                            }
                                            if (!empty($sub['techcrunch_url'])) {
                                                $page = 5;
                                                $run_url = '/crawler/techcrunch/category?cate_id=' . $sub['id'] . '&page=' . $page;
                                                echo 'Techcrunch: <a rel="nofollow" href="' . $run_url . '" target="_blank">' . $sub['techcrunch_url'] . '</a>';
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php echo intval($data['static'][$sub['id']]); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->createUrl('edit', array('id' => $sub['id'])) ?>"><i
                                                    class="icon-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>