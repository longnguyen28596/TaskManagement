<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các nhân viên</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>Id</th>
                                <th>Tên nhân viên</th>
                                <th>Tên tài khoản</th>
                                <th>Chức vụ</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                    <tr title='Click vào để xem thông tin chi tiết của nhân viên'>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" ><?= $user->id ?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" ><?= $user->name ?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" ><?= $user->username ?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" ><?= $user->position['name'] ?></td>
                                        <td ><a href="/Users/delete/<?= $user->id ?>" onclick="return confirm('Bạn có chắc muốn xoá nhân viên này?')" title="Xoá nhân viên ra khỏi công ty" > Xoá</a></td>
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