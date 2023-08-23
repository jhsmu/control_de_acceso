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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
      <form method="post" action="">
        <div style="display: flex; justify-content: center; align-items: center;">
        <video src="" id="video" width="85%" height="75%" ></video>
        </div>
        <label for="estado"></label>
        <select name="estado" id="estado">
            <option value="" selected>Seleccione</option>
            <option value="1" >Entrada</option>
            <option value="0" >Salida</option>
        </select>
        <a href="./controlacceso.php">Control de Acceso</a>
      </form>
    </div>


    <script src="./validaciones/anima.js"></script>
    <script src="./validaciones/camara.js"></script>
    <!-- Agrega esta etiqueta script antes de tu script PHP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
  <script>
$(document).ready(function () {
    <?php
    if (isset($_SESSION['lastInsertId']) ) {
    ?>
    var lastInsertId = <?php echo $_SESSION['lastInsertId']; ?>;    
    function verificarToken() {
        Swal.fire({
            title: "Por favor Ingrese el token de verificación",
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
                            title: 'Bienvenido/a!',
                            html: "Al campus Universitario Uniclaretiana" 
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
    }
    ?>
});

</script>


  </body>

</html>