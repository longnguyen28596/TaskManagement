<?php
$status = $project->sex == 1 ? 'Dự án kết thúc' : 'Chưa hoàn thành';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Thông tin chi tiết dự án</h3>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive table-upgrade">
                            <br>
                            <table class="table">
                                <br>
                                <tbody>
                                    <tr>
                                    <td style="color:  black;font-weight: bolder;">Tên dự án:</td>
                                        <td><?= $project->name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:  black;font-weight: bolder;">Công ty thuê dự án:</td>
                                        <td><?= $project->company['company_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:  black;font-weight: bolder;">Trạng thái dự án:</td>
                                        <td><?= $status ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:  black;font-weight: bolder;">Ngày tạo dự án:</td>
                                        <td> <?=$this->Application->fullDateTime($project->create_at)?></td>
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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Mô tả về dự án</h3>
                    </div>
                    <div class="tim-typo">
                        <p><?= $project->description?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các nhân viên làm dự án</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên nhân viên</th>
                                <th class="text-center">Tên tài khoản</th>
                                <th class="text-center">Ngày vào dự án</th>
                                <th class="text-center">Ngày rời dự án</th>
                            </thead>
                            <tbody>
                                <?php foreach($userProjects as $userProject) {
                                    $user =$userProject->user;
                                    ?>
                                    <tr class="modal-user" data-user_id="<?= $user->id ?>" data-href='/Users/view/<?= $user->id ?>' title='Click vào để xem chi tiết nhân viên'>
                                        <td><?= $user->id?></td>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->username?></td>
                                        <td><?=$this->Application->fullDateTime($user->create_at)?></td>
                                        <td><?= $user->out_at?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float:right">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('modal_user_detail') ?>