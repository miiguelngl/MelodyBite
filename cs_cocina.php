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
    $consulta1 = "SELECT * FROM `usuario` WHERE `Apodo` =  ?";
    
    $stmt = $conexion->prepare($consulta1);
    $stmt->bind_param("s", $idUsu);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $array = $result->fetch_assoc();
        
        if($array["Tipo_usuario"] == 1){
            //CONTENIDO DEL ADMIN.PHP

            //MOSTRAR TODOS LOS USUARIO NO VALIDADAS

            $consulta2 = "SELECT * FROM `pedidos`";

            $stmt2 = $conexion->prepare($consulta2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if($result2->num_rows > 0){
                $array2 = $result2->fetch_assoc();
                echo "<table>";
                echo "<tr><th>Nº Pedido</th><th>Repartidor</th><th>Pedido</th><th>Estado</th><th>Cambiar estado</th></tr>";
                foreach ($result2 as $pedido) {
                    echo "<tr>";
                    echo "<td>" . $pedido['ID_Pedido'] . "</td>";
                    if($pedido['ID_Repartidor'] == NULL || $pedido['ID_Repartidor'] == ""){
                        echo "<td>Repartidor no asignado</td>";
                    }else{
                        $consultaRep = "SELECT * FROM `repartidores` WHERE `ID_Repartidor` = ?";

                        $stmt3 = $conexion->prepare($consultaRep);
                        $stmt3->bind_param("i", $pedido['ID_Repartidor']);
                        $stmt3->execute();

                        $resultado3 = $stmt3->get_result();
                        $repartidor = $resultado3->fetch_assoc();

                        $consultaNombreRep = "SELECT * FROM `usuario` WHERE `IdUsuario` =  ?";

                        $stmt4 = $conexion->prepare($consultaNombreRep);
                        $stmt4->bind_param("i", $repartidor['ID_Usuario']);
                        $stmt4->execute();

                        $resultado4 = $stmt4->get_result();
                        $datosRepartidor = $resultado4->fetch_assoc();

                        echo "<td>" . $datosRepartidor['Nombre'] . "</td>";
                    }
                    echo "<td>";
                        $burgers = explode("}, ", $pedido['Pedido']);

                        if (end($burgers) !== "") {
                            $burgers[count($burgers) - 1] .= "}";
                        }

                        foreach ($burgers as $burger) {
                            $parts = explode(" - {EXTRAS: ", $burger);

                            if (count($parts) == 2) {
                                $name = $parts[0];
                                $extras = rtrim($parts[1], '}');
                            } else {
                                $name = $burger;
                                $extras = '';
                            }

                            echo "Hamburguesa: " . $name . "<br>";

                            if (!empty($extras)) {
                                echo "Extras: " . $extras . "<br><br>";
                            } else {
                                echo "Extras: Ninguno<br><br>";
                            }
                        }
                    echo "</td>";

                    if($pedido['Estado'] == 0){
                        echo "<td>Oido cocina</td>";
                    }elseif($pedido['Estado'] == 1){
                        echo "<td>En reparto</td>";
                    }else{
                        echo "<td>Entregado</td>";
                    };
                    echo "<td class='estado'>
                    <form action='php/cambiarPedido.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$pedido['ID_Pedido']."'>
                        <input type='hidden' name='estado' value='0'>
                        <input type='submit' id='enviar_admin' class='btn btn-success' value='En cocina'>
                    </form>
                    <form action='php/cambiarPedido.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$pedido['ID_Pedido']."'>
                        <input type='hidden' name='estado' value='1'>
                        <input type='submit' id='enviar_cocinero' class='btn btn-success' value='En reparto'>
                    </form>
                    <form action='php/cambiarPedido.php' method='post' enctype='multipart/form-data'>
                        <input type='number' id='id' name='id' class='d-none' value='".$pedido['ID_Pedido']."'>
                        <input type='hidden' name='estado' value='2'>
                        <input type='submit' id='enviar_cocinero' class='btn btn-success' value='Entregado'>
                    </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo '<nav class="submenu"><a href="miperfil.php">Volver</a>';
                echo '<a href="gestionarBurgers.php">Ver hamburguesas</a></nav>';
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