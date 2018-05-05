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
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên task</th>
                                <th class="text-center">Người thực hiện</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Mức độ ưu tiên</th>
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
                                                </select>
                                            </td>
                                            <td><?= $task->priority ?></td>
                                            <td><a href="#" class="modal-view_task" data-task_id=<?= $task->id ?> title="Click vào để xem chi tiết task">Xem chi tết  | <a href="/Tasks/edit/<?= $task->id ?>" title="Click vào để sửa task">Sửa | <a href="/Tasks/delete/<?= $task->id ?>" onclick="return confirm('Bạn có chắc muốn huỷ nhiệm vụ này ?')" title="Click vào để xoá task">Xoá</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else {?>
                                    <tr><td colspan="7"><p style="color:silver" align="center">Hiện tại chưa có nhiệm vụ nào</p></td></tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('custom/js_list_task_of_projects.js') ?>

<div id="modalInListTaskByMyProject" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Chi tiết nhiệm vụ</h4>
        </div>
        <hr>
        <div class="modal-body" id="conten-modal" style="padding-top: 0"></div>
        <hr>
        <div class="modal-footer">
            <button type="button" id="go_to_view_task" class="btn btn-primary" >Chuyển sang màn hình to</button>
            <button type="button" class="btn btn-primary btn-close-modal" >Close</button>
        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('.modal-view_task').click(function() {
            task_id = $(this).data('task_id')
            $('#modalInListTaskByMyProject').data('task-id', task_id)
            // xử lý khi xem chi tiết task ở màn hình riêng
            $('#go_to_view_task').click(function() {
                window.location.href = "/tasks/view/"+task_id;
            })
            $.ajax({
                url: '/Tasks/view/'+task_id,
                type: 'GET',
                data: {
                    hidecomment: '1',
                }
            }).done(function(data) {
                $('#modalInListTaskByMyProject').find('#conten-modal').html(data)
            })
            $("#modalInListTaskByMyProject").modal("show")
        })
    });
</script>