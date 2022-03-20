<?php
include "conexion.php";

$user = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_EMAIL);
$pass = $_POST["pass"];



//validamos los campos del formulario
if(!isset($user) || !isset($pass)){

   header('Location: ../login.php?mensaje=Debe completar todos los campos');
}
else{
 
 $sql ="SELECT * FROM usuarios WHERE usuarios.user='".$user."';";
 $resExiste = mysqli_query($conexion, $sql);
 
    $fila = mysqli_fetch_array( $resExiste , MYSQLI_BOTH);
//comprobamos si el usuario exiaste
    if(!$fila){
        //el usuario no existe
        header('Location: ../login.php?mensaje=Usuario incorrecto');  
    }
    else{
        //El usuario existe, entonces comprobamos la contraseña
        if (password_verify($pass, $fila["pass"])) {
            // Abrimos sesion
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }

            // Guardamos datos en la sesión
            $_SESSION['username'] = $fila["alias"];
            $_SESSION['user_id'] = $fila["id_usuario"];
            $_SESSION['user_foto'] = $fila["foto"];
            $_SESSION['user'] = $fila["user"];
            // Redirigimos a la página principal protegida
            header('Location:../gestor.php');
            exit;   
           
            
        } else {
            //La contraseña es incorrecta
            header('Location: ../login.php?mensaje=Contraseña incorrecta '.$fila["pass"]); 
            exit;
        }
        
       

    }
   
 }


?>