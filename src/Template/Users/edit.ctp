<?php
    $checked_sex = $user->sex == 1 ? 'checked' : '';
?>
<?= $this->Html->script('admin/jquery.uploadPreview.min.js') ?>

<h2 style="text-align:center" class="title"></h2>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Cập nhập thông tin cá nhân</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" enctype="multipart/form-data" action="/Users/edit/<?= $user->id ?>" id="formUpdateProfile">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="avatar" style="top: 25px; background-image: url(<?= $user->avatar ?>);">
                                        <input type="file" name="avatar" accept="image/gif, image/jpeg, image/png">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Họ và tên</label>
                                        <input type="text" value="<?= $user->name ?>" placeholder="Nhập họ và tên" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" value="<?= $user->email ?>" placeholder="Nhập email" name="email" class="form-control">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số chứng minh nhân dân</label>
                                        <input type="text" value="<?= $user->id_card ?>" placeholder="Nhập số CMND" name="id_card" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ngày tháng năm sinh</label>
                                        <input type="text" value="<?= $this->Application->fullDate($user->birthday) ?>" placeholder="Ngày tháng năm sinh" id="datetimepicker" name="birthday" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="">Giới tính</label><br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" <?= $checked_sex = $user->sex == 1 ? 'checked' : ''; ?> name="sex" value="1"><span class="checkbox-material"></span>Nam
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" <?= $checked_sex = $user->sex == 0 ? 'checked' : ''; ?> name="sex" value="0"><span class="checkbox-material"></span>Nữ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại</label>
                                        <input type="text" value="<?= $user->phone ?>" placeholder="Nhập số SĐT" name="phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ thường trú</label>
                                        <input type="text" value="<?= $user->address ?>"  placeholder="Nhập địa chỉ" name="address" class="form-control">
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
        var valcaator = $("#formUpdateProfile").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email:true,
                },
                id_card: {
                    required: true,
                    number: true,
                },
                phone: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                name: "Hãy điền đầy đủ họ của bạn.",
                email: {
                    required: "Hãy điền email.",
                    email: "Hãy nhập đúng định dạng eamil.",
                },
                id_card: {
                    required: "Hãy điền số CMND.",
                    number: "Số CMND không có ký tự chữ.",
                },
                phone: {
                    required: "Hãy điền số điện thoại.",
                    number: "Số điện thoại không có ký tự chữ.",
                },
            }
        });
    })
    jQuery('#datetimepicker').datetimepicker({
        timepicker:false,
        format:'d/m/Y'
    });
</script>

<script type="text/javascript">

$('.avatar').uploadPreview({
    top: '20px',
    width: '200px',
    height: '200px',
    backgroundSize: 'cover',
    fontSize: '16px',
    borderRadius: '200px',
    border: '3px solid #dedede',
    lang: 'en', //language
});
</script>