<?php
        include './Database/conexion.php';

        $consulta = "SELECT * FROM colaboradores";

        $consulta1 = $DB_con->prepare($consulta);
        $consulta1->execute();

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
    <title>Control De Acceso|Colaboradores</title>
</head>
<body>
    
    <!-- Inicio de encabezado -->
        <header>
            <?php include './componentes/header.php' ?>
        </header>
    <!-- Fin de encabezado -->
   <div class="caja" >
        <div class="posicion">
            <select name="cargo" id="">
                <option value="">Seleccione</option>
                <option value="Administrativos" name="administrativo" >Administrativos</option>
                <option value="Profesores" name="profesor" >Profesores</option>
            </select>
        </div>
        <div class="posiciom">
            <button type="submit" name="agregar" data-bs-toggle="modal" data-bs-target="#agregar_colaboradores"> Agregar Colaborador</button>
        </div>
   </div>
    <div class="container">
         <!-- Inicio de tabla -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Identificaciòn</th>
                    <th>Cargo</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($consulta1->rowCount() > 0){
                        $rows = $consulta1->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row){  
                ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nombre"];?></td>
                <td><?php echo $row["apellido"];?></td>
                <td><?php echo $row["documento"]; ?></td>
                <td><?php echo $row["cargo"]; ?></td>
                <td><?php echo $row["telefono"]; ?></td>
                
            </tr>
            <?php
                }
                    }
            ?>
            </tbody>
        </table>
         <!-- fin de tabla -->
    </div>
    <!-- contenedor  -->

    <!-- Modal -->
    <div class="modal fade" id="agregar_colaboradores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Colaborador</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="contenido">
                <form action="">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Nombres</label>
                            <input type="text" name="" id="">
                        </div>
                        <div class="col-6">
                            <label for="">Apellidos</label>
                            <input type="text" name="" id="">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">Numero de documento</label>
                            <input type="text" name="" id="">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="">Cargo</label>
                            <select name="" id="">
                                <option value="">Seleccione</option>
                                <option value="">Administrativo</option>
                                <option value="">Profesor</option>
                            </select>
                        </div>
                        <div class="col-6 mt-3">
                            <label for="">Telefono</label>
                            <input type="text" name="" id="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Agregar</button>
        </div>
        </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>