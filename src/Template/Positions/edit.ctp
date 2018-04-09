<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới chức vụ</h4>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/positions/edit/<?= $position['id'] ?>" id="formEditPosition">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Sửa chức vụ</label>
                                        <input type="text" value="<?= $position['name'] ?>" placeholder="Tên chức vụ" id="name" name="name" class="form-control">
                                        <p id="show-message-error" class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <a href="/"><button class="btn btn-primary pull-right">Bỏ qua</button></a>
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
        var valcaator = $("#formEditPosition").validate({
            rules: {
                name: {
                    required: true,
                    },
            },
            messages: {
                name: {
                    required: "Hãy nhập chức vụ.",
                },
            }
        });

            $('#name').keyup(function(e){
                if($('#name').val().length > 0) {
                    $.ajax({
                    url: '/positions/add?new_name_position='+$('#name').val()
                    }).done(function(result){
                        if (result == 'false') {
                            $('#show-message-error').html('Đã tồn tại tên chức vụ này.')
                        } else {
                            $( "#show-message-error" ).empty();
                        }
                    });
                }
            });
        })
</script>
