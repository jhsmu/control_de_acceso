<?php
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['indentificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultar = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consulta2 = $DB_con->prepare($consultar);
    $consulta2->bindValue(':identificacion', $identificacion);
    $consulta2->execute();
    $ingresoC = $consulta2->fetch(PDO::FETCH_ASSOC);

    $consultar2 = "SELECT * FROM estudiante WHERE identificacion = :identificacion";
    $consulta3 = $DB_con->prepare($consultar2);
    $consulta3->bindValue(':identificacion', $identificacion);
    $consulta3->execute();
    $ingresoE = $consulta3->fetch(PDO::FETCH_ASSOC);

    if (!$ingresoC && !$ingresoE) {
        session_start();
        $_SESSION['Prohibido'] = 'No eres del campu';
        header("location: ../controlacceso.php");
        exit(); // Terminar la ejecución del script
    }

    $estadoI = null;

    if ($ingresoC) {
        $id = $ingresoC['id'];

        // Verificar estado de ingreso
        $consultarC = "SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id";
        $consulta = $DB_con->prepare($consultarC);
        $consulta->bindValue(':id', $id);
        $consulta->execute();
        $colaboradores = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($colaboradores) {
            $estadoI = $colaboradores['ingresoEstado'];
        }
    } else if ($ingresoE) {
        $id2 = $ingresoE['id'];

        // Verificar estado de ingreso
        $consultarE = "SELECT ingresoEstado FROM ingreso WHERE id_estudiante = :id2";
        $consulta4 = $DB_con->prepare($consultarE);
        $consulta4->bindValue(':id2', $id2);
        $consulta4->execute();
        $estudiantes = $consulta4->fetch(PDO::FETCH_ASSOC);

        if ($estudiantes) {
            $estadoI = $estudiantes['ingresoEstado'];
        }
    }

    $hora_actual = new DateTime();
    $hora_actual->modify('-7 hours');
    $hora_resta = $hora_actual->format('Y-m-d H:i:s');

    if ($ingresoC) {
        if ($estadoI != $estadoIngreso) {
            if ($estadoIngreso == 1) {
                // Insertar nuevo registro de ingreso
                $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
                $query->bindValue(':id', $id);
                $query->bindValue(':fechaingreso', $hora_resta);
                $query->bindValue(':ingresoEstado', $pendiente);
                $guardar = $query->execute();

                if ($guardar) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    $_SESSION['exito'] = 'exito al registrar';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            } else {
                // Actualizar registro de ingreso existente
                $query2 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
                $query2->bindValue(':fechasalida', $hora_resta);
                $query2->bindValue(':ingresoEstado', $finalizado);
                $query2->bindValue(':id', $id);
                $actualizar = $query2->execute();

                if ($actualizar) {
                    $_SESSION['salida'] = 'salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    } else if ($ingresoE) {
        if ($estadoI != $estadoIngreso) {
            if ($estadoIngreso == 1) {
                // Insertar nuevo registro de ingreso
                $query3 = $DB_con->prepare("INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado) VALUES(:id2, :fechaingreso, :ingresoEstado)");
                $query3->bindValue(':id2', $id2);
                $query3->bindValue(':fechaingreso', $hora_resta);
                $query3->bindValue(':ingresoEstado', $pendiente);
                $guardar2 = $query3->execute();

                if ($guardar2) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['exito'] = 'exito al registrar';
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            } else {
                // Actualizar registro de ingreso existente
                $query4 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id2");
                $query4->bindValue(':fechasalida', $hora_resta);
                $query4->bindValue(':ingresoEstado', $finalizado);
                $query4->bindValue(':id2', $id2);
                $actualizar2 = $query4->execute();

                if ($actualizar2) {
                    $_SESSION['salida'] = 'salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    }
}
