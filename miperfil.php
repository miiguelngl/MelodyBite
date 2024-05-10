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
                        <li class="active-menu" data-menu="datos">Mis datos</li>
                        <li data-menu="pedidos">Mis pedidos</li>
                        <li data-menu="cambiar">Cambiar datos</li>
                        <li id="cerrar">Cerrar sesión</li>
                    </ul>
                </div>
            </div>
            <div class="datos-perfil">
                <div class="case-datos-perfil active">
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
                        <div class="info-perfil-overflow">
                            <?php
                                echo '<h5>Nombre: <br><span>'.$usuario['Nombre'].'</span></h5><hr>';
                                echo '<h5>Apellidos: <br><span>'.$usuario['Apellidos'].'</span></h5><hr>';
                                echo '<h5>Correo: <br><span>'.$usuario['Correo'].'</span></h5><hr>';
                                echo '<h5>Dirección: <br><span>'.$usuario['Direccion'].'</span></h5>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="case-pedidos-perfil">
                    <div class="titulo-perfil">
                        <h2>
                            <?php
                                echo 'Pedidos realizados';
                            ?>
                        </h2>
                    </div>
                    <div class="info-perfil">
                        <div class="info-perfil-overflow">
                            <?php
                                $consulta2 = "SELECT * FROM `Pedidos` WHERE `ID_Usuario` = ?";

                                $stmt = $conexion->prepare($consulta2);
                                $stmt->bind_param("s", $usuario['IdUsuario']);
                                $stmt->execute();
        
                                $resultado2 = $stmt->get_result();
                                $pedidos = $resultado2->fetch_assoc();

                                // foreach ($pedidos as $pedido) {
                                    echo '<div class="case-pedido">';
                                    echo '<h2>Pedido número: '. $pedido['ID_Pedido'] .'</h2>';
                                    if ($pedido['Estado'] == 0) {
                                        echo '<h5>Estado del pedido: <br><span>Oido cocina - En preparación</span></h5><hr>';
                                    }else if($pedido['Estado'] == 1){
                                        echo '<h5>Estado del pedido: <br><span>En reparto</span></h5><hr>';
                                    }else{
                                        echo '<h5>Estado del pedido: <br><span>Entregado</span></h5><hr>';
                                    }
                                    echo '</div>';
                                // }
                                
                            ?>
                        </div>
                    </div>
                </div>
                <div class="case-cambiar-perfil">
                    <div class="titulo-perfil">
                        <h2>
                            <?php
                                echo 'Cambiar datos del perfil';
                            ?>
                        </h2>
                    </div>
                    <div class="info-perfil">
                        <div class="info-perfil-overflow">
                            <?php
                                echo '<h5>Nombre: <br><span>'.$usuario['Nombre'].'</span></h5><hr>';
                                echo '<h5>Apellidos: <br><span>'.$usuario['Apellidos'].'</span></h5><hr>';
                                echo '<h5>Correo: <br><span>'.$usuario['Correo'].'</span></h5><hr>';
                                echo '<h5>Dirección: <br><span>'.$usuario['Direccion'].'</span></h5>';
                                // $stmt->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
    <script src="js/menuPerfil.js" defer></script>
</body>
</html>