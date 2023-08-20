<?php

require './database/conexion.php';
// verificar_token.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_POST['token']) && isset($_POST['idUsuario'])) {
    $tokenIngresado = trim($_POST['token']);
    $idUsuario = $_POST['idUsuario'];

    // Consultar el token almacenado en la base de datos para el usuario
    $consultaToken = $DB_con->prepare("SELECT token FROM ingreso WHERE id_ingreso = :idUsuario");
    $consultaToken->bindValue(':idUsuario', $idUsuario);
    $consultaToken->execute();
    $tokenBD = $consultaToken->fetchColumn(); // Obtener el token almacenado en la base de datos

    if ($tokenIngresado === $tokenBD) {
        echo "success"; // Solo envía "success" como respuesta si la validación es exitosa
        
    } else {
        echo "error"; // Envía "error" si la validación no es exitosa
    }
}
?>
