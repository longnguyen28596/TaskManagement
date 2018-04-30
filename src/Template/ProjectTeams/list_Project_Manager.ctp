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
                                    <tr data-href='/Projects/view/<?= $project->Projects['id'] ?>'>
                                        <td><?= $project->Projects['id']?></td>
                                        <td><?= $project->Projects['name']?></td>
                                        <td><?= $project->Projects['company']->company_name; ?></td>
                                        <td><?= strftime('%d/%m/%Y',strtotime($project->Projects['create_at'])) ?></td>
                                        <td>
                                            <a href="/projects/view/<?= $project->Projects['id'] ?>" title="click vào để xem chi tiết về dự án">Xem</a> | <a class="modal-user_projects" data-project_id="<?= $project->Projects['id'] ?>" href="#" title="click vào để thay đổi dự án">Danh sách nhân viên</a> |<a href="/projects/edit/<?= $project->Projects['id'] ?>" title="click vào để thay đổi dự án">Thay đổi</a> | <a href="/projects/view?project_id=<?= $project->Projects['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá dự án này?')" title="Xoá dự án" > Xoá</a>
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

<div id="userProjectModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thay đổi nhân sự tham gia dự án</h4>
      </div>
      <hr>
      <div class="modal-body" id="conten-modal" style="padding-top: 0">
      </div>
      <hr>
    </div>
  </div>
</div>

<script>
    $(document).ready( function () {
        $('.modal-user_projects').hover(function(){
            $(this).css("cursor", "pointer")
        });
        // $('.dataTable').DataTable();
        $('.modal-user_projects').click(function(){
            project_id = $(this).data('project_id')
                $.ajax({
            url: '/UserProjects/index/'+project_id,
            type: 'POST',
        }).done(function(data) {
            $('#conten-modal').children().remove()
            $('#conten-modal').append(data)
        })
        $("#userProjectModal").modal("show")
        // $("#userProjectModal").modal("hide")

    })
});
</script>