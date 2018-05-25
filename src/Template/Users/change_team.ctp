<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thay đổi nhân sự phòng ban</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" id="formchangeTeam">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Chọn team(nếu đã được điều phân bổ)</label>
                                        <select name="team_id" class="form-control team">
                                            <option value="">Lựa chọn team</option>
                                            <option value="0">Chưa thuộc team nào</option>
                                            <?php foreach($teams as $team) { 
                                                $selected = ($user['team_id'] == $team->id) ? "selected" : "";
                                            ?>
                                                <option <?= $selected ?> value=<?= $team->id ?>><?= $team->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Chọn chức vụ</label>
                                        <select name="position_id" class="form-control team">
                                            <option value="">Lựa chọn chức vụ</option>
                                            <?php foreach($positions as $position) { 
                                                $selected1 = ($user['position_id'] == $position->id) ? "selected" : "";
                                            ?>
                                                <option <?= $selected1 ?> value=<?= $position->id ?>><?= $position->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Element('custom_select2'); ?>
<script>
    $('#formchangeTeam').submit(function(event) {
        user_id = $("#modalChangeTeam").data('user_id')
        $.ajax({
            url: '/Users/changeTeam/'+user_id,
            type: 'post',
            data: $("#formchangeTeam").serialize(),
        })
        $("#modalChangeTeam").modal("hide")
        // event.preventDefault();
    })

</script>