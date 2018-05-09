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

    <div class="col-lg-12 col-md-12">
        <div class="card card-nav-tabs">
            <div class="card-header" data-background-color="purple">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tasks:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active">
                                <a href="#profile" data-toggle="tab">
                                    <i class="material-icons">bug_report</i> Tổng thể
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="">
                                <a href="#messages" data-toggle="tab">
                                    <i class="material-icons">code</i> Nhiệm vụ đã giao
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab">
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
                    <div class="tab-pane active" id="profile">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes" checked>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                            </label>
                                        </div>
                                    </td>
                                    <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                            </label>
                                        </div>
                                    </td>
                                    <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes" checked>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="messages">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes" checked>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                            </label>
                                        </div>
                                    </td>
                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="settings">
                    <select name="project_id" class="form-control project_id" id="project_id" >
                        <option>Xem tất cả nhiệm vụ</option>
                        <?php foreach($myProjects as $myProject) { 
                            echo '<option value="'.$myProject->project->id.'">'.$myProject->project->name.'</option>';
                        }?>
                    </select>
                    <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
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
                                            $style = 'background-color: #d9534f' ;
                                        } elseif($diff == 1 || $diff == 0) {
                                            $style = 'background-color: yellow';
                                        }
                                        $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>";
                                        $done = $task->done == 1 ? "selected" : "";
                                    ?>
                                        <tr style='<?= $style ?>'>
                                            <td><?= $task->id?></td>
                                            <td><?= $task->title?></td>
                                            <td><?=$this->Application->fullDateTime($task->deadline)?></td>
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

<script>
    $(document).ready( function () {
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

        $('#project_id').change(function(){
            $.ajax({
                url: '/Tasks/filterListMyTask/'+$(this).val(),
            }).done(function(data) {
                $('.ketqua').html(data)
            })
        });
    });
</script>