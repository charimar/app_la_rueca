<?php
include "conexion.php";

$nombre = filter_input(INPUT_POST, "nombre");
$user = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_EMAIL);
$pass = filter_input(INPUT_POST, "pass");



//validamos los campos del formulario
if(!isset($nombre) || !isset($user) || !isset($pass)){

    header('Location: ../registro.php?mensaje=Debe completar todos los campos');
}
else{
 //encriptamos la con traseña
$pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);
//comprobamos si ya existe el usuario (email)
 $sql ="SELECT usuarios.user FROM usuarios WHERE usuarios.user='".$user."';";
 $resExiste = mysqli_query($conexion, $sql);
 $sql_insertar ="INSERT INTO usuarios VALUES (NULL, '".$nombre."', '".$user."', '".$pass_encriptada."', 'images/usuarios/default.png');";
 
    $fila = mysqli_fetch_array( $resExiste , MYSQLI_BOTH);

    if(!$fila){
        //como no existe el usuario, lo insertamos
        $resregistro = mysqli_query($conexion, $sql_insertar);
        header('Location: ../registro.php?mensaje=Usuario registrado con éxito');  
    }
    else{
        //el usuario ya existe
        header('Location: ../registro.php?mensaje=El usuario ya existe, debe intruducir otro correo');  

    }
   
 }


?>