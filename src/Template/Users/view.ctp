<?php $sex = $user->sex == 1 ? 'Nam' : 'Nữ'; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thông tin nhân viên</h4>
                        <p class="category"></p>
                    </div>
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
                                    Đăng xuất gần nhất lúc: <?= $this->Application->FullDateTime($user->last_login) ?>
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
                                    <tr>
                                        <td>Dự án đang tham gia:</td>
                                        <td><?php 
                                        foreach($project_of_users as $project_of_user) {
                                            echo "<a href='/tasks/listTaskOfProjectId/".$project_of_user->project['id']."'>".$project_of_user->project['name']."</a>, ";
                                        }
                                        ?></td>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách dự án đã tham gia</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                    <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
    <thead class="text-primary">
        <th class="text-center">Mã dự án</th>    
        <th class="text-center">Tên dự án</th>
        <th class="text-center">Ngày vào</th>
        <th class="text-center">Ngày dừng dự án</th>
        <th class="text-center">Đánh giá</th>
    </thead>
    <tbody>
        <?php foreach($all_project_of_users as $all_project_of_user) {
            $project_id = $all_project_of_user->project['id'];
            $sum_point_tasks = 0;
            $count =0;
            foreach ($all_tasks_of_users as $all_tasks_of_user) {
                if ($all_tasks_of_user['project_id'] == $project_id) {
                    foreach($all_rating_of_users as $all_rating_of_user ) {
                        if ($all_tasks_of_user->id == $all_rating_of_user->task_id) {
                            $sum_point_tasks += $all_rating_of_user->point;
                            $count++;
                        }
                    }
                }
            }
            // $result = round($sum_point_tasks/$count);
            ?>
            <tr title='Click vào để xem thông tin chi tiết của nhân viên'>
                <td><?= $all_project_of_user->project['id_name'] ?> </td>
                <td><?= $all_project_of_user->project['name'] ?> </td>
                <td><?= $this->Application->fullDate($all_project_of_user->create_at)  ?></td>
                <td>
                    <?php 
                        if($all_project_of_user->out_at != NULL) {
                            echo $this->Application->fullDate($all_project_of_user->out_at);
                        } else {
                            echo "Đang tham gia";
                        }
                    ?>
                </td>
                <td>
                    <?php

                    if($count != 0) echo $this->Application->ratingStar($project_id, $sum_point_tasks, $count) ?>
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

