<?php

function abrir_sesion(){
  // Abrimos la sesión
if( session_status() != PHP_SESSION_ACTIVE ){
  session_start();
  
}
}
abrir_sesion();

// Comprobamos si está definida la variable usuario en la sesión
if( !isset( $_SESSION['username'] ) || empty( $_SESSION['username'])  ){

	session_destroy();
	header('Location:login.php');
	exit;

}


$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$user_foto= $_SESSION['user_foto'];
$user=$_SESSION['user'] ;
require "./php/conexion.php";
include "./php/header.php";
    ?>


<main id="gestor">
 <section class="d-flex justify-content-between align-items-center mb-2">

 <h2 class="blanco col-12">Bienvenid@ <?php echo $username;?></h2>
<a href="./php/cerrar-sesion.php" class="salir">Salir <i class="bi bi-box-arrow-right"></i></a>
</section>
<div class="d-flex  align-items-center mb-5" >
   
    <img src="./<?php echo $user_foto;?>" alt="" class="mini me-3">
    <p class="blanco ">Usuario: <?php echo $user;?></p>
</div>
<?php


$sql = "SELECT * FROM imagenes WHERE imagenes.id_usuario = $user_id";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {

    die("no ha resultado de la consulta" . mysqli_error());
} else {
    ?>
    <div class="d-flex mb-4">
    <h3 class="blanco me-4">Mis imágenes favoritas</h3>
   
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-insertar">
    Insertar imagen nueva <i class="bi bi-plus-circle"></i>
</button>
</div>
<section>
<p class="respuesta ms-5 text-end"><?php 
    /*$mensaje="";
    if(isset($_GET["mensaje"])){
        $mensaje= $_GET["mensaje"];
    }
    echo $mensaje;
    */?></p>
    </div>
</section>
    <!--modal insertar-->
<div class="modal" tabindex="-1" id="modal-insertar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Añadir imagen y titulo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        

<form enctype="multipart/form-data" action="./php/insertar.php" method="POST">

      <div class="mb-3">
  <label for="formFile" class="form-label">Selecciona una imagen (debe ser jpg menor de 3 megas)</label>
  <input class="form-control" type="file" id="foto" name="foto">
  <span class="input-text" id="">Titulo</span>
  <input type="hidden" name="usuario" value="<?php echo $user_id?>">
  <input type="text" class="form-control" aria-label="" aria-describedby="" name="titulo"  required>

</div>


<button type="submit" class="btn btn-primary">Añadir</button>
</form>
      </div>
      
    </div>
  </div>
</div>
<section class="d-flex flex-wrap">
    <?php
    //Empezamos con el bucle
$i=0;
while ($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
    ++$i;
        ?>
    <div class="col-12 col-md-6 col-lg-4 p-2">
    <div class="card">
  <img src="./images/<?php echo $fila["imagen"]?>"  class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $fila["titulo"]?></h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-borrar-<?php echo $i?>">
    <i class="bi bi-trash"></i>
</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-editar-<?php echo $i?>">
<i class="bi bi-pencil-square"></i>
</button>

    </div>
  </div>
</div>
<!--modal borrar-->
<!-- Modal -->
<div class="modal fade" id="modal-borrar-<?php echo $i?>" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Quieres borrar la imagen y el título?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="mb-3">
 
    <img src="./images/<?php echo $fila["imagen"]?>"  class="card-img-top" alt="...">
    <h3><?php echo $fila["titulo"]?></h3>
 <form action="./php/borrar.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="borrar" value="<?php echo $fila["id_imagen"]?>">
</div>
<button type="submit" class="btn btn-primary">Borrar</button>
</form>
      </div>
      
    </div>
  </div>
</div>





<!--modal editar-->
<div class="modal" tabindex="-1" id="modal-editar-<?php echo $i?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar la imagen y el título</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form action="./php/editar.php" enctype="multipart/form-data" method="POST">

      <div class="mb-3">
  <label for="formFile" class="form-label">Selecciona una imagen (debe ser jpg menor de 3 megas)</label>
  <input class="form-control" type="file" id="foto" name="foto">
  <input type="hidden" name="old" value="<?php echo $fila["imagen"]?>" />
  <span class="input-text" id="">Nuevo título</span>
  <input type="text" class="form-control" aria-label="" aria-describedby="" name="titulo" value="<?php echo $fila["titulo"]?>" required>
  <input type="hidden" name="editar" value="<?php echo $fila["id_imagen"]?>">
</div>
<button type="submit" class="btn btn-primary">Editar</button>
</form>
      </div>
     
    </div>
  </div>
</div>

<?php
} //cierra while
} //cierra else
?>
<!--terminamos con el bucle-->



 </main>
 <?php
 include "./php/footer.php";
 ?>
</body>
</html>
