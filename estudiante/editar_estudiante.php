<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../database/conexion.php';

$id = $_GET["id"];

$consulta = $DB_con->prepare("SELECT * FROM estudiante WHERE id=:id");
$consulta->execute(['id' => $id]);
$estudiante = $consulta->fetch(PDO::FETCH_ASSOC);

$consultar = "SELECT * FROM carrera";
$consultaCarreras = $DB_con->prepare($consultar); // Utilizar $connection en lugar de $DB_con
$consultaCarreras->execute();
$carreras = $consultaCarreras->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
     <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <!-- link de estilo de encabezado -->
    <link rel="stylesheet" href="../css/header.css">
    <!-- link estilos de caja y modal-->
    <link rel="stylesheet" href="../css/caja.css">
    <!-- Css de generar_qr -->
    <link rel="stylesheet" href="../css/codigoQR.css"> 
     <!--estilo para formulario  -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- validaciones de java script -->
    <script type='text/javascript' src="../validaciones/validaciones.js"></script>
    <!-- link de sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- script de datatables en bootstrap -->
    <title>Control De Acceso|Estudiantes</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- Agrega el enlace a jQuery y al archivo de scripts JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
</head>
<body>

        <div class="container">
        <div class="formulario row">
            <div class="col-6 p-0">
                <img class="img-fluid" src="../img/images.png" alt="">
            </div>
            <div class="altura col-6">
                <h3 class="mt-2">Editar y GenerarQR Estudiante</h3>
                <form action="./actualizares.php" method="post">
                    <div hidden>
                        <input type="text" name="id" id="id" value="<?php echo $estudiante['id']; ?>">
                    </div>
                    <div class="row pt-2">
                        <div class="col-6">
                            <label for="nombre">Nombres</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $estudiante['nombre']; ?>" placeholder="<?php echo $estudiante['nombre']; ?>" onchange="nombre1()" required >
                        </div>
                        <div class="col-6 pt-2">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido" id="apellido" value="<?php echo $estudiante['apellido']; ?>" placeholder="<?php echo $estudiante['apellido']; ?>" onchange="apellido1()" required >
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-6">
                            <label for="identificacion">Documento</label>
                            <input type="text" name="identificacion" id="identificacion" value="<?php echo $estudiante['identificacion']; ?>" placeholder="<?php echo $estudiante['identificacion']; ?>" onchange="cedula2()" required >
                        </div>
                        <div class="col-6 pt-2">
                            <label for="carrera">Carrera</label>
                            <select class="carrera" name="carrera" id="carrera" required disabled>
                                <option value="">Programa</option>
                                    <?php
                                        foreach ($carreras as $key => $carrera) { 
                                            if ($estudiante["carrera"]==$carrera["id_carrera"]){
                                                    ?>
                                                <option value="<?php echo $carrera["id_carrera"] ?>" selected>
                                                                <?php echo $carrera["nombre"] ?></option>
                                                  <?php
                                                        } else {
                                                    ?>
                                                        <option value="<?php echo $carrera["id_carrera"] ?>">
                                                                <?php echo $carrera["carrera"] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                             </select>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-6">
                            <label for="correo">Correo</label>
                            <input type="text" name="correo" id="correo" value="<?php echo $estudiante['correo']; ?>" placeholder="<?php echo $estudiante['correo']; ?>" onchange="correo1()" required disabled>
                        </div>
                        <div class="col-6 pt-2">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" value="<?php echo $estudiante['telefono']; ?>" placeholder="<?php echo $estudiante['telefono']; ?>" onchange="telefono1()" required >
                        </div>
                    </div>
                    <button type="submit" name="actualizar" class="btn btn-primary mt-2">Actualizar</button>
                    <button type="button" class="btn btn-primary mt-2" onclick="generarCodigoQR()">Generar QR</button>

                    <a href="../estudiantes.php" class="inicio d-block mt-3">Volver al inicio</a>

                </form>
            </div>
        </div>    
    </div>
<!-- Modal para mostrar los códigos QR -->
<div class="modal fade" id="modalCodigosQR" tabindex="-1" aria-labelledby="modalCodigosQRTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCodigosQRTitle">Códigos QR del Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Aquí se mostrarán los códigos QR generados -->
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <!-- Botón Cerrar alineado a la izquierda -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <!-- Botón Imprimir QR alineado a la derecha -->
        <button type="button" class="btn btn-primary " onclick="imprimirCodigosQR()">Imprimir QR</button>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="../validaciones/validaciones.js"></script>
    <script src="../generar/generar.js"></script>

</body>
</html>
