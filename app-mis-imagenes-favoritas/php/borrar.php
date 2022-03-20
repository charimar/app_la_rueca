<?php
require "conexion.php";
 if(isset($_POST["borrar"])){

    $id = $_POST["borrar"];

    $sql5 = "DELETE FROM `imagenes` WHERE `imagenes`.`id_imagen` = $id";
    $resultado5 = mysqli_query($conexion, $sql5);
        if (!$resultado5) {

            die("no hay resultado de la consulta" . mysqli_error($conexion));

        } else {
            unset($_POST["borrar"]);
            header("Location:../gestor.php?mensaje=Imagen borrada");
            mysqli_free_result($resultado5);
            mysqli_close($conexion);
        }
}
else {
    die("No hay datos");
}
?>