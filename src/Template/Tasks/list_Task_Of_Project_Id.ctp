<div class="content">
    <div class="container-fluid">
        <div id="message">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách nhiệm vụ</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên task</th>
                                <th class="text-center">Người làm</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Mức độ ưu tiên</th>
                                <th class="text-center">Xong/Chưa xong</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php if($tasks->count() >=1 ) { ?>
                                    <?php foreach($tasks as $task) {
                                        $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>";
                                        $done = $task->done == 1 ? "selected" : "";
                                    ?>
                                        <tr>
                                            <td><?= $task->id?></td>
                                            <td><?= $task->title?></td>
                                            <td><?= $task->user->username?></td>
                                            <td>
                                                <select name="status" class="status" id="status" data-task_id=<?= $task->id ?>>
                                                    <option <?php if ($task->status == 'Chưa làm') echo "selected"; ?> value='Chưa làm'>Chưa làm</option>
                                                    <option <?php if ($task->status == 'Đang làm') echo "selected"; ?> value='Đang làm'>Đang làm</option>
                                                    <option <?php if ($task->status == 'Kiểm tra') echo "selected"; ?> value='Kiểm tra'>Kiểm tra</option>
                                                    <option <?php if ($task->status == 'Đã xong') echo "selected"; ?> value='Đã xong'>Đã xong</option>
                                                </select>
                                            </td>
                                            <td><?= $task->priority ?></td>
                                            <td>
                                            <select name="done" class="done" id="done" data-task_id=<?= $task->id ?>>
                                                <option value='0'>Chưa hoàn thành</option>
                                                <option <?= $done ?> value='1'>Hoàn thành</option>
                                            </select>
                                            </td>
                                            <td><a href="/Tasks/view/<?= $task->id ?>" title="Click vào để xem chi tiết task">Xem chi tết | <a href="/Tasks/edit/<?= $task->id ?>" title="Click vào để sửa task">Sửa | <a href="/Tasks/delete/<?= $task->id ?>" onclick="return confirm('Bạn có chắc muốn huỷ nhiệm vụ này ?')" title="Click vào để xoá task">Xoá</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else {?>
                                    Hiện tại chưa có nhiệm vụ nào
                                <?php }?>

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
<?= $this->Html->script('custom/js_list_task_of_projects.js') ?>
