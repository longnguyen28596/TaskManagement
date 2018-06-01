<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Chi tiết nhiệm vụ</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card-profile">
                                    <br>
                                    <div class="card-avatar" style="max-width: 60px;max-height: 60px;">
                                        <a href="#pablo">
                                            <img class="img" src="<?= $user_request->avatar ?>" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4" style=" top: 10px;">
                                <p>Người tạo: <?= $user_request->name ?></p>
                                <p>Ngày tạo: <?= $this->Application->fullDateTime($task->create_at) ?></p>
                            </div>
                            <div class="col-md-4" style=" top: 10px;">
                            <div class="col-md-12">
                                <p>Mã nhiệm vụ: <?= $task->id?></p>
                            </div>
                            <div class="col-md-12">
                                <p>Tiến độ: <?= $task->progress."%"?></p>
                            </div>
                            </div>
                        </div>
                        <br><br>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Tên nhiệm vụ</h4>
                            <div class="border-botom-purple"></div>
                            <div class="row">
                                <div class='col-md-9'>
                                    <input style="width: 100%;border:none;" type="text" readonly id="title_task" value="<?= $task->title?>">
                                </div>
                                <div class='col-md-3'>
                                    <i style='font-size:20px' title='Click vào đây để copy tên task' class="far fa-copy fa-10px p-circle-icon js-btn-copy"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Chi tiết nhiệm vụ</h4>
                            <div class="border-botom-purple"></div>
                            <?= $task->description?>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">File đính kèm</h4>
                            <div class="border-botom-purple"></div>
                            <?php 
                                if ($task->images == Null) {
                                    echo "<p>Nhiệm vụ này không có file đính kèm.</p>";
                                } else {
                                    foreach($task->images as $image){ ?>
                                        <a class="show_image_hover" data-url_image='<?= "/webroot/img/admin/tasks/$task->id/".$image->file_name.'.'.$image->file_extension ?>' href="<?= "/webroot/img/admin/tasks/$task->id/".$image->file_name.'.'.$image->file_extension ?>" download><?= $image->default_name ?></a><br>
                                    <?php }?>
                            <?php }?>
                            <div id="preview" style="float:right; background-color: #d6d5e0; width: 350px; height: 250px; display: none; position: fixed; top: 30%; left: 40%;"></div>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Thông tin khác</h4>
                            <div class="border-botom-purple"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="border-top: 1px solid #ddd;">Độ ưu tiên</td>
                                                    <td style="border-top: 1px solid #ddd;"><?= $task->priority ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày phải bắt đầu</td>
                                                    <td><?= $this->Application->fullDateTime($task->daystart) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Deadline</td>
                                                    <td><?= $this->Application->fullDateTime($task->deadline) ?></td>
                                                </tr>
                                                <?php
                                                if($task->status == 'Đã xong') { ?>
                                                    <tr>
                                                        <td>Ngày hoàn thành</td>
                                                        <td><?= $this->Application->fullDateTime($task->daydone) ?></td>
                                                    </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="border-top: 1px solid #ddd;">Nhân viên thực hiện</td>
                                                    <td style="border-top: 1px solid #ddd;"><?= $user_action->username ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Trạng thái công việc</td>
                                                    <td><?php  $done = $task->status == "Đã xong" ? "<span class='text-success'> Đã hoàn thành<span>" : "<span class='text-danger'> Chưa hoàn thành</span>";?><?= $done?></td>
                                                </tr>
                                                <?php if ($task->status == "Đã xong"){ ?>  
                                                    <tr>
                                                        <td>Đánh giá công việc</td>
                                                        <td>
                                                            <?php 
                                                        $deadline = new DateTime(date("H:s Y-m-d", strtotime(date("H:s Y-m-d", strtotime($task->deadline))))); 
                                                                $daydone = new DateTime(date("H:s Y-m-d", strtotime(date("H:s Y-m-d", strtotime($task->daydone))))); 
                                                                $note = ($daydone > $deadline) ? "<span class=' text-danger'>(Hoàn thành quá hạn)</span>"  : "<span class='text-success'>Hoàn thành đúng hạn</span>";
                                                            ?>
                                                            <span style="left: 25px;position: relative;">
                                                                <?= $this->Application->ratingStar($task->user_request, $point['point'], 1)?>
                                                            </span>                                                            
                                                            <span><?= $note?></span>
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
            </div>
        </div>
    </div>
</div>
<?php if($hidecomment != 1) { ?>
    <div class="content comment">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <h4 style="color: black;font-weight: 400;">Bình luận</h4>
                            <div class="border-botom-purple"></div>
                                <form action="/Comments/add/<?= $task->id ?>" method="post" id="formCommentsAdd">
                                    <div class='row'>
                                        <div class='col-sm-1 col-md-1 '>
                                            <div class="card-avatar" style="max-width: 100%;max-height: 100%;">
                                                <a target="_blank" href="/Users/view/<?= $_SESSION['current_user']['id'] ?>">
                                                    <img class="img" src="<?= $_SESSION['current_user']['avatar'] ?>"/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class='col-sm-11 col-md-11'>
                                            <textarea id="content_comment" name="content_comment" class="ckeditor" ></textarea>
                                            <button data-task_id = <?= $task->id?> type="submit" id="submit_comment" class="btn btn-primary pull-right">Bình luận</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="area_comment">
                                    <?php foreach ($comments as $comment) {
                                        $roles_edit_comment = 0;
                                        if ($comment->parent == 0) {
                                            if ($current_user_id == $comment->user_id) $roles_edit_comment = 1;
                                    ?>
                                        <div  class="<?= $comment->id?> border-botom-gray"></div>
                                        <div class="row" id=<?= $comment->id?>>
                                            <div class='col-sm-1 col-md-1 '>
                                                <a target="_blank" href="/Users/view/<?= $comment->user->id ?>">
                                                    <img class="img" src="<?= $comment->user->avatar ?>"/>
                                                </a>
                                            </div>
                                            <div class='col-sm-11 col-md-11'>
                                                <p>
                                                    <a target="_blank" href="/Users/view/<?= $comment->user->id ?>">
                                                    <?= $comment->user->username?>
                                                    </a><span style="color: silver; font-size: 13px; font-style: italic">đã bình luận lúc <?= $this->Application->fullDateTime($comment->created) ?></span> 
                                                </p>
                                                <div class="c-text-comment"><?= $comment->content ?></div>
                                                    <p>
                                                        <a onclick="handle_reply(this)" href="#" data-task_id = <?= $task->id?> data-comment_id = <?= $comment->id ?> >Trả lời</a> 
                                                        <?php if ($roles_edit_comment == 1) { ?> |  
                                                            <a href="#" onclick="handle_edit(this)" href="#" data-task_id = <?= $task->id?> data-content_comment= '<?= $comment->content ?>' data-comment_id = <?= $comment->id ?> data-comment_parent_id = <?= $comment->id ?> >Sửa</a> |
                                                            <a href="#" data-comment_id = "<?= $comment->id ?>" onclick="delete_comment(this)">Xoá</a>
                                                        <?php } ?>
                                                    </p>
                                                <div class="reply_comment"></div>
                                                <?php foreach ($comment_childs as $comment_child) {
                                                    if ($comment->id == $comment_child->parent) {
                                                ?>
                                                    <div class="row" id="<?= $comment_child->id ?>">
                                                        <div class="border-botom-gray"></div>
                                                        <div class='col-sm-1 col-md-1 '>
                                                            <a target="_blank" href="/Users/view/<?= $comment_child->user->id ?>">
                                                                <img class="img" src="<?= $comment_child->user->avatar ?>"/>
                                                            </a>
                                                        </div>
                                                        <div class='col-sm-11 col-md-11'>
                                                            <p>
                                                                <a target="_blank" href="/Users/view/<?= $comment_child->user->id ?>">
                                                                <?= $comment_child->user->username?>
                                                                </a><span class="c-text-style-datetime">đã bình luận lúc <?= $this->Application->fullDateTime($comment_child->created) ?></span> 
                                                            </p>
                                                            <div class="c-text-comment"><?= $comment_child->content ?></div>
                                                            <p> <a href="#" onclick="handle_edit(this)" data-is_parent="0"  href="#" data-content_comment= '<?= $comment_child->content ?>' data-comment_child_id = <?= $comment_child->id ?> data-comment_parent_id = <?= $comment->id ?> data-is_parent="1" >Sửa</a> | <a href="#" data-comment_id = "<?= $comment_child->id ?>" onclick="delete_comment(this)">Xoá</a></p>
                                                            <div class="comment_child"></div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->Html->script('custom/js-task-view.js') ?>
  
