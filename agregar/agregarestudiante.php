<?php 

require_once '../database/conexion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["agregar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $identificacion = $_POST["identificacion"];
    $id_carrera = $_POST["carrera"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $estado_estudiante=1;

     $validar = "SELECT * FROM estudiante WHERE identificacion = '$identificacion' ";
     $validando = $DB_con->prepare($validar);
     $validando->execute();

    $validar1 = "SELECT * FROM estudiante WHERE telefono = '$telefono' ";
     $validando1 = $DB_con->prepare($validar1);
     $validando1->execute();

     $validar2 = "SELECT * FROM estudiante WHERE correo = '$correo' ";
     $validando2 = $DB_con->prepare($validar2);
     $validando2->execute();

     if($validando->rowCount() > 0){
        session_start();
         $_SESSION["documentoRepetido"] = "documento repetido";
        header("location:../estudiantes.php?nombre=".$nombre."&apellido=".$apellido."&identificacion=".$identificacion."&carrera=".$id_carrera."&correo=".$correo."&telefono=".$telefono);
     }elseif($validando1->rowCount() > 0){
        session_start();
        $_SESSION["telefonoRepetido"] = "telefono repetido";
        header("location:../estudiantes.php?nombre=".$nombre."&apellido=".$apellido."&identificacion=".$identificacion."&carrera=".$id_carrera."&correo=".$correo."&telefono=".$telefono);
    }elseif($validando2->rowCount() > 0){
        session_start();
        $_SESSION["correoRepetido"] = "correo repetido";
        header("location:../estudiantes.php?nombre=".$nombre."&apellido=".$apellido."&identificacion=".$identificacion."&carrera=".$id_carrera."&correo=".$correo."&telefono=".$telefono);
    }else{
         try{
            
            $agregar=$DB_con->prepare('INSERT INTO estudiante(nombre, apellido, identificacion, carrera,correo, telefono, estado_estudiante) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $guardar = $agregar->execute([$nombre,$apellido,$identificacion,$id_carrera,$correo,$telefono,$estado_estudiante]);
            if ($guardar) {
                session_start();
                $_SESSION['exitoso'] = 'registro';
                header("location: ../estudiantes.php");
            } else {
                session_start();
                $_SESSION['error'] = 'guardad';
                header("location: ../estudiantes.php");
            }  
        } catch (\Throwable $th) {
            session_start();
            $_SESSION["estudianteRepetido"] = "estudiante repetido";
            header("location:../estudiantes.php?nombre=".$nombre."&apellido=".$apellido."&identificacion=".$identificacion."&carrera=".$id_carrera."&correo=".$correo."&telefono=".$telefono);
        }
    }

}