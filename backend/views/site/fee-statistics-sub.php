<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- /.box-header -->
<div class="box-body">
  <!-- DONUT CHART -->
  <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title" style="color: #DD4B39;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                Last Month Fee Statistics <small style="color: #DD4B39;"> Session 2019 - 2021</small>
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
</div>
<!-- /.box-body -->

<script>
// Last Month Income/Expense....
Highcharts.chart('container1', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Sub Branch Fee Statistics'
    },
    subtitle: {
        text: 'Last Month'
    },
    tooltip: {
        format: '<b>{point.name}</b>: ({point.y:1f})'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
        }
    },
    series: [{
        type: 'pie',
        name: 'Amount',
        innerSize: '50%',
        data: [
            ['<b>Total Collectable Fee</b>', 350000],
            ['<b>Collected Fee</b>', 200000],
            ['<b>Pending Fee</b>', 150000],
        ]
    }]
});
</script>