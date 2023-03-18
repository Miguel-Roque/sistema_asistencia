<?php
include('../includes/conn.php');

/*"UPDATE `imagenes` SET `id`='[value-1]',`nombre`='[value-2]',`imagen`='[value-3]' WHERE 1"*/

$idComunicado = $_POST['id'];
$altText = $_POST['alt_text'];
$imageUrl = $_POST['imgedit'];

$sql = "UPDATE imagenes SET nombre = '$altText', image_url = '$imageUrl' WHERE id = $idComunicado";

if ($conn->query($sql) === TRUE) {
  echo '<script> window.location="../mural.php";</script>';
} else {
  echo "Error al actualizar comunicado " . $conn->error;
}

/*    
    if(copy($ruta,$imagen)){
        $sql="UPDATE imagenes SET nombre = $nombreImg, imagen = $imagen WHERE id ='".$idComunicado."')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo '<script> window.location="../mural.php";</script>';
        }else{
            echo "Error al momento de editar" . $conn->error;
        }
    }*/

?> 