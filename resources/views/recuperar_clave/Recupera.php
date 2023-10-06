<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body style="background: #082128;">
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'phpMailer/Exception.php';
    include 'phpMailer/PHPMailer.php';
    include 'phpMailer/SMTP.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer();
    foreach ($sql as $item) {
        $correo = $item->email;
        $cod = 123456;
    }

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'isai.sandoval1999@gmail.com'; // SMTP username
        $mail->Password = 'isai74433542'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS`
        //encouraged
        $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Recipients
        $mail->setFrom('isai.sandoval1999@gmail.com', 'ADMINISTRADOR');
        $mail->addAddress($correo); // Add a recipient
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Restablecer clave';
        $mail->Body =
            '´

            <div style="background: #CACACA;width: 100%;margin: auto; padding: 13px;border-radius: 5px">
            <h1 style="text-align: center; font-family: monospace;font-size: 35px">
                BIENVENIDO
            </h1>
            <h4 style="text-align: center; font-family: monospace;">
            </h4>
            <p>
                Hola, si olvidaste tu clave de acceso no te preocupes;
            ingresa a este link para poder recuperar tu clave de acceso a nuestro sistema.
            Si recibiste este correo por equivocacion por favor has de obviar este correo.Gracias
            </p>
            <div style="background: #000;padding: 10px;text-align: center;border-radius: 5px">
                <figcaption style="font-size: 18px;font-weight: bold;color: #00CBEB;margin-bottom: 10px;font-family: Agency FB">
                    Ingresa a este LINK:
                </figcaption>
                <br/>
                <a href="http://127.0.0.1:8000/recuperar_clave/Formulario/' . $correo . '" style="background: #3DD300;border:none;color: #fff;font-size: 28px;padding: 10px;margin-bottom: 20px;text-decoration: none;">
                    <span style="font-family: monospace;padding: 15px 25px">
                        RECUPERAR
                    </span>
                </a>
                <br/>
                <br/>
            </div>
        </div>

    ´';

        $mail->send();
        echo '<div style="background:#00B5FF;color:white;display:flex;justify-content:space-between;align-items:center" class="alert col-12 col-md-6 m-auto">
        <span>Enviado. Se ha enviado un LINK a su correo</span>
        <a href="http://127.0.0.1:8000/login" style="background:#C39600;padding: 5px 15px;color:white">Volver</a>
        </div>';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>