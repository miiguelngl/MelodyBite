<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $id=$_POST["id"];
    $tipo_usuario = $_POST["tipo_usuario"];

    //Conexion BBDD
    include("conexion.php");

    session_start();
    //Comprueba si existe sesion iniciada
    if(isset($_SESSION['Usu'])){
        $Us = $_SESSION['Usu'];

        if($conexion) {
            $consulta1 = "UPDATE `usuario` SET `Tipo_usuario` = ? WHERE `usuario`.`IdUsuario` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $tipo_usuario, $id);
            $stmt->execute();

            header("Location: ../darPermisos.php");
        }
    }else{
        header("Location: ../IniciarSesion/signIn.html");
    }
?>