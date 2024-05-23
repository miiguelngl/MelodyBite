<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhapsody's Burgers</title>
    <link rel="stylesheet" href="css/normalize.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/gestiones.css">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './php/conexion.php';
session_start();
//Comprobar que tiene sesion iniciada
include './php/header.php';
if(isset($_SESSION["Usu"])){
    $idUsu = $_SESSION["Usu"];
    //Comprobar que la sesion iniciada sea Admin
    $consulta1 = "SELECT * FROM `Usuario` WHERE `Apodo` =  ?";
    
    $stmt = $conexion->prepare($consulta1);
    $stmt->bind_param("s", $idUsu);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $array = $result->fetch_assoc();
        
        if($array["Tipo_usuario"] == 1){
            //CONTENIDO DEL ADMIN.PHP

            //MOSTRAR TODOS LOS USUARIO NO VALIDADAS

            $consulta2 = "SELECT * FROM `Hamburguesas`";

            $stmt2 = $conexion->prepare($consulta2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if($result2->num_rows > 0){
                $array2 = $result2->fetch_assoc();
                //Bucle para cada solicitud
                echo "<table>";
                echo "<tr><th>IdHamburguesa</th><th>Nombre</th><th>Precio</th><th>Ingredientes</th></tr>";
                // while ($array2 = $result2->fetch_assoc()) {
                //     echo "<tr><td>".$array2['IdHamburguesa']."</td><td><p>".$array2['Nombre']."</p></td><td>".$array2['Precio']."</td><td>".$array2['Ingredientes']."</td></tr>";
                // }
                foreach ($result2 as $hamburguesa) {
                    echo "<tr>";
                    echo "<td>" . $hamburguesa['IdHamburguesa'] . "</td>";
                    echo "<td><p>" . $hamburguesa['Nombre'] . "</p></td>";
                    echo "<td>" . $hamburguesa['Precio'] . "</td>";
                    echo "<td>" . $hamburguesa['Ingredientes'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<nav class='menu'><a href=miperfil.php>Volver</a></nav>";
            }
        }else{
            echo("<h4>ERROR 404 NOT FOUND</h4>");
        }
    }else{
        echo("<h4>ERROR 404 NOT FOUND</h4>");
    }
    }else{
        echo("<h4>ERROR 404 NOT FOUND</h4>");
    }
?>
</body>
</html>