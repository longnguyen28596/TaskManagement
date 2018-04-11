<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<h2 style="text-align:center" class="title">Thêm mới nhiệm vụ cho project</h2>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <form method="post" action="/Tasks/edit/<?= $id ?>" id="formTaskEdit">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên task</label>
                                        <input type="text" value="<?= $task->title ?>" placeholder="Nhập title" name="title" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Mô tả nhiệm vụ</label>
                                		<textarea name="description" class="ckeditor" ><?= $task->description ?></textarea>
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
                                        <label class="control-label">Tình trạng</label>
                                        <select name="status" class="form-control">
                                            <option <?php if ($task->status == 'Chưa làm') echo "selected"; ?> value='Chưa làm'>Chưa làm</option>
                                            <option <?php if ($task->status == 'Đang làm') echo "selected"; ?> value='Đang làm'>Đang làm</option>
                                            <option <?php if ($task->status == 'Kiểm tra') echo "selected"; ?> value='Kiểm tra'>Kiểm tra</option>
                                            <option <?php if ($task->status == 'Đã xong') echo "selected"; ?> value='Đã xong'>Đã xong</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mức độ ưu tiên task</label>
                                        <select name="priority" class="form-control">
                                            <option <?php if($task->priority == "Thấp") echo 'selected'; ?> value="Thấp">Thấp</option>
                                            <option <?php if($task->priority == "Trung bình") echo 'selected'; ?> value="Trung bình">Trung bình</option>
                                            <option <?php if($task->priority == "Cao") echo 'selected'; ?>value="Cao">Cao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Người làm</label>
                                        <select name="user_action" class="form-control">
                                            <option value="">Lựa chọn người thực hiện</option>
                                            <?php foreach($user_projects as $user_project) { 
                                                $selected = $task->user_action == $user_project->id ? "selected" : "";
                                            ?>
                                                <option <?= $selected ?> value=<?= $user_project->id ?>><?= $user_project->user->name . ' ( ' . $user_project->user->username . ' )'?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Cập nhập</button>
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
        var valcaator = $("#formTaskEdit").validate({
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
        format:'Y/m/d',
        startDate: '2018/1/1',
    });
    $('#deadline').data("DateTimePicker").show();

</script>
