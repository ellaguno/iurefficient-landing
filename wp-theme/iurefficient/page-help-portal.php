<?php
/* Template Name: Help Portal */
get_header();
$current_help_page = 'inicio';
get_template_part('template-parts/help-nav');
?>

<style>
<?php // Help portal pages load the help-portal stylesheet via wp_enqueue_style in functions.php ?>
</style>
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/styles.css'); ?>">

<!-- ===== Hero ===== -->
<section class="hero">
  <h1>Centro de Ayuda</h1>
  <p>Todo lo que necesitas para aprovechar al maximo tu Colaborador Especialista con Inteligencia Artificial.</p>
  <div class="hero-search">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    <input type="text" id="globalSearch" placeholder="Buscar articulos, tutoriales, preguntas..." autocomplete="off">
  </div>
</section>

<!-- ===== Categorias ===== -->
<section class="section">
  <h2 class="section-title">Explora por Categoria</h2>
  <p class="section-subtitle">Encuentra rapidamente lo que necesitas.</p>

  <div class="card-grid" id="categoryCards">

    <a href="<?php echo esc_url(home_url('/guia-inicio/')); ?>" class="card" data-search="primeros pasos inicio login registro cuenta contrasena">
      <div class="card-icon">&#128640;</div>
      <h3>Primeros Pasos</h3>
      <p>Registrate, accede al sistema y configura tu perfil en minutos.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#proyectos')); ?>" class="card" data-search="proyectos casos gestion clientes tareas">
      <div class="card-icon">&#128193;</div>
      <h3>Gestion de Proyectos</h3>
      <p>Crea proyectos, asigna tareas, gestiona clientes y controla plazos.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#documentos')); ?>" class="card" data-search="documentos archivos pdf subir descargar versionado ocr">
      <div class="card-icon">&#128196;</div>
      <h3>Gestion de Documentos</h3>
      <p>Sube, organiza y versiona documentos. OCR y procesamiento automatico.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#ia')); ?>" class="card" data-search="ia inteligencia artificial chat asistente rag consultas preguntas">
      <div class="card-icon">&#129302;</div>
      <h3>Asistente de IA (RAG)</h3>
      <p>Chatea con tus documentos. Respuestas precisas con fuentes verificadas.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#investigacion')); ?>" class="card" data-search="investigacion research web scraping buscar analisis">
      <div class="card-icon">&#128270;</div>
      <h3>Investigacion Inteligente</h3>
      <p>Investiga temas en la web y genera bases de conocimiento automaticamente.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#integraciones')); ?>" class="card" data-search="integraciones google microsoft office 365 calendar drive nextcloud">
      <div class="card-icon">&#128279;</div>
      <h3>Integraciones</h3>
      <p>Conecta Google Workspace, Microsoft 365, Nextcloud y mas.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#reportes')); ?>" class="card" data-search="reportes analitica productividad metricas dashboard graficas">
      <div class="card-icon">&#128200;</div>
      <h3>Reportes y Analitica</h3>
      <p>Dashboards de productividad, reportes de uso, seguimiento de ROI.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/funcionalidades/#seguridad')); ?>" class="card" data-search="seguridad cifrado permisos roles privacidad gdpr">
      <div class="card-icon">&#128274;</div>
      <h3>Seguridad y Permisos</h3>
      <p>Cifrado AES-256, roles granulares, auditoria y cumplimiento GDPR.</p>
      <span class="card-link">Ver guia</span>
    </a>

    <a href="<?php echo esc_url(home_url('/industrias/')); ?>" class="card" data-search="industrias legal abogados contabilidad consultoria ingenieria rrhh">
      <div class="card-icon">&#127970;</div>
      <h3>Soluciones por Industria</h3>
      <p>Legal, Contabilidad, Consultoria, Ingenieria, RRHH y mas.</p>
      <span class="card-link">Ver guia</span>
    </a>

  </div>
</section>

<!-- ===== Como funciona ===== -->
<section class="section" style="background:#fff; border-top:1px solid var(--gray-200); border-bottom:1px solid var(--gray-200);">
  <div style="max-width:var(--max-w); margin:0 auto;">
    <h2 class="section-title" style="text-align:center;">Como funciona Iurefficient</h2>
    <p class="section-subtitle" style="text-align:center;">Empieza a ahorrar tiempo en 4 sencillos pasos.</p>
    <div class="steps">
      <div class="step">
        <h4>Sube tus documentos</h4>
        <p>Arrastra contratos, informes, expedientes. El sistema los procesa automaticamente con OCR y extraccion de entidades.</p>
      </div>
      <div class="step">
        <h4>Pregunta lo que necesites</h4>
        <p>Chatea en lenguaje natural. El asistente responde con informacion exacta de tus documentos, citando fuentes.</p>
      </div>
      <div class="step">
        <h4>Genera documentos</h4>
        <p>Borradores de demandas, reportes, propuestas o memorias tecnicas en segundos, basados en tu estilo y datos reales.</p>
      </div>
      <div class="step">
        <h4>Colabora con tu equipo</h4>
        <p>Asigna tareas, comparte proyectos, recibe notificaciones. Todo el equipo conectado en tiempo real.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FAQ rapido ===== -->
<section class="section">
  <h2 class="section-title">Preguntas frecuentes</h2>
  <p class="section-subtitle">Las dudas mas comunes resueltas rapidamente.</p>
  <div class="faq-list">

    <div class="faq-item">
      <button class="faq-question">Iurefficient reemplaza a mis profesionales?</button>
      <div class="faq-answer">
        <p>No. Iurefficient es un <strong>asistente</strong> que potencia a tus profesionales para que sean 2-3x mas productivos. Se encarga de research, analisis y borradores mientras tu equipo se enfoca en estrategia y relacion con clientes.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Que tan precisa es la informacion?</button>
      <div class="faq-answer">
        <p>Iurefficient usa RAG (Retrieval-Augmented Generation) para recuperar texto exacto de fuentes verificadas antes de generar respuestas. Toda respuesta incluye citas con fuente, pagina y fecha. Precision >95% en facts verificables.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Mis datos estan seguros?</button>
      <div class="faq-answer">
        <p>Absolutamente. Implementamos cifrado AES-256 en reposo y en transito, autenticacion 2FA, aislamiento total por organizacion y cumplimiento GDPR. Tus datos jamas se usan para entrenar modelos de IA.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Cuanto tarda la implementacion?</button>
      <div class="faq-answer">
        <p><strong>Profesional individual:</strong> 1 hora. <strong>Firma pequena (5-10 personas):</strong> 1 semana incluyendo capacitacion. <strong>Empresa grande (50+):</strong> 2-4 semanas con migracion y personalizacion.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Necesito conocimientos tecnicos?</button>
      <div class="faq-answer">
        <p>No. Si sabes usar WhatsApp, sabes usar Iurefficient. La interfaz es conversacional e intuitiva. Ademas, incluimos capacitacion para tu equipo.</p>
      </div>
    </div>

  </div>
  <p style="margin-top:1.5rem;"><a href="<?php echo esc_url(home_url('/faq/')); ?>" class="card-link" style="font-weight:600;">Ver todas las preguntas frecuentes</a></p>
</section>

<!-- ===== CTA ===== -->
<section class="section">
  <div class="cta-banner">
    <h2>Listo para transformar tu practica profesional?</h2>
    <p>Prueba Iurefficient gratis durante 14 dias. Sin tarjeta de credito. Sin compromiso.</p>
    <a href="<?php echo esc_url(home_url('/planes/#prueba')); ?>" class="btn-white">Comenzar prueba gratis</a>
  </div>
</section>

<?php
get_template_part('template-parts/help-footer');
?>

<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/app.js'); ?>"></script>

<?php get_footer(); ?>
