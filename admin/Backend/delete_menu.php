<?php

  include('../includes/conn.php');

  $idRandom= $_POST['id'];
  $sql = "DELETE FROM menu_imagenes WHERE ID = $idRandom";
  
  if ($conn->query($sql) === TRUE) {
	echo '<script> window.location="../add_img_menu.php";</script>';
	} else {
	  echo "Error al eliminar comunicado " . $conn->error;
	}
	
?>


