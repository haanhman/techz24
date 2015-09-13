<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i> Thêm mới danh mục
                </div>
            </div>
            <div class="portlet-body form">
                <form action="" method="POST">
                <div class="form-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input class="form-control" type="text" name="name" value="" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label>Danh mục mục cha</label>
                        <select class="form-control" name="parent_id" style="width: 200px;">
                            <option value="0">Chọn danh mục</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="status" style="width: 200px;">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Meta title</label>
                        <textarea class="form-control" name="meta_title" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Meta keywords</label>
                        <textarea class="form-control" name="meta_keywords" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Meta description</label>
                        <textarea class="form-control" name="meta_description" rows="5"></textarea>
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