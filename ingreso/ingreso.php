<?php

    require_once '../database/conexion.php';

    if(isset($_POST['ingresar'])){
        $estadoI = 1;
        $estadoS = 2;
        $estado = 3;
        $identificacion = $_POST['indentificacion'];
        $estadoIngreso = $_POST['estado'];



        $consultar = "SELECT * FROM colaboradores WHERE documento = $identificacion";
        $consulta2 = $DB_con->prepare($consultar);
        $consulta2->execute();
        $ingresosC = $consulta2->fetchAll(PDO::FETCH_ASSOC);

        foreach($ingresosC as $key => $ingresoC){
            $id = $ingresoC['id'];
        }

        // Obtener la hora actual
        $hora_actual = new DateTime();

        // Restar 5 horas
        $hora_actual->modify('-7 hours');

        $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores,fechaingreso) VALUES(?, ?)");// Traduzco mi petición
        $guardar = $query->execute([$id, $hora_resta = $hora_actual->format('Y-m-d H:i:s')]);

            if ($guardar2) {
                session_start();
                $_SESSION['error'] = 'registro';
                header("location: ../index.php");
                } else {
                    session_start();
                    $_SESSION['error_1'] = 'registro';
                    header("location: ../index.php");
                }
    }