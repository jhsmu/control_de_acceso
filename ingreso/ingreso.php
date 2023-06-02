<?php
require_once '../database/conexion.php';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['indentificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultar = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consulta2 = $DB_con->prepare($consultar);
    $consulta2->bindValue(':identificacion', $identificacion);
    $consulta2->execute();
    $ingresosC = $consulta2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($ingresosC as $key => $ingresoC) {
        if ($identificacion == $ingresoC['documento']) {
            $id = $ingresoC['id'];
            break;
        } else {
            continue;
        }
    }

    $consultar2 = "SELECT * FROM estudiante WHERE identificacion = :identificacion";
    $consulta3 = $DB_con->prepare($consultar2);
    $consulta3->bindValue(':identificacion', $identificacion);
    $consulta3->execute();
    $ingresosE = $consulta3->fetchAll(PDO::FETCH_ASSOC);

    foreach ($ingresosE as $key => $ingresoE) {
        if ($identificacion == $ingresoE['identificacion']) {
            $id2 = $ingresoE['id'];
            break;
        } else {
            continue;
        }
    }

    $prueba = "SELECT * FROM ingreso";
    $prueba1 = $DB_con->prepare($prueba);
    $prueba1->execute();
    $ingri = $prueba1 ->fetchAll(PDO::FETCH_ASSOC);

    foreach($ingri as $key => $ingri1){
        if($id == $ingri1["id_colaboradores"] || $id2 == $ingri1["id_estudiante"]){
            $estadoI = $ingri1['ingresoEstado'];
        }
    }

    $hora_actual = new DateTime();
    $hora_actual->modify('-7 hours');
    $hora_resta = $hora_actual->format('Y-m-d H:i:s');

    if (isset($id)) {
      if($estadoI != $estadoIngreso){
        $consultarC = "SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id";
        $consulta = $DB_con->prepare($consultarC);
        $consulta->bindValue(':id', $id);
        $consulta->execute();
        $colaboradores = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($estadoIngreso == 1) {
            $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
            $query->bindValue(':id', $id);
            $query->bindValue(':fechaingreso', $hora_resta);
            $query->bindValue(':ingresoEstado', $pendiente);
            $guardar = $query->execute();

            if ($guardar) {
                $lastInsertId = $DB_con->lastInsertId(); // Obtener la última ID insertada
                session_start();
                $_SESSION['error'] = 'registro';
                $_SESSION['lastInsertId'] = $lastInsertId; // Guardar la última ID insertada en la sesión
                header("location: ../index.php");
            } else {
                session_start();
                $_SESSION['error_1'] = 'registro';
                header("location: ../index.php");
            }
        } else {
            $query2 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
            $query2->bindValue(':fechasalida', $hora_resta);
            $query2->bindValue(':ingresoEstado', $finalizado);
            $query2->bindValue(':id', $id);
            $actualizar = $query2->execute();

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
      }else{
        session_start();
        $_SESSION['error_1'] = 'registro';
        header("location: ../index.php");
      }
    } else {
        if($estadoI != $estadoIngreso){
        $consultarE = "SELECT ingresoEstado FROM ingreso WHERE id_estudiante = :id2";
        $consulta4 = $DB_con->prepare($consultarE);
        $consulta4->bindValue(':id2', $id2);
        $consulta4->execute();
        $estudiantes = $consulta4->fetch(PDO::FETCH_ASSOC);

        if ($estadoIngreso == 1) {

            $query3 = $DB_con->prepare("INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado) VALUES(:id2, :fechaingreso, :ingresoEstado)");
            $query3->bindValue(':id2', $id2);
            $query3->bindValue(':fechaingreso', $hora_resta);
            $query3->bindValue(':ingresoEstado', $pendiente);
            $guardar2 = $query3->execute();

            if ($guardar2) {
                $lastInsertId = $DB_con->lastInsertId(); // Obtener la última ID insertada
                session_start();
                $_SESSION['error'] = 'registro';
                $_SESSION['lastInsertId'] = $lastInsertId; // Guardar la última ID insertada en la sesión
                header("location: ../index.php");
            } else {
                session_start();
                $_SESSION['error_1'] = 'registro';
                header("location: ../index.php");
            }
         
        } else {
            $query4 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id2");
            $query4->bindValue(':fechasalida', $hora_resta);
            $query4->bindValue(':ingresoEstado', $finalizado);
            $query4->bindValue(':id2', $id2);
            $actualizar2 = $query4->execute();

            if ($actualizar2) {
                session_start();
                $_SESSION['error'] = 'registro';
                header("location: ../index.php");
            } else {
                session_start();
                $_SESSION['error_1'] = 'registro';
                header("location: ../index.php");
            }
        }
    }else{
        session_start();
        $_SESSION['error_1'] = 'registro';
        header("location: ../index.php");
    }
   }
}