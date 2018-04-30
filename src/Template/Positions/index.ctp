<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các team trong công ty</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên chức vụ</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($positions as $position) {?>
                                    <tr>
                                        <td><?= $position->id?></td>
                                        <td><?= $position->name?></td>
                                        <td><a href="/Positions/listUsersByPosition/<?= $position->id ?>" title="Click vào để xem nhân viên theo chức vụ">Danh sách các thành viên có chức vụ này | <a href="/positions/edit/<?= $position->id ?>" title="Click vào để sửa">Sửa | <a href="/positions/delete/<?= $position->id ?>" title="Click vào để xoá" onclick="return confirm('Bạn có chắc muốn xoá tài khoản này')">Xoá</td>
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
