<?php
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/reloj.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Sistema de Control de Acceso</title>
  </head>
  <body>

    <header>

    <?php include './componentes/headeracceso.php' ?>

    </header>

   <div class="login-box">
      <img src="./img/logo-fucla.png" class="avatar" alt="logo fluca">
      <h1>Campus Univerisitario</h1>
      <h3>Uniclaretiana</h3>
      <form method="post" action="./ingreso/ingresoQR.php">
        <div class="contenedorVideo">
        <video src="" id="video" width="100%" height="100%" ></video>
        </div>
        <select name="estado" id="">
            <option value="" selected>Seleccione</option>
            <option value="1" >Entrada</option>
            <option value="0" >Salida</option>
            </select>
        <button class="boton" type="submit" name="ingresar">Ingreso</button>
        <a href="./loginadmin.php" class="mt-2">Administrador</a><br>
        <a href="./controlacceso.php">Control de Acceso</a>
      </form>
    </div>


    <script src="./validaciones/anima.js"></script>
    <script src="./validaciones/camara.js"></script>
    <!-- Agrega esta etiqueta script antes de tu script PHP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
  
  </body>
</html>
<?php 

if (isset($_SESSION["exito"])) {
  echo "<script>
  Swal.fire({
      icon: 'success',
      title: 'Bienvenido',
      text: 'Al campus Universitario Uniclaretiana ' 
      });
  </script>";
  unset($_SESSION['exito']);
}

if (isset($_SESSION["salida"])) {
  echo "<script>
  Swal.fire({
      icon: 'success',
      title: '¡Oh ya te vas!',
      text: 'Hasta la proxima' 
      });
  </script>";
  unset($_SESSION['salida']);
}

if (isset($_SESSION["registroDoble"])) {
  echo "<script>
  Swal.fire({
      icon: 'erro',
      title: '¡Ups!',
      text: 'Ya has ingresado al campus, presiona en la opcion de salida'
      });
  </script>";
  unset($_SESSION['registroDoble']);
}
?>