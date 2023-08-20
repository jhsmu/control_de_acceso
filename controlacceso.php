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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      <form method="post" action="./ingreso/ingreso.php">
        <label for="identificacion">Identificación</label>
        <input type="text" name="identificacion" placeholder="Digite su Documento">
        <select name="estado" id="estado">
            <option value="" selected>Seleccione</option>
            <option value="1">Entrada</option>
            <option value="0">Salida</option>
        </select>
        <button class="boton" type="submit" name="ingresar">Ingreso</button>
        <a href="./index.php">Lectura de Código QR</a>
    </form>

    </div>

    <script src="./validaciones/anima.js"></script>
    <script>
$(document).ready(function () {
    <?php
<<<<<<< HEAD
    if (isset($_SESSION['lastInsertId']) && isset($_SESSION['nombrePersona'])) {
    ?>
    var lastInsertId = <?php echo $_SESSION['lastInsertId']; ?>;
    var nombrePersona = "<?php echo $_SESSION['nombrePersona']; ?>";
    
    function verificarToken() {
        Swal.fire({
            title: "Por favor Ingrese el token de verificación para <strong>" + nombrePersona + "</strong>",
=======
    if (isset($_SESSION['lastInsertId'])) {
    ?>
    var lastInsertId = <?php echo $_SESSION['lastInsertId']; ?>;
    
    function verificarToken() {
        Swal.fire({
            title: 'Ingresa el token de verificación',
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Verificar',
            showLoaderOnConfirm: true,
            preConfirm: (token) => {
                return $.ajax({
                    type: "POST",
                    url: "./verificar_token.php", // Archivo PHP que verificará el token
                    data: { token: token, idUsuario: lastInsertId },
                })
                .then(function(response) {
                    response = response.trim(); // Eliminar espacios en blanco
                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
<<<<<<< HEAD
                            title: 'Bienvenido/a!',
                            html: "Al campus Universitario Uniclaretiana <strong>" + nombrePersona + "</strong>" 
=======
                            title: 'Bienvenido',
                            text: 'Al campus Universitario Uniclaretiana'
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Token incorrecto',
                            text: 'El token ingresado no es válido'
                        }).then(() => {
                            verificarToken(); // Llamar a la función nuevamente para intentar verificar otro token
                        });
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    icon: 'info',
                    title: 'Verificación cancelada',
                    text: 'Has cancelado la verificación'
                });
            }
        });
    }
    
    verificarToken(); // Llamar a la función para iniciar el proceso de verificación
    <?php
    unset($_SESSION['lastInsertId']);
<<<<<<< HEAD
    unset($_SESSION['nombrePersona']);
=======
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
    }
    ?>
});

</script>


<<<<<<< HEAD

=======
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
    
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

<<<<<<< HEAD

 if (isset($_SESSION["salida"])) {
=======
if (isset($_SESSION['lastInsertId'])) {
  echo "<script> 
    
  </script>";
}
 unset($_SESSION['exito']);
if (isset($_SESSION["salida"])) {
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
  echo "<script>
  Swal.fire({
      icon: 'success',
      title: '¡Hasta la próxima!',
      html: 'Salida exitosa de <strong>{$_SESSION['nombrePersona']}</strong>'
  });
  </script>";
  unset($_SESSION['salida']);
  unset($_SESSION['nombrePersona']);
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

if (isset($_SESSION['UsuarioDeshabilitado'])){
  echo "<script>
  Swal.fire({
      icon: 'warning',
      title: '!Ohh lo sentimos¡',
      text: 'Pero actualmente estas Inhabilitado comunicate con...'
      });
  </script>";
}
unset($_SESSION['UsuarioDeshabilitado'])
?>