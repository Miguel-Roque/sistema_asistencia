<?php

  include('includes/conn.php');

  if (isset($_GET))
   {
  	$cod_imagen=0;
  	$imagen='';
  	$cod_imagen=$_GET['cod_imagen'];
  	$imagen=$_GET['imagen'];
  	$sql="DELETE FROM imagenes WHERE cod_imagen = '".$cod_imagen."'";
  	$res = mysqli_query($conn,$sql);
  	if ($res) 
  	{
  		unlink($imagen);
  		echo '<script> window.location="mural.php";</script>';	

  	}
  }

	
?>
