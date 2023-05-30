<?php

    require_once '../database/conexion.php';

    if(isset($_POST['ingresar'])){
        $estadoI = 1;
        $estadoS = 2;
        $estado = 3;
        $identificacion = $_POST['indentificacion'];
        $fechaingreso = date('Y-m-d');

        $consultar = "SELECT * FROM estudiante WHERE identificacion = $identificacion";
        $consulta2 = $DB_con->prepare($consultar);
        $consulta2->execute();
        $ingresosC = $consulta2->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "SELECT * FROM colaboradores WHERE documento = $identificacion";
        $consulta1 = $DB_con->prepare($consulta);
        $consulta1->execute();
        $ingresosE = $consulta1->fetchAll(PDO::FETCH_ASSOC);

        foreach($ingresosC as $key => $ingresoC){
            if($estado == $ingresoC['id_estado']){
                $agregar = "INSERT INTO ingreso(id_colaboradores,fechaingreso) VALUES (:identificacion, :fecha_ingreso)";
                $stmt = $DB_con->prepare($agregar);
                $stmt->bindParam(':identificacion', $identificacion);
                $stmt->bindParam(':fecha_ingreso', $fechaIngreso);
                $stmt->execute();

                $actu = "UPDATE colaboradores SET id_estado WHERE id=:identificacion'";
                $cambio->bindParam('1', $estado);

            }
        }
        if ($cambio->execute()) {
            session_start();
            $_SESSION['error'] = 'registro';
            header("location: ../index.php");
            } else {
                session_start();
                $_SESSION['error_1'] = 'registro';
                header("location: ../index.php");
            }
    }

