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

              <table border ='1' id="example1 border-collapse: separate">
                <thead>
                  <th scope='col' bgcolor='#A9D08E'>Fecha</th>
                  <th scope='col' bgcolor='#00B0F0'>Nombre y Apellido</th>
                  <th scope='col' bgcolor='#EB7A1D'>Codigo de Asistencia</th>
                  <th scope='col' bgcolor='#FF66FF'>Unidad de Negocio</th>
                  <th scope='col' bgcolor='#9966FF'>Area</th>
                  <th scope='col' bgcolor='#92D050'>Hora Entrada</th>
                  <th scope='col' bgcolor='#00FF99'>Hora de Salida</th>
                  <th scope='col' bgcolor='#FFFF00'>Asistencia</th>
                  <th scope='col' bgcolor='#66FFFF'>Miembro Desde</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT attendance.*,employees.*,negocio.*,position.*, employees.employee_id AS empid,
                           CASE WHEN ADDTIME(schedules.time_in, '00:15:00') >= attendance.time_in THEN 1 
                           WHEN ADDTIME(schedules.time_in, '00:15:00') <= attendance.time_in THEN 0 
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
                        $status = '<span class="label label-success pull-right"> A Tiempo</span>';
               } else if ( ($row['status_v1'])=="0" ){
                        $status = '<span class="label label-warning pull-right"> Tarde</span>';
                      } else if ( ($row['status_v1']) == NULL ){

                        $status = '<span class="label label-danger pull-right"> No Marco</span>';
                   }
                 
                        echo "
                        <tr>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['nombre_negocio']."</td>
                          <td>".$row['description']."</td>
                          <td>".date('h:i A', strtotime($row['time_in']))."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>".$status."</td>
                          <td>".date('M d, Y', strtotime($row['created_on']))."</td>

                      ";
                    }
                  ?>


                 <?php
                /*    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";*/

                $sql = "SELECT *, employees.id AS empid
                            FROM employees
                            LEFT JOIN position
                            ON position.id = employees.position_id
                            LEFT JOIN schedules
                            ON schedules.id = employees.schedule_id
                            LEFT JOIN negocio
                            ON negocio.id = employees.negocio_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                     
                        <td>".date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out']))."</td>

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
