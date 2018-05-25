<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các nhân viên của team: <?= $team->name ?> </h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên nhân viên</th>
                                <th class="text-center">Tên tài khoản</th>
                                <th class="text-center">Chức vụ</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) {
                                    $isLeader = $team->leader == $user->id ? "(trưởng nhóm)" : ""
                                ?>
                                    <tr>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" title="Click vào để xem chi tiết nhân viên này."><?= $user->id?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" title="Click vào để xem chi tiết nhân viên này."><?= $user->name.' '.$isLeader?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" title="Click vào để xem chi tiết nhân viên này."><?= $user->username?></td>
                                        <td class="modal-user" data-user_id="<?= $user->id ?>" title="Click vào để xem chi tiết nhân viên này."><?= $user->position->name?></td>
                                        <td>
                                            <a class="modal-change_team" data-user_id=<?= $user->id ?> >
                                                <button type="button" rel="tooltip" title="Chuyển đổi nhân viên sang phòng khác" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="fa fa-exchange"></i>
                                                </button>
                                            </a>
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

<?= $this->element('modal_user_detail') ?>
<div id="modalChangeTeam" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
    <br>
        <div class="modal-body" id="conten-modal" style="padding-top: 0">
        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('.modal-change_team').click(function() {
            user_id = $(this).data('user_id')
            $.ajax({
                url: '/Users/changeTeam/'+user_id,
            }).done(function(data) {
                $('#modalChangeTeam').find('#conten-modal').html(data)
            });
            $("#modalChangeTeam").modal("show")
            $('#modalChangeTeam').data('user_id', user_id)
            return false;
        })
    });
</script>
<?= $this->Element('custom_select2'); ?>
