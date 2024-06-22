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

            if ($estado == 0) {
                header("Location: ../cocina.php");
            }elseif ($estado == 1) {
                asignarRepartidor($id);
                header("Location: ../cocina.php");
            }elseif ($estado == 2) {
                header("Location: ../miperfil.php");
            }
        }
    }else{
        header("Location: ../IniciarSesion/signIn.html");
    }

    function asignarRepartidor($idPedido){
        global $conexion; // Usa la conexión global

        // Obtener todos los IDs de repartidores
        $consulta = "SELECT ID_Repartidor FROM repartidores";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            // Recoger todos los IDs de repartidores en un array
            $repartidores = [];
            while ($row = $resultado->fetch_assoc()) {
                $repartidores[] = $row['ID_Repartidor'];
            }

            // Seleccionar un ID de repartidor al azar
            $repartidorAleatorio = $repartidores[array_rand($repartidores)];

            // Asignar el repartidor al pedido
            $consultaUpdate = "UPDATE pedidos SET ID_Repartidor = ? WHERE ID_Pedido = ?";
            $stmt = $conexion->prepare($consultaUpdate);
            $stmt->bind_param("ii", $repartidorAleatorio, $idPedido);
            $stmt->execute();
            $stmt->close();
            
        } else {
            echo "No hay repartidores disponibles.";
        }

        $resultado->close();
    }
?>