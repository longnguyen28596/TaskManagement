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
                        <table class="table table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên nhân viên</th>
                                <th class="text-center">Tên tài khoản</th>
                                <th class="text-center">Chức vụ</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) {
                                    $isLeader = $team->leader == $user->id ? "(trưởng nhóm)" : ""
                                ?>
                                    <tr class="modal-user" data-user_id="<?= $user->id ?>" title="Click vào để xem chi tiết nhân viên này.">
                                        <td><?= $user->id?></td>
                                        <td><?= $user->name.' '.$isLeader?></td>
                                        <td><?= $user->username?></td>
                                        <td><?= $user->position->name?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('modal_user_detail') ?>