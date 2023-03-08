<?php

  include('../includes/conn.php');

  if (isset($_POST))
   {
  	$id=0;
  	$ruta='';
  	$id=$_POST['id'];
  	$ruta=$_POST['ruta'];
  	$sql="DELETE FROM imagenes WHERE id = '".$id."'";
  	$res = mysqli_query($conn,$sql);
  	if ($res) 
  	{

  		unlink($ruta);
  		echo '<script> window.location="../mural.php";</script>';	

  	}
  }

	
?>


