<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><?php echo $data['title'] ?></div>
            </div>
            <div class="portlet-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td style="width: 15%">Tiêu đề</td>
                            <td><?php echo $data['title'] ?></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>
                                <img src="<?php echo $data['thumbnail'] ?>" class="thumbnail"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Short text</td>
                            <td>
                                <?php echo nl2br($data['short_text']) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nội dung chính</td>
                            <td><?php echo $data['content'] ?></td>
                        </tr>
                        <tr>
                            <td>Tags</td>
                            <td>
                                <?php
                                if (empty($data['tags'])) {
                                    echo 'N/A';
                                } else {
                                    $tags = json_decode($data['tags']);
                                    echo implode(', ', $tags);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Gallery</td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td>Meta keywords</td>
                            <td><?php echo $data['meta_keywords'] ?></td>
                        </tr>
                        <tr>
                            <td>Meta description</td>
                            <td><?php echo $data['meta_description'] ?></td>
                        </tr>
                        <tr>
                            <td>Source URL</td>
                            <td><a target="_blank" rel="nofollow"
                                   href="<?php echo $data['source_url'] ?>"><?php echo $data['source_url'] ?></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <a href="<?php echo $this->createUrl('edit', array('id' => $data['id'])) ?>">
        <span class="icon-pencil"></span>
    </a>
    <a href="<?php echo $this->createUrl('approve', array('id' => $data['id'])) ?>">
        <span class="icon-like"></span>
    </a>
</div>
<style type="text/css">

    div.panel {
        z-index: 9999;
        background: gray;
        position: fixed;
        top: 100px;
        right: 10px;
        padding: 5px;
    }
    div.panel a {
        padding: 0px 10px;
    }
    div.panel span {
        font-size: 30px;
    }

    img.thumbnail {
        max-width: 150px;
    }

    div.gallery img {
        float: left;
        margin-right: 5px;
    }
</style>