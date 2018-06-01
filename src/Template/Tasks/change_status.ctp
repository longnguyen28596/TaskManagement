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
            <?php if ($current_user_id == $task->user_action && $task->user_request != $task->user_action) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Cập nhật trạng thái công việc</label>
                        <select class="form-control" name="status" id="status">
                            <option <?php if($task->status == "Chưa bắt đầu") echo 'selected'; ?>  value="Chưa bắt đầu">Chưa bắt đầu</option>
                            <option <?php if($task->status == "Đã bắt đầu") echo 'selected'; ?> value="Đã bắt đầu">Đã bắt đầu</option>
                            <option <?php if($task->status == "Yêu cầu kiểm tra") echo 'selected'; ?>  value="Yêu cầu kiểm tra">Yêu cầu kiểm tra</option>
                            <option disabled <?php if($task->status == "Yêu cầu làm lại") echo 'selected'; ?>  value="Yêu cầu làm lại">Yêu cầu làm lại</option>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <?php if ($current_user_id == $task->user_request || $task->user_request == $task->user_action) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Cập nhật trạng thái công việc</label>
                        <select class="form-control" name="status" id="status">
                            <option  <?php if($task->status == "Chưa bắt đầu") echo 'selected'; ?>  value="Chưa bắt đầu">Chưa bắt đầu</option>
                            <option <?php if($task->status == "Đã bắt đầu") echo 'selected'; ?> value="Đã bắt đầu">Đã bắt đầu</option>
                            <option  <?php if($task->status == "Yêu cầu kiểm tra") echo 'selected'; ?>  value="Yêu cầu kiểm tra">Yêu cầu kiểm tra</option>
                            <option  <?php if($task->status == "Yêu cầu làm lại") echo 'selected'; ?>  value="Yêu cầu làm lại">Yêu cầu làm lại</option>
                            <option  <?php if($task->status == "Đã xong") echo 'selected'; ?>  value="Đã xong">Đã xong</option>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-6 area_progress">
                <div class="form-group">
                    <label class="control-label">Cập nhật tiến độ</label>
                    <input name="progress" id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?= $task->progress ?>"/>
                </div>
            </div>
            </div>
            <a href="#">
                <button id='submit_update' class="btn btn-primary pull-right">Cập nhật</button>
            </a>
        </form>
        </div>
    </div>
</div>

<script>
        if ($('#status').val() == 'Chưa bắt đầu') {
            $('.area_progress').fadeOut()        
        }
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

        $('#status').change(function() {
            if($('#status').val() != 'Chưa bắt đầu') {
                $('.area_progress').fadeIn()
                $('#ex1').slider({
                    formatter: function(value) {
                        return 'Xử lý: ' + value + '%';
                    }
                });
                $("#ex1Slider").css("top", "9px")
            }
        });

        $("#ex1Slider").css("top", "9px")
    });
</script>
