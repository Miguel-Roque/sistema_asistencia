<?php
	include 'includes/session.php';

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sqlDelete = "DELETE FROM papelera WHERE id = '$id'";
        if($conn->query($sqlDelete)){ 
                $_SESSION['success'] = 'Empleado eliminado definitivamente';
        } else {
                $_SESSION['error'] = $conn->error;
        }
            header('location: papelera.php');
    }
        else{
            $_SESSION['error'] = 'Select item to delete first';
        }
    

	header('location: papelera.php');
	
?>
