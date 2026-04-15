<?php
/* Template Name: FAQ */
get_header();
$current_help_page = 'faq';
get_template_part('template-parts/help-nav');
?>

<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/styles.css'); ?>">

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/help-portal/')); ?>">Ayuda</a> / Preguntas Frecuentes</div>
    <h1>Preguntas Frecuentes</h1>
    <p>Encuentra respuestas a las dudas mas comunes sobre Iurefficient.</p>
  </div>
</div>

<section class="section">

  <!-- Sobre el Producto -->
  <h2 class="section-title" style="margin-bottom:.5rem;">Sobre el Producto</h2>
  <p class="section-subtitle">Que es, como funciona y que esperar.</p>
  <div class="faq-list" style="margin-bottom:3rem;">

    <div class="faq-item">
      <button class="faq-question">Que es exactamente Iurefficient?</button>
      <div class="faq-answer">
        <p>Iurefficient es una plataforma de gestion de proyectos profesionales potenciada con Inteligencia Artificial. Funciona como un <strong>"Colaborador Especialista"</strong>: un asistente inteligente que conoce tus documentos, tu normativa y tus proyectos, y te ayuda a investigar, analizar y generar documentos con informacion precisa y verificada.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Iurefficient reemplaza a mis profesionales?</button>
      <div class="faq-answer">
        <p>No. Iurefficient es un <strong>asistente</strong>, no un reemplazo. Potencia a tus profesionales para que sean 2-3x mas productivos, permitiendoles enfocarse en estrategia y relacion con clientes mientras el sistema maneja research, analisis y generacion de borradores.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Que tan precisa es la informacion que genera?</button>
      <div class="faq-answer">
        <p>Iurefficient usa <strong>RAG (Retrieval-Augmented Generation)</strong> para recuperar texto exacto de fuentes verificadas antes de generar respuestas. Toda respuesta incluye citas con nombre del documento, pagina y fecha. Precision &gt;95% en datos verificables. A diferencia de ChatGPT, nunca inventa informacion: si no la encuentra en tus documentos, te lo dice.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Se actualiza el conocimiento legal y normativo?</button>
      <div class="faq-answer">
        <p>Si, <strong>continuamente</strong>. Monitoreamos fuentes oficiales (DOF, BOE, EUR-Lex, etc.) y actualizamos nuestras bases de conocimiento semanalmente (legal) o mensualmente (otros sectores). Tu organizacion siempre tiene acceso a la normativa mas reciente.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Puedo usar Iurefficient en otros idiomas?</button>
      <div class="faq-answer">
        <p>Actualmente <strong>espanol e ingles</strong> estan completamente soportados. El sistema es multilingue y puede trabajar con documentos en multiples idiomas simultaneamente. Proximamente: frances, aleman y portugues.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Funciona offline?</button>
      <div class="faq-answer">
        <p>Parcialmente. Puedes acceder en solo-lectura a proyectos y documentos recientes sin internet. Las funciones que requieren IA (consultas, generacion de documentos, investigacion) necesitan conexion a internet.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Que diferencia a Iurefficient de ChatGPT o Copilot?</button>
      <div class="faq-answer">
        <p>La diferencia clave es el <strong>RAG (Retrieval-Augmented Generation)</strong>: Iurefficient responde basandose en <strong>tus documentos reales</strong> y bases de conocimiento especializadas, no en conocimiento general. Ademas, incluye gestion de proyectos, tareas, documentos, integraciones y herramientas especificas para tu industria &mdash; todo en una sola plataforma.</p>
      </div>
    </div>

  </div>

  <!-- Implementacion -->
  <h2 class="section-title" style="margin-bottom:.5rem;">Sobre la Implementacion</h2>
  <p class="section-subtitle">Tiempos, migracion y requisitos tecnicos.</p>
  <div class="faq-list" style="margin-bottom:3rem;">

    <div class="faq-item">
      <button class="faq-question">Cuanto tarda la implementacion?</button>
      <div class="faq-answer">
        <p><strong>Profesional individual:</strong> 1 hora (registrate y empieza). <strong>Firma pequena (5-10 personas):</strong> 1 semana incluyendo capacitacion. <strong>Empresa grande (50+ personas):</strong> 2-4 semanas con migracion de datos y personalizacion.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Necesito conocimientos tecnicos?</button>
      <div class="faq-answer">
        <p>No. Si sabes usar WhatsApp, sabes usar Iurefficient. La interfaz es conversacional e intuitiva. Ademas, incluimos capacitacion gratuita para tu equipo y documentacion detallada.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Como migro mis documentos y casos existentes?</button>
      <div class="faq-answer">
        <p>Tienes tres opciones:</p>
        <ul>
          <li><strong>Upload masivo:</strong> Arrastra carpetas completas al sistema.</li>
          <li><strong>Integracion con Google Drive / OneDrive:</strong> Sincronizacion automatica bidireccional.</li>
          <li><strong>Migracion asistida:</strong> Nuestro equipo te ayuda con la migracion (disponible en Plan Enterprise).</li>
        </ul>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Se integra con mi software actual?</button>
      <div class="faq-answer">
        <p>Si. Tenemos integraciones nativas con:</p>
        <ul>
          <li><strong>Google Workspace:</strong> Drive, Calendar, Gmail.</li>
          <li><strong>Microsoft 365:</strong> OneDrive, Outlook, Teams.</li>
          <li><strong>Nextcloud:</strong> Almacenamiento privado.</li>
          <li><strong>ERP:</strong> Dolibarr, Odoo (sincronizacion bidireccional).</li>
          <li><strong>AWS S3 / Azure Blob:</strong> Almacenamiento empresarial.</li>
          <li><strong>API REST:</strong> Para integraciones personalizadas.</li>
        </ul>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Puedo instalar Iurefficient en mis propios servidores?</button>
      <div class="faq-answer">
        <p>Si. El Plan Enterprise ofrece la opcion de <strong>despliegue on-premise</strong> o en tu nube privada (AWS, Azure, GCP). Tambien ofrecemos despliegue hibrido donde los datos sensibles permanecen en tu infraestructura.</p>
      </div>
    </div>

  </div>

  <!-- Seguridad -->
  <h2 class="section-title" style="margin-bottom:.5rem;">Seguridad y Privacidad</h2>
  <p class="section-subtitle">Proteccion de datos y cumplimiento normativo.</p>
  <div class="faq-list" style="margin-bottom:3rem;">

    <div class="faq-item">
      <button class="faq-question">Mis datos estan seguros?</button>
      <div class="faq-answer">
        <p>Absolutamente. Implementamos multiples capas de seguridad:</p>
        <ul>
          <li><strong>Cifrado AES-256:</strong> Datos cifrados en reposo y en transito.</li>
          <li><strong>Autenticacion 2FA:</strong> Doble factor de autenticacion.</li>
          <li><strong>Aislamiento total:</strong> Cada organizacion tiene datos completamente aislados (multi-tenant con segregacion a nivel de base de datos).</li>
          <li><strong>Backups automaticos:</strong> Respaldos diarios con retencion configurable.</li>
          <li><strong>Auditoria completa:</strong> Log de todas las acciones de usuarios.</li>
        </ul>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Usan mis datos para entrenar la IA?</button>
      <div class="faq-answer">
        <p><strong>Jamas.</strong> Tus datos son exclusivamente tuyos. No los usamos para entrenar modelos de IA ni los compartimos con terceros. Cada organizacion opera en un entorno completamente aislado.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Cumplen con GDPR / LFPDPPP?</button>
      <div class="faq-answer">
        <p>Si. Cumplimos con GDPR (Europa), LFPDPPP (Mexico) y CCPA (California). Ofrecemos:</p>
        <ul>
          <li>Derecho al olvido (eliminacion completa de datos).</li>
          <li>Exportacion de datos en formato estandar.</li>
          <li>Residencia de datos configurable (EU, US, LATAM).</li>
          <li>Oficial de proteccion de datos (DPO) designado.</li>
        </ul>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Donde se almacenan mis datos?</button>
      <div class="faq-answer">
        <p>Puedes elegir la region de almacenamiento segun tus necesidades regulatorias: <strong>Union Europea</strong>, <strong>Estados Unidos</strong> o <strong>Latinoamerica</strong>. Para Plan Enterprise, ofrecemos despliegue multi-region y on-premise.</p>
      </div>
    </div>

  </div>

  <!-- Soporte -->
  <h2 class="section-title" style="margin-bottom:.5rem;">Soporte y Facturacion</h2>
  <p class="section-subtitle">Ayuda, pagos y cancelaciones.</p>
  <div class="faq-list">

    <div class="faq-item">
      <button class="faq-question">Que tipo de soporte ofrecen?</button>
      <div class="faq-answer">
        <p>Dependiendo de tu plan:</p>
        <ul>
          <li><strong>Basico:</strong> Email con respuesta en 48 horas + documentacion.</li>
          <li><strong>Profesional:</strong> Soporte prioritario + webinars + API access.</li>
          <li><strong>Enterprise:</strong> Soporte dedicado 24/7 + SLA 99.9% + capacitacion personalizada.</li>
        </ul>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Puedo cancelar en cualquier momento?</button>
      <div class="faq-answer">
        <p>Si. No hay contratos de permanencia. Puedes cancelar cuando quieras. Si pagas anual, recibes un reembolso proporcional por los meses no utilizados. Tus datos permanecen disponibles para exportacion durante 30 dias despues de la cancelacion.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Ofrecen descuentos por volumen o pago anual?</button>
      <div class="faq-answer">
        <p>Si. <strong>Pago anual:</strong> 20% de descuento sobre el precio mensual. <strong>Descuento por volumen:</strong> Disponible para contratos de 20+ usuarios (contactar ventas). <strong>ONGs y educacion:</strong> Descuento especial &mdash; contactanos.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Que metodos de pago aceptan?</button>
      <div class="faq-answer">
        <p>Tarjeta de credito/debito (Visa, Mastercard, American Express), transferencia bancaria (factura mensual), y para Enterprise: ordenes de compra y facturacion personalizada.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Tienen garantia de satisfaccion?</button>
      <div class="faq-answer">
        <p>Si. Si no ahorras al menos <strong>10 horas en el primer mes</strong>, te devolvemos el 100% de tu inversion. Soporte ilimitado durante los primeros 60 dias y capacitacion incluida para todo tu equipo.</p>
      </div>
    </div>

  </div>

</section>

<!-- CTA -->
<section class="section">
  <div class="cta-banner">
    <h2>Aun tienes dudas?</h2>
    <p>Nuestro equipo esta listo para ayudarte. Agenda una demo personalizada de 30 minutos.</p>
    <a href="mailto:sales@iurefficient.com?subject=Solicitar demo Iurefficient" class="btn-white">Agendar demo</a>
  </div>
</section>

<?php
get_template_part('template-parts/help-footer');
?>

<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/app.js'); ?>"></script>

<?php get_footer(); ?>
