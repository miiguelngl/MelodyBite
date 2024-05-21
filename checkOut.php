<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/check-out.css">
    <script src="js/despliegueMenu.js" defer></script>
    <script src="js/productos.js" defer></script>
    <script src="js/listaCompra.js" defer></script>
    <script src="js/burgersAddForm.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div class="case">
            <?php
                include 'php/conexion.php';
                if (isset($_SESSION['Usu'])) {
                    $username = $_SESSION['Usu'];
                    $consulta = "SELECT * FROM `Usuario` WHERE `Apodo` = ?";

                    $stmt = $conexion->prepare($consulta);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();


                    $resultado = $stmt->get_result();
                    $usuario = $resultado->fetch_assoc();


                    echo '<div id="form-contact">';
                        echo '<form action="php/hacerPedido.php" method="post">';
                            echo '<h2>DATOS DE PAGO</h2>';
                            echo '<label for="">Nombre</label>';
                            echo '<input type="text" name="nombre" value="'.$usuario['Nombre'].'">';
                            echo '<label for="">Apellidos</label>';
                            echo '<input type="text" name="apellido" value="'.$usuario['Apellidos'].'">';
                            echo '<label for="">Dirección</label>';
                            echo '<input type="text" name="direccion" value="'.$usuario['Direccion'].'">';
                            echo '<div id="puertaPiso">';
                                echo '<div id="piso">';
                                    echo '<label for="">Piso</label><br>';
                                    echo '<input type="text" name="piso" id="pisoInput" value="">';
                                echo '</div>';
                                echo '<div id="puerta">';
                                    echo '<label for="">Puerta</label><br>';
                                    echo '<input type="text" name="puerta" id="puertaInput" value="">';
                                echo '</div>';
                            echo '</div>';
                            echo '<label for="">Tarjeta</label>';
                            echo '<input type="number" min="0" pattern="[0-9]{12}" placeholder="Nº tarjeta">';
                            echo '<label for="">CVV</label>';
                            echo '<input type="number" min="0" pattern="[0-9]{3}" value="" placeholder="CVV">';
                            echo '<input type="text"  value="" name="hamburguesas" style="display: none;">';
                            echo '<input type="submit" class="finalizarCompra" value="REALIZAR PEDIDO">';
                        echo '</form>';
                    echo '</div>';
                    $stmt->close();
                }
            ?>
            <div class="lista-compra">
                <div id="lista">
                
                </div>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>