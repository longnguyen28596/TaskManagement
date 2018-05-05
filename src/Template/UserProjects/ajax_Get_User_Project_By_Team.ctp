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
        <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->name?></td>
        <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->username?></td>
        <td class="modal-user" data-user_id="<?= $userTeam->id ?>"><?= $userTeam->position->name?></td>
        <td>
            <div class="awesomeRating-<?= $userTeam->id ?>">

            </div>
        </td>
    </tr>
    <?php } ?>
<?php } else {?>
    <tr><td colspan="7"><p style="color:silver" align="center">Hiện tại chưa có nhân viên nào trong team</p></td></tr>
<?php }?>

<?= $this->element('modal_user_detail') ?>
