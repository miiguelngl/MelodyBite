<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/despliegueMenu.js" defer></script>
    <script src="js/sliderFrases.js" defer></script>
    <script src="js/productos.js" defer></script>
    <title>Rhapsody's Burgers</title>
</head>
<body>
    <?php
        include './php/header.php';
    ?>
    <main>
        <div id="video-slider">
            <div id="video-slider-frase">
                <h2>Ritmo en cada bocado</h2>
            </div>
            <div id="capa"></div>
            <video src="vid/4131833-hd_1920_1080_24fps.mp4" autoplay="" loop="" muted="muted" controlslist="nodownload"></video>
        </div>
        <div class="contenedor">
            <div class="texto-desplazante">¡Sabor que suena a vinilo! · Dale sabor a tu música con nuestras hamburguesas · Hamburguesas con alma de vinilo · Descubre el sabor vintage de nuestras hamburguesas</div>
        </div>
        <div class="sobre-nosotros">
            <div id="sobre-nosotros-img">
                
            </div>
            <div class="sobre-nosotros-contenido">
                <h2>Sonido en cada bocado</h2>
                <p>
                    En nuestro acogedor rincón culinario, te invitamos a disfrutar de una experiencia gastronómica única. Sumérgete en el mundo de las hamburguesas gourmet, donde cada bocado es una explosión de sabor y calidad.<br><br>
                    Nuestro compromiso es ofrecerte hamburguesas irresistibles, elaboradas con ingredientes frescos y seleccionados cuidadosamente para garantizar la mejor calidad en cada plato que servimos. Desde clásicas hamburguesas con queso fundido hasta creaciones innovadoras con ingredientes exóticos, nuestro menú está diseñado para satisfacer todos los gustos y antojos.
                </p>
            </div>
        </div>
        <div class="carta">
            <h2>La melodía en nuestras hamburguesas</h2>
            <a href="carta.php">Ver carta</a>
        </div>
        <div id="info-local-reserva">
            <div class="local">
                <div class="local-info">
                    <h2>Nuestro local</h2>
                    <p>
                        En Rhapsody´s Burgers, no solo nos esforzamos por ofrecerte las hamburguesas más sabrosas y creativas, sino que también te transportamos a una época dorada de la música. Nuestro local está decorado con una cuidadosa selección de vinilos vintage y modernos, que adornan las paredes y crean una atmósfera retro y acogedora.<br><br>
    
                        Una de las características principales de Rhapsody´s Burgers es nuestro rincón de vinilos, donde los amantes de la música pueden sumergirse en una extensa colección de discos de todos los géneros. Mientras disfrutas de tu hamburguesa favorita, puedes elegir un vinilo de nuestra colección y ponerlo en nuestro tocadiscos vintage para deleitarte con los sonidos cálidos y auténticos que solo el vinilo puede ofrecer.
                    </p>
                </div>
                <div id="local-img">
                    <img src="img/local hamburguesas.png" alt="Local Rhapsody's Burger">
                </div>
            </div>
        </div>
    </main>
    <?php
        include './php/footer.php';
    ?>
</body>
</html>