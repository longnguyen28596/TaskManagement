<?php if($position_id == 1 || $position_id == 2 ) { ?>
<div class="sidebar" data-color="purple" data-image="/img/admin/sidebar-1.jpg">
    <div class="logo">
        <a href="/" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
                <li>
                    <a href="/userprojects/getListProjectsJoin">
                        <i class="material-icons">grid_on</i>
                        <p> Các dự án đang tham gia
                        </p>
                    </a>
                </li>
            <li>
                <a href="/projects/index">
                    <i class="material-icons">grid_on</i>
                    <p> Danh sách các dự án
                    </p>
                </a>
            </li>
            <li>
                <a href="/users/index">
                    <i class="fas fa-users"></i>
                    <p> Quản lý nhân viên
                    </p>
                </a>
            </li>
            <li>
                <a href="/teams/index">
                    <i class="material-icons">grid_on</i>
                    <p> Quản lý phòng ban
                    </p>
                </a>
            </li>
            <li>
                <a href="/positions/index">
                    <i class="material-icons">grid_on</i>
                    <p> Quản lý chức vụ
                    </p>
                </a>
            </li>
            <li>
                <a href="/Tasks/report">
                    <i class="fas fa-chart-pie"></i> Thống kê
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>

<?php if( isset($isLeader) && $isLeader == 1) { ?>
<div class="sidebar" data-color="purple" data-image="/img/admin/sidebar-1.jpg">
    <div class="logo">
        <a href="/" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
                <li>
                    <a href="/userprojects/getListProjectsJoin">
                        <i class="material-icons">grid_on</i>
                        <p> Các dự án đang tham gia
                        </p>
                    </a>
                </li>
            <li>
                <a href="/projects/index">
                    <i class="material-icons">grid_on</i>
                    <p> Danh sách các dự án
                    </p>
                </a>
            </li>
            <li>
                <a href="/users/index">
                    <i class="fas fa-users"></i>
                    <p> Danh sách nhân viên
                    </p>
                </a>
            </li>
            <li>
                <a href="/teams/index">
                    <i class="material-icons">grid_on</i>
                    <p> Danh sách phòng ban
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>

<?php if($position_id == 3 || $position_id == 4){ ?>
<div class="sidebar" data-color="purple" data-image="/img/admin/sidebar-1.jpg">
    <div class="logo">
        <a href="/" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="/userprojects/getListProjectsJoin">
                    <i class="material-icons">grid_on</i>
                    <p> Các dự án đang tham gia
                    </p>
                </a>
            </li>
            <li>
                <a href="/users/index">
                    <i class="fas fa-users"></i>
                    <p> Danh sách nhân viên
                    </p>
                </a>
            </li>
            <li>
                <a href="/teams/index">
                    <i class="material-icons">grid_on</i>
                    <p> Danh sách phòng ban
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>