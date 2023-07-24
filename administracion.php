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
    <div class="card bg-danger text-white mb-2 mx-2" style="width: 18rem; height: 6rem;">
    <div class="card-body">
        <p class="card-title text-lg">
            Total De Colaboradores:
        </p>
        <div class="progress-circle">
            <div class="progress-circle-value">
                <?php
                $total_colaboradores = ($colaboradores[0] == null) ? 0 : $colaboradores[0];
                echo $total_colaboradores;
                ?>
            </div>
        </div>
    </div>
</div>


    <div class="card bg-info text-white mb-2 mx-2" style="width: 18rem; height: 6rem;">
        <div class="card-body">
            <p class="card-title text-lg">
                Total De Estudiantes:
            </p>
            <p class="card-text text-2xl">
                <?php if ($total_estudiantes = $estudiantes[0] == null) {
                    echo "0";
                } else {
                    echo $total_estudiantes = $estudiantes[0];
                } ?>
            </p>
        </div>
    </div>

    <div class="card bg-warning text-dark mb-2 mx-2" style="width: 18rem; height: 6rem;">
        <div class="card-body">
            <p class="card-title text-lg">
                Total De Entradas:
            </p>
            <p class="card-text text-2xl">
                <?php if ($totalEntrada == null) {
                    echo "0";
                } else {
                    echo $totalEntrada;
                } ?>
            </p>
        </div>
    </div>

    <div class="card bg-success text-white mb-2 mx-2" style="width: 18rem; height: 6rem;">
        <div class="card-body">
            <p class="card-title text-lg">
                Total De Salidas:
            </p>
            <p class="card-text text-2xl">
                <?php if ($totalSalida == null) {
                    echo "0";
                } else {
                    echo $totalSalida;
                } ?>
            </p>
        </div>
    </div>
</div>
    </div>

   </div>

   <div class="card">
  <div class="card-body">
    <h5 class="card-title">Nombre del Elemento</h5>
    <div class="progress-wrapper">
      <div class="progress-bar"></div>
      <div class="progress-text">
        <span id="progress-number"></span>%
      </div>
    </div>
  </div>
</div>









<script>

const progressBar = document.querySelector('.progress-bar');
const numeroElement = document.getElementById('numero');

const valorProgreso = 75; // Cambia este valor según tus necesidades
const valorNumero = 42; // Cambia este valor según tus necesidades

progressBar.style.transform = `rotate(${valorProgreso * 1.8}deg)`;
numeroElement.textContent = valorNumero;


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>