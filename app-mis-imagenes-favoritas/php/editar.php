<?php
require "conexion.php";
if(isset($_POST["editar"])){
    
   $foto = $_FILES["foto"]["name"];
  $old =$_POST["old"];
  
    $id = $_POST["editar"];
    $titulo = $_POST["titulo"];
 
    
    if (isset($_FILES["foto"])){

        if($_FILES['foto']['name'] != ""){

            move_uploaded_file($_FILES["foto"]["tmp_name"], "../images/" . $_FILES["foto"]["name"]);
            $sql4 =  "UPDATE `imagenes` SET `titulo` = '$titulo', 
            `imagen` = '$foto'
            WHERE `imagenes`.`id_imagen` = $id";
            $resultado4 = mysqli_query($conexion, $sql4);
            if (!$resultado4) {
    
                die("no hay resultado de la consulta2" . mysqli_error($conexion));
    
            } else {
               
                //echo "con foto";
              header("Location:../gestor.php?mensaje=Imagen editada");
                mysqli_free_result($resultado4);
               mysqli_close($conexion);
             
            }}
          else{ $sql4 = "UPDATE `imagenes` SET `titulo` = '$titulo', 
            `imagen` = '$old'
            WHERE `imagenes`.`id_imagen` = $id";
        $resultado4 = mysqli_query($conexion, $sql4);
        if (!$resultado4) {

            die("no hay resultado de la consulta2" . mysqli_error($conexion));

        } else {
         
            //echo "sin foto";
           header("Location:../gestor.php?mensaje=Titulo cambiado");
            mysqli_free_result($resultado4);
          mysqli_close($conexion);
        
        }
          }
      
        
        
        }
    
    
    }


?>