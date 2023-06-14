<?php
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['documento'])) {
    $pendiente = 1;
    $finalizado = 0;
    $documento = $_POST['documento'];
    $tipo = $_POST['tipo'];

    // Consultar el documento en la tabla correspondiente (colaboradores o estudiantes)
    if ($tipo == 'colaborador') {
        $consulta = $DB_con->prepare("SELECT * FROM colaboradores WHERE documento = :documento");
        $consulta->bindValue(':documento', $documento);
    } else if ($tipo == 'estudiante') {
        $consulta = $DB_con->prepare("SELECT * FROM estudiante WHERE documento = :documento");
        $consulta->bindValue(':documento', $documento);
    }

    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        $_SESSION['Prohibido'] = 'No eres parte de la institución';
        echo "No eres parte de la institución";
        exit(); // Terminar la ejecución del script
    }

    $hora_actual = new DateTime();
    $hora_actual->modify('-7 hours');
    $hora_resta = $hora_actual->format('Y-m-d H:i:s');

    $id = $registro['id'];

    // Verificar estado de ingreso
    if ($tipo == 'colaborador') {
        $consultaIngreso = $DB_con->prepare("SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id");
        $consultaIngreso->bindValue(':id', $id);
    } else if ($tipo == 'estudiante') {
        $consultaIngreso = $DB_con->prepare("SELECT ingresoEstado FROM ingreso WHERE id_estudiante = :id");
        $consultaIngreso->bindValue(':id', $id);
    }

    $consultaIngreso->execute();
    $ingreso = $consultaIngreso->fetch(PDO::FETCH_ASSOC);

    if ($ingreso) {
        $estadoIngreso = $ingreso['ingresoEstado'];
    }

    if ($estadoIngreso != $pendiente) {
        // Insertar nuevo registro de ingreso
        if ($tipo == 'colaborador') {
            $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
            $query->bindValue(':id', $id);
        } else if ($tipo == 'estudiante') {
            $query = $DB_con->prepare("INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado) VALUES(:id, :fechaingreso, :ingresoEstado)");
            $query->bindValue(':id', $id);
        }

        $query->bindValue(':fechaingreso', $hora_resta);
        $query->bindValue(':ingresoEstado', $pendiente);
        $guardar = $query->execute();

        if ($guardar) {
            $_SESSION['exito'] = 'Ingreso registrado exitosamente';
            echo "Ingreso registrado exitosamente";
            exit();
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            echo "Error al guardar el ingreso";
            exit();
        }
    } else {
        // Actualizar registro de ingreso existente
        if ($tipo == 'colaborador') {
            $query = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
            $query->bindValue(':id', $id);
        } else if ($tipo == 'estudiante') {
            $query = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id");
            $query->bindValue(':id', $id);
        }

        $query->bindValue(':fechasalida', $hora_resta);
        $query->bindValue(':ingresoEstado', $finalizado);
        $actualizar = $query->execute();

        if ($actualizar) {
            $_SESSION['exito'] = 'Salida registrada exitosamente';
            echo "Salida registrada exitosamente";
            exit();
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            echo "Error al guardar la salida";
            exit();
        }
    }
}
?>
