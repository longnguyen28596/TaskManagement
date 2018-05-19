<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<?= $this->Flash->render() ?>
<h2 style="text-align:center" class="title">Thêm mới nhiệm vụ cho project</h2>
<div class="content">
    <div id="message">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <form method="post" action="/Tasks/add/<?= $id ?>" id="formTaskAdd" enctype="multipart/form-data">
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
                                <div id="area-preview">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="">
                                            <label class="control-label">File đính kèm(click tại đây)</label>
                                            <div class="area-upload-img">
                                                <input class="files" type="file" name="files[]" onchange="changeimg(this);" multiple="multiple" placeholder="file đính kèm có thể là ảnh, text,..">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
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
                                        <select name="priority" class="form-control">
                                            <option value="Thấp">Thấp</option>
                                            <option value="Trung bình">Trung bình</option>
                                            <option value="Cao">Cao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Người thực hiện</label>
                                        <select name="user_action" class="user_action form-control">
                                            <option value="">Lựa chọn người thực hiện</option>
                                            <?php foreach($user_projects as $user_project) { 
                                                if (!is_null($user_project->user->name)) {
                                            ?>
                                                <option value=<?= $user_project->user->id ?>><?= $user_project->user->name . ' ( ' . $user_project->user->username . ' )'?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Tạo mới</button>
                            <input type="hidden" name="list-image-do-not-upload" id="list-image-do-not-upload" value="">
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function changeimg(a) {
        for (var i=0, len = a.files.length; i < len; i++) {
            (function (j, self) {
                var reader = new FileReader()
                reader.onload = function (e) {
                    if (self.files[j].type === 'image/jpeg' || self.files[j].type === 'image/png' || self.files[j].type === 'image/gif')
                        $('#area-preview ').append('<div title="'+self.files[j].name+'" class="col-md-2 preview-image"><button onclick="deleteFileUpload(this);" style="font-size:30px;position: relative;top: -9px;color:red" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button> <img style="width: 80px;position: relative;left: 16px;" src="' + e.target.result + '"> <p class="file_name_upload">' + self.files[j].name + '</p></div>')
                    else
                        $('#area-preview ').append('<div title="'+self.files[j].name+'" class="col-md-2 preview-image"><button onclick="deleteFileUpload(this);" style="font-size:30px;position: relative;top: -9px;color:red" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button> <i style="font-size: 73px;position: relative;left: 30px;" class="material-icons">description</i><p class="file_name_upload">' + self.files[j].name + '</p></div>')
                }            
                reader.readAsDataURL(self.files[j])
            })(i, a);
        }
    };
    function deleteFileUpload(a) {
        $(a).parent().remove()
        b = $('#list-image-do-not-upload').val();
        b += $(a).parent().find(('.file_name_upload')).text()+ "|";
        $('#list-image-do-not-upload').val(b);
    }
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
        $('.user_action').select2({
            placeholder: "Lựa chọn người thực hiện"
        });
    })
    jQuery('#datetimepicker').datetimepicker({
        format:'Y/m/d H:i'
    });
</script>

<?= $this->Element('custom_select2'); ?>