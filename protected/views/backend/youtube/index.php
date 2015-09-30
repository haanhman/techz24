<div class="row">
    <div class="col-md-12">
        <p>Tổng số có <strong><?php echo $item_count ?></strong> video cần duyệt</p>

        <form method="GET" action="">
            <?php
            $name = urlGETParams('name');
            $feature = urlGETParams('feature', VARIABLE_NUMBER);
            $order = urlGETParams('order', VARIABLE_NUMBER);
            $error = urlGETParams('error', VARIABLE_NUMBER);
            ?>
            Tiêu đề video
            <input class="form-control" style="width: 200px; display: inline-block" type="text" name="name" value="<?php echo CHtml::encode($name) ?>" />
            <label><input type="checkbox" name="feature" value="1" <?php if($feature == 1) echo 'checked=""'; ?> /> Feature</label>
            <label><input type="checkbox" name="order" value="1" <?php if($order == 1) echo 'checked=""'; ?> /> Order created</label>
            <label><input type="checkbox" name="error" value="1" <?php if($error == 1) echo 'checked=""'; ?> /> Lỗi</label>
            <input type="submit" value="Search">
        </form>
        <hr />

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">Danh sách video từ youtube</div>
            </div>
            <div class="portlet-body">
                <?php echo showMessage(); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Thumbnail</th>
                            <th>Feature</th>
                            <th>Error</th>
                            <th>Channel Name</th>
                            <th>published</th>
                            <th>Tiêu đề</th>
                            <th style="width: 5%">Xoá</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
                        if ($page <= 0) {
                            $page = 1;
                        }

                        $i = ($page - 1) * $page_size + 1;
                        foreach ($data['listItem'] as $item) {
                            ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td>
                                    <a href="<?php echo $this->createUrl('detail', array('id' => $item['id'])) ?>">
                                        <img class="thumbnail"
                                             src="<?php echo getYoutubeThumbnail($item['thumbnails'], 'medium') ?>"/>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if($item['is_feature'] == 1) {
                                        echo '<i style="color: green; font-size: 20px;" class="icon-check"></i>';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if($item['is_error'] == 1) {
                                        echo '<i style="color: red; font-size: 20px;" class="fa fa-warning"></i>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $item['channel_name'] ?></td>
                                <td>
                                    <?php echo substr($item['publishedAt'], 1, 10) ?>
                                </td>
                                <td>
                                    <a href="<?php echo $this->createUrl('detail', array('id' => $item['id'])) ?>"><?php echo $item['title'] ?></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')"
                                       href="<?php echo $this->createUrl('delete', array('id' => $item['id'])) ?>"><i
                                            class="icon-trash"></i></a>
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
        <?php
        if (!empty($data['listItem'])) {
            echo '<div class="dataTables_paginate paging_bootstrap">';
            $this->widget('CLinkPager', array(
                'header' => '',
                'pages' => $pages,
            ));
            echo '</div>';
        }
        ?>
    </div>
</div>