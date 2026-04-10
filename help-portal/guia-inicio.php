<?php
$base_path = '../';
$current_help_page = 'guia';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Primeros Pasos — Iurefficient</title>
  <meta name="description" content="Guia de inicio rapido para Iurefficient. Registrate, accede y configura tu cuenta en minutos.">
  <link rel="icon" type="image/png" href="<?= $base_path ?>images/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/includes/help-nav.php'; ?>

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?= $base_path ?>help-portal/">Ayuda</a> / Primeros Pasos</div>
    <h1>Primeros Pasos con Iurefficient</h1>
    <p>Todo lo que necesitas para comenzar a trabajar con tu Colaborador Especialista.</p>
  </div>
</div>

<div class="content-layout">
  <aside class="sidebar">
    <ul class="sidebar-nav">
      <li><a href="#registro" class="active">Registro y activacion</a></li>
      <li><a href="#login">Primer inicio de sesion</a></li>
      <li><a href="#dashboard">Tour del Dashboard</a></li>
      <li><a href="#perfil">Configurar tu perfil</a></li>
      <li><a href="#primer-proyecto">Tu primer proyecto</a></li>
      <li><a href="#primer-chat">Tu primera consulta IA</a></li>
      <li><a href="#roles">Roles y permisos</a></li>
    </ul>
  </aside>

  <main class="content-main">

    <h2 id="registro">1. Registro y activacion de cuenta</h2>
    <p>Tu administrador te enviara un correo de invitacion con un enlace para activar tu cuenta. Este enlace expira en 72 horas.</p>

    <h3>Pasos para activar tu cuenta</h3>
    <ol>
      <li>Abre el correo de invitacion de Iurefficient.</li>
      <li>Haz clic en <strong>"Aceptar Invitacion y Crear Contrasena"</strong>.</li>
      <li>Ingresa tu nombre completo.</li>
      <li>Crea una contrasena segura (minimo 8 caracteres, incluir mayusculas, numeros y simbolos).</li>
      <li>Configura tu foto de perfil (opcional pero recomendado).</li>
      <li>Selecciona tu zona horaria.</li>
      <li>Haz clic en <strong>"Activar mi cuenta"</strong>.</li>
    </ol>

    <div class="info-box warning">
      <strong>Importante:</strong> Usa una contrasena unica que no reutilices de otros servicios. Considera usar un gestor de contrasenas como 1Password, LastPass o Bitwarden.
    </div>

    <h2 id="login">2. Primer inicio de sesion</h2>
    <p>Navega a la URL de tu organizacion. Dependiendo de tu tipo de despliegue:</p>
    <div class="code-block">
https://tu-organizacion.iurefficient.com
    </div>
    <p>O si es instalacion local:</p>
    <div class="code-block">
https://app.tuempresa.com
    </div>
    <p>Ingresa tu email corporativo y la contrasena que acabas de crear.</p>

    <h2 id="dashboard">3. Tour del Dashboard</h2>
    <p>Al ingresar por primera vez, veras el <strong>Dashboard Principal</strong> con los siguientes elementos:</p>
    <ul>
      <li><strong>Barra superior:</strong> Navegacion principal (Proyectos, Documentos, Asistente IA), notificaciones y configuracion personal.</li>
      <li><strong>Mis Proyectos Activos:</strong> Proyectos donde estas asignado, con codigo de color segun urgencia (rojo = &lt;48h, amarillo = &lt;7 dias, verde = &gt;7 dias).</li>
      <li><strong>Tareas Pendientes:</strong> Tus tareas ordenadas por fecha de vencimiento. Puedes marcar como completadas directamente.</li>
      <li><strong>Feed de Actividad:</strong> Actualizaciones de tus proyectos, menciones (@tu_nombre) y cambios importantes.</li>
    </ul>

    <div class="info-box">
      <strong>Consejo:</strong> El dashboard es completamente personalizable. Puedes agregar, quitar y redimensionar widgets segun tus preferencias.
    </div>

    <h2 id="perfil">4. Configurar tu perfil</h2>
    <p>Haz clic en tu foto de perfil &rarr; <strong>"Mi Perfil"</strong> para configurar:</p>
    <h3>Informacion basica</h3>
    <ul>
      <li>Nombre completo, telefono y puesto/rol.</li>
      <li>Foto de perfil.</li>
    </ul>
    <h3>Preferencias</h3>
    <ul>
      <li><strong>Idioma:</strong> Espanol, Ingles, Portugues.</li>
      <li><strong>Zona horaria:</strong> America/Mexico_City, Europe/Madrid, etc.</li>
      <li><strong>Formato de fecha:</strong> DD/MM/AAAA vs MM/DD/YYYY.</li>
      <li><strong>Notificaciones por email:</strong> Activa para menciones y tareas urgentes.</li>
    </ul>
    <h3>Configuracion del Asistente de IA</h3>
    <ul>
      <li><strong>Modelo preferido:</strong> GPT-4, Claude, DeepSeek, etc.</li>
      <li><strong>Estilo de respuesta:</strong> Formal, tecnico o conciso.</li>
      <li><strong>Idioma de respuestas:</strong> Espanol o Ingles.</li>
    </ul>

    <h2 id="primer-proyecto">5. Tu primer proyecto</h2>
    <p>Desde el menu principal &rarr; <strong>Proyectos</strong> &rarr; <strong>+ Nuevo Proyecto</strong>.</p>
    <h3>Campos obligatorios</h3>
    <ol>
      <li><strong>Nombre del proyecto:</strong> Descriptivo y unico (ej. "Divorcio Garcia vs Garcia - Custodia y bienes").</li>
      <li><strong>Tipo de proyecto:</strong> Selecciona de la lista configurada por tu admin (Litigio Civil, Auditoria Fiscal, etc.).</li>
      <li><strong>Cliente:</strong> Busca cliente existente o crea uno nuevo.</li>
      <li><strong>Responsable principal:</strong> Quien lidera el proyecto.</li>
    </ol>
    <h3>Opciones avanzadas</h3>
    <ul>
      <li><strong>Activar RAG de proyecto:</strong> Crea automaticamente una coleccion de conocimiento para este proyecto.</li>
      <li><strong>Usar plantillas:</strong> Aplica plantillas de documentos predefinidas por tu organizacion.</li>
      <li><strong>Sincronizar con calendario:</strong> Conecta hitos con Google/Microsoft Calendar.</li>
    </ul>

    <div class="info-box success">
      <strong>Listo!</strong> Una vez creado, el sistema notifica automaticamente a todos los miembros del equipo y te redirige a la vista del proyecto.
    </div>

    <h2 id="primer-chat">6. Tu primera consulta al Asistente de IA</h2>
    <p>Una vez que hayas subido documentos a tu proyecto:</p>
    <ol>
      <li>Abre el proyecto y ve a la pestana <strong>"Asistente IA"</strong>.</li>
      <li>Selecciona el alcance de la consulta:
        <ul>
          <li><strong>RAG de Proyecto:</strong> Solo documentos de este proyecto.</li>
          <li><strong>RAG Global:</strong> Base de conocimiento de toda tu organizacion.</li>
          <li><strong>RAG Central:</strong> Legislacion, normativa y conocimiento compartido del sistema.</li>
        </ul>
      </li>
      <li>Escribe tu pregunta en lenguaje natural, por ejemplo: <em>"Que dice el contrato sobre clausulas de confidencialidad?"</em></li>
      <li>Recibe una respuesta con <strong>citas exactas</strong> incluyendo fuente, pagina y fecha.</li>
    </ol>

    <div class="info-box">
      <strong>Diferencia clave:</strong> A diferencia de ChatGPT o IA generica, Iurefficient responde basandose en <strong>tus documentos reales</strong>, no en conocimiento general. Cada respuesta incluye la fuente exacta para que puedas verificar.
    </div>

    <h2 id="roles">7. Roles y permisos</h2>
    <h3>Tipos de usuario</h3>
    <ul>
      <li><strong>Usuario Normal (Colaborador):</strong> Ve proyectos asignados, crea documentos y tareas, usa IA, ejecuta investigaciones y registra tiempo.</li>
      <li><strong>Manager (Gerente/Socio):</strong> Ademas puede crear proyectos, asignar tareas a cualquier miembro, ver reportes de productividad y aprobar tiempo facturable.</li>
      <li><strong>Administrador:</strong> Control total incluyendo gestion de usuarios, configuracion de IA, integraciones, plantillas y reportes financieros.</li>
    </ul>
    <h3>Permisos por proyecto</h3>
    <ul>
      <li><strong>Propietario:</strong> Control total del proyecto.</li>
      <li><strong>Colaborador:</strong> Puede editar documentos y tareas.</li>
      <li><strong>Solo lectura:</strong> Puede ver pero no modificar.</li>
      <li><strong>Sin acceso:</strong> No puede ver el proyecto.</li>
    </ul>

    <div class="info-box warning">
      <strong>Consejo de seguridad:</strong> Para proyectos sensibles (legal, medico), configura permisos restrictivos y solo agrega usuarios segun sea necesario.
    </div>

  </main>
</div>

<?php include __DIR__ . '/includes/help-footer.php'; ?>

<script src="app.js"></script>
</body>
</html>
