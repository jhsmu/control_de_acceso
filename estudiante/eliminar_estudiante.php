<?php
session_start();
require_once '../database/conexion.php';
require '../database/databaseconexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        echo "Iniciando proceso de eliminación para el estudiante con ID: " . $id;
        $query = $DB_con->prepare("DELETE FROM estudiante WHERE id = :id");
        $query->execute(['id' => $id]);
        $_SESSION['EliminacionExitosa'] = 'Se eliminó con éxito el estudiante';
        header("Location: ../estudiantes.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar al estudiante: " . $e->getMessage();
    }
}
?>
