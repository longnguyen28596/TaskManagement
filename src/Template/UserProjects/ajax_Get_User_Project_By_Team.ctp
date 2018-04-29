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
                <?php if($userTeams->count() >= 1) {?>
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
                            <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->id?></td>
                            <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->name?></td>
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

<?= $this->element('modal_user_detail') ?>
