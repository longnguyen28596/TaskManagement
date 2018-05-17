<?= $this->Html->css('stars')?>
<style type="text/css">
    .dark-area {
        background-color: #666;
        padding: 40px;
        margin: 0 -40px 20px -40px;
        clear: both;
    }
    .clearfix:before,.clearfix:after {content: " "; display: table;}
</style>
<?= $this->Html->css('circle.css') ?>
<?php
    $curent_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $project_id = substr(strrchr($curent_url,'/'),1);
?>
<div class="content">
    <div class="container-fluid">
        <div id="message">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách nhiệm vụ của dự án: "<?= $project['name'] ?>"</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <a target="_blank" href="/tasks/add/<?= $project_id ?>"><button type="button" class="btn btn-primary">Thêm mới nhiệm vụ</button></a>
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Tiến độ</th>
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên task</th>
                                <th class="text-center">Người thực hiện</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Mức độ ưu tiên</th>
                                <th class="text-center">Hoàn thành</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($tasks as $task) {
                                    $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>";
                                    $status = $task->status == '' ? "Chưa xử lý" : "Đang xử lý";
                                    if ($task->done == 0) {
                                        if ($task->request_check == '-1' && $task->status == '100') 
                                        $status = 'Kiểm tra';
                                        if (($task->request_check == '0' && $task->status == '100') || $task->request_check == '0') 
                                            $status = 'Yêu cầu làm lại';
                                    }
                                    // $done = $task->done == 1 ? "Đã xong" : "Chưa xong";
                                ?>
                                    <tr id="<?= $task->id?>">
                                        <td>
                                            <div class="c100 p<?= $task->status ?> small green">
                                                <span><?= $task->status ?>%</span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $task->id?></td>
                                        <td style="text-align: left"><?= $task->title?></td>
                                        <td><?= $task->user->username?></td>
                                        <td><?= $status ?></td>
                                        <td><?= $task->priority ?></td>
                                        <td>
                                            <?php  $done = $task->done == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành</p>";?><?= $done?>
                                        </td>
                                        <td><a href="#" class="modal-view_task" data-task_id=<?= $task->id ?> title="Click vào để xem chi tiết task">Chi tết | <a href="/Tasks/edit/<?= $task->id ?>" title="Click vào để sửa task">Sửa | <a href="/Tasks/delete/<?= $task->id ?>" onclick="return confirm('Bạn có chắc muốn huỷ nhiệm vụ này ?')" title="Click vào để xoá task">Xoá</td>
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
<?= $this->Html->script('custom/js_list_task_of_projects.js') ?>

<div id="modalInListTaskOfProjectId" class="modal fade" tabindex="-1" role="dialog">
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
            $('#modalInListTaskOfProjectId').data('task-id', task_id)
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
                $('#modalInListTaskOfProjectId').find('#conten-modal').html(data)
            })
            $("#modalInListTaskOfProjectId").modal("show")
        })
    });
</script>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Đánh giá nhân viên làm task này</h4>
            </div>
            <hr>
            <div class="modal-body" id="conten-modal" style="padding-top: 0">
                <div class="stars">
                    <input class="star star-5" data-point="5" id="star-5" type="radio" name="star"/>
                    <label class="star star-5 label-star" data-point="5" for="star-5"></label>
                    <input class="star star-4" data-point="4" id="star-4" type="radio" name="star"/>
                    <label class="star star-4 label-star" data-point="4" for="star-4"></label>
                    <input class="star star-3" data-point="3" id="star-3" type="radio" name="star"/>
                    <label class="star star-3 label-star" data-point="3" for="star-3"></label>
                    <input class="star star-2" data-point="2" id="star-2" type="radio" name="star"/>
                    <label class="star star-2 label-star" data-point="2" for="star-2"></label>
                    <input class="star star-1" data-point="1" id="star-1" type="radio" name="star"/>
                    <label class="star star-1 label-star" data-point="1" for="star-1"></label>
                </div>
            </div>
            <hr>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close-modal" >Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script("custom/js-stars-rating.js") ?>
