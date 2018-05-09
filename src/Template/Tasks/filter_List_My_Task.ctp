

<?php if ($tasks->count() != '0') {?>
    <?php foreach($tasks as $task) {
        $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>";
        $done = $task->done == 1 ? "selected" : "";
        $deadline = new DateTime(date("H:s Y-m-d", strtotime(date("H:s Y-m-d", strtotime($task->deadline))))); 
        $now = new DateTime(date("H:s Y-m-d"));
        $style='';
        $diff=date_diff($now, $deadline);
        $diff = $diff->format("%R%a");
        if($diff < 0) {
            $style = 'background-color: #d9534f' ;
        } elseif($diff == 1 || $diff == 0) {
            $style = 'background-color: yellow';
        }
    ?>
        <tr style='<?= $style ?>'>
            <td><?= $task->id?></td>
            <td><?= $task->title?></td>
            <td><?= $task->deadline?></td>
            <td>
                <select name="status" class="status" id="status" data-task_id=<?= $task->id ?>>
                    <option <?php if ($task->status == 'Chưa làm') echo "selected"; ?> value='Chưa làm'>Chưa làm</option>
                    <option <?php if ($task->status == 'Đang làm') echo "selected"; ?> value='Đang làm'>Đang làm</option>
                    <option <?php if ($task->status == 'Kiểm tra') echo "selected"; ?> value='Kiểm tra'>Kiểm tra</option>
                </select>
            </td>
            <td><?= $task->priority ?></td>
            <td><a href="#" class="modal-view_task" data-task_id=<?= $task->id ?> title="Click vào để xem chi tiết task">Xem chi tết </td>
        </tr>
    <?php } ?>
<?php } else {?>
    <tr><td colspan="6"><p style="color:silver" align="center">Hiện tại chưa có nhiệm vụ nào</p></td></tr>
<?php }?>
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