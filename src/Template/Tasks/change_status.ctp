<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"></script> -->
<style>
    #ex1Slider .slider-selection {
        background: green;
    }
</style>
<?= $this->Html->css('stars')?>
<?= $this->Html->script("custom/js-stars-rating.js") ?>

<div class="content">
    <div class="container-fluid">
        <div class="card-content">
        <form method="post" action="/tasks/changeStatus/<?= $task->id ?>" id="formUpdateStatusTask">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Cập nhật trạng thái công việc</label>
                        <select class="form-control" name="status" id="status">
                            <option  <?php if($task->status == "") echo 'selected'; ?>  value="Chưa bắt đầu">Chưa bắt đầu</option>
                            <option <?php if($task->status != "") echo 'selected'; ?> value="Đã bắt đầu">Đã bắt đầu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($current_user_id == $task->user_request) { ?>
                        <div class="form-group">
                            <label class="control-label">Tình trạng</label>
                            <select id="done" class="form-control" name="request_check">
                                <option <?php if($task->request_check == '-1') echo 'selected'; ?> value="-1">Đề nghị kiểm tra</option>
                                <option <?php if($task->request_check == '1') echo 'selected'; ?> value="1">Đã đạt</option>
                                <option <?php if($task->request_check == '0') echo 'selected'; ?> value="0">Chưa đạt</option>    
                            </select>
                        </div>
                    <?php } else { ?>
                        <div class="checkbox">
                            <label>
                                <input <?php if ($task->request_check == '-1') echo 'checked';  ?> type="checkbox" name="cb_request_check" id="cb_request_check">
                                Yêu cầu kiểm tra
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Cập nhật tiến độ </label>
                <input name="progess" id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?= $task->status ?>"/>
            </div>
            <a href="#">
                <button id='submit_update' class="btn btn-primary pull-right">Cập nhật</button>
            </a>
        </form>
        </div>
    </div>
</div>

<script>
        $('#ex1').fadeOut()
        $(document).ready( function () {
            if($('#status').val() != 'Chưa bắt đầu') {
                $('#ex1').slider({
                    formatter: function(value) {
                        return 'Xử lý: ' + value + '%';
                }
            });
        }
        
        $('#formUpdateStatusTask').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"/Tasks/changeStatus/" + <?= $task->id ?>,  
                method:"POST",
                data:$('#formUpdateStatusTask').serialize(),  
                success:function(data){
                    $("#modalUpdateStatusTasks").modal("hide")
                    $.ajax({
                        url: '/Tasks/filterListMyTask',
                        type: "POST",
                        data: {
                            project_id: 0,
                            from_tab: $('#modalUpdateStatusTasks').data('from_tab'),
                        }
                    }).done(function(data) {
                        $('#'+$('#modalUpdateStatusTasks').data('from_tab')).find('.ketqua').html(data)
                    })
                }  
            });
        })

        $('#status').change(function(){
            if($('#status').val() != 'Chưa bắt đầu') {
                $('#ex1').fadeIn()
                $('#ex1').slider({
                    formatter: function(value) {
                        return 'Xử lý: ' + value + '%';
                    }
                });
            }
        });

        $(".checkbox").click(function(){
            if($('#ex1').val() !="100" ){
                alert("Tiến độ phải 100% mới kiểm tra được");
                $("#cb_request_check").prop("checked", false);
            }
        })
    });
</script>
