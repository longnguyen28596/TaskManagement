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
                        <h4 class="title">Danh sách các nhân viên của team: <?= $team->name ?> </h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <form method="post" action="/UserProjects/add/<?= $project_id ?>">
                            <table class="table table-hover text-center">
                                <thead class="text-primary">
                                    <th class="text-center">Đang tham gia</th>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Tên nhân viên</th>
                                    <th class="text-center">Tên tài khoản</th>
                                    <th class="text-center">Chức vụ</th>
                                </thead>
                                <tbody>
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
                                                <td><?= $userTeam->id?></td>
                                                <td><?= $userTeam->name.' '.$isLeader?></td>
                                                <td><?= $userTeam->username?></td>
                                                <td><?= $userTeam->position->name?></td>
                                            </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary pull-right">Cập nhập</button>
                        </form>
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
</script>