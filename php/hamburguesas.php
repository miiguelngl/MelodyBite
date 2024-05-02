<?php
    include("conexion.php");

    // Consulta para obtener todas las hamburguesas
    $sql = "SELECT * FROM hamburguesas";
    $hamburguesas = $conexion->query($sql);

    if ($hamburguesas->num_rows > 0) {
        // Mostrar cada hamburguesa
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $num = 0;

        while($hamburguesa = $hamburguesas->fetch_assoc()) {
            if($num == 0 | $num == 3){
                echo '<div class="carta-fila">';
            }
            echo '<div class="carta-case">';
            echo '<div class="carta-case-2">';
            echo '<div class="contenedor-img">';
            echo '<img src="img/Hamburguesas/' . $hamburguesa["Nombre"] . '.png" alt="" class="imgBurger" data-ingredientes="' . $hamburguesa["Ingredientes"] . '">';
            echo '<svg id="lupa" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-nombre="' . $hamburguesa["Nombre"] . '" data-descripcion="' . $hamburguesa["Descripcion"] . '" data-precio="' . $hamburguesa["Precio"] . '">';
            echo '<circle cx="11" cy="11" r="8"/>';
            echo '<line x1="21" y1="21" x2="16.65" y2="16.65"/>';
            echo '</svg>';
            echo '</div>';
            echo '<h2>' . $hamburguesa["Nombre"] . '</h2>';
            echo '<p>' . $hamburguesa["Descripcion_corta"] . '</p>';
            echo '</div>';
            if(isset($_SESSION['Usu'])){
                echo '
                <div class="carta-case-3">
                    <button class="añadir" id="comprar" name="' . $hamburguesa["Nombre"] . '" data-precio="' . $hamburguesa["Precio"] . '">La quiero</button>
                    <button class="añadir" id="precio" name="' . $hamburguesa["Nombre"] . '" data-precio="' . $hamburguesa["Precio"] . '">' . $hamburguesa["Precio"] . '€</button>
                </div>
                ';
            }
            echo '</div>';
            if($num == 2 | $num == 5){
                echo '</div>';
            }
            $num++;
        }
    } else {
        echo "No se encontraron hamburguesas.";
    }
    // $conn->close();
?>