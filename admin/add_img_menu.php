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
        Imagenes de menu
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin/home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Agregar imagen</li>
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
         <h1 class="text-primary">Añadir imagen al menu</h1>
      <form action="Backend/subir_menu.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label for="formFile" class="form-label">Seleccione una imagen</label>
              <input class="form-control" type="file" id="formFile" name="imagen">
          </div>

          <input type="submit" value="Guardar" class="btn btn-success" name="Guardar">
      </form>
    </div>
  </div>
</div>  
<table class="table table-striped table-bordered">
      <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Imagen</th>
            <th scope="col">Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        //Paginador
        $sql_registe = mysqli_query($conn,"SELECT COUNT(*) as total_posts FROM menu_imagenes ");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_posts'];

        $por_pagina = 6;

        if(empty($_GET['pagina']))
        {
          $pagina = 1;
        }else{
          $pagina = $_GET['pagina'];
        }

        $desde = ($pagina-1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conn,"SELECT * FROM menu_imagenes 
                                     ORDER BY ID 
                                     ASC LIMIT $desde,$por_pagina");

        mysqli_close($conn);

        $result = mysqli_num_rows($query);
        if($result > 0){

          while ($data = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td style="width: 50px;" scope="row"><?php echo $data['ID']?></td>
            <td style="width: 100px;"><?php echo $data['nombre_img']?></td>
            <td><img style="width: 200px;" src="data:image/jpg;base64,<?php echo base64_encode($data['imagen_rdm'])?>" alt=""></td>
            <td style="text-align: center">
              <form action="Backend/delete_menu.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data ['ID']?>">
                <button class="btn btn-danger" onclick="return delete1('¿Está seguro de que deseas eliminar esta imagen?');">Eliminar</button>
              </form>
              </form>
            </td>
          </tr>
        <?php 
          } 
        }?>
      </tbody>
    </table>
    </div>
    <div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


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
