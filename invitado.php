<?php
include './Database/conexion.php';

if (!isset($_POST["genero"])) {
<<<<<<< HEAD
    $consulta = "SELECT invitados.nombre, invitados.apellido, invitados.documento, genero.nombre as genero, invitados.descripcion, invitados.telefono , invitados.fecha FROM invitados
=======
    $consulta = "SELECT invitados.nombre, invitados.apellido, invitados.documento, genero.nombre as genero, invitados.descripcion, invitados.telefono FROM invitados
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                 INNER JOIN genero ON invitados.genero = genero.id_genero";
    $consulta1 = $DB_con->prepare($consulta);
    $consulta1->execute();
} else {
    $prueba = $_POST["genero"];
<<<<<<< HEAD
    $consulta = "SELECT invitados.nombre, invitados.apellido, invitados.documento, genero.nombre as genero, invitados.descripcion, invitados.telefono , invitados.fecha FROM invitados
=======
    $consulta = "SELECT invitados.nombre, invitados.apellido, invitados.documento, genero.nombre as genero, invitados.descripcion, invitados.telefono FROM invitados
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                 INNER JOIN genero ON invitados.id_genero = genero.id_genero WHERE genero.id_genero = :genero";
    $consulta1 = $DB_con->prepare($consulta);
    $consulta1->bindParam(":genero", $prueba);
    $consulta1->execute();
}

$consultar = "SELECT * FROM genero";
$consulta2 = $DB_con->prepare($consultar);
$consulta2->execute();

$generos = $consulta2->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- script de datatables en bootstrap -->
    <title>Control De Acceso|Estudiantes</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
     <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
<<<<<<< HEAD
                <option value="" >Seleccione</option>
=======
                <option value="" selected>Programas</option>
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
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
                <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#generar_qr"> Generar Codigo QR</button>
            </div>
        </div>
   </div>

    <!-- Inicio de tabla -->
    <div class="container">
     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Identificaciòn</th>
                <th>Telefono</th>
                <th>Genero</th>
                <th>Descripcion</th>
<<<<<<< HEAD
                <th>Fecha</th>
=======
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
            </tr>
        </thead>
        <tbody>
    <?php
    if ($consulta1->rowCount() > 0) {
      $rows = $consulta1->fetchAll(PDO::FETCH_ASSOC);
      $filaIndex = 0;

      foreach ($rows as $row) {
        $filaClass = $filaIndex % 2 == 0 ? 'tabla-filas' : '';

        echo '<tr class="' . $filaClass . '">';
        echo '<td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["apellido"] . '</td>';
        echo '<td>' . $row["documento"] . '</td>';
        echo '<td>' . $row["telefono"] . '</td>';
        echo '<td>' . $row["genero"] . '</td>';
<<<<<<< HEAD
        echo '<td>' . $row["descripcion"] . '</td>'; 
        echo '<td>' . $row["fecha"] . '</td>';
=======
        echo '<td>' . $row["descripcion"] . '</td>';
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
        echo '</tr>';

        $filaIndex++;
      }
    }
    ?>
  </tbody>
        
    </table>
</div>

    <!-- Inicio de modal Generar Codigo QR -->
    <div class="modal" id="generar_qr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generar Código QR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Por favor, registre los datos del tutor</p>
        <div class="contenido">
          <form action="" id="formularioTutor" method="post">
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
                <label for="identificacion">Número de documento</label>
                <input type="text" name="identificacion" id="identificacion" onchange="cedula2()">
              </div>
              <div class="col-6 mt-3">
                <label for="institucion">Institución Educativa</label>
                <input type="text" name="institucion" id="institucion" onchange="telefono1()">
              </div>
              <div class="col-6 mt-3">
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" onchange="correo1()">
              </div>
              <div class="col-6 mt-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" onchange="telefono1()">
              </div>
              <div class="col-6 mt-3">
                <label for="archivo">Archivo Excel</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx, .xls">
              </div>
            </div>
          </form>
        </div>

        <div id="qr-container"></div>
        <div id="qr-info"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGenerarQR">Generar</button>
      </div>
    </div>
  </div>
</div>

<!-- fin de modal de generar_qr -->

<!-- Modal para mostrar los códigos QR -->
<div class="modal fade" id="modalMostrarQR" tabindex="-1" role="dialog" aria-labelledby="modalMostrarQRLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalMostrarQRLabel">Códigos QR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Aquí se mostrarán los códigos QR generados -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="imprimirCodigosQR()">Imprimir</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
     <!-- <script src="./generar/generarQRin.js"></script> -->
    <script src="./generar/generarQRin.js"></script>
    <script src="./impresion/impresion.js"></script>
     <script> 
        function cambio(){
            document.getElementById('buton').click();
        }
    </script>
<script>
    $(document).ready(function () {
    $('#example').DataTable({
        "language": {
                        "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                        "lengthMenu": "Mostrar _MENU_"
                    },
        "lengthMenu": [5, 10, 25, 50],
        "pageLength":5
    });
});
</script>
</body>
</html>
