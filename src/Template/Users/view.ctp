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
