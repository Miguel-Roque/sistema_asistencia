<?php

  include('../includes/conn.php');

  if (isset($_GET))
   {
  	$id=0;
  	$ruta='';
  	$id=$_GET['id'];
  	$ruta=$_GET['ruta'];
  	$sql="DELETE FROM imagenes WHERE id = '".$id."'";
  	$res = mysqli_query($conn,$sql);
  	if ($res) 
  	{

  		unlink($ruta);
  		echo '<script> window.location="../mural.php";</script>';	

  	}
  }

	
?>


