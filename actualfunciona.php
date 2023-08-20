<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['indentificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultar = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consulta2 = $DB_con->prepare($consultar);
    $consulta2->bindValue(':identificacion', $identificacion);
    $consulta2->execute();
    $ingresoC = $consulta2->fetch(PDO::FETCH_ASSOC);

    $consultar2 = "SELECT * FROM estudiante WHERE identificacion = :identificacion";
    $consulta3 = $DB_con->prepare($consultar2);
    $consulta3->bindValue(':identificacion', $identificacion);
    $consulta3->execute();
    $ingresoE = $consulta3->fetch(PDO::FETCH_ASSOC);
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
        session_start();
        $_SESSION['Prohibido'] = 'No eres del campu';
        header("location: ../controlacceso.php");
        exit(); // Terminar la ejecución del script
    }

    $estadoI = null;

    if ($ingresoC) {
        $id = $ingresoC['id'];

        // Verificar estado de ingreso
        $consultarC = "SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id";
        $consulta = $DB_con->prepare($consultarC);
        $consulta->bindValue(':id', $id);
        $consulta->execute();
        $colaboradores = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($colaboradores) {
            $estadoI = $colaboradores['ingresoEstado'];
        }
    } else if ($ingresoE) {
        $id2 = $ingresoE['id'];

        // Verificar estado de ingreso
        $consultarE = "SELECT ingresoEstado FROM ingreso WHERE id_estudiante = :id2";
        $consulta4 = $DB_con->prepare($consultarE);
        $consulta4->bindValue(':id2', $id2);
        $consulta4->execute();
        $estudiantes = $consulta4->fetch(PDO::FETCH_ASSOC);

        if ($estudiantes) {
            $estadoI = $estudiantes['ingresoEstado'];
        }
    }

    $hora_actual = new DateTime();
    $hora_actual->modify('-5 hours');
    $hora_resta = $hora_actual->format('Y-m-d H:i:s');

    if ($ingresoC) {
        if ($estadoI != $estadoIngreso) {
            if ($estadoIngreso == 1) {
                // Generar un token aleatorio
                $token = bin2hex(random_bytes(3)); // Genera un token hexadecimal de 6 caracteres (3 bytes)
    
                // Insertar nuevo registro de ingreso
                $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado, token) VALUES(:id, :fechaingreso, :ingresoEstado, :token)");
                $query->bindValue(':id', $id);
                $query->bindValue(':fechaingreso', $hora_resta);
                $query->bindValue(':ingresoEstado', $pendiente);
                $query->bindValue(':token', $token); // Almacena el token generado en el campo "token"
                $guardar = $query->execute();
    
                if ($guardar) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    $_SESSION['exito'] = 'exito al registrar';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            } else if ($estadoIngreso == 0) {
                // Actualizar registro de ingreso existente
                $query2 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
                $query2->bindValue(':fechasalida', $hora_resta);
                $query2->bindValue(':ingresoEstado', $finalizado);
                $query2->bindValue(':id', $id);
                $actualizar = $query2->execute();
    
                if ($actualizar) {
                    $_SESSION['salida'] = 'salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    }else if ($ingresoE) {
        if ($estadoI != $estadoIngreso) {
            if ($estadoIngreso == 1) {
                // Generar un token aleatorio
                $token = bin2hex(random_bytes(3)); // Genera un token hexadecimal de 6 caracteres (3 bytes)
    
                $query3 = $DB_con->prepare("INSERT INTO ingreso(id_estudiante, fechaingreso, ingresoEstado, token) VALUES(:id2, :fechaingreso, :ingresoEstado, :token)");
                $query3->bindValue(':id2', $id2);
                $query3->bindValue(':fechaingreso', $hora_resta);
                $query3->bindValue(':ingresoEstado', $pendiente);
                $query3->bindValue(':token', $token); // Almacena el token generado en el campo "token"
                $guardar2 = $query3->execute();
    
                if ($guardar2) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['exito'] = 'exito al registrar';
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            } else if ($estadoIngreso == 0) {
                // Actualizar registro de ingreso existente
                $query4 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_estudiante = :id2");
                $query4->bindValue(':fechasalida', $hora_resta);
                $query4->bindValue(':ingresoEstado', $finalizado);
                $query4->bindValue(':id2', $id2);
                $actualizar2 = $query4->execute();
    
                if ($actualizar2) {
                    $_SESSION['salida'] = 'salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    }
       
   }
   ?>
   <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../Database/conexion.php';

if (isset($_POST['ingresar'])) {
    $pendiente = 1;
    $finalizado = 0;
    $identificacion = $_POST['indentificacion'];
    $estadoIngreso = $_POST['estado'];

    $consultar = "SELECT * FROM colaboradores WHERE documento = :identificacion";
    $consulta2 = $DB_con->prepare($consultar);
    $consulta2->bindValue(':identificacion', $identificacion);
    $consulta2->execute();
    $ingresoC = $consulta2->fetch(PDO::FETCH_ASSOC);

    if (!$ingresoC) {
        session_start();
        $_SESSION['Prohibido'] = 'No eres del campus';
        header("location: ../controlacceso.php");
        exit(); // Terminar la ejecución del script
    }

    $estadoColaborador = $ingresoC['estado_colaborador'];

    if ($estadoColaborador == 1) {
        $id = $ingresoC['id'];

        // Verificar estado de ingreso
        $consultarC = "SELECT ingresoEstado FROM ingreso WHERE id_colaboradores = :id";
        $consulta = $DB_con->prepare($consultarC);
        $consulta->bindValue(':id', $id);
        $consulta->execute();
        $colaboradores = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($colaboradores) {
            $estadoI = $colaboradores['ingresoEstado'];
        }

        $hora_actual = new DateTime();
        $hora_actual->modify('-5 hours');
        $hora_resta = $hora_actual->format('Y-m-d H:i:s');

        if ($estadoI != $estadoIngreso) {
            if ($estadoIngreso == 1) {
                // Generar un token aleatorio
                $token = bin2hex(random_bytes(3)); // Genera un token hexadecimal de 6 caracteres (3 bytes)
    
                // Insertar nuevo registro de ingreso
                $query = $DB_con->prepare("INSERT INTO ingreso(id_colaboradores, fechaingreso, ingresoEstado, token) VALUES(:id, :fechaingreso, :ingresoEstado, :token)");
                $query->bindValue(':id', $id);
                $query->bindValue(':fechaingreso', $hora_resta);
                $query->bindValue(':ingresoEstado', $pendiente);
                $query->bindValue(':token', $token); // Almacena el token generado en el campo "token"
                $guardar = $query->execute();
    
                if ($guardar) {
                    $lastInsertId = $DB_con->lastInsertId();
                    $_SESSION['lastInsertId'] = $lastInsertId;
                    $_SESSION['exito'] = 'exito al registrar';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            } else if ($estadoIngreso == 0) {
                // Actualizar registro de ingreso existente
                $query2 = $DB_con->prepare("UPDATE ingreso SET fechasalida = :fechasalida, ingresoEstado = :ingresoEstado WHERE id_colaboradores = :id");
                $query2->bindValue(':fechasalida', $hora_resta);
                $query2->bindValue(':ingresoEstado', $finalizado);
                $query2->bindValue(':id', $id);
                $actualizar = $query2->execute();
    
                if ($actualizar) {
                    $_SESSION['salida'] = 'salida exitosa';
                    header("location: ../controlacceso.php");
                    exit();
                } else {
                    $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
                    header("location: ../controlacceso.php");
                    exit();
                }
            }
        } else {
            $_SESSION['registroDoble'] = 'Estás intentando entrar nuevamente';
            header("location: ../controlacceso.php");
            exit();
        }
    } else {
        $_SESSION['UsuarioDeshabilitado'] = 'Usuario deshabilitado. Contacte al administrador.';
        header("location: ../controlacceso.php");
        exit(); // Terminar la ejecución del script
    }
}
?>
<script>
          function cambiarEstado(idUsuario, estado) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  // Éxito en la solicitud
                  if (estado) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Usuario habilitado',
                      text: '¡Se ha habilitado el usuario exitosamente!',
                      showConfirmButton: false, // Ocultar el botón "OK"
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                      
                    }).then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Usuario deshabilitado',
                      text: '¡Se ha deshabilitado el usuario exitosamente!',
                      showConfirmButton: false, // Ocultar el botón "OK"
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                    }).then(() => {
                      location.reload();
                    });
                  }
                } else {
                  // Error en la solicitud
                  alert("Error al cambiar el estado del usuario.");
                }
              }
            };

            xhr.open("GET", "cambiar_estado.php?id_usuario=" + idUsuario + "&estado=" + (estado ? 1 : 0), true);
            xhr.send();
          }
        </script>