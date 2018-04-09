<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới thông tin đăng nhập</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/users/add" id="formAddNewUser">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tên đăng nhập:</label>
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Chọn team(nếu đã được điều phân bổ)</label>
                                        <select name="team_id" class="form-control">
                                            <option value="">Lựa chọn team</option>
                                            <option value="0">Chưa thuộc team nào</option>
                                            <?php foreach($teams as $team) { ?>
                                                <option value=<?= $team->id ?>><?= $team->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Chức vụ</label>
                                        <select name="position_id" class="form-control">
                                            <option value="">Lựa chọn chức vụ</option>
                                            <?php foreach($positions as $position) { ?>
                                                <option value=<?= $position->id ?>><?= $position->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="text-info" style="font-style: italic;">note(*) mật khẩu mặc định là 12345678, hãy thông báo nhân viên.</p>
                            <button type="submit" class="btn btn-primary pull-right">Tạo mới</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var validator = $("#formAddNewUser").validate({
            rules: {
                username: "required",
                team_id: "required",
                position_id: "required"
            },
            messages: {
                username: "Hãy điền username.",
                team_id: "Hãy lựa chọn team cho nhân viên",
                position_id: "Hãy lựa chọn chức vụ cho nhân viên."
            }
        });
    })
</script>
