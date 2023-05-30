<?php 

require_once '../database/conexion.php';


if(isset($_POST["agregar"])){
    $estado = 3;
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $documento = $_POST["documento"];
    $id_cargo = $_POST["cargo"];
    $telefono = $_POST["telefono"];

     $validar = "SELECT * FROM colaboradores WHERE documento = '$documento' ";
     $validando = $DB_con->prepare($validar);
     $validando->execute();

    $validar1 = "SELECT * FROM colaboradores WHERE telefono = '$telefono' ";
     $validando1 = $DB_con->prepare($validar1);
     $validando1->execute();

     if($validando->rowCount() > 0){
        session_start();
         $_SESSION["documentoRepetido"] = "documento repetido";
        header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$id_cargo."&telefono=".$telefono."&estado".$estado);
     }elseif($validando1->rowCount() > 0){
        session_start();
        $_SESSION["telefonoRepetido"] = "telefono repetido";
       header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$id_cargo."&telefono=".$telefono."&estado".$estado);
    }else{
         try{

            $agregar=$DB_con->prepare('INSERT INTO colaboradores(nombre, apellido, documento, cargo, telefono,estado) VALUES(:nombre, :apellido, :documento, :cargo, :telefono,:estado)');
            
            $agregar->bindParam(':nombre', $nombre);
            $agregar->bindParam(':apellido', $apellido);
            $agregar->bindParam(':documento', $documento);
            $agregar->bindParam(':cargo', $id_cargo);
            $agregar->bindParam(':telefono', $telefono);
            $agregar->bindParam(':estado', $estado);
            $guardar = $agregar->execute();
            if ($guardar) {
                session_start();
                $_SESSION['exitoso'] = 'registro';
                header("location: ../colaboradores.php");
            } else {
                session_start();
                $_SESSION['error'] = 'guardad';
                header("location: ../colaboradores.php");
            }  
        } catch (\Throwable $th) {
            session_start();
            $_SESSION["colaboradoRepetido"] = "colaborador repetido";
            header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$id_cargo."&telefono=".$telefono);
        }
    }

}