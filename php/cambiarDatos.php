<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    // Conexion BBDD
    include("conexion.php");
    session_start();
    
    // Comprueba si existe sesión iniciada
    if (!isset($_SESSION['Usu'])) {
        header("Location: ../IniciarSesion/signIn.html");
        exit();
    }
    
    // Obteniendo el nombre de usuario desde la sesión
    $username = $_SESSION['Usu'];
    
    
    
    $tipo = $_POST["tipo"];
    
    // Consulta para obtener el ID del usuario
    $consulta = "SELECT * FROM `Usuario` WHERE `Apodo` = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $id = $usuario['IdUsuario'];
    
    if ($tipo == 1) {
        $nombre = $_POST["nombre"];
        $consulta1 = "UPDATE `Usuario` SET `Nombre` = ? WHERE `IdUsuario` = ?";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bind_param("si", $nombre, $id);
        $stmt->execute();
        header("Location: ../miperfil.php");
    } elseif ($tipo == 2) {
        $apellido = $_POST["apellido"];
        $consulta1 = "UPDATE `Usuario` SET `Apellidos` = ? WHERE `IdUsuario` = ?";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bind_param("si", $apellido, $id);
        $stmt->execute();
        header("Location: ../miperfil.php");
    } elseif ($tipo == 3) {
        $direccion = $_POST["direccion"];
        $consulta1 = "UPDATE `Usuario` SET `Direccion` = ? WHERE `IdUsuario` = ?";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bind_param("si", $direccion, $id);
        $stmt->execute();
        header("Location: ../miperfil.php");
    } elseif ($tipo == 4) {
        $contrasenya = password_hash($_POST["newcontrasenya"], PASSWORD_DEFAULT);
        $consulta1 = "UPDATE `Usuario` SET `Contrasena` = ? WHERE `IdUsuario` = ?";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bind_param("si", $contrasenya, $id);
        $stmt->execute();
        header("Location: ../miperfil.php");
    }
?>