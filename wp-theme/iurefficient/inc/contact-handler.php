<?php
/**
 * Iurefficient - AJAX Contact Form Handler
 *
 * Handles the demo request form via WordPress AJAX.
 * Sends notification email to admin and confirmation to the client.
 */

define('IUREFFICIENT_FROM_EMAIL', 'noreply@iurefficient.com');
define('IUREFFICIENT_FROM_NAME', 'Iurefficient');
define('IUREFFICIENT_ADMIN_NAME', 'Iurefficient');

function iurefficient_handle_contact() {
    $brevo_api_key = get_option('iurefficient_brevo_api_key', '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');
    $admin_email = get_option('iurefficient_admin_email', 'contacto@iurefficient.com');

    // Get data from request
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // If not JSON, try form data
    if (!$data) {
        $data = [
            'nombre'   => isset($_POST['nombre']) ? $_POST['nombre'] : '',
            'email'    => isset($_POST['email']) ? $_POST['email'] : '',
            'telefono' => isset($_POST['telefono']) ? $_POST['telefono'] : '',
            'tamano'   => isset($_POST['tamano']) ? $_POST['tamano'] : '',
        ];
    }

    // Validation - nombre and email are required
    if (empty($data['nombre']) || empty($data['email'])) {
        wp_send_json_error([
            'error' => 'Faltan campos requeridos: nombre y email son obligatorios',
        ], 400);
    }

    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        wp_send_json_error([
            'error' => 'Email inválido',
        ], 400);
    }

    // Sanitize data
    $name = htmlspecialchars(strip_tags($data['nombre']));
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(isset($data['telefono']) ? $data['telefono'] : 'No especificado'));
    $tamano = htmlspecialchars(strip_tags(isset($data['tamano']) ? $data['tamano'] : 'No especificado'));

    // Map size to readable text
    $tamanoTexto = [
        '1'    => 'Solo yo',
        '2-5'  => '2-5 abogados',
        '6-20' => '6-20 abogados',
        '20+'  => 'Más de 20 abogados',
    ];
    $tamanoDisplay = isset($tamanoTexto[$tamano]) ? $tamanoTexto[$tamano] : $tamano;

    // Admin notification email
    $adminEmailContent = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 20px; border: 1px solid #e5e7eb; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #4f46e5; }
        .value { margin-top: 5px; }
        .footer { background: #1a1a2e; color: #9ca3af; padding: 15px; font-size: 12px; border-radius: 0 0 8px 8px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2 style='margin:0;'>Nueva solicitud de Demo desde iurefficient.com</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>Nombre:</div>
                <div class='value'>{$name}</div>
            </div>
            <div class='field'>
                <div class='label'>Email:</div>
                <div class='value'><a href='mailto:{$email}'>{$email}</a></div>
            </div>
            <div class='field'>
                <div class='label'>Telefono:</div>
                <div class='value'>{$phone}</div>
            </div>
            <div class='field'>
                <div class='label'>Tamano del despacho:</div>
                <div class='value'>{$tamanoDisplay}</div>
            </div>
        </div>
        <div class='footer'>
            Recibido el " . date('d/m/Y H:i:s') . " desde iurefficient.com
        </div>
    </div>
</body>
</html>
";

    // Client confirmation email
    $clientEmailContent = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); color: white; padding: 30px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { background: #ffffff; padding: 30px; border: 1px solid #e5e7eb; }
        .highlight { background: #f0f9ff; border-left: 4px solid #4f46e5; padding: 15px; margin: 20px 0; }
        .footer { background: #1a1a2e; color: #9ca3af; padding: 20px; font-size: 12px; border-radius: 0 0 8px 8px; text-align: center; }
        .btn { display: inline-block; background: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1 style='margin:0; font-size:24px;'>Gracias por tu interes!</h1>
            <p style='margin:10px 0 0 0; opacity:0.9;'>Hemos recibido tu solicitud de demo</p>
        </div>
        <div class='content'>
            <p>Hola <strong>{$name}</strong>,</p>

            <p>Gracias por tu interes en Iurefficient. Hemos recibido tu solicitud de demo y nuestro equipo se pondra en contacto contigo muy pronto.</p>

            <div class='highlight'>
                <strong>Proximos pasos:</strong><br>
                Un miembro de nuestro equipo te contactara en las proximas <strong>24 horas habiles</strong> para agendar tu demo personalizada.
            </div>

            <p>Mientras tanto, te invitamos a conocer mas sobre como Iurefficient puede transformar tu practica legal:</p>

            <center>
                <a href='https://iurefficient.com/#caracteristicas' class='btn'>Ver caracteristicas</a>
            </center>

            <p style='margin-top:30px;'>Saludos cordiales,<br><strong>El equipo de Iurefficient</strong></p>
        </div>
        <div class='footer'>
            <p style='margin:0;'>&copy; " . date('Y') . " Iurefficient. Todos los derechos reservados.</p>
            <p style='margin:10px 0 0 0;'>
                <a href='https://iurefficient.com' style='color:#06b6d4;'>iurefficient.com</a> |
                <a href='mailto:contacto@iurefficient.com' style='color:#06b6d4;'>contacto@iurefficient.com</a>
            </p>
        </div>
    </div>
</body>
</html>
";

    // Send email to admin
    $admin_headers = "MIME-Version: 1.0\r\n";
    $admin_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $admin_headers .= "From: " . IUREFFICIENT_FROM_NAME . " <" . IUREFFICIENT_FROM_EMAIL . ">\r\n";
    $admin_headers .= "Reply-To: {$email}\r\n";

    $admin_result = mail(
        $admin_email,
        "Nuevo contacto: {$name} - Solicitud de Demo",
        $adminEmailContent,
        $admin_headers
    );

    // Send confirmation to client
    $client_headers = "MIME-Version: 1.0\r\n";
    $client_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $client_headers .= "From: " . IUREFFICIENT_FROM_NAME . " <" . IUREFFICIENT_FROM_EMAIL . ">\r\n";

    $client_result = mail(
        $email,
        "Gracias por contactar a Iurefficient - Hemos recibido tu mensaje",
        $clientEmailContent,
        $client_headers
    );

    // Response
    if ($admin_result) {
        wp_send_json_success([
            'message' => 'Mensaje enviado correctamente. Te hemos enviado un correo de confirmación.',
        ]);
    } else {
        wp_send_json_error([
            'error' => 'Error al enviar el mensaje. Por favor contáctanos directamente a contacto@iurefficient.com',
        ], 500);
    }
}

add_action('wp_ajax_iurefficient_contact', 'iurefficient_handle_contact');
add_action('wp_ajax_nopriv_iurefficient_contact', 'iurefficient_handle_contact');
