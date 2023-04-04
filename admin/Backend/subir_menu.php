<?php
//Ahora se muestran las imagenes en la pagina y son guardadas en la BD



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
            echo '<script> window.location="../add_img_menu.php";</script>'; 
        }
        else{
            die("Error".mysqli_error($conn));
        }
      }
    }
}
?>
