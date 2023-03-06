<?php
include('../includes/conn.php');

if(isset($_FILES['img'])){
    $nombreImg=$_FILES['img']['name'];
    $ruta=$_FILES['img']['tmp_name'];
    $destino="imagenes/".$nombreImg;
    if(copy($ruta,$destino)){
        $sql="INSERT INTO imagenes(nombre,ruta) VALUES ('$nombreImg','$destino')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo '<script> window.location="../mural.php";</script>';

        }else{
            die("Error".mysqli_error($conn));
        }

    }

}
?>


