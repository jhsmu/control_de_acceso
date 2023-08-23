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
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];

    try {
        // Verificar si el documento ya existe en la base de datos para otro estudiante o colaborador
        $consulta_documento = $connection->prepare("SELECT id FROM estudiante WHERE identificacion = :documento AND id != :id UNION SELECT id FROM colaboradores WHERE documento = :documento AND id != :id");
        $consulta_documento->execute(['documento' => $documento, 'id' => $id]);
        $documento_existente = $consulta_documento->fetch();

        // Verificar si el teléfono ya existe en la base de datos para otro estudiante o colaborador
        $consulta_telefono = $connection->prepare("SELECT id FROM estudiante WHERE telefono = :telefono AND id != :id UNION SELECT id FROM colaboradores WHERE telefono = :telefono AND id != :id");
        $consulta_telefono->execute(['telefono' => $telefono, 'id' => $id]);
        $telefono_existente = $consulta_telefono->fetch();

        // Validación adicional de documento y teléfono juntos
        if ($documento_existente && $telefono_existente) {
            // Documento y teléfono pertenecen a otro estudiante o colaborador
            $_SESSION['error_actualizar'] = true;
            $_SESSION['mensaje_error'] = "No se puede actualizar. El documento y el teléfono ya pertenecen a otro estudiante o colaborador.";
            header("Location: ../colaboradores.php");
            exit();
        }
        // Validaciones de documento y teléfono
        elseif ($documento_existente) {
            // Hay duplicados de documento para estudiantes o colaboradores
            $_SESSION['error_actualizar'] = true;
            $_SESSION['mensaje_error'] = "No se puede actualizar. El documento ya pertenece a otro estudiante o colaborador.";
            header("Location: ../colaboradores.php");
            exit();
        } elseif ($telefono_existente) {
            // Hay duplicados de teléfono para estudiantes o colaboradores
            $_SESSION['error_actualizar'] = true;
            $_SESSION['mensaje_error'] = "No se puede actualizar. El telefono ya pertenece a otro estudiante o colaborador.";
            header("Location: ../colaboradores.php");
            exit();
        }

        // Si no hay duplicados, proceder con la actualización
        $query = $connection->prepare("UPDATE colaboradores SET nombre=?, apellido=?, documento=?, telefono=? WHERE id=?");
        $actualizar = $query->execute([$nombre, $apellido, $documento, $telefono, $id]);

        if ($actualizar) {
            $_SESSION['actualizarColaborador'] = 'actualizacion exitosa';
            header("Location: ../colaboradores.php");
            exit();
        } else {
            $_SESSION['error_actualizar'] = 'actualizar';
        }
    } catch (\Throwable $th) {
        $_SESSION['tel'] = "Telefono repetido.";
    }
}
?>
