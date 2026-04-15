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
define('DEBUG_MODE', true); // Cambiar a false en producción
define('LOG_FILE', __DIR__ . '/contact-log.txt');
// ===========================================

// Función para escribir logs
function writeLog($message, $data = null) {
    if (!DEBUG_MODE) return;

    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}";
    if ($data !== null) {
        $logMessage .= "\n" . print_r($data, true);
    }
    $logMessage .= "\n" . str_repeat('-', 50) . "\n";

    file_put_contents(LOG_FILE, $logMessage, FILE_APPEND | LOCK_EX);
}

writeLog("=== Nueva solicitud recibida ===");
writeLog("Método: " . $_SERVER['REQUEST_METHOD']);
writeLog("Headers recibidos", getallheaders());

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
writeLog("Raw input recibido", $input);

$data = json_decode($input, true);
writeLog("JSON decode result", $data);
writeLog("JSON decode error (si hay)", json_last_error_msg());

// Si no es JSON, intentar con form data
if (!$data) {
    writeLog("No es JSON, intentando form data", $_POST);
    $data = [
        'nombre' => $_POST['nombre'] ?? '',
        'email' => $_POST['email'] ?? '',
        'telefono' => $_POST['telefono'] ?? '',
        'tamano' => $_POST['tamano'] ?? ''
    ];
}

writeLog("Datos finales a procesar", $data);

// Validación básica (solo nombre y email son requeridos)
if (empty($data['nombre']) || empty($data['email'])) {
    writeLog("ERROR: Validación falló - campos vacíos", [
        'nombre_empty' => empty($data['nombre']),
        'email_empty' => empty($data['email'])
    ]);
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Faltan campos requeridos: nombre y email son obligatorios']);
    exit();
}

// Validar email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Email inválido']);
    exit();
}

// Sanitizar datos
$name = htmlspecialchars(strip_tags($data['nombre']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(strip_tags($data['telefono'] ?? 'No especificado'));
$tamano = htmlspecialchars(strip_tags($data['tamano'] ?? 'No especificado'));

// Mapear tamaño a texto legible
$tamanoTexto = [
    '1' => 'Solo yo',
    '2-5' => '2-5 abogados',
    '6-20' => '6-20 abogados',
    '20+' => 'Más de 20 abogados'
];
$tamanoDisplay = $tamanoTexto[$tamano] ?? $tamano;

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
            <h2 style='margin:0;'>📬 Nueva solicitud de Demo desde iurefficient.com</h2>
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
                <div class='label'>📱 Teléfono:</div>
                <div class='value'>{$phone}</div>
            </div>
            <div class='field'>
                <div class='label'>🏢 Tamaño del despacho:</div>
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
            <h1 style='margin:0; font-size:24px;'>¡Gracias por tu interés!</h1>
            <p style='margin:10px 0 0 0; opacity:0.9;'>Hemos recibido tu solicitud de demo</p>
        </div>
        <div class='content'>
            <p>Hola <strong>{$name}</strong>,</p>

            <p>Gracias por tu interés en Iurefficient. Hemos recibido tu solicitud de demo y nuestro equipo se pondrá en contacto contigo muy pronto.</p>

            <div class='highlight'>
                <strong>📋 Próximos pasos:</strong><br>
                Un miembro de nuestro equipo te contactará en las próximas <strong>24 horas hábiles</strong> para agendar tu demo personalizada.
            </div>

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

// ============== ENVIAR EMAILS ==============
function sendEmail($to, $subject, $htmlContent, $replyTo = null) {
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">\r\n";
    if ($replyTo) {
        $headers .= "Reply-To: {$replyTo}\r\n";
    }

    $result = mail($to, $subject, $htmlContent, $headers);
    writeLog("mail() result para {$to}: " . ($result ? 'OK' : 'FAIL'));

    return ['success' => $result];
}

// Enviar email al administrador
$adminResult = sendEmail(
    ADMIN_EMAIL,
    "Nuevo contacto: {$name} - Solicitud de Demo",
    $adminEmailContent,
    $email
);

// Enviar confirmación al cliente
$clientResult = sendEmail(
    $email,
    "Gracias por contactar a Iurefficient - Hemos recibido tu mensaje",
    $clientEmailContent
);

// Respuesta
if ($adminResult['success']) {
    writeLog("SUCCESS: Email al admin enviado correctamente");
    echo json_encode([
        'success' => true,
        'message' => 'Mensaje enviado correctamente. Te hemos enviado un correo de confirmación.'
    ]);
} else {
    writeLog("ERROR: Fallo al enviar email", [
        'adminResult' => $adminResult,
        'clientResult' => $clientResult
    ]);

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al enviar el mensaje. Por favor contáctanos directamente a contacto@iurefficient.com'
    ]);
}
?>
