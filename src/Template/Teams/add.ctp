<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tạo mới một team.</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/teams/add" id="formAddNewTeam">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Tên của nhóm(Team)</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Chọn trưởng nhóm</label>
                                        <select name="leader" class="form-control">
                                            <option value="">Lựa chọn trưởng nhóm</option>
                                            <?php foreach($users as $user) { ?>
                                                <option value=<?= $user->id ?>><?= $user->user_profile->name.'('.$user->position->name.')'?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hãy thêm tiêu chí, mục tiêu cho nhóm của mình:</label>
                                        <div class="form-group label-floating">
                                            <textarea name="criteria" class="form-control" rows="5"></textarea>
                                        </div>
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
        var validator = $("#formAddNewTeam").validate({
            rules: {
                name: "required",
                leader: "required"
            },
            messages: {
                name: "Hãy điền tên của nhóm.",
                leader: "Hãy lựa chọn leader cho nhóm"
            }
        });
    })
</script>
