<?php
include './Database/conexion.php'; // Asegúrate de incluir la conexión a la base de datos

if (isset($_POST["id"]) && isset($_POST["estado"])) {
    $idColaborador = $_POST["id"];
    $nuevoEstado = $_POST["estado"];

    // Actualizar el estado en la base de datos
    $actualizarEstado = "UPDATE colaboradores SET estado_colaborador = :nuevoEstado WHERE id = :id";
    $consultaActualizar = $DB_con->prepare($actualizarEstado);
    $consultaActualizar->bindParam(":nuevoEstado", $nuevoEstado);
    $consultaActualizar->bindParam(":id", $idColaborador);

    if ($consultaActualizar->execute()) {
        echo "success"; // Devuelve 'success' en caso de éxito
    } else {
        echo "error"; // Devuelve 'error' en caso de error
    }
} else {
    // Parámetros faltantes
    echo "Parámetros inválidos";
}
?>