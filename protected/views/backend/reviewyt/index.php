<div class="row">
    <div class="col-md-12">
        <p>Tổng số có <strong><?php echo $item_count ?></strong> video cần duyệt</p>

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