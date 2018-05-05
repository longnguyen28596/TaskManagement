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
                        <a href="/projects/add"><button type="button" class="btn btn-primary">Thêm mới dự án</button></a>
                        <table class="table table-striped table-bordered data-table-list table-responsive table-hover text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên dự án</th>
                                <th class="text-center">Tên công ty</th>
                                <th class="text-center">Ngày tạo dự án</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($projects as $project) { ?>
                                    <tr>
                                        <td class='jumb-link-row-table' data-href='/Projects/view/<?= $project->id ?>'><?= $project->id?></td>
                                        <td class='jumb-link-row-table' data-href='/Projects/view/<?= $project->id ?>'><?= $project->name?></td>
                                        <td class='jumb-link-row-table' data-href='/Projects/view/<?= $project->id ?>'><?= $project->company['company_name']?></td>
                                        <td class='jumb-link-row-table' data-href='/Projects/view/<?= $project->id ?>'><?= strftime('%d/%m/%Y',strtotime($project->create_at)) ?></td>
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
