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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sistema de Control de Acceso</title>
  </head>
  <body>

  <div class="login-box">
      <img src="./img/logo-fucla.png" class="avatar" alt="logo fluca">
      <h1>Campus Univerisitario</h1>
      <h3>Uniclaretiana</h3>
      <form action="./sesion/iniciarsesion.php" method="post">
        <!-- USERNAME INPUT -->
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" placeholder="Digite su Usuario">
        <label for="clave">Contraseña</label>
        <input type="password" name="clave" placeholder="Digite su Contraseña">
        <input type="submit" name="inicio" value="ingresar">
        <a href="./index.php">Control de Acceso</a><br>
        <a href="#">Lectura de ****</a>
      </form>
    </div>
  
  </body>
</html>
<?php 

if (isset($_SESSION["Datos_incorrectos"])) {
  echo ('<script>Swal.fire({
      title: "Datos incorrectos",
      text: "Los datos ingresados son incorrectos, por favor verifique",
      icon: "error" 
  });
  </script>');
  session_destroy();
}

?>