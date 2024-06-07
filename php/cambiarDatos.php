<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $tipo = $_POST["tipo"];

    //Conexion BBDD
    include("conexion.php");

    session_start();

    $consulta = "SELECT * FROM `Usuario` WHERE `Apodo` = ?";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $id= $usuario['IdUsuario'];

    //Comprueba si existe sesion iniciada
    if(isset($_SESSION['Usu'])){
        $Us = $_SESSION['Usu'];

        if($tipo == 1){

            $nombre = $_POST["nombre"];
            $consulta1 = "UPDATE `Usuario` SET `Nombre` = ? WHERE `Usuario`.`IdUsuario` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $nombre, $id);
            $stmt->execute();

            header("Location: ../miperfil.php");

        }else if($tipo == 2){

            $apellido = $_POST["apellido"];
            $consulta1 = "UPDATE `Usuario` SET `Apellidos` = ? WHERE `Usuario`.`IdUsuario` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $apellido, $id);
            $stmt->execute();

            header("Location: ../miperfil.php");

        }else if($tipo == 3){

            $direccion = $_POST["direccion"];
            $consulta1 = "UPDATE `Usuario` SET `Direccion` = ? WHERE `Usuario`.`IdUsuario` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $direccion, $id);
            $stmt->execute();

            header("Location: ../miperfil.php");

        }else if($tipo == 4){

            $contrasenya = password_hash($_POST["contrasenya"], PASSWORD_DEFAULT);

            $consulta1 = "UPDATE `Usuario` SET `Contrasena` = ? WHERE `Usuario`.`IdUsuario` = ?;";
            $stmt = $conexion->prepare($consulta1);
            $stmt->bind_param("ss", $contrasenya, $id);
            $stmt->execute();

            header("Location: ../miperfil.php");

        }
    }else{
        header("Location: ../IniciarSesion/signIn.html");
    }
?>