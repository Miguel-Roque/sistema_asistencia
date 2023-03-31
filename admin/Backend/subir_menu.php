<?php
/*
include('../includes/conn.php');

$nombre = $_FILES["imagen"]["name"];
$imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);

// Mover la imagen a la carpeta deseada
move_uploaded_file($_FILES["imagen"]["tmp_name"], "../Backend/randomimg/$nombre");

// Insertar la imagen en la base de datos
$sql = "INSERT INTO imagenes (nombre, imagen) VALUES ('$nombre', '$imagen')";
mysqli_query($conn, $sql);

// Cerrar la conexión
mysqli_close($conn);

// Redirigir al usuario a otra página
header("Location: add_img_menu.php");
*/
include('../includes/conn.php');

if(isset($_FILES['imagen'])){
    $nombre=$_FILES['imagen']['name'];
    $imagen=$_FILES['imagen']['tmp_name'];

    if($_FILES["imagen"]["error"] === 4){
        echo "<script> alert('No hay imagen que añadir'); </script>";
        echo '<script> window.location="../add_img_menu.php";</script>';
    }
    else{
    if(copy($imagen,$nombre)){
        $img_content = file_get_contents($imagen);
        $img_content = mysqli_real_escape_string($conn, $img_content);
        
        $sql="INSERT INTO menu_imagenes(nombre_img,imagen_rdm) VALUES ('$nombre','$img_content')";
        $res=mysqli_query($conn,$sql);
        if($res){
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "../Backend/randomimg/$nombre");
            echo '<script> window.location="../add_img_menu.php";</script>'; 
        }
        else{
            die("Error".mysqli_error($conn));
        }
      }
    }
}
?>
