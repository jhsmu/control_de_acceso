<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = 'root';
$basededatos = 'fucla';

$conexion = mysqli_connect($host, $usuario, $contraseña, $basededatos);
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener el parámetro de carrera desde la solicitud GET
$idCargo = $_GET['cargo'];

// Consulta SQL para obtener los datos de los estudiantes de la carrera seleccionada
$query = "SELECT  colaboradores.nombre, colaboradores.documento, cargo.nombre AS cargo
          FROM colaboradores
          INNER JOIN cargo ON colaboradores.cargo = cargo.id_cargo WHERE cargo = '$idCargo'";

$resultado = mysqli_query($conexion, $query);

$datos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
  $datos[] = $row;
}

// Devolver los datos como respuesta en formato JSON
echo json_encode($datos);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
