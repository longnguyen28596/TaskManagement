<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Quản lý công việc
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a data-toggle="collapse" href="#tablesUsers">
                    <i class="material-icons">person</i>
                    <p> Quản lý người dùng
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesUsers" >
                    <ul class="nav">
                        <li>
                            <a href="/users/index">
                                <span class="sidebar-normal"> Danh sách nhân viên</span>
                            </a>
                        </li>
                        <li>
                            <a href="/users/add">
                                <span class="sidebar-normal"> Thêm mới nhân viên</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#tablePositions">
                    <i class="material-icons">grid_on</i>
                    <p> Quản lý chức vụ
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablePositions" >
                    <ul class="nav">
                        <li onclick="handle_click_child(this)">
                            <a href="/positions/add">
                                <span class="sidebar-normal"> Thêm mới chức vụ</span>
                            </a>
                        </li>
                        <li onclick="handle_click_child(this)">
                            <a href="/positions/index">
                                <span class="sidebar-normal"> Danh sách các chức vụ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php if(isset($listProjectManager)) { ?>
                <li>
                    <a data-toggle="collapse" href="#manageTask">
                        <i class="material-icons">grid_on</i>
                        <p> Các dự án đang quản lý
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="manageTask" >
                        <ul class="nav">
                            <?php foreach($listProjectManager as $project) { ?>
                                <li>
                                    <a data-toggle="collapse" href="#project<?= $project['id'] ?>">
                                        <p> <?= $project['name'] ?>
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse" id="project<?= $project['id'] ?>" >
                                        <ul class="nav">
                                            <li>
                                                <a href="/tasks/listTaskOfProjectId/<?= $project['id'] ?>">
                                                    <span class="sidebar-normal"> Danh sách nhiệm vụ</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/tasks/add/<?= $project['id'] ?>">
                                                    <span class="sidebar-normal"> Thêm mới nhiệm vụ</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/UserProjects/index/<?= $project['id'] ?>">
                                                    <span class="sidebar-normal"> Thêm nhân viên vào dự án</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php } ?> 
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <li>
                <a data-toggle="collapse" href="#tableProjects">
                    <i class="material-icons">grid_on</i>
                    <p> Quản lý dự án
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tableProjects" >
                    <ul class="nav">
                        <li onclick="handle_click_child(this)">
                            <a href="/projects/index">
                                <span class="sidebar-normal"> Danh sách các dự án </span>
                            </a>
                        </li>    
                        <li onclick="handle_click_child(this)">
                            <a href="/projects/add">
                                <span class="sidebar-normal"> Thêm mới dự án</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#tableTeams">
                    <i class="material-icons">grid_on</i>
                    <p> Quản lý Team
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tableTeams" >
                    <ul class="nav">
                        <li onclick="handle_click_child(this)">
                            <a href="/teams/index">
                                <span class="sidebar-normal"> Danh sách các team </span>
                            </a>
                        </li>    
                        <li onclick="handle_click_child(this)">
                            <a href="/teams/add">
                                <span class="sidebar-normal"> Thêm mới</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>