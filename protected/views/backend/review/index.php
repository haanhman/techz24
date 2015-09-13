
<div class="row">
    <div class="col-md-12">
        <p>Tổng số có <strong><?php echo $item_count ?></strong> nội dung cần duyệt</p>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">Danh sách nội dung </div>
            </div>
            <div class="portlet-body">
                <?php echo showMessage(); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Hình ảnh</th>
                            <th style="width: 40%">Tiêu đề</th>
                            <th>Short text</th>
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
                                    <img class="thumbnail" src="<?php echo $item['thumbnail'] ?>" />
                                </td>
                                <td>
                                    <a href="<?php echo $this->createUrl('detail', array('id' => $item['id'])) ?>"><?php echo $item['title'] ?></a>
                                    <br />
                                    <?php echo $data['category'][$item['cate_id']] ?>
                                </td>
                                <td>
                                    <?php echo nl2br($item['short_text']) ?>
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="<?php echo $this->createUrl('delete', array('id' => $item['id'])) ?>"><i class="icon-trash"></i></a>
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
<style type="text/css">
    img.thumbnail {
        max-width: 150px;
    }
</style>