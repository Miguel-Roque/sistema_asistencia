<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, papelera.id as paid FROM papelera LEFT JOIN position ON position.id=papelera.position_id LEFT JOIN schedules ON schedules.id=papelera.schedule_id LEFT JOIN negocio ON negocio.id=papelera.negocio_id WHERE papelera.id= '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>