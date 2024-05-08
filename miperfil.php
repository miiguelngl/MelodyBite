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
                        <li>Mis datos</li>
                        <li>Mis pedidos</li>
                        <li>Cambiar datos</li>
                        <li id="cerrar">Cerrar sesión</li>
                    </ul>
                </div>
            </div>
            <div class="datos-perfil">
                <div class="case-datos-perfil">
                
                </div>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>