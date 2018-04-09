<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Cập nhập lại mật khẩu(nếu muốn).</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/users/edit_Password_For_New_User" id="formChangePassword">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Nhập mật khẩu hiện tại</label>
                                        <input type="password" placeholder="Mật khẩu" id="current_password" name="current_password" class="form-control">
                                        <div id="noidung"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Nhập mật khẩu mới</label>
                                        <input type="password" placeholder="Mật khẩu" id="new_password" name="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Nhập lại mật khẩu mới</label>
                                        <input type="password" placeholder="Nhập lại mật khẩu mới" name="re_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <a href="/"><button class="btn btn-primary pull-right">Bỏ qua</button></a>
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
        var valcaator = $("#formChangePassword").validate({
            rules: {
                current_password: {
                    required: true,
                    },
                new_password: {
                    required: true,
                },
                re_password: {
                    required: true,
                    equalTo: "#new_password",
                },
            },
            messages: {
                current_password: {
                    required: "Hãy nhập mật khẩu hiện tại.",
                },
                new_password: {
                    required: "Hãy nhập mật khẩu mới.",
                },
                re_password: {
                    required: "Hãy nhập lại mật khẩu mới.",
                    equalTo: "Mật khẩu nhập lại không trùng với mật khẩu mới"
                },
            }
        });

        $('#current_password').keyup(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/users/edit_Password_For_New_User/',
                type: 'GET',
                data: {
                    ajax_current_password: $('#current_password').val()
                }
            }).done(function(ketqua) {
                $('#noidung').html(ketqua);
                document.getElementById('noidung').innerHTML = '<label id="error_current_password" style="font-style: italic;color: red;" for="current_password">Mật khẩu này không phải là mật khẩu hiện tại.</label>';
            });
        });
    })
</script>
