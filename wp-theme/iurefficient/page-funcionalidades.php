<?php
/* Template Name: Funcionalidades */
get_header();
$current_help_page = 'funcionalidades';
get_template_part('template-parts/help-nav');
?>

<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/styles.css'); ?>">

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/help-portal/')); ?>">Ayuda</a> / Funcionalidades</div>
    <h1>Funcionalidades de Iurefficient</h1>
    <p>Conoce todo lo que tu Colaborador Especialista puede hacer por ti.</p>
  </div>
</div>

<div class="content-layout">
  <aside class="sidebar">
    <ul class="sidebar-nav">
      <li><a href="#proyectos" class="active">Gestion de Proyectos</a></li>
      <li><a href="#documentos">Gestion de Documentos</a></li>
      <li><a href="#ia">Asistente de IA (RAG)</a></li>
      <li><a href="#investigacion">Investigacion Inteligente</a></li>
      <li><a href="#tareas">Tareas y Tiempo</a></li>
      <li><a href="#pdf">Herramientas PDF</a></li>
      <li><a href="#audio">Transcripcion de Audio</a></li>
      <li><a href="#reportes">Reportes y Analitica</a></li>
      <li><a href="#integraciones">Integraciones</a></li>
      <li><a href="#seguridad">Seguridad</a></li>
    </ul>
  </aside>

  <main class="content-main">

    <!-- Proyectos -->
    <h2 id="proyectos">Gestion de Proyectos y Casos</h2>
    <p>El proyecto es la unidad central de trabajo en Iurefficient. Dependiendo de tu industria, puede llamarse "caso", "engagement", "obra" o "consulta".</p>

    <h3>Caracteristicas principales</h3>
    <ul>
      <li><strong>Vista de portafolio:</strong> Todos tus proyectos activos con indicadores de urgencia por color (rojo, amarillo, verde).</li>
      <li><strong>Filtros avanzados:</strong> Por estado, tipo, cliente, equipo o fecha.</li>
      <li><strong>Creacion rapida:</strong> Formulario guiado con campos obligatorios y opcionales.</li>
      <li><strong>Gestion de clientes:</strong> Informacion de contacto, historial, contratos asociados.</li>
      <li><strong>Hitos y entregables:</strong> Fechas criticas con alertas automaticas.</li>
      <li><strong>Asignacion de equipo:</strong> Roles por proyecto (Propietario, Colaborador, Solo lectura).</li>
      <li><strong>Plantillas de proyecto:</strong> Crea proyectos a partir de plantillas predefinidas por tu organizacion.</li>
    </ul>

    <div class="info-box">
      <strong>Terminologia personalizable:</strong> Tu administrador puede configurar como se llaman los conceptos segun tu industria. "Proyecto" puede ser "Caso" (legal), "Engagement" (contabilidad) u "Obra" (ingenieria).
    </div>

    <!-- Documentos -->
    <h2 id="documentos">Gestion de Documentos</h2>
    <p>Sube, organiza y versiona todos los documentos de tus proyectos con procesamiento automatico.</p>

    <h3>Carga de documentos</h3>
    <ul>
      <li><strong>Drag &amp; drop:</strong> Arrastra archivos directamente a la interfaz.</li>
      <li><strong>Upload masivo:</strong> Sube carpetas completas de una vez.</li>
      <li><strong>Formatos soportados:</strong> PDF, Word, Excel, PowerPoint, imagenes (JPG, PNG), correos (EML), archivos de texto.</li>
      <li><strong>OCR automatico:</strong> Documentos escaneados se convierten a texto buscable automaticamente.</li>
      <li><strong>Cifrado AES-256-GCM:</strong> Todos los archivos se cifran automaticamente al subirse.</li>
    </ul>

    <h3>Organizacion y versionado</h3>
    <ul>
      <li><strong>Carpetas por proyecto:</strong> Cada proyecto tiene su espacio de documentos aislado.</li>
      <li><strong>Control de versiones:</strong> Historial completo de cambios con posibilidad de restaurar versiones anteriores.</li>
      <li><strong>Etiquetas y metadatos:</strong> Organiza documentos con tags personalizados.</li>
      <li><strong>Buscador global:</strong> Encuentra cualquier documento por nombre, contenido o metadatos.</li>
    </ul>

    <!-- IA -->
    <h2 id="ia">Asistente de IA con RAG</h2>
    <p>El corazon de Iurefficient: un asistente que <strong>conoce tus documentos</strong> y responde con informacion real, citando fuentes.</p>

    <h3>Tres niveles de conocimiento (RAG)</h3>
    <ul>
      <li><strong>RAG Central:</strong> Legislacion actualizada, normativa profesional, jurisprudencia y estandares tecnicos. Compartido por todos los usuarios de tu especialidad.</li>
      <li><strong>RAG Global:</strong> Plantillas de tu organizacion, precedentes, mejores practicas internas. Compartido dentro de tu organizacion.</li>
      <li><strong>RAG de Proyecto:</strong> Contratos, evidencias, informes, documentos unicos del proyecto. Especifico de un proyecto.</li>
    </ul>

    <h3>Que puedes hacer</h3>
    <ul>
      <li><strong>Preguntas en lenguaje natural:</strong> "Que dice el contrato sobre clausulas de confidencialidad?"</li>
      <li><strong>Analisis de documentos:</strong> "Resume las recomendaciones principales del informe pericial."</li>
      <li><strong>Generacion de borradores:</strong> "Genera un borrador de demanda basado en este caso."</li>
      <li><strong>Comparacion de documentos:</strong> "Compara las especificaciones de estos 3 equipos."</li>
      <li><strong>Analisis de riesgo:</strong> "Que probabilidades tiene este argumento de prosperar?"</li>
    </ul>

    <div class="info-box">
      <strong>Precision y fuentes:</strong> Cada respuesta incluye citas con nombre del documento, pagina y fecha. Precision &gt;95% en datos verificables. Nunca inventa informacion: si no la encuentra en tus documentos, te lo dice.
    </div>

    <h3>Chat con conversaciones</h3>
    <ul>
      <li><strong>Multiples hilos:</strong> Crea conversaciones separadas para diferentes temas.</li>
      <li><strong>Historial completo:</strong> Accede a todas tus consultas anteriores.</li>
      <li><strong>Contexto persistente:</strong> El asistente recuerda el contexto de la conversacion.</li>
      <li><strong>Exportar:</strong> Exporta conversaciones a PDF o Word.</li>
    </ul>

    <!-- Investigacion -->
    <h2 id="investigacion">Investigacion Inteligente</h2>
    <p>Investiga temas en la web y genera bases de conocimiento automaticamente, todo desde la interfaz de Iurefficient.</p>

    <h3>Como funciona</h3>
    <ol>
      <li><strong>Define tu consulta:</strong> "Investiga sentencias recientes sobre negligencia medica en Mexico 2024".</li>
      <li><strong>Busqueda multi-fuente:</strong> El sistema busca en multiples motores de busqueda y fuentes especializadas.</li>
      <li><strong>Scraping inteligente:</strong> Extrae y limpia contenido relevante de las paginas encontradas.</li>
      <li><strong>Resumen ejecutivo:</strong> Genera un informe con los hallazgos principales y fuentes verificadas.</li>
      <li><strong>Creacion de RAG:</strong> Automaticamente crea una coleccion de conocimiento con los resultados.</li>
    </ol>

    <div class="info-box">
      <strong>Tiempo de ejecucion:</strong> La investigacion se ejecuta en segundo plano (5-10 minutos). Recibiras una notificacion cuando este lista.
    </div>

    <!-- Tareas -->
    <h2 id="tareas">Gestion de Tareas y Tiempo</h2>
    <ul>
      <li><strong>Crear y asignar tareas:</strong> Asocia tareas a proyectos con fechas limite, prioridad y responsables.</li>
      <li><strong>Dependencias:</strong> Define que tareas deben completarse antes de otras.</li>
      <li><strong>Vista Kanban:</strong> Arrastra tareas entre columnas (Pendiente, En progreso, Completada).</li>
      <li><strong>Vista Calendario:</strong> Ve todas las fechas criticas en un calendario mensual o semanal.</li>
      <li><strong>Registro de tiempo:</strong> Registra horas trabajadas por tarea, diferenciando facturable y no facturable.</li>
      <li><strong>Notificaciones:</strong> Alertas automaticas para tareas proximas a vencer o vencidas.</li>
    </ul>

    <!-- PDF -->
    <h2 id="pdf">Herramientas PDF</h2>
    <p>Suite completa de herramientas PDF sin necesidad de software externo como Adobe.</p>
    <ul>
      <li><strong>Unir PDFs:</strong> Combina multiples documentos en uno solo.</li>
      <li><strong>Dividir PDF:</strong> Separa un documento en paginas individuales o rangos.</li>
      <li><strong>Marca de agua:</strong> Agrega texto o imagen como marca de agua.</li>
      <li><strong>Numerar paginas:</strong> Agrega numeracion automatica.</li>
      <li><strong>Rotar paginas:</strong> Corrige la orientacion de paginas individuales.</li>
      <li><strong>Comprimir:</strong> Reduce el tamano del archivo manteniendo calidad.</li>
    </ul>

    <!-- Audio -->
    <h2 id="audio">Transcripcion de Audio</h2>
    <p>Convierte reuniones, audiencias y entrevistas a texto buscable y analizable.</p>
    <ul>
      <li><strong>Formatos soportados:</strong> MP3, WAV, M4A, OGG, FLAC.</li>
      <li><strong>Identificacion de hablantes:</strong> Detecta y etiqueta diferentes voces.</li>
      <li><strong>Timestamps:</strong> Cada fragmento incluye marca de tiempo para referencia rapida.</li>
      <li><strong>Indexacion RAG:</strong> Las transcripciones se indexan automaticamente para consultas IA.</li>
    </ul>

    <!-- Reportes -->
    <h2 id="reportes">Reportes y Analitica</h2>
    <ul>
      <li><strong>Dashboard de productividad:</strong> Metricas de equipo, tareas completadas, tiempo registrado.</li>
      <li><strong>Reportes de proyecto:</strong> Avance, riesgos, desviaciones de plazo y presupuesto.</li>
      <li><strong>Meta-Reportes:</strong> Informes compuestos multi-seccion exportables a PDF o DOCX.</li>
      <li><strong>Generacion con IA:</strong> "Dame un resumen del proyecto ABC para enviar al cliente" &rarr; Reporte listo en 2 minutos.</li>
      <li><strong>Widgets personalizables:</strong> Construye tu dashboard ideal con los widgets que necesites.</li>
    </ul>

    <!-- Integraciones -->
    <h2 id="integraciones">Integraciones Externas</h2>
    <h3>Google Workspace</h3>
    <ul>
      <li>Google Drive: Sincroniza documentos bidireccional.</li>
      <li>Google Calendar: Sincroniza hitos y fechas criticas.</li>
      <li>Gmail: Importa correos relevantes al proyecto.</li>
    </ul>
    <h3>Microsoft 365</h3>
    <ul>
      <li>OneDrive/SharePoint: Sincroniza documentos.</li>
      <li>Outlook Calendar: Sincroniza eventos.</li>
      <li>Teams: Notificaciones y alertas.</li>
    </ul>
    <h3>Otras integraciones</h3>
    <ul>
      <li><strong>Nextcloud:</strong> Almacenamiento privado de documentos.</li>
      <li><strong>AWS S3 / Azure Blob:</strong> Almacenamiento en la nube empresarial.</li>
      <li><strong>ERP (Dolibarr / Odoo):</strong> Sincronizacion bidireccional de clientes, proyectos, facturas e inventario.</li>
      <li><strong>API abierta:</strong> Integra con cualquier sistema mediante nuestra API REST.</li>
    </ul>

    <!-- Seguridad -->
    <h2 id="seguridad">Seguridad y Cumplimiento</h2>
    <ul>
      <li><strong>Cifrado AES-256:</strong> Datos cifrados en reposo y en transito.</li>
      <li><strong>Aislamiento multi-tenant:</strong> Cada organizacion tiene datos completamente aislados.</li>
      <li><strong>Autenticacion JWT + 2FA:</strong> Tokens de sesion seguros con autenticacion de dos factores.</li>
      <li><strong>Roles granulares:</strong> Permisos por rol y por proyecto.</li>
      <li><strong>Auditoria completa:</strong> Log de todas las acciones de usuarios.</li>
      <li><strong>GDPR / CCPA:</strong> Cumplimiento de normativas de proteccion de datos.</li>
      <li><strong>Residencia de datos:</strong> Elige la region donde se almacenan tus datos (EU, US, LATAM).</li>
      <li><strong>SSO (Enterprise):</strong> Single Sign-On para integracion con tu directorio corporativo.</li>
      <li><strong>Backups automaticos:</strong> Respaldos diarios con retencion configurable.</li>
    </ul>

    <div class="info-box">
      <strong>Privacidad de IA:</strong> Tus datos <strong>jamas</strong> se usan para entrenar modelos de Inteligencia Artificial. Cada organizacion opera en un entorno aislado.
    </div>

  </main>
</div>

<?php
get_template_part('template-parts/help-footer');
?>

<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/app.js'); ?>"></script>

<?php get_footer(); ?>
