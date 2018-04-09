<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách dự án trong công ty </h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>Id</th>
                                <th>Tên dự án</th>
                                <th>Tên công ty</th>
                                <th>Ngày tạo dự án</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($projects as $project) { ?>
                                    <tr>
                                        <td><?= $project->id?></td>
                                        <td><?= $project->name?></td>
                                        <td><?= $project->company['company_name']?></td>
                                        <td><?= $project->create_at?></td>
                                        <td>
                                            <a href="/projects/view/<?= $project->id ?>" title="click vào để xem chi tiết về dự án">Xem</a> | <a href="/projects/edit/<?= $project->id ?>" title="click vào để thay đổi dự án">Thay đổi</a> | <a href="/projects/view?project_id=<?= $project->id ?>" onclick="return confirm('Bạn có chắc muốn xoá dự án này?')" title="Xoá dự án" > Xoá</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float:right">
                            <?= $this->Paginator->numbers();?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
