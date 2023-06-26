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
        Vista de asistencia
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin/home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Vista de asistencia de trabajadores</li>
      </ol> 
    </section>
    <!-- Main content --> 
  </div>
  <section>

  <div>
  <div class="row justify-content-end">
      <div class="col-auto">
          <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
      </div>
  </div>
  </div>
  </section>
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/negocio_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
