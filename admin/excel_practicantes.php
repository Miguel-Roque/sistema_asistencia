<?php 

header("content-type: application/xls");
header("content-Disposition: attachment; filename = Control de Asistencia NHL.xls");

 ?>

<?php include 'includes/session.php'; ?>

<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">


  <div class="content-wrapper">

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
      <div class="row">
        <div class="col-xs-12 border">
          <div class="box">

            <div class="box-body">

              <style>
        table, tr, th, td{
          border: #1422D2;
          text-align: center;
              }
        </style>
              <h2>Control de Asistencia Semanal </h2>
              <table border ='1' id="example1 border-collapse: separate">
              <thead>
                  <th scope='col' bgcolor='#00B0F0'>Nombre y Apellido</th>
                  <th scope='col' bgcolor='#FF66FF'>Unidad de Negocio</th>
                  <th scope='col' bgcolor='#9966FF'>Area</th>
                  <th scope='col' bgcolor='#92D050'>Asistencias a Tiempo</th>
                  <th scope='col' bgcolor='#00FF99'>Asistencias de Tardanzas</th>
                  <th scope='col' bgcolor='#239B56'>Horas Realizadas Totales</th>
                </thead>
                <tbody>
                <?php
// Obtener el número de semana actual y el año actual
$current_week = date('W');
$current_year = date('Y');
$current_date = date('Y-m-d');
if ($current_date >= '2023-03-24') {
  $add_time = '00:05:00';
} else {
  $add_time = '00:15:00';
}
$negocio = $_GET['negocio'];
$sql = "SELECT attendance.*, employees.*, negocio.*, position.*, employees.employee_id AS empid,
CASE WHEN ADDTIME(schedules.time_in, '$add_time') >= attendance.time_in THEN 1 
     WHEN ADDTIME(schedules.time_in, '$add_time') <= attendance.time_in THEN 0 
END AS status_v1,
attendance.id AS attid 
FROM attendance
RIGHT JOIN employees ON employees.id = attendance.employee_id
LEFT JOIN position ON position.id = employees.position_id
LEFT JOIN negocio ON negocio.id = employees.negocio_id
LEFT JOIN schedules ON schedules.id = employees.schedule_id

WHERE employees.employee_id = '$negocio'

  AND YEAR(attendance.date) = $current_year
  AND WEEK(attendance.date) = $current_week
ORDER BY attendance.date DESC, attendance.time_in DESC";

$query = $conn->query($sql);
$attendance_count = array();
$total_num_hr = array();

while($row = $query->fetch_assoc()){
$employee_id = $row['employee_id'];
if (isset($attendance_count[$employee_id])) {
if ($row['status_v1'] == 1) {
  $attendance_count[$employee_id]['ontime']++;
} else {
  $attendance_count[$employee_id]['late']++;
}
$total_num_hr[$employee_id] += $row['num_hr'];
} else {
$attendance_count[$employee_id] = array(
  'ontime' => 0,
  'late' => 0,
  'descripcion' => $row['description'],
  'nombre_negocio' => $row['nombre_negocio'],
  'firstname' => $row['firstname'],
  'lastname' => $row['lastname'],
  'num_hr' => $row['num_hr']
);
if ($row['status_v1'] == 1) {
  $attendance_count[$employee_id]['ontime'] = 1;
} else {
  $attendance_count[$employee_id]['late'] = 1;
}
$total_num_hr[$employee_id] = $row['num_hr'];
}
}

foreach ($attendance_count as $employee_id => $attendance) {
echo "<tr>";
echo "<td>".$attendance['firstname']." ".$attendance['lastname']."</td>";
echo "<td>".$attendance['descripcion']."</td>";
echo "<td>".$attendance['nombre_negocio']."</td>";
echo "<td>".$attendance['ontime']."</td>";
echo "<td>".$attendance['late']."</td>";
echo "<td>".number_format($total_num_hr[$employee_id], 2)."</td>";
echo "</tr>";
}

?>

                </tbody>
            </table>
              <h2>Control de Asistencia</h2>
              <table border ='1' id="example1 border-collapse: separate">
                <thead>
                  <th scope='col' bgcolor='#00B0F0'>Nombre y Apellido</th>
                  <th scope='col' bgcolor='#EB7A1D'>Codigo de Asistencia</th>
                  <th scope='col' bgcolor='#FF66FF'>Unidad de Negocio</th>
                  <th scope='col' bgcolor='#9966FF'>Area</th>
                  <th scope='col' bgcolor='#92D050'>Asistencias a Tiempo</th>
                  <th scope='col' bgcolor='#00FF99'>Asistencias de Tardanzas</th>
                  <th scope='col' bgcolor='#239B56'>Horas Realizadas Totales</th>
                </thead>
                <tbody>
                <?php
                
$negocio = $_GET['negocio'];
$current_date = date('Y-m-d');
if ($current_date >= '2023-03-24') {
  $add_time = '00:05:00';
} else {
  $add_time = '00:15:00';
}
$sql = "SELECT attendance.*, employees.*, negocio.*, position.*, employees.employee_id AS empid,
CASE WHEN ADDTIME(schedules.time_in, '$add_time') >= attendance.time_in THEN 1 
     WHEN ADDTIME(schedules.time_in, '$add_time') <= attendance.time_in THEN 0 
END AS status_v1,
attendance.id AS attid 
FROM attendance
RIGHT JOIN employees ON employees.id = attendance.employee_id
LEFT JOIN position ON position.id = employees.position_id
LEFT JOIN negocio ON negocio.id = employees.negocio_id
LEFT JOIN schedules ON schedules.id = employees.schedule_id
WHERE employees.employee_id = '$negocio'
ORDER BY attendance.date DESC, attendance.time_in DESC";

$query = $conn->query($sql);
$attendance_count = array();
$total_num_hr = array();

while($row = $query->fetch_assoc()){
$employee_id = $row['employee_id'];
if (isset($attendance_count[$employee_id])) {
if ($row['status_v1'] == 1) {
  $attendance_count[$employee_id]['ontime']++;
} else {
  $attendance_count[$employee_id]['late']++;
}
$total_num_hr[$employee_id] += $row['num_hr'];
} else {
$attendance_count[$employee_id] = array(
  'ontime' => 0,
  'late' => 0,
  'descripcion' => $row['description'],
  'nombre_negocio' => $row['nombre_negocio'],
  'firstname' => $row['firstname'],
  'lastname' => $row['lastname'],
  'num_hr' => $row['num_hr']
);
if ($row['status_v1'] == 1) {
  $attendance_count[$employee_id]['ontime'] = 1;
} else {
  $attendance_count[$employee_id]['late'] = 1;
}
$total_num_hr[$employee_id] = $row['num_hr'];
}
}

foreach ($attendance_count as $employee_id => $attendance) {
echo "<tr>";
echo "<td>".$attendance['firstname']." ".$attendance['lastname']."</td>";
echo "<td>".$employee_id."</td>";
echo "<td>".$attendance['descripcion']."</td>";
echo "<td>".$attendance['nombre_negocio']."</td>";
echo "<td>".$attendance['ontime']."</td>";
echo "<td>".$attendance['late']."</td>";
echo "<td>".number_format($total_num_hr[$employee_id], 2)."</td>";
echo "</tr>";
}

?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
</div>
<?php include 'includes/scripts.php'; ?>
<script>

  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'schedule_employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('#schedule_val').val(response.schedule_id);
      $('#schedule_val').html(response.time_in+' '+response.time_out);
      $('#empid').val(response.empid);
    }
  });
}
</script>
</body>
</html>
