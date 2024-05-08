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
    <script src="js/cerrarSesion.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div class="case">
            <div class="menu-perfil">
                <div class="lista-menu-perfil">
                    <ul>
                        <li class="active">Mis datos</li>
                        <li>Mis pedidos</li>
                        <li>Cambiar datos</li>
                        <li id="cerrar">Cerrar sesión</li>
                    </ul>
                </div>
            </div>
            <div class="datos-perfil">
                <div class="case-datos-perfil">
                    <?php
                        include 'php/conexion.php';
                        // session_start();
                        if (!isset($_SESSION['Usu'])) {
                            header("Location: ./index.php");
                        }
                        $username = $_SESSION['Usu'];
                        $consulta = "SELECT * FROM `Usuario` WHERE `Apodo` = ?";

                        $stmt = $conexion->prepare($consulta);
                        $stmt->bind_param("s", $username);
                        $stmt->execute();


                        $resultado = $stmt->get_result();
                        $usuario = $resultado->fetch_assoc();
                    ?>
                    <div class="titulo-perfil">
                        <h2>
                            <?php
                                echo 'Bienvenido/a '.$usuario['Nombre'];
                            ?>
                        </h2>
                    </div>
                    <div class="info-perfil">
                        <?php
                            echo '<h5>Nombre: <span>'.$usuario['Nombre'].'</span></h5>';
                            echo '<h5>Apellidos: <span>'.$usuario['Apellidos'].'</span></h5>';
                            echo '<h5>Correo: <span>'.$usuario['Correo'].'</span></h5>';
                            $stmt->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>