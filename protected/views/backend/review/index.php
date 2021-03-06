<div class="row">
    <div class="col-md-12">

        <div style="margin-bottom: 10px;">
            <a href="<?php echo $this->createUrl('index', array('source' => 1)) ?>"
               class="btn btn-circle red-sunglo btn-sm">Cnet</a>
            <a href="<?php echo $this->createUrl('index', array('source' => 2)) ?>"
               class="btn btn-circle red-sunglo btn-sm">Techcrunch</a>
            <a href="<?php echo $this->createUrl('index', array('source' => 3)) ?>"
               class="btn btn-circle red-sunglo btn-sm">WPcentral</a>
            <a href="<?php echo $this->createUrl('index', array('source' => 4)) ?>"
               class="btn btn-circle red-sunglo btn-sm">Android Central</a>
        </div>

        <?php
        $source = isset($_GET['source']) ? intval($_GET['source']) : 1;
        ?>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <?php
                if ($source == 1) {
                    echo '<li><a href="' . $this->createUrl('review/checkvideo', array('source' => $source)) . '">Check video Cnet</a></li>';
                } else {
                    echo '<li><a href="' . $this->createUrl('review/checksource', array('source' => $source)) . '">Check source trong nội dung</a></li>';
                }
                ?>
            </ul>
        </div>


        <p>Tổng số có <strong><?php echo $item_count ?></strong> nội dung cần duyệt</p>
        <?php
        if ($data['total_have_video'] > 0) {
            echo 'Có <strong>' . $data['total_have_video'] . '</strong> tin cần phải check video';
        }

        ?>

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">Danh sách nội dung</div>
            </div>
            <div class="portlet-body">
                <?php echo showMessage(); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Hình ảnh</th>
                            <th>Video</th>
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
                                    <a href="<?php echo $this->createUrl('detail', array('id' => $item['id'])) ?>">
                                        <img class="thumbnail" src="<?php echo $item['thumbnail'] ?>"/>
                                    </a>
                                </td>
                                <th>
                                    <?php
                                    if ($item['have_video'] == 1) {
                                        echo '<i style="color: green;" class="icon-check"></i>';
                                    }
                                    ?>
                                </th>
                                <td>
                                    <a href="<?php echo $this->createUrl('detail', array('id' => $item['id'])) ?>"><?php echo $item['title'] ?></a>
                                    <br/>
                                    <?php echo $data['category'][$item['cate_id']] ?>
                                </td>
                                <td>
                                    <?php echo nl2br($item['short_text']) ?>
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
<style type="text/css">
    img.thumbnail {
        max-width: 150px;
    }
</style>