<?php 

error_reporting( ~E_NOTICE );

require '../database/conexion.php';

if(isset($_POST["inicio"])){
    $usuario=$_POST["usuario"];
    $contra=htmlentities($_POST["clave"]);

    $consultar=$DB_con->prepare('SELECT * FROM administrador WHERE usuario=:usuario');
    $consultar->bindParam(':usuario', $usuario);
    $consultar->execute();

    $admin=$consultar->fetch(PDO::FETCH_ASSOC);

    if($usuario==$admin["usuario"] and $contra==$admin["clave"]){
        session_start();
        $_SESSION["id"]=$admin["id"];
        // $_SESSION["admin"]=$admin["nombre"];
        header('location:../administracion.php');
    }else{
        session_start();
        $_SESSION["Datos_incorrectos"] = "Datos incorrectos";
        header("location:../loginadmin.php");
    }
}