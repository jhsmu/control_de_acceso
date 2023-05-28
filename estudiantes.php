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
    
        
        // $query3 = $connection->prepare("SELECT * FROM producto
        // INNER JOIN marca ON producto.id_marca =  marca.id_marca
        // WHERE id_categoria=:categoria");
        // $query3->bindParam(":categoria", $_POST["categoria"]);
        // $query3->execute();
        
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
    <!-- link estilos de caja y modal-->
    <link rel="stylesheet" href="./css/caja.css">
    <!-- validaciones de java script -->
    <script type='text/javascript' src="./validaciones/validaciones.js"></script>
    <!-- link de sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Control De Acceso|Estudiantes</title>
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
        <div class="posiciom">
            <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#agregar_estudiante"> Agregar Estudiante</button>
        </div>

   </div>
    <!-- Inicio de tabla -->
    <div class="container">
     <table class="table">

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
                            <select name="carrera" id="carrera">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
<script> 
        function cambio(){
            document.getElementById('buton').click();
        }

</script>