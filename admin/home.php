<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel de Control
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Panel de Control</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM employees";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total de Practicantes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="employee.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM attendance";
                $query = $conn->query($sql);
                $total = $query->num_rows;

                $sql = "SELECT * FROM attendance WHERE status = 1";
                $query = $conn->query($sql);
                $early = $query->num_rows;
                
                $percentage = ($early/$total)*100;

                echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
              ?>
          
              <p>Practicantes a Tiempo</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM attendance WHERE date = '$today' AND status = 1";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>"
              ?>
             
              <p>A tiempo hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM attendance WHERE date = '$today' AND status = 0";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>"
              ?>

              <p>Tardes hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informe de asistencia mensual</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          </div>
        </div>
      <div class="col-xs-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Informe de Asistencia</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                </form>
              </div>
            </div>
   
            <div class="box-body">
            <table id="example1" class="table">
                <thead>
                  <th class="hidden"></th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Area</th>
                  <th>Hora Entrada</th>
                  <th>Hora Salida</th>
                </thead>
                <tbody>
                  <?php
                  $current_date = date('Y-m-d');
                  if ($current_date >= '2023-03-24') {
                    $add_time = '00:05:00';
                  } else {
                    $add_time = '00:15:00';
                  }
                    $sql = "SELECT attendance.*,employees.*,negocio.*,position.*, employees.employee_id AS empid,
                           CASE WHEN ADDTIME(schedules.time_in, '$add_time') >= attendance.time_in THEN 1 
                           WHEN ADDTIME(schedules.time_in, '$add_time') <= attendance.time_in THEN 0 
                           END AS status_v1,

                              attendance.id AS attid FROM attendance
                              RIGHT JOIN employees
                                ON employees.id = attendance.employee_id
                              LEFT JOIN position
                                ON position.id = employees.position_id
                              LEFT JOIN negocio
                                ON negocio.id = employees.negocio_id
                              LEFT JOIN schedules
                                ON schedules.id = employees.schedule_id
                              WHERE attendance.date >= DATE_SUB(CURDATE(), INTERVAL 14 DAY)

                              ORDER BY attendance.date DESC,
                              attendance.time_in DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      //$status = ($row['status'])?'<span class="label label-warning pull-right">a tiempo</span>':'<span class="label label-danger pull-right">tarde</span>';
                      if ( ($row['status_v1']) =="1" ){ 
                        $status = '<span class="label label-success pull-right">A Tiempo</span>';
               } else if ( ($row['status_v1'])=="0" ){
                        $status = '<span class="label label-warning pull-right">Tarde</span>';
                      } else if ( ($row['status_v1']) == NULL ){

                        $status = '<span class="label label-danger pull-right">No Marco</span>';
                   }
                 
                        echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['nombre_negocio']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>

                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    
    </div>


      </section>
      <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(date) = '.$year;
  $months = array();
  $ontime = array();
  $late = array();




  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM attendance  WHERE MONTH(date) = '$m' AND status = 1 $and";
    $oquery = $conn->query($sql);
    array_push($ontime, $oquery->num_rows);

    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
    $lquery = $conn->query($sql);
    array_push($late, $lquery->num_rows);


    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);

   
    
  }

  

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);

 

?>

<!-- End Chart Data -->
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
        {
          label               : 'Tarde',
          fillColor           : 'rgba(255, 168, 0, 1)',
          strokeColor         : 'rgba(255, 168, 0, 1)',
          pointColor          : '#Ffa800',
          pointStrokeColor    : 'rgba(255, 168, 0, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 168, 0, 1)',
          data                : <?php echo $late; ?>
        },
        {
          label               : 'A tiempo',
          fillColor           : 'rgba(45, 160, 69, 1)',
          strokeColor         : 'rgba(45, 160, 69, 1)',
          pointColor          : '#2da045',
          pointStrokeColor    : 'rgba(45, 160, 69, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(45, 160, 69, 1)',
          data                : <?php echo $ontime; ?>
        },     
    ]
  }

  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();

  
  
});
</script>

<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
