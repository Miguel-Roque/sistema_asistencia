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
        Comunicados
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin/home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Publicaciones</li>
        <li class="active">Comunicados</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

<?php 
  include('includes/conn.php');
  $query = "SELECT * FROM imagenes";
  $resultado = mysqli_query($conn,$query);
?>


      <div class="row">
        <div class="col-xs-12">
          <div class="box">

  
<div class="container">
  <div class="row">
    <div class="col-lg-4">
         <h1 class="text-primary">Subir imagen</h1>
      <form action="Backend/subir.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label for="formFile" class="form-label">Seleccione una Imagen</label>
              <input class="form-control" type="file" id="formFile" name="img">
          </div>

          <input type="submit" value="Guardar" class="btn btn-primary" name="Guardar">
      </form>
    </div>
  </div>
</div>  
<table class="table table-striped table-bordered">
      <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        //Paginador
        $sql_registe = mysqli_query($conn,"SELECT COUNT(*) as total_posts FROM imagenes ");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_posts'];

        $por_pagina = 10;

        if(empty($_GET['pagina']))
        {
          $pagina = 1;
        }else{
          $pagina = $_GET['pagina'];
        }

        $desde = ($pagina-1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conn,"SELECT * FROM imagenes 
                                     ORDER BY id 
                                     ASC LIMIT $desde,$por_pagina");

        mysqli_close($conn);

        $result = mysqli_num_rows($query);
        if($result > 0){

          while ($data = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td style="width: 50px;" scope="row"><?php echo $data['id']?></td>
            <td style="width: 100px;"><?php echo $data['nombre']?></td>
            <td style="text-align: center">
              <form action="Backend/delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data ['id']?>">
                <button href="Backend/delete.php?id=<?php echo $row['id'];?>&ruta=<?php echo $row['ruta'];?> type="submit" class="btn btn-danger" onclick="return delete1('¿Está seguro de que deseas eliminar esta publicación?');">Eliminar</button>
              </form>
              </form>
            </td>
          </tr>
        <?php 
          } 
        }?>
      </tbody>
    </table>


<script type="text/javascript">
  
  function delete1() 
  {
    var respuesta = confirm("Estas Seguro que deseas eliminar?");
    if (respuesta == true)
    {
      return true;
    }
    else 
    {
      return false;
    }
  }
</script>



<hr>

<?php 
/*
  $sql = "select * from imagenes";
  $res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res))
{
  ?>

  <img src="Backend/imagenes/<?php echo $row['nombre']; ?>" alt="" class="galeria__img">

       <a href="Backend/delete.php?id=<?php echo $row['id'];?>&ruta=<?php echo $row['ruta'];?>">
           <span class="glyphicon glyphicon-remove-circle icondelete" onclick="return delete1()"></span>
      </a>
 

  <?php 
}
*/
?>


</div>
  




<style type="text/css">
  
body{
  background: #222;
  font-family: monospace;
}

.titulo{
  color: blue;
  text-align: center;
}
.contenedor-galeria{
  display: flex;
  width: 80%;
  justify-content: space-around;
  flex-wrap: wrap;
  max-width: 1000px;
  margin: auto;
}

.icondelete{
background: red;
color: white;
line-height: 30px;
align-items: center;
text-align: center;
width:30px;
height: 30px;
border-radius: 50%;
top: -120px;

font-size: 25px;

}

.galeria__img{
  position: relative;
  width: 400px;
  height: 300px;
  margin-bottom: 10px;
  padding: 10px;
  object-fit: cover;
  left: 10px;
  
}

@keyframes escalar{
  to{
    transform: scale(1);
  }
  from{
    transform: scale(1.05);
  }
}

</style>

          </div>
        </div>
      </div>
    </section>   
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>

</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
