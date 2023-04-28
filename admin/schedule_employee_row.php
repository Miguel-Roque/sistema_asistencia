<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT attendance.*, employees.*, position.*, schedules.*, negocio.*, employees.id AS empid 
				FROM attendance
		        RIGHT JOIN employees ON employees.id = attendance.employee_id
				LEFT JOIN position ON position.id = employees.position_id 
				LEFT JOIN schedules ON schedules.id = employees.schedule_id 
				LEFT JOIN negocio ON negocio.id = employees.negocio_id 
				WHERE employees.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		
		echo json_encode($row);
	}
?>
