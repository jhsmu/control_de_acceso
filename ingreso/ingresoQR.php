<?php
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['indentificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultarC = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consultaC = $DB_con->prepare($consultarC);
    $consultaC->bindValue(':identificacion', $identificacion);
    $consultaC->execute();
    $ingresoC = $consultaC->fetch(PDO::FETCH_ASSOC);

    $consultarE = "SELECT * FROM estudiante WHERE identificacion = :identificacion";
    $consultaE = $DB_con->prepare($consultarE);
    $consultaE->bindValue(':identificacion', $identificacion);
    $consultaE->execute();
    $ingresoE = $consultaE->fetch(PDO::FETCH_ASSOC);

    if (!$ingresoC && !$ingresoE) {
        $_SESSION['Prohibido'] = 'No eres del campus';
        header("location: ../controlacceso.php");
        exit(); // Terminar la ejecución del script
    }

    $estadoI = null;
    $id = null;
    $numeroDocumento = null;

    if ($ingresoC) {
        $id = $ingresoC['id'];
        $numeroDocumento = $ingresoC['documento'];

        // Verificar estado de ingreso
        $consultarIngresoC = "SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id";
        $consultaIngresoC = $DB_con->prepare($consultarIngresoC);
        $consultaIngresoC->bindValue(':id', $id);
        $consultaIngresoC->execute();
        $ingresoColaborador = $consultaIngresoC->fetch(PDO::FETCH_ASSOC);

        if ($ingresoColaborador) {
            $estadoI = $ingresoColaborador['ingresoEstado'];
        }
    } elseif ($ingresoE) {
        $id = $ingresoE['id'];
        $numeroDocumento = $ingresoE['identificacion'];

        // Verificar estado de ingreso
        $consultarIngresoE = "SELECT ingresoEstado FROM ingreso WHERE id_estudiante = :id";
        $consultaIngresoE = $DB_con->prepare($consultarIngresoE);
        $consultaIngresoE->bindValue(':id', $id);
        $consultaIngresoE->execute();
        $ingresoEstudiante = $consultaIngresoE->fetch(PDO::FETCH_ASSOC);

        if ($ingresoEstudiante) {
            $estadoI = $ingresoEstudiante['ingresoEstado'];
        }
    }

    $hora_actual = new DateTime();
    $hora_actual->modify('-7 hours');
    $hora_resta = $hora_actual->format('Y-m-d H:i:s');

    if ($estadoI != $estadoIngreso) {
        if ($estadoIngreso == 1) {
            // Insertar nuevo registro de ingreso para colaboradores
            if ($ingresoC) {
                $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
                $query->bindValue(':id', $id);
                $query->bindValue(':fechaingreso', $hora_resta);
                $query->bindValue(':ingresoEstado', $pendiente);
                $guardar = $query->execute();

                if ($guardar) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    $_SESSION['exito'] = 'Éxito al registrar';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }

            // Insertar nuevo registro de ingreso para estudiantes
            if ($ingresoE) {
                $query = $DB_con->prepare("INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
                $query->bindValue(':id', $id);
                $query->bindValue(':fechaingreso', $hora_resta);
                $query->bindValue(':ingresoEstado', $pendiente);
                $guardar = $query->execute();

                if ($guardar) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    $_SESSION['exito'] = 'Éxito al registrar';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            // Actualizar registro de ingreso existente para colaboradores
            if ($ingresoC) {
                $query = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
                $query->bindValue(':fechasalida', $hora_resta);
                $query->bindValue(':ingresoEstado', $finalizado);
                $query->bindValue(':id', $id);
                $actualizar = $query->execute();

                if ($actualizar) {
                    $_SESSION['salida'] = 'Salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }

            // Actualizar registro de ingreso existente para estudiantes
            if ($ingresoE) {
                $query = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id");
                $query->bindValue(':fechasalida', $hora_resta);
                $query->bindValue(':ingresoEstado', $finalizado);
                $query->bindValue(':id', $id);
                $actualizar = $query->execute();

                if ($actualizar) {
                    $_SESSION['salida'] = 'Salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        }
    } else {
        $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
        header("location: ../controlacceso.php");
        exit();
    }
}
?>
