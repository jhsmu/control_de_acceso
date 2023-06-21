<?php
        include './Database/conexion.php';

        if(!isset($_POST["carrera"])){
        $consulta = "SELECT estudiante.id, estudiante.nombre, estudiante.apellido, estudiante.identificacion, carrera.nombre as carrera, estudiante.correo, estudiante.telefono FROM estudiante
        INNER JOIN carrera ON estudiante.carrera =  carrera.id_carrera";
        $consulta1 = $DB_con->prepare($consulta);
        $consulta1->execute();
        }else{
        $prueba = $_POST["carrera"];
        $consulta = "SELECT estudiante.id, estudiante.nombre, estudiante.apellido, estudiante.identificacion, carrera.nombre as carrera, estudiante.correo, estudiante.telefono FROM estudiante
        INNER JOIN carrera ON estudiante.carrera =  carrera.id_carrera WHERE carrera = :carrera";
        $consulta1 = $DB_con->prepare($consulta);
        $consulta1 -> bindParam(":carrera",$prueba);
        $consulta1->execute();
        }

        $consultar = "SELECT * FROM carrera";
        $consulta2 = $DB_con->prepare($consultar);
        $consulta2->execute();

        $carreras = $consulta2->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="./css/header.css">
    <!-- link estilos de caja y modal-->
    <link rel="stylesheet" href="./css/caja.css">
    <!-- Css de generar_qr -->
    <link rel="stylesheet" href="./css/codigoQR.css">    
    <!-- validaciones de java script -->
    <script type='text/javascript' src="./validaciones/validaciones.js"></script>
    <!-- link de sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- script de datatables en bootstrap -->
    <title>Control De Acceso|Estudiantes</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    
</head>
<body>
    
    <!-- Inicio de encabezado -->
        <header>
            <?php include './componentes/header.php' ?>
        </header>
    <!-- Fin de encabezado -->
    <div class="caja">
        <div class="posicion">
            <form action="" method="post">
            <select name="carrera" id="" onchange="cambio()">
                <option value="" selected>Seleccione</option>
                <?php
                    foreach ($carreras as $key => $carrera){     
                ?>
                <option value="<?php echo $carrera["id_carrera"]; ?>"><?php echo $carrera["nombre"]; ?></option>
                <?php
                    }                
                ?>
            </select>
            <button type="submit" hidden id="buton"></button>
            </form>
        </div>
        <div class="todo">
            <div class="posiciom">
            <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#agregar_estudiante"> Agregar Estudiante</button>
            </div>
            <div class="posiciom1">
                <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#generar_qr"> Generar Codigo QR</button>
            </div>
        </div>

   </div>
    <!-- Inicio de tabla -->
    <div class="container">
     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Identificaciòn</th>
                <th>Carrera</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>

                <?php
                    // if()
                    if($consulta1->rowCount() > 0){
                        $rows = $consulta1->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row){  
                ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nombre"];?></td>
                <td><?php echo $row["apellido"];?></td>
                <td><?php echo $row["identificacion"]; ?></td>
                <td><?php echo $row["carrera"]; ?></td>
                <td><?php echo $row["correo"]; ?></td>
                <td><?php echo $row["telefono"]; ?></td>
                
            </tr>
            <?php
                }
                    }
            ?>
            </tbody>
        
    </table>
</div>

<!-- Inicio modal -->
<!-- Modal -->
<div class="modal fade" id="agregar_estudiante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Colaborador</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="contenido">
                <form action="./agregar/agregarestudiante.php" method="post">
                    <div class="row">
                        <div class="col-6">
                            <label for="nombre">Nombres</label>
                            <input type="text" name="nombre" id="nombre" onchange="nombre1()">
                        </div>
                        <div class="col-6">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido" id="apellido" onchange="apellido1()">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="identificacion">Numero de documento</label>
                            <input type="text" name="identificacion" id="identificacion" onchange="cedula2()">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="carrera">Carrera</label>
                            <select name="carrera" id="carrera" required>
                            <option value="">Seleccione</option>
                            <?php
                                foreach ($carreras as $key => $carrera){     
                            ?>
                            <option value="<?php echo $carrera["id_carrera"]; ?>"><?php echo $carrera["nombre"]; ?></option>
                            <?php
                                }                
                            ?>
                            </select>
                        </div>
                        <div class="col-6 mt-3">
                            <label for="correo">Correo</label>
                            <input type="text" name="correo" id="correo" onchange="correo1()">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" onchange="telefono1()">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
        <!-- fin del modal agregar colaborador -->

    <!-- Inicio de modal Generar Codigo QR -->
    <div class="modal" id="generar_qr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generar Codigo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <select name="carrera" id="carreraSelect">
                            <option value="">Seleccione</option>
                            <?php
                                foreach ($carreras as $key => $carrera){     
                            ?>
                            <option value="<?php echo $carrera["id_carrera"]; ?>"><?php echo $carrera["nombre"]; ?></option>
                            <?php
                                }                
                            ?>
        </select>        

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="generarCodigosQR()">Generar</button>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- fin de modal de generar_qr -->

<!-- Modal para mostrar los códigos QR -->
<div class="modal fade" id="modalCodigosQR" tabindex="-1" role="dialog" aria-labelledby="modalCodigosQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCodigosQRLabel">Códigos QR</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
          <!-- Los códigos QR generados se mostrarán aquí -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="imprimirCodigosQR()">Imprimir</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Fin de mostrar los codigos QR -->

<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
     <script src="./generar/generarQRes.js"></script>
     <script> 
        function cambio(){
            document.getElementById('buton').click();
        }
</script>
<script>
    $(document).ready(function () {
    $('#example').DataTable({
        "language": {
                        "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                    },
        "lengthMenu": [5, 10, 25, 50],
        "pageLength":5
    });
});
</script>
</body>
</html>
<?php

if (isset($_SESSION['exitoso'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'estudiante agregado exitosamente' 
        });
    </script>";
    unset($_SESSION['exitoso']);
}
if (isset($_SESSION['error'])) {
    echo "<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'No se pudo guardado su informacion verifiquela'
        });
    </script>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['estudianteRepetido'])) {
    echo "<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'El estudian que desea guardar ya esta registrado'
        });
    </script>";
    unset($_SESSION['estudianteRepetido']);
}
if (isset($_SESSION['documentoRepetido'])) {
    echo "<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'El documento ingresado ya existe'
        });
    </script>";
    unset($_SESSION['documentoRepetido']);
}
if (isset($_SESSION['telefonoRepetido'])) {
    echo "<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'El telefono ya existe'
        });
    </script>";
    unset($_SESSION['telefonoRepetido']);
}

if (isset($_SESSION['correoRepetido'])) {
    echo "<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'El telefono ya existe'
        });
    </script>";
    unset($_SESSION['correoRepetido']);
}
?>
