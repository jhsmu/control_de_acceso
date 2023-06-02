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
      <form method="post" action="./ingreso/ingreso.php">
        <!-- USERNAME INPUT -->
        <label for="identifiacion">Indentificacion</label>
        <input type="text" name="indentificacion" placeholder="Digite su Documento">
        <select name="estado" id="">
            <option value="" selected>Seleccione</option>
            <option value="1" >Entrada</option>
            <option value="0" >Salida</option>
            </select>
        <button class="boton" type="submit" name="ingresar">Ingreso</button>
        <a href="./loginadmin.php">Administrador</a><br>
        <a href="#">Lectura de ****</a>
      </form>
    </div>
  
  </body>
</html>
<?php 

if (isset($_SESSION["Datos_incorrectos"])) {
  echo "<script>
  Swal.fire({
      icon: 'info',
      title: 'Info',
      text: 'No se pudo guardado su informacion verifiquela'
      });
  </script>";
  unset($_SESSION['Datos_incorrectos']);
}
if (isset($_SESSION["exito"])) {
  echo "<script>
  Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: 'estudiante agregado exitosamente' 
      });
  </script>";
  unset($_SESSION['exito']);
}
if (isset($_SESSION["errorRegistro"])) {
  echo "<script>
  Swal.fire({
      icon: 'info',
      title: 'Info',
      text: 'No se pudo guardado su informacion verifiquela'
      });
  </script>";
  unset($_SESSION['errorRegistro']);
}
?>