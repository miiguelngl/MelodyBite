<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/contacto.css">
    <script src="js/despliegueMenu.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div class="case">
            <div id="frase">
                <h2>Reserva en uno de nuestros locales</h2>
            </div>
            <div id="form-contact">
                <form action="">
                    <label for="">Nombre</label>
                    <input type="text" placeholder="Nombre" name="nombre">
                    <label for="">Apellidos</label>
                    <input type="text" placeholder="Apellidos" name="apellidos">
                    <label for="">Local</label>
                    <select name="local">
                        <option value="Gran via" selected>Gran vía</option>
                        <option value="Campanar">Campanar</option>
                        <option value="Aragon">Aragón</option>
                    </select>
                    <label for="">Fecha</label>
                    <input type="date" min="<?php echo date('Y-m-d'); ?>" name="fecha">
                    <label for="">Personas</label>
                    <input type="number" max="8" name="numPersonas">
                    <input type="submit" class="finalizarCompra" value="HACER RESERVA">
                </form>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>