<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<h2 style="text-align:center" class="title">Thêm mới nhiệm vụ cho project</h2>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <form method="post" action="/Tasks/add/<?= $id ?>" id="formTaskAdd">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên task</label>
                                        <input type="text" placeholder="Nhập title" name="title" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Mô tả nhiệm vụ</label>
                                		<textarea name="description" class="ckeditor" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File đính kèm(click tại đây)</label>
                                        <input type="file" placeholder="File đính kèm có thể là ảnh, text,.." name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Deadline</label>
                                        <input type="text" placeholder="Hạn xong task" id="datetimepicker" name="deadline" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mức độ ưu tiên task</label>
                                        <select name="priority_id" class="form-control">
                                            <?php foreach($priorities as $priority) { ?>
                                                <option value=<?= $priority->id ?>><?= $priority->note?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Người làm</label>
                                        <select name="user_action" class="form-control">
                                            <option value="">Lựa chọn người thực hiện</option>
                                            <?php foreach($user_projects as $user_project) { ?>
                                                <option value=<?= $user_project->id ?>><?= $user_project->user->name . ' ( ' . $user_project->user->username . ' )'?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Tạo mới</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var valcaator = $("#formTaskAdd").validate({
            rules: {
                title: "required",
                email: {
                    required: true,
                },
            },
            messages: {
                title: "Hãy điền đầy tên nhiệm vụ này.",
                email: {
                    required: "Hãy lựa chọn người thực hiện.",
                },
            }
        });
    })
    jQuery('#datetimepicker').datetimepicker({
        format:'Y/m/d'
    });
</script>
