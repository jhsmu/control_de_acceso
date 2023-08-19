<?php 
    include './Database/conexion.php';

    $consulta = $DB_con->prepare("SELECT COUNT(*) FROM colaboradores"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición
    $colaboradores = $consulta->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

    $consulta1 = $DB_con->prepare("SELECT COUNT(*) FROM estudiante"); // Traduzco mi petición
    $consulta1->execute(); //Ejecuto mi petición
    $estudiantes = $consulta1->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

    
    $consultaEntrada = $DB_con->prepare("SELECT COUNT(*) as total_entrada FROM ingreso WHERE fechaingreso IS NOT NULL");
    $consultaEntrada->execute();
    $resultadoEntrada = $consultaEntrada->fetch(PDO::FETCH_ASSOC);
    $totalEntrada = $resultadoEntrada['total_entrada'];

    $consultaSalida = $DB_con->prepare("SELECT COUNT(*) as total_salida FROM ingreso WHERE fechasalida IS NOT NULL");
    $consultaSalida->execute();
    $resultadoSalida = $consultaSalida->fetch(PDO::FETCH_ASSOC);
    $totalSalida = $resultadoSalida['total_salida'];

   
    // Realizar consulta para obtener las carreras
    $consultar = "SELECT * FROM carrera";
    $consulta2 = $DB_con->prepare($consultar);
    $consulta2->execute();
    $carreras = $consulta2->fetchAll(PDO::FETCH_ASSOC);

    // Realizar consulta para obtener los cargos
    $consultar1 = "SELECT * FROM cargo";
    $consulta3 = $DB_con->prepare($consultar1);
    $consulta3->execute();
    $cargos = $consulta3->fetchAll(PDO::FETCH_ASSOC);

    // Combina los datos de carreras y cargos en un único arreglo
    $datosCombinados = array_merge($carreras, $cargos);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <!-- link de estilo de encabezado -->
    <link rel="stylesheet" href="./css/header.css">
    <!-- Link de stilo de las card -->
    <link rel="stylesheet" href="./css/contador.css">
    <title>Control De Acceso</title>
    <!-- Enlace para descargar Chart.js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/justgage@1.4.0/justgage.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
     <!-- link de generador de QR -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



</head>
<body>
    
    <!-- Inicio de encabezado -->
        <header>
            <?php include './componentes/header.php' ?>
        </header>
    <!-- Fin de encabezado -->

    <!--  inicio contadore -->
   <div class="container">
    <div class="contenido mt-3">
     <div class="d-flex flex-column flex-md-row flex-lg-row">
            <!-- Tarjeta para el total de colaboradores -->
            <div class="card">
                <div class="card-body">
                        <h5 class="card-title">Total Colaboradores</h5>
                        <!-- Agregar un elemento canvas para mostrar el Gauge Chart de colaboradores -->
                        <div id="gaugeColaboradores" style="width: 200px; height: 150px;"></div>
                    </div>
            </div>

            <!-- Tarjeta para el total de estudiantes -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Estudiantes</h5>
                    <!-- Agregar un elemento canvas para mostrar el Gauge Chart de estudiantes -->
                    <div id="gaugeEstudiantes" style="width: 200px; height: 150px;"></div>
                    
                </div>
            </div>

            <!-- Tarjeta para el total de entradas -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Entradas</h5>
                    <!-- Agregar un elemento canvas para mostrar el Gauge Chart de entradas -->
                    <div id="gaugeEntradas" style="width: 200px; height: 150px;"></div>
                </div>
            </div>

            <!-- Tarjeta para el total de salidas -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Salidas</h5>
                    <!-- Agregar un elemento canvas para mostrar el Gauge Chart de salidas -->
                    <div id="gaugeSalidas" style="width: 200px; height: 150px;"></div>
                </div>
            </div>

        </div>
     </div>
        
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Agregar el script para configurar el Gauge Chart -->
<script>
    // Datos de los Gauge Charts obtenidos de las variables de PHP
    var datosColaboradores = <?php echo $colaboradores[0]; ?>;
    var datosEstudiantes = <?php echo $estudiantes[0]; ?>;
    var datosEntradas = <?php echo $totalEntrada; ?>;
    var datosSalidas = <?php echo $totalSalida; ?>;

    // Configuración de los Gauge Charts
    var configColaboradores = {
        id: 'gaugeColaboradores',
        value: datosColaboradores,
        min: 0,
        max: 100, // Puedes ajustar el valor máximo según tus necesidades
        title: 'Colaboradores',
        label: 'Cantidad',
        gaugeWidthScale: 0.9, // Ancho del medidor (0.0 a 1.0)
        valueFontColor: '#F7C04A',
        levelColors: ['#F7C04A'],
        valueMinFontSize: 55,
        titleMinFontSize: 16
    };

    var configEstudiantes = {
        id: 'gaugeEstudiantes',
        value: datosEstudiantes,
        min: 0,
        max: 100, // Puedes ajustar el valor máximo según tus necesidades
        title: 'Estudiantes',
        label: 'Cantidad',
        gaugeWidthScale: 0.9, // Ancho del medidor (0.0 a 1.0)
        valueFontColor: '#0E5F76',
        levelColors: ['#0E5F76'],
        valueMinFontSize: 55,
        titleMinFontSize: 16
    };

    var configEntradas = {
        id: 'gaugeEntradas',
        value: datosEntradas,
        min: 0,
        max: 100, // Puedes ajustar el valor máximo según tus necesidades
        title: 'Entradas',
        label: 'Cantidad',
        gaugeWidthScale: 0.9, // Ancho del medidor (0.0 a 1.0)
        valueFontColor: '#1A5D1A',
        levelColors: ['#1A5D1A'],
        valueMinFontSize: 55,
        titleMinFontSize: 16
    };

    var configSalidas = {
        id: 'gaugeSalidas',
        value: datosSalidas,
        min: 0,
        max: 100, // Puedes ajustar el valor máximo según tus necesidades
        title: 'Salidas',
        label: 'Cantidad',
        gaugeWidthScale: 0.9, // Ancho del medidor (0.0 a 1.0)
        valueFontColor: '#FF0000',
        levelColors: ['#FF0000'],
        valueMinFontSize: 55,
        titleMinFontSize: 16
    };

    // Crear los Gauge Charts
    var gaugeColaboradores = new JustGage(configColaboradores);
    var gaugeEstudiantes = new JustGage(configEstudiantes);
    var gaugeEntradas = new JustGage(configEntradas);
    var gaugeSalidas = new JustGage(configSalidas);
</script>

</body>
</html>