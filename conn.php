<?php
	$conn = new mysqli('localhost', 'n1m5g3f0_asistencia', 'porsiempre1', 'n1m5g3f0_asistencia');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>