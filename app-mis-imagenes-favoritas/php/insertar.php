<?php
//INSERTAR IMÁGANES
require "conexion.php";
if (isset($_POST["usuario"])){

    $titulo = $_POST["titulo"];
    $foto = $_FILES["foto"]["name"];
    $usuario = $_POST["usuario"];

    if ($_FILES['foto']['name'] != "") {
        //$_FILES["foto"]["type"] == "image/jpeg"
        
        if ($_FILES["foto"]["size"] < 3145728) {
            if(move_uploaded_file($_FILES["foto"]["tmp_name"], "../images/" . $_FILES["foto"]["name"])){
              $sql3 = "INSERT INTO imagenes (id_imagen, id_usuario, imagen, titulo)
       VALUES (NULL, '$usuario', '$foto', '$titulo')";
            
            $resultado3 = mysqli_query($conexion, $sql3);
                if (!$resultado3) {

                die("no hay resultado de la consulta" . mysqli_error($conexion));

                 } 
                 else {
                unset($_POST["insertar"]);
            
               header("Location:../gestor.php?mensaje=imagen insertada");
               mysqli_free_result($resultado3);
               mysqli_close($conexion);
                }   
            } 
        }
    } 
    else {
            echo "<br>";
            echo "El archivo no existe";
    }
}

?>