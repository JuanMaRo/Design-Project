<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        // $phone = strip_tags(trim($_POST["phone"]));
        $saludo = "Email desde el sitio web de Qumran";
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            // http_response_code(400);
            echo "Oops! Hubo un problema con el envío. Por favor complete el formulario y vuelva a intentarlo.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "dp@dp-eu.com";

        // Set the email subject.
        $subject = "Mensaje de la web Dp-eu de >> $name";

        // Build the email content.
        $email_content = "$saludo\n\n";
        $email_content = "Nombre: $name\n\n";
        $email_content .= "Email: $email\n\n";
        // $email_content .= "Telefono: $phone\n\n";
        $email_content .= "Mensaje:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            // http_response_code(200);
            // echo "Grácias, su mensaje ha sido enviado!.";
            // header('Location: index.html');
            include 'confirmacion.html';
        } else {
            // Set a 500 (internal server error) response code.
            // http_response_code(500);
            echo "Oops! Algo salió mal y no pudimos enviar su mensaje.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        // http_response_code(403);
        echo "Hubo un problema con el envío, por favor intente de nuevo.";
    }

?>
