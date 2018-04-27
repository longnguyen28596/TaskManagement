<div class="card-content table-responsive">
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
                            <td><?= $userTeam->name?></td>
                            <td><?= $userTeam->username?></td>
                            <td><?= $userTeam->position->name?></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
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