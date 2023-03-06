<?php
   $conn = new mysqli('localhost', 'root', '', 'asistencia');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>