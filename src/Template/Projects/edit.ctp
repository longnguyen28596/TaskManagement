<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thay đổi dự án</h4>
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Chọn khách hàng</label>
                                        <select name="company_id" class="form-control companies">
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Chọn team làm dự án</label>
                                        <select name="teams[]" class="form-control teams" multiple="multiple" >
                                            <?php foreach($teams as $team) {
                                                $selected = "";
                                                foreach ($projectTeams as $projectTeam) {
                                                    if ($team->id == $projectTeam->team_id) {
                                                        $selected = "selected";
                                                        break;
                                                    }
                                                }?>
                                                <option <?= $selected ?> value=<?= $team->id ?>><?= $team->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Độ ưu tiên</label>
                                        <select name="priority" class="form-control" id="priority">
                                            <option value='Thấp' <?php if($project->priority == "Thấp") echo "selected"; ?>>Thấp</option>
                                            <option value='Trung bình' <?php if($project->priority == "Trung bình") echo "selected"; ?>>Trung bình</option>
                                            <option value='Cao' <?php if($project->priority == "Cao") echo "selected"; ?>>Cao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Ngày relase(Có thể không cần)</label>
                                        <input type="text" name="release" class="form-control" value="<?= $project->time_release ?>" id="release">
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
                teams: "required",
                company_id: "required",
            },
            messages: {
                name: "Hãy điền tên cho dự án.",
                teams: "Hãy lựa chọn nhóm thực hiện dự án.",
                company_id: "Hãy lựa chọn đối tác.",
            }
        });

    $('.companies').select2({
        placeholder: "Lựa chọn khách hàng"
    });
    $('.teams').select2({
        placeholder: "Lựa chọn team làm dự án"
    });
    
    })
</script>
<?= $this->Element('custom_select2'); ?>
