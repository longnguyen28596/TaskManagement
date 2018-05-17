<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li class="dropdown" id="notifications">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">notifications</i>
                        <?php if($count_messages != 0) { ?><span class="notification"><?php  echo $count_messages; ?></span><?php }?>
                        <p class="hidden-lg hidden-md">Notifications</p>
                    </a>
                    <ul class="dropdown-menu">
                    Thông báo
                    <hr style="margin: 0">
                    <?php if(isset($mesages)){ ?>
                        <?php foreach ($mesages as $mesage) { ?>
                            <li>
                                <a href="<?= $mesage->url ?>" title=" Lúc <?= $mesage->created ?>"><?= $mesage->content ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <hr style="margin: 0">
                    <li>
                        <a style="text-align:center" href="#">Xem tất cả</a>
                    </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/Users/editPassword/<?= $_SESSION['current_user']['id'] ?>">Đổi mật khẩu</a>
                        </li>
                        <li>
                            <a href="/Users/edit/<?= $_SESSION['current_user']['id'] ?>">Đổi thông tin người dùng</a>
                        </li>
                        <li>
                            <a href="/Users/logout/">Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $('#notifications').click(function(){
        $.ajax({
            url: '/messages/edit/',
        }).done(function(){
            $('#notifications').find('.notification').hide()
        })
    })
</script>