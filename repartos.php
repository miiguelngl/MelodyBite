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
    <script src="js/despliegueMenu.js" defer></script>
    <script src="js/productos.js" defer></script>
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
        
        if($array["Tipo_usuario"] == 1 || $array["Tipo_usuario"] == 3){
            //CONTENIDO DEL ADMIN.PHP

            //MOSTRAR TODOS LOS USUARIO NO VALIDADAS

            $consulta2 = "SELECT * FROM `Pedidos`";

            $stmt2 = $conexion->prepare($consulta2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if($result2->num_rows > 0){
                $array2 = $result2->fetch_assoc();
                echo "<table>";
                echo "<tr><th>Nº Pedido</th><th>Nombre del cliente</th><th>Dirección</th><th>Estado</th><th>Cambiar estado</th></tr>";
                foreach ($result2 as $pedido) {
                    if($pedido['Estado'] == 1){
                        echo "<tr>";
                        echo "<td>" . $pedido['ID_Pedido'] . "</td>";
                        echo "<td>" . $pedido['Nombre_Cliente'] . "</td>";
                        echo "<td>" . $pedido['Direccion'] . "</td>";
    
                        if($pedido['Estado'] == 1){
                            echo "<td>En reparto</td>";
                        }else{
                            echo "<td>Entregado</td>";
                        };
                        echo "<td class='estado'>
                        <form action='php/cambiarPedido.php' method='post' enctype='multipart/form-data'>
                            <input type='number' id='id' name='id' class='d-none' value='".$pedido['ID_Pedido']."'>
                            <input type='hidden' name='estado' value='2'>
                            <input type='submit' id='enviar_cocinero' class='btn btn-success' value='Entregado'>
                        </form>
                        </td>";
                        echo "</tr>";
                    } 
                }
                echo "</table>";
                echo '<nav class="submenu"><a href="miperfil.php">Volver</a></nav>';
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