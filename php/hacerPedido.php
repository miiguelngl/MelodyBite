<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /* ENVIO */
    $nombreCliente = $_POST["nombre"];
    $apellidoCliente = $_POST["apellido"];
    $direccion = $_POST["direccion"];
    $piso = $_POST["piso"];
    $puerta = $_POST["puerta"];
    $direccionEnt = $direccion . ", Piso: " . $piso . ", Puerta: " . $puerta;
    // $cp = $_POST["cp"];

    /* HAMBURGUESA */
    $burgers = $_POST["hamburguesas"];

    //Conexion BBDD
    include("conexion.php");
    
    session_start();
    //Comprueba si existe sesion iniciada
    if (isset($_SESSION['Usu'])) {
        $us = $_SESSION['Usu'];
    
        // Consulta para obtener el IdUsuario
        $consulta1 = "SELECT * FROM `Usuario` WHERE `Apodo` = ?";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bind_param("s", $us);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows > 0) { // Comprobar si se encontró el usuario
            $fila = $resultado->fetch_assoc();
            $idUsuario = $fila['IdUsuario'];
    
            // Preparar la inserción del pedido
            $subida = "INSERT INTO `Pedidos` (ID_Usuario, Nombre_Cliente, Pedido, Direccion, Estado) VALUES (?, ?, ?, ?, 0)";
            $stmt = $conexion->prepare($subida);
            $stmt->bind_param("isss", $idUsuario, $nombreCliente, $burgers, $direccionEnt);
            $stmt->execute();

            // Enviar email
            enviarMail($fila['Correo'], $nombreCliente);
    
            // Redireccionar a la página de confirmación
            header("Location: ../formulario/confirmacionPedido.html");
            exit();
        } else {
            // Usuario no encontrado, redirigir a la página de inicio de sesión
            header("Location: ../IniciarSesion/signIn.html");
            exit();
        }
    } else {
        // No hay sesión iniciada, redirigir a la página de inicio de sesión
        header("Location: ../IniciarSesion/signIn.html");
        exit();
    }


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarMail($correo, $nombre){
        //Carga de las clases necesarias
        require '../mail/PHPMailer/src/Exception.php';
        require '../mail/PHPMailer/src/PHPMailer.php';
        require '../mail/PHPMailer/src/SMTP.php';

        //Crear una instancia. Con true permitimos excepciones
        $mail = new PHPMailer(true);

        try {
            //Valores dependientes del servidor que utilizamos
            $mail->isSMTP();                                           //Para usaar SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Nuestro servidor SMTMP smtp.gmail.com en caso de usar gmail
            $mail->SMTPAuth   = true;    
            $mail->Username   = 'rhapsodysburgers@outlook.es';             
            $mail->Password   = 'hrvghyjybswnfche';    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            //Remitente
            $mail->setFrom('rhapsodysburgers@outlook.es', 'Rhapsody´s Burgers');
            //Receptores. Podemos añadir más de uno. El segundo argumento es opcional, es el nombre
            $mail->addAddress($correo, $nombre);     //Add a recipient
            //Contenido
            //Si enviamos HTML
            $mail->isHTML(true);    
            $mail->CharSet = "UTF8";    
            //Asunto
            $mail->Subject = '¡Tu bocado está más cerca!';
            //Conteido HTML
            $mail->Body    = '<h3>¡Hola '. $nombre .', tu pedido está ya en cocina!</h3><br><p>Puedes seguir el proceso del pedido en tu perfil.</p>';
            //Contenido alternativo en texto simple
            $mail->AltBody = '¡Hola '. $nombre .', tu cuenta a sido creado correctamente. Ahora podras disfrutar de todos los servicios que ofrecemos';
            //Enviar correo
            $mail->send();
            echo 'El mensaje se ha enviado con exito';
        } catch (Exception $e) {
            echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
            
        }
    }
?>