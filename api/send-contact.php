<?php
/**
 * Iurefficient - Contact Form Handler with Brevo (Sendinblue)
 *
 * Configuración:
 * 1. Reemplaza BREVO_API_KEY con tu API key de Brevo
 * 2. Actualiza ADMIN_EMAIL con el correo donde quieres recibir los contactos
 * 3. Sube este archivo a tu servidor en la carpeta /api/
 */

// ============== CONFIGURACIÓN ==============
define('BREVO_API_KEY', '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');
define('ADMIN_EMAIL', 'contacto@iurefficient.com'); // Email del administrador
define('ADMIN_NAME', 'Iurefficient');
define('FROM_EMAIL', 'noreply@iurefficient.com'); // Debe estar verificado en Brevo
define('FROM_NAME', 'Iurefficient');
// ===========================================

// Headers CORS para permitir requests desde el frontend
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Manejar preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit();
}

// Obtener datos del formulario
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Si no es JSON, intentar con form data
if (!$data) {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'company' => $_POST['company'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'message' => $_POST['message'] ?? ''
    ];
}

// Validación básica
if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Faltan campos requeridos: nombre, email y mensaje son obligatorios']);
    exit();
}

// Validar email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Email inválido']);
    exit();
}

// Sanitizar datos
$name = htmlspecialchars(strip_tags($data['name']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$company = htmlspecialchars(strip_tags($data['company'] ?? 'No especificado'));
$phone = htmlspecialchars(strip_tags($data['phone'] ?? 'No especificado'));
$message = htmlspecialchars(strip_tags($data['message']));

// ============== EMAIL AL ADMINISTRADOR ==============
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
            <h2 style='margin:0;'>📬 Nuevo contacto desde iurefficient.com</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>👤 Nombre:</div>
                <div class='value'>{$name}</div>
            </div>
            <div class='field'>
                <div class='label'>📧 Email:</div>
                <div class='value'><a href='mailto:{$email}'>{$email}</a></div>
            </div>
            <div class='field'>
                <div class='label'>🏢 Empresa/Despacho:</div>
                <div class='value'>{$company}</div>
            </div>
            <div class='field'>
                <div class='label'>📱 Teléfono:</div>
                <div class='value'>{$phone}</div>
            </div>
            <div class='field'>
                <div class='label'>💬 Mensaje:</div>
                <div class='value' style='background:white; padding:15px; border-radius:4px; border:1px solid #e5e7eb;'>{$message}</div>
            </div>
        </div>
        <div class='footer'>
            Recibido el " . date('d/m/Y H:i:s') . " desde iurefficient.com
        </div>
    </div>
</body>
</html>
";

// ============== EMAIL DE CONFIRMACIÓN AL CLIENTE ==============
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
            <h1 style='margin:0; font-size:24px;'>¡Gracias por contactarnos!</h1>
            <p style='margin:10px 0 0 0; opacity:0.9;'>Hemos recibido tu mensaje</p>
        </div>
        <div class='content'>
            <p>Hola <strong>{$name}</strong>,</p>

            <p>Gracias por tu interés en Iurefficient. Hemos recibido tu mensaje y nuestro equipo lo revisará a la brevedad.</p>

            <div class='highlight'>
                <strong>📋 Resumen de tu mensaje:</strong><br>
                <em>\"{$message}\"</em>
            </div>

            <p>Te responderemos en un plazo máximo de <strong>24 horas hábiles</strong>.</p>

            <p>Mientras tanto, te invitamos a conocer más sobre cómo Iurefficient puede transformar tu práctica legal:</p>

            <center>
                <a href='https://iurefficient.com/#caracteristicas' class='btn'>Ver características</a>
            </center>

            <p style='margin-top:30px;'>Saludos cordiales,<br><strong>El equipo de Iurefficient</strong></p>
        </div>
        <div class='footer'>
            <p style='margin:0;'>© " . date('Y') . " Iurefficient. Todos los derechos reservados.</p>
            <p style='margin:10px 0 0 0;'>
                <a href='https://iurefficient.com' style='color:#06b6d4;'>iurefficient.com</a> |
                <a href='mailto:contacto@iurefficient.com' style='color:#06b6d4;'>contacto@iurefficient.com</a>
            </p>
        </div>
    </div>
</body>
</html>
";

// ============== ENVIAR CON BREVO API ==============
function sendBrevoEmail($to, $toName, $subject, $htmlContent, $replyTo = null) {
    $url = 'https://api.brevo.com/v3/smtp/email';

    $payload = [
        'sender' => [
            'name' => FROM_NAME,
            'email' => FROM_EMAIL
        ],
        'to' => [
            [
                'email' => $to,
                'name' => $toName
            ]
        ],
        'subject' => $subject,
        'htmlContent' => $htmlContent
    ];

    if ($replyTo) {
        $payload['replyTo'] = [
            'email' => $replyTo
        ];
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json',
        'api-key: ' . BREVO_API_KEY
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    return [
        'success' => $httpCode >= 200 && $httpCode < 300,
        'httpCode' => $httpCode,
        'response' => json_decode($response, true),
        'error' => $error
    ];
}

// Enviar email al administrador
$adminResult = sendBrevoEmail(
    ADMIN_EMAIL,
    ADMIN_NAME,
    "🔔 Nuevo contacto: {$name} - Solicitud de Demo",
    $adminEmailContent,
    $email // Reply-To del cliente
);

// Enviar confirmación al cliente
$clientResult = sendBrevoEmail(
    $email,
    $name,
    "Gracias por contactar a Iurefficient - Hemos recibido tu mensaje",
    $clientEmailContent
);

// Respuesta
if ($adminResult['success'] && $clientResult['success']) {
    echo json_encode([
        'success' => true,
        'message' => 'Mensaje enviado correctamente. Te hemos enviado un correo de confirmación.'
    ]);
} else {
    // Log del error (en producción deberías guardar esto en un archivo de log)
    error_log("Brevo Error - Admin: " . json_encode($adminResult) . " Client: " . json_encode($clientResult));

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al enviar el mensaje. Por favor intenta de nuevo o contáctanos directamente a contacto@iurefficient.com'
    ]);
}
?>
