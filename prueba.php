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
    $ingresosC = $consulta2->fetchAll(PDO::FETCH_ASSOC);

    if ($consulta2->rowCount() == 0) {
        // No se encontraron registros en la base de datos
        // Redirigir o mostrar mensaje de error al usuario
        header("location: ruta/a/la/pagina/de/error.php");
        exit(); // Terminar la ejecución del script
    }

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

    if ($consulta3->rowCount() == 0) {
        // No se encontraron registros en la base de datos
        // Redirigir o mostrar mensaje de error al usuario
        header("location: ruta/a/la/pagina/de/error.php");
        exit(); // Terminar la ejecución del script
    }

    foreach ($ingresosE as $key => $ingresoE) {
        if ($identificacion == $ingresoE['identificacion']) {
            $id2 = $ingresoE['id'];
            break;
        } else {
            continue;
        }
    }

    // Resto del código...
}
