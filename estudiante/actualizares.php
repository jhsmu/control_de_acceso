<?php
session_start();
require_once '../database/conexion.php';
require_once '../database/databaseconexion.php';

// Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); // Creamos la conexión a la BD

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];

    try {
        // Verificar si la cédula ya existe en la base de datos para otro estudiante o colaborador
        $consulta_cedula = $connection->prepare("SELECT id FROM estudiante WHERE identificacion = :identificacion AND id != :id UNION SELECT id FROM colaboradores WHERE documento = :identificacion AND id != :id");
        $consulta_cedula->execute(['identificacion' => $identificacion, 'id' => $id]);
        $cedula_existente = $consulta_cedula->fetch();

        // Verificar si el teléfono ya existe en la base de datos para otro estudiante o colaborador
        $consulta_telefono = $connection->prepare("SELECT id FROM estudiante WHERE telefono = :telefono AND id != :id UNION SELECT id FROM colaboradores WHERE telefono = :telefono AND id != :id");
        $consulta_telefono->execute(['telefono' => $telefono, 'id' => $id]);
        $telefono_existente = $consulta_telefono->fetch();
        // Validación adicional de cédula y teléfono juntos
        if ($cedula_existente && $telefono_existente) {
         // Cédula y teléfono pertenecen a otro estudiante o colaborador
        $_SESSION['error_actualizar'] = true;
        $_SESSION['mensaje_error'] = "No se puede actualizar. La cédula y el teléfono ya pertenecen a otro estudiante o colaborador.";
        header("Location: ../estudiantes.php");
        exit();
                }
        // Validaciones de cédula y teléfono
        elseif ($cedula_existente) {
            // Hay duplicados de cédula para estudiantes o colaboradores
            $_SESSION['error_actualizar'] = true;
            $_SESSION['mensaje_error'] = "No se puede actualizar. La cédula ya pertenece a otro estudiante o colaborador.";
            header("Location: ../estudiantes.php");
            exit();
        } elseif ($telefono_existente) {
            // Hay duplicados de teléfono para estudiantes o colaboradores
            $_SESSION['error_actualizar'] = true;
            $_SESSION['mensaje_error'] = "No se puede actualizar. El telefono ya pertenece a otro estudiante o colaborador.";
            header("Location: ../estudiantes.php");
            exit();
        }
        // Si no hay duplicados, proceder con la actualización
        $query = $connection->prepare("UPDATE estudiante SET nombre=?, apellido=?, identificacion=?, telefono=? WHERE id=?");
        $actualizar = $query->execute([$nombre, $apellido, $identificacion, $telefono, $id]);

        if ($actualizar) {
            $_SESSION['actualizar'] = 'actualizacion exitosa';
            header("Location: ../estudiantes.php");
            exit();
        } else {
            $_SESSION['error_actualizar'] = 'actualizar';
        }
    } catch (\Throwable $th) {
        $_SESSION['tel'] = "Telefono repetido.";
    }
}
?>
