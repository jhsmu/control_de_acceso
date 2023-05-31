<?php

    require_once '../database/conexion.php';

    if(isset($_POST['ingresar'])){
        $pendiente = 1;
        $finalizado = 0;
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

        $consultarC = "SELECT * FROM ingreso WHERE id_colaboradores = $id";
        $consulta = $DB_con->prepare($consultarC);
        $consulta->execute();
        $colaboradores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach($colaboradores as $key => $colaborador){
            $cambio = $colaborador['ingresoEstado'];
        }

            if ($estadoIngreso == 1) {
                $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores,fechaingreso, ingresoEstado) VALUES(?, ?, ?)");// Traduzco mi petición
                $guardar = $query->execute([$id, $hora_resta = $hora_actual->format('Y-m-d H:i:s'), $pendiente]);

                if ($guardar) {
                    session_start();
                    $_SESSION['error'] = 'registro';
                    header("location: ../index.php");
                    } else {
                        session_start();
                        $_SESSION['error_1'] = 'registro';
                        header("location: ../index.php");
                    }

            } else{
                    if ($pendiente == $cambio){
                        $query2 = $DB_con->prepare("UPDATE ingreso SET fechasalida=?, ingresoEstado=? WHERE id_colaboradores=?");// Traduzco mi petición
                        $actualizar = $query2->execute([$hora_resta = $hora_actual->format('Y-m-d H:i:s'), $finalizado, $id]);
                    }
                }
        
                if ($actualizar) {
                    session_start();
                    $_SESSION['error'] = 'registro';
                    header("location: ../index.php");
                    } else {
                        session_start();
                        $_SESSION['error_1'] = 'registro';
                        header("location: ../index.php");
                    }
            }