<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách các phòng ban trong công ty</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                    <?php if($position_id == 1 || $position_id == 2) { ?>
                        <a href="/teams/add"><button type="button" class="btn btn-primary">Thêm mới phòng ban</button></a>
                    <?php } ?>
                        <table class="table table-striped table-bordered data-table-list table-responsive table-hover text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên team</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($teams as $team) {?>
                                    <tr>
                                        <td><?= $team->id?></td>
                                        <td><?= $team->name?></td>
                                        <td><a href="/Teams/usersOfTeam/<?= $team->id ?>" title="Click vào để xem team có những nhân viên nào">Danh sách các thành viên thuộc team</td>
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
