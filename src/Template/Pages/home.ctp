<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;


if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!-- css cho vòng tròn -->
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

<!-- cdn cho thanh phần trăm -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"></script>

    <div class="col-lg-12 col-md-12">
        <div class="card card-nav-tabs">
            <div class="card-header" data-background-color="purple">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active">
                                <a href="#tab1" data-toggle="tab">
                                    <i class="material-icons">info</i> Thông tin cá nhân
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="">
                                <a href="#tab2" data-toggle="tab">
                                    <i class="material-icons">code</i> Nhiệm vụ đã giao
                                </a>
                            </li>
                            <li class="">
                                <a href="#tab3" data-toggle="tab">
                                    <i class="material-icons">cloud</i> Nhiệm vụ chưa hoàn thành
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                    <?php $sex = $user->sex == 1 ? 'Nam' : 'Nữ'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="table-responsive table-upgrade">
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-profile">
                                        <div class="card-avatar">
                                            <a href="#">
                                                <img class="img" src="<?= $user->avatar ?>" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="title">Thông tin đăng nhập</h3>
                                    Tên tài khoản: <?= $user->username?><br>
                                </div>
                            </div>
                            <table class="table">
                                <br>
                                <tbody>
                                    <tr>
                                        <td>Họ và tên:</td>
                                        <td><?= $user->name ?></td>
                                    </tr>
                                    <tr>
                                        <td>Đánh giá:</td>
                                        <td>
                                        <?php if($user->ratings != array()) { ?>
                                                <?= $this->Application->ratingStar($user->id, $user->ratings['0']->sum_point, $user->ratings['0']->count_ratings)?>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày tháng năm sinh:</td>
                                        <td><?=$this->Application->fullDate($user->birthday)?></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?= $user->email ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số CMND:</td>
                                        <td><?= $user->id_card ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td><?= $user->phone ?></td>
                                    </tr>
                                    <tr>
                                        <td>Giới tính:</td>
                                        <td><?=  $sex; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ thường trú:</td>
                                        <td><?= $user->address ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    </div>
                    <div class="tab-pane" id="tab2">
                    <select data-from_tab=tab2 name="project_id" class="form-control project_id" id="project_id" >
                        <option value="">Xem tất cả nhiệm vụ</option>
                        <?php foreach($myProjects as $myProject) { 
                            echo '<option value="'.$myProject->project->id.'">'.$myProject->project->name.'</option>';
                        }?>
                    </select>
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Tiến độ</th>
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên task</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Mức độ ưu tiên</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody class="ketqua">
                                <?php if($listTasksRequest->count() >= 1 ) { ?>
                                    <?php foreach($listTasksRequest as $task) {
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
                                        $status = $task->status == '' ? "Chưa xử lý" : "Đang xử lý";
                                        if ($task->request_check == '-1' && $task->status == '100') 
                                            $status = 'Kiểm tra';
                                        if (($task->request_check == '0' && $task->status == '100') || $task->request_check == '0') 
                                            $status = 'Yêu cầu làm lại';
                                        $done = $task->done == 1 ? "selected" : "";
                                    ?>
                                        <tr style='<?= $style ?>'>
                                            <td>
                                                <div class="c100 p<?= $task->status ?> small green">
                                                    <span><?php if($task->status != "") echo $task->status.'%';  ?></span>
                                                    <div class="slice">
                                                        <div class="bar"></div>
                                                        <div class="fill"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $task->id?></td>
                                            <td><?= $task->title?></td>
                                            <td><?=$this->Application->fullDateTime($task->deadline)?></td>
                                            <td><?= $status ?></td>
                                            <td><?= $task->priority ?></td>
                                            <td>
                                                <a href="#" class="modal-view_task" data-task_id=<?= $task->id ?> title="Click vào để chi tiết task">
                                                    <button type="button" rel="tooltip" title="Click vào để chi tiết task" class="btn btn-primary btn-simple btn-xs">
                                                        <i style="font-size: 20px; <?= $style ?>" class="material-icons">streetview</i>
                                                    </button>
                                                </a>
                                                
                                                <!-- <a title="Click vào để chi tiết task"> | -->
                                                <a href="#" class="modal-change_status" data-task_id=<?= $task->id ?> data-user_id=<?= $task->user_action ?> data-from_tab=tab3 >
                                                    <button type="button" rel="tooltip" title="Cập nhật" class="btn btn-primary btn-simple btn-xs">
                                                        <i style="font-size: 20px; <?= $style ?>" class="glyphicon glyphicon-check"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else {?>
                                    <tr><td colspan="7"><p style="color:silver" align="center">Hiện tại chưa có nhiệm vụ nào</p></td></tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab3">
                    <select data-from_tab=tab3 name="project_id" class="form-control project_id" id="project_id" >
                        <option value="">Xem tất cả nhiệm vụ</option>
                        <?php foreach($myProjects as $myProject) { 
                            echo '<option value="'.$myProject->project->id.'">'.$myProject->project->name.'</option>';
                        }?>
                    </select>
                    <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Tiến độ</th>
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên task</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Mức độ ưu tiên</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody class="ketqua">
                                <?php if($myTasks->count() >=1 ) { ?>
                                    <?php foreach($myTasks as $task) {
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
                                        $status = $task->status == '' ? "Chưa xử lý" : "Đang xử lý";
                                        if ($task->request_check == '-1' && $task->status == '100') 
                                            $status = 'Kiểm tra';
                                        if (($task->request_check == '0' && $task->status == '100') || $task->request_check == '0') 
                                            $status = 'Yêu cầu làm lại';
                                        $done = $task->done == 1 ? "selected" : "";
                                    ?>
                                        <tr style='<?= $style ?>'>
                                            <td>
                                                <div class="c100 p<?= $task->status ?> small green">
                                                    <span><?php if($task->status != null) echo $task->status."%" ?></span>
                                                    <div class="slice">
                                                        <div class="bar"></div>
                                                        <div class="fill"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $task->id?></td>
                                            <td><?= $task->title?></td>
                                            <td><?=$this->Application->fullDateTime($task->deadline)?></td>
                                            <td><?= $status ?></td>
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
<?= $this->Html->script('custom/js_list_task_of_projects.js') ?>

<div id="modalInHome" class="modal fade" tabindex="-1" role="dialog">
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

<div id="modalUpdateStatusTasks" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
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
<script>
    $(document).ready( function () {
        $("#myModal").modal("hide")
        $('.modal-view_task').click(function() {
            task_id = $(this).data('task_id')
            $('#modalInHome').data('task-id', task_id)
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
                $('#modalInHome').find('#conten-modal').html(data)
            })
            $("#modalInHome").modal("show")
        })

        $('.modal-change_status').click(function() {
            task_id = $(this).data('task_id')
            from_tab = $(this).data('from_tab')
            user_id = $(this).data('user_id')
            $.ajax({
                url: '/Tasks/changeStatus/'+task_id,
            }).done(function(data) {
                $('#modalUpdateStatusTasks').find('#conten-modal').html(data)
                $('#modalUpdateStatusTasks').data('from_tab', from_tab)
                $('#myModal').data('user_id', user_id)
                $('#myModal').data('task_id', task_id)
            });
            $("#modalUpdateStatusTasks").modal("show")
        })

        $('.project_id').change(function() {
            from_tab = $(this).data('from_tab')
            $.ajax({
                url: '/Tasks/filterListMyTask/',
                type: 'POST',
                data: {
                    from_tab: from_tab,
                    project_id: +$(this).val(),
                }
            }).done(function(data) {
                $('#'+from_tab).find('.ketqua').html(data)
            })
        });
    });
</script>
