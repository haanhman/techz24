<?php
$row = $data['row'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">Sửa tags youtube</div>
            </div>
            <div class="portlet-body form">
                <form action="" method="POST">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input class="form-control" type="text" name="name"
                                   value="<?php echo CHtml::encode($row['name']) ?>" placeholder="Nhập tên danh mục">
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