<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tạo mới dự án</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/projects/add" id="formAddNewProject">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã dự án</label>
                                        <input type="text" name="id_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên của dự án</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Độ ưu tiên</label>
                                        <select name="priority" class="form-control" id="priority">
                                            <option value='Thấp'>Thấp</option>
                                            <option value='Trung bình'>Trung bình</option>
                                            <option value='Cao'>Cao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Ngày relase(Có thể không cần)</label>
                                        <input type="text" name="release" class="form-control" id="release">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Lựa chọn khách hàng</label>
                                        <select name="company_id" class="form-control companies">
                                            <option value="">Lựa chọn khách hàng</option>
                                            <?php foreach($companies as $company) { ?>
                                                <option value=<?= $company->id ?>><?= $company->company_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Chọn phòng ban đảm nhiệm</label>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hãy thêm thông tin cơ bản cho dự án:</label>
                                        <div class="form-group label-floating">
                                            <textarea name="description" class="form-control ckeditor" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Tạo mới</button>
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
                id_name: "required",
            },
            messages: {
                name: "Hãy điền tên cho dự án.",
                teams: "Hãy lựa chọn nhóm thực hiện dự án.",
                id_name: "Hãy thêm mã dự án vào.",
            }
        });

        $('.companies').select2({
            placeholder: "Lựa chọn khách hàng"
        });
        $('.teams').select2({
            placeholder: "Lựa chọn phòng ban đảm nhiệm"
        });
        jQuery('#release').datetimepicker({
            format:'Y/m/d H:i'
        });
    })
</script>
<?= $this->Element('custom_select2'); ?>