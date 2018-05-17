<?php if($position_id == 1 || $position_id ==2){ ?>
<div class="sidebar" data-color="purple" data-image="/img/admin/sidebar-1.jpg">
    <div class="logo">
        <a href="/" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <?php if ($countProjectManager > 0) { ?>
                <li>
                    <a href="/ProjectTeams/listProjectManager">
                        <i class="material-icons">grid_on</i>
                        <p> Các dự án đang quản lý
                        </p>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="/projects/index">
                    <i class="material-icons">grid_on</i>
                    <p> Danh sách các dự án
                    </p>
                </a>
            </li>
            <li>
                <a href="/users/index">
                    <i class="material-icons">person</i>
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
                    <p> 
                        <span style="padding-right: 14px;font-size: 24px;" class="glyphicon glyphicon-stats"></span> Thống kê
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>





<?php if($position_id == 3 || $position_id ==4){ ?>
<div class="sidebar" data-color="purple" data-image="/img/admin/sidebar-1.jpg">
    <div class="logo">
        <a href="/" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a data-toggle="collapse"  href="/users/index">
                <i class="material-icons">person</i>
                    <span class="sidebar-normal"> Danh sách nhân viên</span>
                </a>
            </li>
            <li>
                <a href="/teams/index">
                    <i class="material-icons">grid_on</i>
                    <span class="sidebar-normal"> Danh sách thành viên các team </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>