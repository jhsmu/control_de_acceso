<?php 

require_once '../database/conexion.php';

// $consulta=$DB_con->prepare('SELECT email FROM cliente');
// $consulta->execute();
// $emails=$consulta->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST["nombre"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $documento = $_POST["documento"];
    $cargo = $_POST["cargo"];
    $telefono = $_POST["telefono"];

    $validar = "SELECT * FROM cliente WHERE documento = '$documento' ";
    $validando = $DB_con->prepare($validar);
    $validando->execute();

    $validar1 = "SELECT * FROM cliente WHERE telefono = '$telefono' ";
    $validando1 = $DB_con->prepare($validar1);
    $validando1->execute();

    if($validando->rowCount() > 0){
        session_start();
        $_SESSION["documentoRepetido"] = "documento repetido";
        header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$cargo."&tel=".$telefono);
    }elseif($validando1->rowCount() > 0){
        session_start();
        $_SESSION["telefonoRepetido"] = "telefono repetido";
        header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$cargo."&tel=".$telefono);
    }else{
        try{
            $query = $DB_con->prepare("INSERT INTO colaboradores(nombre, apellido, documento, cargo, telefono) VALUES(?, ?, ?, ?, ?)");// Traduzco mi petición
            $guardar = $query->execute([$nombre, $apellido, $documento, $cargo, $telefono]); //Ejecuto mi petición
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
            header("location:../colaboradores.php?nombre=".$nombre."&apellido=".$apellido."&documento=".$documento."&cargo=".$cargo."&tel=".$telefono);
        }
    }

}