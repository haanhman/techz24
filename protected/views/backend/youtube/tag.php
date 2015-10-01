<div class="row">
    <div class="col-md-12">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo $this->createUrl('tag', array('feature' => 1)) ?>">Feature</a>
                </li>
            </ul>
        </div>


        <p>Tổng số có <strong><?php echo $item_count ?></strong> tags</p>

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">Danh sách tags youtube</div>
            </div>
            <div class="portlet-body">
                <?php echo showMessage(); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Tags name</th>
                            <th>Feature</th>
                            <th>Total video</th>
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
                                    <a href="<?php echo $this->createUrl('tag', array('action' => 'edit', 'id' => $item['id'])) ?>"><?php echo $item['name'] ?></a>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if ($item['is_feature'] == 1) {
                                        echo '<i style="color: green; font-size: 20px;" class="icon-check"></i><br />';
                                    }
                                    ?>
                                    <a href="<?php echo $this->createUrl('tag', array('action' => 'changefeature', 'id' => $item['id'])) ?>">Change</a>
                                </td>
                                <td><?php echo $item['total_video'] ?></td>
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