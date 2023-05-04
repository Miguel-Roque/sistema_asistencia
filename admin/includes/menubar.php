<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTES</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        <li class="header">ADMINISTRACIÓN</li>
        
        <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Practicantes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Lista de Practicantes</a></li>
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
          </ul>
        </li>

        <li><a href="position.php"><i class="fa fa-suitcase"></i> Cargos</a></li>
        <li><a href="negocio.php"><i class="fa fa-suitcase"></i> Unidad de Negocio</a></li>
        <li class="header">CONSULTAS</li>
        <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Horarios</span></a></li>
        <li class="header">EXPORTAR</li>
        
        <li><a href="exportar.php"><i class="glyphicon glyphicon-cloud-download"></i> <span>Exportar Asistencias</span></a></li>
        <li><a href="employee_export.php"><i class="glyphicon glyphicon-cloud-download"></i> <span>Exportar por Practicantes</span></a></li>

        <li class="header">FORO O MURAL</li>
        <li><a href="mural.php"><i class="fa fa-solid fa-camera-retro"></i> <span>Publicaciones</span></a></li>

        <li class="header">USUARIOS</li>
        <li><a href="usuario.php"><i class="fa fa-light fa-user"></i> <spam>Lista de Usuarios</spam></a></li>
        <li><a href="papelera.php"><i class="fa fa-light fa-trash"></i> <spam>Papelera</spam></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
