<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		// Sentencia SQL para seleccionar los datos que deseas insertar en la tabla papelera
		$sqlSelect = "SELECT * FROM employees WHERE id = '$id'";
		// Ejecutar la consulta de selección
		$resultSelect = $conn->query($sqlSelect);
		// Verificar si se obtuvieron resultados
		if ($resultSelect->num_rows > 0) {
			// Sentencia SQL para insertar los datos seleccionados en la tabla papelera
			$sqlInsert = "INSERT INTO papelera SELECT * FROM employees WHERE id = '$id'";
			// Ejecutar la consulta de inserción
			if ($conn->query($sqlInsert) === TRUE) {
				$_SESSION['success'] = 'Empleado eliminado con éxito';
			} else {
				$_SESSION['error'] = $conn->error;
			}
			// Sentencia SQL para eliminar los datos de la tabla employees
			$sqlDelete = "DELETE FROM employees WHERE id = '$id'";
			// Ejecutar la consulta de eliminación
			if ($conn->query($sqlDelete) === TRUE) {
				$_SESSION['success'] = 'Empleado eliminado con éxito';
			} else {
				$_SESSION['error'] = $conn->error;
			}
			header('location: employee.php');
		} else {
			$_SESSION['error'] = 'No se encontraron datos en la tabla employees con el ID ' . $id;
			header('location: employee.php');
		}
	} else {
		$_SESSION['error'] = 'Seleccione el elemento para eliminar primero';
		header('location: employee.php');
	}

	/*if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "INSERT INTO papelera SELECT*FROM employees WHERE id = '$id';
		        DELETE FROM employees WHERE id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Empleado eliminado con éxito';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Seleccione el elemento para eliminar primero';
	}

	header('location: employee.php');*/
	
?>