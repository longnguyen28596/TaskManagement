<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách nhiệm vụ</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Id</th>
                                <th>Tên task</th>
                                <th>Người làm</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($tasks as $task) { 
                                $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>"
                                ?>
                                    <tr>
                                        <td><?= $task->id?></td>
                                        <td><?= $task->title?></td>
                                        <td><?= $task->user->username?></td>
                                        <td><?= $status?></td>
                                        <td><a href="/Tasks/view/<?= $task->id ?>" title="Click vào để xem chi tiết task">Xem chi tết | <a href="/Tasks/edit/<?= $task->id ?>" title="Click vào để sửa task">Sửa</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float:right">
                            <?= $this->Paginator->numbers();?> <p>Tổng số bản ghi:<?= $total_record ?><p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
