<?php
$row = $data['row'];
if(empty($row)) {
    $row['status'] = 1;
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <?php
                    if (!empty($row)) {
                        echo 'Sửa thông tin danh mục: ' . $row['name'];
                    } else {
                        echo 'Thêm mới danh mục';
                    }
                    ?>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="" method="POST">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input class="form-control" type="text" name="name"
                                   value="<?php echo CHtml::encode($row['name']) ?>" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label>Weight</label>
                            <input class="form-control" type="text" name="weight"
                                   value="<?php echo $row['weight'] ?>">
                        </div>

                        <div class="form-group">
                            <label>CNET Url</label>
                            <input class="form-control" type="text" name="cnet_url"
                                   value="<?php echo $row['cnet_url']?>" placeholder="Nhập URL CNET">
                        </div>
                        <div class="form-group">
                            <label>Techcrunch Url</label>
                            <input class="form-control" type="text" name="techcrunch_url"
                                   value="<?php echo $row['techcrunch_url']?>" placeholder="Nhập URL Techcrunch">
                        </div>
                        <div class="form-group">
                            <label>WPcentral Url</label>
                            <input class="form-control" type="text" name="wpcentral_url"
                                   value="<?php echo $row['wpcentral_url']?>" placeholder="Nhập URL wpcentral">
                        </div>

                        <div class="form-group">
                            <label>Danh mục mục cha</label>
                            <select class="form-control" name="parent_id" style="width: 200px;">
                                <option value="0">Chọn danh mục</option>
                                <?php
                                foreach ($data['category'] as $cate_id => $cate_name) {
                                    ?>
                                    <option <?php if ($row['parent_id'] == $cate_id) echo 'selected=""'; ?>
                                        value="<?php echo $cate_id ?>"><?php echo $cate_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status" style="width: 200px;">
                                <option value="1" <?php if($row['status'] == 1) echo 'selected=""'; ?>>Hiển thị</option>
                                <option value="0" <?php if($row['status'] == 0) echo 'selected=""'; ?>>Ẩn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nổi bật</label><br />
                            <input <?php if($row['is_feature'] == 1) echo 'checked=""'; ?> data-checkbox="icheckbox_minimal-red" class="icheck" name="is_feature" type="checkbox" value="1" />
                        </div>

                        <div class="form-group">
                            <label>Meta title</label>
                            <textarea class="form-control" name="meta_title" rows="5"><?php echo $row['meta_title'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" name="meta_description" rows="5"><?php echo $row['meta_description'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta keywords</label>
                            <textarea class="form-control" name="meta_keywords" rows="5"><?php echo $row['meta_keywords'] ?></textarea>
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>