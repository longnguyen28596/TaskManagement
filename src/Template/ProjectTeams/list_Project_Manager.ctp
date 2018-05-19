<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Danh sách dự án đang quản lý </h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-striped table-bordered table-responsive table-hover data-table-list text-center">
                            <thead class="text-primary">
                                <th class="text-center">Id</th>
                                <th class="text-center">Tên dự án</th>
                                <th class="text-center">Đối tác</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($projects as $project) { ?>
                                    <tr data-href='/Projects/view/<?= $project->Projects['id'] ?>'>
                                        <td><?= $project->Projects['id']?></td>
                                        <td><?= $project->Projects['name']?></td>
                                        <td><?= $project->Projects['company']->company_name; ?></td>
                                        <td>
                                            <a href="/tasks/listTaskOfProjectId/<?= $project->Projects['id'] ?>" target="_blank" title="click vào để thay đổi dự án">
                                                <button type="button" rel="tooltip" title="Danh sách nhiệm vụ" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">list_alt</i>
                                                </button>
                                            </a>
                                            <a href="/tasks/add/<?= $project->Projects['id'] ?>" target="_blank" title="click vào để thay đổi dự án">
                                                <button type="button" rel="tooltip" title="Thêm nhiệm vụ" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">add</i>
                                                </button>    
                                            </a>
                                            <a class="modal-user_projects" data-project_id="<?= $project->Projects['id'] ?>" href="#">
                                                <button type="button" rel="tooltip" title="Thay đổi nhân sự cho dự án" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">person_add</i>
                                                </button>
                                            </a>
                                            <a class="modal-view_project" href="#" data-project_id=<?= $project->Projects['id'] ?> >
                                                <button type="button" rel="tooltip" title="click vào để xem chi tiết về dự án" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">streetview</i>
                                                </button>    
                                            </a>
                                            <a class="modal-edit_project" data-project_id=<?= $project->Projects['id'] ?> href="#" title="click vào để thay đổi dự án">
                                                <button type="button" rel="tooltip" title="Cập nhật thông tin dự án" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">edit</i>
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

<div id="modalInListProjectManager" class="modal fade" tabindex="-1" role="dialog">
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
        $('.modal-user_projects').click(function() {
            project_id = $(this).data('project_id')
            $.ajax({
                url: '/UserProjects/index/'+project_id,
                type: 'POST',
            }).done(function(data) {
                $('#conten-modal').html(data)
            })
            $("#modalInListProjectManager").modal("show")
        })

        $('.modal-view_project').click(function() {
            project_id = $(this).data('project_id')
            $.ajax({
                url: '/Projects/view/'+project_id,
                type: 'POST',
            }).done(function(data) {
                $('#modalInListProjectManager').find('#conten-modal').html(data)
            })
            $("#modalInListProjectManager").modal("show")
        })

        $('.modal-edit_project').click(function() {
            project_id = $(this).data('project_id')
            $.ajax({
                url: '/Projects/edit/'+project_id,
            }).done(function(data) {
                $('#modalInListProjectManager').find('#conten-modal').html(data)
            })
            $("#modalInListProjectManager").modal("show")
        })
    });
</script>