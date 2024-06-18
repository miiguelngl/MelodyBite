<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/contacto.css">
    <script defer src="js/despliegueMenu.js"></script>
    <script defer src="js/formularioContacto.js"></script>
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
                <form action="php/hacerReserva.php" method="post">
                    <div class="centrar">
                        <div class="centrarInput">
                            <label for="">Nombre</label>
                            <input type="text" placeholder="Nombre" name="nombre">
                         </div>
                        <div class="centrarInput">
                            <label for="">Apellidos</label>
                            <input type="text" placeholder="Apellidos" name="apellidos">
                        </div>
                    </div>
                    <label for="">Correo</label>
                    <input type="email" placeholder="Correo" name="correo">
                    <label for="">Local</label>
                    <select name="local">
                        <option value="Gran via" selected>Gran vía</option>
                        <option value="Campanar">Campanar</option>
                        <option value="Aragon">Aragón</option>
                    </select>
                    <div class="centrar">
                        <div class="centrarInput">
                            <label for="">Fecha</label>
                            <input type="date" min="<?php echo date('Y-m-d'); ?>" name="fecha">
                         </div>
                        <div class="centrarInput">
                            <label for="">Hora</label>
                            <select name="hora">
                                <option value="13:00" selected>13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                            </select>
                        </div>
                    </div>
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