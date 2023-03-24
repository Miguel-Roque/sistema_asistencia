<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nombre = $_POST['firstname'];
		$last = $_POST['lastname'];
		$photo = $_POST['photo'];
		$rango = $_POST['rango'];
		
		$sql = "INSERT INTO admin (username, password, firstname, lastname, photo, rango) VALUES ('$username', '$password', '$nombre', '$last', '$photo', '$rango')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Usuario añadido satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: usuario.php');
?>