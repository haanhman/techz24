<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><?php echo $data['title'] ?></div>
            </div>
            <div class="portlet-body">
                <?php echo showMessage() ?>
                <form action="" method="POST">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-actions">
                                        <button type="submit" class="btn blue">Cập nhật</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Tiêu đề</td>
                                <td>
                                    <input class="form-control" type="text" name="title"
                                           value="<?php echo CHtml::encode($data['title']) ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Nổi bật</td>
                                <td>
                                    <input <?php if ($data['is_feature'] == 1) echo 'checked=""'; ?> type="checkbox"
                                                                                                     name="is_feature"
                                                                                                     value="1"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Short text</td>
                                <td>
                                <textarea class="form-control" rows="10"
                                          name="description"><?php echo $data['description'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Thumbnail</td>
                                <td>
                                    <?php
                                    $thumbnails = json_decode($data['thumbnails'], true);
                                    foreach($thumbnails as $item) {
                                        echo $item['url'] . '<br />';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Video</td>
                                <td>
                                    <iframe width="560" height="315"
                                            src="https://www.youtube.com/embed/<?php echo $data['video_id'] ?>"
                                            frameborder="0" allowfullscreen></iframe>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>