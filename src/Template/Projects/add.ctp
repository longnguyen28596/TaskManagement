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
                        <form method="post" action="/projects/add" id="formAddNewProject">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên của dự án</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
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
                                <div class="col-md-7">
                                    <div class="card-content">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead class="text-primary">
                                                <th class="text-center">Lựa chọn</th>
                                                <th class="text-center">Tên Team</th>
                                            </thead>
                                            <tbody>
                                                    <?php foreach($teams as $team) {
                                                    ?>
                                                        <tr data-href='/Teams/view/<?= $team->id ?>' title='Click vào để xem chi tiết team này.'>
                                                            <td><input value=<?= $team->id ?> class='teams' name="teams[]" type="checkbox"></td>
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
                team_id: "required",
                company_id: "required",
            },
            messages: {
                name: "Hãy điền tên cho dự án.",
                team_id: "Hãy lựa chọn nhóm thực hiện dự án.",
                company_id: "Hãy lựa chọn đối tác.",
            }
        });

        $('.companies').select2({
            placeholder: "Lựa chọn khách hàng"
        });
    })
</script>
<?= $this->Element('custom_select2'); ?>