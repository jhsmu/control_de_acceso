<?php
session_start();
require_once '../database/conexion.php';
require '../database/databaseconexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        echo "Iniciando proceso de eliminación para el estudiante con ID: " . $id;
        $query = $DB_con->prepare("DELETE FROM colaboradores WHERE id = :id");
        $query->execute(['id' => $id]);
        $_SESSION['EliminacionColaborador'] = 'Se eliminó con éxito el colaboradores';
        header("Location: ../colaboradores.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar al colaboradores: " . $e->getMessage();
    }
}
?>
