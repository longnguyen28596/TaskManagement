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
            $style = 'background-color: #f2dede; color: #a94442';
        } elseif($diff == 1 || $diff == 0) {
            $style = 'background-color: #fcf8e3; color: #8a6d3b';
        }
    ?>
        <tr style='<?= $style ?>'>
            <td>
                <div class="c100 p<?= $task->progress ?> small green">
                    <span><?= $task->progress ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </td>
            <td><?= $task->id?></td>
            <td><?= $task->title?></td>
            <td><?=$this->Application->fullDateTime($task->daystart)?></td>
            <td><?=$this->Application->fullDateTime($task->deadline)?></td>
            <td><?= $task->status?></td>
            <td><?= $task->priority ?></td>
            <td>
                <a href="#" class="modal-view_task" data-task_id=<?= $task->id ?> title="Click vào để chi tiết task">
                    <button type="button" rel="tooltip" title="Click vào để chi tiết task" class="btn btn-primary btn-simple btn-xs">
                        <i style="font-size: 20px; <?= $style ?>" class="material-icons">streetview</i>
                    </button>
                </a>
                
                <a href="#" class="modal-change_status" data-task_id=<?= $task->id ?> data-user_id=<?= $task->user_action ?> data-from_tab=tab3 >
                    <button type="button" rel="tooltip" title="Cập nhật" class="btn btn-primary btn-simple btn-xs">
                        <i style="font-size: 20px; <?= $style ?>" class="glyphicon glyphicon-check"></i>
                    </button>
                </a>
            </td>
        </tr>
    <?php } ?>
<?php }?>
<?= $this->Html->script('custom/js_list_task_of_projects.js') ?>

<div id="modalUpdateStatusTasks" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cập nhật trạng thái</h4>
        </div>
        <hr>
        <div class="modal-body" id="conten-modal" style="padding-top: 0">

        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('.modal-view_task').click(function() {
            task_id = $(this).data('task_id')
            $('#modalUpdateStatusTasks').data('task-id', task_id)
            $.ajax({
                url: '/Tasks/view/'+task_id,
                type: 'GET',
                data: {
                    hidecomment: '1',
                }
            }).done(function(data) {
                $('#modalUpdateStatusTasks').find('#conten-modal').html(data)
            })
            $("#modalUpdateStatusTasks").modal("show")
            $("#modalUpdateStatusTasks").find("modal-title").remove()
            $('#modalUpdateStatusTasks').find(".modal-dialog").addClass("modal-lg");
            $('#modalUpdateStatusTasks').find(".modal-dialog").removeClass("modal-md");
            $('#modalUpdateStatusTasks').find(".modal-title").text("Thông tin chi tiết nhiệm vụ")
        })

        $('.modal-change_status').click(function() {
            task_id = $(this).data('task_id')
            $.ajax({
                url: '/Tasks/changeStatus/'+task_id,
            }).done(function(data) {
                $('#modalUpdateStatusTasks').find('#conten-modal').html(data)
            })
            $("#modalUpdateStatusTasks").modal("show")
            $('#modalUpdateStatusTasks').find(".modal-dialog").removeClass("modal-lg");
            $('#modalUpdateStatusTasks').find(".modal-dialog").addClass("modal-md");
            $('#modalUpdateStatusTasks').find(".modal-title").text("Cập nhật trạng thái");
        })
    });
</script>    
