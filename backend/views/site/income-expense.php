<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- /.box-header -->
<div class="box-body">
<?php  
    $branches = Yii::$app->db->createCommand("SELECT branch_name, branch_code FROM branches WHERE status = 'Active'")->queryAll();
    $branchCount = count($branches);
    if ($branchCount>1) {
        $branchName1 = $branches[0]['branch_name'];
        $branchCode1 = $branches[0]['branch_code'];
        $branchName2 = $branches[1]['branch_name'];
        $branchCode2 = $branches[1]['branch_code'];            
    }
    else{
        $branchName1 = $branches[0]['branch_name'];
        $branchCode1 = $branches[0]['branch_code'];
    }
?>  
  <!-- DONUT CHART -->
  <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title" style="color: #DD4B39;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                Income/Expense <?php echo $branchName1." ".$branchCode1; ?><small style="color: #DD4B39;"> Session 2019</small>
            </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color: #04e27b;"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" style="color: #DD4B39;"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-12 col-sm-12" id="container1"></div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
  <!-- /.box -->
  <!-- DONUT CHART -->
  <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" style="color: #00C0EF;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                Income/Expense <?php echo $branchName2." ".$branchCode2; ?><small style="color: #00C0EF;"> Session 2019 - 2021</small>
            </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color: #04e27b;"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" style="color: #DD4B39;"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-12 col-sm-12" id="container2"></div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
  <!-- /.box -->
</div>
<!-- /.box-body -->

<script>
// Last Month Income/Expense....
Highcharts.chart('container1', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Current Month <?php echo date('M'); ?>'
    },
    // subtitle: {
    //     text: 'anything'
    // },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Delivered amount',
        data: [
            ['Income', 850000],
            ['Expence', 350000],
            ['Profit', 500000],
        ]
    }]
});
// Last Month Income/Expense....
Highcharts.chart('container2', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Current Month'
    },
    // subtitle: {
    //     text: 'From Begining to Last Month'
    // },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45,
        }
    },
    series: [{
        name: 'Delivered amount',
        data: [
            ['Income', 310000000],
            ['Expence', 110000000],
            ['Profit', 210000000],
        ]
    }]
});
</script>