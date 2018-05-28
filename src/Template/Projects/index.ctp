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
                        <?php if($position_id == 1 || $position_id == 2 ){ ?>
                            <a href="/projects/add"><button type="button" class="btn btn-primary">Thêm mới dự án</button></a>
                        <?php }?>
                        <table class="table table-striped table-bordered data-table-list table-responsive table-hover">
                            <thead class="text-primary">
                                <th class="text-center">Mã dự án</th>
                                <th class="text-center">Tên dự án</th>
                                <th class="text-center">Tên khách hàng</th>
                                <th class="text-center">Ngày tạo dự án</th>
                                <th class="text-center">Phòng ban đang đảm nhiệm</th>
                                <th class="text-center">Hành động</th>
                            </thead>
                            <tbody>
                                <?php foreach($projects as $project) { ?>
                                    <tr>
                                        <td><?= $project->id_name?></td>
                                        <td><?= $project->name?></td>
                                        <td><?= $project->company['company_name']?></td>
                                        <td><?= strftime('%d/%m/%Y',strtotime($project->create_at)) ?></td>
                                        <td>
                                        <?php 
                                            $teams = "";
                                            foreach ($project->project_teams as $project_team) {
                                                echo  "<a href='/tasks/listTaskByTeam?team_id={$project_team->team['id']}&project_id={$project->id}'>".$project_team->team['name']."</a>"."<br>";
                                            }
                                        ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="/tasks/listTaskOfProjectId/<?= $project->id ?>" title="Danh sách nhiệm vụ của dự án">
                                                <button style="padding-right: 0;" type="button" rel="tooltip" title="Danh sách nhiệm vụ" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons size_icon">list_alt</i>
                                                </button>  
                                            </a>
                                            <a class="modal-view_project" data-project_id=<?= $project->id ?> href="" title="click vào để xem chi tiết về dự án">
                                                <button style="padding-right: 0;" type="button" rel="tooltip" title="Xem chi tiết dự án" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons size_icon">streetview</i>
                                                </button>    
                                            </a>
                                            <a href="/projects/edit/<?= $project->id ?>">
                                                <button style="padding-right: 0;" type="button" rel="tooltip" title="Cập nhật" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons size_icon">edit</i>
                                                </button>
                                            </a>
                                            <a href="/projects/delete/<?= $project->id ?>" onclick="return confirm('Bạn có chắc muốn xoá dự án này?')"> 
                                                <button style="padding-right: 0;" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="material-icons size_icon">close</i>
                                                </button>
                                            </a>
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

<div id="modalInProjectsIndex" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông tin về dự án</h4>
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

        $('.modal-view_project').click(function() {
            project_id = $(this).data('project_id')
            $.ajax({
                url: '/Projects/view/'+project_id,
                type: 'POST',
            }).done(function(data) {
                $('#modalInProjectsIndex').find('#conten-modal').html(data)
            })
            $("#modalInProjectsIndex").modal("show")
            return false;
        })
    });
</script>