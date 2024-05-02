<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/carta.css">
    <script src="js/despliegueMenu.js" defer></script>
    <script src="js/productos.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div class="carta">
            <?php
                include './php/hamburguesas.php';
            ?>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>