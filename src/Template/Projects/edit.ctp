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
                                    <div class="form-group">
                                        <label class="control-label">Chọn team</label>
                                        <select name="team_id" class="form-control">
                                            <option value="">Lựa chọn team</option>
                                            <?php foreach($teams as $team) { 
                                                $selected = $project->team_id == $team->id ? "selected" : "";
                                            ?>
                                                <option <?= $selected ?> value=<?= $team->id ?>><?= $team->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
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
                                                <option <?= $selected ?> value=<?= $team->id ?> value=<?= $company->id ?>><?= $company->company_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hãy thêm thông tin cơ bản cho dự án:</label>
                                        <div class="form-group label-floating">
                                            <textarea name="description" class="form-control" rows="5"><?= $project->description ?></textarea>
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
