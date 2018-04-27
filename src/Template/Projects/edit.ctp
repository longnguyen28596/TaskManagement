<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tạo mới dự án.</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/projects/edit/<?= $project->id ?>" id="formAddNewProject">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Tên của dự án</label>
                                        <input value="<?= $project->name ?>" type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
         
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Chọn đối tác</label>
                                        <select name="company_id" class="form-control">
                                            <option value="">Lựa chọn đối tác</option>
                                            <?php foreach($companies as $company) { 
                                                $selected = $project->company_id == $company->id ? "selected" : "";
                                            ?>
                                                <option <?= $selected ?> value=<?= $company->id ?>><?= $company->company_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <div class="card-content">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead class="text-primary">
                                                <th class="text-center">Lựa chọn</th>
                                                <th class="text-center">Tên Team</th>
                                            </thead>
                                            <tbody>
                                                    <?php foreach($teams as $team) {
                                                        $checked = "";
                                                        foreach ($projectTeams as $projectTeam) {
                                                            if ($team->id == $projectTeam->team_id) {
                                                                $checked = "checked";
                                                                break;
                                                            }
                                                        }
                                                    ?>
                                                        <tr data-href='/Teams/view/<?= $team->id ?>' title='Click vào để xem chi tiết team này.'>
                                                            <td><input value=<?= $team->id ?> <?= $checked ?> class='teams' name="teams[]" type="checkbox"></td>
                                                            <td><?= $team->name ?></td>
                                                        </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hãy thêm thông tin cơ bản cho dự án:</label>
                                        <div class="form-group label-floating">
                                            <textarea name="description" class="form-control ckeditor" rows="5"><?= $project->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Cập nhập</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var validator = $("#formAddNewProject").validate({
            rules: {
                name: "required",
                team_id: "required",
                company_id: "required",
            },
            messages: {
                name: "Hãy điền tên cho dự án.",
                team_id: "Hãy lựa chọn nhóm thực hiện dự án.",
                company_id: "Hãy lựa chọn đối tác.",
            }
        });
    })
</script>
