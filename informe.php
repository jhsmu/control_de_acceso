<?php 
    include './Database/conexion.php';
    $consulta = "SELECT * FROM ingreso";
    $consulta1 = $DB_con ->prepare($consulta);
    $consulta1->execute();
    $ingresos=$consulta1->fetchAll(PDO::FETCH_ASSOC);
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
</head>
<body>
    
    <!-- Inicio de encabezado -->
        <header>
            <?php include './componentes/header.php' ?>
        </header>
    <!-- Fin de encabezado -->
    <!-- inicio consultas -->
    <div class="caja" >
        <div class="posicion">
            <div class="fecha">
                <label for="">Fecha Inicio</label>
                <input type="date" name="" id=""> 
            </div>
            <div class="fecha1">
                <label for="">Fecha fin</label>
                <input type="date" name="" id=""> 
            </div>
        </div>
        <div class="todo">
            <div class="posiciom">
                <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#agregar_colaboradores"> Agregar Colaborador</button>
            </div>
            <div class="posiciom1">
                <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#generar_qr"> Generar Codigo QR</button>
            </div>
        </div>
   </div>
    <!-- Fin consultas -->
    <!-- Inicio de tabla -->
    <div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Identificaciòn</th>
                <th>Rol</th>
                <th>Ocupacion</th>
                <th>Fecha de Entrada</th>
                <th>Fecha de Salida</th>
            </tr>
        </thead>
        <Tbody> 

            <?php
                foreach($ingresos as $ket => $ingreso ){
                    
            ?>
                <tr>
                    <?php 
                        if($ingreso['id_estudiante'] != NULL){
                            $consultaE = "SELECT estudiante.id, estudiante.nombre, estudiante.apellido, estudiante.identificacion, carrera.nombre as carrera FROM estudiante 
                            INNER JOIN carrera ON estudiante.carrera =  carrera.id_carrera
                            WHERE id=:id ";
                            $consultaE1 = $DB_con->prepare($consultaE);
                            $consultaE1->bindParam(':id',$ingreso['id_estudiante']);
                            $consultaE1->execute();
                            $estudinate = $consultaE1->fetch(PDO::FETCH_ASSOC);

                            
                    ?>
                    <td><?php echo $estudinate['nombre'];  ?></td>
                    <td><?php echo $estudinate['apellido'];  ?></td>
                    <td><?php echo $estudinate['identificacion'];  ?></td>
                    <td>Estudiante</td>
                    <td><?php echo $estudinate['carrera'];  ?></td>
                    <?php
                        }else{

                            $consultaC = "SELECT colaboradores.nombre, colaboradores.apellido, colaboradores.documento, cargo.nombre as cargo FROM colaboradores 
                            INNER JOIN cargo ON colaboradores.cargo =  cargo.id_cargo
                            WHERE id=:id";
                            $consultaC1 = $DB_con->prepare($consultaC);
                            $consultaC1->bindParam(':id',$ingreso['id_colaboradores']);
                            $consultaC1->execute();
        
                            $colaboradores = $consultaC1->fetch(PDO::FETCH_ASSOC);
                        
                    ?>
                    <td><?php echo $colaboradores['nombre'];  ?></td>
                    <td><?php echo $colaboradores['apellido'];  ?></td>
                    <td><?php echo $colaboradores['documento'];  ?></td>
                    <td>colaborador</td>
                    <td><?php echo $colaboradores['cargo'];  ?></td>
                    <?php
                    } 
                    ?>
                    <td> <?php echo $ingreso['fechaingreso']; ?> </td>
                    <td> <?php echo $ingreso['fechasalida']; ?> </td>
                </tr>
            <?php
                }
            ?>
        </Tbody>
    </table>


    </div>


<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function () {
    $('#example').DataTable({
        "language": {
                        "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                    }
    });
});
</script>
