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
                        if (!isset($_SESSION['Usu'])) {
                            header("Location: index.php");
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

                                if ($usuario['Tipo_usuario'] == 2 || $usuario['Tipo_usuario'] == 1) {
                                    echo '<hr><h5>Organización interna</h5>';
                                    echo '<div class="organizacion">';
                                        echo '<a href="cocina.php">Cocina</a>';
                                        echo '<a href="gestionarBurgers.php">Hamburguesas</a>';
                                        if($usuario['Tipo_usuario'] == 1){
                                            echo '<a href="darPermisos.php">Usuarios</a>';
                                            echo '<a href="cs_cocina.php">Todos los pedidos</a>';
                                        }
                                    echo '</div>';
                                }
                                if ($usuario['Tipo_usuario'] == 3){
                                    echo '<hr><h5>Organización interna</h5>';
                                    echo '<div class="organizacion">';
                                        echo '<a href="repartos.php">Repartos</a>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="case-pedidos-perfil">
                    <div class="titulo-perfil">
                        <h2>
                            <?php
                                if ($usuario['Tipo_usuario'] == 3) {
                                    echo 'Pedidos para repartir';
                                }else echo 'Pedidos realizados';
                            ?>
                        </h2>
                    </div>
                    <div class="info-perfil">
                        <div class="info-perfil-overflow">
                            <?php
                                if ($usuario['Tipo_usuario'] != 3) {
                                    $consulta2 = "SELECT * FROM `Pedidos` WHERE `ID_Usuario` = ?";

                                    $stmt = $conexion->prepare($consulta2);
                                    $stmt->bind_param("s", $usuario['IdUsuario']);
                                    $stmt->execute();
            
                                    $resultado2 = $stmt->get_result();
                                    while($pedido = $resultado2->fetch_assoc()) {
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
                                    }
                                }else{
                                    // Suponiendo que ya tienes la conexión a la base de datos en $conexion
                                    $consulta2 = "SELECT * FROM `Repartidores` WHERE `ID_Usuario` = ?";

                                    $stmt = $conexion->prepare($consulta2);
                                    $stmt->bind_param("i", $usuario['IdUsuario']);
                                    $stmt->execute();

                                    $resultado2 = $stmt->get_result();
                                    $repartidor = $resultado2->fetch_assoc();

                                    if ($repartidor) {
                                        $consulta3 = "SELECT * FROM `Pedidos` WHERE `ID_Repartidor` = ?";

                                        $stmt2 = $conexion->prepare($consulta3);
                                        $stmt2->bind_param("i", $repartidor['ID_Repartidor']); // Cambié 's' a 'i' porque ID_Repartidor parece ser un entero
                                        $stmt2->execute();

                                        $resultado3 = $stmt2->get_result();
                                        while ($pedido = $resultado3->fetch_assoc()) {
                                            echo '<div class="case-pedido">';
                                            echo '<h2>Pedido número: '. $pedido['ID_Pedido'] .'</h2>';
                                            if ($pedido['Estado'] == 1) {
                                                echo '<h5>Estado del pedido: <br><span>En reparto</span></h5><hr>';
                                            } else {
                                                echo '<h5>Estado del pedido: <br><span>Entregado</span></h5><hr>';
                                            }
                                            echo '</div>';
                                        }
                                    } else {
                                        echo 'No se encontró el repartidor.';
                                    }
                                }
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
                                echo '<form method="POST" action="php/cambiarDatos.php">';
                                    echo '<label for="">Nombre:</label>';
                                    echo '<input type="text" name="nombre" value="'.$usuario['Nombre'].'">';
                                    echo '<input type="number" name="tipo" value="1" style="display: none;">';
                                    echo '<input type="submit" class="cambiar" value="Cambiar">';
                                echo '</form>';
                                echo '<hr>';
                                echo '<form method="POST" action="php/cambiarDatos.php">';
                                    echo '<label for="">Apellidos:</label>';
                                    echo '<input type="text" name="apellido" value="'.$usuario['Apellidos'].'">';
                                    echo '<input type="number" name="tipo" value="2" style="display: none;">';
                                    echo '<input type="submit" class="cambiar" value="Cambiar">';
                                echo '</form>';
                                echo '<hr>';
                                echo '<form method="POST" action="php/cambiarDatos.php">';
                                    echo '<label for="">Dirección:</label>';
                                    echo '<input type="text" name="direccion" value="'.$usuario['Direccion'].'">';
                                    echo '<input type="number" name="tipo" value="3" style="display: none;">';
                                    echo '<input type="submit" class="cambiar" value="Cambiar">';
                                echo '</form>';
                                echo '<hr>';
                                echo '<form method="POST" action="php/cambiarDatos.php">';
                                    echo '<label for="">Contraseña:</label>';
                                    echo '<input type="password" name="contrasenya" value="">';
                                    echo '<input type="number" name="tipo" value="4" style="display: none;">';
                                    echo '<input type="submit" class="cambiar" value="Cambiar">';
                                echo '</form>';
                                echo '<hr>';
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