<?php 

require_once '../database/conexion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


if(isset($_POST["agregar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $documento = $_POST["documento"];
    $id_cargo = $_POST["cargo"];
    $telefono = $_POST["telefono"];
    $estado_colaborador = 1;

    $validar = "SELECT * FROM colaboradores WHERE documento = '$documento' ";
    $validando = $DB_con->prepare($validar);
    $validando->execute();

    $validar1 = "SELECT * FROM colaboradores WHERE telefono = '$telefono' ";
    $validando1 = $DB_con->prepare($validar1);
    $validando1->execute();

    if($validando->rowCount() > 0){
        session_start();
        $_SESSION["documentoRepetido"] = "documento repetido";
        header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$id_cargo."&telefono=".$telefono);
    }elseif($validando1->rowCount() > 0){
        session_start();
        $_SESSION["telefonoRepetido"] = "telefono repetido";
        header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$id_cargo."&telefono=".$telefono);
    }else{
        try{

            $agregar = $DB_con->prepare('INSERT INTO colaboradores(nombre, apellido, documento, cargo, telefono, estado_colaborador) VALUES(?, ?, ?, ?, ?, ?)');
            $guardar = $agregar->execute([$nombre, $apellido, $documento, $id_cargo, $telefono, $estado_colaborador]);
        
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