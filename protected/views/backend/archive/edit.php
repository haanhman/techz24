<?php
$category = $data['category'];
$data = $data['row'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <?php echo $data['title'] ?>
                </div>
            </div>
            <div class="portlet-body form">
                <?php echo showMessage() ?>
                <form action="" method="POST">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Nguồn</label>
                            <br/>
                            <a target="_blank" rel="nofollow"
                               href="<?php echo $data['source_url'] ?>"><?php echo $data['source_url'] ?></a>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" value="<?php echo $data['title'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" name="cate_id" style="width: 200px;">
                                <option value="0">Chọn danh mục</option>
                                <?php
                                foreach ($category as $cate_id => $cate_name) {
                                    ?>
                                    <option <?php if ($data['cate_id'] == $cate_id) echo 'selected=""'; ?>
                                        value="<?php echo $cate_id ?>"><?php echo $cate_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <img src="<?php echo $data['thumbnail'] ?>" class="thumbnail"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Short text</label>
                            <textarea class="form-control" rows="3"
                                      name="short_text"><?php echo $data['short_text'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung chính</label>
                            <textarea class="form-control" rows="3"
                                      name="content" id="summernote_1"><?php echo $data['content'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta keywords</label>
                            <textarea class="form-control" rows="3"
                                      name="meta_keywords"><?php echo $data['meta_keywords'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" rows="3"
                                      name="meta_description"><?php echo $data['meta_description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <?php
                            $tags = '';
                            if (!empty($data['tags'])) {
                                $tags = json_decode($data['tags']);
                                $tags = implode(', ', $tags);
                            }
                            ?>
                            <textarea class="form-control" rows="3" name="tags"><?php echo $tags ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gallery</label>
                            <br/>
                            <input type="checkbox" name="remove_gallery" value="1"/> Bỏ gallery
                            <br/>
                            <?php
                            if (empty($data['gallery'])) {
                                echo 'N/A';
                            } else {
                           $gallery = json_decode($data['gallery'], true);
                                echo '<h2>' . $gallery['title'] . '<h2>';
                                echo '<div class="gallery">';
                                foreach ($gallery['images'] as $img) {
                                    echo '<img src="' . $img . '" class="thumbnail"/>';
                                }
                                echo '</div>';
                            }
                            ?>
                            <div style="clear: both"></div>
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
<style type="text/css">
    div.form-group label {
        font-weight: bold
    }

    img.thumbnail {
        max-width: 150px;
    }

    div.gallery img {
        float: left;
        margin-right: 5px;
    }
</style>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>/public/assets/global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo base_url() ?>/public/assets/global/plugins/bootstrap-summernote/summernote.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url() ?>/public/assets/admin/pages/scripts/components-editors.js"></script>
<script type="text/javascript">
    $(function () {
        ComponentsEditors.init();
    });
</script>