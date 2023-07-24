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
      <form  method="post" action="./ingreso/ingreso.php">
        <label for="identifiacion">Indentificacion</label>
        <input type="text" name="indentificacion" placeholder="Digite su Documento">
        <select name="estado" id="estado">
            <option value="" selected>Seleccione</option>
            <option value="1" >Entrada</option>
            <option value="0" >Salida</option>
            </select>
        <button class="boton" type="submit" name="ingresar">Ingreso</button>
        <a href="./invitado.php">Invitado</a><br>
        <a href="./index.php">Lectura de Codigo QR </a>
      </form>
    </div>

    <script src="./validaciones/anima.js"></script>
    
  </body>
</html>
<?php 

if(isset($_SESSION['ingresoAdmin'])){
  echo "<script>
  Swal.fire({
    title: 'Ingrese la contraseña',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Ingresar',
    showLoaderOnConfirm: true,
    preConfirm: (password) => {

      if (password === 'Admin.123') {
        
        window.location.href = './loginadmin.php';
      } else {
        // Mostrar mensaje de error
        Swal.fire('Contraseña incorrecta', '', 'error');
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
</script>";
  unset($_SESSION['ingresoAdmin']);
}

if(isset($_SESSION['ingresoInvitado'])){
  echo "<script>
  Swal.fire({
    title: 'Ingrese la contraseña',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Ingresar',
    showLoaderOnConfirm: true,
    preConfirm: (password) => {

      if (password === 'Admin.123') {
        
        window.location.href = './invitados.php';
      } else {
        // Mostrar mensaje de error
        Swal.fire('Contraseña incorrecta', '', 'error');
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
</script>";
  unset($_SESSION['ingresoInvitado']);
}


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
      icon: 'info',
      title: '¡Ups!',
      text: 'Ya has ingresado al campus, presiona en la opcion de salida'
      });
  </script>";
  unset($_SESSION['registroDoble']);
}

if (isset($_SESSION["Prohibido"])) {
  echo "<script>
  Swal.fire({
      icon: 'error',
      title: '!Ohh lo sentimos¡',
      text: 'Pero no puedes ingresar al campus'
      });
  </script>";
  unset($_SESSION['Prohibido']);
}

?>