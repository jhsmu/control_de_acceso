<?php

include './Database/conexion.php';


$consultar = "SELECT * FROM estado_ingreso";
$consulta2 = $DB_con->prepare($consultar);
$consulta2->execute();


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
      <form method="post" action="./ingreso/ingreso.php">
        <!-- USERNAME INPUT -->
        <label for="identifiacion">Indentificacion</label>
        <input type="text" name="indentificacion" placeholder="Digite su Documento">
        <select name="estado" id="">
            <option value="" selected>Seleccione</option>
            <option value="1" selected>Entrada</option>
            <option value="2" selected>Salida</option>
            </select>
        <button type="submit" name="ingresar">Ingreso</button>
        <a href="./loginadmin.php">Administrador</a><br>
        <a href="#">Lectura de ****</a>
      </form>
    </div>
  
  </body>
</html>
<?php 

if (isset($_SESSION["error"])) {
  echo ('<script>Swal.fire({
      title: "Datos incorrectos",
      text: "Los datos ingresados son incorrectos, por favor verifique",
      icon: "info" 
  });
  </script>');
  session_destroy();
}
if (isset($_SESSION["error_1"])) {
  echo ('<script>Swal.fire({
      title: "Datos incorrectos",
      text: "Los datos ingresados son incorrectos",
      icon: "info" 
  });
  </script>');
  session_destroy();
}

?>