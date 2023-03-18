<?php

  include('../includes/conn.php');

  $idComunicado= $_POST['id'];
  $sql = "DELETE FROM imagenes WHERE id = $idComunicado";
  
  if ($conn->query($sql) === TRUE) {
	echo '<script> window.location="../mural.php";</script>';
	} else {
	  echo "Error al eliminar comunicado " . $conn->error;
	}
	
?>


