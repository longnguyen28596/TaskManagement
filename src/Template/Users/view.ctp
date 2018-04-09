<?php
$sex = $user->sex == 1 ? 'Nam' : 'Nữ';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Thông tin chi tiết của nhân viên</h3>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive table-upgrade">
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-profile">
                                        <div class="card-avatar">
                                            <a href="#pablo">
                                                <img class="img" src="/webroot/img/avatar/<?= $user->avatar ?>" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="title">Thông tin đăng nhập</h3>
                                    Đăng xuất gần nhất lúc: <?= $user->user['last_login'] ?>
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
                                        <td><?= $user->birthday ?></td>
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
