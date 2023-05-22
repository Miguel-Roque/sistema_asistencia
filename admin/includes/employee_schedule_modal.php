<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center"><b><span class="employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="schedule_employee_edit.php">
                    <input type="hidden" id="empid" name="id">
                    <div class="row">
  <div class="col-sm-5 text-center">
    <div style="text-align:center;">
      <span  style="font-weight:bold;">Foto de perfil</span><br>
      <img id="profile_image" src="../images/profile.jpg" width="400px" height="600px">
    </div>
  </div>
  <div class="col-sm-7 text-center">
    <div class="form-group">
      <label for="edit_schedule" class="control-label">
                <div class="form-group">
                    <label for="employee_val" class="col-sm-3 control-label">Código de Practicante</label>

                    <div class="col-sm-9">
                      <input  type="text" class="form-control" name="employee_val" id="employee_val" disabled>
                      </input>
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="negocio" class="col-sm-3 control-label">Area</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="negocio" id="negocio_valv2" required disabled>
                        
                      </input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="position_valv2" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <input  type="text" class="form-control" name="position" id="position_valv2" disabled>
                      </input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="position_valv2" class="col-sm-3 control-label">Dias Trabajados</label>

                    <div class="col-sm-9">
                      <input  type="text" class="form-control" name="position" id="position_valv2">
                      </input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="employee_val" class="col-sm-3 control-label">Dias Faltados</label>

                    <div class="col-sm-9">
                      <input  type="text" class="form-control" name="position" id="employee_val">
                      </input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="num_hr" class="col-sm-3 control-label">Horas de Trabajo</label>

                    <div class="col-sm-9">
                      <input  type="text" class="form-control" name="num_hr" id="num_hr" disabled>
                      </input>
                    </div>
                </div>
                <div class="form-group">

                <div>
                  <canvas id="myChart"></canvas>
                </div>

                </div>
                

      </label>
      
    </div>
  </div>
</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  const ctx = document.getElementById('myChart');
  <?php
    $current_date = date('Y-m-d');
    if ($current_date >= '2023-03-24') {
      $add_time = '00:05:00';
    } else {
      $add_time = '00:15:00';
    }
    $employee_id = isset($_GET['employee_val']) ? $_GET['employee_val'] : null;
    $where_clause = $employee_id ? "WHERE employees.employee_id = $employee_id" : "";
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
      $where_clause
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

    $late_count = 0;
    $ontime_count = 0;
    foreach ($attendance_count as $employee_id => $attendance) {
      $late_count += $attendance['late'];
      $ontime_count += $attendance['ontime'];
    }
  ?>    
  
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Faltas', 'Asistencias', 'Tardanzas'],
      datasets: [{
        label: '# of Votes',
        data: [<?php echo count($attendance_count) - $ontime_count - $late_count ?>, 
        <?php echo $ontime_count ?>,
        <?php echo $late_count ?>],

        borderWidth: 1
      }]
    },
    options:
 {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  

</script>

