<?php 
    include './Database/conexion.php';

    $consulta = $DB_con->prepare("SELECT COUNT(*) FROM colaboradores"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición
    $colaboradores = $consulta->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

    $consulta1 = $DB_con->prepare("SELECT COUNT(*) FROM estudiante"); // Traduzco mi petición
    $consulta1->execute(); //Ejecuto mi petición
    $estudiantes = $consulta1->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

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
    <!-- link de estilo Contador  -->
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
    <div class="contenido">
    <div class="d-flex flex-column flex-md-row flex-lg-row">
    <div class="card bg-danger text-white mb-2 mx-2" style="width: 18rem; height: 6rem;">
        <div class="card-body">
            <p class="card-title text-lg">
                Total De Colaboradores:
            </p>
            <p class="card-text text-2xl">
                <?php if ($total_colaboradores = $colaboradores[0] == null) {
                    echo "0";
                } else {
                    echo $total_colaboradores = $colaboradores[0];
                } ?>
            </p>
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
                Total De Entradas/Salidas:
            </p>
            <!-- <p class="card-text text-2xl">
                <php if ($total_usuarios = $usuarios[0] == null) {
                    echo "0";
                } else {
                    echo $total_usuarios = $usuarios[0];
                } ?>
            </p> -->
        </div>
    </div>

    <div class="card bg-success text-white mb-2 mx-2" style="width: 18rem; height: 6rem;">
        <div class="card-body">
            <p class="card-title text-lg">
                Total de Productos:
            </p>
            <!-- <p class="card-text text-2xl">
                <php echo $total_productos = $productos[0]; ?>
            </p> -->
        </div>
    </div>
</div>
    </div>

   </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>