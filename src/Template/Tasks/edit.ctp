<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<h2 style="text-align:center" class="title">Cập nhập nhiệm vụ</h2>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <form method="post" action="/Tasks/edit/<?= $id ?>" id="formTaskEdit" enctype="multipart/form-data">
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
                            <div>
                                <h4 style="color: black;font-weight: 400;">File đính kèm</h4>
                                <div style="border: 0.05rem solid #8e24aa; margin-bottom: 10px"></div>
                                <?php foreach($task->images as $image){ ?>
                                    <p><a class="file_attachement" data-url_image='<?= "/webroot/img/admin/tasks/$task->id/".$image->file_name.'.'.$image->file_extension ?>' href="<?= "/webroot/img/admin/tasks/$task->id/".$image->file_name.'.'.$image->file_extension ?>" download><?= $image->default_name ?></a> <button data-image_id=<?= $image->id ?> onclick="remove_file_attachement(<?= $image->id ?>, this)" style="font-size:30px;position: relative;top: -3px;color:red;float: left;left: 130px;" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>
                                <?php }?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Deadline</label>
                                        <input type="text" name="deadline" id="datetimepicker" value="<?=$this->Application->fullDateTime($task->deadline)?>" class="form-control">
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
                                                $selected = $task->user_action == $user_project->user_id ? "selected" : "";
                                            ?>
                                                <option <?= $selected ?> value=<?= $user_project->user_id ?>><?= $user_project->user->name . ' ( ' . $user_project->user->username . ' )'?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Cập nhập</button>
                            <div class="clearfix"></div>
                            <input type="hidden" name="list-image-do-not-upload" id="list-image-do-not-upload" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="preview" style="background-color: #d6d5e0; width: 350px; height: 250px; display: none; position: fixed; top: 30%; left: 40%;"></div>

<script type="text/javascript">
    $(document).ready(function() {
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
        $(".area-upload-img").click(function() {
            $('.files').hide()
            $('.area-upload-img').append('<input class="files" onchange="changeimg(this);" type="file" name="files[]" multiple="multiple" placeholder="file đính kèm có thể là ảnh, text,..">');
        });
    })
    jQuery('#datetimepicker').datetimepicker({
        format:'d/m/Y H:i'
    });

    $('.file_attachement').hover(function() {
        $('.preview_file').remove()
        $('#preview').append( '<img class="preview_file" style="width:100%; height: 100%"  src="'+$(this).data('url_image')+'">')
        $('#preview').css('display', 'block')
    },function(){
        $('#preview').css('display', 'none')
    })

    function remove_file_attachement(image_id, a) {
        $(a).parent().remove()
        $.ajax({
            url: '/images/delete/'+image_id,
            type: 'POST',
            data: {
                id: image_id
            }
        }).done(function(ketqua) {
        })
    }

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
</script>
