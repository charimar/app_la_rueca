<?php
include "php/header.php"
?>

<section class="registro">
    <div>
    <div class="mb-3">
    <h2 class="blanco text-center lh-lg">Bienvenid@ a la aplicación <br>Mis imágenes favoritas</h2>
</div>
    <form class="formulario" action="./php/form_login.php" method="post">
        <div class="text-center">
        <img class="mini rounded-circle" src="./images/usuarios/default.png" alt="">
    </div>
        <div class="mb-3">
    <label class="form-label">Usuario</label>
    <input type="email" class="form-control" name="usuario" id="" placeholder="nombre@correo.es" required>
  </div>

  <div class="mb-3"> 
 <label for="inputPassword5" class="form-label">Contraseña</label>
<input type="password" name="pass" id="" required class="form-control" >
</div>

    <div class="text-center mb-2">
    <button type="submit" class="btn btn-primary">Enviar</button>
   
    </form>
<div class="acceso_reg mt-3"><a href="registro.php">Si no tienes cuenta registrate aquí</a></div>

<section>
<p class="respuesta mt-2"><?php 
    $mensaje="";
    if(isset($_GET["mensaje"])){
        $mensaje= $_GET["mensaje"];
    }
    echo $mensaje;?></p>
    </div>
</section></section>
<?php
include "php/footer.php"
?>
