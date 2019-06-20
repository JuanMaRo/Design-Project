<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $saludo = "Email desde el sitio web de Qumran";
        $message = trim($_POST["message"]);

        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Oops! Hubo un problema con el envío. Por favor complete el formulario y vuelva a intentarlo.";
            exit;
        }

        $recipient = "dp@dp-eu.com"; // ***DATOS CONTACTO - CORREO***

        $subject = "Mensaje de la web Dp-eu de >> $name";

        $email_content = "$saludo\n\n";
        $email_content = "Nombre: $name\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Mensaje:\n$message\n";

        $email_headers = "From: $name <$email>";

        if (mail($recipient, $subject, $email_content, $email_headers)) {
            include 'confirmacion.html';
        } else {
            echo "Oops! Algo salió mal y no pudimos enviar su mensaje.";
        }

    } else {
        echo "Hubo un problema con el envío, por favor intente de nuevo.";
    }

?>
