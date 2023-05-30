<?php


// Verificar si se han enviado los datos del formulario
if (isset($_POST['cedula'])) {

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $fechaIngreso = date('Y-m-d'); // Obtiene la fecha actual en el formato 'AAAA-MM-DD'

    // Configuración de la conexión a la base de datos (reemplaza los valores con los de tu base de datos)
    
    try {
        // Verificar si el estudiante ya está registrado en la base de datos
        $consulta = "SELECT * FROM estudiantes WHERE cedula = :cedula";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El estudiante ya está registrado.";
        } else {
            // Insertar los datos en la tabla
            $consulta = "INSERT INTO estudiantes (cedula, nombre, fecha_ingreso) VALUES (:cedula, :nombre, :fecha_ingreso)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha_ingreso', $fechaIngreso);
            $stmt->execute();

            echo "Estudiante ingresado correctamente.";
        }
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    } finally {
        // Cerrar la conexión a la base de datos
        $conexion = null;
    }
} else {
    echo "No se han enviado los datos del formulario.";
}
?>
