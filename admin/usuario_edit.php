<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
        $nombre = $_POST['firstname'];
		$last = $_POST['lastname'];
		$rango = $_POST['rango'];
		
		$sql = "UPDATE admin SET username = '$username', password = '$password', firstname = '$nombre', lastname = '$last', rango = '$rango' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Usuario actualizado con éxito';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Seleccionar usuario para editar primero';
	}

	header('location: usuario.php');
?>