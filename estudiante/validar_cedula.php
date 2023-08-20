<?php
// Incluir la conexión a la base de datos
include '../database/conexion.php'; // Asegúrate de que la ruta sea correcta

// Recibir los valores de POST
$documento = $_POST['documento'];
$idCarrera = $_POST['id_carrera'];

try {
    // Preparar y ejecutar la consulta utilizando marcadores de posición para evitar SQL injection
    $query = "SELECT * FROM estudiante WHERE identificacion = :documento AND carrera = :idCarrera";
    $stmt = $DB_con->prepare($query);
    $stmt->bindParam(':documento', $documento);
    $stmt->bindParam(':idCarrera', $idCarrera);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $resultado = ['estudianteValido' => true, 'id' => $id_estudiante]; // Aquí asigna el ID correcto
    } else {
        $resultado = ['estudianteValido' => false];
    }
} catch (PDOException $e) {
    $resultado = ['error' => 'Error en la consulta de la base de datos: ' . $e->getMessage()];
}

// Devolver la respuesta al cliente como JSON
header('Content-Type: application/json');
echo json_encode($resultado);
?>



<!-- <php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../Database/conexion.php';

$documento = $_POST['documento'];
$id_carrera = $_POST['id_carrera'];

try {
    // Preparar y ejecutar la consulta
    $consulta = $DB_con->prepare("SELECT * FROM estudiante WHERE identificacion = :documento AND carrera = :id_carrera");
    $consulta->bindParam(':documento', $documento);
    $consulta->bindParam(':id_carrera', $id_carrera);
    $consulta->execute();
    if ($consulta->rowCount() > 0) {
        echo json_encode(["estudianteValido" => true, "id" => $id_estudiante]);
    } else {
        echo json_encode(["estudianteValido" => false]);
    }
    // if ($consulta->rowCount() > 0) {
    //     // El estudiante es válido, redireccionar a la página de edición
    //     $estudiante = $consulta->fetch(PDO::FETCH_ASSOC);
    //     $id_estudiante = $estudiante['id_estudiante'];
    //     header("Location: ./estudiante/editar_estudiante.php?id=$id_estudiante");
    //     exit();
    // } else {
    //     // El estudiante no pertenece a la carrera, mostrar una alerta
    //     echo "El estudiante no pertenece a la carrera seleccionada.";
    // }
} catch (Exception $e) {
    // Mostrar mensaje de error en caso de excepción
    // echo "Error en la consulta: " . $e->getMessage();
    echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);

}
?> -->


<!-- <php
// Incluir la conexión a la base de datos
include '../database/conexion.php'; // Asegúrate de que la ruta sea correcta

// Recibir los valores de POST
$documento = $_POST['documento'];
$idCarrera = $_POST['id_carrera'];

try {
    // Preparar y ejecutar la consulta utilizando marcadores de posición para evitar SQL injection
    $query = "SELECT * FROM estudiante WHERE identificacion = :documento AND carrera = :idCarrera";
    $stmt = $DB_con->prepare($query);
    $stmt->bindParam(':documento', $documento);
    $stmt->bindParam(':idCarrera', $idCarrera);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $resultado = 'El estudiante pertenece a esta carrera.';
    } else {
        $resultado = 'El estudiante no pertenece a esta carrera.';
    }
} catch (PDOException $e) {
    $resultado = 'Error en la consulta de la base de datos: ' . $e->getMessage();
}

// Devolver la respuesta al cliente
echo $resultado;
?> -->
