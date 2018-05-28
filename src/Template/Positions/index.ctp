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
                    <?php if($position_id == 1 || $position_id == 2) { ?>
                        <a href="/positions/add"><button type="button" class="btn btn-primary">Thêm mới chức vụ</button></a>
                    <?php }?>
                        <table class="table table-striped table-bordered data-table-list table-responsive table-hover text-center">
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
                                        <td>
                                            <a href="/Positions/listUsersByPosition/<?= $position->id ?>" title="Click vào để xem nhân viên theo chức vụ">
                                                <button type="button" rel="tooltip" title="Danh sách nhân viên theo chức vụ" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">streetview</i>
                                                </button>    
                                            </a>
                                            <a href="/positions/edit/<?= $position->id ?>" title="Click vào để sửa">
                                                <button type="button" rel="tooltip" title="Cập nhật" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </a>
                                            <a href="/positions/delete/<?= $position->id ?>" title="Click vào để xoá" onclick="return confirm('Bạn có chắc muốn xoá tài khoản này')">
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </a>
                                        </td>
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
