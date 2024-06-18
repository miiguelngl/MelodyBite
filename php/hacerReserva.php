<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /* ENVIO */
    
    $nombreCliente = $_POST["nombre"];
    $apellidoCliente = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $local = $_POST["local"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $numPersonas = $_POST["numPersonas"];

    $nombreCompleto = $nombreCliente . " " . $apellidoCliente;

    //Conexion BBDD
    include("conexion.php");
    
    session_start();
    //Comprueba si existe sesion iniciada
    if (isset($_SESSION['Usu'])) {
        enviarMailCliente($correo, $nombreCliente, $nombreCompleto, $local, $fecha, $hora, $numPersonas);
        header("Location: ../formulario/confirmacionSolicitud.html");
    } else {
        // No hay sesión iniciada, redirigir a la página de inicio de sesión
        header("Location: ../formulario/IniciarSesion/signIn.html");
        exit();
    }


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarMailCliente($correo, $nombreCliente, $nombreCompleto, $local, $fecha, $hora, $numPersonas){
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
            $mail->addAddress($correo, $nombreCliente);     //Add a recipient
            //Contenido
            //Si enviamos HTML
            $mail->isHTML(true);    
            $mail->CharSet = "UTF8";    
            //Asunto
            $mail->Subject = '¡Estamos mirando tu reserva en '. $local .'!';
            //Conteido HTML
            $mail->Body    = '<h3>¡Hola '. $nombreCliente .'!<br>Estamos viendo la disponibilidad para la reserva de '. $local . ' a las ' . $hora .' el día ' . $fecha . ' para ' . $numPersonas .'.</h3><p>Nos pondremos en contacto contigo para confirmarte la reserva.</p><p>¡Un saludo!</p>';
            //Contenido alternativo en texto simple
            $mail->AltBody = '¡Hola '. $nombreCliente .', tu cuenta a sido creado correctamente. Ahora podras disfrutar de todos los servicios que ofrecemos';
            //Enviar correo
            $mail->send();
            echo 'El mensaje se ha enviado con exito';

            $mail2 = new PHPMailer(true);
            $mail2->isSMTP();                                           //Para usaar SMTP
            $mail2->Host       = 'smtp-mail.outlook.com';                     //Nuestro servidor SMTMP smtp.gmail.com en caso de usar gmail
            $mail2->SMTPAuth   = true;    
            $mail2->Username   = 'rhapsodysburgers@outlook.es';             
            $mail2->Password   = 'hrvghyjybswnfche';    
            $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail2->Port = 587;
            //Remitente
            $mail2->setFrom('rhapsodysburgers@outlook.es', 'Rhapsody´s Burgers');
            //Receptores. Podemos añadir más de uno. El segundo argumento es opcional, es el nombre
            $mail2->addAddress('rhapsodysburgers@outlook.es', 'Reserva');     //Add a recipient
            //Contenido
            //Si enviamos HTML
            $mail2->isHTML(true);    
            $mail2->CharSet = "UTF8";    
            //Asunto
            $mail2->Subject = '¡Nueva reserva de '. $nombreCompleto .'!';
            //Conteido HTML
            $mail2->Body    = '<h3>Correo:</h3><h4>'. $correo .'</h4><h3>Nombre:</h3><h4>'. $nombreCompleto .'</h4><h3>Local:</h3><h4>'. $local .'</h4><h3>Fecha:</h3><h4>'. $fecha .'</h4><h3>Hora:</h3><h4>'. $hora .'</h4><h3>Personas:</h3><h4>'. $numPersonas .'</h4>';
            //Contenido alternativo en texto simple
            $mail2->AltBody = '¡Hola '. $nombreCliente .', tu cuenta a sido creado correctamente. Ahora podras disfrutar de todos los servicios que ofrecemos';
            //Enviar correo
            $mail2->send();
            echo 'El mensaje se ha enviado con exito';
        } catch (Exception $e) {
            echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
            
        }
    }
?>