<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $id=$_POST["id"];
    $estado = $_POST["estado"];

    //Conexion BBDD
    include("conexion.php");

    session_start();
    //Comprueba si existe sesion iniciada
    if(isset($_SESSION['Usu'])){
        $Us = $_SESSION['Usu'];

        if($conexion) {
            $consulta1 = "UPDATE `Pedidos` SET `Estado` = ? WHERE `Pedidos`.`ID_Pedido` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $estado, $id);
            $stmt->execute();

            header("Location: ../cocina.php");
        }
    }else{
        header("Location: ../IniciarSesion/signIn.html");
    }
?>