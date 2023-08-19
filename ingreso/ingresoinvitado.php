<?php
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['ingresar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $descripcion = $_POST['descripcion'];


    // Obtener el id_genero correspondiente al nombre de género seleccionado
    try {

        // Establecer el modo de error PDO para mostrar excepciones
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt_genero = $DB_con->prepare("SELECT id_genero FROM genero WHERE nombre = :genero");
        $stmt_genero->bindParam(':genero', $genero);
        $stmt_genero->execute();

        $id_genero = $stmt_genero->fetchColumn();

        // Preparar la consulta SQL para insertar los datos en la tabla "invitados"
        $sql = "INSERT INTO invitados (nombre, apellido, documento, telefono, genero, descripcion) 
                VALUES (:nombre, :apellido, :documento, :telefono, :genero, :descripcion)";

        // Preparar la sentencia
        $stmt = $DB_con->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':documento', $documento);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':genero', $genero); // Usar el nombre del género seleccionado
        $stmt->bindParam(':descripcion', $descripcion);
        

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['exitoInvitado'] = 'exito al registrar';
            header("location: ../invitados.php");
            exit();
        } else {
            $_SESSION['errorInvitado'] = 'error de registro';
            header("location: ../invitados.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>



