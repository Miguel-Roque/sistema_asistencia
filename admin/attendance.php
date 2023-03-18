<?php include 'includes/session.php'; ?>
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
      Asistencia
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin/home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Asistencia</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              
           

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Unidad de Negocio</th>
                  <th>Área</th>
                  <th>Hora Entrada</th>
                  <th>Hora Salida</th>
                  <th>Acción</th>
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
                          <td>".$row['description']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Editar</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Eliminar</button>
                          </td>
                        </tr>
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
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
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
</script>
</body>
</html>
