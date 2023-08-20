<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../Database/conexion.php';

// Token de acceso (Bearer token) de Sinch
$accessToken = '52f97fa25373410494e1826376f257bf';


// URL de la API de Sinch
$sinchApiUrl = 'https://sms.api.sinch.com/xms/v1/22c486ef0a1540769d7de50d52dec44f/batchesa';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['identificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultarColaborador = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consultaColaborador = $DB_con->prepare($consultarColaborador);
    $consultaColaborador->bindValue(':identificacion', $identificacion);
    $consultaColaborador->execute();
    $ingresoC = $consultaColaborador->fetch(PDO::FETCH_ASSOC);

    $consultarEstudiante = "SELECT * FROM estudiante WHERE identificacion = :identificacion";
    $consultaEstudiante = $DB_con->prepare($consultarEstudiante);
    $consultaEstudiante->bindValue(':identificacion', $identificacion);
    $consultaEstudiante->execute();
    $ingresoE = $consultaEstudiante->fetch(PDO::FETCH_ASSOC);
        // Consulta a la nueva tabla
        $consultaAdmin = "SELECT * FROM ingreso_a WHERE cedula = :identificacion";
        $consultaAdminDB = $DB_con->prepare($consultaAdmin);
        $consultaAdminDB->bindValue(':identificacion', $identificacion);
        $consultaAdminDB->execute();
        $ingresoAdmin = $consultaAdminDB->fetch(PDO::FETCH_ASSOC);
    
    // Si la cédula existe en la nueva tabla, verifica el número de documento
        // Consulta a la nueva tabla
        $consultaAdmin = "SELECT * FROM ingreso_a WHERE cedula = :identificacion";
        $consultaAdminDB = $DB_con->prepare($consultaAdmin);
        $consultaAdminDB->bindValue(':identificacion', $identificacion);
        $consultaAdminDB->execute();
        $ingresoAdmin = $consultaAdminDB->fetch(PDO::FETCH_ASSOC);
    
        // Si la cédula existe en la nueva tabla, verifica el número de documento
        if ($ingresoAdmin) {
            if ($ingresoAdmin['cedula'] == '1919191919') {  // Aquí reemplaza 'valorEsperadoParaAdmin' con el valor que 
                
                $_SESSION['ingresoAdmin'] = 'ingreso administrador';
                header("location: ../controlacceso.php");
                exit();
            } elseif ($ingresoAdmin['cedula'] == '1818181818') {
                $_SESSION['ingresoInvitado'] = 'ingresar a un invitado';
                header("location: ../controlacceso.php");  // Redirige a 'registro.php' si el número de documento es cualquier otro
                exit();
            }
            exit(); // Termina la ejecución del script
        }

        if (!$ingresoC && !$ingresoE) {
            $_SESSION['Prohibido'] = 'No eres del campu';
            header("location: ../controlacceso.php");
            exit(); // Terminar la ejecución del script
        }

    if (($ingresoC && $ingresoC['estado_colaborador'] == 0) || ($ingresoE && $ingresoE['estado_estudiante'] == 0)) {
        $_SESSION['UsuarioDeshabilitado'] = 'Usuario deshabilitado. Contacte al administrador.';
        header("location: ../controlacceso.php");
        exit();
    }

    if ($estadoIngreso == 1) {
        $estadoUsuario = ($ingresoC) ? $ingresoC['estado_colaborador'] : $ingresoE['estado_estudiante'];
        $idUsuario = ($ingresoC) ? $ingresoC['id'] : $ingresoE['id'];

        $consultarIngreso = ($ingresoC) ? "SELECT * FROM ingreso WHERE id_colaboradores = :id AND ingresoEstado = :estado" : "SELECT * FROM ingreso WHERE id_estudiante = :id AND ingresoEstado = :estado";
        $consultaIngreso = $DB_con->prepare($consultarIngreso);
        $consultaIngreso->bindValue(':id', $idUsuario);
        $consultaIngreso->bindValue(':estado', $pendiente);
        $consultaIngreso->execute();
        $registroIngreso = $consultaIngreso->fetch(PDO::FETCH_ASSOC);

         if ($registroIngreso) {
             $_SESSION['registroDoble'] = 'Ya has realizado un ingreso previo';
             header("location: ../controlacceso.php");
             exit();
         }

        $hora_actual = new DateTime();
        $hora_actual->modify('-5 hours');
        $hora_resta = $hora_actual->format('Y-m-d H:i:s');

        $token = bin2hex(random_bytes(3)); // Genera un token hexadecimal de 6 caracteres (3 bytes)

        $query = ($ingresoC) ? "INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado, token) VALUES(:id, :fechaingreso, :ingresoEstado, :token)" : "INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado, token) VALUES(:id, :fechaingreso, :ingresoEstado, :token)";
        $query = $DB_con->prepare($query);
        $query->bindValue(':id', $idUsuario);
        $query->bindValue(':fechaingreso', $hora_resta);
        $query->bindValue(':ingresoEstado', $pendiente);
        $query->bindValue(':token', $token);
        $guardar = $query->execute();

        if ($guardar) {
            $lastInsertId = $DB_con->lastInsertId();
            $_SESSION['lastInsertId'] = $lastInsertId;
            echo "tu token de autentikacion es:".$token;
             // Obtener el número de teléfono según si es colaborador o estudiante
             if ($ingresoC) {
                 $numeroDestino = $ingresoC['telefono'];
             } elseif ($ingresoE) {
                 $numeroDestino = $ingresoE['telefono'];
             } else {
                 echo "No se encontró un número de teléfono válido.";
                 exit();
             }
            // Datos del mensaje para enviar el token
            $fromNumber = '447520651059';
            $toNumbers = ["573007405540"];
            $messageBody = "Tu token de autenticación es:".$token;

            // Configuración de la solicitud para la API de Sinch
            $data = [
                "from" => $fromNumber,
                "to" => $toNumbers,
                "body" => $messageBody
            ];

         $options = array(
                'http' => array(
                 'header' => "Content-type: application/json\r\n" .
                             "Authorization: Bearer $accessToken\r\n",
                    'method' => 'POST',
                 'content' => json_encode($data)
                )
         );
        // Realizar la solicitud a la API de Sinch
          $ch = curl_init($sinchApiUrl);
          curl_setopt($ch, CURLOPT_URL, $sinchApiUrl);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             "Content-Type: application/json",
          "Authorization: Bearer $accessToken"));

          $response = curl_exec($ch);
          curl_close($ch);
                        if ($response === false) {
                echo "Error al enviar el mensaje de texto.";
            } else {
<<<<<<< HEAD
                $nombrePersona = ($ingresoC) ? $ingresoC['nombre'] : $ingresoE['nombre'];
                 $_SESSION['nombrePersona'] = $nombrePersona; // Almacena el nombre en la sesión
=======
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                header("Location: ../controlacceso.php");
                exit();   
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    } elseif ($estadoIngreso == 0) {
        if ($ingresoC) {
            $estadoUsuario = $ingresoC['estado_colaborador'];
            $idUsuario = $ingresoC['id'];
        } elseif ($ingresoE) {
            $estadoUsuario = $ingresoE['estado_estudiante'];
            $idUsuario = $ingresoE['id'];
        } else {
            $_SESSION['Prohibido'] = 'No eres del campus';
            header("location: ../controlacceso.php");
            exit();
        }

        $consultarIngreso = ($ingresoC) ? "SELECT * FROM ingreso WHERE id_colaboradores = :id AND ingresoEstado = :estado" : "SELECT * FROM ingreso WHERE id_estudiante = :id AND ingresoEstado = :estado";
        $consultaIngreso = $DB_con->prepare($consultarIngreso);
        $consultaIngreso->bindValue(':id', $idUsuario);
        $consultaIngreso->bindValue(':estado', $pendiente);
        $consultaIngreso->execute();
        $registroIngreso = $consultaIngreso->fetch(PDO::FETCH_ASSOC);

<<<<<<< HEAD
    
=======
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
        if ($registroIngreso) {
            $hora_actual = new DateTime();
            $hora_actual->modify('-5 hours');
            $hora_resta = $hora_actual->format('Y-m-d H:i:s');

            $query = ($ingresoC) ? "UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id AND ingresoEstado = :estado" : "UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id AND ingresoEstado = :estado";
            $query = $DB_con->prepare($query);
            $query->bindValue(':fechasalida', $hora_resta);
            $query->bindValue(':ingresoEstado', $finalizado);
            $query->bindValue(':id', $idUsuario);
            $query->bindValue(':estado', $pendiente);
            $actualizar = $query->execute();

            if ($actualizar) {
<<<<<<< HEAD
                // $_SESSION['salida'] = 'Salida exitosa';
                $_SESSION['salida'] = 'Salida exitosa';
                $_SESSION['nombrePersona'] = ($ingresoC) ? $ingresoC['nombre'] : $ingresoE['nombre'];
=======
                $_SESSION['salida'] = 'Salida exitosa';
>>>>>>> c366912a80316a03334cb2e8f050d2404a029798
                header("location: ../controlacceso.php");
                exit();
            } else {
                $_SESSION['salidaError'] = 'Error al registrar la salida';
                header("location: ../controlacceso.php");
                exit();
            }
        } else {
            $_SESSION['salidaError'] = 'No tienes un ingreso pendiente para registrar la salida';
            header("location: ../controlacceso.php");
            exit();
        }
    }
}
?>
