<?php
include './Database/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudianteId = $_POST["id"];
    $nuevoEstado = $_POST["estado"];

    // Consulta SQL para actualizar el estado del estudiante en la base de datos
    $sql = "UPDATE estudiante SET estado_estudiante = :estado WHERE id = :id";
    $consulta = $DB_con->prepare($sql);
    $consulta->bindParam(":estado", $nuevoEstado, PDO::PARAM_INT);
    $consulta->bindParam(":id", $estudianteId, PDO::PARAM_INT);

    if ($consulta->execute()) {
        echo "success"; // Devuelve 'success' en caso de éxito
    } else {
        echo "error"; // Devuelve 'error' en caso de error
    }
}
?>
