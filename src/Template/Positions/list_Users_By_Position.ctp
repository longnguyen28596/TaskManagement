<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các nhân viên theo chức vụ</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>Id</th>
                                <th>Tên nhân viên</th>
                                <th>Tên tài khoản</th>
                                <th>Chức vụ</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                    <tr>
                                        <td><a href="/UserProfiles/detailUser?user_id=<?= $user->id ?>" title="click vào để xem chi tiết thông tin nhân viên"><?= $user->id?></a></td>
                                        <td><a href="/UserProfiles/detailUser?user_id=<?= $user->id ?>" title="click vào để xem chi tiết thông tin nhân viên"><?= isset($user->user_profile) ? $user->user_profile->name : " "?></a></td>
                                        <td><a href="/UserProfiles/detailUser?user_id=<?= $user->id ?>" title="click vào để xem chi tiết thông tin nhân viên"><?= $user->username?></a></td>
                                        <td><?= $user->position['name']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float:right">
                            <?= $this->Paginator->numbers();?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
