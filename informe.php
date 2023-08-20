<?php
include './Database/conexion.php';

$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] . " 00:00:00" : '';
$fechaFin = isset($_POST['fechaFin']) ? $_POST['fechaFin'] . " 23:59:59" : '';
$tipoFiltro = isset($_POST['tipoFiltro']) ? $_POST['tipoFiltro'] : '';

if ($tipoFiltro === 'invitados') {
    $consulta = "SELECT invitados.*, genero.nombre AS genero_nombre
    FROM invitados
    LEFT JOIN genero ON invitados.genero = genero.id_genero
    WHERE invitados.fecha BETWEEN :fechaInicio AND :fechaFin";

    try {
        $consulta1 = $DB_con->prepare($consulta);
        $consulta1->bindParam(':fechaInicio', $fechaInicio);
        $consulta1->bindParam(':fechaFin', $fechaFin);
        $consulta1->execute();

        $ingresos = $consulta1->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $consulta = "SELECT ingreso.*, colaboradores.nombre AS nombre_colaborador, colaboradores.apellido AS apellido_colaborador, colaboradores.documento AS documento_colaborador, cargo.nombre AS nombre_cargo, estudiante.nombre AS nombre_estudiante, estudiante.apellido AS apellido_estudiante, estudiante.identificacion AS identificacion_estudiante, carrera.nombre AS nombre_carrera
    FROM ingreso
    LEFT JOIN colaboradores ON ingreso.id_colaboradores = colaboradores.id
    LEFT JOIN cargo ON colaboradores.cargo = cargo.id_cargo
    LEFT JOIN estudiante ON ingreso.id_estudiante = estudiante.id
    LEFT JOIN carrera ON estudiante.carrera = carrera.id_carrera
    WHERE (ingreso.fechaingreso BETWEEN :fechaInicio AND :fechaFin) OR (ingreso.fechasalida BETWEEN :fechaInicio AND :fechaFin)";

    try {
        $consulta1 = $DB_con->prepare($consulta);
        $consulta1->bindParam(':fechaInicio', $fechaInicio);
        $consulta1->bindParam(':fechaFin', $fechaFin);
        $consulta1->execute();
    
        $ingresos = $consulta1->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
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
    <title>Control De Acceso|Entrada/Salida</title>
    <style>
    .no-show {
        display: none;
    }

    .flex-header {
        display: flex;
        justify-content: space-between;
        text-align: left;
    }

    .header-item {
        flex: 1;
    }

    .header-logo {
        width: 100px; /*ajusta esto al tamaño que desees*/
        margin: 0 auto; /*centra la imagen horizontalmente*/
    }

    .header-description {
        margin-top: 25px;
        text-align: center;
    }

    @media print {
        .no-show {
            display: flex;
        }

        .no-print {
            display: none;
        }
    }
</style>



</head>
<body>
    
    <!-- Inicio de encabezado -->
    <header>
        <?php include './componentes/header.php' ?>
    </header>
    <!-- Fin de encabezado -->
    <!-- inicio consultas -->
    <div class="caja">
        <!-- Formulario de filtrado -->
        <div class="posicion">
            <div class="fecha">
                <form action="" method="POST">                    
                    <label for="tipoFiltro">Tipo de Filtro:</label>
                    <select name="tipoFiltro" id="tipoFiltro">
                        <option value="entrada" <?php if ($tipoFiltro === 'entrada') echo 'selected'; ?>>Entrada/Salida</option>
                        <option value="invitados" <?php if ($tipoFiltro === 'invitados') echo 'selected'; ?>>Invitados</option>
                    </select>

                    <label for="fechaInicio">Fecha Inicio</label>
<<<<<<< HEAD
                    <input class="fechaInicio" type="date" name="fechaInicio" id="fechaInicio" value="<?php echo isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : ''; ?>">
                    <label for="fechaFin">Fecha fin</label>
                    <input class="fechaFin" type="date" name="fechaFin" id="fechaFin" value="<?php echo isset($_POST['fechaFin']) ? $_POST['fechaFin'] : ''; ?>">

=======
                    <input class="fechaInicio" type="date" name="fechaInicio" id="fechaInicio" value="<?php echo isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : ''; ?>"> 
                    <label for="fechaFin">Fecha fin</label>
                    <input class="fechaFin" type="date" name="fechaFin" id="fechaFin" value="<?php echo isset($_POST['fechaFin']) ? $_POST['fechaFin'] : ''; ?>"> 
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                    <button type="submit">Filtrar</button>
                    <button onclick="printTable();">Imprimir</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin consultas -->
    <!-- Inicio de tabla -->
<!-- Tabla de resultados -->
<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?php if ($tipoFiltro === 'invitados') : ?>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Identificación</th>
                    <th>Género</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            <?php else : ?>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Identificación</th>
                    <th>Rol</th>
                    <th>Ocupación</th>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php
            foreach ($ingresos as $ingreso) {
                echo "<tr>";
                if ($tipoFiltro === 'invitados') {
                    echo "<td>".$ingreso['nombre']."</td>";
                    echo "<td>".$ingreso['apellido']."</td>";
                    echo "<td>".$ingreso['documento']."</td>";
                    echo "<td>".$ingreso['genero_nombre']."</td>";
                    echo "<td>".$ingreso['descripcion']."</td>";
                    echo "<td>".$ingreso['fecha']."</td>";
                } elseif($tipoFiltro === 'entrada') {
                    echo "<tr>";
                    if (!empty($ingreso['nombre_estudiante'])) {
                        echo "<td>".$ingreso['nombre_estudiante']."</td>";
                        echo "<td>".$ingreso['apellido_estudiante']."</td>";
                        echo "<td>".$ingreso['identificacion_estudiante']."</td>";
                        echo "<td>Estudiante</td>";
                        echo "<td>".$ingreso['nombre_carrera']."</td>";
                    } else {
                        echo "<td>".$ingreso['nombre_colaborador']."</td>";
                        echo "<td>".$ingreso['apellido_colaborador']."</td>";
                        echo "<td>".$ingreso['documento_colaborador']."</td>";
                        echo "<td>Colaborador</td>";
                        echo "<td>".$ingreso['nombre_cargo']."</td>";
                    }
                    echo "<td>".$ingreso['fechaingreso']."</td>";
                    echo "<td>".$ingreso['fechasalida']."</td>";
                    echo "</tr>";
                }
                else{
                    session_start();
                    $_SESSION['incorrecto'] = "no selecciono ninguna opcion";
                    header('location: ./informe.php');
                    exit();
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
    <div id="print-header" class="no-show ">
    <div class="header-item">
        <img class="header-logo" src="./img/logo-fucla.png" alt="Logo">
    </div>
    <div class="header-item">
        <h1>Campus Universitario</h1>
    </div>
<<<<<<< HEAD
=======
    <div id="print-header" class="no-show ">
    <div class="header-item">
        <img class="header-logo" src="./img/logo-fucla.png" alt="Logo">
    </div>
    <div class="header-item">
        <h1>Campus Universitario</h1>
    </div>
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
    <div class="header-item">
        <p>Fecha: <?php echo date("d-m-Y"); ?></p>
    </div>
    <div class="header-description">
        <p>Descripción breve...</p>
    </div>
</div>


<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">

    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                    "lengthMenu": "Mostrar _MENU_"
                },
        "lengthMenu": [5, 10, 25, 50],
        "pageLength":5
            });
        });
        
        function printTable() {
        var printContents = document.getElementById("print-header").outerHTML + document.getElementById("example").outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents ;
        window.print();
        document.body.innerHTML = originalContents;
}

    </script>
</body>
<<<<<<< HEAD
</html>
<?php 

?>
=======
</html>
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
