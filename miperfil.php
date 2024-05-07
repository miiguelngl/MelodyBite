<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/perfil.css">
    <script src="js/despliegueMenu.js" defer></script>
    <script src="js/productos.js" defer></script>
    <script src="js/listaCompra.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div class="case">
            <div class="case-perfil">
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
                            echo '<form action="">';
                                echo '<label for="">Nombre</label>';
                                echo '<input type="text" value="'.$usuario['Nombre'].'">';
                                echo '<label for="">Apellidos</label>';
                                echo '<input type="text" value="'.$usuario['Apellidos'].'">';
                                echo '<label for="">Dirección</label>';
                                echo '<input type="text" value="'.$usuario['Direccion'].'">';
                            echo '</form>';
                        echo '</div>';
                        $stmt->close();
                    }
                ?>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>