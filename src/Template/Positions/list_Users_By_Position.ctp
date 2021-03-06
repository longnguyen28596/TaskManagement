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
                        <table class="table table-striped table-bordered data-table-list table-responsive table-hover text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên nhân viên</th>
                                <th class="text-center">Tên tài khoản</th>
                                <th class="text-center">Chức vụ</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                    <tr class="modal-user" data-user_id="<?= $user->id ?>">
                                        <td><a title="click vào để xem chi tiết thông tin nhân viên"><?= $user->id?></a></td>
                                        <td><a title="click vào để xem chi tiết thông tin nhân viên"><?= $user->name?></a></td>
                                        <td><a title="click vào để xem chi tiết thông tin nhân viên"><?= $user->username?></a></td>
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
<?= $this->element('modal_user_detail') ?>