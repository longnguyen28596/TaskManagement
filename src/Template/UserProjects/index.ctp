<?php
    $curent_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $project_id = substr(strrchr($curent_url,'/'),1);
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới nhân sự vào dự án <span style="font-size:25px"><?= $project['name'] ?></span></h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="team_id" class="form-control team_id">
                                        <?php foreach($teams as $team) { 
                                            $selected = $teams[0]->id == $team->id ? "selected" : "";
                                        ?>
                                            <option <?= $selected ?> value=<?= $team->id ?>><?= $team->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-content table-responsive ketqua">
                            <table class="table table-hover text-center">
                                <thead class="text-primary">
                                    <th class="text-center">Đang tham gia</th>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Tên nhân viên</th>
                                    <th class="text-center">Tên tài khoản</th>
                                    <th class="text-center">Chức vụ</th>
                                </thead>
                                <tbody>
                                    <?php if($userTeams->count() >= 1) {?>
                                        <?php foreach($userTeams as $userTeam) {
                                            $isLeader = $team->leader == $userTeam->id ? "(trưởng nhóm)" : "";
                                            $checked = '';
                                            foreach($userProjects as $userProject) {
                                                if($userProject->user->id == $userTeam->id) {
                                                    $checked = 'checked';
                                                    break;
                                                }
                                            }
                                        ?>
                                            <tr data-href='/Users/view/<?= $userTeam->id ?>' title='Click vào để xem chi tiết nhân viên này.'>
                                                <td><input value='<?= $userTeam->id ?>' id="checked_<?= $userTeam->id ?>" class='add_staff_to_project' name="add_staff_to_project[]" <?= $checked ?> type="checkbox"></td>
                                                <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->id?></td>
                                                <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->name.' '.$isLeader?></td>
                                                <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->username?></td>
                                                <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->position->name?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else {?>
                                        <tr><td colspan="7"><p style="color:silver" align="center">Hiện tại chưa có nhân viên nào trong team</p></td></tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.add_staff_to_project').change(function(){
        user_id = $(this).val()
        $.ajax({
            url: '/UserProjects/add/'+<?= $project_id ?>,
            type: 'POST',
            data: {
                user_id: user_id,
                status: $('#checked_'+user_id).is(':checked')
            }
        }).done(function(ketqua) {
        })
    })

    $('.team_id').change(function(){
        // user_id = $(this).val()
        $.ajax({
            url: '/UserProjects/ajaxGetUserProjectByTeam/'+<?= $project_id ?>,
            type: 'POST',
            data: {
                team_id: $(this).val(),
            }
        }).done(function(data) {
            $('.ketqua').children().remove()
            $('.ketqua').append(data)
        })
    })
</script>
<?= $this->element('modal_user_detail') ?>
