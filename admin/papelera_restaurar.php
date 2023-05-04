<?php
	include 'includes/session.php';

	if(isset($_POST['restaurar'])){
		$id = $_POST['id'];
		// Sentencia SQL para seleccionar los datos que deseas volver a insertar en la tabla empleados
		$sqlSelect = "SELECT * FROM papelera WHERE id = '$id'";
		// Ejecutar la consulta de selección
		$resultSelect = $conn->query($sqlSelect);
		// Verificar si se obtuvieron resultados
		if ($resultSelect->num_rows > 0) {
			// Sentencia SQL para insertar los datos seleccionados en la tabla empleados
			$sqlInsert = "INSERT INTO employees SELECT * FROM papelera WHERE id = '$id'";
			// Ejecutar la consulta de inserción
			if ($conn->query($sqlInsert) === TRUE) {
				$_SESSION['success'] = 'Empleado restaurado con éxito';
			} else {
				$_SESSION['error'] = $conn->error;
			}
			// Sentencia SQL para eliminar los datos de la tabla papelera
			$sqlDelete = "DELETE FROM papelera WHERE id = '$id'";
			// Ejecutar la consulta de eliminación
			if ($conn->query($sqlDelete) === TRUE) {
				$_SESSION['success'] = 'Empleado eliminado con éxito';
			} else {
				$_SESSION['error'] = $conn->error;
			}
			header('location: papelera.php');
		} else {
			$_SESSION['error'] = 'No se encontraron datos en la tabla employees con el ID ' . $id;
			header('location: papelera.php');
		}
	} else {
		$_SESSION['error'] = 'Seleccione el elemento para eliminar primero';
		header('location: papelera.php');
	}
    	
?>