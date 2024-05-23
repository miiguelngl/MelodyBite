<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhapsody's Burgers</title>
    <link rel="stylesheet" href="css/normalize.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/gestiones.css">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './php/conexion.php';
session_start();
//Comprobar que tiene sesion iniciada
include './php/header.php';
if(isset($_SESSION["Usu"])){
    $idUsu = $_SESSION["Usu"];
    //Comprobar que la sesion iniciada sea Admin
    $consulta1 = "SELECT * FROM `Usuario` WHERE `Apodo` =  ?";
    
    $stmt = $conexion->prepare($consulta1);
    $stmt->bind_param("s", $idUsu);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $array = $result->fetch_assoc();
        
        if($array["Tipo_usuario"] == 1){
            //CONTENIDO DEL ADMIN.PHP

            //MOSTRAR TODOS LOS USUARIO NO VALIDADAS

            $consulta2 = "SELECT * FROM `Usuario`";

            $stmt2 = $conexion->prepare($consulta2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if($result2->num_rows > 0){
                $array2 = $result2->fetch_assoc();
                //Bucle para cada solicitud
                echo "<table>";
                echo "<tr><th>IdUsuario</th><th>Nombre</th><th>Correo</th><th>Tipo usuario</th><th>Estado</th></tr>";
                while ($array2 = $result2->fetch_assoc()) {
                    echo "<tr><td>".$array2['IdUsuario']."</td><td><p>".$array2['Apodo']."</p></td><td>".$array2['Correo']."</td><td>";
                    if($array2['Tipo_usuario'] == 0){
                        echo "Cliente</td>";
                    } elseif($array2['Tipo_usuario'] == 1){
                        echo "Administrador</td>";
                    } else {
                        echo "Cocinero</td>";
                    }
                    echo "<td class='estado'>
                    <form action='php/darUsuario.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$array2['IdUsuario']."'>
                        <input type='hidden' name='tipo_usuario' value='1'>
                        <input type='submit' id='enviar_admin' class='btn btn-success' value='Dar Admin'>
                    </form>
                    <form action='php/darUsuario.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$array2['IdUsuario']."'>
                        <input type='hidden' name='tipo_usuario' value='2'>
                        <input type='submit' id='enviar_cocinero' class='btn btn-success' value='Dar Cocinero'>
                    </form>
                    <form action='php/darUsuario.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$array2['IdUsuario']."'>
                        <input type='hidden' name='tipo_usuario' value='0'>
                        <input type='submit' id='enviar_cocinero' class='btn btn-danger' value='Quitar Permisos'>
                    </form>
                    </td></tr>";
                }
                echo "</table>";
                echo "<nav class='menu'><a href=./admin.php>Validar Productos</a></nav>";
            }else{
                echo "<p style=text-align:center>No hay Solicitudes</p>";
                echo "<nav class='menu'><a href=./admin>Validar Zapatillas</a></nav>";
            }
        }else{
            echo("<h4>ERROR 404 NOT FOUND</h4>");
        }
    }else{
        echo("<h4>ERROR 404 NOT FOUND</h4>");
    }
    }else{
        echo("<h4>ERROR 404 NOT FOUND</h4>");
    }
?>
</body>
</html>