<?php
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="formulario row">
            <div class="col-6 p-0">
                <img class="img-fluid" src="./img/images.png" alt="">
            </div>
            <div class="col-6">
                <h3 class="mt-2">Registro de Invitados</h3>
                <form action="./ingreso/ingresoinvitado.php" method="post">
                    <div class="row pt-2">
                        <div class="col-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" placeholder="Digite sus nombres">
                        </div>
                        <div class="col-6 pt-2">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" placeholder="Digite sus apellidos">
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-6">
                            <label for="cudula">Documento</label>
                            <input type="text" name="documento" placeholder="Digite su numero de documento">
                        </div>
                        <div class="col-6 pt-2">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" placeholder="Digite sus numero de telefono">
                        </div>
                    </div>

                    <div class="form-group pt-2">
                        <label>Género</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="masculino" value="1">
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="femenino" value="2">
                            <label class="form-check-label" for="femenino">Femenino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="otro" value="3">
                            <label class="form-check-label" for="otro">Otro</label>
                        </div>
                    </div>
                    <div class="pt-2">
<<<<<<< HEAD
                        <label for="descripcion">Detelles de su visita</label>
=======
                        <label for="descripcion">A que viene a el campus</label>
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="129" rows="5" style="resize: none;" required></textarea>
                    </div>


                    <button type="submit" name="ingresar" class="btn btn-primary mt-2">Registrar</button>
                    <a href="./index.php" class="d-block mt-2">Volver al inicio</a>

                </form>
            </div>
        </div>    
    </div>


<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php 

    if (isset($_SESSION["exitoInvitado"])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Exito',
        text: 'Registro de Usuario Exitoso' 
        });
    </script>";
    unset($_SESSION['exitoInvitado']);
  }

  if (isset($_SESSION["errorInvitado"])) {
    echo "<script>
    Swal.fire({
        icon: 'Error',
        title: 'Error',
        text: 'Algo salio mal en el proceso' 
        });
    </script>";
    unset($_SESSION['errorInvitado']);
  }

?>