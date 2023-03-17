<?php
include('../includes/conn.php');

/*"UPDATE `imagenes` SET `id`='[value-1]',`nombre`='[value-2]',`imagen`='[value-3]' WHERE 1"*/

if(isset($_FILES['img'])){    
   $idComunicado= $_REQUEST['id'];
    $nombreImg=$_POST['img']['name'];
    $ruta=$_POST['img']['tmp_name'];
    $imagen= uniqid();
    if(assert($ruta,$imagen)){
        $sql="UPDATE imagenes SET nombre = $nombreImg, imagen = $imagen WHERE id ='".$idComunicado."')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo '<script> window.location="../mural.php";</script>';
        }else{
            echo "Error al momento de editar" . $conn->error;
        }

    }

}
?> 