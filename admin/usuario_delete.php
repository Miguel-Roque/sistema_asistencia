<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM `admin` WHERE id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Usuario deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Seleccione el usuario a eliminar primero';
	}

	header('location: usuario.php');
	
?>