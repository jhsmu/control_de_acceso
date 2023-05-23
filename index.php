<!DOCTYPE html>
<html>
  <head>
    <title>Sistema de Control de Acceso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
  </head>
  <body>
    <form method="post" action="registro.php">
        <div class="encabezado">
          <h1>Sistema de Control de Acceso <br>Nuevo Campus Uniclaretiana</h1>
          <img src="https://www.cieasypal.com/sites/default/files/styles/large/public/logo-fucla.png?itok=jVv62Cdt" alt="Logo Uniclaretiana">
        </div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>
        <br>
        <label for="accion">Acción:</label>
        <select name="accion" required>
          <option value="">Seleccione una acción</option>
          <option value="Entrada">Entrada</option>
          <option value="Salida">Salida</option>

          
        </select>
        <br>
        <input type="submit" value="Registrar">
      </form>
  </body>
</html>
