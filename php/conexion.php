<?php
    $servername = "localhost";          //opal.c1ocwiak66or.us-east-1.rds.amazonaws.comNombre del servidor de la base de datos
    $username = "RhapsodyAdmin";            //Nombre de usuario de la base de datos
    $password = "PabloMotos69";  //Contraseña de la base de datos Yovoyahaceruncorral
    $bdname = "rhapshody_burger";                   //Nombre de la base de datos
    // Crear conexión
    $conexion = new mysqli ($servername, $username, $password, $bdname);
    if ($conexion->connect_error) {
        die ("No se pudo conectar a la base de datos:". $conexion->connect_error);
    }  
    
?>