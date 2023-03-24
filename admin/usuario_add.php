<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$password = $_POST['password']; // aquí se define la contraseña que quieres cifrar
        $hash = password_hash($password, PASSWORD_DEFAULT); // aquí se cifra la contraseña y se guarda el hash resultante en una variable
		$nombre = $_POST['firstname'];
		$last = $_POST['lastname'];
		$photo = $_POST['photo'];
		$rango = $_POST['rango'];
		
		$sql = "INSERT INTO admin (username, password, firstname, lastname, photo, rango) VALUES ('$username', '$hash', '$nombre', '$last', '$photo', '$rango')";
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