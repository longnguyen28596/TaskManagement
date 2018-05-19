<?php 
    $sum_tong_task_da_xong_dung_tien_do = 0;
    $sum_tong_task_da_xong_cham_tien_do = 0;
    $sum_tong_task_chua_xong_cham_tien_do = 0;
    $sum_tong_task_chua_xong_dung_tien_do = 0;


?>
<?= $this->Html->script('Chart.min.js') ?>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Lựa chọn bộ lọc</h3>
                    </div>
                    <div class="card-content">
                        <form method="post" action="/Tasks/report/" id="formTaskAdd" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Thống kê từ ngày </label>
                                        <input value="<?php if($fromDate != "") echo $fromDate; ?>" type="text" placeholder="Thống kê từ ngày" id="fromDate" name="fromDate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Thống kê đến ngày </label>
                                        <input type="text" value="<?php if($toDate != "") echo $toDate; ?>" placeholder="Thống kê đến ngày" id="toDate" name="toDate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Thống kê theo phòng ban</label>
                                        <select name="team_id" class="teams form-control">
                                            <option value='-1'>Thống kê tất cả phòng ban</option>
                                            <?php foreach($teams as $team) { 
                                                echo $team_id;
                                                $selected ="";
                                                if($team->id == $team_id){
                                                    $selected = 'selected';
                                                }
                                            ?>
                                                <option <?= $selected ?> value=<?= $team->id ?>><?= $team->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary pull-right">Thống kê</button>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Biểu đồ báo cáo</h3>
                    </div>
                    <div class="card-content bieudo">
                        <center>
                            <div id="chart_div"></div>
                        <center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header text-center" data-background-color="purple">
                        <h4 class="title">Kết quả tìm kiếm</h3>
                    </div>
                    <div class="card-content">
                    <table class="table table-striped table-bordered table-responsive table-hover text-center">
                            <tr  class="text-primary" >
                                <th rowspan="2" class="text-center">Tên nhân viên</th>
                                <th rowspan="2" class="text-center">Tổng số nhiệm vụ</th>
                                <th colspan="2" class="text-center">Nhiệm vụ chưa xong</th>
                                <th colspan="2" class="text-center">Nhiệm vụ đã xong</th>
                                <th rowspan="2" class="text-center">Đánh giá</th>
                            </tr>
                            <tr class="text-primary">
                                <th class="text-center">Nhiệm vụ đúng hạn</th>
                                <th class="text-center">Nhiệm vụ quá hạn</th>
                                <th class="text-center">Nhiệm vụ đúng hạn</th>
                                <th class="text-center">Nhiệm vụ quá hạn</th>
                            </tr>
                            <tbody>
                                <?php foreach($users as $user) {
                                    $tong_task_da_xong_dung_tien_do = 0;
                                    $tong_task_da_xong_cham_tien_do = 0;
                                    $tong_task_chua_xong_cham_tien_do = 0;
                                    $tong_task_chua_xong_dung_tien_do = 0;
                                    $tong_task = 0;
                                    foreach($tasks as $task) {
                                        if($user->id == $task->user_action) {
                                            $tong_task = $task->sum_task;
                                            break;                                            
                                        }
                                    }
                                    foreach($sum_task_da_xong_dung_tien_dos as $sum_task_da_xong_dung_tien_do) {
                                        if($user->id == $sum_task_da_xong_dung_tien_do->user_action) {
                                            $tong_task_da_xong_dung_tien_do = $sum_task_da_xong_dung_tien_do->count;
                                            break;                                            
                                        }
                                    }
                                    foreach($sum_task_da_xong_cham_tien_dos as $sum_task_da_xong_cham_tien_do) {
                                        if($user->id == $sum_task_da_xong_cham_tien_do->user_action) {
                                            $tong_task_da_xong_cham_tien_do = $sum_task_da_xong_cham_tien_do->count;
                                            break;
                                        }
                                    }
                                    foreach($sum_task_chua_xong_dung_tien_dos as $sum_task_chua_xong_dung_tien_do) {
                                        if($user->id == $sum_task_chua_xong_dung_tien_do->user_action) {
                                            $tong_task_chua_xong_dung_tien_do = $sum_task_chua_xong_dung_tien_do->count;
                                            break;                                            
                                        }
                                    }
                                    foreach($sum_task_chua_xong_cham_tien_dos as $sum_task_chua_xong_cham_tien_do) {
                                        if($user->id == $sum_task_chua_xong_cham_tien_do->user_action) {
                                            $tong_task_chua_xong_cham_tien_do = $sum_task_chua_xong_cham_tien_do->count;
                                            break;                                            
                                        }
                                    }
                                    $sum_tong_task_da_xong_dung_tien_do += $tong_task_da_xong_dung_tien_do;
                                    $sum_tong_task_da_xong_cham_tien_do += $tong_task_da_xong_cham_tien_do;
                                    $sum_tong_task_chua_xong_cham_tien_do += $tong_task_chua_xong_cham_tien_do;
                                    $sum_tong_task_chua_xong_dung_tien_do += $tong_task_chua_xong_dung_tien_do;
                                ?>
                                    <tr>
                                        <td><?= $user->name?></td>
                                        <td><?= $tong_task ?></td>
                                        <td><?= $tong_task_chua_xong_dung_tien_do ?></td>
                                        <td><?= $tong_task_chua_xong_cham_tien_do ?></td>
                                        <td><?= $tong_task_da_xong_dung_tien_do ?></td>
                                        <td><?= $tong_task_da_xong_cham_tien_do ?></td>
                                        <td>
                                            <?php if($user->ratings != array()) { ?>
                                                <?= $this->Application->ratingStar($user->id, $user->ratings['0']->sum_point, $user->ratings['0']->count_ratings)?>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float:right">
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.teams').select2({
            placeholder: "Lựa chọn phòng ban muốn liệt kê"
        });
    })
    jQuery('#fromDate').datetimepicker({
        format:'Y/m/d H:i'
    });
    jQuery('#toDate').datetimepicker({
        format:'Y/m/d H:i'
    });
</script>
<?= $this->Element('custom_select2'); ?>


<script type="text/javascript">

// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
    ['Nhiệm vụ đã xong quá hạn', <?= $sum_tong_task_da_xong_cham_tien_do ?>],
    ['Nhiệm vụ chưa xong trong quá trình làm', <?= $sum_tong_task_chua_xong_cham_tien_do?>],
    ['Nhiệm vụ chưa xong và quá hạn', <?= $sum_tong_task_chua_xong_dung_tien_do?>],
    ['Nhiệm vụ đã xong và đúng hạn', <?= $sum_tong_task_da_xong_dung_tien_do; ?>],
    ]);
    // Set chart options
    var options = {'title':'Biểu đồ thống kê tình trạng công việc',
                    'width':700,
                    'height':400};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
