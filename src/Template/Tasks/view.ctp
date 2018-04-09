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
                                    <div class="card-avatar" style="max-width: 45px;max-height: 45px;">
                                        <a href="#pablo">
                                            <img class="img" src="/webroot/img/avatar/<?= $user_request->avatar ?>" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-offset-1">
                            </div>
                            <div class="col-md-4">
                                <p>Người tạo: <?= $user_request->name ?></p>
                                <p>Ngày tạo: <?= $task->create_at ?></p>
                            </div>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Tên nhiệm vụ</h4>
                            <div style="border: 0.05rem solid #8e24aa; margin-bottom: 10px"></div>
                            <?= $task->title?>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Chi tiết nhiệm vụ</h4>
                            <div style="border: 0.05rem solid #8e24aa; margin-bottom: 10px"></div>
                            <?= $task->description?>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">File đính kèm</h4>
                            <div style="border: 0.05rem solid #8e24aa; margin-bottom: 10px"></div>
                        </div>
                        <div>
                            <h4 style="color: black;font-weight: 400;">Thông tin khác</h4>
                            <div style="border: 0.05rem solid #8e24aa; margin-bottom: 10px"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="border-top: 1px solid #ddd;">Độ ưu tiên</td>
                                                    <td style="border-top: 1px solid #ddd;"><?= $task->Priorities['note'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Deadline</td>
                                                    <td><?= $task->deadline ?></td>
                                                </tr>
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
                                                    <td style="border-top: 1px solid #ddd;"><?= $user_action->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tình trạng công việc</td>
                                                    <td><?php $status = $task->status == '1' ? "<p class='text-success'> Đã hoàn thành<p>" : "<p class='text-danger'> Chưa hoàn thành<p>"; echo $status ?></td>
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
        </div>
    </div>
</div>
