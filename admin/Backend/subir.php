<?php


include('../includes/conn.php');

if(isset($_FILES['img'])){
    $nombreImg=$_FILES['img']['name'];
    $ruta=$_FILES['img']['tmp_name'];
    $destino="imagenes/".$nombreImg;
    if(copy($ruta,$destino)){
        $sql="INSERT INTO imagenes(nombre,ruta,imagen) VALUES ('$nombreImg','$destino','$ruta')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo '<script> window.location="../mural.php";</script>';

        }else{
            die("Error".mysqli_error($conn));
        }

    }

}
/*
if(isset($_POST["submit"])){
    $nombreImg = $_POST["name"];
    if($_FILES["img"]["error"] === 4){
        echo
        "<script> alert('La imagen no existe'); </script>";
    }
    else{
        copy($ruta,$destino);
        $nombreArchivo = $_FILES["img"]["name"];
        $tamaño = $_FILES["img"]["size"];
        $ruta = $_FILES["img"]["tmp_name"];

        $formatvalido = ['jpg','jpeg','png','bmp'];
        $imageExtension = explode ('.', $nombreArchivo);
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $formatvalido)){
          echo
          "<script> alert('Imagen no valida'); </script>";
        }
        else if($tamaño > 1000000){
            echo
            "<script> alert('Imagen muy pesada'); </script>";
        }
        else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($ruta, '../Backend/imagenes/'. $newImageName);
            $query = "INSERT INTO imagenes(nombre,ruta,imagen) VALUES('$nombreImg','$ruta','$newImageName')";
            mysqli_query($conn, $query);
            
            header('Location: ../admin/mural.php');
        }
    }
}
*/
/*
include('../includes/conn.php');
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    if($_FILES["img"]["error"] === 4){
        echo
        "<script> alert('La imagen no existe'); </script>";
    }
    else{
        $fileName = $_FILES["imge"]["name"];
        $fileSize = $_FILES["img"]["size"];
        $tmpName = $_FILES["img"]["tmp_name"];

        $validImageExtension = ['jpg','jpeg','png','bmp'];
        $imageExtension = explode ('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $validImageExtension)){
          echo
          "<script> alert('Imagen no valida'); </script>";
        }
        else if($fileSize > 1000000){
            echo
            "<script> alert('Imagen muy pesada'); </script>";
        }
        else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, '../Backend/imagenes'. $newImageName);
            $query = "INSERT INTO imagenes(nombre,ruta,imagen) VALUES('','$name','','$newImageName')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Exitosamente añadido'); 
            document.location.href = 'mural.php';           
            </script>";
        }
    }
}
*/
?>


