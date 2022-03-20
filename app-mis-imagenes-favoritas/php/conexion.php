<?php
$host = "localhost";
$usuario_bbdd = "root";
$contrasenya ="";
$bbdd ="app-la-rueca";


$conexion = mysqli_connect($host, $usuario_bbdd, $contrasenya, $bbdd);
if(!$conexion){
  echo "Error: No se pudo conectar a la bbdd".PHP_EOL;
  echo mysqli_connect_error().PHP_EOL;
}




?>